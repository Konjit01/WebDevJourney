<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

  
<h3 style="color: #099"><?php echo $title; ?></h3>


<div class="row">
    
    <div class="col-md-3 ">
        <h4 >Number of articles you contribute: <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></h4>
        <img src="<?php echo base_url(); ?>uploads/<?php echo $user['profile_pic']; ?>" width="400" height="400" class="img-circle img-responsive img-center">
         <hr>
        <div class="form-group">
            <a class="btn btn-block btn-danger" href="#delete-account" data-toggle="modal" class="btn btn-link"
				role="link" name="op" value="Login">Delete My Account</a>
        </div>
    </div>
                  
    <div class ="col-md-8 " >
     
       

    </div>

