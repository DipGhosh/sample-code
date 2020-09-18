<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()  
    {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		
		$this->load->database();
		$this->load->model(array('Common_model'));
		$this->load->library('user_agent');
		$this->table_super = 'super_admin';
		$this->table_login_data = 'login_data';
		$this->table_categories = 'categories';
		$this->table_sub_categories = 'sub_categories';
		$this->table_users = 'users';
		$this->load->library("pagination");
	}

	public function index()
	{

		if($this->session->userdata('logged_in')){


			$resultCount = $this->Common_model->numrowsDbQuery("Select user_id from $this->table_users");

			$config = array();
	        $config["base_url"] = base_url() . "admin/users";
	        $config["total_rows"] = $resultCount;
	        $config["per_page"] = 10;
	        $config['enable_query_strings'] = TRUE;
	        $config["uri_segment"] = 3;
	        /*$config['cur_tag_open'] = '<strong>';
		    $config['cur_tag_close'] = '</strong>';*/


		    $config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";

	       
			$config['num_links'] = 3;
	        $this->pagination->initialize($config);

	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	        $result['page'] = $page;

	        $result["links"] = $this->pagination->create_links();
			$result['subCategory'] =  $this->Common_model->getDatawithlimit($this->table_users, '','user_id',$page,10);//$this->Common_model->getValueall($this->table_users);
			$data['content'] = $this->load->view('admin/users/list',$result, true);
			$this->load->view('template/admin/main',$data);
			
			//redirect(admin.'/dashboard/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

	public function inactive($id)
	{

		if($this->session->userdata('logged_in')){

			
			$this->Common_model->update_data($this->table_users,array('user_id' => $id ),array('active' => 'N'));

			redirect(admin.'users/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

public function active($id)
	{

		if($this->session->userdata('logged_in')){

			
			$this->Common_model->update_data($this->table_users,array('user_id' => $id ),array('active' => 'Y'));

			redirect(admin.'users/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}







}
