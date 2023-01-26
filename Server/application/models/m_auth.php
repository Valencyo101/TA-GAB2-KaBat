<?php  

/**
* 
*/
class m_auth extends CI_Model
{
	
	private $table_name = "tb_users";

	function get_user_by_emai($email,$password){
		$this->db->where('EMAIL',$email);
		$this->db->where('PASSWORD',$password);

		return $this->db->get($this->table_name)->row();
	}
}

?>