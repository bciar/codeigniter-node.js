<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserBalancesModel extends MY_Model
{
    protected $tableName = "users_balances";


    public function updateBalance($price)
    {
        $data = [];
        
        $data['user_id']= $this->session->userdata('UserLoggedId');

        $data['amount'] = $price;

        $data['created_at'] = date('Y-m-d h:i:s');
        
        $this->db->insert($this->tableName, $data);

        $balance =$this->getBalance($data['user_id']);

        $balance = (empty($balance->amount))? 0 : $balance->amount;

        $this->session->set_userdata(['balance'=>$balance]);

        return true;
    }

    public function getBalance($id){

        $this->db->select('SUM(amount) as amount');
        $this->db->where(['user_id'=>$id]);

        $query = $this->db->get($this->tableName);
        
        return $query->row();
    }

    public function payExpert($expert_id, $amount)
    {
        $data = [];
        $data['user_id'] = $expert_id;
        $data['amount'] = $amount;
        $data['created_at'] = date('Y-m-d h:i:s');

        $this->db->insert($this->tableName, $data);

        return true;
    }

}