<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Questions
 *
 * @author Konjit
 */
class Questions extends CI_Controller{
    //put your code here
    
     public function index(){
         
        $data['title'] = "All Questions";
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user->get_profile_name($user_id);
        $data['questions'] = $this->question->get_questions();    
        $this->load->view('templates/header', $data);
        $this->load->view('questions/index', $data);
        $this->load->view('templates/footer'); 
        
    }
    public function ask(){
        
         if(!$this->session->userdata('logged_in')){
             $this->session->set_flashdata('questionlog', 'You have to login to ask questions.');
             
            redirect('users/login');
        }
        $data['title'] = 'Ask Questions';
    
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user->get_profile_name($user_id);
        $data['sum_units'] = $this->question->get_sum_units($user_id);  
        $data['categories'] = $this->unit->get_categories();
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('insert_question', 'Question', 'required');
        if($this->form_validation->run() === FALSE){
           //echo "form validation"; die();
            $this->load->view('templates/header', $data);
            $this->load->view('questions/askquestions', $data);
            $this->load->view('templates/footer'); 
        }
        else{
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $new_name = uniqid(rand());
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            //print_r("Value:".$this->upload->do_upload('userfile')); die();
            if(!$this->upload->do_upload('userfile')){
                $image_path = 'noimg.jpg';
            } 
            else {
                $data = $this->upload->data();
                $image_path = $data['file_name'];
            }
            $result = $this->question->insert_question($image_path);
            
            if($result == TRUE){
                echo "result is true"; die();
                $this->session->set_flashdata('question_submitted', 'Question submitted successfuly.');
                redirect('questions/index');
            }else{
                 echo "result is false"; die();
                 $this->session->set_flashdata('question_nsubmitted', 'Question is not submitted successfuly.');
                redirect('questions/ask');
            }        
       }
    }  
    public function view($slug = NULL){
        $data['title'] = "All Answers";
        $qid = $this->uri->segment(3);
        $quser_id = $this->uri->segment(4);
        //$data['title'] = 'Ask Questions';
        $data['question'] = $this->question->get_question($qid, $quser_id);
        $data['answers'] = $this->question->get_answers($qid);
       // print_r($data); die();
        //$user_id = $this->session->userdata('user_id');
       // $data['user'] = $this->user->get_profile_name($user_id);
        //$data['sum_units'] = $this->question->get_sum_units($user_id);  
        
        if($this->session->userdata('logged_in'))
        {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->get_profile_name($user_id);
        }
        $this->load->view('templates/header', $data);
        $this->load->view('questions/view', $data);
        $this->load->view('templates/footer'); 
    }
    
        public function submit($slug = NULL){
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        //$data['title'] = 'Ask Questions';
         $data['questions'] = $this->question->get_questions();
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user->get_profile_name($user_id);
        $data['sum_units'] = $this->question->get_sum_units($user_id);  
        $this->load->view('templates/header', $data);
        $this->load->view('questions/view', $data);
        $this->load->view('templates/footer'); 
    }

}
