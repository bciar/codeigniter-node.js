<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    /**
     * @var string $tableName
     * This is the current table name for model
     * */
    protected $tableName;
    /**
     * Append callers __call and __callStatic
     * */
    use CallerTrait;
    /**
     * Append model standard methods like (all,oneBiId,oneWhere ....)
     * */
    use HelperModelTrait;

    /**
     * MY_Model constructor.
     * @param null $tableName
     */
    public function __construct($tableName = null)
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @param $row
     * @param string $type
     * @return $this
     */
    public function order($row,$type="asc")
    {
        $this->db->order_by($row,$type);
        return $this;
    }

    /**
     * @param $row
     * @param $value
     * @return $this
     */
    public function where($row,$value)
    {
        $this->db->where($row,$value);
        return $this;
    }

    /**
     * @param string $row
     * @return $this
     */
    public function group($row = "id")
    {
        $this->db->group_by($row);
        return $this;
    }

    /**
     * @param string $select
     * @return mixed
     */
    public function get($select = '*'){
        $this->db->select($select);
        return $this->db->get($this->tableName)->result();
    }
}
