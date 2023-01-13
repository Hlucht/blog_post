<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect(base_url('adm/login'));
	}

	public function index()
	{
		//Dados para o cabeçalho
		$data['title']='Dash Board';
		$data['subtitle']='Home';

		$this->load->view('backend/template/html-header', $data);
		$this->load->view('backend/template/template');
		$this->load->view('backend/home');
		$this->load->view('backend/template/html-footer');
	}

}