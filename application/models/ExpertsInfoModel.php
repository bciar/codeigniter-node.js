<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ExpertsInfoModel
 */
class ExpertsInfoModel extends MY_Model
{
    /**
     * @var string $tableName
     */
    protected $tableName = "experts_info";

    /**
     * @param $client_id
     * @return array
     */
    public function getExpertsListForChat($client_id)
    {
        $experts = $this->db->query("SELECT expert_id,name,surname,image FROM experts_info WHERE expert_id IN (SELECT expert_id FROM client_message_expert WHERE client_id = $client_id and from_expert = 1 GROUP BY expert_id)");
        return $experts->result();
    }

    /**
     * @param $expert_id
     */
    public function emilPrice($expert_id){

        $this->db->select('mail_price');
        $this->db->where(['expert_id'=>$expert_id]);

        $query = $this->db->get($this->tableName);

        return $query->row();
    }
}