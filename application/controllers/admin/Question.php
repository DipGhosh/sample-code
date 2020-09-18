<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

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
		$this->load->helper('number');
		$this->load->library("pagination");
		$this->load->library('csvimport');

	}

	public function index()
	{

		if($this->session->userdata('logged_in')){

			
			$resultCount = $this->Common_model->numrowsDbQuery("SELECT sc.sub_category_name, q.* FROM `question_data` q, sub_categories sc WHERE sc.`sub_cat_id` = q.`sub_cat_id`");

			$config = array();
	        $config["base_url"] = base_url() . "admin/question";
	        $config["total_rows"] = $resultCount;
	        $config["per_page"] = 10;
	        if(isset($_GET['sub_cat_id'])){
	        	 $config['reuse_query_string'] = TRUE;
	   		}
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

	        $result['subCategory'] = $this->Common_model->getValueall($this->table_sub_categories);

	        if(isset($_GET['sub_cat_id'])){


	        	$result['question'] = $this->Common_model->dbQuery("SELECT sc.sub_category_name,sc.sub_category_name_de, q.* FROM `question_data` q, sub_categories sc WHERE sc.`sub_cat_id` = q.`sub_cat_id` AND q.sub_cat_id = '".$_GET['sub_cat_id']."' limit ".$page.",10");
	        }
	        else
	        {
	        		$result['question'] = $this->Common_model->dbQuery("SELECT sc.sub_category_name,sc.sub_category_name_de, q.* FROM `question_data` q, sub_categories sc WHERE sc.`sub_cat_id` = q.`sub_cat_id` limit ".$page.",10");
	        }

			
			$data['content'] = $this->load->view('admin/question/list',$result, true);
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

			if($this->input->post('cat_id') && $this->input->post('sub_cat_id')){

				$squestionData = array("cat_id" => $this->input->post('cat_id'),
				 'sub_cat_id' => $this->input->post('sub_cat_id'), 'question' => $this->input->post('question'), 'question_de' => $this->input->post('question_de'),'created' => date('Y-m-d H:i:s')  );

				$this->Common_model->insertData($this->table_question_data,$squestionData);

				$questionid = $this->db->insert_id();
				$choiceDe = $this->input->post('choice_de');
				if($this->input->post('choice')){

					$i = 0;
					foreach ($this->input->post('choice')  as $choice ) {
							
						if($this->input->post('correct'.$i)){

							$this->Common_model->insertData($this->table_question_choice,array('question_id' => $questionid, 'choice' => $choice, 'choice_de' => $choiceDe[$i],
							 'correct' => $this->input->post('correct'.$i), 'created' => date('Y-m-d H:i:s')  ));
						}
						else
						{
							$this->Common_model->insertData($this->table_question_choice,array('question_id' => $questionid, 'choice' => $choice,  'choice_de' => $choiceDe[$i],
							 'created' => date('Y-m-d H:i:s')  ));
						}
						

						$i++;

					}
				}


				redirect(admin.'/question');
				//print_r($_POST);

			}
			else
			{
				$result['category'] = $this->Common_model->getAllData($this->table_categories, array('status' => 'Y'));
				$data['content'] = $this->load->view('admin/question/add',$result, true);
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

			if($this->input->post('question_id')){

				$qData = array("cat_id" => $this->input->post('cat_id'), 'sub_cat_id' => $this->input->post('sub_cat_id'), 'question' => $this->input->post('question'),'question_de' => $this->input->post('question_de'));
				$this->Common_model->dataUpdate($this->table_question_data,array('question_id' => $this->input->post('question_id') ),$qData);

				$i = 0;
				$choice = $this->input->post('choice');
				$choiceDe = $this->input->post('choice_de');
				foreach ($this->input->post('choice_id') as $choiceValue) {
					
					if($this->input->post('correct'.$i)){
						$this->Common_model->dataUpdate($this->table_question_choice,array('choice_id' => $choiceValue ),array('choice' => $choice[$i],'choice_de' => $choiceDe[$i], 'correct' => $this->input->post('correct'.$i) ));
					}	
					else
					{
						$this->Common_model->dataUpdate($this->table_question_choice,array('choice_id' => $choiceValue ),array('choice' => $choice[$i],'choice_de' => $choiceDe[$i],
							 'correct' => 'N' ));
					}
					
					$i++;
				}
				redirect(admin.'/question');
				//print_r($_POST);
			}
			else
			{

				$id = $this->uri->segment(4);
				$result['category'] = $this->Common_model->getAllData($this->table_categories, array('status' => 'Y'));


				$result['choice'] = $this->Common_model->getAllData($this->table_question_choice, array('question_id' => $id));
				$result['question'] = $this->Common_model->getSingle($this->table_question_data, array('question_id' => $id));

				$result['subCategory'] = $this->Common_model->getAllData($this->table_sub_categories, array('cat_id' => $result['question']->cat_id));


				$data['content'] = $this->load->view('admin/question/edit',$result, true);
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

			

			
			$this->Common_model->delete_data($this->table_question_data,array('question_id' => $id));
			$this->Common_model->delete_data($this->table_question_choice,array('question_id' => $id));
			$this->session->set_flashdata('success', 'Deleted Successfully.');
            redirect('admin/question');
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


	public function import_data()
	{
		if($this->session->userdata('logged_in')){

			if(isset($_FILES["csv_file"])){

				
				$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);

				
				if(!empty($file_data)){
					$i = 0;
					foreach ($file_data as  $value) {

						/*$this->table_sub_categories = 'sub_categories';
		$this->table_question_data = 'question_data';
		$this->table_question_choice = 'question_choice';*/

						$singleCategory = $this->Common_model->getSingle($this->table_categories,array('category_name' => $value['Category'] ));

						$where_clause = array('sub_category_name' => $value['Course'] );	
						$singleSub = $this->Common_model->getSingle($this->table_sub_categories,$where_clause);
						//print_r($singleSub);

						$squestionData = array("cat_id" => $singleCategory->cat_id, 'sub_cat_id' => $singleSub->sub_cat_id, 'question' => $value['Question'], 'created' => date('Y-m-d H:i:s')  );

						$this->Common_model->insertData($this->table_question_data,$squestionData);

						$questionid = $this->db->insert_id();


						$option1 = explode('|', $value['Option_1']);
						$option2 = explode('|', $value['Option_2']);
						$option3 = explode('|', $value['Option_3']);
						$option4 = explode('|', $value['Option_4']);

						if(!empty($option1)){

							if($option1[1] == 'Yes'){
								$answer1 = 'Y';
							}
							else
							{
								$answer1 = 'N';
							}
							$this->Common_model->insertData($this->table_question_choice,array('question_id' => $questionid, 'choice' => $option1[0], 'correct' => $answer1, 'created' => date('Y-m-d H:i:s')  ));

						}
						

						if(!empty($option2)){

							if($option2[1] == 'Yes'){
								$answer2 = 'Y';
							}
							else
							{
								$answer2 = 'N';
							}
							$this->Common_model->insertData($this->table_question_choice,array('question_id' => $questionid, 'choice' => $option2[0], 'correct' => $answer2, 'created' => date('Y-m-d H:i:s')  ));

						}

						if(!empty($option3)){

							if($option3[1] == 'Yes'){
								$answer3 = 'Y';
							}
							else
							{
								$answer3 = 'N';
							}
							$this->Common_model->insertData($this->table_question_choice,array('question_id' => $questionid, 'choice' => $option3[0], 'correct' => $answer3, 'created' => date('Y-m-d H:i:s')  ));

						}


						if(!empty($option4)){

							if($option4[1] == 'Yes'){
								$answer4 = 'Y';
							}
							else
							{
								$answer4 = 'N';
							}
							$this->Common_model->insertData($this->table_question_choice,array('question_id' => $questionid, 'choice' => $option4[0], 'correct' => $answer4, 'created' => date('Y-m-d H:i:s')  ));

						}



						//print_r($best);


					}


					$this->session->set_flashdata('success', 'Question CSV data is uploaded.');
	            	redirect('admin/question/import-data');


				}
				else
				{
						$this->session->set_flashdata('error', 'In CSV data is not available.');
	            		redirect('admin/question/import-data');
				}


			}
			else
			{	
				$result = array();
				$data['content'] = $this->load->view('admin/question/import',$result, true);
				$this->load->view('template/admin/main',$data);
			}

		}
		else
		{
			$this->load->view('admin/login/login');
		}
	}

}
