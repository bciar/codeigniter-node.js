<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientsInfoModel extends MY_Model
{
    /**
     * @var string
     */
    protected $tableName = "clients_info";

    /**
     * @param $id
     * @return mixed
     */
    public function getClientInfo($id){
        $this->db->select('users.screen_name,users.id,clients_info.image');
        $this->db->where(['user_id'=>$id]);
        $this->db->join('users', 'users.id = clients_info.user_id');

        $query = $this->db->get($this->tableName);

        return $query->row();
    }
}