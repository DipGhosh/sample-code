<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		
	}

	public function index()
	{

		if($this->session->userdata('logged_in')){
			redirect(admin.'/dashboard/');
		}
		if($this->input->post('username')){

			$where = array('user_name' => $this->input->post('username'), 'password' => md5($this->input->post('password')) );
			$rows = $this->Common_model->numrows($this->table_super,$where);

			if($rows > 0){

				$single = $this->Common_model->getSingle($this->table_super,$where);	


				

				
				$insertData = array('user_id' => $single->id,'ip' => $this->input->ip_address(), 'login_date' =>  date("Y-m-d H:i:s") );
					$this->Common_model->insertData($this->table_login_data,$insertData);


				$newdata = array(
				        'username'  => $single->user_name,
				        'id'     => $single->id,
				        'site_lang' => 'english',
				        'logged_in' => TRUE
				);

				$this->session->set_userdata($newdata);
				redirect(admin.'/dashboard/');
			}
			else
			{
				$this->session->set_flashdata('error', 'User name or password is wrong.');
				redirect(admin.'/login');
			}
		}
		else
		{
			$this->load->view('admin/login/login');
		}
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}



}
