<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<div class="container ctr-div">
    <div class="col-md-offset-4 col-md-4" id="user-info" style=" padding-top: 10px;  margin-top:60px; border:1px solid #4CAF50; border-radius: 10px;   box-shadow: 0px 0 16px 0 rgba(0,0,0,0.24), 0px 0 0px  0 rgba(0,0,0,0.19);">
        <legend  style="color: #099">RECOVER YOUR PASSWORD</legend>
       
        <form  action="<?php echo base_url();?>users/update_user_pwd/<?php echo $id; ?>" method="post">
        <div class="form-group">
            <label>Enter you new password</label>
            <input type="password" class="form-control" name="pwd" placeholder="Enter your new password">
            <?php echo form_error('pwd', '<div class="error">', '</div>'); ?>
        </div>

        <div class="form-group">
            <label>Repeat password</label>
            <input type="password" class="form-control" name="cpwd" placeholder="Conform Password">
            <?php echo form_error('cpwd', '<div class="error">', '</div>'); ?>
        </div>

        <button class="btn btn-block" style = " background-color: #4CAF50; color: white;">Submit</button>
               <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
            
        </p>
       <?php echo form_close(); ?>

    </div>
</div>
