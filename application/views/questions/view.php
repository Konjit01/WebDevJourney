<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="col-md-offset-1 col-md-7 col-sm-6 col-xs-12 " style="top-padding: 60px;">
 
  </div>
<div class="row">
  
    <div class="col-md-offset-1 col-md-7 col-sm-6 col-xs-12 " style="top-padding: 60px;">
        
        <h2 style="color: #099"><?php echo $question['title']; ?></h2>
    
        <hr>
        <div class="post-body">
            <?php echo $question['body']; ?>
        </div>
      
       <?php if($this->session->userdata('user_id') == $question['user_id']):?>
            <hr>
            <a href="<?php echo base_url(); ?>questions/qedit/<?php echo $question['slug']; ?>" class="btn  pull-left" style="background-color: #4CAF50; color: white;"><span class="glyphicon glyphicon-edit"></span>Edit</a>
            <!--</*?php echo form_open('/units/delete/' . $unit['id']); ?>
            <input type="submit" value="Delete" class="btn btn-danger">
            </*?php echo form_close(); ?>-->
        <?php endif;?>
           
    </div>

    <hr> 
        
    <!--<div class=" col-md-4 right-side" style="padding-top: 60;">
        <div id="right-side">
               <h3 class="text-centered" style="color: #099" >Table of contents</h3>
        </div>
    </div>-->
    
 
    <div class="col-md-offset-1 col-md-7 col-sm-6 col-xs-12 ">
     <h4 style="color: #099;">All answers</h4>
       <?php if(!$answers) : ?> 
     <p style="color: #099;">No answers to show</p>
     <?php else:?>
        <?php foreach($answers as  $answer):?>
        <hr>
        <div >
             <?php echo $answer['ans_body'];?>  
          
             <div class="row">
                <br>
                <div class="col-md-7"><p class=" float-right"><span class="glyphicon glyphicon-calendar" style="color: #099;"> <?php echo  date('D. M. Y', strtotime($answer['created_at']));  ?> &nbsp answered by <strong><?php echo $answer['username']; ?></strong></p></div>
                <div class="col-md-1"><a href="<?php echo site_url('users/user_details/' . $answer['user_id']);?> "><img src="<?php echo base_url(); ?>uploads/<?php echo $answer['profile_pic']; ?>" width="40" height="40"  class="img-circle img-responsive img-center"></a></div>
            </div>
         
            <hr>
        </div>
        <?php endforeach; ?>
       <?php endif;?>
    </div>
    
   <?php echo form_open_multipart('answers/submit_answer/'.$question['qid']);?>
      <div class="col-md-offset-1 col-md-8">
      
        <div class="form-group">
            <label></label>
            <textarea id="editor1" class="form-control" name="ans_body" placeholder="Add Body"></textarea>
             <?php echo form_error('ans_body', '<div class="error">', '</div>'); ?>
         </div>
          <button class="btn btn-success">Submit Answer</button>
       </div>
    
  <?php echo form_close();?> 
    
    
</div>








