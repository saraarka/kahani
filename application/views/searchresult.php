<link rel="stylesheet" href="<?php echo base_url();?>assets/css/searchresult.css">

<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="main-containerv">
            <div class="">
                <div class="visiblev" style="margin-bottom:20px;">
                   <center>
                        <form class="form-inline my-2 my-lg-0" method="GET" id="searchpost" action="<?php echo base_url();?>search">
                            <input type="text" class="search-box" name="searchtext" value="<?php if(isset($searchtext) && !empty($searchtext)){ echo $searchtext; }?>" placeholder="Search for writers, stories, Series and more..." style="background:transparent; border-bottom:2px solid #3c8dbc;">
                            <button class="search-button" type="submit" style="background:#3c8dbc"><i class="fa fa-search" aria-hidden="true" style="font-size:18px;"></i></button>
                        </form>
                    </center>
                </div>
            </div>
            <div class="cenv" style="margin-bottom:20px;">
                <ul class="nav nav-pills">
            		<li <?php if(!isset($_GET['type']) || ($_GET['type'] == '')){?>class="active"<?php } ?>>
            		    <a href="<?php echo base_url();?>search?searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>"> ALL </a>
            		</li>
            		<li <?php if(isset($_GET['type']) && ($_GET['type'] == 'story')){?>class="active"<?php } ?>>
            		    <a href="<?php echo base_url();?>searchresult?type=story&searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>"> STORIES </a></li>
            		
            		<li <?php if(isset($_GET['type']) && ($_GET['type'] == 'series')){?>class="active"<?php } ?>>
            		    <a href="<?php echo base_url();?>searchresult?type=series&searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>"> SERIES </a>
            		</li>
            		<li <?php if(isset($_GET['type']) && ($_GET['type'] == 'life')){?>class="active"<?php } ?>>
            		    <a href="<?php echo base_url();?>searchresult?type=life&searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>"> LIFE EVENTS </a>
            		</li>
            		<li <?php if(isset($_GET['type']) && ($_GET['type'] == 'people')){?>class="active"<?php } ?>>
            		    <a href="<?php echo base_url();?>searchresultwriter?type=people&searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>"> PEOPLE </a>
            		</li>
            	</ul>
            </div>
            
    		<div class="">
    		    <?php if(isset($searchresults) && ($searchresults->num_rows() > 0) && ($_GET['type'] == 'series')){ ?>
    			    <!-- Series Start -->	
                	<div class="pd-0">
        		        <span class="titlei">SERIES</span>
        		    </div><hr>
            		<div class="mg-2">
    				    <div style="display:flex; flex-wrap:wrap; justify-content:center;" id="loadmoreall">
                			<?php foreach($searchresults->result() as $seriesrow) { ?>
                			<div class="card">
    						    <div class="book-type"><?php echo $seriesrow->gener;?></div>
    							<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->story_id);?>" class="imagesls-style">
        							<?php if(isset($seriesrow->image) && !empty($seriesrow->image)) { ?>
        							    <img src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->image; ?>" alt="<?php echo ($seriesrow->title);?>" class="imageme">
        							<?php }else{ ?>
        								<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($seriesrow->title);?>" class="imageme">
        							<?php } ?>
    							</a>
        						<div>
        							<font class="max-lines">
        								<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->story_id);?>" style="color: #337ab7;">
        									<?php echo ($seriesrow->title);?>
        								</a>
        							</font> 
        						</div>
        						<div class="flextest">
        							<font class="byname">By<font class="namehere">
        							    <a href="<?php echo base_url($seriesrow->profile_name);?>" style="color:#000"> <?php echo $seriesrow->name;?></a></font></font><br>
        						</div>
        						<div class="flextest" style="padding-top:4px;">
        							<font class="episodes">
        								<?php $keycount = get_episodecount($seriesrow->sid); 
        								if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
        								<?php $subsmemcount = get_storysubscount($seriesrow->sid); 
        								if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
        							</font><br>
        						</div>
    						    <div class="flextest" style="padding-top:6px">
        							<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($seriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
        								<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
        							<?php }else{ ?>
        								<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($seriesrow->sid, $readlatersids)) { ?>
        									<button onclick="unreadlater(<?php echo $seriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
        									<i class="fa fa-check faicon<?php echo $seriesrow->sid;?>"></i> Read later </button>
        								<?php }else { ?>
        									<button onclick="readlater(<?php echo $seriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
        									<i class="fa fa-bookmark faicon<?php echo $seriesrow->sid;?>"></i> Read later </button>
        								<?php } ?>
        							<?php } ?>
        							<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        								<span class=""><i class="fa fa-plus"></i></span>
        							</button>
        							<ul class="dropdown-menu list-inline dropvk">
        								<li onclick="groupsuggest(<?php echo $seriesrow->sid; ?>);">
        									<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
        								</li>
        								<li onclick="friend(<?php echo $seriesrow->sid;?>);">
        									<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
        								</li>
        								<li onclick="socialshare(<?php echo $seriesrow->sid;?>, 'series');">
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
                    <div id="load_data_message"></div>
            		<!-- Series End -->
    			<?php } else if(isset($searchresults) && ($searchresults->num_rows() > 0) && ($_GET['type'] == 'story')){ ?>
    			    <div class="pd-0">
        		        <span class="titlei">STORIES</span>
        		    </div><hr>
    			    <div class="mg-2">
    				    <div style="display:flex; flex-wrap:wrap; justify-content:center;" id="loadmoreall">
    				    <?php foreach($searchresults->result() as $storyrow) { ?>
    				    	<div class="card">
        						<div class="book-type"><?php echo $storyrow->gener;?></div>
        							<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $storyrow->title).'-'.$storyrow->sid);?>" class="imagesls-style">
            							<?php if(isset($storyrow->image) && !empty($storyrow->image)) { ?>
            							<img src="<?php echo base_url();?>assets/images/<?php echo $storyrow->image; ?>" alt="<?php echo ($storyrow->title);?>" class="imageme">
            							<?php }else{ ?>
            								<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($storyrow->title);?>" class="imageme">
            							<?php } ?>
        						    </a>
        						<div>
        							<font class="max-lines">
        								<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $storyrow->title).'-'.$storyrow->sid);?>" style="color: #337ab7;">
        									<?php echo ($storyrow->title);?>
        								</a>
        							</font> 
        						</div>
        						<div class="flextest">
        							<font class="byname">By<font class="namehere">
        							    <a href="<?php echo base_url($storyrow->profile_name);?>" style="color:#000"> <?php echo $storyrow->name;?></a>
        							</font></font><br>
        						</div>
        						<div class="flextest" style="padding-top:4px;">
    								<font class = "episodes">
    									<font>
    										<?php $wordcount = explode(' ', $storyrow->story);
    									    $time = round(sizeof($wordcount)/180);	?>
    										<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
    									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $storyrow->views;?>&nbsp;</b></font>
    									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    										<b>
    										<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    											foreach($reviews21->result() as $reviews2) { 
    												if($reviews2->sid == $storyrow->sid) {
    													echo round($reviews2->rating);
    												}
    										} } ?>
    										</b>
    									</font>
    								</font><br>
    							</div>
    							<div class="flextest" style="padding-top:6px">
    								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($storyrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    									
    										<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    									
    								<?php }else{ ?>
    									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($storyrow->sid, $readlatersids)) { ?>
    										<button onclick="unreadlater(<?php echo $storyrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $storyrow->sid;?>">
    										<i class="fa fa-check faicon<?php echo $storyrow->sid;?>"></i> Read later </button>
    									<?php }else { ?>
    										<button onclick="readlater(<?php echo $storyrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $storyrow->sid;?>">
    										<i class="fa fa-bookmark faicon<?php echo $storyrow->sid;?>"></i> Read later </button>
    									<?php } ?>
    								<?php } ?>
    								
    								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    									<span class=""><i class="fa fa-plus"></i></span>
    								</button>
    								<ul class="dropdown-menu list-inline dropvk">
    									<li onclick="groupsuggest(<?php echo $storyrow->sid; ?>);">
    										<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    									</li>
    									<li onclick="friend(<?php echo $storyrow->sid;?>);">
    										<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    									</li>
    									<li onclick="socialshare(<?php echo $storyrow->sid;?>, 'story');">
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
        		    <div id="load_data_message"></div>
                <?php } else if(isset($searchresults) && ($searchresults->num_rows() > 0) && ($_GET['type'] == 'life')){ ?>
                    <div class="pd-0">
        		        <span class="titlei">Life events</span>
        		    </div><hr>
                    <div style="display:flex; flex-wrap:wrap; justify-content:center;" id="loadmoreall">
                        <?php foreach($searchresults->result() as $liferow) { ?>
        			    <div class="card1">
            				<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $liferow->title).'-'.$liferow->sid);?>" class="imagelife-style">
            				<?php if(isset($liferow->image) && !empty($liferow->image)) { ?>
            					<img src="<?php echo base_url();?>assets/images/<?php echo $liferow->image; ?>" alt="<?php echo $liferow->title;?>" class="imageme1">
            				<?php }else{ ?>
            					<img src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $liferow->title;?>" class="imageme1">
            				<?php } ?>
            				</a>	
            				<div>
            				<font class="max-lines">
            					<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $liferow->title).'-'.$liferow->sid);?>" style="color: #337ab7;">
            						<?php echo $liferow->title;?>
            					</a>
            				</font> 
            				</div>
            				
            				
            				<div class="flextest">
            					<?php if(($liferow->writing_style == 'anonymous') && ($liferow->type == 'life')){ ?>
            						<font class="byname">By<font class="namehere"><a href="javascript:void(0);" style="color:#000"> Anonymous</a></font></font><br>
            					<?php } else { ?>
            						<font class="byname">By<font class="namehere">
            						    <a href="<?php echo base_url($liferow->profile_name);?>" style="color:#000"> <?php echo $liferow->name;?></a></font></font>
            						<br>
            					<?php } ?>
            				</div>
            				
            				<div class="flextest" style="padding-top:4px;">
            					<font class="lifeEvents-text"><?php echo substr(strip_tags($liferow->story),0,150);?></font>
            				</div>
            			
            				<div class="flextest" style="padding-top:6px">
            					<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($liferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
            						
            							<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
            						
            					<?php }else{ ?>
            						<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($liferow->sid, $readlatersids)) { ?>
            							<button onclick="unreadlater(<?php echo $liferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
            							<i class="fa fa-check faicon<?php echo $liferow->sid;?>"></i> Read later </button>
            						<?php }else { ?>
            							<button onclick="readlater(<?php echo $liferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
            							<i class="fa fa-bookmark faicon<?php echo $liferow->sid;?>"></i> Read later </button>
            						<?php } ?>
            					<?php } ?>
            					
            					<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
            						<span class=""><i class="fa fa-plus"></i></span>
            					</button>
            					<ul class="dropdown-menu list-inline dropvklife">
            						<li onclick="groupsuggest(<?php echo $liferow->sid; ?>);">
            							<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
            						</li>
            						<li onclick="friend(<?php echo $liferow->sid;?>);">
            							<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
            						</li>
            						<li onclick="socialshare(<?php echo $liferow->sid;?>, 'story');">
										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
											<i class="fa fa-share-alt"></i>
										</a>
									</li>
            					</ul>
            				</div>
            			</div>
        			    <?php } ?>
        			</div>
        			<div id="load_data_message"></div>
                <?php } else if(isset($searchresults) && ($searchresults->num_rows() > 0) && ($_GET['type'] == 'people')){ ?>
                	<!-- Writers search -->
                	<div class="pd-0">
        		        <span class="titlei">People</span>
        		    </div><hr>
            	    <div style="display:flex; flex-wrap:wrap; justify-content:center;" id="loadmoreall">
            		<?php foreach($searchresults->result() as $writerrow) { ?>
            			<div class="card1" style="height:215px">
                		    <?php if(isset($writerrow->pbanner_image) && !empty($writerrow->pbanner_image)){ ?>
    				        <div class="imageme1" style="height:115px; background-position:center; background:url(<?php echo base_url();?>assets/images/<?php echo $writerrow->pbanner_image; ?>) center center; background-size:cover">
    					        <div style="padding:9px; background:rgba(0, 0, 0, 0.64);height:115px;">
    					            <a href="<?php echo base_url($writerrow->profile_name);?>">
    						            <?php if(isset($writerrow->profile_image) && !empty($writerrow->profile_image)) { ?>
    						            	<img src="<?php echo base_url();?>assets/images/<?php echo $writerrow->profile_image; ?>" class="circle-image" alt="<?php echo $writerrow->name;?>" style="height:50px">
    						            <?php }else{ ?>
    						            	<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" alt="<?php echo $writerrow->name;?>" style="height:50px">
    						            <?php } ?>
    					            </a>
    					            <h3 class="name-nanostories" style="color:#fff">
    					                <a href="<?php echo base_url($writerrow->profile_name);?>" style="color:#FFF;"><?php echo $writerrow->name;?></a>
    					            </h3>
    					            <p class="writerc"><?php echo $writerrow->aboutus; ?></p>
    					        </div>
    				        </div>
    				        <?php } else{ ?>
    				        <div class="imageme1" style="height:115px; background-position:center; background: linear-gradient(-60deg,RoyalBlue,brown);background-size:cover">
    					        <div style="padding:9px; background:rgba(0, 0, 0, 0.64);height:115px;">
    					            <a href="<?php echo base_url($writerrow->profile_name);?>">
    						            <?php if(isset($writerrow->profile_image) && !empty($writerrow->profile_image)) { ?>
    						            	<img src="<?php echo base_url();?>assets/images/<?php echo $writerrow->profile_image; ?>" class="circle-image" alt="<?php echo $writerrow->name;?>" style="height:50px">
    						            <?php }else{ ?>
    						            	<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" alt="<?php echo $writerrow->name;?>" style="height:50px">
    						            <?php } ?>
    					            </a>
    					            <h3 class="name-nanostories" style="color:#fff">
    					                <a href="<?php echo base_url($writerrow->profile_name);?>" style="color:#FFF;"><?php echo $writerrow->name;?></a>
    					            </h3>
    					            <p class="writerc"><?php echo $writerrow->aboutus; ?></p>
    					        </div>
    				        </div>
    				        <?php } ?>
    				        <div style="padding-top:6px;">
    				            <center>
    				                <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $writerrow->user_id)){ ?>
                                        <button class="vjw btn btn-success" onclick="yoursfollow()"> FOLLOW </button>
                                    <?php } else { ?>
                                        <?php if(isset($following) && in_array($writerrow->user_id, $following)) { ?>
                                            <button class="vjw btn btn-primary notloginmodal unfollow<?php echo $writerrow->user_id;?>" onclick="writerunfollow(<?php echo $writerrow->user_id;?>,'<?php echo $writerrow->name;?>')"> FOLLOWING </button>
                                        <?php } else { ?>
                                            <button class="vjw btn btn-success notloginmodal follow<?php echo $writerrow->user_id;?>" onclick="writerfollow(<?php echo $writerrow->user_id;?>,'<?php echo $writerrow->name;?>')"> FOLLOW </button>
                                        <?php } ?>
                                    <?php } ?>
    				            </center>
    				            <ul class="list-inlinev writers" style="padding:0">
    				                <li>
    				                <?php $writings = get_writingsjoins($writerrow->user_id);
        							    if(isset($writings['userwcount'])) { echo $writings['userwcount']; }else{ echo 0; } ?><br>
    				                    WRITINGS
    				                </li>
    				                <li class="border-lr">
    	                            <?php $wstoriesviews = get_wstoriesviews($writerrow->user_id);
        								if(isset($wstoriesviews['wstoriesviews'])) { echo $wstoriesviews['wstoriesviews']; }else{ echo 0; } ?><br>
    				                    VIEWS
    				                </li>
    				                <li>
    				                    <span id="follcount<?php echo $writerrow->user_id;?>">
                                        <?php $reviewscount = 0; if(isset($follow_count) && ($follow_count->num_rows()>0)) {
                                            foreach($follow_count->result() as $reviews2){ if($reviews2->writer_id == $writerrow->user_id) {
                                                $reviewscount = $reviews2->follo; 
                                            }   } 
                                        } echo $reviewscount; ?> </span><br>
    				                    FOLLOWERS
    				                </li>
    				            </ul>
    				        </div>
    			        </div>
            		<?php } ?>
            		</div>
            		<div id="load_data_message"></div>
                <?php } else { ?>
    	            <div class="outerv hidden-xs">
            	        <div class="middlev hidden-xs">
            	            <div class="innerv">
            	                <img src="<?php echo base_url();?>assets/images/nodata.svg" class="img-responsive" style="width:100%;" alt="No Data">
            	                <div style="font-family: arial,sans-serif;margin-top:5px;"><center>NO STORIES FOUND</center></div>
            	            </div>
            	        </div>
            	    </div>
                    <?php if(isset($_GET['searchtext']) && !empty($_GET['searchtext'])){ ?>
            	    <div class="hidden-md hidden-lg" style="margin-bottom:20px;">
            	        <center>
                	        <div style="margin:10.8% auto">
                	            <div style="width:150px;">
                	                <img src="<?php echo base_url();?>assets/images/nodata.svg" class="img-responsive" style="width:100%;" alt="No Data">
                	            </div>
                	            <div style="font-family: arial,sans-serif;margin-top:5px;"><center>NO STORIES FOUND</center></div>
                	        </div>
                	    </center>
            	    </div>
                    <?php } ?>
                <?php } ?>
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
		<div class="modal-content socv">
			<div class="modal-header">
				<button type="button" class="close" style="color:#000; opacity:initial; font-size: 23px;" data-dismiss="modal" aria-label="Close">&times;</button>
				<h5 class="modal-title" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="" style="padding-top:10px;">
				<div class="row" style="margin-left: -15px;">
					<div class="col-md-12 pd-5v" style="padding-bottom:5px;">
						<a href="javascript:void(0);" class="facebookshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;margin-top:-8px;"/> <p class="socialsharepopupspan">Facebook</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="padding-bottom:5px;">
					    <a href="javascript:void(0);" class="whatsappshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;margin-top:-8px;"/> <p class="socialsharepopupspan">Whatsapp</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="padding-bottom:5px;">
						<a href="javascript:void(0);" class="twittershare socsh">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;margin-top:-8px;"/> <p class="socialsharepopupspan">Twitter</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="padding-bottom:5px;">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')" class="socsh">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;margin-top:-8px;"/> <p class="socialsharepopupspan">Copy to link</p></a>
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
    $(document).ready(function(){
        var limit = 7;
        var start = 0;
        var action = 'inactive';
        function load_country_data(limit, start) {
            var vatype = "<?php echo $_GET['type'];?>";
            var vaquery = "<?php echo $_GET['searchtext'];?>";
            if(vatype == "people"){
                $.ajax({
                    url:'<?php echo base_url();?>welcome/searchwriterloadmore?type='+vatype+'&searchtext='+vaquery,
                    method:"POST",
                    data:{limit:limit, start:start},
                    cache:false,
                    success:function(data){
                        $('#loadmoreall').append(data);
                        if(data == '') {
                            $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:10px;'> No More Results!</div></center>");
                            action = 'active';
                        }else{
                            $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                            action = "inactive";
                        }
                    }
                });
            }else{
                $.ajax({
                    url:'<?php echo base_url();?>welcome/searchresultloadmore?type='+vatype+'&searchtext='+vaquery,
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
        }
        /*if(action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        }*/
        $(window).scroll(function(){
            //if($(window).scrollTop() + $(window).height() > $("#loadmoreall").height() && action == 'inactive'){
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