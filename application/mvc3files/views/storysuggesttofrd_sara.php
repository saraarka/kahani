<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/dist/css/tokenize2.css" />
<?php if(isset($storysuggesttofrd) && ($storysuggesttofrd->num_rows() == 1)){ foreach($storysuggesttofrd->result() as $story){ ?>
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" style="color:#000; opacity:initial; margin-top:2px;">&times;</button>
    	<h4 class="modal-title"> You're suggesting a story <?php echo ucfirst($story->title);?>	</h4>
    </div>
    <div class="modal-body">
        <center><h5 class="resmsg"></h5></center>
    	<form id="storysuggestiontousers">
    		<input type="hidden" name="title" id="title123" value="<?php echo $story->title;?>">
    		<input type="hidden" name="sid" id="sid123" value="<?php echo $story->sid;?>">
    		<?php $openlinkurl = '#'; if($story->type == 'series'){ 
    		    $openlinkurl = 'series/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->story_id; ?>
    		    <input type="hidden" name="url" id="url123" value="<?php echo $openlinkurl;?>">
    		<?php } elseif(($story->type == 'story') || ($story->type == 'life')){ 
    		    $openlinkurl = 'story/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->sid;?>
    		    <input type="hidden" name="url" id="url123" value="<?php echo $openlinkurl;?>">
		    <?php } else{ $openlinkurl = '#';?>
	            <input type="hidden" name="url" id="url123" value="">
    		<?php } ?>
    		<div class="">
        		<!--<?php if(isset($allusers) && ($allusers->num_rows() >0)){ foreach($allusers->result() as $row) { 
        		    if($row->user_id != $this->session->userdata['logged_in']['user_id']){ ?>
        			<div class="col-sm-6">
        				<input type="radio" name="to_id" value="<?php echo $row->user_id; ?>" required ><?php echo $row->name;?>
        			</div>
        		<?php } } } ?> -->
        		<select name="to_ids[]" class="form-control tokenize-sortable-demo1" multiple>
     				<?php if(isset($allusers) && ($allusers->num_rows() >0)){ foreach($allusers->result() as $row){ 
     					if($row->user_id != $this->session->userdata['logged_in']['user_id']){ ?>
     					<option value="<?php echo $row->user_id;?>"><?php echo $row->name;?></option>
     				<?php } } } ?> 
 				</select>
 				
    		</div>
    		<div class="" style="margin-top:5px;">
    		    <input type="text" name="to_idtext" class="form-control" placeholder="Enter your text">
    		</div>
    		<!-- <?php if(isset($allusers) && ($allusers->num_rows() >0)){ foreach($allusers->result() as $row) { 
    		    if($row->user_id != $this->session->userdata['logged_in']['user_id']){ ?>
    			<div class="col-sm-6 user-block">
    			    <?php if(!empty($row->profile_image)){ ?>
    			         <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image;?>" style="float:none;margin-bottom:5px;">
    			    <?php }else{ ?>
    			        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="float:none;margin-bottom:5px;">
    			    <?php } ?>
    				<span><?php echo ucfirst($row->name);?></span>
    			</div>
        	<?php } } } ?> -->
        	<div class="modal-footer" style="padding-bottom:0px;padding-right: 0;">
        	    <button class="btn btn-primary sharefriendspinner" type="submit"> Send </button>
            </div>
    	</form> 
    	<!--<center><a href="<?php echo base_url();?>index.php/welcome/<?php echo $openlinkurl;?>" class="btn btn-primary" target="_blank"> Open Link </a></center>-->
    </div>
    
<?php } } else{ ?>
    <center> Something Wrong in Your Suggestion. Try Again. </center>
<?php } ?>

<script src="<?php echo base_url();?>assets/dist/js/tokenize2.js" type="text/javascript"></script>
<script> // Tags select auto complete
	$('.tokenize-sortable-demo1').tokenize2({
		sortable: true,
		placeholder: 'Please Search and Select writers'
	});
	$('.tokenize-override-demo1').tokenize2();
	$.extend($('.tokenize-override-demo1').tokenize2(), {
		dropdownItemFormat: function(v){
			return $('<a />').html(v.writername + ' override').attr({
				'data-value': v.sid,
				'data-text': v.writername
			})
		}
	});
	$('#btnClear').on('mousedown touchstart', function(e){
		e.preventDefault();
		$('.tokenize-demo1, .tokenize-demo2, .tokenize-demo3').tokenize2().trigger('tokenize:clear');
	});
	
	$("form#storysuggestiontousers").submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>welcome/friendnote",$("form#storysuggestiontousers").serialize(),function(result) {
		    $('.sharefriendspinner').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
		    /*if(result == 1){
		        $('.resmsg').html('<span class="alert-primary">A story successfully suggested to frinds. </span>');
		        console.log('success');
		    }else{
		        $('.resmsg').html('<span class="alert-danger">Failed to suggest a story to frinds. </span>');
		        console.log('fail');
		    }
		    //$('#friendsuggest').modal('hide');
		    setTimeout(function(){
                $('#friendsuggest').modal('hide');
            }, 3000);*/
            if(result == 1){
                setTimeout(function(){ $('#friendsuggest').modal('hide'); }, 100);
                $('#snackbar').text('Successfully suggested the story.').addClass('show');
    			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
    			
            }else{
                setTimeout(function(){ $('#friendsuggest').modal('hide'); }, 100);
                $('#snackbar').text('Failed to suggest Story to frinds.').addClass('show');
    			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
    			
            }
		});
	});
</script>