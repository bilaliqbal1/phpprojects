<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('medicine/medicine_model');
        $this->load->model('finance/finance_model');
        $this->load->model('settings/settings_model');
        $this->load->model('pharmacy/pharmacy_model');
        $this->load->model('home_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
        if (!$this->ion_auth->in_group('superadmin')) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $pharmacy_id = $this->db->get_where('pharmacy', array('ion_user_id' => $current_user_id))->row()->id;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $pharmacy_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->pharmacy_id;
            }
            $data = array();
            $data['medicines'] = $this->medicine_model->getMedicineByPId($pharmacy_id);
            $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
            $data['payments'] = $this->finance_model->getPaymentByPId($pharmacy_id);
            $data['expenses'] = $this->finance_model->getExpenseByPId($pharmacy_id);
            $data['today_sales_amount'] = $this->finance_model->todaySalesAmount($pharmacy_id);
            $data['today_expenses_amount'] = $this->finance_model->todayExpensesAmount($pharmacy_id);
            $data['sum'] = $this->home_model->getSum('gross_total', 'payment');
        } else {
            redirect('pharmacy');
        }
        $this->load->view('dashboard', $data); // just the header file
        $this->load->view('home', $data);
        $this->load->view('footer');
    }

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
