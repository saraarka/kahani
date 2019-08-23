<?php if(isset($generseries) && ($generseries->num_rows() > 0 )){ foreach($generseries->result() as $seriesrow) { ?>
    <div class="cardls">
	    <div class="book-type"><?php echo $seriesrow->gener;?></div>
	    	<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace('/\s+/', '-', $seriesrow->title).'-'.$seriesrow->story_id);?>">
    	    	<?php if(isset($seriesrow->image) && !empty($seriesrow->image)) { ?>
    	    	    <img src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->image; ?>" alt="<?php echo $seriesrow->title;?>" class="imagemels">
    	    	<?php }else{ ?>
    	    		<img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $seriesrow->title;?>" class="imagemels">
    	    	<?php } ?>
	    	</a>
	    	<div>
	    		<font class="max-linesls">
	    			<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace('/\s+/', '-', $seriesrow->title).'-'.$seriesrow->story_id);?>" class="product-title">
	    				<?php echo $seriesrow->title;?>
	    			</a>
	    		</font> 
	    	</div>
		<div class="flextestls">
			<font class="bynamels">By<font class="nameherels">
			    <a href="<?php echo base_url($this->uri->segment(1)."/".$seriesrow->profile_name);?>" style="color:#000"><?php echo $seriesrow->name;?></a></font></font><br>
		</div>
	    <div class="flextestls" style="padding-top:4px;">
		    <font class="episodesls">
			<?php $keycount = get_episodecount($seriesrow->sid); 
				if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES |
			<?php $subsmemcount = get_storysubscount($seriesrow->sid); 
				if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS</font><br>
		</div>
		<div class="flextest" style="padding-top:6px">
		    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($seriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
		        <button class="read" style="background:none; border:none;" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
	        <?php }else if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
            	<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($seriesrow->sid, $readlatersids)) { ?>
            		<button onclick="unreadlater(<?php echo $seriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
            		<i class="fa fa-check faicon<?php echo $seriesrow->sid;?>"></i> Read later </button>
            	<?php }else { ?>
            		<button onclick="readlater(<?php echo $seriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
            		<i class="fa fa-bookmark faicon<?php echo $seriesrow->sid;?>"></i> Read later </button>
            	<?php } ?>
            <?php } else{ ?>
			    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
			<?php } ?>
		        
	        <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
				<span class=""><i class="fa fa-plus"></i></span>
			</button>
			<ul class="dropdown-menu list-inline dropvk">
				<li onclick="groupsuggest(<?php echo $seriesrow->sid; ?>);">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
				</li>
				<li onclick="friend(<?php echo $seriesrow->sid;?>);">
					<a dhref="javascript:void(0)" ata-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
				</li>
				<li onclick="socialshare(<?php echo $seriesrow->sid;?>, 'series');">
					<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
						<i class="fa fa-share-alt"></i>
					</a>
				</li>
			</ul>
	    </div>
	</div>

	<!-- /.col -->
<?php } ?>
<input type="hidden" id="generid" value="<?php echo $seriesrow->genre; ?>">
<?php } else{ ?>
<center>
    <div class="load-more col-md-12"> No Results Found! </div>
</center>
<?php } ?>

<script>
    $(document).ready(function(){
        var limit = 4;
        var start = 4;
        var action = 'inactive';
        function load_country_data(limit, start) {
            var gener = $('#generid').val();
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/generviewallloadmore/'+gener,
                method:"POST",
                data:{limit:limit, start:start},
                cache:false,
                success:function(data){
                    $('#loadmoreall').append(data);
                    if(data == '') {
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        action = 'active';
                    }else{
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        action = "inactive";
                    }
                }
            });
        }
        if(action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        }
        $(window).scroll(function(){
            if ($(window).scrollTop() >= (($("#loadmoreall").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 500);
            }
        });
    });
</script>