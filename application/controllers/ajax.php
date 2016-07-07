<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('message_model');
	}

	public function delete_ajax()
	{
		$this->message_model->delete_entry(filter_var($_POST["recordToDelete"], FILTER_SANITIZE_NUMBER_INT));
		return true;
	}

	public function create_ajax()
	{
		$this->load->library('user_agent');
		if ($this->agent->is_browser())
		{
			$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
			$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
		}
		else
		{
			$agent = 'Unidentified User Agent';
		}

		$params = array(
			'ip_address' => $this->input->ip_address(),
			'agent' => $agent,
			'username' => $this->input->post()['username'],
			'email' => $this->input->post()['email'],
			'text' => strip_tags($this->input->post()['message']
			)
		);

		$this->message_model->insert_entry($params);
		//$data = $this->upd_ajax($params['username'], $params['email']);
		$result = $this->message_model->get_entry($params['username'], $params['email']);
		foreach ($result as $res)
		{
			$date = date('d.m.Y', strtotime($res['created_date']));
			echo "<li id=\"med_{$res['id']}\" class=\"media\">
                        <div class=\"media-body\">

                            <div class=\"media-heading\">
                                <div class=\"author\">{$params['username']}</div>
                                <div class=\"metadata\">
                                    <span class=\"date\">{$date}</span>
                                </div>
                            </div>
                            <div class=\"media-text text-justify\">{$params['text']}</div>
                            <hr>
                        </div>
                    </li>";
			/*<div class=\"footer-comment\">
                                <a href=\"#\" id=\"bt-{$res['id']}\" class=\"btn btn-danger btn-xs delbtn\">Удалить</a>
                            </div>*/
			break;
		}
	}

	// public function upd_ajax($user, $eml)
	// {


	// 	$dat = date('d.m.Y', strtotime($result[0]['date']));

	// 	$str = "<li id=\"med_{$result[0]['id']}\" class=\"media\">
 //                        <div class=\"media-body\">
 //                            <div class=\"footer-comment\">
 //                                <a href=\"#\" id=\"bt-{$result[0]['id']}\" class=\"btn btn-danger btn-xs delbtn\">Удалить</a>
 //                            </div>
 //                            <div class=\"media-heading\">
 //                                <div class=\"author\">{$result[0]['username']}</div>
 //                                <div class=\"metadata\">
 //                                    <span class=\"date\">{$dat}</span>
 //                                </div>
 //                            </div>
 //                            <div class=\"media-text text-justify\">{$result[0]['text']}</div>
 //                            <hr>
 //                        </div>
 //                    </li>";
	// 	return $str;
	// }
}
