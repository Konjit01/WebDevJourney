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
 
<h1 style="color: #099;"><?= $title; ?></h1>

<?php if(!$units): ?>
    <h3 > Your search results cannot be found</h3>
<?php else: ?>
    <?php foreach ($units as $unit) : ?>
        <div class="row">
            <div class="col-sm-10">
                <div class=" panel panel-info" style="border-color:green;">
                    <div class="panel-heading">
                        <h5 style="color: black;"><strong><?php echo $unit['title']; ?></h5>
                    </div>
                    <div class="panel-body">
                        <?php echo word_limiter($unit['body'], 100); ?>
                    </div>
                    <div class="panel-footer">
                        <p><a class="btn btn-success" href="<?php echo site_url('/units/' . $unit['slug']); ?>">Read More</a></p>
                         <small class="">Published on: <?php echo $unit['created_at']; ?></small><br>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <!--<img  class=" img-responsive  post-thumb" src="</*?php //echo site_url(); ?>uploads/</*?php echo //$unit['unit_img']; //*?>*/">     -->        
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>


<div class="pagination-links">
    <div class ="row">
        <div class="col-md-offset-4">
		    <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>