<?php
class UsuarioModel extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

    #verifica se o usuario existe no banco
	function autenticar($email, $senha){
		$this->db->where('Email', $email); 
		$this->db->where('Senha', md5($senha));
		$this->db->where('StatusConta', 1);
		$query = $this->db->get('Usuarios'); 
		return $query->row_array();
        //return ($query->num_rows() == 1);
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
		// if($this->input->post('Senha') != $this->input->post('Senhac')){
		// 	return false;
		// }
		
		$data = array(
			'Nome'  => $nome,
			'Email' => $email,
			'Senha' => md5($senha),
			'SenhaAntiga' => '0',
			'Status'=> 1,
			'Peso' => $peso, 
			'Altura' => $altura,
			'Sexo' => $sexo,
			'DataNascimento' => date('Y-m-d H:i:s',strtotime($dataNascimento)),
			'DataCadastro' => date('Y-m-d H:i:s'),
			'DataUltimaModificacao' => date('Y-m-d H:i:s')
			);

		$this->db->insert('Usuarios', $data);
		return true;
	}

	function select($id)
	{
		//$this->db->where('id', $this->input->post('id')); 
		$this->db->where('id', $id); 
		$query = $this->db->get('Usuarios'); 

		$ret = $query->row_array();
		//$ret['DataNascimento'] = date('m/d/Y', strtotime($ret['DataNascimento']));
		return $ret;

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
		$this->db->where('idUsuario', $id); 
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