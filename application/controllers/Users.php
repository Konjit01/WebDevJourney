<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author Konjit
 */
class Users extends CI_Controller {
    /* REGISTER USER */
    public function register() {

        if($this->session->userdata('logged_in')){
            redirect('units/');
        }
        $data['title'] = "Sign up";
        $data['categories'] = $this->unit->get_categories();

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|callback_check_if_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_if_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Conform Password', 'trim|matches[password]');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('users/signup', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $new_name = uniqid(rand()) . $this->input->post('userfile');
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $image_path = 'avatar.jpg';
            } else {
                $data = $this->upload->data();
                $image_path = $data['file_name'];
            }
            $result = $this->user->register_user($image_path);
            if ($result === NULL) {
                $this->session->set_flashdata('registered_into_db_failed', 'Sorry, error occurred during registration try later.');
                redirect('users/register');
            } else if ($result === TRUE) {

                $this->session->set_flashdata('check_email', 'Please check your email, a link has been sent for activation!');
                redirect('users/register');
                //$this->user->activate_user();
            } else {

                $this->session->set_flashdata('user_registered', 'You are registered successfuly!');
                redirect('users/login');
            }
        }
    }

    /* ACTIVATE USER WITH VALID E-MAIL ADDRESS */

    public function activate() {

        $id = $this->uri->segment(3);
        $code = $this->uri->segment(4);
        $user = $this->user->get_user($id);
        //echo 'activate user id' .$id; die();
        if ($user['code'] == $code) {
            $query = $this->user->activate_user($id);
            if ($query) {
                $this->session->set_flashdata('activation_success', 'Your account is activated successfully, you can login now');
                redirect('users/login');
            } else {
                $this->session->set_flashdata('activation_failure', 'Could not activate your account please try after few minutes ');
                redirect('users/register');
            }
        } else {
            $this->session->set_flashdata('code_mismatch', 'Cannot activate account. Code didnt match');
            redirect('users/register');
        }
    }

    /* VERIFY USER AND LET LOGIN */

    public function login() {

        if($this->session->userdata('logged_in')){
            redirect('categories/');
        }
        $data['title'] = "Sign in";
        $data['categories'] = $this->unit->get_categories();
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {
            $result = $this->user->verify();
            $data['user'] = $this->user->get_user($result);
            //    print_r("User:".$data['user']); die();
            if ($result === -1) {
                $this->session->set_flashdata('account_inactive', 'Your account is not activated or verified!');
                redirect('users/login');
            } else if ($result === 0) {
                $this->session->set_flashdata('email_not_found', 'The username or the password is not correct!');
                redirect('users/login');
            } else {
                if ($result) {    // Create a session for the logged in user
                    $user_data = array(
                        'user_id' => $result,
                        'username' => $this->input->post('username'),
                        'first_name' => $data['user']['first_name'],
                        'last_name' => $data['user']['last_name'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('user_login_success', 'You are logged in successfuly!');
                    redirect('categories/');
                } else {
                    $this->session->set_flashdata('user_login_failed', 'The username or the password is not correct!');
                    redirect('users/login');
                }
            }
        }
    }

    // --------PROFILE SETTEINGS FOR USER NOT FULLY IMPELMENTED--------------
    public function profile_settings() {
      
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $data['title'] = "Profile Setting";
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user->get_profile_name($user_id);
        $this->load->view('templates/header', $data);
        $this->load->view('users/profile', $data);
        $this->load->view('templates/footer');
    }

    public function change_password() {
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }

        $this->form_validation->set_rules('prevpwd', 'Password', 'required');
        $this->form_validation->set_rules('newpwd', 'CPassword', 'required');
        $this->form_validation->set_rules('cnewpwd', 'Conform Password', 'matches[password]');
        $bool_val = $this->user->change_password($user_id);
        if ($bool_val == false) {

            $this->session->set_flashdata('pwd_incorrect', 'The password you provided is not correct!');
        }
        if ($bool_val == true) {
            $this->session->set_flashdata('pwd_changed', 'Your password has been changed!');
        }
        redirect('users/profile_settings');
    }

    // -------PASSWORD OR ACCONUT RECEVORY------------- 
    public function password_recovery() {
        // Validation ??
        $result = $this->user->password_recovery();

        if ($result) {

            $this->session->set_flashdata('password_email', 'Please check your email to recvover your password!');
            redirect('users/login');
        } else {
            $this->session->set_flashdata('password_email_wrong', 'The email you entered is not found in our system please provide the correct email!');
            redirect('users/login');
        }
    }

    //----------PART OF RECOVERY-------------------
    public function update_user_pwd() {

        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('cpwd', 'Conform Password', 'trim|matches[pwd]');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/pwd_recovery', $data);
            $this->load->view('templates/footer');
        } else {
            $result = $this->user->update_password($id);
            if ($result === true) {
                $this->session->set_flashdata('pwd_updated_success', 'Your password is updated now you can login now!');
            }if ($result === false) {
                $this->session->set_flashdata('pwd_updated_failed', 'Your password is not updated!');
            }
        }
        redirect('users/login');
    }

    // ----------GET USER ID--------------
    public function update_password() {
        $data['id'] = $this->uri->segment(3);
        $data['code'] = $this->uri->segment(4);
        $this->load->view('templates/header');
        $this->load->view('users/pwd_recovery', $data);
        $this->load->view('templates/footer');
    }

    // --------LOGOUT THE USER ----------------
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('user_logged_out', 'You are logged out successfuly!');
        redirect('users/login');
    }

    // -----DELETE USER PERMANTELY------------ 
    public function delete_account() {

        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $this->form_validation->set_rules('pwd_delete', 'Password', 'required|callback_check_password_match');
            $bool_val = $this->user->delete_account($user_id);
            if ($bool_val == false) {
                $this->session->set_flashdata('pwd_no_match', 'Your password did not match and cannot delete your account!');
                redirect('users/profile_settings');
            }
            if ($bool_val == true) {
                $this->session->unset_userdata('logged_in');
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('username');
                $this->session->set_flashdata('account_delete', 'Your account has been deleted!');
                redirect('users/login');
            }
        } else {
            redirect('users/login');
        }
    }

    /* VALIDATION FUNCTIONS --HELPERS */

    public function check_if_username_exists($username) {
        $this->form_validation->set_message('check_if_username_exists', 'That username is taken!');

        if ($this->user->check_username_exists($username)) {
            return false;
        } else {
            return true;
        }
    }

    public function check_if_email_exists($email) {
        $this->form_validation->set_message('check_if_email_exists', 'That email is already registerd!');

        if ($this->user->check_username_exists($email)) {
            return false;
        } else {
            return true;
        }
    }

    public function check_password_match() {
        $this->form_validation->set_message('check_password_match', 'That password did not match!');
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            //$data['user'] = $this->user->get_profile_name($user_id);
        }
        $result = $this->user->check_password_match($user_id);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //---------CHNAGE PROFILE PIC------------
    public function change_profile_pic() {   
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $new_name = uniqid(rand()) . $this->input->post('userfile');
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {
            $image_path = $data['user']['profile_pic']; 
        } else {
            $data = $this->upload->data();
            $image_path = $data['file_name'];
        }
        $result = $this->user->change_profile_pic($user_id, $image_path);
        if ($result === false) {
            $this->session->set_flashdata('pic_updated_unsuccess', 'Your profile picture is not updated.');
        } else if ($result === TRUE) {
            $this->session->set_flashdata('pic_updated_success', 'Your profile picture is updated!');
        } redirect('users/profile_settings');
    }
    
    // Lastly add
    
    public function user_details(){
        $id = $this->uri->segment(3);
        //print_r('$id'.$id); die();
        $data['user_details'] = $this->user->get_user($id);
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $this->load->view('templates/header', $data);
        $this->load->view('users/user_details', $data);
        $this->load->view('templates/footer');
    }

}
