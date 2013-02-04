<?php

/**
 * CodeIgniter CRUD Model 2
 * A base model providing CRUD, pagination and validation.
 *
 * Install this file as application/core/MY_Model.php
 *
 * @package	CodeIgniter
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012, Jesse Terry
 * @link		http://developer13.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */
class MY_Model extends CI_Model {

	public $table;
	public $primary_key;
	public $default_limit	 = 15;
	public $page_links;
	public $query;
	public $form_values	 = array();
	protected $default_validation_rules	 = 'validation_rules';
	protected $validation_rules;
	public $validation_errors;
	public $total_rows;
	public $date_created_field;
	public $date_modified_field;
	public $native_methods				 = array(
		'select', 'select_max', 'select_min', 'select_avg', 'select_sum', 'join',
		'where', 'or_where', 'where_in', 'or_where_in', 'where_not_in', 'or_where_not_in',
		'like', 'or_like', 'not_like', 'or_not_like', 'group_by', 'distinct', 'having',
		'or_having', 'order_by', 'limit'
	);
	public $user_funcs = array();
	public $order_by;
	public $order = 'asc';
	public function __call($name, $arguments)
	{
        call_user_func_array(array($this->db, $name), $arguments);
        $this->user_funcs[] = array($name, $arguments);
        return $this;
	}

	/**
	 * Sets CI query object and automatically creates active record query
	 * based on methods in child model.
	 * $this->model_name->get()
	 */
	public function get($include_defaults = true)
	{
		if ($include_defaults)
		{
			$this->set_defaults();
		}

		$this->query = $this->db->get($this->table);

		$this->user_funcs = array();

		return $this;
	}

	/**
	 * Query builder which listens to methods in child model.
	 * @param type $exclude
	 */
	private function set_defaults($exclude = array())
	{
		$native_methods = $this->native_methods;

		foreach ($exclude as $unset_method)
		{
			unset($native_methods[array_search($unset_method, $native_methods)]);
		}

		foreach ($native_methods as $native_method)
		{
			$native_method = 'default_' . $native_method;

			if (method_exists($this, $native_method))
			{
				$this->$native_method();
			}
		}
	}

	/**
	 * Call when paginating results.
	 * $this->model_name->paginate()
	 */
	public function paginate()
	{
		$uri_segment = '';
		$offset		 = 0;
		$per_page	 = $this->default_limit;

		$this->load->helper('url');
		$this->load->library('pagination');

		$this->set_defaults();

		$uri_segments = $this->uri->segment_array();
		foreach ($uri_segments as $key => $segment)
		{
			if ($segment == 'page')
			{
				$uri_segment = $key + 1;

				if (isset($uri_segments[$uri_segment]))
				{
					$offset = $uri_segments[$uri_segment];
				}

				unset($uri_segments[$key], $uri_segments[$key + 1]);

				$base_url = site_url(implode('/', $uri_segments) . '/page/');
			}
		}

		$this->total_rows = $this->get($this->table)->num_rows();

		if (!$uri_segment)
		{
			$base_url = site_url($this->uri->uri_string() . '/page/');
		}

		$config = array(
			'base_url'		 => $base_url,
			'uri_segment'	 => $uri_segment,
			'total_rows'	 => $this->total_rows,
			'per_page'		 => $per_page
		);

		if ($this->config->item('pagination_style'))
		{
			$config = array_merge($config, $this->config->item('pagination_style'));
		}

		$this->pagination->initialize($config);

		$this->page_links = $this->pagination->create_links();

		/**
		 * Done with pagination, now on to the paged results
		 */
		$this->set_defaults();

        foreach ($this->user_funcs as $func)
        {
            call_user_func_array(array($this->db, $func[0]), $func[1]);
        }


		$this->db->limit($per_page, $offset);
		$this->query = $this->db->get($this->table);

		$this->user_funcs = array();

		return $this;
	}

