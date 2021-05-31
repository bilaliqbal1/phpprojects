<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pharmacy extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('pharmacy_model');
        $this->load->library('upload');
        $this->load->model('ion_auth_model');
        $this->lang->load('system_syntax');
        $this->load->model('settings/settings_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } 
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['pharmacys'] = $this->pharmacy_model->getPharmacy();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('pharmacy', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("pharmacy/editPharmacy?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone
            );

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Pharmacy
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('pharmacy/addNewView');
                } else {
                    $dfg = 1;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->pharmacy_model->insertPharmacy($data);
                    $pharmacy_user_id = $this->db->get_where('pharmacy', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->pharmacy_model->updatePharmacy($pharmacy_user_id, $id_info);
                    $pharmacy_settings_data = array();
                    $pharmacy_settings_data = array('pharmacy_id' => $pharmacy_user_id,
                        'title' => $name,
                        'email' => $email,
                        'address' => $address,
                        'phone' => $phone,
                        'system_vendor' => 'Code Aristos | Pharmacy management System',
                        'discount' => 'flat',
                        'currency' => '$'
                    );
                    $this->settings_model->insertSettings($pharmacy_settings_data);
                    $this->session->set_flashdata('feedback', 'New Pharmacy Created');
                }
            } else { // Updating Pharmacy
                $ion_user_id = $this->db->get_where('pharmacy', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->pharmacy_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->pharmacy_model->updatePharmacy($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('pharmacy');
        }
    }

    function getPharmacy() {
        $data['pharmacys'] = $this->pharmacy_model->getPharmacy();
        $this->load->view('pharmacy', $data);
    }
    
    function activate(){
        $pharmacy_id = $this->input->get('pharmacy_id');
        $data = array('active' => 1);
        $this->pharmacy_model->activate($pharmacy_id, $data);
        $this->session->set_flashdata('feedback', 'Activated');
        redirect('pharmacy');
    }
    
    function deactivate(){
        $pharmacy_id = $this->input->get('pharmacy_id');
        $data = array('active' => 0);
        $this->pharmacy_model->deactivate($pharmacy_id, $data);
        $this->session->set_flashdata('feedback', 'Deactivated');
        redirect('pharmacy');
    }

    function editPharmacy() {
        $data = array();
        $id = $this->input->get('id');
        $data['pharmacy'] = $this->pharmacy_model->getPharmacyById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPharmacyByJason() {
        $id = $this->input->get('id');
        $data['pharmacy'] = $this->pharmacy_model->getPharmacyById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('pharmacy', array('id' => $id))->row();
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->pharmacy_model->delete($id);
        redirect('pharmacy');
    }

}

/* End of file pharmacy.php */
/* Location: ./application/modules/pharmacy/controllers/pharmacy.php */
