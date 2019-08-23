<?php if(isset($storysuggesttogroup) && ($storysuggesttogroup->num_rows() == 1)){ 
    foreach($storysuggesttogroup->result() as $story){ ?>
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" style="color:#000; opacity:initial; margin-top:2px;">&times;</button>
    	<h4 class="modal-title">
    	    <b><?php if(isset($this->session->userdata['logged_in']['name'])){
    	        //echo ucfirst($this->session->userdata['logged_in']['name']);
    	        }?></b> COMMUNITY SHARE 
    	        <!--<?php echo ucfirst($story->title);?>-->
    	</h4>
    </div>
    <div class="modal-body">
        <!--<h4> Read the following Story, it consists of some eye opening facts. </h4> -->
        <center><h5 class="resmsg"></h5></center>
    	<form id="storysuggestiontogroup">
    		<input type="hidden" name="title" value="<?php echo $story->title;?>">
    		<input type="hidden" name="sid" value="<?php echo $story->sid;?>">
    		<input type="hidden" name="image" value="<?php echo $story->image;?>">
    		<input type="hidden" name="story" value="<?php if($story->type == 'nano'){ echo $story->story; } else{ echo mb_substr(strip_tags($story->story), 0,100); } ?>">
    	    <input type="hidden" name="type" value="<?php if($story->type == 'nano'){ echo 'story'; }else{ echo 'url'; } ?>">
    	    <input type="hidden" name="storywname" value="<?php if($story->type == 'nano'){ echo $story->name; } ?>">
    	    <input type="hidden" name="storywid" value="<?php if($story->type == 'nano'){ echo $story->profile_name; } ?>">
    		<?php $openlinkurl = '#'; if($story->type == 'series'){ 
    		    $openlinkurl = 'series/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->story_id;
    		} elseif(($story->type == 'story') || ($story->type == 'life')) { 
    		    $openlinkurl = 'story/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->sid;
	        } else{ $openlinkurl = '#'; } ?>
    		<input type="hidden" name="url" value="<?php if($story->type != 'nano'){ echo base_url().$openlinkurl; } ?>">
    		<div class="row">
        		<div class="col-md-12">
            		<div class="input-group" style="display:block;">
            		    <input type="text" name="description" class="form-control" placeholder="Enter your text to post on community">
            		</div>
            	</div>
        	</div>
    		<br>
    		<div class="row">
    		    <div class="col-sm-12 user-block">
    		    
        		<?php if(isset($communities_gener) && ($communities_gener->num_rows() >0)){ ?>
        		    <select class="form-control" name="comm_id">
        		        <option value=""> -- Select Community --</option>
        		    <?php foreach($communities_gener->result() as $rowjoin) { ?>
        			    <option value="<?php echo $rowjoin->id; ?>"><?php echo ucfirst($rowjoin->gener);?></option>
        			    
        			    <!-- <input type="checkbox" name="comm_ids[]" value="<?php echo $rowjoin->id; ?>">
        			   <?php if(!empty($rowjoin->comm_image)){ ?>
        			         <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $rowjoin->comm_image;?>" style="float:none;margin-bottom:5px;">
        			    <?php }else{ ?>
        			        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="float:none;margin-bottom:5px;">
        			    <?php } ?> 
        				<span><?php echo ucfirst($rowjoin->gener);?></span>-->
        			
            	    <?php } ?>
            	    </select>
            	<?php } ?>
            	
            	</div>
        	</div>
        <div class="modal-footer" style="padding-bottom:0px;padding-right: 0;">
            <button class="btn btn-primary pull-right sharegroupspinner" type="submit"> Send </button>
        </div>
    	</form> 
    	<!--<center><a href="<?php echo base_url();?>index.php/welcome/<?php echo $openlinkurl;?>" class="btn btn-primary" target="_blank"> Open Link </a></center>-->
    </div>
<?php } } else{ ?>
    <center> Something Wrong in Your Suggestion. Try Again. </center>
<?php } ?>

<script>
	$("form#storysuggestiontogroup").submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>welcome/share_feed_communities",$("form#storysuggestiontogroup").serialize(),function(result) {
		    $('.sharegroupspinner').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
		    /*if(result == 1){
		        $('.resmsg').html('<span class="alert-primary">Story Shared on selected communities Successfully. </span>');
		        console.log('success');
		    }else{
		        $('.resmsg').html('<span class="alert-danger">Failed to share Story on communities. </span>');
		        console.log('fail');
		    }
		    setTimeout(function(){
                $('#groupsuggest').modal('hide');
            }, 3000);*/
            if(result == 1){
                setTimeout(function(){ $('#groupsuggest').modal('hide'); }, 100);
                $('#snackbar').text('Shared to community.').addClass('show');
    			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			
            }else{
                setTimeout(function(){ $('#groupsuggest').modal('hide'); }, 100);
                $('#snackbar').text('Failed to share Story on communities. ').addClass('show');
    			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
            }
		});
	});
</script>