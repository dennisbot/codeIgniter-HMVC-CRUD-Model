<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generador extends MX_Controller
{
    public $entity_name;
    public $identity;
    public $mvc = array();
    private $list_tables;

    function __construct()
    {
        parent::__construct();
        $this->list_tables = $this->db->list_tables();
        $this->load->library('form_validation');
        $this->template->add_css(base_css() . "generator.css");
    }
    function index()
    {
        /*var_dump($this->indent(json_encode(array('frutas' => array('platano', 'mandarina', 'queso')))));
        var_dump(json_encode(array('frutas' => array('platano', 'mandarina', 'queso'))));
        exit;*/

        $this->load->database();
        $this->load->helper('url');
        if ($this->input->post('table_data', true) || !$_POST) {
            // get table data
            $this->form_validation->set_rules('table', 'Table', 'required|trim|xss_clean|max_length[200]');
            if ($this->form_validation->run() !== false) {
                $result = $this->db->query("SHOW FIELDS from " . $this->list_tables[$this->input->post('table')]);
                $data['alias'] = $result->result();
                $data['table_name'] = $this->list_tables[$this->input->post('table')];
            }
            $data['table'] = $this->list_tables;
            $this->template->write_view('content', 'generador', $data);
            $this->template->render();
            // $this->load->view('generador', $data);
        }
        else {
            if ($this->input->post('generate', true)) {

                $this->load->helper('file');
                /* set the current entity name */
                $this->entity_name = $_POST['controller'];
                /* set the current identity's id */
                $this->identity = $_POST['primaryKey'];
                var_dump($this->identity);
                /* create files */
                $cur_dir = dirname(__DIR__);
                var_dump("cur_dir", $cur_dir);
                $cur_dir .= '/generados/';

                if (!(is_dir($cur_dir)))
                    mkdir ($cur_dir);

                $path_entity = $cur_dir . $this->entity_name;

                if (is_dir($path_entity))
                    $this->delete_directory($path_entity);
                /* creamos el directorio entidad que alojará a la triada */
                if(mkdir($path_entity)) {
                    echo "entidad " . $this->entity_name . " creada<br />";
                }


                $this->mvc = array(
                    'models' => $path_entity . '/models/',
                    'views' => $path_entity . '/views/',
                    'controllers' => $path_entity . '/controllers/',
                    'assets' => array(
                        'js' => 'assets/' . $this->entity_name . '/js/'
                    )
                );
                foreach ($this->mvc as $key => $value) {
                    if ($key == 'assets') {
                        foreach ($this->mvc[$key] as $k => $v) {
                            if (is_dir($this->mvc[$key][$k])) {
                                $this->delete_directory($this->mvc[$key][$k]);
                            }
                            var_dump($this->mvc[$key][$k]);
                            if ($res = mkdir($this->mvc[$key][$k])) {
                                echo "directorio assets -> " . $k . " creado<br />";
                            } else {
                                var_dump($res);
                            }
                        }
                    }
                    else {
                        if (mkdir($value)) {
                            echo "carpeta " . $key . " creada<br />";
                        }
                    }
                }

                /* create model */
                $this->create_model();
                /* create model headers */
                $this->create_model_headers();
                /* create controller */
                $this->create_controller();
                /* create views */
                $this->create_view();
                /* create assets js */
                $this->create_assets_js();
                /* create delete index.js */
                $this->create_delete_js();
                echo '<a href="'.base_url().'">Ir al inicio</a>';
            }
        }

    }

    function form_validations($rules) {
        $res = "\n";
        foreach ($rules as $key => $value) {
            $r = "";
            foreach ($value as $rule) {
                $r .= "|" . $rule;
            }
            $r = substr($r, 1);
            $res .= "        $" . "this->form_validation->set_rules('$key','$key', '$r');\n";
        }
        return $res;
    }

    function form_validations_array($rules)
    {
        $res = "return array(\n";
        foreach ($rules as $key => $value) {
            $r = "";
            foreach ($value as $rule) {
                $r .= "|" . $rule;
            }
            $r = substr($r, 1);
            $res .= str_repeat(' ', 12)."'$key' => array(
                    'field' => '$key',
                    'label' => '$key',
                    'rules' => '$r'
                    ),\n";
        }
        return substr($res, 0, -2) . "\n" . str_repeat(' ', 8).");";
    }

    function create_model()
    {
        $content = file_get_contents('templates/models/mdl_entity.php');

        $model_search = array('{model_name}', '{entity}', '{identity}', '{form_validations}');

        $replace = array(
            'Mdl_' . $this->entity_name,
            $this->entity_name,
            $this->identity,
            $this->form_validations_array($_POST['rules'])
        );

        $model_content = str_replace($model_search, $replace, $content);

        write_file($this->mvc['models'] . 'mdl_' . $this->entity_name . '.php', $model_content);
    }

    function create_model_headers()
    {
        $content = file_get_contents('templates/models/mdl_entity_table.php');

        $model_search = array('{model_name_table}', '{headers}');

        $replace = array(
            'Mdl_' . $this->entity_name . '_table',
            $this->headers($_POST['field'])
        );

        $model_content = str_replace($model_search, $replace, $content);

        write_file($this->mvc['models'] . 'mdl_' . $this->entity_name . '_table.php', $model_content);
    }

    function headers($fields)
    {
        $res = "$" . "headers = array(\n";
        $res .= "        '" . $this->identity . "' => anchor('" . $this->entity_name . '/index/order_by/' . $this->identity . "/order/'.$" . "order, '" . $this->identity . "'),\n";
        foreach ($fields as $field) {

            $res .= "        '" . $field . "' => anchor('" . $this->entity_name . '/index/order_by/' . $field . "/order/'.$" . "order, '" . $field . "'),\n";
        }
        $res .= "        );\n";
        return $res;
    }

    function create_controller()
    {
        $content = file_get_contents('templates/controllers/entity.php');

        $controller_search = array('{controller_name}', '{entity}', '{identity}', '{model_name}', '{model_name_table}', '{switch_order}');

        $replace = array(
            ucfirst($this->entity_name),
            $this->entity_name,
            $this->identity,
            'mdl_' . $this->entity_name,
            'mdl_' . $this->entity_name . '_table',
            $this->switch_order($_POST['field'])
        );

        $controller_content = str_replace($controller_search, $replace, $content);

        write_file($this->mvc['controllers'] . $this->entity_name . '.php', $controller_content);
    }

    function switch_order($fields)
    {
        $content = "switch (" . "$" . "order_by) {\n";

        foreach ($fields as $field) {

            $content .= "          case '" . $field . "':\n";
            $content .= "              " . "$" . "params['order_by'] = '" . $this->entity_name . "." . $field . " ' .$" . "order;\n";
            $content .= "              break;\n";
        }

        /* default */

        $content .= "          default:\n";
        $content .= "              " . "$" . "params['order_by'] = '" . $this->entity_name . "." . $this->identity . " ' .$" . "order;\n";
        $content .= "          }\n";
        return $content;
    }

    function create_view()
    {
        /* para el form */
        $content = file_get_contents('templates/views/form.php');

        $views_search = array('{entity}', '{fields_form}');

        $replace = array(
            $this->entity_name,
            $this->fields_form($_POST['type'])
        );

        $view_content = str_replace($views_search, $replace, $content);

        write_file($this->mvc['views'] . 'form.php', $view_content);

        /* para el index/table */
        $content = file_get_contents('templates/views/index.php');

        $views_search = array('{entity}', '{identity}', '{headers}');

        $replace = array(
            $this->entity_name,
            $this->identity,
            $this->view_headers()
        );

        $view_content = str_replace($views_search, $replace, $content);

        write_file($this->mvc['views'] . 'index.php', $view_content);
    }

    function view_headers()
    {
        $espacios = str_repeat(' ', 16);
        $content = "<?php\n";
        $content .= $espacios . "foreach ($" . "table_headers as $" . "key => $" . "value) { ?>\n";
        $content .= $espacios . "<th><?php echo $" . "table_headers[$" . "key]; ?></th>\n";
        $content .= $espacios . "<?php } ?>\n";

        $content .= $espacios . "<th><?php echo $" . "this->lang->line('actions'); ?></th>\n";

        return $content;
    }

    function fields_form($fields)
    {
        $rules = $_POST['rules'];
        $space16 = str_repeat(' ', 16);
        $space12 = str_repeat(' ', 12);
        $space8 = str_repeat(' ', 8);
        $res = "";
        foreach ($fields as $key => $field) {
            $ok = false;
            foreach ($rules[$key] as $value) {
                if ($value == 'required') {
                    $ok = true;
                    break;
                }
            }
            $req = $ok ? '*' : '';
            $res .= $space8 . "<div class=\"form-group <?php echo form_error('$key') != '' ? 'has-error has-feedback' : '';?>\">\n";
            $res .= $space12 . "<label class=\"col-sm-3 control-label\" for=\"$key\">$req $key </label>\n";
            $content = "";
            switch ($field) {
                case 'password' :
                case 'text' :
                    $content = $space16.'<input type="text" name="' . $key . '" id="'.$key.'" class="form-control" value="<?php echo $this->mdl_' . $this->entity_name . '->form_value(\'' . $key . '\'); ?>" />';
                    break;
                case 'dropdown' :
                    $content = $space16.'<select name="' . $key . '">' . "\n" . '
                                            <option>' . $key . '</option>' . "\n" . '
                               </select>' . "\n";
                    break;
                case 'textarea' :
                    $content = $space16.'<textarea cols="26" rows="8" name="' . $key . '" id="' . $key . '"><?php echo $this->mdl_' . $this->entity_name . '->form_value(\'' . $key . '\'); ?></textarea>';
                    break;
            }
            $content .= $space12 . "<?php if (form_error('$key') != ''): ?>\n
                    <span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>\n
                <?php endif ?>";
            $res .= $space12 . "<div class=\"col-sm-9\">\n$content\n$space12</div>\n";
            $res .= $space8 . "</div>\n";
        }
        return $res;
    }

    public function create_assets_js()
    {
        $rules = $_POST['rules'];
        $space4 = str_repeat(' ', 4);
        $space8 = str_repeat(' ', 8);
        $space12 = str_repeat(' ', 12);
        $space16 = str_repeat(' ', 16);
        $content_asset_js = "$(document).ready(function() {\n";
        $content_asset_js .= $space4 . "$.validator.messages.required = 'Este campo es requerido';\n";
        $content_asset_js .= $space4 . "$.validator.messages.email = 'Ingrese una dirección de email válida';\n";
        $content_asset_js .= $space4 . "$('#form-" . $this->entity_name . "').validate(\n";
        $res = array('rules' => array());
        $map_rules = array('required' => 'required', 'valid_email' => 'email');
        var_dump($this->indent_json(json_encode($rules)));
        if (isset($rules) && !empty($rules)) {
            foreach ($rules as $name => $the_rules) {
                    $res['rules'][$name] = array();
                    foreach ($the_rules as $the_rule) {
                        if ($the_rule != 'required' && $the_rule != 'valid_email') continue;
                        $res['rules'][$name][$map_rules[$the_rule]] = true;
                    }
            }
            $content_asset_js .= $this->indent_json(json_encode($res)) . "\n";
            $content_asset_js .= $space8 . ");//end of validate\n";
            $content_asset_js .= $space4 . "}//end of function\n";
            $content_asset_js .= ");//end of ready\n";
        }
        else {
            echo "esta vacio los rules";
        }
        write_file($this->mvc['assets']['js'] . 'validate_' . $this->entity_name . '.js', $content_asset_js);
    }

    public function create_delete_js()
    {
        $js = "$(function() {
    bootbox.setDefaults({locale: 'es'});
    $('.delete-record').click(function() {
        var that  = this;
        bootbox.confirm('<center><h3>¿Estás seguro de eliminar este registro?</h3></center>', function(result) {
            console.log('result: ', result);
            if (result) {
                window.location.href = that.href;
            }
        });
        return false;
    })
});
";
        write_file($this->mvc['assets']['js'] . 'index.js', $js);
    }


    function fexist($path)
    {
        if (file_exists($path)) {
            // todo , automatically adds new validation
            return $path . ' - File exists <br>';
        } else {
            return false;
        }
    }

    function writefile($file, $content)
    {

        if (!write_file($file, $content)) {
            return $file . ' - Unable to write the file';
        } else {
            return false;
        }
    }

    function delete_directory($dirname)
    {

        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;

    }
    function indent_json($json)
    {

        $pos         = 0;
        $strLen      = strlen($json);
        $indentStr   = str_repeat(' ', 2);
        $newLine     = "\n";
        $prevChar    = '';
        $outOfQuotes = true;
        $tab         = str_repeat(' ', 12);
        $result      = $tab;

        for ($i=0; $i<=$strLen; $i++) {

            // Grab the next character in the string.
            $char = substr($json, $i, 1);

            // Are we inside a quoted string?
            if ($char == '"' && $prevChar != '\\') {
                $outOfQuotes = !$outOfQuotes;

            // If this character is the end of an element,
            // output a new line and indent the next line.
            } else if(($char == '}' || $char == ']') && $outOfQuotes) {
                $result .= $newLine . $tab;
                $pos --;
                $result .= str_repeat($indentStr, $pos);
            }

            // Add the character to the result string.
            $result .= $char;

            // If the last character was the beginning of an element,
            // output a new line and indent the next line.
            if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
                $result .= $newLine . $tab;
                if ($char == '{' || $char == '[') {
                    $pos ++;
                }

                $result .= str_repeat($indentStr, $pos);
            }

            $prevChar = $char;
        }

        return $result;
    }
}

?>