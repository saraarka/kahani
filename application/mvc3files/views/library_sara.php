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
                                <li><a href="#tab_2" data-toggle="tab">SUBSCRIBED</a></li>
                                <li><a href="#tab_3" data-toggle="tab">FAVORITE</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <?php $rlscount = 0; $frscount = 0; ?>
                    <div class="tab-pane active" id="tab_1">
                        <?php if(isset($rlseries) && ($rlseries->num_rows() > 0)){ $rlscount = $rlscount+$rlseries->num_rows(); ?>
                            <div class="row pt-0">
    		                    <div class="col-md-12 col-xs-12 pd-0">
    			                	<div class="titlei">SERIES</div>
    			                </div>
    		                </div><hr>
                            <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
                                <?php foreach($rlseries->result() as $rlseriesrow){ ?>
                                <div class="cardls" id="rllibdel<?php echo $rlseriesrow->sid;?>">
            					    <div class="book-typels"><?php echo $rlseriesrow->gener;?></div>
        			    	        <a href="<?php echo base_url('new_series?id='.$rlseriesrow->sid.'&story_id='.$rlseriesrow->story_id);?>">
        			    	            <?php if(isset($rlseriesrow->cover_image) && !empty($rlseriesrow->cover_image)) { ?>
        			    	                <img src="<?php echo base_url();?>assets/images/<?php echo $rlseriesrow->cover_image; ?>" alt="Avatar" class="imagemels">
        			    	            <?php }else{ ?>
        			    	            	<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imagemels">
        			    	            <?php } ?>
        			    	        </a>
    			    	            <div class="bottom-left">
    			    	                <a href="javascript:void(0)" onclick="deleterllibrary(<?php echo $rlseriesrow->sid;?>);">
    								    <i class="fa fa-trash"></i></a>
    								</div>
    			    	            <div class="clear-fix"></div>
            					    <div style="margin-top:-18px;">
    			    	            	<font class="max-linesls">
    			    	            		<a href="<?php echo base_url('new_series?id='.$rlseriesrow->sid.'&story_id='.$rlseriesrow->story_id);?>">
    			    	            			<?php echo $rlseriesrow->title;?>
    			    	            		</a>
    			    	            	</font> 
    			    	            </div>
            						<div class="flextestls">
    					                <font class="bynamels">By<font class="nameherels"><a href="<?php echo base_url('profile?id='.$rlseriesrow->user_id);?>" style="color:#000;"><?php echo $rlseriesrow->name;?></a></font>
    					                </font><br>
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
                                        <a href="<?php echo base_url('new_series?id='.$rlseriesrow->sid.'&story_id='.$rlseriesrow->story_id);?>">
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
    								<a href="<?php echo base_url('only_story_view?id='.$rlstoryrow->sid);?>">
        								<?php if(isset($rlstoryrow->cover_image) && !empty($rlstoryrow->cover_image)) { ?>
        							        <img src="<?php echo base_url();?>assets/images/<?php echo $rlstoryrow->cover_image; ?>" alt="Avatar" class="imagemels">
        							    <?php }else{ ?>
        								    <img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imagemels">
    							        <?php } ?>
							        </a>
							        <div class="bottom-left">
							            <a href="javascript:void(0)" onclick="deleterllibrary(<?php echo $rlstoryrow->sid;?>);">
        					            <i class="fa fa-trash"></i></a>
        		                    </div>
					    	        <div class="clear-fix"></div>
                        			<div style="margin-top:-18px;">
        								<font class="max-lines">
        									<a href="<?php echo base_url('only_story_view?id='.$rlstoryrow->sid);?>" class="product-title">
        									    <?php echo $rlstoryrow->title;?>
        									</a>
        								</font> 
        							</div>
        							<div class="flextest">
        								<font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$rlstoryrow->user_id);?>" style="color:#000;"><?php echo $rlstoryrow->name;?></a></font>
        								</font><br>
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
							            <a href="<?php echo base_url('only_story_view?id='.$rlstoryrow->sid);?>">
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
        							<a href="<?php echo base_url('only_story_view?id='.$rlliferow->sid);?>">
            							<?php if(isset($rlliferow->cover_image) && !empty($rlliferow->cover_image)) { ?>
            								<img src="<?php echo base_url();?>assets/images/<?php echo $rlliferow->cover_image; ?>" alt="Avatar" class="imageme1">
            							<?php }else{ ?>
            								<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imageme1">
            							<?php } ?>
        							</a>
        							<div class="bottom-left" style="top: -150px;">
							            <a href="javascript:void(0)" onclick="deleterllibrary(<?php echo $rlliferow->sid;?>);">
        					            <i class="fa fa-trash"></i></a>
        		                    </div>
					    	        <div class="clear-fix"></div>
        							<div>
            							<font class="max-lines">
            								<a href="<?php echo base_url('only_story_view?id='.$rlliferow->sid);?>"><?php echo $rlliferow->title;?></a>
            							</font> 
        							</div>
        							<div class="flextest">
        								<?php if(($rlliferow->writing_style == 'anonymous') && ($rlliferow->type == 'life')){ ?>
        									<font class="byname">By<font class="namehere">Anonymous</font></font><br>
        								<?php } else { ?>
        									<font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$rlliferow->user_id);?>" style="color:#000;"><?php echo $rlliferow->name;?></a></font>
        									</font><br>
        								<?php } ?>
        							</div>
        							<div class="flextest" style="padding-top:4px;">
        								<font class="lifeEvents-text"><?php echo $rlliferow->story;?> 
        									<a href="<?php echo base_url('only_story_view?id='.$rlliferow->sid);?>"></a>
        								</font>
        							</div>
    							    <div class="flextest" style="padding-top:6px">
    							        <a href="<?php echo base_url('only_story_view?id='.$rlliferow->sid);?>">
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
                        <?php if($rlscount <= 0){ ?>
                            <center><img src="<?php echo base_url();?>assets/images/nodata.png" class="imgn"></center>
                        <?php } ?>
            		</div>
            		
            		
                    <div class="tab-pane" id="tab_2">
            		    <?php if(isset($scseries) && ($scseries->num_rows() > 0)){ ?>
            		    <?php $readlatersids = get_storiesreadlater('readlater'); ?>
                        <div class="row pt-0">
		                    <div class="col-md-6 col-xs-8 pd-0">
			                	<div class="titlei">SERIES</div>
			                </div>
		                </div><hr>
                        <div class="">
                            <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
                                <?php foreach($scseries->result() as $scseriesrow){ ?>
                                    <div class="cardls" id="sclibdel<?php echo $scseriesrow->sid;?>">
                					    <div class="book-typels"><?php echo $scseriesrow->gener;?></div>
					    	            <a href="<?php echo base_url('new_series?id='.$scseriesrow->sid.'&story_id='.$scseriesrow->story_id);?>">
    					    	            <?php if(isset($scseriesrow->cover_image) && !empty($scseriesrow->cover_image)) { ?>
    					    	                <img src="<?php echo base_url();?>assets/images/<?php echo $scseriesrow->cover_image; ?>" alt="Avatar" class="imagemels">
    					    	            <?php }else{ ?>
    					    	            	<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imagemels">
    					    	            <?php } ?>
					    	            </a>
					    	            <div class="bottom-left">
					    	                <a href="javascript:void(0)" onclick="deletesclibrary(<?php echo $scseriesrow->sid;?>);">
        								    <i class="fa fa-trash"></i></a>
        								</div>
					    	            <div class="clear-fix"></div>
                					    <div style="margin-top:-18px;">
					    	            	<font class="max-linesls">
					    	            		<a href="<?php echo base_url('new_series?id='.$scseriesrow->sid.'&story_id='.$scseriesrow->story_id);?>">
					    	            			<?php echo $scseriesrow->title;?>
					    	            		</a>
					    	            	</font> 
					    	            </div>
                						<div class="flextestls">
							                <font class="bynamels">By<font class="nameherels"><a href="<?php echo base_url('profile?id='.$scseriesrow->user_id);?>" style="color:#000;"><?php echo $scseriesrow->name;?></a></font>
					                        </font><br>
                						</div>
                					    <div class="flextestls" style="padding-top:4px;">
					                        <font class="episodesls">
    						                    <?php $keycount = get_episodecount($scseriesrow->sid); 
    							                    if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
    							                <?php $subsmemcount = get_storysubscount($scseriesrow->sid); 
												    if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
											</font><br>
                						</div>
							            <div class="flextestls" style="padding-top:6px">
							                <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($scseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
					                            <button class="read" style="background:none; border:none;" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
						                	<?php }else{ ?>
			                	            	<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($scseriesrow->sid, $readlatersids)) { ?>
			                	            		<button onclick="unreadlater(<?php echo $scseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $scseriesrow->sid;?>">
			                	            		<i class="fa fa-check faicon<?php echo $scseriesrow->sid;?>"></i> Read later </button>
			                	            	<?php }else { ?>
			                	            		<button onclick="readlater(<?php echo $scseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $scseriesrow->sid;?>">
			                	            		<i class="fa fa-bookmark faicon<?php echo $scseriesrow->sid;?>"></i> Read later </button>
			                	            	<?php } ?>
			                	            <?php } ?>
				                	        <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
				                				<span class=""><i class="fa fa-plus"></i></span>
				                			</button>
				                			<ul class="dropdown-menu list-inline dropvk">
				                				<li onclick="groupsuggest(<?php echo $scseriesrow->sid; ?>);">
				                					<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
				                				</li>
				                				<li onclick="friend(<?php echo $scseriesrow->sid;?>);">
				                					<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
				                				</li>
				                				<li onclick="socialshare(<?php echo $scseriesrow->sid;?>, 'series');">
				                					<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
				                						<i class="fa fa-share-alt"></i>
				                					</a>
				                				</li>
				                			</ul>
						                </div>
							        </div><!-- cardls -->
                                <?php } ?>
                            </div>
                        </div>
                        <?php } else{ ?>
                            <center><img src="<?php echo base_url();?>assets/images/nodata.png"></center>
                        <?php } ?>
                    </div>
                    
                    
                    <div class="tab-pane" id="tab_3">
                        <?php if(isset($frseries) && ($frseries->num_rows() > 0)){ $frscount = $frscount+$frseries->num_rows();  ?>
                            <div class="row pt-0">
    		                    <div class="col-md-6 col-xs-8 pd-0">
    			                	<div class="titlei">SERIES</div>
    			                </div>
    		                </div><hr>
                            <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
                                <?php foreach($frseries->result() as $frseriesrow){ ?>
                                    <div class="cardls" id="frlibdel<?php echo $frseriesrow->sid;?>">
                    			        <div class="book-typels"><?php echo $frseriesrow->gener;?></div>
    				    	            <a href="<?php echo base_url('new_series?id='.$frseriesrow->sid.'&story_id='.$frseriesrow->story_id);?>">
        				    	            <?php if(isset($frseriesrow->cover_image) && !empty($frseriesrow->cover_image)) { ?>
        				    	                <img src="<?php echo base_url();?>assets/images/<?php echo $frseriesrow->cover_image; ?>" alt="Avatar" class="imagemels">
        				    	            <?php }else{ ?>
        				    	            	<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imagemels">
        				    	            <?php } ?>
    				    	            </a>
    					    	            <div class="bottom-left">
    					    	                <a href="javascript:void(0)" onclick="deletefrlibrary(<?php echo $frseriesrow->sid;?>);">
            								    <i class="fa fa-trash"></i></a>
            								</div>
    					    	            <div class="clear-fix"></div>
                    					    <div style="margin-top:-18px;">
    					    	            	<font class="max-linesls">
    					    	            		<a href="<?php echo base_url('new_series?id='.$frseriesrow->sid.'&story_id='.$frseriesrow->story_id);?>">
    					    	            			<?php echo $frseriesrow->title;?>
    					    	            		</a>
    					    	            	</font> 
    					    	            </div>
                    						<div class="flextestls">
    							                <font class="bynamels">By<font class="nameherels"><a href="<?php echo base_url('profile?id='.$frseriesrow->user_id);?>" style="color:#000;"><?php echo $frseriesrow->name;?></a></font>
    	                                        </font><br>
                    						</div>
                    					    <div class="flextestls" style="padding-top:4px;">
    						                  <font class="episodesls">
    							                    <?php $keycount = get_episodecount($frseriesrow->sid); 
    								                    if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES |
    								                <?php $subsmemcount = get_storysubscount($frseriesrow->sid); 
    													if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
    											</font><br>
                    						</div>
    							            <div class="flextestls" style="padding-top:6px">
    							                <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($frseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                    <button class="read" style="background:none; border:none;" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
                                                <?php }else{ ?>
                                	            	<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($frseriesrow->sid, $readlatersids)) { ?>
                                	            		<button onclick="unreadlater(<?php echo $frseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $frseriesrow->sid;?>">
                                	            		<i class="fa fa-check faicon<?php echo $frseriesrow->sid;?>"></i> Read later </button>
                                	            	<?php }else { ?>
                                	            		<button onclick="readlater(<?php echo $frseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $frseriesrow->sid;?>">
                                	            		<i class="fa fa-bookmark faicon<?php echo $frseriesrow->sid;?>"></i> Read later </button>
                                	            	<?php } ?>
                                	            <?php } ?>
    				                	        <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    				                				<span class=""><i class="fa fa-plus"></i></span>
    				                			</button>
    				                			<ul class="dropdown-menu list-inline dropvk">
    				                				<li onclick="groupsuggest(<?php echo $frseriesrow->sid; ?>);">
    				                					<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
    				                				</li>
    				                				<li onclick="friend(<?php echo $frseriesrow->sid;?>);">
    				                					<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
    				                				</li>
    				                				<li onclick="socialshare(<?php echo $frseriesrow->sid;?>, 'series');">
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
                        
                        <?php if(isset($frstories) && ($frstories->num_rows() > 0)){ $frscount = $frscount+$frstories->num_rows(); ?>
                		    <div class="row pt-0">
    		                    <div class="col-md-6 col-xs-8 pd-0">
    			                	<div class="titlei">STORIES</div>
    			                </div>
    		                </div><hr>
            		        <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
                    			<?php foreach($frstories->result() as $frstoriesrow) { ?>
                    			<div class="cardls" id="frlibdel<?php echo $frstoriesrow->sid;?>">
							        <div class="book-type"><?php echo $frstoriesrow->gener;?></div>
    								<a href="<?php echo base_url('only_story_view?id='.$frstoriesrow->sid);?>" class="product-title">
        								<?php if(isset($frstoriesrow->cover_image) && !empty($frstoriesrow->cover_image)) { ?>
        							        <img src="<?php echo base_url();?>assets/images/<?php echo $frstoriesrow->cover_image; ?>" alt="Avatar" class="imagemels">
            							<?php }else{ ?>
            								<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imagemels">
            							<?php } ?>
            						</a>
        							<div class="bottom-left">
        							    <a href="javascript:void(0)" onclick="deletefrlibrary(<?php echo $frstoriesrow->sid;?>);">
                					    <i class="fa fa-trash"></i></a>
                					</div>
        					    	<div class="clear-fix"></div>
                        			<div style="margin-top:-18px;">
        								<font class="max-lines">
        									<a href="<?php echo base_url('only_story_view?id='.$frstoriesrow->sid);?>" class="product-title">
        									    <?php echo $frstoriesrow->title;?>
        									</a>
        								</font> 
        							</div>
        							<div class="flextest">
        								<font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$frstoriesrow->user_id);?>" style="color:#000;"><?php echo $frstoriesrow->name;?></a></font>
        								</font><br>
        							</div>
        							<div class="flextest" style="padding-top:4px;">
        								<font class = "episodes">
        									<font>
        										<?php $wordcount = explode(' ', $frstoriesrow->story);
        									    $time = round(sizeof($wordcount)/50);	?>
        										<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
        									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $frstoriesrow->views;?>&nbsp;</b></font>
        									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
        										<b><?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
        											foreach($reviews21->result() as $reviews2) { 
        												if($reviews2->sid == $frstoriesrow->sid) {
        													echo round($reviews2->rating);
        												}
        										} } ?></b>
        									</font>
        								</font><br>
        							</div>
    							    <div class="flextest" style="padding-top:6px">
        								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($frstoriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
        									<button class="read" style="background:none; border:none;" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
        								<?php }else{ ?>
        									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($frstoriesrow->sid, $readlatersids)) { ?>
        										<button onclick="unreadlater(<?php echo $frstoriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $frstoriesrow->sid;?>">
        										<i class="fa fa-check faicon<?php echo $frstoriesrow->sid;?>"></i> Read later </button>
        									<?php }else { ?>
        										<button onclick="readlater(<?php echo $frstoriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $frstoriesrow->sid;?>">
        										<i class="fa fa-bookmark faicon<?php echo $frstoriesrow->sid;?>"></i> Read later </button>
        									<?php } ?>
        								<?php } ?>
    								
        								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        									<span class=""><i class="fa fa-plus"></i></span>
        								</button>
        								<ul class="dropdown-menu list-inline dropvk">
        									<li onclick="groupsuggest(<?php echo $frstoriesrow->sid; ?>);">
        										<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
        									</li>
        									<li onclick="friend(<?php echo $frstoriesrow->sid;?>);">
        										<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
        									</li>
        									<li onclick="socialshare(<?php echo $frstoriesrow->sid;?>, 'story');">
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
                    	
                    	<?php if(isset($frlife) && ($frlife->num_rows() > 0)){ $frscount = $frscount+$frlife->num_rows(); ?>
                		    <div class="row pt-0">
    		                    <div class="col-md-6 col-xs-8 pd-0">
    			                	<div class="titlei">LIFE EVENTS</div>
    			                </div>
    		                </div><hr>
                		    <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
                                <?php foreach($frlife->result() as $frliferow) { ?>
                                    <div class="card1" style="margin-top:10px" id="frlibdel<?php echo $frliferow->sid;?>">
            							<a href="<?php echo base_url('only_story_view?id='.$frliferow->sid);?>">
                							<?php if(isset($frliferow->cover_image) && !empty($frliferow->cover_image)) { ?>
                								<img src="<?php echo base_url();?>assets/images/<?php echo $frliferow->cover_image; ?>" alt="Avatar" class="imageme1">
                							<?php }else{ ?>
                								<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imageme1">
                							<?php } ?>
            						    </a>
            						    <div class="bottom-left" style="top:-150px;">
            							    <a href="javascript:void(0)" onclick="deletefrlibrary(<?php echo $frliferow->sid;?>);">
                    					    <i class="fa fa-trash"></i></a>
                    					</div>
            							<div>
                							<font class="max-lines">
                								<a href="<?php echo base_url('only_story_view?id='.$frliferow->sid);?>">
                								    <?php echo $frliferow->title;?>
                								</a>
                							</font> 
            							</div>
            							<div class="flextest">
            								<?php if(($frliferow->writing_style == 'anonymous') && ($frliferow->type == 'life')){ ?>
            									<font class="byname">By<font class="namehere">Anonymous</font></font><br>
            								<?php } else { ?>
            									<font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$frliferow->user_id);?>" style="color:#000;"><?php echo $frliferow->name;?></a></font>
            									</font><br>
            								<?php } ?>
            							</div>
            							<div class="flextest" style="padding-top:4px;">
            								<font class="lifeEvents-text"><?php echo $frliferow->story;?> 
            									<a href="<?php echo base_url('only_story_view?id='.$frliferow->sid);?>"></a>
            								</font>
            							</div>
            							<div class="flextest" style="padding-top:6px">
            								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($frliferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
            									<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
            								<?php }else{ ?>
            									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($frliferow->sid, $readlatersids)) { ?>
            										<button onclick="unreadlater(<?php echo $frliferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $frliferow->sid;?>">
            										<i class="fa fa-check faicon<?php echo $frliferow->sid;?>"></i> Read later </button>
            									<?php }else { ?>
            										<button onclick="readlater(<?php echo $frliferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $frliferow->sid;?>">
            										<i class="fa fa-bookmark faicon<?php echo $frliferow->sid;?>"></i> Read later </button>
            									<?php } ?>
            								<?php } ?>
            								
            								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
            									<span class=""><i class="fa fa-plus"></i></span>
            								</button>
            								<ul class="dropdown-menu list-inline dropvklife">
            									<li onclick="groupsuggest(<?php echo $frliferow->sid; ?>);">
            										<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
            									</li>
            									<li onclick="friend(<?php echo $frliferow->sid;?>);">
            										<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
            									</li>
            									<li onclick="socialshare(<?php echo $frliferow->sid;?>, 'story');">
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
                        <?php if($frscount <= 0){ ?>
                            <center><img src="<?php echo base_url();?>assets/images/nodata.png"></center>
                        <?php } ?>
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
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:2px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="modal-body" style="padding-top:5px;">
				<div class="row">
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="facebookshare">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;"/> <span style="padding-left:5px; font-size:18px;">Faceebok</span></a>
					</div>
					<div class="col-md-12 pd-5v">
					    <a href="javascript:void(0);" class="whatsappshare">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;"/> <span style="padding-left:5px; font-size:18px;">Whatsapp</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="twittershare">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;"/> <span style="padding-left:5px; font-size:18px;">Twitter</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;"/> <span style="padding-left:5px; font-size:18px;">Copy to link</span></a>
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
		$.ajax({
			type:"post",
			url:"<?php echo base_url('index.php/welcome/deletelibrary');?>",
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
	}
	function deletesclibrary(story_id){
		$.ajax({
			type:"post",
			url:"<?php echo base_url('index.php/welcome/deletelibrary');?>",
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
	}
	function deletefrlibrary(story_id){
		$.ajax({
			type:"post",
			url:"<?php echo base_url('index.php/welcome/deletelibrary');?>",
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
}
</script>