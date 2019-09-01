<?php
class PainelGeral extends CI_Controller {
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
			$this->data['Despesas'][$x]['vencimento'] = $this->ConverterDataPadraoBrasileiro($this->data['Despesas'][$x]['vencimento'],'%d/%m/%Y');
		}

		$this->load->view('PainelGeralView', $data);
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

	public function estatisticasDespesasPorFavorecido(){
		$data = "";
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('DespesasModel');
		$this->data['EstatisticasFavorecidos'] = $this->DespesasModel->buscarDespesasPorFavorecidos($this->session->userdata['id']);
		//log_message('error', 'estatisticasDespesasPorFavorecido[resultado]:' . serialize($this->data['EstatisticasFavorecidos']));

		echo json_encode($this->data['EstatisticasFavorecidos']);
	}

	public function estatisticasDespesasPorFormaPagamento(){
		$data = "";
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('DespesasModel');
		$this->data['EstatisticasFormaPagamento'] = $this->DespesasModel->buscarDespesasPorFormaPagamento($this->session->userdata['id']);
		//log_message('error', 'estatisticasDespesasPorFavorecido[resultado]:' . serialize($this->data['EstatisticasFavorecidos']));

		echo json_encode($this->data['EstatisticasFormaPagamento']);
	}

	public function estatisticasDespesasPorCategoria(){
		$data = "";
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('DespesasModel');
		$this->data['EstatisticasCategoria'] = $this->DespesasModel->buscarDespesasPorCategoria($this->session->userdata['id']);
		//log_message('error', 'estatisticasDespesasPorFavorecido[resultado]:' . serialize($this->data['EstatisticasFavorecidos']));

		echo json_encode($this->data['EstatisticasCategoria']);
	}

	public function estatisticasDespesasPorPeriodo(){
		$meses = array(
			1 => 'Janeiro',
			'Fevereiro',
			'Março',
			'Abril',
			'Maio',
			'Junho',
			'Julho',
			'Agosto',
			'Setembro',
			'Outubro',
			'Novembro',
			'Dezembro'
		);

		$data = "";
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('DespesasModel');
		$this->data['EstatisticasPeriodo'] = $this->DespesasModel->buscarDespesasPorPeriodo($this->session->userdata['id'], 3);

		for($x=count($this->data['EstatisticasPeriodo'])-1; $x>=0; $x--){
			$this->data['EstatisticasPeriodo'][$x]['Nome'] = $meses[$this->data['EstatisticasPeriodo'][$x]['Nome']];
		}

		echo json_encode($this->data['EstatisticasPeriodo']);
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