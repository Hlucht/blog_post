<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Model {

	public $id;
	public $titulo;

	public function __construct()
	{
		parent::__construct();
	}

	public function list_categories()
	{
		$this->db->order_by('titulo', 'ASC');
		return $this->db->get('categorias')->result();
	}

	public function list_category($id)
	{
		$this->db->from('categorias');
		$this->db->where('md5(id)',$id);
		return $this->db->get()->result();
	}

	public function list_title($id)
	{
		$this->db->from('categorias');
		$this->db->where('id =' .$id);
		return $this->db->get()->result();
	}

	public function add($heading)
	{
		$data['titulo']=$heading;
		return $this->db->insert('categorias',$data);
	}

	public function delete($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->delete('categorias');
	}

	public function update($heading, $id)
	{
		$data['titulo']=$heading;
		$this->db->where('id', $id);
		return $this->db->update('categorias', $data);
	}
	
}