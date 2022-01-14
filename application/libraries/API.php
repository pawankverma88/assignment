<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class API
{
	protected $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	function get_response($service_url, $input_params = array())
	{
		$curl        = curl_init($service_url);
		if (!empty($input_params)) {
			$curl_post_data = $input_params;
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

		$curl_response = curl_exec($curl);

		if ($errno = curl_errno($curl)) {
			$error_message = curl_strerror($errno);
			curl_close($curl);
			return array(
				'api_status' => 'error',
				'api_response' => $error_message
			);
		} else {
			$curl_api_decoded = json_decode($curl_response);
			if (isset($curl_api_decoded->statusCode) && $curl_api_decoded->statusCode == 200) {
				curl_close($curl);
				return array(
					'api_status' => 'success',
					'api_response' => $curl_api_decoded
				);
			} elseif (isset($curl_api_decoded->statusCode) && $curl_api_decoded->statusCode == 404) {
				curl_close($curl);
				return array(
					'api_status' => 'error',
					'api_response' => $curl_api_decoded
				);
			} else {
				curl_close($curl);
				return array(
					'api_status' => 'error',
					'api_response' => $curl_api_decoded
				);
			}
		}
	}

	function get_students($search_type = null, $search_value = null)
	{

		if ($search_type && $search_value) {
			$api_url      = API_PREFIX . "student-list/all?search_type=".$search_type."&search_value=".$search_value;
		} else {
			$api_url      = API_PREFIX . "student-list/all";
		}
		$api_response = $this->get_response($api_url, array());
		$api_content = '';
		if ($api_response['api_status'] == "success") {
			if (isset($api_response['api_response']->content)) {
				$api_content = $api_response['api_response']->content;
			}
		}
		return $api_content;
	}

	function get_student_by_id($student_id)
	{
		$api_url      = API_PREFIX . "student-list/".$student_id;
		$api_response = $this->get_response($api_url, array());
		$api_content = '';
		
		if ($api_response['api_status'] == "success") {
			if (isset($api_response['api_response']->content)) {
				$api_content = $api_response['api_response']->content;
			}
		}
		return $api_content;
	}

	function add_student($post_data)
	{
		$api_url      = API_PREFIX . "add-student";
		$api_response = $this->get_response($api_url, $post_data);
		$api_content = '';
		if ($api_response['api_status'] == "success") {
			if (isset($api_response['api_response']->message)) {
				$api_content = $api_response['api_response']->message;
			}
		}
		return $api_content;
	}

	function update_student($post_data)
	{
		$api_url      = API_PREFIX . "update-student";
		$api_response = $this->get_response($api_url, $post_data);
		$api_content = '';
		
		if ($api_response['api_status'] == "success") {
			if (isset($api_response['api_response']->message)) {
				$api_content = $api_response['api_response']->message;
			}
		}
		return $api_content;
	}

	function delete_student($post_data)
	{
		$api_url      = API_PREFIX . "remove-student";
		$api_response = $this->get_response($api_url, $post_data);
		$api_content = '';
		
		if ($api_response['api_status'] == "success") {
			if (isset($api_response['api_response']->message)) {
				$api_content = $api_response['api_response']->message;
			}
		}
		return $api_content;
	}
}
?>
