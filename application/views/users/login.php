<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <?php if ($this->session->flashdata('questionlog')): ?>
            <p class="alert alert-warning"><?= $this->session->flashdata('questionlog') ?></p>
        <?php endif; ?>

        <?php if ($this->session->flashdata('answerlog')): ?>
            <p class="alert alert-warning"><?= $this->session->flashdata('answerlog') ?></p>
        <?php endif; ?>

        <form id="login-form" action="<?= base_url('users/login') ?>" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="username" value="<?= set_value('username'); ?>" placeholder="Enter Your Username or E-mail">
                <?= form_error('username', '<div class="error">', '</div>'); ?>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                <?= form_error('password', '<div class="error">', '</div>'); ?>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

            <p style="color:#099;"><strong>New?</strong>
                <a href="<?= base_url('users/register') ?>">Register</a>  
                <a href="#forgot-password" data-toggle="modal" class="btn btn-link" role="link" name="op" value="Login">Forget password?</a>
            </p>
        </form>
            <div>
                <hr>
                <p>Or sign up with:</p>
                <!-- Google Sign-up button -->
                <a href="<?= base_url('users/google_login') ?>" class="btn btn-danger">Sign up with Google</a>
                <!-- Facebook Sign-up button -->
                <a href="<?= base_url('users/facebook_login') ?>" class="btn btn-primary">Sign up with Facebook</a>
            </div>
        </div>
</div>
</div>



<!-- Modal -->
<div id="forgot-password" class="modal fade " role="dialog" style=" margin: auto;" >
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <?php
            echo form_open("users/password_recovery");
            ?>

            <div class="modal-header">
                <h3 class="panel-title" style="color: #099;"><strong>RECOVER YOUR PASSWORD</strong></h3>
            </div>
            <div class="modal-body">
                <div class="form-group input-group">
                    <span class="input-group-addon"> </span>
                    <input type="email" name="email_recovery" id="email"
                           class="form-control" value="<?php echo set_value('email_recovery'); ?>"placeholder="Enter Your E-mail" />
                           <?php echo form_error('email_recovery', '<div class="error">', '</div>'); ?>

                </div>
                <div id="alert-msg"></div>
                <input class="btn btn-block" id="submit" style = " background-color: #4CAF50; color: white;"type="submit" value="Submit">

            </div>
            </form>
            <div class="modal-footer">
                <a class="btn btn-default" style = " background-color: #4CAF50; color: white;" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).on("click", ".btn", function () {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>users/password_recovery",
            data: {your: data},
            success: function (data) {

                //and from data parse your json data and show error message in the modal
                var obj = $.parseJSON(data);
                if (obj !== null)
                {
                    $('#err_mssg').html(obj['error_message']);
                }
            }});
    });
 </script>