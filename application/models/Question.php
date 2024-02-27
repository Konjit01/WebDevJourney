<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Question
 *
 * @author konjit
 */
class Question extends CI_Model {

    //put your code here    
    public function insert_question($unit_img) {
        $slug = url_title($this->input->post('subject'));

        $data = array(
            'title' => $this->input->post('subject'),
            'slug' => $slug,
            'body' => $this->input->post('insert_question'),
            'subcategory_id' => $this->input->post('subcategory_id'),
            'user_id' => $this->session->userdata('user_id'),
            'question_pic' => $unit_img
        );
        $this->db->insert('questions', $data);

        if ($this->db->affected_rows() === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_questions() {

        $sql = "SELECT * FROM `questions` JOIN `users` ON `questions`.`user_id` = `users`.`id`;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function edit($question_id) {
        
    }

    public function get_sum_units($user_id) {
        return $this->db->where(['user_id' => $user_id])->from('questions')->count_all_results();
    }

    public function get_question($id, $user_id) {

        $sql = "SELECT * FROM `questions` JOIN `users` ON `questions`.`qid` = $id AND `users`.`id`  = $user_id;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function get_answers($qid) {
        $sql = "SELECT * FROM `answers` JOIN `users` ON `answers`.`question_id` = $qid AND `answers`.`user_id` = `users`.`id`;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_num_answers($qid) {
        return $this->db->where(['question_id' => $qid])->from('answers')->count_all_results();
    }

    public function insert_answer($qid) {
        $data = array(
            'ans_body' => $this->input->post('ans_body'),
            'question_id' => $qid,
            'user_id' => $this->session->userdata('user_id'),
        );
        $this->db->insert('answers', $data);

        if ($this->db->affected_rows() === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
