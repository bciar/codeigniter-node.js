<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ExpertsInfoModel
 */
class ExpertClientsModel extends MY_Model
{
    /**
     * @var string $tableName
     */
    protected $tableName = "expert_clients";

    /**
     * @param $data
     */
    public function updateMyClients($data)
    {

        $date = date('Y-m-d h:i:s');

        $this->db->where($data);

        $query = $this->db->get($this->tableName);


        if($query->num_rows()){
            $this->db->where($data);
            $this->db->update($this->tableName, ['date'=>$date]);

        }else{

            $data['date'] = $date;

            $this->db->insert($this->tableName,$data);
        }
    }

    /**
     * @param $expert_id
     */
    public function getMyClients($expert_id)
    {
        $this->db->select('users.screen_name,users.id,clients_info.image,expert_clients.*');
        $this->db->where(['expert_id'=>$expert_id]);
        $this->db->join('clients_info', 'clients_info.user_id = expert_clients.client_id');
        $this->db->join('users', 'users.id = expert_clients.client_id');
        $this->db->limit(4);
        $this->db->order_by('expert_clients.date','DESC');
        $query = $this->db->get($this->tableName);

        return $query->result();
    }
}