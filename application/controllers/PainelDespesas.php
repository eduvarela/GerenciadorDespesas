<?php
class PainelDespesas extends CI_Controller {
	public function carregarPainelAsync()
	{
		$data = "";
		$this->load->helper('url');
		$this->load->library('session');

		if(!$this->session->userdata['id']) {
			redirect('Inicio/index');
		}	

		$this->load->model('DespesasModel');
		$this->data['Despesas'] = $this->DespesasModel->buscarDespesasUsuario($this->session->userdata['id']);
		$this->data['Favorecidos'] = $this->DespesasModel->listarFavorecidos($this->session->userdata['id']);
		$this->data['FormasPagamento'] = $this->DespesasModel->listarFormasPagamento($this->session->userdata['id']);

		for($x=count($this->data['Despesas'])-1; $x>=0; $x--){
			$this->data['Despesas'][$x]['DataVencimento'] = $this->ConverterDataPadraoBrasileiro($this->data['Despesas'][$x]['DataVencimento'],'%d/%m/%Y');
		}

		$this->load->view('PainelDespesasView', $data);
	}

	public function adicionarDespesa(){
		$data = "";
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('DespesasModel');

		$usuario = $this->session->userdata['id'];
		$favorecido = $this->input->post('favorecido');
		$formaPagamento = $this->input->post('formaPagamento');
		$pago = $this->input->post('pago');
		$valor = $this->input->post('valor');
		$descricao = $this->input->post('descricao');
		$vencimento = $this->input->post('vencimento');

		if($usuario != null && $favorecido != null && $formaPagamento != null && $valor != null && $descricao != null && $vencimento != null){
			if($this->DespesasModel->adicionarDespesa($usuario, $favorecido, $formaPagamento, $pago, $valor, $descricao, $vencimento)){
				$data = array('message'=>"Sua publicação foi realizada com sucesso!", 'type'=>"success");
			}else{
				$data = array('message'=>"Por favor preencher todos os campos!", 'type'=>"error");
			}
		}else{
				$data = array('message'=>"Por favor preencher todos os campos!", 'type'=>"error");
		}
		echo json_encode($data);
	}

	public function ConverterDataPadraoBrasileiro($date, $datestring){
		date_default_timezone_set('America/Sao_Paulo');
		setlocale(LC_ALL, 'Portuguese_Brazilian');
		$this->load->helper('date');
		$mydate = mysql_to_unix($date);
		$mydate = mdate($datestring, $mydate);
		return $mydate;
	}
}
?>