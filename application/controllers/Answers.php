<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Answers
 *
 * @author Konjit
 */
class Answers extends CI_Controller{
    //put your code here
    
       public function submit_answer($q_id ){
        if(!$this->session->userdata('logged_in')){
               $this->session->set_flashdata('answerlog', 'You have to login to ans questions.');
            redirect('users/login');
        }
        
       
        $user_id = $this->session->userdata('q_id');
        $data['user'] = $this->user->get_profile_name($user_id);
        $data['sum_units'] = $this->question->get_sum_units($user_id);  
        $this->form_validation->set_rules('ans_body', 'Answer', 'required');
        if($this->form_validation->run() === FALSE){
           //echo "form validation"; die();
           $this->session->set_flashdata('body_empty', 'This field cannot be empty.');
       
        }
        else{
          
            $result = $this->question->insert_answer($q_id);
            
            if($result == TRUE){
                //echo "result is true"; die();
                $this->session->set_flashdata('answer_submitted', 'Answer submitted successfuly.');
                redirect('questions/index');
            }else{
                  //echo "result is false"; die();
                $this->session->set_flashdata('answer_nsubmitted', 'Answer is not submitted successfuly.');
                redirect('questions/ask');
            }
            
       }
       
    }
}
