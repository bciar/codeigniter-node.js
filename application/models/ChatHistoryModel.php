<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChatHistoryModel extends MY_Model
{
    /**
     * @var string
     */
    protected $tableName = "chat_history";

    /**
     * @param $user_id
     * @param $user_type
     * @return mixed
     */
    public function getHistory($user_id, $user_type)
    {
        $field = $user_type . '_id';
        $this->db->where($field, $user_id);
        $query = $this->db->get($this->tableName);

        return $query->result();
    }

}