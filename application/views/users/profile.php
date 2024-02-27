<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<h3 style="color: #099">Edit Your Profile </h3>


  



    <div class="row">
       <div class="col-md-3" >
         
          <!-- Profile Image -->
          <div class="box box-primary" id="element_overlap">
            <div class="box-body box-profile">
            
       
              <img class="profile-user-img img-responsive img-circle profileImgUrl" src="<?php echo base_url(); ?>uploads/<?php echo $user['profile_pic']; ?>" alt="<?=$user['username'];?>">

              <h3 class="profile-username text-center NameEdt"><?=$user['username'];?></h3>

              <p class="text-muted text-center">Member since <?=date('M. Y',strtotime($user['created_at']) );?>  </p>
 
             
                  <?php echo form_open_multipart('users/change_profile_pic'); ?>
                 <div class="form-group">
                     
                <label style="color: #099">Upload New Image</label> 
                <input type="file" name="userfile" id="imgfile"size="20">
                <br>
                <button class="btn btn-block" style = "background-color: #4CAF50; color: white;">Submit</button>
            </div> </form>
               <p id="ErrorMessage" style="padding: 5px;"></p>
            </div>
            <!-- /.box-body -->
          </div> </form>
          <!-- /.box -->
          
      
       
        <div class="form-group">
            <a href="#" id="delete-account">Delete My Account</a>
        </div>
        <form id="delete-form"  action='' method="post">
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-at"></i> </span>
                <input type="password" name="pwd_delete" id="password"
                       class="form-control" placeholder="Enter Your Password">
            </div>
            <a class="btn btn-success btn-block" type="button" href="<?php echo base_url()?>users/delete_account" id="submit">Submit</a>
        </form>
  	 
          
        </div>
     <div class="col-md-offset-1 col-md-6">
          <div class="nav-tabs-custom" id="element_overlap1">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" style="color: #099">General Details</a></li>
              <li><a href="#settings" data-toggle="tab" style="color: #099">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
               	<form class="form-horizontal UpdateDetails">
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">User ID</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$user['id']?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Name</label>
                     <div class="col-sm-3">
                      <input type="text" class="form-control" name="first_name" value="<?=$user['first_name']?>" placeholder="First Name">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="last_name" value="<?=$user['last_name']?>" placeholder="Last Name">
                    </div>
                  </div>
                  
                    
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                     <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" value="<?=$user['email']?>" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group"><label for="" required class="col-sm-2 control-label">&nbsp;</label>
                 	<p  id="ErrorMessageU"></p>
                   </div>
                   
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            

              <div class="tab-pane" id="settings">
                   <?php echo form_open_multipart('users/change_password'); ?>
        
            
            <div class="form-group">
                <input type="password" class="form-control" name="prevpwd" placeholder="Enter Your Pervious Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="newpwd" placeholder="Enter Your New Password">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="cnewpwd" placeholder="Conform Your Password">
            </div>
            <button class="btn btn-block" style = " background-color: #4CAF50; color: white;">Submit</button>
            <br>
        </div>
        </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        </div>
    
    
     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
   
      
    </div>
  </div>
    <style>
        #delete-form{
            display:none;
        }
    </style>
    <script>
        $(document).ready(function () {

            $("#delete-account").click(function () {
                $("#delete-form").toggle();
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on("click", ".btn", function () {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>users/delete_account",
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
        ></script>
    <script>
function LoginWith(url){
	window.open(url, "popup", "width=800,height=500,left=220,top=130");
}

$(".UploadForm").submit('on',function(e){
					e.preventDefault();
	
 					$('#myModal').modal('hide');
					$('#ErrorMessage').html('');
					
					$("#element_overlap").LoadingOverlay("show");
					
					var file_data = $('#userImage').prop('files')[0];   
					var form_data = new FormData();
					form_data.append('userPhoto', file_data);
 
  					$.ajax({
					  dataType : "json",
					  type : "post",
					  cache: false,
					  contentType: false,
					  processData: false,
					  data : form_data,
 					  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
					  url: '<?=base_url('upload-profile');?>',
					  success:function(data)
							{
								$("#element_overlap").LoadingOverlay("hide", true);
   								if(data.status == 0)
								{
								  $('#ErrorMessage').html('<span style="color:red;">'+data.message+'</span>');
								}
								if(data.status == 1)
								{
 									  $('#ErrorMessage').html(data.message);
									  $('.profileImgUrl').attr('src',data.picture_url);
 								}
 					  },
					  error: function (jqXHR, status, err) {
 						  $('#ErrorMessage').html('<span style="color:red;">Local error callback.</span>');
 					  }
 					});
					//} //else
 });
 
 
 $(".ChangePassword").submit('on',function(e){
	e.preventDefault();
	var New,Old,Confirm;
	New=$('#New').val();
	Old=$('#Old').val();
	Confirm=$('#Confirm').val();
     				$("#element_overlap1").LoadingOverlay("show");
    					$.ajax({
						  dataType : "json",
						  type : "post",
						  data : {New:New,Old:Old,Confirm:Confirm,},
						  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
						  url: '<?=base_url('profile-password-update');?>',
						  success:function(data)
								{
									$("#element_overlap1").LoadingOverlay("hide", true);
									if(data.status == 0)
									{
									  $('#ErrorMessageP').html('<span style="color:red;">'+data.message+'</span>');
									}
									if(data.status == 1)
									{
										  $('#ErrorMessageP').html(data.message);
 									}
						  },
						  error: function (jqXHR, status, err) {
							  $('#ErrorMessageP').html('<span style="color:red;">Local error callback.</span>');
						  }
 					});
					//} //else
 });
  
 $(".UpdateDetails").submit('on',function(e){
	e.preventDefault();
 
     				$("#element_overlap1").LoadingOverlay("show");
    					$.ajax({
						  dataType : "json",
						  type : "post",
						  data : $(".UpdateDetails").serialize(),
						  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
						  url: '<?=base_url('profile-details-update');?>',
						  success:function(data)
								{
									$("#element_overlap1").LoadingOverlay("hide", true);
									if(data.status == 0)
									{
									  $('#ErrorMessageU').html('<span style="color:red;">'+data.message+'</span>');
									}
									if(data.status == 1)
									{
										  $('#ErrorMessageU').html(data.message);
										  $('.NameEdt').html(data.updateName);
										  
									}
						  },
						  error: function (jqXHR, status, err) {
							  $('#ErrorMessageU').html('<span style="color:red;">Local error callback.</span>');
						  }
 					});
					//} //else
 });
 
 </script>
