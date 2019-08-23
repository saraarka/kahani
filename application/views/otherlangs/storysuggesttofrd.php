<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/dist/css/tokenize2.css" />
<style>
.tokenize-dropdown > .dropdown-menu {
    min-height: 10px;
    width: 100%;
    display: block;
    margin: -1px 0 0 0;
    visibility: visible;
    opacity: 1;
    max-height:105px;
    overflow-y:scroll;
    text-align: left;
    list-style: none;
    background-color: #fff;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    font-size: 15px;
    text-align: left;
    font-family: "Arial";
    -webkit-background-clip: padding-box;
          background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
          box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}
</style>
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
    		    $openlinkurl = $this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->story_id; ?>
    		    <input type="hidden" name="url" id="url123" value="<?php echo $openlinkurl; ?>">
    		<?php } elseif(($story->type == 'story') || ($story->type == 'life')) {
    		    $openlinkurl = $this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $story->title).'-'.$story->sid; ?>
    		    <input type="hidden" name="url" id="url123" value="<?php echo $openlinkurl;?>">
	        <?php } else{ $openlinkurl = '#';?>
	            <input type="hidden" name="url" id="url123" value="">
    		<?php } ?>
    		<div class="">
        		<select name="to_ids[]" class="form-control tokenize-callable-demo1" multiple placeholder="Enter username to suggest"></select>
    		</div>
    		<div class="" style="margin-top:5px;">
    		    <input type="text" name="to_idtext" class="form-control" placeholder="Enter your text">
    		</div>
        	<div class="modal-footer" style="padding-bottom:0px;padding-right: 0;">
        	    <button class="btn btn-primary sharefriendspinner" type="submit"> Send </button>
        	</div>
    	</form>
    </div>
    
<?php } } else{ ?>
    <center> Something Wrong in Your Suggestion. Try Again. </center>
<?php } ?>

<script src="<?php echo base_url();?>assets/dist/js/sugfrdtokenize.js" type="text/javascript"></script>
<script>
    $('.tokenize-callable-demo1').tokenize2({
		placeholder: "Enter username to suggest",
        dataSource: function(search, object){  // search and get tokens
            $.ajax('<?php echo base_url().$this->uri->segment(1);?>/allusers', {
                data: { search: search, start: 1 },
                dataType: 'json',
                success: function(data){
                    var $items = [];
                    $.each(data, function(k, v){
                        $items.push(v);
                    });
                    object.trigger('tokenize:dropdown:fill', [$items]);
                }
            });
        }
    });
</script>
<script>	
	$("form#storysuggestiontousers").submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url().$this->uri->segment(1);?>/friendnote",$("form#storysuggestiontousers").serialize(),function(result) {
		    $('.sharefriendspinner').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
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