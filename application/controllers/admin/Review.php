<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

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
		$this->table_ratings = 'ratings';
		$this->load->helper('number');
		$this->load->library("pagination");
	}

	public function index()
	{

		if($this->session->userdata('logged_in')){

			 /* if(isset($_GET['sub_cat_id'])){

			  		$resultCount = $this->Common_model->numrowsDbQuery("SELECT c.category_name, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` AND c.cat_id = '".$_GET['sub_cat_id']."'");
			  }
			  else
			  {
			  		$resultCount = $this->Common_model->numrowsDbQuery("SELECT c.category_name, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id`");
			  }
			*/
			
			$resultCount = $this->Common_model->numrowsDbQuery("SELECT c.category_name, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id`");

			$config = array();
	        $config["base_url"] = base_url() . "admin/review";
	        $config["total_rows"] = $resultCount;
	        $config["per_page"] = 10;
	        /* if(isset($_GET['sub_cat_id'])){
	        	 $config['reuse_query_string'] = TRUE;
	   		}*/
	        $config['enable_query_strings'] = TRUE;
	        $config["uri_segment"] = 3;
	       


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

	        $result['category'] = $this->Common_model->getValueall($this->table_categories);


	       /* if(isset($_GET['sub_cat_id'])){

	        	$result['subCategory'] = $this->Common_model->dbQuery("SELECT c.category_name, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` AND c.cat_id =  '".$_GET['sub_cat_id']."'order by sc.cat_id limit ".$page.",10");
	        }
	        else
	        {
	        	$result['subCategory'] = $this->Common_model->dbQuery("SELECT c.category_name, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` order by sc.cat_id limit ".$page.",10");
	        }*/

	        $result['subCategory'] = $this->Common_model->dbQuery("SELECT c.category_name, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` order by sc.cat_id limit ".$page.",10");
			
			$data['content'] = $this->load->view('admin/review/list',$result, true);
			$this->load->view('template/admin/main',$data);
			
			//redirect(admin.'/dashboard/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

	public function details()
	{

		if($this->session->userdata('logged_in')){

			



				$result['subCatDetails'] = $this->Common_model->getSingle($this->table_sub_categories,array('sub_cat_id' => $this->uri->segment(4) ));

				$result['rating'] = $this->Common_model->getAllData($this->table_ratings, array('sub_cat_id' => $this->uri->segment(4)));
				$data['rating'] = $result['rating'];
				//print_r($result['category']);
				$data['content'] = $this->load->view('admin/review/review-details',$result, true);
				$this->load->view('template/admin/main',$data);
			
			
			
			
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}





}
