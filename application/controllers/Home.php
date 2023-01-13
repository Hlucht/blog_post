<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Categories', 'categoriesModel');
		$this->categories=$this->categoriesModel->list_categories();
	}

	public function index()
	{
		$data['categories']=$this->categories;

		$this->load->model('publications', 'publicationsModel');
		$data['publications']=$this->publicationsModel->contrast_home();

		//Dados para o cabeçalho
		$data['title']='Página inicial';
		$data['subtitle']='Postagens recentes';

		$this->load->view('frontend/template/html-header', $data);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/home');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}