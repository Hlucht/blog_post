<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect(base_url('adm/login'));
		
		$this->load->model('Categories', 'categoriesModel');
		$this->categories=$this->categoriesModel->list_categories();
	}

	public function index()
	{
		$this->load->library('table');
		$data['categories']=$this->categories;

		//Dados para o cabeçalho
		$data['title']='Dash Board';
		$data['subtitle']='Categoria';

		$this->load->view('backend/template/html-header', $data);
		$this->load->view('backend/template/template');
		$this->load->view('backend/category');
		$this->load->view('backend/template/html-footer');
	}

	public function insert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-categoria', 'Nome da Categoria', 'required|min_length[3]|is_unique[categorias.titulo]');

		if($this->form_validation->run() == FALSE) {
			$this->index();
		}else{
			$heading=$this->input->post('txt-categoria');

			if($this->categoriesModel->add($heading)) redirect(base_url('adm/category'));
			else echo "Houve um erro no sistema";
		}
	}

	public function delete($id)
	{
		if($this->categoriesModel->delete($id)) redirect(base_url('adm/category'));
			else echo "Houve um erro no sistema";
	}

	public function edit($id)
	{
		$this->load->library('table');
		$data['categories']=$this->categoriesModel->list_category($id);

		//Dados para o cabeçalho
		$data['title']='Dash Board';
		$data['subtitle']='Categoria';

		$this->load->view('backend/template/html-header', $data);
		$this->load->view('backend/template/template');
		$this->load->view('backend/edit-category');
		$this->load->view('backend/template/html-footer');
	}

	public function update()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-categoria', 'Nome da Categoria', 'required|min_length[3]|is_unique[categorias.titulo]');

		if($this->form_validation->run() == FALSE) {
			$this->index();
		}else{
			$heading=$this->input->post('txt-categoria');
			$id=$this->input->post('txt-id');
			if($this->categoriesModel->update($heading, $id)) redirect(base_url('adm/category'));
			else echo "Houve um erro no sistema";
		}
	}
	
}