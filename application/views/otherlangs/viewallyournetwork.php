<link rel="stylesheet" href="<?php echo base_url();?>assets/css/viewallyournetwork.css">

<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content wv">
		<div class="">
    		<!-- // Your network STORIES start-->
    		<div class="main-container1">
    		    <?php if(isset($viewallyournetwork) && ($viewallyournetwork->num_rows() > 0)){ ?>
    		    <div class="row pt-0">
    			    <div class="col-md-12 col-xs-12 pd-0">
    			    	<div class="titlei">YOUR NETWORK STORIES</div>
    			    </div>
    			</div><hr>
    			<div>
    			    <div id="loadmoreall"  style="display:flex; flex-wrap:wrap;" class="jsw">
    	            <?php foreach($viewallyournetwork->result() as $yournetworkrow) { ?>
            	        <div class="cardls">
    						<div class="book-typels"><?php echo $yournetworkrow->gener;?></div>
    						<?php $yournwurl = base_url('story/'.preg_replace('/\s+/', '-', $yournetworkrow->title).'-'.$yournetworkrow->sid);
        						$langfullname = get_langfullname($yournetworkrow->language); 
        						if(isset($langfullname) && !empty($langfullname)){
        						    $yournwurl = base_url($langfullname.'/story/'.preg_replace('/\s+/', '-', $yournetworkrow->title).'-'.$yournetworkrow->sid);
        						} ?>
    						<a href="<?php echo $yournwurl;?>" class="product-title imagesls-style">
    							<?php if(isset($yournetworkrow->cover_image) && !empty($yournetworkrow->cover_image)) { ?>
        						<img src="<?php echo base_url();?>assets/images/<?php echo $yournetworkrow->cover_image; ?>" alt="<?php echo $yournetworkrow->title;?>" class="imagemels">
        						<?php }else{ ?>
        							<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $yournetworkrow->title;?>" class="imagemels">
        						<?php } ?>
        					</a>
    						<div>
    							<font class="max-linesls">
    								<font class="max-linesls"><a href="<?php echo $yournwurl;?>" class="product-title"><?php echo $yournetworkrow->title;?></a></font> 
    							</font> 
    						</div>
    												
    						<div class="flextestls">
    							<font class="bynamels">By<font class="nameherels"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$yournetworkrow->profile_name;?>" style="color:#000"> <?php echo $yournetworkrow->name;?></a></font></font><br>
    						</div>
    									
    						<div class="flextestls" style="padding-top:4px;">
    							<font class = "episodesls">
    								<font>
    									<?php $wordcount = explode(' ', $yournetworkrow->story);
    								$time = round(sizeof($wordcount)/50);	?>
    									<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
    								<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $yournetworkrow->views;?>&nbsp;</b></font>
    								<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    									<b>
    									<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    										foreach($reviews21->result() as $reviews2) { 
    											if($reviews2->sid == $yournetworkrow->sid) {
    												echo round($reviews2->rating);
    											}
    									} } ?>
    									</b>
    								</font>
    							</font><br>
    						</div>
    						
    						<div class="flextestls" style="padding-top:6px">
    							<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($yournetworkrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    								
    									<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    								
    							<?php }else{ ?>
    								<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($yournetworkrow->sid, $readlatersids)) { ?>
    									<button onclick="unreadlater(<?php echo $yournetworkrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $yournetworkrow->sid;?>">
    									<i class="fa fa-check faicon<?php echo $yournetworkrow->sid;?>"></i> Read later </button>
    								<?php }else { ?>
    									<button onclick="readlater(<?php echo $yournetworkrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $yournetworkrow->sid;?>">
    									<i class="fa fa-bookmark faicon<?php echo $yournetworkrow->sid;?>"></i> Read later </button>
    								<?php } ?>
    							<?php } ?>
    							
    							<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    								<span class=""><i class="fa fa-plus"></i></span>
    							</button>
    							<ul class="dropdown-menu list-inline dropvk">
    								<li onclick="groupsuggest(<?php echo $yournetworkrow->sid; ?>);">
    									<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
    								</li>
    								<li onclick="friend(<?php echo $yournetworkrow->sid;?>);">
    									<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
    								</li>
    								<li onclick="socialshare(<?php echo $yournetworkrow->sid;?>, 'story');">
    									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
    										<i class="fa fa-share-alt"></i>
    									</a>
    								</li>
    							</ul>
    						</div>
    					</div>
                    <?php } ?>
    			    </div>
                </div>
                <?php } ?>
                <div id="load_data_message"></div>
            </div><!-- // Your network STORIES end-->
    		<div class="clear-fix"></div>
		</div><br>
    </section>
</div>

<!-- group suggest popup code ---- -->
<div class="modal fade" id="groupsuggest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code ----------- -->
<!-- frind popup code ------>
<div class="modal fade" id="friendsuggest" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttofriend"></div>
		</div>
	</div>
</div>
<!--frind popup end ------------->

<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv ">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px;margin-bottom:-2px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="" style="padding-top:10px;">
				<div class="row">
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" class="facebookshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;margin-top:-10px;"/><p class="socialsharepopupspan">Facebook</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
					    <a href="javascript:void(0);" class="whatsappshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;margin-top:-10px;"/><p class="socialsharepopupspan">Whatsapp</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" class="twittershare socsh">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Twitter</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')" class="socsh">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px;height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Copy to link</p></a>
					    <input type="hidden" id="copylinkshare" value="<?php echo base_url();?>">
					</div>
				</div>v>
				</div>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Social popup ---- -->

<script>
    $(document).ready(function(){
        var limit = 7;
        var start = 7;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/viewallloadyournetwork',
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
<script>
    function genericSocialShare(url){
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }
    function copylinkshare(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
        $('#snackbar').text('Link Copied to clipboard...').addClass('show');
        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    }
</script>