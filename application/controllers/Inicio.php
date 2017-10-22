<?php
class Inicio extends CI_Controller {
	public function index($page = 'index')
	{
		$data = '';
		$this->load->helper('url');
		$this->load->view('InicioView', $data);
	}

	public function conectar(){
		
		#Carrega as Bibliotecas
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('UsuarioModel');

		#Envia o usuario e senha para a model
		$usuario = $this->UsuarioModel->autenticar($this->input->post('Email'), $this->input->post('Senha'));
		if(isset($usuario)){
			#Se existir, registra na sessao e manda pra tela principal
			// $this->session->userdata['logged_in'] = true;
			$this->session->set_userdata('id', $usuario['IdUsuario']); 
			redirect('Painel/principal');
		}else{
			#Se nao, manda novamente para a tela inicial
			$this->session->logged = false;
			$data['error'] = "Usuario ou Senha invalidos!";
			$this->load->view('InicioView', $data);
		}
	}
}
?>