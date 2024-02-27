<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Units
 *
 * @author Konjit
 */
class Units extends CI_Controller{
    public function index($offset = 0){
        $data['title'] = 'Units';
        // Pagination Config	
        $data['categories'] = $this->unit->get_categories();
        $config['base_url'] = base_url() . 'units/index/';
        $config['total_rows'] = $this->db->count_all('units');
        $config['per_page'] = 2;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');
        // Init Pagination
        $this->pagination->initialize($config);
        //$data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);
        $data['units'] = $this->unit->get_units(FALSE, $config['per_page'], $offset);
        if($this->session->userdata('logged_in')){
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $data['subcategories'] = $this->unit->get_subcategories();
        $this->load->view('templates/header', $data);
        $this->load->view('units/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function about()
    {
        $data['title'] = "About me";
        $data['categories'] = $this->unit->get_categories();
        if($this->session->userdata('logged_in'))
        {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $data['welcome'] = 'Welcome to TechWisdom, ';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/about', $data);
        $this->load->view('templates/footer');
        
    }
    
    public function aboutus()
    {
        $data['title'] = "About us";
        $data['categories'] = $this->unit->get_categories();
        if($this->session->userdata('logged_in'))
        {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $data['welcome'] = 'Welcome to TechWisdom, ';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/aboutus', $data);
        $this->load->view('templates/footer');
    }
    
    public function view( $id ){
        // $slug is the url version of the title.
        $data['welcome'] = 'Welcome to TechWisdom, ';
        $data['unit'] = $this->unit->get_units($id);
        $unit_id = $data['unit']['id'];
        if(empty($data['unit'])){
            show_404();
        }
        $data['categories'] = $this->unit->get_categories();
        $data['title'] = $data['unit']['title'];
        $data['comments'] = $this->unit->get_comments($unit_id);
        $data['image_name'] = $data['unit']['unit_img']; 
        if($this->session->userdata('logged_in'))
        {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $this->load->view('templates/header', $data);
        $this->load->view('units/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function create(){
        
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        $data['title'] = 'Create Unit';
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user->get_profile_name($user_id);
        $data['sum_units'] = $this->user->get_sum_units($user_id);  

        $data['categories'] = $this->unit->get_categories();
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');
        
        if($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('units/create', $data);
            $this->load->view('templates/footer'); 
        }
        else
        {
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $new_name = uniqid(rand());
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            //print_r("Value:".$this->upload->do_upload('userfile')); die();
            if(!$this->upload->do_upload('userfile'))
            {
                $image_path = 'noimg.jpg';
            } 
            else 
            {
                $data = $this->upload->data();
                $image_path = $data['file_name'];
            }
            $this->unit->insert_unit($image_path);
            $this->session->set_flashdata('units_created', 'You created an article successfuly!');
            redirect('units/');
        }
    }
    
    public function delete($id){
        //$data['unit'] = $this->unit->get_units($slug);
        $this->unit->delete_unit($id);
        redirect('units/');
    }
    
    public function upload_images()
    {
        $config = [
            'upload_path'   => './uploads/',
            'allowed_types' => 'gif|jpg|png',
            'overwrite' => TRUE,
            'max_size'      => 100,
            'max_width'     => 1024, //Mainly goes with images only
            'max_heigth'    => 768,
        ];

    $this->load->library('upload', $config);
    if( !$this->upload->do_upload() ){
        //echo 'Upload function not working'; die();
        $error = array("error" => $this->upload->display_errors());
        $unit_img = 'noimg.jpg';
    }else{
        $data = array('upload_data' => $this->upload->data());
        $unit_img = $_FILES['userfile']['name'];
    }
    return $unit_img;
    }
    
    public function edit( $slug ){
        
        $data['unit'] = $this->unit->get_units($slug);
        $data['categories'] = $this->unit->get_categories();
         $data['welcome'] = 'Welcome to TechWisdom, ';
        if($this->session->userdata('user_id') != $this->unit->get_units($slug)['user_id'])
        {
            redirect('units/');
        }
          if($this->session->userdata('logged_in'))
        {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $data['categories'] = $this->unit->get_categories();
        if(empty($data['unit'])){
            show_404();
        }
        $data['title'] = "Edit Units";
         $data['welcome'] = 'Welcome to TechWisdom, ';
        //$data['unit'] = $this->unit->edit_unit($id);
        $this->load->view('templates/header', $data);
        $this->load->view('units/edit', $data);
        $this->load->view('templates/footer');
        
        
        //redirect('units/view');
    }
    
    public function update()
    {
        $this->unit->edit_unit( );
        redirect('units/');
    }

    public function create_comment($unit_id)
    {
        $slug = $this->input->post('slug');
       // $data['unit'] = $this->unit->get_units($slug);
        
        $this->unit->insert_comment($unit_id);
        redirect('units/'.$slug);
        // form valdation goes here
    }
    
   public function search_units()
   {
       
       $data['title'] = 'Search Results';
       $data['categories'] = $this->unit->get_categories();
       $this->form_validation->set_rules('search', 'Search', 'required');
       
      /* if($this->form_validation->run() === FALSE)
       {
            $this->load->view('templates/header', $data);
            $this->load->view('units/index', $data);
            $this->load->view('templates/footer');
       }else{
           
       }*/
        // Pagination Config	
        /*$config['base_url'] = base_url() . 'units/index/';
        $config['total_rows'] = $this->db->count_all('units');
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');
        // Init Pagination
        $this->pagination->initialize($config);*/
        //$data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);
        $data['units'] = $this->unit->search_for_units();
         $data['welcome'] = 'Welcome to Wisdom, ';
         if($this->session->userdata('logged_in'))
        {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $this->load->view('templates/header', $data);
        $this->load->view('units/search_result', $data);
        $this->load->view('templates/footer');
        
    }

   public function get_subcategories()
   {
     
       $id = $this->input->post('id');
   
       $subcategories = $this->unit->get_subcategories_by($id);
       
       if( count($subcategories) > 0 )
       {
           //print_r('How many?'.count($subcategires));
           $pro_select_box = ' ';
           $pro_select_box .= '<option value="">Select SubCategory</option>';
           
           foreach($subcategories as $sub)
           {
               $pro_select_box .='<option value="'.$sub->id.'">'.$sub->name.'</option>'; 
               //$pro_select_box .='<option value="'.$province->province_id.'">'.$province->province_name.'</option>';
           }
        
           //print_r(json_encode($pro_select_box)); 
           echo json_encode($pro_select_box, JSON_FORCE_OBJECT);
       }
   }
 
}

