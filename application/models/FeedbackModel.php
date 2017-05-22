<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class BlockModel
 */
class FeedbackModel extends MY_Model
{
    /**
     * @var string $tableName
     */
    protected $tableName = "feedback";


    /**
     * @param $id
     * @return mixed
     */
    public function getStarsRate($id){
        $query = $this->db->query("SELECT SUM(star) as star,COUNT(star) as count FROM feedback Where to_id = $id ");
        return $query->row();
    }

    /**
     * @param $id
     * @param $offset = false
     */
    public function getExpertFeedback($id,$offset = 0){
        $this->db->select('feedback.*,users.screen_name');
        $this->db->from($this->tableName);
        $this->db->where('to_id',$id);
        $this->db->join('users', 'users.id = feedback.from_id');
        $this->db->order_by('feedback.id','DESC');

        $this->db->limit(5,$offset);
        $query = $this->db->get();

        return $query->result();
    }
}