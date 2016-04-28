<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
	}
	public function index()
	{
		redirect('/main');
	}
	public function main()
	{
		$this->load->view('login');
	}
	public function create()
	{
		$user_details=$this->input->post();
		$result=$this->User->validate($user_details);
		if($result=="valid")
		{
			$this->User->create_user($user_details);
			$success="<h2>Registration Successful - Please Login to continue!</h2>";
			$this->session->set_flashdata('success',$success);
			redirect('/main');
			exit();
		}
		else
		{
			$this->session->set_flashdata('errors',$result);
			redirect('/main');
			die();
		}
	}
	public function authenticate()
	{
		$user_details=$this->input->post();
		$result=$this->User->validate_login($user_details);
		if($result=="valid")
		{
			$results=$this->User->login($user_details['username']);
			$this->session->set_userdata('logged_in',TRUE);
			$this->session->set_userdata('username',$results['username']);
			$this->session->set_userdata('user_id',$results['id']);
			redirect('/travels');
			exit();
		}
		else
		{
			$this->session->set_flashdata('errors',$result);
			redirect('/main');
			die();
		}
	}
	public function logout()
	{
		$this->session->set_userdata('logged_in',FALSE);
		$this->session->sess_destroy();
		redirect('/');
		die();
	}
}