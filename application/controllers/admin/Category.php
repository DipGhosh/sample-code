<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
		$this->load->library("pagination");
		$this->load->library('pdfgenerator');
		$this->load->library('email');
	}

	public function index()
	{

		if($this->session->userdata('logged_in')){

			
			$resultCount = $this->Common_model->numrowsDbQuery("Select cat_id from $this->table_categories");

			$config = array();
	        $config["base_url"] = base_url() . "admin/category";
	        $config["total_rows"] = $resultCount;
	        $config["per_page"] = 9;
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

	        $result['category'] = $this->Common_model->getDatawithlimit($this->table_categories, '','cat_id',$page,9);//$this->Common_model->getValueall($this->table_categories);

	        $result["links"] = $this->pagination->create_links();


			$data['content'] = $this->load->view('admin/category/list',$result, true);
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

			if($this->input->post('cat_name')){

				//$insertArray = array('');


				 $config['upload_path']   = './public/uploads/category/'; 
		         $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		         /*$config['max_size']      = 100; 
		         $config['max_width']     = 1024; 
		         $config['max_height']    = 768;  */
		         $this->load->library('upload', $config);
					
		         if ( ! $this->upload->do_upload('fileup')) {
		            /*$error =  $this->upload->display_errors(); 
		            $this->session->set_flashdata('error', $error);
		            redirect('admin/category/add');*/

		         $insertArray = array('category_name' => $this->input->post('cat_name'),
		     'category_description' => $this->input->post('cat_description'),'category_name_de' => $this->input->post('cat_name_de'),'category_description_de' => $this->input->post('cat_description_de'),

		              'created' => date('Y-m-d') ); 

		            $this->Common_model->insertData($this->table_categories, $insertArray);
		            //print_r($imageData);
		            $this->session->set_flashdata('success', 'Category Added Successfully.');
		            redirect('admin/category');


		            //print_r($error);

		            //$this->load->view('upload_form', $error); 
		         }
					
		         else { 
		            $imageData = $this->upload->data(); 
		            
		            $insertArray = array('category_name' => $this->input->post('cat_name'),
		            	'category_description' => $this->input->post('cat_description'),'category_name_de' => $this->input->post('cat_name_de'),'category_description_de' => $this->input->post('cat_description_de'),

		             'category_image' => 'public/uploads/category/'.$imageData['file_name'], 'created' => date('Y-m-d') ); 

		            $this->Common_model->insertData($this->table_categories, $insertArray);
		            //print_r($imageData);
		            $this->session->set_flashdata('success', 'Category Added Successfully.');
		            redirect('admin/category');
		            //$this->load->view('upload_success', $data); 
		         } 


				

			}
			else
			{
				$result = '';
				$data['content'] = $this->load->view('admin/category/add-category',$result, true);
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

			if($this->input->post('cat_name')){

				//$insertArray = array('');

			

				 $config['upload_path']   = './public/uploads/category/'; 
		         $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		         /*$config['max_size']      = 100; 
		         $config['max_width']     = 1024; 
		         $config['max_height']    = 768;  */
		         $this->load->library('upload', $config);
					
		         if ( ! $this->upload->do_upload('fileup')) {
		            $error =  $this->upload->display_errors(); 
		            $this->session->set_flashdata('error', $error);

		             $insertArray = array('category_name' => $this->input->post('cat_name'),
		            	'category_description' => $this->input->post('cat_description'),'category_name_de' => $this->input->post('cat_name_de'),'category_description_de' => $this->input->post('cat_description_de'),
		             ); 

		            $this->Common_model->dataUpdate($this->table_categories,array('cat_id' => $this->input->post('cat_id') ), $insertArray);
		            //print_r($imageData);
		           


		            redirect('admin/category/');
		            //print_r($error);

		            //$this->load->view('upload_form', $error); 
		         }
					
		         else { 
		            $imageData = $this->upload->data(); 
		            
		            $insertArray = array('category_name' => $this->input->post('cat_name'),
		            	'category_description' => $this->input->post('cat_description'),
		            	'category_name_de' => $this->input->post('cat_name_de'),'category_description_de' => $this->input->post('cat_description_de'),

		             'category_image' => 'public/uploads/category/'.$imageData['file_name'] ); 

		            $this->Common_model->dataUpdate($this->table_categories,array('cat_id' => $this->input->post('cat_id') ), $insertArray);
		            //print_r($imageData);
		            $this->session->set_flashdata('success', 'Category Updated Successfully.');
		            redirect('admin/category');
		            //$this->load->view('upload_success', $data); 
		         } 


				

			}
			else
			{

				$id = $this->uri->segment(4);
				$result['categoryDetails'] = $this->Common_model->getSingle($this->table_categories, array('cat_id' => $id));


				$data['content'] = $this->load->view('admin/category/edit-category',$result, true);
				$this->load->view('template/admin/main',$data);
			}
			
			
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

			
			$this->Common_model->update_data($this->table_categories,array('cat_id' => $id ),array('status' => 'N'));

			redirect(admin.'category/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

public function active($id)
	{

		if($this->session->userdata('logged_in')){

			
			$this->Common_model->update_data($this->table_categories,array('cat_id' => $id ),array('status' => 'Y'));

			redirect(admin.'category/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

	public function delete($id)
	{

		if($this->session->userdata('logged_in')){

			

			$this->Common_model->delete_data($this->table_categories,array('cat_id' => $id));
			$this->Common_model->delete_data($this->table_sub_categories,array('cat_id' => $id));
			$this->session->set_flashdata('success', 'Deleted Successfully.');
            redirect('admin/category');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
	}


	public function pdf()
	{	

		$images =  file_get_contents(FCPATH.'public/admin/images/certificate-bg2.jpg');
		$base64 = 'data:image/' .  ';base64,' . base64_encode($images);

		$html1 ='
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">

    <style>
    
</style>
</head>
<body >
<div style="width:1000px; height:1000px; background-size: 100%;  background-image: url('.$base64.'); background-repeat: no-repeat; padding-top: 150px;">
<div style="padding:20px; text-align:center; ">
       <span style="font-size:90px; font-weight:normal;font-family: \'Great Vibes\', cursive; color: #d96113;" >Certificate of Completion</span>
       <br><br>
       <span style="font-size:25px"><i>This certifies that</i></span>
       <br><br><br>
       <span style="font-size:60px;font-family: \'Great Vibes\', cursive; color: #d96113; font-weight: normal;">Leonardo carlos</span><br/><br/><br>
    
    
    
       <span style="font-size:25px"><i>for oustanding achievement From December 21, 2019 to March 19, 2020. Course Credit : 55 Credits</i></span> <br/><br/>
      
       <span style="font-size:20px">Awarded on March 22, 2020<br>
Your hard work, dedication, and achievement will be cherished.</span> <br/><br/><br/><br/>
    
    
    
    <div class="signature">
        <h3 style="font-size:45px;font-family: \'Great Vibes\', cursive; color: #000; font-weight: normal; margin: 0; line-height: 35px;">Signature bbb</h3>
        <h5 style="font-size: 20px; font-weight: normal;">Brandon James <br>
Director<br>
724-277-4749</h5>
    </div>
       
</div>
</div>
    </body>
</html>


    ';

    $stream = '';
    $paper = '';
     $orientation = '';
   $output = $this->pdfgenerator->generate($html1, date('Y-m-d H:i:s').'.pdf', $stream, $paper, $orientation);

    				$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->to('avijit.micronixsystem@gmail.com');
					$this->email->from('info@elearning.i-mbu.com','Elearning');
					$this->email->subject('Forget Password');
					$this->email->attach($output);
					$this->email->message("Your ");
					//$this->email->send();
					$this->email->send(FALSE);

					// Will only print the email headers, excluding the message subject and body
					$this->email->print_debugger(array('headers'));
		//$this->pdfgenerator->generate($html1, date('Y-m-d H:i:s').'.pdf', $stream, $paper, $orientation);
	}


}
