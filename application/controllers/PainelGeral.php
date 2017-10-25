<?php
class PainelGeral extends CI_Controller {
	public function carregarPainelAsync()
	{
		$data = '';
		$this->load->helper('url');
		$this->load->library('session');

		if(!$this->session->userdata['id']) {
			redirect('Inicio/index');
		}	

		$this->load->model('DespesasModel');
		$this->data['Despesas'] = $this->DespesasModel->buscarDespesasUsuario($this->session->userdata['id']);
		$this->data['Favorecidos'] = $this->DespesasModel->listarFavorecidos($this->session->userdata['id']);
		$this->data['FormasPagamento'] = $this->DespesasModel->listarFormasPagamento($this->session->userdata['id']);

		
		$this->load->view('PainelGeralView', $data);
	}
}
?>