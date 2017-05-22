<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class BlockModel
 */
class BlockModel extends MY_Model
{
    /**
     * @var string $tableName
     */
    protected $tableName = "block";

    /**
     * @param $expert_id
     *
     */
    public function getBlockClients($expert_id){
        $this->db->select('block.client_id,users.screen_name,clients_info.image');
        $this->db->from($this->tableName);
        $this->db->where('expert_id',$expert_id);
        $this->db->join('users', 'users.id = block.client_id');
        $this->db->join('clients_info', 'clients_info.user_id = users.id');
        $this->db->order_by('block.id','DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getBlockId($expert_id){
        $this->db->select('block.client_id');
        $this->db->from($this->tableName);
        $this->db->where('expert_id',$expert_id);

        $query = $this->db->get();
        $result = [];
        foreach($query->result_array() as $item) {
            $result[] = $item['client_id'];
        }


        return $result;
    }
}