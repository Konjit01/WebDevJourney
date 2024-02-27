<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Konjit
 */
class User extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // -------------REGISTER USER INTO DATABASE------------------
    public function register_user($profile_pic) {

        $first = $this->input->post('first_name');
        $last = $this->input->post('last_name');
        $uname = $this->input->post('username');
        $email = $this->input->post('email');
        $pwd = $this->input->post('password');
        $enc_pwd = md5($pwd);
        $profile = $profile_pic;
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($set), 0, 12);
        //$acitvated = 0;
        $data = array('first_name' => $first,
            'last_name' => $last,
            'username' => $uname,
            'email' => $email,
            'password' => $enc_pwd,
            'profile_pic' => $profile,
            'activated' => 0,
            'code' => $code
        );
        $id = $this->insert($data);
        if ($this->db->affected_rows() === 1) {
            //$this->set_session($first, $last, $email);
            $session_id = $this->session->userdata('session_id');
            
            //var_dump($this->session->all_userdata()); //die();
            $result = $this->send_verification($id, $email, $pwd, $code);
            if ($result === NULL) {
                return NULL;
            } else {
                return true;
            }
        } else {
            $to = 'konjitweldesenbet2017@gmail.com';
            $subject = "Registration Issue";
            $headers = "From: TechWisdom <kkll6349@gmail.com>\r\n";
            $headers .= "Replay-To: kkll6349@gmail.com\r\n";
            $headers .= "Content-type: text/html\r\n";

            if (isset($email)) {
                $message = "User with email .'$email'. cannot register.";
            } else {
                $message = "Unable to register a user into database.";
            }
            mail($to, $subject, $message, $headers);
            return NULL;
        }
    }

    //-------------SET USER SESSION---------------------------------
    public function set_session($first, $last, $email) {

        $sql = " SELECT * FROM `users` WHERE `users`.`email` = '" . $email . "';";
        $result = $this->db->query($sql);
        $row = $result->row();

        $sess_data = array(
            'user_id' => $row->id,
            'first_name' => $first,
            'last_name' => $last,
            'email' => $email,
            'logged_in' => 0
        );
        $this->session->set_userdata($sess_data);
        print_r('In set-session');
    }

    // ----------SEND EMAIL TO USER TO VERIFY-----------------------
    public function send_verification($id, $email, $password, $code) {
        $to = $email;
        $subject = "Activate your account";
        $message = '<p>Thank you for registering to TechWisdom</p>';
        $message .= "<p>Your Account:</p>
					<p>Email: " . $email . "</p>
				    <p>Please click the link below to activate your account.</p>";

        $message .= "<h4><a href='" . base_url() . "users/activate/" . $id . "/" . $code . "'>Activate My Account</a></h4>";

        $headers = "From: TechWisdom <konjitweldesenbet2017@gmail.com>\r\n";
        $headers .= "Replay-To: konjitweldesenbet2017@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        $is_successful = mail($to, $subject, $message, $headers);

        if ($is_successful === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // ---------ACTIVATE USER--------------------------------
    public function activate_user($id) {
        $sql = "UPDATE `users` SET `activated`= 1 WHERE `id` = $id;";
        $this->db->query($sql);
        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            return NULL;
        }
    }

    public function insert($user) {
        $this->db->insert('users', $user);
        return $this->db->insert_id();
    }

    public function get_user($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    // ----------CREDENTIAL VERFICATION----------------------------
    public function verify() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $sql = "SELECT * FROM `users` WHERE (`users`.`username` = '$username' OR `users`.`email`='$username') AND `users`.`password`='$password';";

        $result = $this->db->query($sql);
        if ($result->num_rows() == 1) {
            if ($result->row(0)->activated == 1) {
                return $result->row(0)->id;
            }
            if ($result->row(0)->activated == 0) {
                return -1;
            }
        } else {
            return 0;
        }
    }
    //----------CHECKS IF E-MAIL PROVIDED DOES  EXIT ALREADY-----
    public function email_exists() {
        $email = $this->input->post('email_recovery');
        $sql = "SELECT * FROM `users` WHERE `users`.`email` = '$email';";
        $result = $this->db->query($sql);
        if ($result->num_rows() == 1) {
            //echo "username".$result->row(0)->username; die();
            return $result;
        } else {
            return false;
        }
    }

        // ------PASSWORD RECOVERY-----------------------------------------
    public function password_recovery() {
        $email = $this->input->post('email_recovery');
        $sql = "SELECT * FROM `users` WHERE `email` = '$email';";
        $result = $this->db->query($sql);

        if ($result->num_rows() === 1) {
            $to = $email;
            $id = $result->row(0)->id;
            $code = $result->row(0)->code;

            // Email configuration
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'konjitweldesenbet2017@gmail.com',
                'smtp_pass' => 'jbyp zvwu dpdv qizu', // Use App Password if two-factor authentication is enabled
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            );
            $this->load->library('email', $config);

            // Email content
            $this->email->from('konjitweldesenbet2017@gmail.com', 'TechWisdom');
            $this->email->to($to);
            $this->email->subject('Recover Your Account');
            $this->email->message('<p>You requested for password recovery @ TechWisdom</p>
                <p>Your Account:</p>
                <p>Email: ' . $email . '</p>
                <p>Please click the link below to recover your account.</p>
                <h4><a href="' . base_url() . 'users/update_password/' . $id . '/' . $code . '">Recover My Account</a></h4>');

            // Send email
            $is_successful = $this->email->send();

            // Check if the email was sent successfully
            if ($is_successful) {
                echo "Email sent successfully!";
            } else {
                echo "Email sending failed. Error: " . $this->email->print_debugger(); die();
            }
        }
    }


    public function update_password($id) {
        $pwd = $this->input->post('pwd');
        $new_pwd = md5($pwd);
        $query = $this->db->get_where("users", array("id" => $id));

        if ($query->num_rows() > 0) {
            $sql = "UPDATE `users` SET `password` =  '$new_pwd' WHERE `id` = '$id'; ";
            $this->db->query($sql);
            if ($this->db->affected_rows() === 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function check_email_exists($email) {

        $sql = "SELECT * FROM `users` WHERE `email` = '$email';";
        $query = $this->db->query($sql);

        if ($query->row_array() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function check_username_exists($username) {
        //$username = $this->input->post('username');

        $sql = "SELECT * FROM `users` WHERE `username` = '$username';";
        $query = $this->db->query($sql);

        if ($query->row_array() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /* Getting user profile name */

    public function get_profile_name($user_id) {
        $this->db->where('id', $user_id);
        $result = $this->db->get('users');
        return $result->row_array();
    }

    public function change_password($user_id) {
        $prev_pwd = $this->input->post('prevpwd');
        $new_pwd = $this->input->post('newpwd');
        $enc_prev_pwd = md5($prev_pwd);
        $query = $this->db->get_where("users", array("id" => $user_id));

        if ($query->num_rows() == 0) {
            return false;
        } else {

            /* $query = $this->db->get_where("users", array("password"=> '$enc_prev_pwd'));
              if( $query->num_rows() == 0 )
              {
              echo('here'); die();
              return false;
              }
              else
              { */
            $enc_new_pwd = md5($new_pwd);
            $sql = "UPDATE `users` SET `password` = '$enc_new_pwd' WHERE `id` = $user_id;";
            $this->db->query($sql);
            return true;
            //}
        }
    }

    public function check_password_match($user_id, $enc_pwd) {
        $query = "SELECT * FROM `users` WHERE `id` = $user_id;";
        $result = $this->db->query($query);
        if ($result->num_rows() === 1) {
            $password = $result->row(0)->password;
            print_r("From db " . $password);
            if ($password === $enc_pwd) {
                return true;
            } else {
              return false;
            }
        } else {
            return false;
        }
    }

    public function get_sum_units($user_id) {
        return $this->db->where(['user_id' => $user_id])->from('units')->count_all_results();
    }
    public function delete_account($user_id){
        $pwd = $this->input->post('pwd_delete');
        $enc_pwd = md5($pwd);
        
        if($this->check_password_match($user_id,  $enc_pwd) )
        {
            $sql = "DELETE TABLE `users` WHERE `id` = '".$user_id."';";
            $this->db->query($sql);
            if( $this->db->affected_rows() === 1){
               return true;
            }
            }else {
                return false;
            }
        
    }
    //-------------UPDATE PROFILE PICTURE------
   public function change_profile_pic($user_id, $image_path){
       
       $sql = "SELECT * FROM `users` WHERE `id` = $user_id;";
        $result = $this->db->query($sql);
        if ($result->num_rows() === 1) {
            $sql = "UPDATE `users` SET `profile_pic` = '$image_path' WHERE `id` = $user_id;";
            $this->db->query($sql);
            if ($this->db->affected_rows() === 1) {
                return true;
            }
        } else {
            return false;
        }
    }

}
