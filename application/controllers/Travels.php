<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travels extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Travel');
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$this->user_trips();
		}
		else
		{
			redirect('/');
			die();
		}
	}
	public function add()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$this->load->view('add_trip');
		}
		else
		{
			redirect('/');
			die();
		}
	}
	public function new_plan()
	{
		$trip_details=$this->input->post();
		$result=$this->Travel->validate($trip_details);
		if($result=="valid")
		{
			$this->Travel->add_trip($trip_details);
			redirect('/travels');
			exit();
		}
		else
		{
			$this->session->set_flashdata('errors',$result);
			redirect('/travels/add');
			die();
		}
	}
	public function user_trips()
	{
		$results=$this->Travel->get_user_trips();
		$other_results=$this->Travel->get_other_trips();
		$this->load->view('home',array("plans"=>$results,"other_plans"=>$other_results));
	}
	public function destination($id)
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$results=$this->Travel->get_trip_info($id);
			$other_results=$this->Travel->get_trip_participants($id);
			$this->load->view('view_trip',array('trip'=>$results,'others'=>$other_results));
		}
		else
		{
			redirect('/');
			die();
		}
	}
	public function join($id)
	{
		$this->Travel->add_participant($id);
		redirect('/Travels/user_trips');
	}
}