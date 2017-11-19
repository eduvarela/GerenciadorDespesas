<?php
class DespesasModel extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	function buscarDespesasUsuario($idUsuario)
	{ 		
		$this->db->select('des.IdUsuario, cat.Nome AS Categoria, fav.Nome AS Favorecido, des.Pago, des.Valor, des.DataVencimento, fp.Nome as FormaPagamento');
		$this->db->from('Despesas des');
		$this->db->join('Favorecidos fav', 'des.IdFavorecido = fav.IdFavorecido', 'inner');
		$this->db->join('Categorias cat', 'fav.IdCategoria = cat.IdCategoria', 'inner');
		$this->db->join('FormaPagamento fp', 'des.IdFormaPagamento = fp.IdFormaPagamento', 'inner');
		$this->db->where_in('des.IdUsuario', $idUsuario);
		$this->db->limit(20);

		$query = $this->db->get(); 
		$resultado = $query->result_array();
		return $resultado;
	}

	function buscarFavorecidos($id)
	{ 
		$this->db->select('Nome, IdFavorecido, IdCategoria, Descricao');
		$this->db->where('IdUsuario', $id); 
		$query = $this->db->get('Favorecidos'); 
		return $query->row_array();
	}

	function listarFavorecidos($id)
	{ 
		$this->db->select('fav.IdFavorecido, fav.Nome');
		$this->db->from('Favorecidos fav');
		$this->db->where('fav.IdUsuario', $id); 
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function listarFormasPagamento($id)
	{ 
		$this->db->select('fp.IdFormaPagamento, fp.Nome');
		$this->db->from('FormaPagamento fp');
		$this->db->where('fp.IdUsuario', $id); 
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function adicionarDespesa($usuario, $favorecido, $formaPagamento, $pago, $valor, $descricao, $vencimento){

		$data = array(
			'IdUsuario'  => $usuario,
			'IdFavorecido'  => $favorecido,
			'IdFormaPagamento'  => $formaPagamento,
			'Pago'  => $pago,
			'Valor'  => $valor,
			'Descricao'  => $descricao,
			'DataVencimento'  => date('Y-m-d H:i:s',strtotime($vencimento)),
			);

		$this->db->insert('Despesas', $data);
		return true;
	}
}
?>