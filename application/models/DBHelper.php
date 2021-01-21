<?php
class DBHelper extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function select($select, $table, $where = false, $order_by = FALSE, $limit = FALSE, $offset = FALSE, $group_by = FALSE)
    {
        $this->db->select($select);
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($order_by)
            $this->db->order_by($order_by);
        if ($limit)
            $this->db->limit($limit);
        if ($offset)
            $this->db->offset($offset);
        if ($group_by)
            $this->db->group_by($group_by);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert($table, $data)
    {
        if ($this->db->insert($table, $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function update($table, $data, $where)
    {
        $this->db->where($where);
        if ($this->db->update($table, $data)) {
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            }
        }
        return false;
    }

    public function delete($table, $where)
    {
        if ($this->db->delete($table, $where)) {
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            }
        }
        return false;
    }

    public function data_exists($table, $where = FALSE, $or_where = FALSE)
    {
        $this->db->select('id');
        $this->db->from($table);
        if ($where)
            $this->db->where($where);
        if ($or_where)
            $this->db->or_where($or_where);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $query = $query->row();
            return $query->id;
        }
        return false;
    }

    public function count($table, $where = FALSE, $group_by = FALSE)
    {
        $this->db->select("COUNT(id) as numrows");
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($group_by) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get();
        $row = $query->row();
        if ($row != null && $row->numrows != null) {
            return $row->numrows;
        }
        return false;
    }

    public function last_query()
    {
        return $this->db->last_query();
    }
}
