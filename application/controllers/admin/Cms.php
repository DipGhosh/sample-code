<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

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
		$this->table_question_choice = 'question_choice';
		$this->table_cms = 'cms';
		$this->load->helper('number');

	}

	public function index()
	{

		if($this->session->userdata('logged_in')){

			

			$result['subCategory'] = $this->Common_model->getValueall($this->table_cms);
			$data['content'] = $this->load->view('admin/cms/list',$result, true);
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

			if($this->input->post('title') && $this->input->post('cms_description')){

				$squestionData = array("title" => $this->input->post('title'), 'description' => $this->input->post('cms_description'),"title_de" => $this->input->post('title_de'), 'description_de' => $this->input->post('cms_description_de'), 'created' => date('Y-m-d H:i:s')  );

				$this->Common_model->insertData($this->table_cms,$squestionData);

				redirect(admin.'/cms');
				//print_r($_POST);

			}
			else
			{
				$result['category'] = $this->Common_model->getAllData($this->table_categories, array('status' => 'Y'));
				$data['content'] = $this->load->view('admin/cms/add',$result, true);
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

			if($this->input->post('title')){

				$data = array('title' => $this->input->post('title'),'description' => $this->input->post('cms_description'),'title_de' => $this->input->post('title_de'),'description_de' => $this->input->post('cms_description_de'));
					$this->Common_model->dataUpdate($this->table_cms,array('id' => $this->input->post('cms_id') ),$data);
		         	
		            $this->session->set_flashdata('success', 'Details Added Successfully.');
		            redirect('admin/cms');
			}
			else
			{

				$id = $this->uri->segment(4);
				
				$result['details'] = $this->Common_model->getSingle($this->table_cms, array('id' => $id));

				$data['content'] = $this->load->view('admin/cms/edit',$result, true);
				$this->load->view('template/admin/main',$data);
			}
			
			
			//redirect(admin.'/dashboard/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}


public function convertToReadableSize($size){
  $base = log($size) / log(1024);
  $suffix = array("", "KB", "MB", "GB", "TB");
  $f_base = floor($base);
  return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}


	public function delete($id)
	{

		if($this->session->userdata('logged_in')){

			

			//$this->Common_model->delete_data($this->table_categories,array('cat_id' => $id));
			$this->Common_model->delete_data($this->table_sub_categories,array('sub_cat_id' => $id));
			$this->session->set_flashdata('success', 'Deleted Successfully.');
            redirect('admin/details');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
	}


	public function detail_ajax()
	{
		if($this->session->userdata('logged_in')){


			if($_POST['cat_id'] != ''){


				
				$allStageDrop = $this->Common_model->getAllData($this->table_sub_categories, array('cat_id' => $_POST['cat_id'] ));

				if(!empty($allStageDrop)){
			?>
			
			<select class="form-control" name="sub_cat_id" class="stageAjax" required="required">
                            <option value="">Select Detail</option>
                            <?php if(!empty($allStageDrop)){
                                foreach ($allStageDrop as $allStageDropvalue) {
                                  
                                ?>
                                <option value="<?php echo $allStageDropvalue->sub_cat_id;?>"><?php echo $allStageDropvalue->sub_category_name;?></option>
                                tmsavalue
                            <?php } } ?>
                            
                           
                        </select>
			

			<?php 
		} } }

	}

}
