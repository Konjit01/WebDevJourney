<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<div class="row">
    <div class="col-md-offset-0 col-md-7 col-sm-6 col-xs-12 content">
        <h2 style="color: #099"><?php echo $unit['title']; ?></h2>
        <div>
        <img  id="img-about" class="img-responsive" style="height:350px; width: 500px" src="<?php echo site_url(); ?>uploads/<?php echo $unit['unit_img']; ?>"> 
        </div>
        <p ><strong>Fig: <?php echo $image_name; ?></strong></p>
        <hr>
        <div class="post-body">
            <?php echo $unit['body']; ?>
        </div>
                   

       <?php if($this->session->userdata('user_id') == $unit['user_id']):?>
            <hr>
            <a href="<?php echo base_url(); ?>units/edit/<?php echo $unit['slug']; ?>" class="btn  pull-left" style="background-color: #4CAF50; color: white;"><span class="glyphicon glyphicon-edit"></span>Edit</a>
            <!--</*?php echo form_open('/units/delete/' . $unit['id']); ?>
            <input type="submit" value="Delete" class="btn btn-danger">
            </*?php echo form_close(); ?>-->
        <?php endif;?>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12" style ="margin-top: 40px;">
        <h3 style="color: #099;">Recommended Materials</h3>
       
    
        <h4 style="color: #099;">Recommneded Videos</h4>
         <iframe width="420" height="315"
            src="<?php echo $unit['resources']; ?>">
                </iframe> 
        
   
    </div>
 
        
    <!--<div class=" col-md-4 right-side" style="padding-top: 60;">
        <div id="right-side">
               <h3 class="text-centered" style="color: #099" >Table of contents</h3>
        </div>
    </div>-->
</div>
<div class="row">
    <div class="col-md-offset-0 col-md-7 col-sm-6 col-xs-12 ">
     <h4 style="color: #099;">All comments</h4>
       <?php if(!$comments) : ?> 
     <p style="color: #099;">No comments to show</p>
     <?php else:?>
        <?php foreach($comments as  $comment):?>
        <hr>
        <div >
             <?php echo $comment['body'];?>  
          
           <div class='float-right'>
                By <strong><?php echo $comment['name']; ?></strong> 
           </div>
            <hr>
        </div>
        <?php endforeach; ?>
       <?php endif;?>
    </div>
</div>


<?php // form valdation?>
<div class="row">
  <div class="col-md-offset-0 col-md-7 col-sm-6 col-xs-12 ">
        <h3 style="color: #099">Leave Comments</h3>
        <?php echo form_open('units/create_comment/' . $unit['id']); ?>
        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Enter your name">
        </div>
     
        <div class="form-group">
           <textarea name="body" class="form-control" placeholder="Enter your comments..."></textarea>
        </div>
        <input type="hidden" name="slug" value="<?php echo $unit['slug']; ?>">
        <input type='hidden' name='parent_id' value="0" id='parent_id' />
        <input type='hidden' name='unit_id' value="<?= set_value("unit_id", $unit['id']) ?>" id='parent_id'/>
        <button class="btn btn-success btn-block" type="submit">Submit</button>
        <?php echo form_close(); ?>
    </div>
</div>




