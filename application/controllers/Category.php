<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Categories', 'categoriesModel');
		$this->categories=$this->categoriesModel->list_categories();
	}

	public function index($id, $slug=null)
	{
		$data['categories']=$this->categories;

		$this->load->model('Publications', 'publicationsModel');
		$data['publications']=$this->publicationsModel->publi_category($id);

		//Dados para o cabeçalho
		$data['title']='Categorias';
		$data['subtitle']='';
		$data['subtitleDb']=$this->categoriesModel->list_title($id);

		$this->load->view('frontend/template/html-header', $data);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/category');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}