<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Unit
 *
 * @author Konjit
 */
class Unit extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //----------RETRIEVE ALL ARTICLES-----
    public function get_units( $slug , $limit = FALSE, $offset = FALSE)
    {
        if($limit){
	    $this->db->limit($limit, $offset);
        }
        if( $slug === FALSE ){
            $this->db->order_by('units.id', 'DESC');
	    $this->db->join('subcategories', 'subcategories.id = units.subcategory_id');
	    $query = $this->db->get('units');
	    return $query->result_array();
        } 
       $query = $this->db->get_where('units', array('slug' => $slug));
       return $query->row_array();
    }
    // ------------INSERT ARTICLES-------
    public function insert_unit($unit_img){
        $slug = url_title($this->input->post('title'));
        
        $data = array(
            'title' => $this->input->post('title'),
            'slug'  => $slug,
            'body'  => $this->input->post('body'),
            'subcategory_id' => $this->input->post('subcategory_id'),
            'user_id' => $this->session->userdata('user_id'),
            'unit_img' => $unit_img
        );
        //$category_id = $this->input->post('category_id ');
        return $this->db->insert('units', $data);
    }
    
    // -------DELETE ARTICLES---------
    public function delete_unit($id){
        $sql_stmt = "DELETE FROM units WHERE `id` = $id";
        $this->db->query($sql_stmt);
        return true;
    }
    
    //----- EDIT ARTICLES----------
    public function edit_unit(){
      
        $slug = url_title($this->input->post('title'));
        $data = array(
            'title' => $this->input->post('title'),
            'slug'  => $slug,
            'body' => $this->input->post('body'),
            );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('units', $data);
    }

    // -------INSERT CATEGORIES INTO DB----
    public function insert_category($image_path){
        $name = $this->input->post('name');
        $sql = "INSERT INTO `categories` (`name`, `cate_pic`) VALUES( '$name', '$image_path' )";
        $this->db->query($sql);
          if ($this->db->affected_rows() === 1 ) {
              return 1;
        } else {
            return 0;
        }
    }
   
    //---------GETS CATEGORY BY ID--------
    public function get_category($id){
        $sql = "SELECT `name` FROM `categories` WHERE `categories`.`id` = $id";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    //-------INSERT COMMNETS TO THE DATABASE---
    public function insert_comment($unit_id){
        $data = array(
            'unit_id' => $unit_id,
            'parent_id' =>$this->input->post('parent_id'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'body' => $this->input->post('body')
        );
        
        $this->db->insert('comments', $data);
        return $this->input->post('parent_id');
    }
    //---- GETS ALL COMMENTS BY ID---------- 
    public function get_comments($unit_id)
    {
        $sql = "SELECT * FROM `comments` WHERE `comments`.`unit_id` = $unit_id;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    // --------------SERACH FOR THE KEYWORD PROVIDED-------- 
    public function search_for_units(){
        $search_item = $this->input->post('search');
        if( $search_item != '')
        {
            $sql = "SELECT * FROM `units` WHERE `title` LIKE '%$search_item%' OR `body` LIKE '%$search_item%';";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
    }
    
    //--------THESE LAST TWO FUNCTION TO BE COMBINED
    public function get_categories(){
        $sql = "SELECT * FROM `categories` ORDER BY `name`;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
     public function get_subcategories_query($id){
      $sql = "SELECT * FROM `subcategories` WHERE `subcategories`.`id` = $id; ";
      $result = $this->db->query($sql);
        if ($result->num_rows() == 1) {
          return $result->row(0)->category_id;
        } else {
            return 0;
        }
     
    }

    public function get_subcategories_units($id){
   
      $sql = "SELECT * FROM `subcategories` WHERE `subcategories`.`category_id` = '".$id."'";
      $query = $this->db->query($sql);
      return $query->result_array();
    }
    
    public function get_subcategories_by($id){
     $sql = $this->db->get_where('subcategories', array('category_id' => $id));
     return $sql->result();
    }
    //$data['units'] = $this->unit->get_units_by_subcategory( $config['per_page'], $offset, $id );
    public function get_units_by_subcategory($id, $limit = FALSE, $offset=FALSE){
        $sql = "SELECT * FROM `units` JOIN `users` ON `units`.`user_id`=`users`.`id` WHERE `subcategory_id` = $id";
        $query = $this->db->query($sql);
       // print_r($query->result_array()); die();
        return $query->result_array();
    }
     
    public function get_units_by_category_id($subcategory_id ){
        $subcategory_id = $this->input->post('subcategory_id');
        // echo($category_id); die();
        /*$data['units'] = "SELECT * FROM units JOIN categories ON units.category_id = categories.id ORDER BY units.created_at DESC;";
        $sql = "SELECT * FROM `units` WHERE $units.`category_id` =  $category_id ;";
        $query = $this->db->query($sql_stmt);
        $query = $this->db->query($sql);*/
        $this->db->order_by('units.id', 'DESC');
        $this->db->join('subcategories', 'subcategories.id = units.subcategory_id');
        $query = $this->db->get_where('units', array('subcategory_id' => $subcategory_id));
        return $query->result_array();
   }
   //---------RETRIEVE ALL SUB CATEGORIES-----------
   public function get_subcategories(){
       $sql = "SELECT * FROM `subcategories`;";
       $query = $this->db->query($sql);
       return  $query->result_array();
   }
   
   public function create_subcategory(){
       
       $category_id = $this->input->post('category_id');
       $name = $this->input->post('subcate_name');
       
       $sql = "INSERT INTO `subcategories` (`name`, `category_id`) VALUES ('$name', $category_id);";
       $this->db->query($sql);
       
       if($this->db->affected_rows() === 1){
         return TRUE;  
       }else{
           return FALSE;
       }
    }
   
}
