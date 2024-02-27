<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <title>Quest</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body id="body_id" style="background-color: #F0F8FF; padding-bottom: 100px;" >  

        <div class="container"  id="page-container" style= "padding-top: 50px; padding-bottom: 10px;" >
            <?php
            require 'navbar.php';
            ?>
            <?php if ($this->session->flashdata('recover_password')): ?>
                <?php echo '<p class="alert alert-success " id="success-message">' . $this->session->flashdata('recover_password') . '</p>' ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('user_registered')): ?>
                <?php echo '<p class="alert alert-success"  id="success-message">' . $this->session->flashdata('user_registered') . '</p>' ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('user_login_success')): ?>
                <?php echo '<p class="alert alert-success"  id="success-message">' . $this->session->flashdata('user_login_success') . '</p>' ?>
            <?php endif; ?>


            <?php if ($this->session->flashdata('user_logged_out')): ?>
                <?php echo '<p class="alert alert-success"   id="success-message">' . $this->session->flashdata('user_logged_out') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('pwd_changed')): ?>
                <?php echo '<p class="alert alert-success"  id="success-message">' . $this->session->flashdata('pwd_changed') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('pwd_incorrect')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('pwd_incorrect') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('account_delete')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('account_delete') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('pwd_no_match')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('pwd_no_match') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('registered_into_db_failed')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('registered_into_db_failed') . '</p>' ?>
            <?php endif; ?>


            <?php if ($this->session->flashdata('check_email')): ?>
                <?php echo '<p class="alert alert-success"  id="success-message">' . $this->session->flashdata('check_email') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('activation_success')): ?>
                <?php echo '<p class="alert alert-success"  id="success-message">' . $this->session->flashdata('activation_success') . '</p>' ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('activation_failure')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('activation_failure') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('code_mismacth')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('code_mismacth') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('account_inactive')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('account_inactive') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('password_email')): ?>
                <?php echo '<p class="alert alert-success"  id="success-message">' . $this->session->flashdata('password_email') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('password_email_wrong')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('password_email_wrong') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('pwd_updated_failed')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('pwd_updated_failed') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('pwd_updated_success')): ?>
                <?php echo '<p class="alert alert-success"  id="success-message">' . $this->session->flashdata('pwd_updated_success') . '</p>' ?>
            <?php endif; ?>


            <?php if ($this->session->flashdata('email_not_found')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('email_not_found') . '</p>' ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('question_submitted')): ?>
                <?php echo '<p class="alert alert-success"  id="success-message">' . $this->session->flashdata('question_submitted') . '</p>' ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('question_nsubmitted')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('question_nsubmitted') . '</p>' ?>
            <?php endif; ?> 
            <?php if ($this->session->flashdata('answer_submitted')): ?>
                <?php echo '<p class="alert alert-success">' . $this->session->flashdata('answer_submitted') . '</p>' ?>
            <?php endif; ?> 
            <?php if ($this->session->flashdata('answer_nsubmitted')): ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('answer_nsubmitted') . '</p>' ?>
            <?php endif; ?> 





