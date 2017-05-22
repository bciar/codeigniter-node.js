<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ClientMessageExpertModel
 */
class MessageModel extends MY_Model
{
    /**
     * @var string $tableName
     */
    protected $tableName = "messages";

    /**
     * @param $where
     * @param $row
     * @param string $type
     * @return mixed
     */
    public function allWhereOrder($where, $row, $type = 'ASC')
    {
        if (is_array(array_values($where)[0])) {
            foreach ($where as $item => $value) {
                $this->db->group_start();
                for ($i = 0; $i < sizeof($value); $i++) {
                    if ($i == 0)
                        $this->db->where($value[$i], $item);
                    else
                        $this->db->or_where($value[$i], $item);
                }
                $this->db->group_end();
            }
        } else
            $this->db->where($where);
        $this->db->order_by($row, $type);

//        $this->db->group_by('from_user_id');
        $query = $this->db->get($this->tableName);

//        return $this->db->last_query();
        return $query->result();
    }

    /**
     * @param $where
     * @param $row
     * @param string $type
     * @return mixed
     */
    public function allWhereOrderLimit($where, $row, $type = 'ASC', $group_by = '')
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
        $this->db->order_by($row, $type);

        if ($group_by) {
            $this->db->group_by($group_by);
        } else {
            $this->db->limit(1);
        }

        $query = $this->db->get($this->tableName);
//        return $this->db->last_query();
        return $query->result();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getUserInbox($user_id, $search = '')
    {
        $additional_where = '';
        if ($search) {
            $additional_where = ' AND (l.`subject` LIKE "%' . $search . '%") OR (l.`message` LIKE "%' . $search . '%")';
        }

        $sql = 'SELECT l.*, SUM(p.amount) AS payment_amount,
                  (
                    SELECT SUM(amount) FROM invoices
                      WHERE l.subject=subject AND (client_id=l.from_user_id OR client_id=l.to_user_id) AND (expert_id=l.from_user_id OR expert_id=l.to_user_id)
                  ) AS invoice_amount
                  FROM ' . $this->tableName . ' l
                  INNER JOIN
                  (
                    SELECT `subject`, MAX(`time`) AS latest FROM ' . $this->tableName . ' WHERE `to_user_id` = ' . $user_id . $additional_where . ' GROUP BY `subject`
                  ) r ON l.`time` = r.latest AND l.`subject` = r.`subject`
                LEFT JOIN payments p ON l.payment_id = p.id 
                GROUP BY l.subject
                ORDER BY l.`time` DESC';
        $query = $this->db->query($sql);

        return $query->result();
    }

    /**
     * @param $row
     * @param string $type
     * @return mixed
     */
    public function allOrder($row, $type = 'ASC')
    {
        $this->db->order_by($row, $type);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    /**
     * method whereOr
     * @param $id
     */
    public function whereOr($id)
    {
        $query = $this->db->query("SELECT * FROM messages Where from_user_id = $id OR to_user_id = $id");
        return $query->result();
    }
}