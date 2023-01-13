<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publication extends CI_Controller {

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
		$data['publications']=$this->publicationsModel->publication($id);

		//Dados para o cabeçalho
		$data['title']='Publicação';
		$data['subtitle']='';
		$data['subtitleDb']=$this->publicationsModel->list_title($id);

		$this->load->view('frontend/template/html-header', $data);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/publication');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function search()
    {
	   $this->load->model('Publications', 'publicationsModel');

       $data['categories']=$this->categories;
       $inquiry= $this->input->post('search');
	   
	   $data['publications']=$this->publicationsModel->search($inquiry);

       $data['title']='Home';
	   $data['subtitle']='Buscas';

	   $this->load->view('frontend/template/html-header', $data);
       $this->load->view('frontend/template/header');
       $this->load->view('frontend/home');
       $this->load->view('frontend/template/aside'); 
       $this->load->view('frontend/template/footer');
	   $this->load->view('frontend/template/html-footer');

       if($this->publicationsModel->search($inquiry));
       else echo "Publicação não encontrada";
    }
}