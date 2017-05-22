<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceModel extends MY_Model
{
    protected $tableName = "invoices";

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

    public function markPaid($invoice_id, $date)
    {
        $data = array(
            'paid_time' => $date,
            'is_paid' => 1
        );

        $this->db->where('id', $invoice_id);
        $this->db->update($this->tableName, $data);

        return true;
    }

}