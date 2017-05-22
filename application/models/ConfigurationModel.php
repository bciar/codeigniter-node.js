<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConfigurationModel extends MY_Model
{
    /**
     * @var string
     */
    protected $tableName = "configuration";

    /**
     * @param $id
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');

        $query = $this->db->get($this->tableName);

        return $query->row();
    }

    public function update($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);

        $this->db->update($this->tableName);
    }

}