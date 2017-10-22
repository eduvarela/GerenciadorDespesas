<?php
class Painel extends CI_Controller {
	public function principal()
	{
		$data = '';
		$this->load->helper('url');
		$this->load->library('session');
		
		$this->load->model('UsuarioModel');
		$this->data['Usuario'] = $this->UsuarioModel->buscarDadosUsuario($this->session->userdata['id'], array('Nome'));
		
		$this->load->model('DespesasModel');
		$this->data['Despesas'] = $this->DespesasModel->buscarDespesasUsuario($this->session->userdata['id']);
		
		$this->load->view('PainelView', $data);
	}
}
?>