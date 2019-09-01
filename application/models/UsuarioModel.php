<?php
class UsuarioModel extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

    #verifica se o usuario existe no banco
	function autenticar($email, $senha){
		$this->db->where('Email', $email); 
		$this->db->where('Senha', md5($senha));
		$this->db->where('Status', 1);
		$query = $this->db->get('Usuarios'); 
		return $query->row_array();
	}
	#Verifica se o e-mail é válido
	function validarEmail($email)
	{
		return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
	}

	#adiciona usuario no banco
	function adicionarUsuario($nome, $email, $senha, $peso, $altura, $sexo, $dataNascimento){

		#verifica se o email ja foi cadastrado
		$this->db->where('Email', $email); 
		$query = $this->db->get('Usuarios'); 

		if($query->num_rows() == 1){
			return false;
		}
		
		$data = array(
			'Nome'  => $nome,
			'Email' => $email,
			'Senha' => md5($senha),
			'status'=> 1,
			'DataNascimento' => date('Y-m-d H:i:s',strtotime($dataNascimento)),
			);

		$this->db->insert('Usuarios', $data);
		return true;
	}

	function select($id)
	{
		$this->db->where('id', $id); 
		$query = $this->db->get('Usuarios'); 
		return $query->row_array();
	}

	function buscarUsuarioEmail($email)
	{
		$this->db->select("*");
		$this->db->where('Email', $email); 
		$query = $this->db->get('Usuarios'); 
		return $query->row_array();
	}

	function buscarDadosUsuario($id, $dados)
	{ 
		$this->db->select($dados);
		$this->db->where('id', $id); 
		$query = $this->db->get('Usuarios'); 
		return $query->row_array();
	}
	
	function buscarUsuario($id, $busca)
	{
		$amigos = $this->filtrarAmigos($id);
		$filtro = array_merge($amigos, array($id));
		
		$this->db->select('us.Nome, us.Id, us.FotoPerfil');
		$this->db->from('Usuarios us');
		$this->db->like('us.Nome', $busca);
		$this->db->or_like('us.Email', $busca);
		$this->db->where_not_in('us.Id', $id);

		$query = $this->db->get();
		return $query->result_array();
	}
}
?>