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
<div class="col-md-offset-2" >

<h3 style="color: #099"> <?php echo  $user_details['first_name']; ?>'s &nbsp;Profile</h3>

</div>
<div class="row">
    <div class="col-md-offset-2 col-md-3" >

        <!-- Profile Image -->
        <div class="box box-primary" id="element_overlap">
            <div class="box-body box-profile">


                <img class="img-responsive img-circle " src="<?php echo base_url(); ?>uploads/<?php echo  $user_details['profile_pic']; ?>" alt="<?= $user_details['username']; ?>">




            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->





    </div>
    <div class=' col-md-5'>
        
        <h3 class="profile-username text-center NameEdt"><?= $user_details['first_name']; ?> &nbsp;<?=  $user_details['last_name']; ?></h3>
                <h3 class="profile-username text-center NameEdt"></h3>
                <h4 class="profile-username text-center NameEdt">Education </h4>
                <p class="text-muted text-center">Member since <?= date('M. Y', strtotime( $user_details['created_at'])); ?>  </p>

        </div>

    <!-- /.nav-tabs-custom -->
</div>




