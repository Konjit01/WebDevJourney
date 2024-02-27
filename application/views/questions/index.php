<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class = "row">
    <div class=" col-md-offset-1 col-md-3"> 
        <h2 style="color: #099"><?php echo $title; ?></h2>
    </div>
    <div class=" col-md-offset-3 col-md-2" style="padding-top: 20px;"> 
               
                        <a class=" btn navbar-btn signin" style ="padding: 5px 7px; background-color: #4CAF50; color:white; " href="<?php echo base_url(); ?>questions/ask">ASK QUESTIONS&nbsp;</a></li>
                   
    </div>
    <?php foreach ($questions as $question) : ?>

        <div class=" col-md-offset-1 col-md-8"> 
        <h5> <strong><?php echo $question['title']; ?></strong>  </h5>

            <hr>
            <div class = "row">
            <div class="col-md-offset-0 col-md-7">
               <a class = "question_anchor"style="color: black;" href='<?php echo base_url('/questions/view/' . $question['qid'] . "/". $question['user_id']); ?>'><?php echo word_limiter($question['body'], 100); ?></a>
           </div>
            <div class="col-md-offset-2 col-md-3">
                <h5 style ="color: #099;">   <strong> has &nbsp;<?php echo $this->question->get_num_answers($question['qid']);?> answer(s)</strong></h5>
              </div> 
            </div>
            <div class="row">
                <br>
                <div class="col-md-5"><p class=" float-right"><span class="glyphicon glyphicon-calendar" style="color: #099;"> <?php echo  date('D. M. Y', strtotime($question['created_at']));  ?> &nbsp By <strong><?php echo $question['username']; ?></strong></p></div>
                <div class="col-md-1"><a href="<?php echo site_url('users/user_details/' . $question['user_id']);?> "><img src="<?php echo base_url(); ?>uploads/<?php echo $question['profile_pic']; ?>" width="40" height="40"  class="img-circle img-responsive img-center"></a></div>
            </div>
            <hr>

           




        </div><!--col-md-9-->
    <?php endforeach; ?>

</div>



<div class="col-md-offset-3">
    
            <?php echo $this->pagination->create_links(); ?>
    
</div>