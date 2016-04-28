<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function validate($user_details)
	{
		$this->form_validation->set_rules('name','Name','required|min_length[3]');
		$this->form_validation->set_rules('username','Username','required|is_unique[users.username]|min_length[3]');
		$this->form_validation->set_rules('password','Password','required|min_length[6]|matches[confirm_pw]|trim');
		$this->form_validation->set_rules('confirm_pw','Confirm Password','trim');
		if($this->form_validation->run())
		{
			return "valid";
		}
		else
		{
			return validation_errors();
		}
	}

	public function create_user($user_details)
	{
		$query="INSERT INTO users(name,username,password,created_at,updated_at) VALUES (?,?,?,NOW(),NOW())";
		$values=array($user_details['name'],$user_details['username'],password_hash($user_details['password'],PASSWORD_DEFAULT));
		$this->db->query($query,$values);
	}
	public function validate_login($user_details)
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password1','Password','trim|required');
		if(!$this->form_validation->run())
		{
			return validation_errors();
		}
		
		else 
		{
			$this->form_validation->set_rules('username','Username','is_unique[users.username]');
			if($this->form_validation->run())
			{
				return "Email or Password is incorrect";
			}
			else
			{
				$username=$user_details['username'];
				$query="SELECT users.password FROM users WHERE username = ?";
				$result=$this->db->query($query,$username)->row_array();
				if(password_verify($user_details['password1'],$result['password']))
				{
					return "valid";
				}
				else 
				{
					return "Email or Password is incorrect";
				}
			}
		}
	}
	public function login($username)
	{
		$query="SELECT users.id,users.username FROM users WHERE username = ?";
		return $this->db->query($query,$username)->row_array();
	}
}