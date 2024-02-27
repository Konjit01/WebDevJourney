<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


  
    <?php if($this->session->flashdata('user_registered')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'?>
    <?php endif;?>
<?php if($this->session->flashdata('user_login_success')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_login_success').'</p>'?>
    <?php endif;?>
<?php if($this->session->flashdata('user_login_failed')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('user_login_failed').'</p>'?>
    <?php endif;?>
