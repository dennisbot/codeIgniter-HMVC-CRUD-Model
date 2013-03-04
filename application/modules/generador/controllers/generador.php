<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generador extends MX_Controller {

    public $entity_name;
    public $identity;
    public $mvc = array();
    private $list_tables;
    function __construct() {
        parent::__construct();
        $this->list_tables = $this->db->list_tables();
        $this->load->library('form_validation');
    }
    function index() {
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

            $this->load->view('generador', $data);
        }
        else {
            if ($this->input->post('generate', true)) {

                $this->load->helper('file');
                //var_dump($_POST);exit;
                /* set the current entity name */
                $this->entity_name = $_POST['controller'];
                /* set the current identity's id */
                $this->identity = $_POST['primaryKey'];
                var_dump($this->identity);
                /* create files */
                $cur_dir = dirname(__DIR__);

                $cur_dir .= '/generados/';
                if (!(is_dir($cur_dir)))
                    mkdir ($cur_dir);

                $path_entity = $cur_dir . $this->entity_name;

                if (is_dir($path_entity))
                    $this->delete_directory($path_entity);

                echo mkdir($path_entity);

                $this->mvc = array(
                    'models' => $path_entity . '/models/',
                    'views' => $path_entity . '/views/',
                    'controllers' => $path_entity . '/controllers/',
                );
                foreach ($this->mvc as $value) {
                    echo mkdir($value);
                }

                /* create model */
                $this->create_model();
                /* create model headers */
                $this->create_model_headers();
                /* create controller */
                $this->create_controller();
                /* create views */
                $this->create_view();
                exit;
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
function form_validations_array($rules) {
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
        return substr($res, 0, -2) . "\n".str_repeat(' ', 8).");";
    }

    function create_model() {
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

    function create_model_headers() {
        $content = file_get_contents('templates/models/mdl_entity_table.php');

        $model_search = array('{model_name_table}', '{headers}');

        $replace = array(
            'Mdl_' . $this->entity_name . '_table',
            $this->headers($_POST['field'])
        );

        $model_content = str_replace($model_search, $replace, $content);

        write_file($this->mvc['models'] . 'mdl_' . $this->entity_name . '_table.php', $model_content);
    }

    function headers($fields) {
        $res = "$" . "headers = array(\n";
        $res .= "        '" . $this->identity . "' => anchor('" . $this->entity_name . '/index/order_by/' . $this->identity . "/order/'.$" . "order, '" . $this->identity . "'),\n";
        foreach ($fields as $field) {

            $res .= "        '" . $field . "' => anchor('" . $this->entity_name . '/index/order_by/' . $field . "/order/'.$" . "order, '" . $field . "'),\n";
        }
        $res .= "        );\n";
        return $res;
    }

    function create_controller() {
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

    function switch_order($fields) {

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

    function create_view() {
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

    function view_headers() {
        $espacios = "                ";
        $content = "<?php\n";
        $content .= $espacios . "foreach ($" . "table_headers as $" . "key => $" . "value) { ?>\n";
        $content .= $espacios . "<th><?php echo $" . "table_headers[$" . "key]; ?></th>\n";
        $content .= $espacios . "<?php } ?>\n";

        $content .= $espacios . "<th><?php echo $" . "this->lang->line('actions'); ?></th>\n";

        return $content;
    }

    function fields_form($fields) {
        $space16 = str_repeat(' ', 16);
        $space12 = str_repeat(' ', 12);
        $space8 = str_repeat(' ', 8);
        $res = "";
        $res .= "<dl>\n";

        $res .= $space12 . '<input type="hidden" name="' . $this->identity . '" value="<?php echo $this->mdl_' . $this->entity_name . '->form_value(\'' . $this->identity . '\'); ?>" />' . "\n";
        $res .= $space8 . "</dl>\n";
        foreach ($fields as $key => $field) {
            $res .= $space8 . "<div class=\"control-group <?php echo form_error('$key') != '' ? 'error' : '';?>\">\n";
            $res .= $space12 . "<label class=\"control-label\">* $key </label>\n";
            $content = "";
            switch ($field) {
                case 'text' :
                    $content = $space16.'<input type="text" name="' . $key . '" value="<?php echo $this->mdl_' . $this->entity_name . '->form_value(\'' . $key . '\'); ?>" />';
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
            $res .= $space12 . "<div class=\"controls\">\n$content\n$space12</div>\n";
            $res .= $space8 . "</div>\n";
        }
        return $res;
    }

    function fexist($path) {
        if (file_exists($path)) {
            // todo , automatically adds new validation
            return $path . ' - File exists <br>';
        } else {
            return false;
        }
    }

    function writefile($file, $content) {

        if (!write_file($file, $content)) {
            return $file . ' - Unable to write the file';
        } else {
            return false;
        }
    }

    function delete_directory($dirname) {

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

}

?>