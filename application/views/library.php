<link rel="stylesheet" href="<?php echo base_url();?>assets/css/library.css">
<script>
    $(document).ready(function(){ 
        $("#lib").addClass("active");
    });
</script>

<div class="content-wrapper">
    <section class="content"> 
        <div class="main-container1">
            <div class="">
                <div class="pd">
                    <div class="">
                        <div class="nav-tabs-custom" style="background:transparent">
                            <ul class="nav nav-tabs" style="background: #23678e;">
                                <li class="active"><a href="#tab_1" data-toggle="tab">READ LATER</a></li>
                                <li onclick="subscribedstories();"><a href="#tab_2" data-toggle="tab">SUBSCRIBED</a></li>
                                <li onclick="favoritestories();"><a href="#tab_3" data-toggle="tab">FAVORITE</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <?php $rlscount = 0; if(isset($rlseries) && ($rlseries->num_rows() > 0)){ $rlscount = $rlscount+$rlseries->num_rows(); ?>
                            <div class="row pt-0">
    		                    <div class="col-md-12 col-xs-12 pd-0">
    			                	<div class="titlei">SERIES</div>
    			                </div>
    		                </div><hr>
                            <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
                                <?php foreach($rlseries->result() as $rlseriesrow){ ?>
                                <div class="cardls" id="rllibdel<?php echo $rlseriesrow->sid;?>">
            					    <div class="book-typels"><?php echo $rlseriesrow->gener;?></div>
        			    	        <a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlseriesrow->title).'-'.$rlseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlseriesrow->title).'-'.$rlseriesrow->story_id);?>" class="imagesls-style">
        			    	            <?php if(isset($rlseriesrow->image) && !empty($rlseriesrow->image)) { ?>
        			    	                <img src="<?php echo base_url();?>assets/images/<?php echo $rlseriesrow->image; ?>" alt="<?php echo $rlseriesrow->title;?>" class="imagemels">
        			    	            <?php }else{ ?>
        			    	            	<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $rlseriesrow->title;?>" class="imagemels">
        			    	            <?php } ?>
        			    	        </a>
    			    	            <div class="bottom-left">
    			    	                <a href="javascript:void(0)" onclick="deleterllibrary(<?php echo $rlseriesrow->sid;?>);" title="DELETE">
    								    <i class="fa fa-trash"></i></a>
    								</div>
    			    	            <div class="clear-fix"></div>
            					    <div style="margin-top:-18px;">
    			    	            	<font class="max-linesls">
    			    	            		<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlseriesrow->title).'-'.$rlseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlseriesrow->title).'-'.$rlseriesrow->story_id);?>">
    			    	            			<?php echo $rlseriesrow->title;?>
    			    	            		</a>
    			    	            	</font> 
    			    	            </div>
            						<div class="flextestls">
    					                <font class="bynamels">By<font class="nameherels"><a href="<?php echo base_url($rlseriesrow->profile_name);?>" style="color:#000;"> <?php echo $rlseriesrow->name;?></a></font></font><br>
            						</div>
            					    <div class="flextestls" style="padding-top:4px;">
    				                    <font class="episodesls">
    				                    <?php $keycount = get_episodecount($rlseriesrow->sid); 
    					                    if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
    					                <?php $subsmemcount = get_storysubscount($rlseriesrow->sid); 
    										if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
    									</font><br>
            						</div>
    					            <div class="flextestls" style="padding-top:6px">
                                        <a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlseriesrow->title).'-'.$rlseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlseriesrow->title).'-'.$rlseriesrow->story_id);?>">
							                <button class="readdone"><i class="fa fa-book"></i> Read Now </button>
			                            </a>
    		                	        <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    		                				<span class=""><i class="fa fa-plus"></i></span>
    		                			</button>
    		                			<ul class="dropdown-menu list-inline dropvk">
    		                				<li onclick="groupsuggest(<?php echo $rlseriesrow->sid; ?>);">
    		                					<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
    		                				</li>
    		                				<li onclick="friend(<?php echo $rlseriesrow->sid;?>);">
    		                					<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
    		                				</li>
    		                				<li onclick="socialshare(<?php echo $rlseriesrow->sid;?>, 'series');">
    		                					<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
    		                						<i class="fa fa-share-alt"></i>
    		                					</a>
    		                				</li>
    		                			</ul>
    		                	   </div>
    					        </div><!-- cardls -->
                                <?php } ?>
                            </div>
                        <?php } ?>
                        
                        <!-- Stories -->
            		    <?php if(isset($rlstories) && ($rlstories->num_rows() > 0)){ $rlscount = $rlscount+$rlstories->num_rows(); ?>
            		    <div class="row pt-0">
		                    <div class="col-md-6 col-xs-8 pd-0">
			                	<div class="titlei">STORIES</div>
			                </div>
		                </div><hr>
            		    <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
                            <?php foreach($rlstories->result() as $rlstoryrow) { ?>
                    		    <div class="cardls" id="rllibdel<?php echo $rlstoryrow->sid;?>">
							        <div class="book-type"><?php echo $rlstoryrow->gener;?></div>
    								<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlstoryrow->title).'-'.$rlstoryrow->sid);?>" class="imagesls-style">
        								<?php if(isset($rlstoryrow->image) && !empty($rlstoryrow->image)) { ?>
        							        <img src="<?php echo base_url();?>assets/images/<?php echo $rlstoryrow->image; ?>" alt="<?php echo $rlstoryrow->title;?>" class="imagemels">
        							    <?php }else{ ?>
        								    <img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $rlstoryrow->title;?>" class="imagemels">
    							        <?php } ?>
							        </a>
							        <div class="bottom-left">
							            <a href="javascript:void(0)" onclick="deleterllibrary(<?php echo $rlstoryrow->sid;?>);" title="DELETE">
        					            <i class="fa fa-trash"></i></a>
        		                    </div>
					    	        <div class="clear-fix"></div>
                        			<div style="margin-top:-18px;">
        								<font class="max-lines">
        									<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlstoryrow->title).'-'.$rlstoryrow->sid);?>" class="product-title">
        									    <?php echo $rlstoryrow->title;?>
        									</a>
        								</font> 
        							</div>
        							<div class="flextest">
        								<font class="byname">By<font class="namehere"><a href="<?php echo base_url($rlstoryrow->profile_name);?>" style="color:#000;"> <?php echo $rlstoryrow->name;?></a></font></font><br>
        							</div>
        							<div class="flextest" style="padding-top:4px;">
        								<font class="episodes">
        									<font>
        										<?php $wordcount = explode(' ', $rlstoryrow->story);
        									    $time = round(sizeof($wordcount)/50);	?>
        										<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
        									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $rlstoryrow->views;?>&nbsp;</b></font>
        									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
        										<b><?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
        											foreach($reviews21->result() as $reviews2) { 
        												if($reviews2->sid == $rlstoryrow->sid) {
        													echo round($reviews2->rating);
        												}
        										} } ?></b>
        									 </font>
        								</font><br>
        							</div>
							        <div class="flextest" style="padding-top:6px">
							            <a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlstoryrow->title).'-'.$rlstoryrow->sid);?>">
							                <button class="readdone"><i class="fa fa-book"></i> Read Now </button>
			                            </a>
        								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        									<span class=""><i class="fa fa-plus"></i></span>
        								</button>
        								<ul class="dropdown-menu list-inline dropvk">
        									<li onclick="groupsuggest(<?php echo $rlstoryrow->sid; ?>);">
        										<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
        									</li>
        									<li onclick="friend(<?php echo $rlstoryrow->sid;?>);">
        										<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
        									</li>
        									<li onclick="socialshare(<?php echo $rlstoryrow->sid;?>, 'story');">
        										<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
        											<i class="fa fa-share-alt"></i>
        										</a>
        									</li>
        								</ul>
							        </div>
						        </div><!-- cardls -->
                    		<?php } ?>
                    	</div>
                    	<?php } ?>
                    	
                    	
                    	<!-- Life Events -->
                    	<?php if(isset($rllife) && ($rllife->num_rows() > 0)){ $rlscount = $rlscount+$rllife->num_rows(); ?>
            		    <div class="row pt-0">
		                    <div class="col-md-6 col-xs-8 pd-0">
			                	<div class="titlei">LIFE EVENTS</div>
			                </div>
		                </div><hr>
            		    <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
                            <?php foreach($rllife->result() as $rlliferow) { ?>
                                <div class="card1" style="margin-top:10px" id="rllibdel<?php echo $rlliferow->sid;?>">
        							<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlliferow->title).'-'.$rlliferow->sid);?>" class="imagelife-style">
            							<?php if(isset($rlliferow->image) && !empty($rlliferow->image)) { ?>
            								<img src="<?php echo base_url();?>assets/images/<?php echo $rlliferow->image; ?>" alt="<?php echo $rlliferow->title;?>" class="imageme1">
            							<?php }else{ ?>
            								<img src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $rlliferow->title;?>" class="imageme1">
            							<?php } ?>
        							</a>
        							<div class="bottom-left bottom-left-life" style="top: -158px;">
							            <a href="javascript:void(0)" onclick="deleterllibrary(<?php echo $rlliferow->sid;?>);" title="DELETE">
        					            <i class="fa fa-trash"></i></a>
        		                    </div>
					    	        <div class="clear-fix"></div>
        							<div style="margin-top:-22px;">
            							<font class="max-lines">
            								<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlliferow->title).'-'.$rlliferow->sid);?>"><?php echo $rlliferow->title;?></a>
            							</font> 
        							</div>
        							<div class="flextest">
        								<?php if(($rlliferow->writing_style == 'anonymous') && ($rlliferow->type == 'life')){ ?>
        									<font class="byname">By<font class="namehere"> Anonymous</font></font><br>
        								<?php } else { ?>
        									<font class="byname">By<font class="namehere"><a href="<?php echo base_url($rlliferow->profile_name);?>" style="color:#000;"> <?php echo $rlliferow->name;?></a></font></font><br>
        								<?php } ?>
        							</div>
        							<div class="flextest" style="padding-top:4px;">
        								<font class="lifeEvents-text"><?php echo substr(strip_tags($rlliferow->story),0,150);?> </font>
        							</div>
    							    <div class="flextest" style="padding-top:6px">
    							        <a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $rlliferow->title).'-'.$rlliferow->sid);?>">
							                <button class="readdone"><i class="fa fa-book"></i> Read Now </button>
							            </a>
        								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        									<span class=""><i class="fa fa-plus"></i></span>
        								</button>
        								<ul class="dropdown-menu list-inline dropvklife">
        									<li onclick="groupsuggest(<?php echo $rlliferow->sid; ?>);">
        										<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
        									</li>
        									<li onclick="friend(<?php echo $rlliferow->sid;?>);">
        										<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
        									</li>
        									<li onclick="socialshare(<?php echo $rlliferow->sid;?>, 'story');">
        										<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
        											<i class="fa fa-share-alt"></i>
        										</a>
        									</li>
        								</ul>
    							    </div>
						        </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <!--<?php if($rlscount <= 0){ ?>
                            <center>
                    	        <div style="margin:16% auto 0">
                    	            <div style="width:150px;">
                    	                <img src="<?php echo base_url();?>assets/images/nodata.svg" class="img-responsive" style="width:100%;" alt="No Data">
                    	            </div>
                    	            <div style="font-family: arial,sans-serif;margin-top:5px;">NO STORIES FOUND</div>
                    	        </div>
                    	    </center>
                        <?php } ?>-->
                        <?php if($rlscount <= 0){ ?>
                            <div class="outerv">
                    	        <div class="middlev">
                    	            <div class="innerv">
                    	                <img src="<?php echo base_url();?>assets/images/nodata.svg" class="img-responsive" style="width:100%;" alt="No Data">
                    	            </div>
                    	            <div class="innervd">NO STORIES FOUND</div>
                    	        </div>
                    	    </div>
                        <?php } ?>
            		</div>
                    <div class="tab-pane" id="tab_2"><div style="margin-top:50px;">
                        <center><img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner"></center></div>
                    </div>
                    <div class="tab-pane" id="tab_3"><div style="margin-top:50px;">
                        <center><img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner"></center></div>
                    </div>
            	</div>
            	
            </div>
        </div>
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
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px; margin-bottom:-2px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="" style="padding-top:10px;">
				<div class="row">
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="facebookshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Facebook</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
					    <a href="javascript:void(0);" class="whatsappshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Whatsapp</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="twittershare socsh">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Twitter</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')" class="socsh">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Copy to link</p></a>
					    <input type="hidden" id="copylinkshare" value="<?php echo base_url();?>">
					</div>
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
    function deleterllibrary(story_id){
        $('.deletemessage').html('Are You Sure? Do you want to delete.');
        //$('#confirmdelpopup').modal({ backdrop: 'static', keyboard: false }).one('click', '#delconfirmed', function (e) {
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
            $.ajax({
                type:"post",
                url:"<?php echo base_url('welcome/deletelibrary');?>",
                data:{'story_id':story_id,'type':'readlater'},
                success:function(data){
                	if(data == "1"){
                	    $('#rllibdel'+story_id).css('display','none');
                	    $('#snackbar').text('Successfully Deleted.').addClass('show');
                	    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                	} else{
                	    $('#snackbar').text('Failed to Delete').addClass('show');
                	    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                	}
                }
            });
        });
	}
    function deletesclibrary(story_id){
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
            $.ajax({
                type:"post",
                url:"<?php echo base_url('welcome/deletelibrary');?>",
                data:{'story_id':story_id,'type':'seriessubscribe'},
                success:function(data){
                    if(data == "1"){
                        $('#sclibdel'+story_id).css('display','none');
                        $('#snackbar').text('Successfully Deleted.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    } else{
                        $('#snackbar').text('Failed to Delete').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
            });
        });
    }
    function deletefrlibrary(story_id){
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
            $.ajax({
                type:"post",
                url:"<?php echo base_url('welcome/deletelibrary');?>",
                data:{'story_id':story_id,'type':'favorite'},
                success:function(data){
                    if(data == "1"){
                        $('#frlibdel'+story_id).css('display','none');
                        $('#snackbar').text('Successfully Deleted.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    } else{
                        $('#snackbar').text('Failed to Delete').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
            });
        });
    }
	
	function subscribedstories(){
	    $.ajax({
			type:"post",
			url:"<?php echo base_url('welcome/seriessubscribe');?>",
			success:function(data){
			    $('#tab_2').html(data);
			}
		});
	}
	function favoritestories(){
	    $.ajax({
			type:"post",
			url:"<?php echo base_url('welcome/storiesfavorite');?>",
			success:function(data){
			    $('#tab_3').html(data);
			}
		});
	}
	
</script>
<script type="text/javascript">
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
    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
}
</script>