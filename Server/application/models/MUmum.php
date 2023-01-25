<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUmum extends CI_Model
{
    public function create($table, $data){
        return $this->db->insert($table, $data);
    }

    public function get($table, $where = null){
        if(isset($where)){
            $this->db->where($where);
        }

        return $this->db->get($table);
    }

    public function update($table, $data, $where){
        return $this->db->where($where)->update($table, $data);
    }

    public function delete($table, $where){
        return $this->db->where($where)->delete($table);
    }
}