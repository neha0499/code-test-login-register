<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    private $password = '';
    public function register() {
        $this->load->view('header');

        $this->load->model('user_model');
        $data = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('pincode', 'Pin-code', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            // If the form validation fails, show the registration form again
            $this->load->view('registration_form');
        }
        else
        {
            $this->password = $this->randomPassword();
            $data['password'] = password_hash($this->password, PASSWORD_DEFAULT);
            $data['otp'] = rand(100000, 999999);
            $id = $this->user_model->register_user($data);
            $user = $this->user_model->get_user_by_email($data['email']);
            $this->send_credentials_mail($user->name, $user->email, $user->otp, $this->password );
            $this->load->view('registration_success');
        }
        $this->load->view('footer');
      
    }
    
    public function login() {
        $this->load->view('header');
        $this->load->model('user_model');
        $user_id = $this->session->userdata('user_id');
        if(empty($user_id)){
            $this->load->view('login_form');
        }else{
            redirect('/dashboard');
        }

        $data = $this->input->post();
        if(!empty( $data)){
            $user = $this->user_model->get_user_by_email($data['email']);
            if ($user && password_verify($data['password'], $user->password)) {
                if ($user->is_active) {
                    $this->session->set_userdata('user_id', $user->id);
                    redirect('/dashboard');
                    // $this->load->view('dashboard');
                } else {
                    redirect('activate-account');
                }
            } else {
                $this->load->view('login_error');
            }
        }
        $this->load->view('footer');

    }
    public function dashboard() {
        $this->load->view('header');
        $this->load->model('user_model');        
        $user_id = $this->session->userdata('user_id');
        if(!empty($user_id)){
            $this->load->view('dashboard');
        }else{
            redirect('/login');
        }
        $this->load->view('footer');

    }
    public function activate_account() {
        $this->load->view('header');
        $this->load->model('user_model');
        
        $data = $this->input->post();
        if(!empty( $data)){
            $user = $this->user_model->get_user_by_otp($data['activation_code']);
            if ($user) {
                $this->user_model->activate_user($user->id);
                $this->session->set_userdata('user_id', $user->id);
                $this->load->view('password_change_form');
            } else {
                $this->load->view('activation_error');
            }
        }else{
            $this->load->view('activate_account_form');
        }
        $this->load->view('footer');

    }

    public function password_change_form(){
        $this->load->view('header');
        $this->load->model('user_model');

        $data = $this->input->post();
        if(!empty( $data)){
            $user_id = $this->session->userdata('user_id');
            $user_data = $this->user_model->get_user_by_id($user_id);
            if ($user_data && password_verify($data['current_password'], $user_data->password)) {
                $this->user_model->set_password($user_id, $data['new_password']);
            }else{
                echo "Old Password not matched!";
            }
            $this->load->view('password_changed');
        }else{
            $this->load->view('activate_account_form');
        }
        $this->load->view('footer');

    }

    public function change_password() {
        $this->load->view('header');
        $this->load->model('user_model');

        $data = $this->input->post();
        $user_id = $this->session->userdata('user_id');
        $this->user_model->set_password($user_id, $data['password']);
        $this->load->view('password_changed');
        $this->load->view('footer');

    }
    
    public function reset_password() {
        $this->load->view('header');
        $this->load->model('user_model');

        $data = $this->input->post();
        $user = $this->user_model->get_user_by_email($data['email']);
        if ($user) {
            $otp = rand(100000, 999999);
            $this->user_model->set_otp($user->id, $otp);
            $this->send_reset_password_mail($user->name, $user->email, $otp);
            $this->load->view('reset_password_success');
        } else {
            $this->load->view('reset_password_error');
        }
        $this->load->view('footer');

    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
    private function send_credentials_mail($name, $email, $otp, $password) {
        // Send an email to the user with their login credentials
        echo "Activation Code: ".$otp."<br>";
        echo "First Time Login Password: ".$password."<br>";
    }
    
    private function send_reset_password_mail($name, $email, $otp) {
        // Send an email to the user with a password reset link
    }
    private function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
}
?>
