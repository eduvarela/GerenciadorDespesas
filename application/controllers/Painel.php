<?php
class Painel extends CI_Controller {
	public function principal()
	{
		$data = '';
		$this->load->helper('url');
		$this->load->library('session');

		if(!$this->session->userdata['id']) {
			redirect('Inicio/index');
		}	
		
		$this->load->model('UsuarioModel');
		$this->data['Usuario'] = $this->UsuarioModel->buscarDadosUsuario($this->session->userdata['id'], array('Nome'));
		$this->load->view('PainelView', $data);
	}

	public function desconectar(){
		$this->load->helper('url');
		$this->load->library('session');
		unset($this->session->userdata['id']);
		$this->session->sess_destroy();
		redirect('Inicio/index');
	}
}
?>