<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

 <div class=" col-md-offset-3"> 
        <h2 style="color: #099">CHOOSE FROM THE FOLLOWING</h2>
    </div>

<div class ="row">
    <div class="col-md-offset-0" style="padding-top: 40px">
        <?php foreach ($categories as $category): ?>
            <div class=" col-md-3"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-8">
                                <p  style="font-size: 15px; color: #099;"><strong><?php echo strtoupper($category['name']); ?></strong></p>
                            </div>
                            <div class="col-md-1">
                                <img src="<?php echo base_url(); ?>uploads/<?php echo $category['cate_pic']; ?>" width="40" height="40"  class=" img-circle "> 
                            </div>
                        </div>
                    </div> 
                    <div class="panel-body">
                        <?php if (!empty($subcategories)) : ?>
                            <?php foreach ($subcategories as $subcat): ?>
                                <?php if ($category['id'] === $subcat['category_id']): ?>
                                    <p style="font-size: 15px;"><a href='<?php echo site_url('/categories/units/' . $subcat['id']. '/'. $subcat['name']); ?>'><?php echo $subcat['name']; ?></a></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class ='text-center' style='color: #099;'>No Sub categories </p>
                        <?php endif; ?> 
                    </div>
                </div>

            </div>

        <?php endforeach; ?>
    </div>
</div>
<style>
    .card {
        /* Add shadows to create the "card" effect */

    }

    /* On mouse-over, add a deeper shadow */
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    /* Add some padding inside the card container */
    .container {
        padding: 2px 16px;
    }
</style>

<script>
    $(document).ready(function () {

        $("#list").click(function () {
            $("#sublist").toggle();
        });
    });
</script>




