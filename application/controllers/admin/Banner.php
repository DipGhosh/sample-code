<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

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
		$this->table_banner = 'banner';
		
	}

	public function index()
	{

		if($this->session->userdata('logged_in')){

			$result['banner'] = $this->Common_model->getValueall($this->table_banner);
			$data['content'] = $this->load->view('admin/banner/list',$result, true);
			$this->load->view('template/admin/main',$data);
			
			//redirect(admin.'/dashboard/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

	public function add()
	{

		if($this->session->userdata('logged_in')){

			if($this->input->post('banner_description')){

				//$insertArray = array('');


				 $config['upload_path']   = './public/uploads/banner/'; 
		         $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		         /*$config['max_size']      = 100; 
		         $config['max_width']     = 1024; 
		         $config['max_height']    = 768;  */
		         $this->load->library('upload', $config);
					
		         if ( ! $this->upload->do_upload('fileup')) {
		            $error =  $this->upload->display_errors(); 
		            $this->session->set_flashdata('error', $error);
		            redirect('admin/category/add');
		            //print_r($error);

		            //$this->load->view('upload_form', $error); 
		         }
					
		         else { 
		            $imageData = $this->upload->data(); 
		            
		            $insertArray = array(
		            	'title' => $this->input->post('title'),
		            	'description' => $this->input->post('banner_description'),
		            	'title_de' => $this->input->post('title_de'),
		            	'description_de' => $this->input->post('banner_description_de'),

		             'file' => 'public/uploads/banner/'.$imageData['file_name'], 'created' => date('Y-m-d') ); 

		            $this->Common_model->insertData($this->table_banner, $insertArray);
		            //print_r($imageData);
		            $this->session->set_flashdata('success', 'Banner Added Successfully.');
		            redirect('admin/banner');
		            //$this->load->view('upload_success', $data); 
		         } 


				

			}
			else
			{
				$result = '';
				$data['content'] = $this->load->view('admin/banner/add',$result, true);
				$this->load->view('template/admin/main',$data);
			}
			
			
			//redirect(admin.'/dashboard/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}


public function edit()
	{

		if($this->session->userdata('logged_in')){

			if($this->input->post('id')){

				//$insertArray = array('');

			

				 $config['upload_path']   = './public/uploads/banner/'; 
		         $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		         /*$config['max_size']      = 100; 
		         $config['max_width']     = 1024; 
		         $config['max_height']    = 768;  */
		         $this->load->library('upload', $config);
					
		         if ( ! $this->upload->do_upload('fileup')) {
		            $error =  $this->upload->display_errors(); 
		            $this->session->set_flashdata('error', $error);

		             $insertArray = array(
		             	'title' => $this->input->post('title'),
		             	'description' => $this->input->post('banner_description'),
		             	'title_de' => $this->input->post('title_de'),
		             	'description_de' => $this->input->post('banner_description_de')
		             ); 

		            $this->Common_model->dataUpdate($this->table_banner,array('id' => $this->input->post('id') ), $insertArray);
		            //print_r($imageData);
		           


		            redirect('admin/banner/');
		            //print_r($error);

		            //$this->load->view('upload_form', $error); 
		         }
					
		         else { 
		            $imageData = $this->upload->data(); 
		            
		            $insertArray = array(
		            	'title' => $this->input->post('title'),
		            	'description' => $this->input->post('banner_description'),
		            	'title_de' => $this->input->post('title_de'),
		             	'description_de' => $this->input->post('banner_description_de'),
		             'file' => 'public/uploads/banner/'.$imageData['file_name'] ); 

		            $this->Common_model->dataUpdate($this->table_banner,array('id' => $this->input->post('id') ), $insertArray);
		            //print_r($imageData);
		            $this->session->set_flashdata('success', 'Banner Updated Successfully.');
		            redirect('admin/banner');
		            //$this->load->view('upload_success', $data); 
		         } 


				

			}
			else
			{
				$id = $this->uri->segment(4);
				$result['categoryDetails'] = $this->Common_model->getSingle($this->table_banner, array('id' => $id));
				$data['content'] = $this->load->view('admin/banner/edit',$result, true);
				$this->load->view('template/admin/main',$data);
			}
			
			
			//redirect(admin.'/dashboard/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}
	

	public function delete($id)
	{

		if($this->session->userdata('logged_in')){

			

			$this->Common_model->delete_data($this->table_banner,array('id' => $id));
			
			$this->session->set_flashdata('success', 'Deleted Successfully.');
            redirect('admin/banner');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
	}



}
