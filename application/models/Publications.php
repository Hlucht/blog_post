<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publications extends CI_Model {

	public $id;
	public $categoria;
    public $titulo;
    public $subtitulo;
    public $conteudo;
    public $data;
    public $img;
    public $user;

	public function __construct()
	{
		parent::__construct();
	}

	public function contrast_home()
	{
		$this->db->select
		('usuarios.id as usuarioId,
		usuarios.nome, 
		postagens.id, 
		postagens.titulo, 
		postagens.subtitulo, 
		postagens.user, 
		postagens.data, 
		postagens.img');
		$this->db->from('postagens');
		$this->db->join('usuarios', 'usuarios.id = postagens.user');

        $this->db->limit(4);
		$this->db->order_by('postagens.data', 'DESC');
		return $this->db->get()->result();
	}

	public function publi_category($id)
	{
		$this->db->select
		('usuarios.id as usuarioId,
		usuarios.nome, 
		postagens.id, 
		postagens.titulo, 
		postagens.subtitulo, 
		postagens.user, 
		postagens.data, 
		postagens.img,
		postagens.categoria');
		$this->db->from('postagens');
		$this->db->join('usuarios', 'usuarios.id = postagens.user');

        $this->db->where('postagens.categoria = ' .$id);
		$this->db->order_by('postagens.data', 'DESC');
		return $this->db->get()->result();
	}

	public function publication($id)
	{
		$this->db->select
		('usuarios.id as usuarioId,
		usuarios.nome, 
		postagens.id, 
		postagens.titulo, 
		postagens.subtitulo, 
		postagens.user, 
		postagens.data, 
		postagens.img,
		postagens.categoria,
		postagens.conteudo');
		$this->db->from('postagens');
		$this->db->join('usuarios', 'usuarios.id = postagens.user');

        $this->db->where('postagens.id', $id);
		return $this->db->get()->result();
	}

	public function list_title($id)
	{
		$this->db->select('id, titulo');
		$this->db->from('postagens');
		$this->db->where('id', $id);
		return $this->db->get()->result();
	}

	public function list_publication()
	{
		$this->db->order_by('data', 'DESC');
		return $this->db->get('postagens')->result();
	}

	public function list_publications($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->get('postagens')->result();
	}

	public function add($title, $subtitle, $content, $date, $category, $userPubli)
	{
		$data['titulo']=$title;
		$data['subtitulo']=$subtitle;
		$data['conteudo']=$content;
		$data['data']=$date;
		$data['categoria']=$category;
		$data['user']=$userPubli;

		return $this->db->insert('postagens',$data);
	}

	public function delete($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->delete('postagens');
	}

	public function update($title, $subtitle, $content, $date, $category, $id)
	{
		$data['titulo']=$title;
		$data['subtitulo']=$subtitle;
		$data['conteudo']=$content;
		$data['data']=$category;
		$data['categoria']= $category;
		$this->db->where('id', $id);

		$this->db->where('id', $id);
		return $this->db->update('postagens', $data);
	}

	public function update_img($id)
	{
		$data['img']=1;

		$this->db->where('md5(id)', $id);
		return $this->db->update('postagens', $data);
	}

	public function count()
	{
		return $this->db->count_all('postagens');
	}
	
	public function search($inquiry)
	{
		$this->db->select
		('usuarios.id as usuarioId,
		usuarios.nome, 
		postagens.id, 
		postagens.titulo, 
		postagens.subtitulo, 
		postagens.user, 
		postagens.data, 
		postagens.img,
		postagens.categoria,
		postagens.conteudo');
		$this->db->from('postagens');
		$this->db->join('usuarios', 'usuarios.id = postagens.user');

        $this->db->where('titulo', $inquiry);
		return $this->db->get()->result();
    }
}