<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Konjit
 */
class Admin extends CI_Controller{
    //put your code here
    
    public function list_users(){
        $data ['title'] = 'All users';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/list_users', $data);
        $this->load->view('templates/footer', $data);
        
    }
}
