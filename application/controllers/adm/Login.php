<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(!$this->session->userdata('logged')) {
			redirect(base_url('adm/login'));
		}
		
		$this->load->library('table');

		$this->load->model('Users', 'usersModel');
		$data['users']=$this->usersModel->list_users();

		//Dados para o cabeçalho
		$data['title']='Dash Board';
		$data['subtitle']='Usuários';

		$this->load->view('backend/template/html-header', $data);
		$this->load->view('backend/template/template');
		$this->load->view('backend/user');
		$this->load->view('backend/template/html-footer');
	}

	public function insert()
	{
		if(!$this->session->userdata('logged')) {
			redirect(base_url('adm/login'));
		}

		$this->load->model('Users', 'usersModel');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-nome', 'Nome do usuário', 'required|min_length[3]');
		$this->form_validation->set_rules('txt-email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('txt-historico', 'Histórico', 'required|min_length[20]');
		$this->form_validation->set_rules('txt-user', 'User', 'required|min_length[3]|is_unique[usuarios.user]');
		$this->form_validation->set_rules('txt-senha', 'Senha', 'required|min_length[3]');
		$this->form_validation->set_rules('txt-confirmar-senha', 'Confirmar senha', 'required|matches[txt-senha]');

		if($this->form_validation->run() == FALSE) {
			$this->index();
		}else{
			$nome=$this->input->post('txt-nome');
			$email=$this->input->post('txt-email');
			$historico=$this->input->post('txt-historico');
			$user=$this->input->post('txt-user');
			$senha=$this->input->post('txt-senha');

			if($this->usersModel->add($name, $email, $historico, $user, $senha)) redirect(base_url('adm/login/index'));
			else echo "Houve um erro no sistema";
		}
	}

	public function delete($id)
	{
		if(!$this->session->userdata('logged')) {
			redirect(base_url('adm/login'));
		}

		$this->load->model('Users', 'usersModel');

		if($this->usersModel->delete($id)) redirect(base_url('adm/login/index'));
			else echo "Houve um erro no sistema";
	}

	public function edit($id)
	{
		if(!$this->session->userdata('logged')) {
			redirect(base_url('adm/login'));
		}

		$this->load->model('Users', 'usersModel');
		
		$data['users']=$this->usersModel->emit_user($id);

		//Dados para o cabeçalho
		$data['title']='Dash Board';
		$data['subtitle']='Usuário';

		$this->load->view('backend/template/html-header', $data);
		$this->load->view('backend/template/template');
		$this->load->view('backend/edit-user');
		$this->load->view('backend/template/html-footer');
	}

	public function update($userCom)
	{
		if(!$this->session->userdata('logged')) {
			redirect(base_url('adm/login'));
		}

		$this->load->model('Users', 'usersModel'); 

		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-nome', 'Nome do usuário', 'required|min_length[3]');
		$this->form_validation->set_rules('txt-email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('txt-historico', 'Histórico', 'required|min_length[20]');

		$user= $this->input->post('txt-user');

		if($userCom != $user){
			$this->form_validation->set_rules('txt-user','User', 'required|min_length[3]|is_unique[usuario.user]');
		}

		$this->form_validation->set_rules('txt-senha', 'Senha', 'required|min_length[3]');
		$this->form_validation->set_rules('txt-confirmar-senha', 'Confirmar senha', 'required|matches[txt-senha]');
		
		if($this->form_validation->run() == FALSE) {
			$id=$this->input->post('txt-id');
			$this->edit(md5($id));
		}else{
			$nome=$this->input->post('txt-nome');
			$email=$this->input->post('txt-email');
			$historico=$this->input->post('txt-historico');
			$user=$this->input->post('txt-user');
			$senha=$this->input->post('txt-senha');
			$id=$this->input->post('txt-id');

			if($this->usersModel->update($nome, $email, $historico, $user, $senha, $id)) redirect(base_url('adm/login/index'));
			else echo "Houve um erro no sistema";
		}
	}

	public function pag_login()
	{
		$data['title']='Dash Board';
		$data['subtitle']='Entrar no Sistema';

		$this->load->view('backend/template/html-header', $data);
		$this->load->view('backend/login');
		$this->load->view('backend/template/html-footer');
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-user', 'Usuario', 'required|min_length[3]');

		$this->form_validation->set_rules('txt-senha', 'Senha', 'required|min_length[3]');

		if($this->form_validation->run() == FALSE) {
			$this->pag_login();
		}else{
			$user=$this->input->post('txt-user');
			$pass=$this->input->post('txt-senha');

			$this->db->where('user', $user);
			$this->db->where('senha', md5($pass));

			$logged=$this->db->get('usuarios')->result();

			if(count($logged) == 1) {
				$session['userLogged']=$logged[0];
				$session['logged']=TRUE;
				$this->session->set_userdata($session);
				redirect(base_url('adm'));
			}else{
				$session['userLogged']=NULL;
				$session['logged']=FALSE;
				$this->session->set_userdata($session);
				redirect(base_url('adm/login'));
			}
		}
	}

	public function logout()
	{
		$session['userLogged']=NULL;
		$session['logged']=FALSE;
		$this->session->set_userdata($session);
		redirect(base_url('adm/login'));
	}

	public function new_img()
	{
		if(!$this->session->userdata('logged')) {
			redirect(base_url('adm/login'));
		}

		$this->load->model('Users', 'usersModel');
		
		$id=$this->input->post('id');
		$config['upload_path']='./assets/frontend/images/users';
		$config['allowed_types']='jpg';
		$config['file_name']=$id .'.jpg';
		$config['overwrite']=TRUE;
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload()) echo $this->upload->display_errors();
		else{
			$settings['source_image']='./assets/frontend/images/users/' .$id .'.jpg';
			$settings['create_thumb']=FALSE;
			$settings['width']=200;
			$settings['heigth']=200;

			$this->load->library('image_lib', $settings);

			if($this->image_lib->resize()) {
				if($this->usersModel->update_img($id)) redirect(base_url('adm/login/edit/' .$id));
				else echo "Houve um erro no sistema";
			}else {
				echo $this->image_lib->display_errors();
			}
		}
	}
	
}