<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categories
 *
 * @author Konjit
 */
class Categories extends CI_Controller {

    //put your code here
    public function index() {

        $data['title'] = 'Categories';
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $data['categories'] = $this->unit->get_categories();
        $data['subcategories'] = $this->unit->get_subcategories();

        $this->load->view('templates/header', $data);
        $this->load->view('categories/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $data['title'] = "Create Category";
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $data['categories'] = $this->unit->get_categories();
        $data['welcome'] = 'Welcome to TechWisdom, ';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('categories/create', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $new_name = uniqid(rand());
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            //print_r("Value:".$this->upload->do_upload('userfile')); die();
            if (!$this->upload->do_upload('userfile')) {
                $image_path = 'noimg.jpg';
            } else {
                $data = $this->upload->data();
                $image_path = $data['file_name'];
            }
            $result = $this->unit->insert_category($image_path);
            /* if($result){
              $this->session->set_flashdata('activation_success', 'Your created a category successfully');
              }else{

              } */
            redirect('categories/create');
        }
    }

    public function create_subcategory() {
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $this->unit->create_subcategory();
        redirect('categories/create', $data);
    }

    public function subcategories($category_id) {
        $data['subcategories'] = $this->unit->get_subcategories_query($category_id);
        //return $data;
    }

    public function catsubcategories() {
        $category_id = $this->uri->segment(3);
        $data['title'] = $this->unit->get_category($category_id)->name;
        $data['title'] = "SubCategories";
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $data['categories'] = $this->unit->get_categories();
        //$data['category'] = $this->unit->get_category($category_id)->id;
        $data['subcategories'] = $this->unit->get_subcategories_query($category_id);
        $data['category_id'] = $category_id;

        $this->load->view('templates/header', $data);
        $this->load->view('categories/index', $data);
        $this->load->view('templates/footer');
    }

    public function units($id, $offset = 0) {
        //print_r("An id is well received ".$id);die();
        $data['title'] = "Units";
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }

        $data['subcategories'] = $this->unit->get_subcategories_units($id);

        $config['base_url'] = base_url() . 'categoires/index/';
        $config['total_rows'] = $this->db->count_all('units');
        $config['per_page'] = 2;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');
        // Init Pagination
        $this->pagination->initialize($config);
        $data['units'] = $this->unit->get_units_by_subcategory($config['per_page'], $offset, $id);
        $data['subcat_name'] = $this->uri->segment(4);
        $this->load->view('templates/header', $data);
        $this->load->view('units/index', $data);
        $this->load->view('templates/footer');
    }

}
