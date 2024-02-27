<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->







<div class="col-md-offset-4 col-md-9">      
   <h2 style = 'color: #099;'>All Results</h2>
</div>

<div class="col-md-offset-2 col-md-9">      
    <?php if (!$units): ?>
        <h2 style = 'color: #099;'>There are no contents on this section yet!</h2>
    <?php endif; ?>
</div>

<?php foreach ($units as $unit) : ?>
    <div class="col-md-offset-1 col-md-9" style="padding-top : 20px;"> 
      
        <div class=" panel panel-info" style="border-color:green;">
            <div class="panel-heading">
                <h5 style="color: black;"><strong><?php echo $unit['title']; ?>&nbsp;</strong></h5>
            </div>
            <div class="panel-body">
                <?php echo word_limiter($unit['body'], 100); ?>
            </div>
            <div class="panel-footer">
                <p><a class="btn btn-success" href="<?php echo site_url('/units/' . $unit['slug']); ?>">Read More</a></p>
               <p class=" float-right"><span class="glyphicon glyphicon-calendar" style="color: #099;"> Published On: &nbsp;<?php echo date('D. M. Y', strtotime($unit['created_at']));  ?> By <?php 
               
               if ($this->session->userdata('logged_in'))
               echo $user['username'];
               else
               echo $unit['username'];
               ?></p>
            </div>

        </div><!--Panel heading-->
    </div><!--col-md-9-->
<?php endforeach; ?>
</div><!--row-->



<div class="pagination-links">
    <div class ="row">
        <div class="col-md-offset-6">
           
        </div>
    </div>
</div>