<?php if(isset($editcommcomment) && ($editcommcomment->num_rows() >0)){  foreach($editcommcomment->result() as $editcomment) { ?>
    <div class="form-group">
        <div class="col-sm-12"> 
            <textarea type="text" name="comment" rows="5" cols="13" placeholder="Type comment ......" class="form-control" id="ucomment"><?php echo $editcomment->comment;?></textarea>
        </div>
    </div>
    <center><button class="btn btn-primary updatecmtspinner" onClick="updatecommcomment(<?php echo $editcomment->id;?>);">Submit</button></center>
<?php } } ?>