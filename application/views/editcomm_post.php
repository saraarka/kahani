<?php if(isset($editcomm_post) && ($editcomm_post->num_rows() >0)){  foreach($editcomm_post->result() as $editcommpost) { ?>
    <input type="hidden" name="comm_storyid" value="<?php echo $editcommpost->id;?>">
    <?php if($editcommpost->type == "url"){ ?>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="hidden" name="url" value="url">
                <!--<input type="text" class="form-control" name="story" placeholder="Post Your Link Here...." value="<?php echo $editcommpost->titleurl;?>"> -->
                <input type="text" class="form-control" name="story" placeholder="Post Your Link Here...." value="<?php echo $editcommpost->urldescription;?>">
                <span class="text-danger story"><?php echo form_error('story');?></span>
            </div>
        </div>
    <?php } elseif(($editcommpost->type == "story") && ($editcommpost->typeoftype == 'quotes')) { ?>
        <div class="form-group">
            <div class="col-sm-12"> 
                <?php $story = str_replace("<b> <q>","",$editcommpost->story); 
                    $qstory = str_replace("</q> </b>","",trim($story)); 
                    $qstory = strip_tags($qstory); ?>
                <textarea name="story" rows="5" cols="13" placeholder="Type QUOTES ......" class="form-control" style="border-radius:5px;border-color:#000; background: #4c3b3b2e; color: #000;"><?php echo trim($qstory);?></textarea>
                <span class="text-danger story"><?php echo form_error('story');?></span>
            </div>
        </div>
		<input type="hidden" name="quotes" value="quotes">
    <?php } else if(($editcommpost->type == "story") && ($editcommpost->typeoftype == '')){ ?>
        <div class="form-group">
            <div class="col-sm-12"> 
                <textarea type="text" name="story" rows="5" cols="13" placeholder="Type Message ......" class="form-control"><?php echo $editcommpost->story;?></textarea>
                <span class="text-danger story"><?php echo form_error('story');?></span>
            </div>
        </div>
    <?php } ?>
        <div class="form-group"> 
            <div class="col-sm-12">
                <center><button type="submit" class="btn btn-primary postupdatespinner">Submit</button></center>
            </div>
        </div>
<?php } } ?>