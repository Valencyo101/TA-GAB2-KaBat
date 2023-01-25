<?php 

class Api_model extends CI_Model 
{
    function registerUser($data)
    {
        $this->db->insert('users',$data);
    }

    function checkLogin($data)
    {
        $this->db->where($data);
        $query = $this->db->get('users');
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        else 
        {
            return false;
        }
    }

    function getProfile($userId)
    {
        $this->db->select('name,email');
        $this->db->where(['id'=>$userId]);
        $query = $this->db->get('users');
        return $query->row();
    }

}