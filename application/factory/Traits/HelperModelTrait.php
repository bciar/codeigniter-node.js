<?php
defined('BASEPATH') OR exit('No direct script access allowed');

trait HelperModelTrait
{
    /**
     * all method
     * @return array|null
     * */
    protected function all()
    {
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    /**
     * allByRow method
     * @param array $where
     * @return array|null
     * */
    protected function allWhere($where,$order_by = false)
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
        } else
            $this->db->where($where);
        
        
        if($order_by){
            $this->db->order_by('id','DESC');
        }
        $query = $this->db->get($this->tableName);

        return $query->result();
    }

    /**
     * oneById method
     * @param int $id
     * @return stdClass|null
     * */
    protected function oneById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->tableName);

        return $query->row();
    }

    /**
     * oneWhere method
     * @param array $where
     * @return stdClass
     * */
    protected function oneWhere($where)
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
        } else

            $this->db->where($where);

        $query = $this->db->get($this->tableName);
        return $query->row();
    }


    /**
     * oneSelectWhere method
     * @param array $select
     * @return stdClass
     * */
    protected function oneSelect($select)
    {
        if (count($select) > 1) {
            $select = implode(",", $select);
        }

        $this->db->select($select);
        $this->db->join('users', 'users.id = experts_info.expert_id');

        $query = $this->db->get($this->tableName);

        return $query->result();
    }

    /**
     * oneSelectJoinWhereIn method
     * @param array $select
     * @functionality  For Expert
     * @return stdClass
     * */
    protected function oneSelectJoinWhereIn($select, $where, $where_in)
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
        } else

            if (count($select) > 1) {
                $select = implode(",", $select);
            }

        $this->db->select($select);
        $this->db->join('users', 'users.id = experts_info.expert_id');
        $this->db->where($where);
        $this->db->where_in('experts_info.expert_id', $where_in);

        $query = $this->db->get($this->tableName);

        return $query->result();
    }


    /**
     * oneSelectJoin method
     * @param array $select
     * @param array $where
     * @param  $favorite_experts
     * @param  $offset
     * @functionality  For Expert
     * @return stdClass
     * */

    // oneSelectJoin
    protected function getExperts($select, $where,$offset = 0,$favorite_experts = false, $order_by = false)
    {

        if(count($where) >1){
            if (is_array(array_values($where)[0])) {
                foreach ($where as $item => $value) {
                    for ($i = 0; $i < sizeof($value); $i++) {
                        if ($i == 0)
                            $this->db->where($value[$i], $item);
                        else
                            $this->db->or_where($value[$i], $item);
                    }
                }
            }
        }

        if (count($select) > 1) {
            $select = implode(",", $select);
        }

        $this->db->select($select);
        $this->db->join('users', 'users.id = experts_info.expert_id');
        $this->db->join('expert_categories', 'expert_categories.id = experts_info.expert_type');
        $this->db->where($where);

        if($favorite_experts){
            $this->db->where_in('experts_info.expert_id', $favorite_experts);
        }

        if ($order_by) {
            $this->db->order_by($order_by['field'], $order_by['direction']);
        }

        $this->db->limit(6,$offset);

        $query = $this->db->get($this->tableName);


        return $query->result();
    }

    /**
     * oneSelectWhere method
     * @param array $where
     * @param array $select
     * @return stdClass
     * */
    protected function oneSelectWhere($select, $where)
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
        } else


            if (count($select) > 1) {
                $select = implode(",", $select);
            }

        $this->db->select($select);
        $this->db->where($where);


        $query = $this->db->get($this->tableName);
        return $query->row();

    }

    /**
     * SelectWhere method
     * @param array $where
     * @param array $select
     * @return stdClass
     * */
    protected function SelectWhere($select, $where)
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
        } else


            if (count($select) > 1) {
                $select = implode(",", $select);
            }

        $this->db->select($select);
        $this->db->where($where);

        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    /**
     * @param $where
     * @param bool $num
     * @param bool $offset
     * @return mixed
     */

    public function getExpertsInfo($where, $num = false, $offset = false, $order_by = false)
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
        } else
            $this->db->select('*');
        $this->db->where($where);
        $this->db->from($this->tableName);
        $this->db->join('experts_info', 'experts_info.expert_id = users.id ');

        if ($order_by) {
            $this->db->order_by($order_by['field'], $order_by['direction']);
        } else {
            $this->db->order_by('users.id', "DESC");
        }

        $this->db->limit($num, $offset);

        $query = $this->db->get();
        return $query->result();
    }


    /**
     * getUsersInfo method
     * @param array $where
     * @return stdClass
     * */

    public function getUsersInfo($where)
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
            $this->db->select('*');
        $this->db->where($where);
        $this->db->from($this->tableName);
        $this->db->join('clients_info', 'clients_info.user_id = users.id ');
        $this->db->order_by('users.id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }


    /**
     * save method
     * @param array $data
     * @return bool
     * */
    protected function save($data)
    {
        $isInserted = $this->db->insert($this->tableName, $data);
        return $isInserted ? $this->db->insert_id() : false;
    }

    /**
     * saveTwoTables method
     * @param array $data
     * @return bool
     * */
    protected function saveTwoTables($tbname, $data)
    {
        $isInserted = $this->db->insert($tbname, $data);
        return $isInserted ? $this->db->insert_id() : false;
    }

    /**
     * update method
     * @param int $id
     * @param array $data
     * @return bool
     * */
    protected function update($id, $data)
    {
        $this->db->where('id', $id);
        $isInserted = $this->db->update($this->tableName, $data);
        return $isInserted;
    }

    /**
     * updateWhere method
     * @param array $where
     * @param array $data
     * @return bool
     * */
    protected function updateWhere($where, $data)
    {
        $this->db->where($where);
        $isInserted = $this->db->update($this->tableName, $data);
        return $isInserted;
    }

    /**
     * limited method
     * @param string $start
     * @param string $end
     * @return array
     * */
    protected function limited($start, $end)
    {
        $this->db->limit($start, $end);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    /**
     * total method
     * @param string $tblName
     * @return int
     * */
    protected function total($tblName = null)
    {
        if (!is_null($tblName))
            $this->tableName = $tblName;

        return $this->db->count_all($this->tableName);
    }


    /**
     * @param $id
     * @return mixed
     */
    protected function delete($id)
    {
        $this->db->where('id', $id);
        $isInserted = $this->db->delete($this->tableName);
        return $isInserted;
    }

    /**
     * @param $where
     */
    protected function deleteWhere($where)
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

        $result = $this->db->delete($this->tableName);
        return $this->db->last_query();

        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function selectEmail($id)
    {
        $this->db->select('email');
        $this->db->where('id', $id);
        $query = $this->db->get($this->tableName);
        return $query->row();

    }

    /**
     * @param $where
     * @return mixed
     */
    protected function numRows($where)
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
        } else
            $this->db->select('*');
        $this->db->where($where);
        $this->db->from($this->tableName);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * @param $id string
     */
    public function lastVisit($id)
    {
        $this->db->where('id', $id);
        
        
        
        $this->db->update('users', [
            'updated_day' => date("Y-m-d H:i:s")
        ]);
    }

}