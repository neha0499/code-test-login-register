<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function register_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
    
    public function get_user_by_email($email) {
        return $this->db->get_where('users', array('email' => $email))->row();
    }
    
    public function get_user_by_id($id) {
        return $this->db->get_where('users', array('id' => $id))->row();
    }
    
    public function activate_user($id) {
        $this->db->where('id', $id);
        $this->db->update('users', array('is_active' => 1));
    }
    
    public function set_password($id, $password) {
        $this->db->where('id', $id);
        $this->db->update('users', array('password' => password_hash($password, PASSWORD_DEFAULT)));
    }
    
    public function set_otp($id, $otp) {
        $this->db->where('id', $id);
        $this->db->update('users', array('otp' => $otp));
    }
    
    public function get_user_by_otp($otp) {
        return $this->db->get_where('users', array('otp' => $otp))->row();
    }
    
}
?>

