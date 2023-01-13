<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Categories', 'categoriesModel');
		$this->categories=$this->categoriesModel->list_categories();

		$this->load->model('Users', 'usersModel');
	}

	public function index()
	{
		$data['categories']=$this->categories;

		$data['users']=$this->usersModel->list_users();

		//Dados para o cabeçalho
		$data['title']='Sobre nós';
		$data['subtitle']='Conheça nosso propósito';

		$this->load->view('frontend/template/html-header', $data);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/about_us');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	
	public function users($id, $slug=null)
	{
		$data['categories']=$this->categories;

		$data['users']=$this->usersModel->list_user($id);

		//Dados para o cabeçalho
		$data['title']='Autores';
		$data['subtitle']='Usuários';

		$this->load->view('frontend/template/html-header', $data);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/user');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}