	/**
	 * Retrieves a single record based on primary key value.
	 */
	public function get_by_id($id)
	{
		return $this->where($this->primary_key, $id)->get()->row();
	}

	public function save($id = NULL, $db_array = NULL)
	{
		if (!$db_array)
		{
			$db_array = $this->db_array();
		}

		if (!$id)
		{
			if ($this->date_created_field)
			{
				$db_array[$this->date_created_field] = time();
			}

			$this->db->insert($this->table, $db_array);

			$this->session->set_flashdata('alert_success', 'Record successfully created.');

			return $this->db->insert_id();
		}
		else
		{
			if ($this->date_modified_field)
			{
				$db_array[$this->date_modified_field] = time();
			}

			$this->db->where($this->primary_key, $id);
			$this->db->update($this->table, $db_array);

			$this->session->set_flashdata('alert_success', 'Record successfully updated.');

			return $id;
		}
	}

	/**
	 * Returns an array based on $_POST input matching the ruleset used to
	 * validate the form submission.
	 */
	public function db_array()
	{
		$db_array = array();

		$validation_rules = $this->{$this->validation_rules}();

		foreach ($this->input->post() as $key => $value)
		{
			if (array_key_exists($key, $validation_rules))
			{
				$db_array[$key] = $value;
			}
		}

		return $db_array;
	}

	/**
	 * Deletes a record based on primary key value.
	 * $this->model_name->delete(5);
	 */
	public function delete($id)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->delete($this->table);

		$this->session->set_flashdata('alert_success', 'Record successfully deleted.');
	}

	/**
	 * Returns the CI query result object.
	 * $this->model_name->get()->result();
	 */
	public function result()
	{
		return $this->query->result();
	}

	/**
	 * Returns the CI query row object.
	 * $this->model_name->get()->row();
	 */
	public function row()
	{
		return $this->query->row();
	}

	/**
	 * Returns CI query result array.
	 * $this->model_name->get()->result_array();
	 */
	public function result_array()
	{
		return $this->query->result_array();
	}

	/**
	 * Returns CI query row array.
	 * $this->model_name->get()->row_array();
	 */
	public function row_array()
	{
		return $this->query->row_array();
	}

	/**
	 * Returns CI query num_rows().
	 * $this->model_name->get()->num_rows();
	 */
	public function num_rows()
	{
		return $this->query->num_rows();
	}

	/**
	 * Used to retrieve record by ID and populate $this->form_values.
	 * @param int $id
	 */
	public function prep_form($id = NULL)
	{
		if (!$_POST and ($id))
		{
			$this->db->where($this->primary_key, $id);
			$row = $this->db->get($this->table)->row();
			foreach ($row as $key => $value)
			{
				$this->form_values[$key] = $value;
			}
		}
	}

	/**
	 * Performs validation on submitted form. By default, looks for method in
	 * child model called validation_rules, but can be forced to run validation
	 * on any method in child model which returns array of validation rules.
	 * @param string $validation_rules
	 * @return boolean
	 */
	public function run_validation($validation_rules = NULL)
	{
		if (!$validation_rules)
		{
			$validation_rules = $this->default_validation_rules;
		}

		foreach (array_keys($_POST) as $key)
		{
			$this->form_values[$key] = $this->input->post($key);
		}

		if (method_exists($this, $validation_rules))
		{
			$this->validation_rules = $validation_rules;

			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<li class="error">', '</li>');

			$this->form_validation->set_rules($this->$validation_rules());

			$run = $this->form_validation->run($this);

			$this->validation_errors = validation_errors();

			return $run;
		}
	}

	/**
	 * Returns the assigned form value to a form input element.
	 * @param type $key
	 * @return type
	 */
	public function form_value($key)
	{
		return (isset($this->form_values[$key])) ? $this->form_values[$key] : '';
	}

	public function set_form_value($key, $value)
	{
		$this->form_values[$key] = $value;
	}

}

?>