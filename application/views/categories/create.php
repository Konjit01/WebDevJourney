<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="col-md-offset-3">
    <h2 class="text-centred" style="color: #099;" >Create categories and subcategories</h2>
</div>
<div class="row">
<div class=" col-md-offset-2 col-md-3 " style="padding-top: 60px;">
   <div class="box box-primary" id="element_overlap">
            <div class="box-body box-profile">
               

<?php echo form_open_multipart('categories/create'); ?>

    <div class="form-group">
        <label>Create Category</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name">
    </div>
    
    <label>Upload an Image</label> 
    <div class="form-group">
        <!-- <label for="imgfile" style="float">Upload Image</label>-->
        <input type="file" name="userfile" id="imgfile"size="20">
    </div>
    <div class="form-group">
        <!-- <label for="imgfile" style="float">Upload Image</label>-->
        <button type="submit" class="btn btn-success btn-block">Submit</button>
    </div>
</div></div></div> <div class="col-md-offset-1 col-md-3 " style="padding-top: 60px;">
          <div class="box box-primary" id="element_overlap">
            <div class="box-body box-profile">
<?php echo form_close(); ?>
<?php echo form_open_multipart('categories/create_subcategory'); ?>

    <div class="form-group">
        <label>Select Category</label>
        <select name="category_id" id="category_id" class="form-control">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" name="cate_id"><?php echo $category['name']; ?></option>
 
            <?php endforeach; ?>
        </select>
    </div> 
    
      <div class="form-group">
        <label>Enter Sub Category</label>
        <input type="text" class="form-control" name="subcate_name" placeholder="Enter Sub Cat">
    </div>
     <div class="form-group">
        <button type="submit" class="btn btn-success btn-block">Submit</button>
    </div>
    
</div>
<?php echo form_close(); ?>
            </div></div></div></div>
