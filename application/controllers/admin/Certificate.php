<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {

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
		$this->table_users = 'users';
		$this->table_sub_categories = 'sub_categories';
		$this->table_ratings = 'ratings';
		$this->table_exam_data = 'exam_data';
		$this->load->helper('number');
		$this->load->library("pagination");
		$this->load->library('pdfgenerator');
	}

	public function index()
	{

		if($this->session->userdata('logged_in')){

			
			
			$resultCount = $this->Common_model->numrowsDbQuery("SELECT c.category_name, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id`");

			$config = array();
	        $config["base_url"] = base_url() . "admin/certificate";
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
	        echo $page;
	        $result['page'] = $page;

	        $result["links"] = $this->pagination->create_links();

	        $result['users'] = $this->Common_model->getValueall($this->table_users);


	      

	        $result['subCategory'] = $this->Common_model->dbQuery("SELECT c.category_name, sc.* FROM `sub_categories` sc, categories c WHERE sc.`cat_id` = c.`cat_id` order by sc.cat_id limit ".$page.",10");
			
			$data['content'] = $this->load->view('admin/certificate/list',$result, true);
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

			



				$result['subCategory'] = $this->Common_model->getValueall($this->table_sub_categories);
				$result['userDetails'] = $this->Common_model->getSingle($this->table_users, array('user_id' => $this->uri->segment(4) ));
				$data['content'] = $this->load->view('admin/certificate/certificate-details',$result, true);
				$this->load->view('template/admin/main',$data);
			
			
			
			
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}


	public function show_certificate()
	{

		if($this->session->userdata('logged_in')){

		$userData = $this->Common_model->getSingle($this->table_users,array('user_id' => $this->uri->segment(4) ));
		$examData = $this->Common_model->getSingle($this->table_exam_data,array('exam_id' => $this->uri->segment(5) ));

		$subCategory = $this->Common_model->getSingle($this->table_sub_categories,array('sub_cat_id' => $this->uri->segment(6) ));	

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
       <span style="font-size:25px"><i>Certificate of Completion
Is granted to  </i></span>
       <br><br><br>
       <span style="font-size:60px;font-family: \'Great Vibes\', cursive; color: #d96113; font-weight: normal;">'.$userData->user_name.'</span><br/><br/><br>
    
    
    
       <span style="font-size:25px"><i>For completing the this '.$subCategory->sub_category_name.' on '.$examData->exam_date.' and Certificate is valid upto '.$examData->valid_to.' </i></span> <br/><br/>


      
       <span style="font-size:20px">Your Hard Work, Dedication, & Achievement Will Be Cherished Forever.</span> <br/><br/><br/><br/>
    
    
    
   
       
</div>
</div>
    </body>
</html>


    ';

    $stream = '';
    $paper = '';
     $orientation = '';
   $output = $this->pdfgenerator->generateOutput($html1, date('Y-m-d H:i:s').'.pdf', $stream, $paper, $orientation);



				/*$result['subCategory'] = $this->Common_model->getValueall($this->table_sub_categories);



				$result['rating'] = $this->Common_model->getAllData($this->table_ratings, array('sub_cat_id' => $this->uri->segment(4)));
				$data['rating'] = $result['rating'];
				//print_r($result['category']);
				$data['content'] = $this->load->view('admin/certificate/certificate-details',$result, true);
				$this->load->view('template/admin/main',$data);*/
			
			
			
			
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}



	public function notification()
	{
		 $allUsers = $this->Common_model->getData('users', array('notification_certificate' => 'Y' ),'user_id');

		           // print_r($allUsers);

		            if(!empty($allUsers)){
		            	foreach ($allUsers as $allUsersValue) {
		            		
		            		 $rowsUser = $this->Common_model->numrows('device_token',array('user_id' => $allUsersValue->user_id ));
		            		if($rowsUser > 0){

		            			$deviceDetails = $this->Common_model->getSingle('device_token',array('user_id' => $allUsersValue->user_id ));

		            			$expireCertificate = "Select * from exam_data where user_id = '".$allUsersValue->user_id."' AND notification_sent = 'N' AND valid_to < '".date('Y-m-d')."'";
		            			//echo "<br>";

		            			$expireResult = $this->Common_model->dbQuery($expireCertificate);

		            			//print_r($expireResult);
		            			if(!empty($expireResult)){
		            				foreach ($expireResult as $expireResultValue) {
		            					
		            					$subCatName = $this->Common_model->getValue($this->table_sub_categories, 'sub_category_name', array('sub_cat_id' =>$expireResultValue->sub_cat_id ));
		            					$this->Common_model->dataUpdate('exam_data',array('exam_id' => $expireResultValue->exam_id),array('notification_sent' => 'Y' ));

		            				if($deviceDetails->device_type == 'ios' ){



		            				

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
											    'title' => 'Your Certificate  expired',
								                'body' => 'Your Certificate  '.$subCatName.'  expired on '.$expireResultValue->valid_to,
											 ),
											'sound' => 'default'
										);
										// Encode the payload as JSON
										$payload = json_encode($body);
										// Build the binary notification
										$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
										// Send it to the server
										$result = fwrite($fp, $msg, strlen($msg));
										//print_r($result);
										// Close the connection to the server
										fclose($fp);
										//if (!$result)
											//echo 'Message not delivered' . PHP_EOL;
										//else
											//echo 'Message successfully delivered' . PHP_EOL;

									//	die();


		            				

		            			}else
		            			{





		                            $fcmMsg = array(
		                                'body' => 'Your Certificate  expired',
		                                'title' =>  'Your Certificate  '.$subCatName.'  expired on '.$expireResultValue->valid_to,
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



		            			/**/


		            		}
		            		

		            	}
		            }




	}



}
