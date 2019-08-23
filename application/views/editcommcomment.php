<?php if(isset($editcommcomment) && ($editcommcomment->num_rows() >0)){  foreach($editcommcomment->result() as $editcomment) { ?>
        <!--<input type="hidden" name="id" value="<?php echo $editcomment->id;?>">
        <input type="hidden" name="comm_id" value="<?php echo $editcomment->comm_id;?>">
        <input type="hidden" name="story_id" value="<?php echo $editcomment->story_id;?>">-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="comment">Comment:</label>
            <div class="col-sm-10"> 
                <textarea type="text" name="comment" rows="5" cols="13" placeholder="Type comment ......" class="form-control" id="ucomment"><?php echo $editcomment->comment;?></textarea>
            </div><br><br><br>
        </div>
        <center><br> <br> <br><button class="btn btn-primary" onClick="updatecommcomment(<?php echo $editcomment->id;?>);">Submit</button></center>
<?php } } ?>