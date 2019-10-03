<link rel="stylesheet" href="<?php echo base_url();?>assets/css/searchdata.css">

<?php $pagestoriescount = 0; $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="main-containerv">
            <div class="">
                <div class="hidden-md hidden-lg" style="margin-bottom:20px;">
                   <center>
                        <form class="form-inline my-2 my-lg-0" method="GET" id="searchpost" action="<?php echo base_url();?>search">
                            <input type="text" class="search-box" name="searchtext" value="<?php if(isset($searchtext) && !empty($searchtext)){ echo $searchtext; }?>" placeholder="Search for writers, stories, Series and more..." style="background:transparent; border-bottom:2px solid #3c8dbc;" required>
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
        	    <!-- Series Start -->	
            	<?php if(isset($get_series) && ($get_series->num_rows() > 0)){ $pagestoriescount = $pagestoriescount+$get_series->num_rows(); ?>
            	<div class="pd-0">
    		        <span class="titlei">SERIES</span>
    		        <?php if($get_series->num_rows() > 4){ ?>
    		        <a href="<?php echo base_url();?>searchresult?type=series&searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>" class="view pull-right">
    		            <span class="pull-right">VIEW MORE</span>
    		        </a>
    		        <?php } ?>
    		    </div><hr>
        		<div class="mg-2">
    		        <div id="StoryContls" class="StoryCont1" style="text-align:left;">
    				    <div id="story-sliderls" class="story-slider series">
                			<?php $i = 0; foreach($get_series->result() as $seriesrow) { if($i < 4){ ?>
                			<div class="card">
    						    <div class="book-type"><?php echo $seriesrow->gener;?></div>
    							<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u",'-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $seriesrow->title).'-'.$seriesrow->story_id);?>" class="imagess-style">
        							<?php if(isset($seriesrow->image) && !empty($seriesrow->image)) { ?>
        							    <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->image; ?>" alt="<?php echo ($seriesrow->title);?>" class="imageme lazy">
        							<?php }else{ ?>
        								<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($seriesrow->title);?>" class="imageme lazy">
        							<?php } ?>
    							</a>
        						<div>
        							<font class="max-lines">
        								<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u",'-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $seriesrow->title).'-'.$seriesrow->story_id);?>">
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
                			<?php $i++; } } ?>
                		</div>
                	</div>
                </div>
        		<?php } ?>
        	    <!-- Series End -->
        	    
        	    <!-- Stories Start -->
        	    <?php if(isset($get_storys) && ($get_storys->num_rows() > 0)){ $pagestoriescount = $pagestoriescount+$get_storys->num_rows(); ?>
        		<div class="pd-0">
    		        <span class="titlei">Stories</span>
    		        <?php if($get_storys->num_rows() > 4){ ?>
    		        <a href="<?php echo base_url();?>searchresult?type=story&searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>" class="view pull-right">
    		            <span class="pull-right">VIEW MORE</span>
    		        </a>
    		        <?php } ?>
    		    </div><hr>
        		<div class="mg-2">
    		        <div id="StoryCont" class="StoryCont1" style="text-align:left;">
    				    <div id="story-slider" class="story-slider series">
    				    <?php $i=0; foreach($get_storys->result() as $storysrow) { if($i<4){  ?>
    				    	<div class="card">
        						<div class="book-type"><?php echo $storysrow->gener;?></div>
        						<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $storysrow->title).'-'.$storysrow->sid);?>" class="imagess-style">
        							<?php if(isset($storysrow->image) && !empty($storysrow->image)) { ?>
        							<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $storysrow->image; ?>" alt="<?php echo ($storysrow->title);?>" class="imageme lazy">
        							<?php }else{ ?>
        								<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($storysrow->title);?>" class="imageme lazy">
        							<?php } ?>
        						</a>
        						<div>
        							<font class="max-lines">
        								<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $storysrow->title).'-'.$storysrow->sid);?>">
        									<?php echo ($storysrow->title);?>
        								</a>
        							</font> 
        						</div>
        						<div class="flextest">
        							<font class="byname">By<font class="namehere">
        							    <a href="<?php echo base_url($storysrow->profile_name);?>" style="color:#000"> <?php echo $storysrow->name;?></a></font></font><br>
        						</div>
        						<div class="flextest" style="padding-top:4px;">
    								<font class="episodes">
    									<font>
    										<?php $wordcount = explode(' ', $storysrow->story);
    									$time = round(sizeof($wordcount)/50);	?>
    										<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
    									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $storysrow->views;?>&nbsp;</b></font>
    									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    										<b>
    										<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    											foreach($reviews21->result() as $reviews2) { 
    												if($reviews2->sid == $storysrow->sid) {
    													echo round($reviews2->rating);
    												}
    										} } ?>
    										</b>
    									</font>
    								</font><br>
    							</div>
    							<div class="flextest" style="padding-top:6px">
    								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($storysrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    									<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    								<?php }else{ ?>
    									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($storysrow->sid, $readlatersids)) { ?>
    										<button onclick="unreadlater(<?php echo $storysrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $storysrow->sid;?>">
    										<i class="fa fa-check faicon<?php echo $storysrow->sid;?>"></i> Read later </button>
    									<?php }else { ?>
    										<button onclick="readlater(<?php echo $storysrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $storysrow->sid;?>">
    										<i class="fa fa-bookmark faicon<?php echo $storysrow->sid;?>"></i> Read later </button>
    									<?php } ?>
    								<?php } ?>
    								
    								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    									<span class=""><i class="fa fa-plus"></i></span>
    								</button>
    								<ul class="dropdown-menu list-inline dropvk">
    									<li onclick="groupsuggest(<?php echo $storysrow->sid; ?>);">
    										<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    									</li>
    									<li onclick="friend(<?php echo $storysrow->sid;?>);">
    										<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    									</li>
    									<li onclick="socialshare(<?php echo $storysrow->sid;?>, 'story');">
        									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
        										<i class="fa fa-share-alt"></i>
        									</a>
        								</li>
    								</ul>
    							</div>
    						</div>        
    				    	<?php }$i++;} ?>
    				    </div>
    			    </div>
    		    </div>
        		
        	    <?php } ?>
        	    <!-- Stories End -->
        	    
        	    <!-- Life Events Start -->
        	    <?php if(isset($get_life) && ($get_life->num_rows() > 0)){ $pagestoriescount = $pagestoriescount+$get_life->num_rows(); ?>
        		<div class="pd-0">
    		        <span class="titlei">Life events</span>
    		        <?php if($get_life->num_rows() >= 3){ ?>
    		        <span class="view pull-right">
    		    	   <a href="<?php echo base_url();?>searchresult?type=life&searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>">VIEW MORE</a>
    		    	</span>
    		    	<?php } ?>
    		    </div><hr>
        		<div class="mg-2" style="justify-content:center;"> 
    			    <div id="StoryContl" class="StoryCont StoryContl1">
                    	<div id="story-sliderl" class="story-slider">
                    		<?php foreach($get_life->result() as $liferow) { ?>
                    			<div class="card1">
                    			    <a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $liferow->title).'-'.$liferow->sid);?>" class="imagelife-style">
                        				<?php if(isset($liferow->image) && !empty($liferow->image)) { ?>
                        					<img src="<?php echo base_url();?>assets/images/lazy-d266-j.jpg"  data-src="<?php echo base_url();?>assets/images/<?php echo $liferow->image; ?>" alt="<?php echo $liferow->title;?>" class="imageme1 lazy">
                        				<?php }else{ ?>
                        					<img src="<?php echo base_url();?>assets/images/lazy-d266-j.jpg" data-src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $liferow->title;?>" class="imageme1 lazy">
                        				<?php } ?>
                    			    </a>		
                    				<div>
                    				<font class="max-lines">
                    					<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $liferow->title).'-'.$liferow->sid);?>">
                    						<?php echo $liferow->title;?>
                    					</a>
                    				</font> 
                    				</div>
                    				<div class="flextest">
                    					<?php if(($liferow->writing_style == 'anonymous') && ($liferow->type == 'life')){ ?>
                    						<font class="byname">By<font class="namehere"><a href="" style="color:#000"> Anonymous</a></font></font><br>
                    					<?php } else { ?>
                    						<font class="byname">By<font class="namehere">
                    						    <a href="<?php echo base_url($liferow->profile_name);?>" style="color:#000"> <?php echo $liferow->name;?></a></font></font>
                    						<br>
                    					<?php } ?>
                    				</div>
                    				
                    				<div class="flextest" style="padding-top:4px;">
                    					<font class="lifeEvents-text"><?php echo substr(strip_tags($liferow->story),0,150);?> </font>
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
                    </div>
                </div>
        		<?php } ?>
        		<!-- Life Events end -->
        		<!-- Writers -->
        		<?php if(isset($get_writer) && ($get_writer->num_rows() > 0)){ $pagestoriescount = $pagestoriescount+$get_writer->num_rows(); ?> <!--  Writers search -->
    		        <div class="pd-0">
    		            <span class="titlei">People</span>
    		            <?php if($get_writer->num_rows() >= 3){ ?>
    		            <a href="<?php echo base_url();?>searchresultwriter?type=people&searchtext=<?php if(isset($searchtext)){echo $searchtext;} ?>" class="view pull-right">
    		                <span class="pull-right">VIEW MORE</span>
    		            </a>
    		            <?php } ?>
    		        </div><hr>
    		        <div class="mg-2" style="justify-content:center;"> 
    			        <div id="StoryContw" class="StoryCont StoryContl1">
                        	<div id="story-sliderw" class="story-slider">
                        	 <?php foreach($get_writer->result() as $writerrow) { ?>
                        	    <div class="card1" style="height:215px">
    	            		    <?php if(isset($writerrow->pbanner_image) && !empty($writerrow->pbanner_image)){ ?>
    					        <div class="imageme1 lazy" style="height:115px;" data-bg="url(<?php echo base_url();?>assets/images/<?php echo $writerrow->pbanner_image; ?>)">
    						        <div style="padding:9px; background:rgba(0, 0, 0, 0.64);height:115px;">
    						            <a href="<?php echo base_url($writerrow->profile_name);?>">
        						            <?php if(isset($writerrow->profile_image) && !empty($writerrow->profile_image)) { ?>
        						            	<img src="<?php echo base_url();?>assets/images/<?php echo $writerrow->profile_image; ?>" alt="<?php echo $writerrow->name;?>" class="circle-image" style="height:50px">
        						            <?php }else{ ?>
        						            	<img src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $writerrow->name;?>" class="circle-image" style="height:50px">
        						            <?php } ?>
    						            </a>
    						            <h3 class="name-nanostories" style="color:#fff">
    						                <a href="<?php echo base_url($writerrow->profile_name);?>" style="color:#FFF;"><?php echo $writerrow->name;?></a>
    						            </h3>
    						            <p class="writerc"><?php echo $writerrow->aboutus; ?></p>
    						        </div>
    					        </div>
    					        <?php }else { ?>
    					        <div class="imageme1" style="height:115px; background-position:center; background: linear-gradient(-60deg,RoyalBlue,brown); background-size:cover">
    						        <div style="padding:9px; background:rgba(0, 0, 0, 0.64);height:115px;">
    						            <a href="<?php echo base_url($writerrow->profile_name);?>">
        						            <?php if(isset($writerrow->profile_image) && !empty($writerrow->profile_image)) { ?>
        						            	<img src="<?php echo base_url();?>assets/images/<?php echo $writerrow->profile_image; ?>" alt="<?php echo $writerrow->name;?>" class="circle-image" style="height:50px">
        						            <?php }else{ ?>
        						            	<img src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $writerrow->name;?>" class="circle-image" style="height:50px">
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
                        </div>
                    </div>
			    <?php } ?>
			    <!-- Writers End-->
            </div>
            <?php if(isset($pagestoriescount) && ($pagestoriescount < 1)){ ?>
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
    </section>
</div>

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
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;margin-top:-10px;"/><p class="socialsharepopupspan">Facebook</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
					    <a href="javascript:void(0);" class="whatsappshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;margin-top:-10px;"/><p class="socialsharepopupspan">Whatsapp</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="twittershare socsh">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Twitter</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')" class="socsh">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px;height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Copy to link</p></a>
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
<!-- group suggest popup code ---- -->
<div class="modal fade" id="groupsuggest" role="dialog">
	<div class="modal-dialog modaldialogs">
		<div class="modal-content">
			<div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code -->
<!-- frind popup code ------>
<div class="modal fade" id="friendsuggest" role="dialog" aria-hidden="true">
	<div class="modal-dialog modaldialogs">
		<div class="modal-content">
			<div class="storysuggesttofriend"></div>
		</div>
	</div>
</div>
<!--frind popup end ------------->

<script>
    /* STORIES,SERIES carasole */
function carousel1(rgtbtnoo, lftbtnoo, storycontoo, storyslideoo, storyslide) {
    
var rightButtona = $(rgtbtnoo);
var leftButtona =$(lftbtnoo);
var containera = $(storycontoo);
var slideConta = $(storyslideoo);

var maxcounta = document.getElementById(storyslide).childElementCount;
if(maxcounta < 3){
  $(rightButtona).hide();
  $(leftButtona).hide();
}
var marLefta = 0, maxXa = maxcounta*210, diffa = 0 ;

function slidea() {
marLefta-=218;
if( marLefta < -maxXa ){ 
  marLefta = -maxXa+183 ;
}
  slideConta.animate({"margin-left" : marLefta + "px"}, 400);
}

function slideBacka() {
  marLefta +=218;
  if ( marLefta > 0 ) { marLefta = 0 ;}
  slideConta.animate({"margin-left" : marLefta + "px"}, 400);
}
rightButtona.click(slidea);
leftButtona.click(slideBacka);

/*touch code from here*/

$(containera).on("mousedown touchstart", function(e) {
  
  var startXa = e.pageX || e.originalEvent.touches[0].pageX;
  diffa = 0;

  $(containera).on("mousemove touchmove", function(e) {
    
      var xta = e.pageX || e.originalEvent.touches[0].pageX;
      diffa = (xta - startXa) * 100 / window.innerWidth;
    if( marLefta == 0 && diffa > 10 ) { 
      event.preventDefault() ;
    } else if (  marLefta == -maxXa && diffta < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containera).on("mouseup touchend", function(e) {
  $(containera).off("mousemove touchmove");
  if(  marLefta == 0 && diffa > 4 ) { 
      sliderConta.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLefta == -maxXa  && diffa < 4 ){
       sliderConta.animate({"margin-left" : -maxXa  + "px"},100);  
   } else {
      if (diffa < -10) {
        slidea();
      } else if (diffa > 10) {
        slideBacka();
      } 
  }
});
}

carousel1("#right-btnls", "#left-btnls", "#StoryContls", "#story-sliderls", "story-sliderls") // write series scroll
carousel1("#right-btn", "#left-btn", "#StoryCont", "#story-slider", "story-slider") // write Story scroll
/* END  series,stories */


/*  WRITERS, LIFE EVENTS */
function carousel2(rgtbtnoo, lftbtnoo, storycontoo, storyslideoo, storyslide) {
var rightButtonl = $(rgtbtnoo);
var leftButtonl =$(lftbtnoo);
var containerl = $(storycontoo);
var slideContl = $(storyslideoo);
var maxcountl = document.getElementById(storyslide).childElementCount;
if(maxcountl < 3){
  $(rightButtonl).hide();
  $(leftButtonl).hide();
}

var marLeftl = 0, maxXl = maxcountl*267, diffl = 0 ;

function slidel() {
marLeftl-=284;
if( marLeftl < -maxXl ){ 
  marLeftl = -maxXl+250 ;
}
  slideContl.animate({"margin-left" : marLeftl + "px"}, 500);
}

function slideBackl() {
  marLeftl +=284;
  if ( marLeftl > 0 ) { marLeftl = 0 ;}
  slideContl.animate({"margin-left" : marLeftl + "px"}, 500);
}
rightButtonl.click(slidel);
leftButtonl.click(slideBackl);

/*touch code from here*/

$(containerl).on("mousedown touchstart", function(e) {
  
  var startXl = e.pageX || e.originalEvent.touches[0].pageX;
  diffl = 0;

  $(containerl).on("mousemove touchmove", function(e) {
    
      var xtl = e.pageX || e.originalEvent.touches[0].pageX;
      diffl = (xtl - startXl) * 100 / window.innerWidth;
    if( marLeftl == 0 && diffl > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftl == -maxXl && diffl < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containerl).on("mouseup touchend", function(e) {
  $(containerl).off("mousemove touchmove");
  if(  marLeftl == 0 && diffl > 4 ) { 
      sliderContl.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftl == -maxXl  && diffl < 4 ){
       sliderContl.animate({"margin-left" : -maxXl  + "px"},100);  
   } else {
      if (diffl < -10) {
        slidel();
      } else if (diffl > 10) {
        slideBackl();
      } 
  }
});
}
carousel2("#right-btnl", "#left-btnl", "#StoryContl", "#story-sliderl", "story-sliderl") // write life scroll
carousel2("#right-btnw", "#left-btnw", "#StoryContw", "#story-sliderw", "story-sliderw") // write nano scroll
<!-- // END WRITERS, LIFE EVENTS-->
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
<script>
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
    });
</script>