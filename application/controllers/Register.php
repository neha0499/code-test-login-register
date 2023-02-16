<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function index()
    {
        // Load the form validation library
        $this->load->library('form_validation');

        // Set the validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('pincode', 'Pin-code', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            // If the form validation fails, show the registration form again
            $this->load->view('register');
        }
        else
        {
            // If the form validation passes, insert the user data into the database
            $data = array(
                'name' => $this->input->post('name'),
                'dob' => $this->input->post('dob'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'pincode' => $this->input->post('pincode'),
                'password' => '',
                'otp' => '',
                'is_active' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->load->model('user_model');
            $this->user_model->create_user($data);

            // Send credentials mail
            $this->load->library('email');

            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.gmail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'thakursuryaveersingh@gmail.com';
            $config['smtp_pass'] = '!@#$surya!@#$';
            $config['smtp_crypto'] = 'ssl';
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';

            $this->email->initialize($config);

            $this->email->from('thakursuryaveersingh@gmail.com', 'Thakur Suryaveer Singh');
            $this->email->to($data['email']);
            $this->email->subject('Registration Details');
            $this->email->message('Your registration is successful. Your username is ' . $data['email'] . ' and your password is ' . $data['password']);

            $this->email->send();

            redirect('login');
        }
    }
}
