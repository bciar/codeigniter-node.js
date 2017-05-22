<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentModel extends MY_Model
{
    /**
     * @var string
     */
    protected $tableName = "payments";

    /**
     * method getPay
     * @param $from
     * @param $to
     * @param $id
     * @return array
     */
    public function getPay($from,$to,$id)
    {
        $query = $this->db->query("SELECT * FROM payments WHERE client_id = $id AND  date BETWEEN CAST('$from' AS DATE) AND CAST('$to' AS DATE)");
        return $query->result();
    }

    /**
     * @param $from
     * @param $to
     * @param $id
     * @return array
     */
    public function getExpertPay($from,$to,$id)
    {
        $query = $this->db->query("SELECT * FROM payments WHERE expert_id = $id AND  date BETWEEN CAST('$from' AS DATE) AND CAST('$to' AS DATE)");
        return $query->result();
    }
    
    /**
     * 
     */
    public function getListPaymentsInProcess($id)
    {
        $this->db->where('id', $id);
        $data['payments'] = $this->db->get($this->tableName)->row();

        $this->db->where('user_id', $data['payments']->client_id);
        $data['client_info'] = $this->db->get('clients_info')->row();

        $this->db->where('expert_id', $data['payments']->expert_id);
        $data['expert_info'] = $this->db->get('experts_info')->row();

        
        return $data;
    }
}