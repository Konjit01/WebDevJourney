<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pages
 *
 * @author Konjit
 */
class Pages extends CI_Controller{
    //put your code here
    public function view($page = 'home'){
        // Checks if a view exists of this page
        // APPPATH: is a codeignitor const that gives the path to the application folder
        if( !file_exists(APPPATH.'views/pages/'.$page.'.php') ){
            show_404(); 
        }
        
        if( $this->session->userdata('logged_in') ) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $data['title'] = ucfirst($page); // represents variables that we want to pass to the view
        $data['categories'] = $this->unit->get_categories();
        redirect('https://localhost/wisdom/users/login');
        /*$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');*/
    }

}
    

