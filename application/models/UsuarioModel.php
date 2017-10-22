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

	function selectAddUsers()
	{
		$this->db->select('*')
		->from('Usuarios')
		->join('UsuarioAmigo', 'Usuarios.Id != UsuarioAmigo.IdUsuario')
		->where('Usuarios.Id', $this->session->userdata['id']);

		$query = $this->db->get();

		return $query->result();
	}

	function atualizarDadosUsuario($id ,$nome, $email, $senha, $peso, $altura, $sexo, $dataNascimento)
	{
		$data = array(			
			'Nome'  => $nome,
			'Email' => $email,
			'Peso' => $peso, 
			'Altura' => $altura,
			'Sexo' => $sexo,
			'DataNascimento' => date('Y-m-d H:i:s',strtotime($dataNascimento)),
			'DataUltimaModificacao' => date('Y-m-d H:i:s',strtotime(time()))
			);

		if($senha != ''){
			$senhaAntiga = buscarDadosUsuario($id, 'Senha');
			$senhas = array(
				'Senha' => md5($senha),
				'SenhaAntiga' => senhaAntiga
				);
			$data = array_merge($data, senhas);
		}

		$this->db->where('id', $id); 
		$this->db->update('Usuarios', $data);
		return true;

	}

	function adicionarAmigo($id, $amigo)
	{
		if(!in_array($amigo, $this->filtrarAmigos($id))){
			$data = array(
				'IdUsuario' => $id,
				'IdUsuarioAmigo' => $amigo,
				'Status' => 0
				);

			$this->db->insert('UsuarioAmigo', $data);
			return true;
		}
		return false;
	}

	function buscarListaAmigos($id)
	{ 
		$this->db->select('*');
		$this->db->where('IdUsuario', $id); 
		$this->db->or_where('IdUsuarioAmigo', $id); 
		$this->db->where('Status', '1');
		$query = $this->db->get('UsuarioAmigo');  
		$ret = $query->row_array();
		return $ret;

	}
	
	function buscarUsuarioAmigo($id)
	{
		$this->db->select('*');
		$this->db->from('Usuarios us');
		$this->db->join('UsuarioAmigo ua', 'ua.IdUsuarioAmigo = us.Id');
		$this->db->where('ua.IdUsuario', $id); 
		$query = $this->db->get(); 
		$resultado = $query->result_array();
		return $resultado;

	}

	// function verificaJaAmigo($id, $idAmigos)
	// {
	// 	$filtro = array_merge(array($id), array($idAmigo));
	// 	$this->db->select('if(IdUsuario=null,false,true) as boolAlready');
	// 	$this->db->from('UsuarioAmigo');
	// 	$this->db->where('IdUsuarioAmigo', $filtro);
	// 	$this->db->where('IdUsuario', $filtro);
	// 	$query = $this->db->get(); 	
	// 	$resultado = $query->result_array();
	// }

	protected function filtrarAmigos($id){
		$this->db->select('IdUsuarioAmigo');
		$this->db->from('Usuarios us');
		$this->db->join('UsuarioAmigo usam', 'usam.IdUsuario = us.Id', 'inner');
		$this->db->where_in('us.id', $id); 
		//$this->db->where('usam.Status', '1');
		$query = $this->db->get(); 
		$listaAmigos = $query->result_array();
		$amigos = array_column($listaAmigos, 'IdUsuarioAmigo');
		return $amigos;
	}

	protected function filtrarAmigosSugestao($id, $idExcecao){
		$this->db->select('IdUsuarioAmigo');
		$this->db->from('Usuarios us');
		$this->db->join('UsuarioAmigo usam', 'usam.IdUsuario = us.Id', 'inner');
		$this->db->where_in('us.id', $id);
		$this->db->where_not_in('usam.IdUsuarioAmigo', $idExcecao); 
		//$this->db->where('usam.Status', '1');
		$query = $this->db->get(); 
		$listaAmigos = $query->result_array();
		$amigos = array_column($listaAmigos, 'IdUsuarioAmigo');
		return $amigos;
	}

	protected function filtrarMinhasSolicitacoes($id){
		$this->db->select('usam.IdUsuario');
		$this->db->from('Usuarios us');
		$this->db->join('UsuarioAmigo usam', 'usam.IdUsuarioAmigo = us.Id', 'inner');
		$this->db->where_in('us.Id', $id);
		//$this->db->where('usam.Status', '1');
		$query = $this->db->get(); 
		$listaAmigos = $query->result_array();
		$amigos = array_column($listaAmigos, 'IdUsuario');
		return $amigos;
	}

	function buscarSugestaoAmigos($id)
	{ 
		$amigos = array_merge($this->filtrarAmigos($id), $this->filtrarMinhasSolicitacoes($id));
		$filtro = array_merge($amigos, array($id));
		if(!empty($amigos) && !empty($this->filtrarAmigosSugestao($amigos, $id))){
			$this->db->select('usam.IdUsuarioAmigo, us.Nome, us.FotoPerfil, Count(*) AS "NroAmigosComum"');
			$this->db->from('UsuarioAmigo usam');
			$this->db->join('Usuarios us', 'usam.IdUsuarioAmigo = us.Id', 'inner');
			$this->db->where('usam.Status', '1');
			$this->db->where_in('usam.IdUsuario', $amigos);
			$this->db->where_not_in('usam.IdUsuarioAmigo', $filtro);
			$this->db->group_by('usam.IdUsuarioAmigo');
			$this->db->limit(5);

			$query = $this->db->get(); 
			$resultado = $query->result_array();
			return $resultado;
		}

		$this->db->select('us.Id AS IdUsuarioAmigo, us.Nome, us.FotoPerfil, "0" AS NroAmigosComum');
		$this->db->from('Usuarios us');
		$this->db->where_not_in('us.Id', $filtro);
		$this->db->limit(5); 

		$query = $this->db->get(); 
		$resultado = $query->result_array();
		return $resultado;

		//return array(); //retorna um array vazio
	}

	function buscarSolicitacoesPendentes($id)
	{
		$this->db->select('us.Id, us.Nome, us.FotoPerfil');
		$this->db->from('UsuarioAmigo usam');
		$this->db->join('Usuarios us', 'usam.IdUsuario = us.Id', 'inner');
		$this->db->where('usam.Status', 0);
		$this->db->where('usam.IdUsuarioAmigo', $id);
		
		$query = $this->db->get(); 
		$resultado = $query->result_array();
		return $resultado;
	}

	function aceitarAmizade($idUsuario, $idAmigo)
	{
		$filtro = array($idUsuario, $idAmigo);
		$this->db->set('Status', '1');
		$this->db->where_in('IdUsuario', $filtro);
		$this->db->where_in('IdUsuarioAmigo', $filtro);
		$this->db->update('UsuarioAmigo');
		return true;
	}

	function rejeitarAmizade($idUsuario, $idAmigo)
	{
		$filtro = array($idUsuario, $idAmigo);
		$this->db->where_in('IdUsuario', $filtro);
		$this->db->where_in('IdUsuarioAmigo', $filtro);
		$this->db->delete('UsuarioAmigo');
		return true;
	}

	function atualizarFoto($idUsuario, $foto)
	{
		$this->db->set('FotoPerfil', $foto);
		$this->db->where_in('Id', $idUsuario);
		$this->db->update('Usuarios');
		return true;
	}
}
?>