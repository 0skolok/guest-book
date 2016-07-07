<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class guestPage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('message_model');
		$this->load->library(array('pagination', 'session'));
	}

	public function index()
	{
		if ($this->input->method() == 'post'){
			$this->generate('index', 'echo');
		}
		else {
			$data = $this->generate('index');
			$data['count'] = $this->message_model->entry_count_all();
			$this->load->view('header_page');
			$this->load->view('navbar_page');
			$this->load->view('index_page', $data);
		}

		$this->load->view('footer_page');
	}

	public function changeBook()
	{
		$data['result'] = $this->message_model->get_entries();
		$data['count'] = $this->message_model->entry_count_all();
		$this->load->view('header_page');
		$this->load->view('navbar_page');
		$this->load->view('index_page_redact', $data);
		$this->load->view('footer_page');
	}

	private function generate($init, $method_return='return')
	{
		$pagination_config = array(
			'base_url' => base_url().'guestpage/'.$init.'/',
			'total_rows' => $this->message_model->entry_count_all(),
			'per_page' => 3,
			'uri_segment' => 3,
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_link' => 'First',
			'first_tag_open' => '<li class="ajax">',
			'first_tag_close' => '</li>',
			'last_tag_open' => '<li class="ajax">',
			'last_tag_close' => '</li>',
			'next_tag_open' => '<li class="ajax">',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li class="ajax">',
			'prev_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>',
			'num_tag_open' => '<li class="ajax">',
			'num_tag_close' => '</li>',
			'anchor_class' => 'class="btn"'
		);
		$this->pagination->initialize($pagination_config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data = array();
		($this->session->flashdata('success_insert')) ? $data['success'] = $this->session->flashdata('success_insert') : $data;
		$data['result'] = $this->message_model->fetch_entries($pagination_config['per_page'], $page);
		$data['links'] = $this->pagination->create_links();

		if ($method_return == 'return') {
			return $data;
		}
	}
}
