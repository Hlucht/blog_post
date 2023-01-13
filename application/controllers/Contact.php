<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Categories', 'categoriesModel');
		$this->categories=$this->categoriesModel->list_categories();
	}
	
	public function index($enviado=null)
	{
		$data['categories']=$this->categories;

		$this->load->model('Publications', 'publicationsModel');

		//Dados para o cabeçalho
		$data['title']='Contato';
		$data['subtitle']='Fale conosco';
		$data['enviado']=$enviado;

		$this->load->view('frontend/template/html-header', $data);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/contact');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function enviar_mensagem()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtNome', 'Nome', 'required');
		$this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('txtmsg', 'Mensagem', 'required');

		if($this->form_validation->run()){
			$nome = $this->input->post('txtNome');
			$email = $this->input->post('txtEmail');
			$msg = $this->input->post('txtMsg');
			$ip = $this->input->ip_address();

			$this->load->library('email');

			$this->email->from($email, $nome);
			$this->email->to('luchtembergh@gmail.com');
			$this->email->subject('Formulário de contato - Blog');
			$this->email->message(
				"
				<p><strong>Nome: </strong> $nome</p>
				<p><strong>Email: </strong> $email</p>
				<p><strong>Mensagem: </strong> $msg</p>
				<p><strong>IP Usuário: </strong> $ip</p>
				
				"
			);

			if($this->email->send()){
				redirect(base_url('contact/1'));
			}else{
				redirect(base_url('contact/2'));
			}

		}else{
			$this->index();
		}
	}
	
}