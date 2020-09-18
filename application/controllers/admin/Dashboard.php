<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$this->table_question_data = 'question_data';
		$this->table_ratings = 'ratings';
		$this->table_users = 'users';
		
	}

	public function index()
	{

		if($this->session->userdata('logged_in')){

			$result = array();

			$result['categoryCount'] = $this->Common_model->numrowsDbQuery("Select cat_id from $this->table_categories ");
			$result['userCount'] = $this->Common_model->numrowsDbQuery("Select user_id from $this->table_users ");

			$result['questionCount'] = $this->Common_model->numrowsDbQuery("Select question_id from $this->table_question_data ");

			 $result['category'] = $this->Common_model->getDatawithlimit($this->table_categories, '','cat_id',0,5);

			 $result['subCategory'] = $this->Common_model->dbQuery("SELECT c.category_name, c.category_name_de,sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` order by sc.cat_id limit 0,5");

			 $result['review'] = $this->Common_model->dbQuery("SELECT c.category_name, c.category_name_de, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` order by sc.cat_id limit 0,15");

			$data['content'] = $this->load->view('admin/dashboard/dashboard',$result, true);
			$this->load->view('template/admin/main',$data);
			
			//redirect(admin.'/dashboard/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}


public function languages() 	{
	   extract($_POST);
	   $this->session->set_userdata('language', $dlang);
	   $redirect_url = base_url().$current;
	   redirect ($redirect_url);	

	}

}
