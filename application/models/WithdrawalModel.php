<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WithdrawalModel extends MY_Model
{
    protected $tableName = "withdrawals";

    /**
     * @param $where
     * @return mixed
     */
    public function allWhere($where, $order_by = false)
    {
        if (is_array(array_values($where)[0])) {
            foreach ($where as $item => $value) {
                for ($i = 0; $i < sizeof($value); $i++) {
                    if ($i == 0)
                        $this->db->where($value[$i], $item);
                    else
                        $this->db->or_where($value[$i], $item);
                }
            }
        } else {
            $this->db->where($where);
        }

        $query = $this->db->get($this->tableName);

        return $query->result();
    }

    public function processWithdraw($withdrawal_id, $trx_id, $date)
    {
        $data = array(
            'process_date' => $date,
            'trx_id' => $trx_id
        );

        $this->db->where('id', $withdrawal_id);
        $this->db->update($this->tableName, $data);

        return true;
    }

}