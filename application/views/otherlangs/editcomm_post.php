<?php if(isset($editcomm_post) && ($editcomm_post->num_rows() >0)){  foreach($editcomm_post->result() as $editcommpost) { ?>
    <input type="hidden" name="comm_storyid" value="<?php echo $editcommpost->id;?>">
    <?php if($editcommpost->type == "url"){ ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="story">Story:</label>
            <div class="col-sm-10">
                <input type="hidden" name="url" value="url">
                <input type="text" class="form-control" name="story" placeholder="Post Your Link Here...." value="<?php echo $editcommpost->titleurl;?>">
                <span class="text-danger story"><?php echo form_error('story');?></span>
            </div>
        </div>
    <?php } elseif(($editcommpost->type == "story") && ($editcommpost->typeoftype == 'quotes')) { ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="story">Quotes:</label>
            <div class="col-sm-10"> 
                <?php $story = str_replace("<b> <q>","",$editcommpost->story); 
                    $qstory = str_replace("</q> </b>","",trim($story)); ?>
                <textarea name="story" rows="5" cols="13" placeholder="Type QUOTES ......" class="form-control" style="border-radius:5px;border-color:#000; background: #4c3b3b2e; color: #000;"><?php echo rtrim($qstory);?></textarea>
                <span class="text-danger story"><?php echo form_error('story');?></span>
            </div>
        </div>
		<input type="hidden" name="quotes" value="quotes">
    <?php } else if(($editcommpost->type == "story") && ($editcommpost->typeoftype == '')){ ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="story">Text:</label>
            <div class="col-sm-10"> 
                <textarea type="text" name="story" rows="5" cols="13" placeholder="Type Message ......" class="form-control"><?php echo $editcommpost->story;?></textarea>
                <span class="text-danger story"><?php echo form_error('story');?></span>
            </div>
        </div>
    <?php } ?>
        <div class="form-group"> 
            <div class="col-sm-12">
                <center><button type="submit" class="btn btn-primary">Submit</button></center>
            </div>
        </div>
<?php } } ?>