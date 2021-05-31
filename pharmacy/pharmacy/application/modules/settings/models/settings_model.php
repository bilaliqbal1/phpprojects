<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSettings($pharmacy_settings_data) {
        $this->db->insert('settings', $pharmacy_settings_data);
    }

    function getSettingsByPId($pharmacy_id) {
        $this->db->where('pharmacy_id', $pharmacy_id);
        $query = $this->db->get('settings');
        return $query->row();
    }

    function updateSettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('settings', $data);
    }

}
