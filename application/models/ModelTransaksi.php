<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelTransaksi extends CI_Model
{
    protected $TABLE = "transaksi";
    public function get_all()
    {
        return $this->db->get($this->TABLE);
    }
    public function delete($id)
    {
        return $this->db->delete($this->TABLE, ["id" => $id]);
    }
    public function add($data)
    {
        $this->db->insert($this->TABLE, $data);
        return $this->db->insert_id();
    }
    public function update($data)
    {
        return $this->db->update($this->TABLE, $data, ["id" => $data['id']]);
    }
    public function get_by_id($id)
    {
        return $this->db->get_where($this->TABLE, ["id" => $id]);
    }
}
