<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

	public $id;
	public $nome;
	public $email;
	public $img;
	public $historico;
	public $usuario;
	public $senha;


	public function __construct()
	{
		parent::__construct();
	}

	public function list_user($id)
	{
		$this->db->select('id, nome, historico, img');
		$this->db->from('usuarios');
		$this->db->where('id', $id);
		return $this->db->get()->result();
	}

	public function list_users()
	{
		$this->db->select('id, nome, img');
		$this->db->from('usuarios');
		$this->db->order_by('nome', 'ASC');
		return $this->db->get()->result();
	}

	public function add($nome, $email, $historico, $user, $senha)
	{
		$data['nome']=$nome;
		$data['email']=$email;
		$data['historico']=$historico;
		$data['user']=$user;
		$data['senha']=md5($senha);

		return $this->db->insert('usuarios',$data);
	}

	public function delete($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->delete('usuarios');
	}

	public function update($nome, $email, $historico, $user, $senha, $id)
	{
		$data['nome']=$nome;
		$data['email']=$email;
		$data['historico']=$historico;
		$data['user']=$user;
		$data['senha']=md5($senha);

		$this->db->where('id', $id);
		return $this->db->update('usuarios', $data);
	}

	public function emit_user($id)
	{
		$this->db->select('id, nome, historico, email, user, img');
		$this->db->from('usuarios');
		$this->db->where('md5(id)', $id);
		return $this->db->get()->result();
	}

	public function update_img($id)
	{
		$data['img']=1;

		$this->db->where('md5(id)', $id);
		return $this->db->update('usuarios', $data);
	}
	
}