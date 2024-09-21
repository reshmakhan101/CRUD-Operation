<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

//retrive user from db while applying specified sorting
public function get_users($limit, $offset, $sort_column = 'id', $sort_order = 'ASC') {
    $this->db->order_by($sort_column, $sort_order); 
    return $this->db->get('users', $limit, $offset)->result_array();
}


    public function count_users() {
        return $this->db->count_all('users');
    }

    public function create_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user($id) {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function update_user($id, $data) {
        return $this->db->update('users', $data, ['id' => $id]);
    }    

    public function delete_user($id) {
        return $this->db->delete('users', ['id' => $id]);
    }
     
    public function get_user_by_email_or_phone($email, $phone, $exclude_id = null) {
        $this->db->group_start();
        if ($email) $this->db->where('email', $email);
        if ($phone) $this->db->where('phone', $phone);
        $this->db->group_end();
        if ($exclude_id) {               
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->get('users')->row_array();
    }
}

