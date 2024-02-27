<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php echo validation_errors(); ?>

<?php echo form_open('units/update'); ?>
<input type="hidden" name="id" value="<?php echo $unit['id']; ?>">
<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $unit['title']; ?>" >
</div>
<div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" ><?php echo $unit['body']; ?></textarea>
</div>

<div class="form-group">
    <label>Select Category</label>
    <select name="category_id" class="form-control">
        <?php foreach ($categories as $category): ?>
            <option vlaue="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>
  <!--<div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="userfile" size="20">
   </div>-->
<button type="submit" class="btn" style ="background-color: #4CAF50; color:white;">Submit</button>
<?php echo form_close(); ?>