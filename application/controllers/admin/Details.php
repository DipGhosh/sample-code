<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller {

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
		$this->load->helper('number');
		$this->load->library("pagination");
	}

	public function index()
	{

		if($this->session->userdata('logged_in')){

			  if(isset($_GET['sub_cat_id'])){

			  		$resultCount = $this->Common_model->numrowsDbQuery("SELECT c.category_name,c.category_name_de, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` AND c.cat_id = '".$_GET['sub_cat_id']."'");
			  }
			  else
			  {
			  		$resultCount = $this->Common_model->numrowsDbQuery("SELECT c.category_name,c.category_name_de, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id`");
			  }
			
			
			$config = array();
	        $config["base_url"] = base_url() . "admin/details";
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

	        $result['category'] = $this->Common_model->getValueall($this->table_categories);


	        if(isset($_GET['sub_cat_id'])){

	        	$result['subCategory'] = $this->Common_model->dbQuery("SELECT c.category_name,c.category_name_de, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` AND c.cat_id =  '".$_GET['sub_cat_id']."'order by sc.cat_id limit ".$page.",10");
	        }
	        else
	        {
	        	$result['subCategory'] = $this->Common_model->dbQuery("SELECT c.category_name, c.category_name_de,sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` order by sc.cat_id limit ".$page.",10");
	        }
			
			$data['content'] = $this->load->view('admin/details/list',$result, true);
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
		         $config['allowed_types'] = 'pdf|mpeg|mpg|mov|avi|movie|mp4|doc|docx'; 
		         /*$config['max_size']      = 100; 
		         $config['max_width']     = 1024; 
		         $config['max_height']    = 768;  */
		         $this->load->library('upload', $config);
					$thumbFile = '';
		         if ( ! $this->upload->do_upload('fileup')) {
		            $error =  $this->upload->display_errors(); 
		            $this->session->set_flashdata('error', $error);
		            redirect('admin/details/add');
		            //print_r($error);

		            //$this->load->view('upload_form', $error); 
		         }else{ 
		         	$imageData = $this->upload->data(); 
		         	$fileSize = byte_format(filesize($imageData['full_path'])); // Returns 456 Bytes
		         	$file_type = explode('/',$imageData['file_type']);
		         	if($imageData['is_image'] == 1){
		         		$fileType = "image";
		         	}else{
		         		if($file_type[0] == 'application'){
		         			//$fileType = $file_type[1];
		         			$fileType = str_replace('.','',$imageData['file_ext']);
		         		}else{			         		
		         			if($file_type[0] == 'video'){

		         				$fileType = $file_type[0];
		         			}else{
		         			
		         				$fileType = str_replace('.','',$imageData['file_ext']);
		         			}
		         			

		         			if($file_type[0] == 'video'){

		         				$video = $imageData['file_path'].$imageData['file_name'];

				               	$thumbFile = time().rand(0000,9999).'.jpg';
				               	$thumbnailVideo = $imageData['file_path'].$thumbFile;

								// shell command [highly simplified, please don't run it plain on your script!]
								shell_exec("ffmpeg -i $video -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $thumbnailVideo 2>&1");
		         			}
		         		}
		         		
		         	}

		         	//echo $fileType;


		            
		            
		            $insertArray = array('cat_id' => $this->input->post('cat_id'), 'sub_category_name' => $this->input->post('cat_name'),'sub_category_name_de' => $this->input->post('cat_name_de'), 'sub_category_image' => 'public/uploads/category/'.$imageData['file_name'],'sub_category_thumb' => 'public/uploads/category/'.$thumbFile,'file_type' => $fileType, 'file_ext' => str_replace('.','',$imageData['file_ext']),
		            	'duration' => $this->input->post('duration'), 'file_size' => $fileSize, 
		            	'percentage' => $this->input->post('percentage'), 'no_of_question_exam' => $this->input->post('question_exam') , 'certificate_valid_month' => $this->input->post('certificate_month'), 'certificate_valid_year' => $this->input->post('certificate_year'),
		            	'sub_category_description' => $this->input->post('cat_description'),'sub_category_description_de' => $this->input->post('cat_description_de'),  'created' => date('Y-m-d') ); 


		            $this->Common_model->insertData($this->table_sub_categories, $insertArray);

		            /************** For Notification Section ***********************/
		           // echo FCPATH;

		            $allUsers = $this->Common_model->getData('users', array('notification_course' => 'Y' ),'user_id');

		           // print_r($allUsers);

		            if(!empty($allUsers)){
		            	foreach ($allUsers as $allUsersValue) {
		            		
		            		 $rowsUser = $this->Common_model->numrows('device_token',array('user_id' => $allUsersValue->user_id ));
		            		if($rowsUser > 0){

		            			$deviceDetails = $this->Common_model->getSingle('device_token',array('user_id' => $allUsersValue->user_id ));

		            			if($deviceDetails->device_type == 'ios' ){



		            				/************* IOS Notification **************/

		            				 $deviceToken = $deviceDetails->device_token;
										$passphrase = 'micronix';
										$ctx = stream_context_create([
								            'ssl' => [
								                'verify_peer'      => false,
								                'verify_peer_name' => false
								            ]
								        ]);
										// ck.pem is your certificate file
										stream_context_set_option($ctx, 'ssl', 'local_cert', FCPATH.'public/certificate/newiMbu_ck.pem');
										stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
										// Open a connection to the APNS server
										$fp = stream_socket_client(
											'ssl://gateway.push.apple.com:2195', $err,
											$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
										if (!$fp)
											exit("Failed to connect: $err $errstr" . PHP_EOL);
										// Create the payload body
										$body['aps'] = array(
											'alert' => array(
											    'title' => 'New Course '.$this->input->post('cat_name'). ' is introduced',
								                'body' => $this->input->post('cat_description'),
											 ),
											'sound' => 'default'
										);
										// Encode the payload as JSON
										$payload = json_encode($body);
										// Build the binary notification
										$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
										// Send it to the server
										$result = fwrite($fp, $msg, strlen($msg));
										print_r($result);
										// Close the connection to the server
										fclose($fp);
										//if (!$result)
											//echo 'Message not delivered' . PHP_EOL;
										//else
											//echo 'Message successfully delivered' . PHP_EOL;

									//	die();


		            				/***********   IOS Notification Ends here *****/

		            			}else
		            			{





		                            $fcmMsg = array(
		                                'body' => $this->input->post('cat_description'),
		                                'title' =>  'New Course '.$this->input->post('cat_name'). ' is introduced',
		                                'sound' => "default",
		                                'color' => "#203E78"
		                            );

		                            $fcmFields = array(
		                                'to' => $deviceDetails->device_token,
		                                'priority' => 'high',
		                                'notification' => $fcmMsg
		                            );

		                            $headers = array(
		                                'Authorization: key=' . ANDROID_API_ACCESS_KEY,
		                                'Content-Type: application/json'
		                            );

		                            $ch = curl_init();
		                            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		                            curl_setopt($ch, CURLOPT_POST, true);
		                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
		                            $result = curl_exec($ch);
		                            curl_close($ch);


                        

                        
		            			}


		            		}
		            		

		            	}
		            }

		           
		           //die();
		
		            /*************** Notification Ends Here *************************/
		            //print_r($imageData);
		            $this->session->set_flashdata('success', 'Details Added Successfully.');
		            redirect('admin/details');
		           
		         } 


				

			}
			else
			{
				$result['category'] = $this->Common_model->getAllData($this->table_categories, array('status' => 'Y'));
				$data['content'] = $this->load->view('admin/details/add-category',$result, true);
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

				//if (! extension_loaded (ffmpeg)) exit ('ffmpeg was not loaded ');
				 $config['upload_path']   = './public/uploads/category/'; 
		         $config['allowed_types'] = 'pdf|mpeg|mpg|mov|avi|movie|mp4|doc|docx'; 
		         /*$config['max_size']      = 100; 
		         $config['max_width']     = 1024; 
		         $config['max_height']    = 768;  */

		         $thumbFile = '';

		         $this->load->library('upload', $config);
					
		         if ( ! $this->upload->do_upload('fileup')) {
		            $error =  $this->upload->display_errors(); 
		            $this->session->set_flashdata('error', $error);

		            $data = array('cat_id' => $this->input->post('cat_id'), 'sub_category_name' => $this->input->post('cat_name'),'sub_category_name_de' => $this->input->post('cat_name_de'), 'sub_category_description' => $this->input->post('cat_description'),'sub_category_description_de' => $this->input->post('cat_description_de'), 'percentage' => $this->input->post('percentage'), 'no_of_question_exam' => $this->input->post('question_exam'), 'certificate_valid_month' => $this->input->post('certificate_month'), 'certificate_valid_year' => $this->input->post('certificate_year')  ); 

		         	$this->Common_model->dataUpdate($this->table_sub_categories,array('sub_cat_id' => $this->input->post('sub_cat_id') ),$data);


		            redirect('admin/details/edit/'.$this->input->post('sub_cat_id'));
		            //print_r($error);

		            //$this->load->view('upload_form', $error); 
		         }
					
		         else { 

		         	$imageData = $this->upload->data(); 

		         	 $fileSize = byte_format(filesize($imageData['full_path'])); // Returns 456 Bytes

		         	
		         	/*print_r($imageData); 
		         	die();*/
		         	$file_type = explode('/',$imageData['file_type']);
		         	
		         	if($imageData['is_image'] == 1)
		         	{
		         		$fileType = "image";
		         	}
		         	else
		         	{

		         		if($file_type[0] == 'application'){
		         			//$fileType = $file_type[1];
		         			$fileType = str_replace('.','',$imageData['file_ext']);
		         		}
		         		else
		         		{
		         			if($file_type[0] == 'video'){

		         				$fileType = $file_type[0];
		         			}
		         			else
		         			{
		         				$fileType = str_replace('.','',$imageData['file_ext']);
		         			}

		         			if($file_type[0] == 'video'){

		         				echo $video = $imageData['full_path'];

				               	$thumbFile = time().rand(0000,9999).'.jpg';
				               	echo  $thumbnailVideo = $imageData['file_path'].$thumbFile;

				               //	die();

								// shell command [highly simplified, please don't run it plain on your script!]
								exec("ffmpeg -i $video -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $thumbnailVideo 2>&1");
		         			}
		         			



		         		}



		         		
		         	}


		         	$data = array('cat_id' => $this->input->post('cat_id'), 'sub_category_name' => $this->input->post('cat_name'), 'sub_category_image' => 'public/uploads/category/'.$imageData['file_name'], 'percentage' => $this->input->post('percentage') ,
		         		 'no_of_question_exam' => $this->input->post('question_exam'),
		         		'sub_category_thumb' => 'public/uploads/category/'.$thumbFile,

		            	'file_type' => $fileType,'file_ext' => str_replace('.','',$imageData['file_ext']),
		            	'duration' => $this->input->post('duration'), 'file_size' => $fileSize, 


		            	'sub_category_description' => $this->input->post('cat_description') ); 

		         	
		         	$this->Common_model->dataUpdate($this->table_sub_categories,array('sub_cat_id' => $this->input->post('sub_cat_id') ),$data);
		         	
		            $this->session->set_flashdata('success', 'Details Added Successfully.');

		         	


		            
		            
		            
		            redirect('admin/details');
		           
		         } 


				

			}
			else
			{

				$id = $this->uri->segment(4);
				$result['category'] = $this->Common_model->getAllData($this->table_categories, array('status' => 'Y'));
				$result['details'] = $this->Common_model->getSingle($this->table_sub_categories, array('sub_cat_id' => $id));

				$data['content'] = $this->load->view('admin/details/edit',$result, true);
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


	public function inactive($id)
	{

		if($this->session->userdata('logged_in')){

			
			$this->Common_model->update_data($this->table_sub_categories,array('sub_cat_id' => $id ),array('status' => 'N'));

			redirect(admin.'details/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

	public function active($id)
	{

		if($this->session->userdata('logged_in')){

			
			$this->Common_model->update_data($this->table_sub_categories,array('sub_cat_id' => $id ),array('status' => 'Y'));

			redirect(admin.'details/');
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

}
