<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pharmacy_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPharmacy($data) {
        $this->db->insert('pharmacy', $data);
    }

    function getPharmacy() {
        $query = $this->db->get('pharmacy');
        return $query->result();
    }

    function getPharmacyById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('pharmacy');
        return $query->row();
    }

    function updatePharmacy($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('pharmacy', $data);
    }

    function activate($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
    
     function deactivate($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('pharmacy');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getPharmacyId($current_user_id) {
        $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
        $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
        $group_name = strtolower($group_name);
        $pharmacy_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->pharmacy_id;
        return $pharmacy_id;
    }

}
