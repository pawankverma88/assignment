<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('API');
	}

	public function index()
	{
		$this->load->view('student/list');
	}

	public function student_ajax_list()
	{
		$search_by = ($this->input->post('search_by'))?$this->input->post('search_by'):'';
		$keyword = ($this->input->post('keyword'))?$this->input->post('keyword'):'';
		$students = $this->api->get_students($search_by, $keyword);
		$output['students'] = $students;
		
		$html = $this->load->view('student/list_ajax', $output, TRUE);
		$data['html'] = $html;
		echo json_encode($data); exit;
	}

	public function insert_student()
	{
		$output = array();

		if ($this->input->post()) {
			$name = trim($this->input->post('name'));
			$mobile_number = trim($this->input->post('mobile_number'));
			$address = trim($this->input->post('address'));

			if ($name && $mobile_number && $address) {
				$data['name'] = $name;
				$data['phone_no'] = $mobile_number;
				$data['address'] = $address;
				$json_data = json_encode($data);
				
				$response = $this->api->add_student($json_data);

				if ($response != '') {
					redirect('student');
				} else {
					$output['error_message'] = 'Technical error. Please try again.';
					$output['name'] = $name;
					$output['mobile_number'] = $mobile_number;
					$output['address'] = $address;
				}
			} else {
				$output['error_message'] = 'Please fill all required fields.';
				$output['name'] = $name;
				$output['mobile_number'] = $mobile_number;
				$output['address'] = $address;
			}
		}
		$this->load->view('student/add', $output);
	}

	public function edit_student($id)
	{
		$output = array();
		if ($this->input->post()) {
			$name = trim($this->input->post('name'));
			$mobile_number = trim($this->input->post('mobile_number'));
			$address = trim($this->input->post('address'));

			if ($name && $mobile_number && $address) {
				$data['id'] = (int)$id;
				$data['name'] = $name;
				$data['phone_no'] = $mobile_number;
				$data['address'] = $address;
				$json_data = json_encode($data);
				$response = $this->api->update_student($json_data);

				if ($response != '') {
					redirect('student');
				} else {
					$output['error_message'] = 'Technical error. Please try again';
					$output['name'] = $name;
					$output['mobile_number'] = $mobile_number;
					$output['address'] = $address;
				}
			} else {
				$output['error_message'] = 'Please fill all required fields.';
				$output['name'] = $name;
				$output['mobile_number'] = $mobile_number;
				$output['address'] = $address;
			}
		} else {

			$student_detail = $this->api->get_student_by_id($id);
			
			if ($student_detail) {
				$output['name'] = $student_detail[0]->name;
				$output['mobile_number'] = $student_detail[0]->phone_no;
				$output['address'] = $student_detail[0]->address;
			} else {
				redirect('student');
			}
		}
		$this->load->view('student/add', $output);
	}	

	public function remove_student($id)
	{
		$data['student_id'] = (int)$id;
		$this->api->delete_student($data);
		redirect('student');
	}
}
