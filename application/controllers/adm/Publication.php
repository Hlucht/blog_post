<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publication extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect(base_url('adm/login'));
		
		$this->load->model('Categories', 'categoriesModel');
		$this->load->model('Publications', 'publicationsModel');
		$this->categories=$this->categoriesModel->list_categories();
	}

	public function index()
	{
		$this->load->library('table');
		$data['categories']=$this->categories;
		$data['publications']= $this->publicationsModel->list_publication();

		//Dados para o cabeçalho
		$data['title']='Dash Board';
		$data['subtitle']='Publicação';

		$this->load->view('backend/template/html-header', $data);
		$this->load->view('backend/template/template');
		$this->load->view('backend/publication');
		$this->load->view('backend/template/html-footer');
	}

	public function insert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-titulo', 'Título', 'required|min_length[3]');
		$this->form_validation->set_rules('txt-subtitulo', 'Subtitulo', 'required|min_length[3]');
		$this->form_validation->set_rules('txt-conteudo', 'Conteúdo', 'required|min_length[20]');

		if($this->form_validation->run() == FALSE) {
			$this->index();
		}else{
			$title=$this->input->post('txt-titulo');
			$subtitle=$this->input->post('txt-subtitulo');
			$content=$this->input->post('txt-conteudo');
			$date=$this->input->post('txt-data');
			$category=$this->input->post('select-categoria');
			$userPubli=$this->input->post('txt-usuario');

			if($this->publicationsModel->add($title, $subtitle, $content, $date, $category, $userPubli)) redirect(base_url('adm/publication'));
			else echo "Houve um erro no sistema";
		}
	}

	public function delete($id)
	{
		if($this->publicationsModel->delete($id)) redirect(base_url('adm/publication'));
		else echo "Houve um erro no sistema";
	}

	public function edit($id)
	{
		$this->load->library('table');
		$data['categories']=$this->categoriesModel->list_category($id);
		$data['publications']=$this->publicationsModel->list_publications($id);

		//Dados para o cabeçalho
		$data['title']='Dash Board';
		$data['subtitle']='Publicação';

		$this->load->view('backend/template/html-header', $data);
		$this->load->view('backend/template/template');
		$this->load->view('backend/edit-publication');
		$this->load->view('backend/template/html-footer');
	}

	public function update()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-titulo', 'Título', 'required|min_length[3]');
		$this->form_validation->set_rules('txt-subtitulo', 'Subtitulo', 'required|min_length[3]');
		$this->form_validation->set_rules('txt-conteudo', 'Conteúdo', 'required|min_length[20]');

		if($this->form_validation->run() == FALSE) {
			$id=$this->input->post('txt-id');
			$this->edit(md5($id));
		}else{
			$title=$this->input->post('txt-titulo');
			$subtitle=$this->input->post('txt-subtitulo');
			$content=$this->input->post('txt-conteudo');
			$date=$this->input->post('txt-data');
			$category=$this->input->post('select-categoria');
			$id=$this->input->post('txt-id');

			if($this->publicationsModel->update($title, $subtitle, $content, $date, $category, $id)) redirect(base_url('adm/publication'));
			else echo "Houve um erro no sistema";
		}
	}

	public function new_img()
	{
		if(!$this->session->userdata('logged')) {
			redirect(base_url('adm/login'));
		}
		
		$id=$this->input->post('id');
		$config['upload_path']='./assets/frontend/images/publication';
		$config['allowed_types']='jpg';
		$config['file_name']=$id .'.jpg';
		$config['overwrite']=TRUE;
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload()) echo $this->upload->display_errors();
		else{
			$settings['source_image']='./assets/frontend/images/publication/' .$id .'.jpg';
			$settings['create_thumb']=FALSE;
			$settings['width']=900;
			$settings['heigth']=300;

			$this->load->library('image_lib', $settings);

			if($this->image_lib->resize()) {
				if($this->publicationsModel->update_img($id)) redirect(base_url('adm/publication/edit/' .$id));
				else echo "Houve um erro no sistema";
			}else {
				echo $this->image_lib->display_errors();
			}
		}
	}
	
}