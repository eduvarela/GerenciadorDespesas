<?php
class DespesasModel extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	function buscarDespesasUsuario($idUsuario)
	{ 		
		$this->db->select('des.IdUsuario, cat.Nome AS Categoria, fav.Nome AS Favorecido, des.StatusDespesa, des.Valor, des.DataVencimento');
		$this->db->from('Despesas des');
		$this->db->join('Favorecidos fav', 'des.IdFavorecido = fav.IdFavorecido', 'inner');
		$this->db->join('Categorias cat', 'fav.IdCategoria = cat.IdCategoria', 'inner');
		$this->db->where_in('des.IdUsuario', $idUsuario);
		$this->db->limit(20);

		$query = $this->db->get(); 
		$resultado = $query->result_array();
		return $resultado;
	}
}
?>