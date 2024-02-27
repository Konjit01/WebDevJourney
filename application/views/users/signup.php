<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<div class="container "style=" margin: 0 auto;
    width:110%;" >
    <div class="col-md-offset-4 col-md-3" style=" padding-top: 20px;  margin-top:35px; border:1px solid #FFFF; border-radius: 10px;    box-shadow: 0px 0 16px 0 rgba(0,0,0,0.24), 0px 0 0px  0 rgba(0,0,0,0.19);">
        
         <legend style="color: #099">CREATE AN ACCOUNT</legend>
      
         <fieldset>
        
        <?php echo form_open_multipart('users/register');?>
            
        <div class="form-group">
            <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="Enter Your First name">
            <?php echo form_error('first_name', '<div class="error">', '</div>'); ?>
        </div>
        <div class="form-group">
            <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Enter Your Last name">
             <?php echo form_error('last_name', '<div class="error">', '</div>'); ?>
        </div>
        
        <div class="form-group">
           <input type="text" class="form-control" name="username" value="<?php echo set_value('username');?>" placeholder="Enter Username">
             <?php echo form_error('username', '<div class="error">', '</div>'); ?>
        </div>
        <div class="form-group">
            
            <input type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>"placeholder="Enter Your E-mail">
            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
        </div>
         <div class="form-group">
           
        <input type="password" class="form-control" name="password" placeholder="Create Password">
             <?php echo form_error('password', '<div class="error">', '</div>'); ?>
        </div>
         <div class="form-group">

            <input type="password" class="form-control" name="cpassword" placeholder="Conform Your Password">
             <?php echo form_error('cpassword', '<div class="error">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Upload an Image</label> 
            <input type="file" name="userfile" id="imgfile"size="20">
        </div>

        <button class="btn btn-success btn-block">Register</button>
        <p>Already a member?
            <a class="" href="<?php echo base_url()?>users/login">Login</a>
        </p>
        <?php echo form_close(); ?>
         
    </div>
</div>

<style>
.error {
    color: red;
}</style>

