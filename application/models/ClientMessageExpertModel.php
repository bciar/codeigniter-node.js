<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ClientMessageExpertModel
 */
class ClientMessageExpertModel extends MY_Model
{
    /**
     * @var string $tableName
     */
    protected $tableName = "client_message_expert";

    /**
     * @param int $expert_id
     * @param int $client_id
     * @return array
     */
    public function getMessagesBetween($expert_id,$client_id)
    {
        $query = $this->db->query("SELECT * FROM client_message_expert WHERE client_id = $client_id and expert_id = $expert_id");
        return $query->result();
    }
}