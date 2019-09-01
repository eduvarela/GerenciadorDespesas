<?php
class DespesasModel extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	function buscarDespesasUsuario($idUsuario)
	{ 		
		$this->db->select('des.IdUsuario, cat.Nome AS Categoria, fav.Nome AS Favorecido, des.status, des.Valor, des.vencimento, fp.Nome as FormaPagamento');
		$this->db->from('Despesas des');
		$this->db->join('Favorecidos fav', 'des.IdFavorecido = fav.id', 'inner');
		$this->db->join('Categorias cat', 'des.IdCategoria = cat.id', 'inner');
		$this->db->join('FormaPagamento fp', 'des.IdFormaPagamento = fp.id', 'inner');
		$this->db->where_in('des.IdUsuario', $idUsuario);
		$this->db->limit(20);

		$query = $this->db->get(); 
		$resultado = $query->result_array();
		return $resultado;
	}

	function listarFavorecidos($id)
	{ 
		$this->db->select('fav.id, fav.Nome');
		$this->db->from('Favorecidos fav');
		$this->db->where('fav.IdUsuario', $id); 
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function listarFormasPagamento($id)
	{ 
		$this->db->select('fp.id, fp.Nome');
		$this->db->from('FormaPagamento fp');
		$this->db->where('fp.IdUsuario', $id); 
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function buscarDespesasPorFavorecidos($id)
	{ 
		$this->db->select('fav.Nome, Count(*) as Valor');
		$this->db->from('Despesas des');
		$this->db->join('Favorecidos fav', 'fav.id = des.IdFavorecido', 'inner');
		$this->db->where('des.IdUsuario', $id); 
		$this->db->group_by("des.IdFavorecido");
		$query = $this->db->get(); 

	//	log_message('error', 'estatisticasDespesasPorFavorecido[resultado]:' . serialize($query->result_array()));

		return $query->result_array();
	}

// SELECT fav.Nome ,Count(*) FROM Despesas des
// JOIN Favorecidos fav ON fav.IdFavorecido = des.IdFavorecido
// WHERE des.IdUsuario = 1
// GROUP BY des.IdFavorecido;

	function buscarDespesasPorFormaPagamento($id)
	{ 
		$this->db->select('fp.Nome, Count(*) as Valor');
		$this->db->from('Despesas des');
		$this->db->join('FormaPagamento fp', 'fp.id = des.IdFormaPagamento', 'inner');
		$this->db->where('des.IdUsuario', $id); 
		$this->db->group_by("des.IdFormaPagamento");
		$query = $this->db->get(); 

		log_message('error', 'buscarDespesasPorFormaPagamento[resultado]:' . serialize($query->result_array()));

		return $query->result_array();
	}

	function buscarDespesasPorCategoria($id)
	{ 
		$this->db->select('cat.Nome, Count(*) as Valor');
		$this->db->from('Despesas des');
		$this->db->join('Favorecidos fav', 'fav.id = des.IdFavorecido', 'inner');
		$this->db->join('Categorias cat', 'des.IdCategoria = cat.id', 'inner');
		$this->db->where('des.IdUsuario', $id); 
		$this->db->group_by("cat.id");
		$query = $this->db->get(); 


		return $query->result_array();
	}

	function buscarDespesasPorPeriodo($id, $periodo)
	{ 
		$this->db->select('EXTRACT(MONTH FROM des.vencimento) as Nome, Count(*) as Valor');
		$this->db->from('Despesas des');
		$this->db->where('des.IdUsuario', $id); 
		$this->db->group_by("EXTRACT(MONTH FROM des.vencimento)");

		// $this->db->where('des.vencimento BETWEEN DATE_SUB(NOW(), INTERVAL ' . $periodo. '* 30  DAY) AND NOW()'); 
		//$this->db->group_by("EXTRACT(MONTH FROM des.DataVencimento)");

		$query = $this->db->get(); 
		//log_message('error', 'buscarDespesasPorPeriodo[resultado]:' . serialize($query->result_array()));


		return $query->result_array();
	}
// BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW();
// 	select SUM(Valor) from Despesas
// WHERE (EXTRACT(MONTH FROM DataVencimento) = 11)
// order by DataVencimento

	function adicionarDespesa($usuario, $favorecido, $formaPagamento, $pago, $valor, $descricao, $vencimento){

		$data = array(
			'IdUsuario'  => $usuario,
			'IdFavorecido'  => $favorecido,
			'IdFormaPagamento'  => $formaPagamento,
			'Pago'  => $pago,
			'Valor'  => $valor,
			'Descricao'  => $descricao,
			'vencimento'  => date('Y-m-d',strtotime($this->dateEmMysql($vencimento))),
		);

		$this->db->insert('Despesas', $data);
		return true;
	}

	public static function dateEmMysql($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}
}
?>