<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPayment($data) {
        $this->db->insert('payment', $data);
    }

    function getPaymentByPId($pharmacy_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('pharmacy_id', $pharmacy_id);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment');
        return $query->row();
    }

    function updatePayment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }

    function deletePayment($id) {
        $this->db->where('id', $id);
        $this->db->delete('payment');
    }

    function insertExpense($data) {
        $this->db->insert('expense', $data);
    }

    function getExpenseByPId($pharmacy_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('pharmacy_id', $pharmacy_id);
        $query = $this->db->get('expense');
        return $query->result();
    }

    function getExpenseById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense');
        return $query->row();
    }

    function updateExpense($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense', $data);
    }

    function insertExpenseCategory($data) {
        $this->db->insert('expense_category', $data);
    }

    function getExpenseCategoryByPId($pharmacy_id) {
        $this->db->where('pharmacy_id', $pharmacy_id);
        $query = $this->db->get('expense_category');
        return $query->result();
    }

    function getExpenseCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense_category');
        return $query->row();
    }

    function updateExpenseCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense_category', $data);
    }

    function deleteExpense($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense');
    }

    function deleteExpenseCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense_category');
    }

    function getDiscountTypeByPId($pharmacy_id) {
        $this->db->where('pharmacy_id', $pharmacy_id);
        $query = $this->db->get('settings');
        return $query->row()->discount;
    }

    function getPaymentByDateByPId($date_from, $date_to, $pharmacy_id) {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('pharmacy_id', $pharmacy_id);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getExpenseByDateByPId($date_from, $date_to, $pharmacy_id) {
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('pharmacy_id', $pharmacy_id);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function amountReceived($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('payment', $data);
    }

    function todaySalesAmount($pharmacy_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['payments'] = $this->getPaymentByDateByPId($today, $today_last, $pharmacy_id);

        foreach ($data['payments'] as $sales) {
            $sales_amount[] = $sales->gross_total;
        }
        if (!empty($sales_amount)) {
            return array_sum($sales_amount);
        } else {
            return 0;
        }
    }

    function todayExpensesAmount($pharmacy_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['payments'] = $this->getExpenseByDateByPId($today, $today_last, $pharmacy_id);

        foreach ($data['payments'] as $expenses) {
            $expenses_amount[] = $expenses->amount;
        }
        if (!empty($expenses_amount)) {
            return array_sum($expenses_amount);
        } else {
            return 0;
        }
    }

}
