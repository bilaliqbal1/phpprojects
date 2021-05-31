<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('client_model');
        $this->lang->load('system_syntax');
        $this->load->library('upload');
        $this->load->model('settings/settings_model');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {
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
        $data['clients'] = $this->client_model->getClientByPId($pharmacy_id);
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('client', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
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
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $doctor = $this->input->post('doctor');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $birthdate = $this->input->post('birthdate');
        $bloodgroup = $this->input->post('bloodgroup');
        $client_id = $this->input->post('p_id');
        if (empty($password)) {
            $password = 'client12345';
        }
        if (empty($client_id)) {
            $client_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('client', array('id' => $id))->row()->add_date;
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

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');





        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("client/editClient?id=$id");
            } else {
                $data = array();
                $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {


            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'client_id' => $client_id,
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'add_date' => $add_date,
                'pharmacy_id' => $pharmacy_id,
            );


            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Client
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('client/addNewView');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->client_model->insertClient($data);
                    $client_user_id = $this->db->get_where('client', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->client_model->updateClient($client_user_id, $id_info);
                    $this->session->set_flashdata('feedback', 'Added');
                }
            } else { // Updating Client
                $ion_user_id = $this->db->get_where('client', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->client_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->client_model->updateClient($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('client');
        }
    }

    function getClient() {
        $data['client'] = $this->client_model->getClientByPId();
        $this->load->view('client', $data);
    }

    function editClient() {
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
        $data['client'] = $this->client_model->getClientById($id);
        $data['settings'] = $this->settings_model->getSettingsByPId($pharmacy_id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editClientByJason() {
        $id = $this->input->get('id');
        $data['client'] = $this->client_model->getClientById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('client', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->client_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('client');
    }

}

/* End of file client.php */
    /* Location: ./application/modules/client/controllers/client.php */
    