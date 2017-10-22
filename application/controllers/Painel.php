<?php
class Painel extends CI_Controller {
	public function principal()
	{
		$data = '';
		$this->load->helper('url');
		$this->load->view('PainelView', $data);
	}
}
?>