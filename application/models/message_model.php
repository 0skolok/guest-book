<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class message_model extends CI_Model
{
    protected $table = 'message';
    protected $ordered_field = 'e_mail';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_entry($params)
    {
        $fields = array(
            'user_ip' => $params['ip_address'],
            'user_browser' => $params['agent'],
            'created_date' => date('Y-m-d H:i:s'),
            'username' => $params['username'],
            'e_mail' => $params['email'],
            'text' => $params['text'],
        );

        $this->db->insert($this->table, $fields);
    }

    public function get_entries() {
        $this->db->select('id, created_date, username, text');
        $this->db->from($this->table);
        $this->db->order_by('created_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetch_entries($limit, $start) {
        $this->db->select('id, created_date, username, text');
        $this->db->from($this->table);
        $this->db->order_by('created_date', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function delete_entry($id){
        $this->db->delete($this->table, array('id' => $id));
    }

    public function entry_count_all() {
        return $this->db->count_all($this->table);
    }

    public function get_entry($name, $email) {
        $this->db->select('id, created_date');
        $this->db->from($this->table);
        $this->db->where('username', $name);
        $this->db->where('e_mail', $email);
        $this->db->order_by('created_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}