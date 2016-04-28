<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travel extends CI_Model {

	public function validate($trip_details)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('destination','Destination','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('date_from','Date From','required');
		$this->form_validation->set_rules('date_to','Date To','required');
		if(!$this->form_validation->run())
		{
			return validation_errors();
		}
		else
		{
			$date_from=new DateTime($trip_details['date_from']);
			$date_to=new DateTime($trip_details['date_to']);
			if($date_from>$date_to)
			{
				return "Trip start date must be before end date";
			}
			elseif($date_from<new DateTime(date('Y-m-d')))
			{
				return "Trip start date must be in the future";
			}
			else
			{
				return "valid";
			}
		}
	}

	public function add_trip($trip_details)
	{
		$query="INSERT INTO destinations(destination,user_id,description,date_from,date_to,created_at,updated_at) VALUES (?,?,?,?,?,NOW(),NOW())";
		$values=array($trip_details['destination'],$trip_details['user_id'],$trip_details['description'],$trip_details['date_from'],$trip_details['date_to']);
		$this->db->query($query,$values);
	}
	public function get_user_trips()
	{
		$query="SELECT destinations.id AS trip_id,destinations.destination,DATE_FORMAT(destinations.date_from,'%M %d %Y') AS date_from,DATE_FORMAT(destinations.date_to,'%M %d %Y') AS date_to,destinations.description FROM destinations LEFT JOIN participants ON destinations.id=participants.destination_id WHERE participants.user_id=? OR destinations.user_id=?";
		$values=array($this->session->userdata('user_id'),$this->session->userdata('user_id'));
		return $this->db->query($query,$values)->result_array();
	}
	public function get_other_trips()
	{
		$query="SELECT destinations.id AS trip_id,destinations.destination,DATE_FORMAT(destinations.date_from,'%M %d %Y') AS date_from,DATE_FORMAT(destinations.date_to,'%M %d %Y') AS date_to,destinations.description,users.name FROM destinations JOIN users ON destinations.user_id=users.id WHERE destinations.id NOT IN (SELECT destinations.id FROM destinations LEFT JOIN participants ON destinations.id=participants.destination_id WHERE participants.user_id=? OR destinations.user_id=?);";
		$values=array($this->session->userdata('user_id'),$this->session->userdata('user_id'));
		return $this->db->query($query,$values)->result_array();
	}
	public function get_trip_info($id)
	{
		$query="SELECT destinations.destination,destinations.user_id,destinations.description,DATE_FORMAT(destinations.date_from,'%M %d %Y') AS date_from,DATE_FORMAT(destinations.date_to,'%M %d %Y') AS date_to,users.name FROM destinations JOIN users ON destinations.user_id=users.id WHERE destinations.id = ?";
		return $this->db->query($query,$id)->row_array();
	}
	public function get_trip_participants($id)
	{
		$query="SELECT users.name FROM users JOIN participants ON users.id=participants.user_id WHERE participants.destination_id=?";
		$values=array($id);
		return $this->db->query($query,$values)->result_array();
	}
	public function add_participant($id)
	{
		$query="INSERT INTO participants(participants.user_id,participants.destination_id) VALUES (?,?)";
		$user_id=$this->session->userdata('user_id');
		$values=array($user_id,$id);
		$this->db->query($query,$values);
	}
}