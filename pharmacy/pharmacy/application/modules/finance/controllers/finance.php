<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('finance_model');
        $this->load->model('client/client_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('settings/settings_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        redirect('finance/financial_report');
    }

    public function payment() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

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

        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['payments'] = $this->finance_model->getPaymentByPId($pharmacy_id);

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPaymentView() {
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
        $data['clients'] = $this->client_model->getClientByPId($pharmacy_id);
        $data['discount_type'] = $this->finance_model->getDiscountTypeByPId($pharmacy_id);
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['medicines'] = $this->medicine_model->getMedicineByPId($pharmacy_id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_payment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPayment() {
        $id = $this->input->post('id');
        $item_selected = array();
        $quantity = array();
        $item_selected = $this->input->post('medicine_id');
        $quantity = $this->input->post('quantity');

        if (empty($item_selected)) {
            $this->session->set_flashdata('feedback', 'Select a Item');
            redirect('finance/addPaymentView');
        } else {
            $item_quantity_array = array();
            $item_quantity_array = array_combine($item_selected, $quantity);
        }
        foreach ($item_quantity_array as $key => $value) {
            $unit_price = $this->db->get_where('medicine', array('id' => $key))->row()->s_price;
            $current_quantity = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
            $qty = $value;
            if (!empty($id)) {
                $current_payment = $this->finance_model->getPaymentById($id)->category_name;
                $current_payment1 = explode(',', $current_payment);
                foreach ($current_payment1 as $index => $current_payment2) {
                    $current_payment3 = explode('*', $current_payment2);
                    $current_quantity_with_current_sale = $current_quantity + $current_payment3[2];
                    if ($current_quantity_with_current_sale < $qty) {
                        $this->session->set_flashdata('sufficient', 'Error: You dont have sufficient quantity. Try Again.');
                        redirect('finance/addPaymentView');
                        die();
                    }
                }
            } elseif ($current_quantity < $qty) {
                $this->session->set_flashdata('sufficient', 'Error: You dont have sufficient quantity. Try Again.');
                redirect('finance/addPaymentView');
                die();
            }
            $item_price[] = $unit_price * $value;
            $category_name[] = $key . '*' . $unit_price . '*' . $qty;
        }

        $category_name = implode(',', $category_name);

        $client = $this->input->post('client');
        $date = time();
        $discount = $this->input->post('discount');
        $amount_received = $this->input->post('amount_received');

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

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Price Field
        $this->form_validation->set_rules('client', 'Patient', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo 'form validate noe nai re';
            // redirect('accountant/add_new'); 
        } else {
            $amount = array_sum($item_price);
            $sub_total = $amount;
            $discount_type = $this->finance_model->getDiscountTypeByPId($pharmacy_id);

            if ($discount_type == 'flat') {
                $flat_discount = $discount;
                $gross_total = $sub_total - $flat_discount;
            } else {
                $flat_discount = $amount * ($discount / 100);
                $gross_total = $sub_total - $flat_discount;
            }

            $data = array();
            if (empty($id)) {
                $data = array(
                    'category_name' => $category_name,
                    'client' => $client,
                    'date' => $date,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'status' => 'unpaid',
                    'pharmacy_id' => $pharmacy_id
                );
                $this->finance_model->insertPayment($data);
                $inserted_id = $this->db->insert_id();
                foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
                    $new_qty = $previous_qty - $value;
                    $this->db->where('id', $key);
                    $this->db->update('medicine', array('quantity' => $new_qty));
                }
                $this->session->set_flashdata('feedback', 'Added');
                redirect("finance/invoice?id=" . "$inserted_id");
            } else {
                $data = array(
                    'category_name' => $category_name,
                    'client' => $client,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'pharmacy_id' => $pharmacy_id
                );

                $original_sale = $this->finance_model->getPaymentById($id);
                $original_sale_quantity = array();
                $original_sale_quantity = explode(',', $original_sale->category_name);
                $o_s_value[] = array();
                foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
                    foreach ($original_sale_quantity as $osq_key => $osq_value) {
                        $o_s_value = explode('*', $osq_value);
                        if ($o_s_value[0] == $key) {
                            $previous_qty1 = $previous_qty + $o_s_value[2];
                            $new_qty = $previous_qty1 - $value;
                            $this->db->where('id', $key);
                            $this->db->update('medicine', array('quantity' => $new_qty));
                        }
                    }
                }
                $this->finance_model->updatePayment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                redirect("finance/invoice?id=" . "$id");
            }
        }
    }

    function editPayment() {
        if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
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
            $data['discount_type'] = $this->finance_model->getDiscountTypeByPId($pharmacy_id);
            $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
            $data['medicines'] = $this->medicine_model->getMedicineByPId($pharmacy_id);
            $id = $this->input->get('id');
            $data['payment'] = $this->finance_model->getPaymentById($id);
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_payment_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function delete() {
        if ($this->ion_auth->in_group('admin')) {
            $id = $this->input->get('id');
            $this->finance_model->deletePayment($id);
            $this->session->set_flashdata('feedback', 'Deleted');
            redirect('finance/payment');
        }
    }

    public function expense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
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
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['expenses'] = $this->finance_model->getExpenseByPId($pharmacy_id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseView() {
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
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['categories'] = $this->finance_model->getExpenseCategoryByPId($pharmacy_id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpense() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $date = time();
        $amount = $this->input->post('amount');

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

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
            $data['categories'] = $this->finance_model->getExpenseCategoryByPId($pharmacy_id);
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category' => $category,
                    'date' => $date,
                    'amount' => $amount,
                    'pharmacy_id' => $pharmacy_id,
                );
            } else {
                $data = array(
                    'category' => $category,
                    'amount' => $amount,
                    'pharmacy_id' => $pharmacy_id,
                );
            }
            if (empty($id)) {
                $this->finance_model->insertExpense($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updateExpense($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('finance/expense');
        }
    }

    function editExpense() {
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
        $data['categories'] = $this->finance_model->getExpenseCategoryByPId($pharmacy_id);
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $id = $this->input->get('id');
        $data['expense'] = $this->finance_model->getExpenseById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpense() {
        $id = $this->input->get('id');
        $this->finance_model->deleteExpense($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('finance/expense');
    }

    public function expenseCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
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
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['categories'] = $this->finance_model->getExpenseCategoryByPId($pharmacy_id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategoryView() {
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
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

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

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_category');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description,
                'pharmacy_id' => $pharmacy_id,
            );
            if (empty($id)) {
                $this->finance_model->insertExpenseCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updateExpenseCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('finance/expenseCategory');
        }
    }

    function editExpenseCategory() {
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
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['category'] = $this->finance_model->getExpenseCategoryById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpenseCategory() {
        $id = $this->input->get('id');
        $this->finance_model->deleteExpenseCategory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('finance/expenseCategory');
    }

    function invoice() {
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
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['discount_type'] = $this->finance_model->getDiscountTypeByPId($pharmacy_id);
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function amountReceived() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $previous_amount_received = $this->db->get_where('payment', array('id' => $id))->row()->amount_received;
        $amount_received = $amount_received + $previous_amount_received;
        $data = array();
        $data = array('amount_received' => $amount_received);
        $this->finance_model->amountReceived($id, $data);
        redirect('finance/invoice?id=' . $id);
    }

    function amountReceivedFromPT() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $payments = $this->finance_model->getPaymentByPatientId($id);
        foreach ($payments as $payment) {
            if ($payment->gross_total != $payment->amount_received) {
                $due_balance = $payment->gross_total - $payment->amount_received;
                if ($amount_received <= $due_balance) {
                    $data = array();
                    $new_amount_received = $amount_received + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->finance_model->amountReceived($payment->id, $data);
                    break;
                } else {
                    $data = array();
                    $new_amount_received = $due_balance + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->finance_model->amountReceived($payment->id, $data);
                    $amount_received = $amount_received - $due_balance;
                }
            }
        }
        redirect('finance/invoicePatientTotal?id=' . $id);
    }

    function todaySales() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
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
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['payments'] = $this->finance_model->getPaymentByDateByPId($today, $today_last, $pharmacy_id);

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('today_sales', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function todayExpense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
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
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $data['expenses'] = $this->finance_model->getExpenseByDateByPId($today, $today_last, $pharmacy_id);

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('today_expenses', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function salesPerMonth() {
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
        $payments = $this->finance_model->getPaymentByPId($pharmacy_id);
        foreach ($payments as $payment) {
            $date = $payment->date;
            $month = date('m', $date);
            $year = date('y', $date);
            if ($month = '01') {
                
            }
        }
    }

    function financialReport() {
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
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }
        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicineByPId($pharmacy_id);
        $data['expense_categories'] = $this->finance_model->getExpenseCategoryByPId($pharmacy_id);


        // if(empty($date_from)&&empty($date_to)) {
        //    $data['payments']=$this->finance_model->get_payment();
        //     $data['ot_payments']=$this->finance_model->get_ot_payment();
        //     $data['expenses']=$this->finance_model->get_expense();
        // }
        // else{

        $data['payments'] = $this->finance_model->getPaymentByDateByPId($date_from, $date_to, $pharmacy_id);
        $data['expenses'] = $this->finance_model->getExpenseByDateByPId($date_from, $date_to, $pharmacy_id);
        // } 
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('financial_report', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

}

/* End of file finance.php */
/* Location: ./application/modules/finance/controllers/finance.php */