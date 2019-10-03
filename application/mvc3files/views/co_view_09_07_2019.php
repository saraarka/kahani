<link rel="stylesheet" href="<?php echo base_url();?>assets/css/co_view.css">
<style>
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
        border: 1px solid #d2d5d3;
        background:#eeeeee;
    }
    .box-footer {
        padding: 10px 10px 0px 10px;
    }
    
</style>
<div class="cotop">
    <section>
        <div class="container-fluid">
        <?php $sesslang = get_langshortname($this->uri->segment(1)); ?>
        <input type="hidden" id="languageto" value="<?php if(isset($sesslang) && !empty($sesslang)) { echo $sesslang; } else { echo 'en'; } ?>">
    	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    	<script type="text/javascript">
    		// Load the Google Transliterate API
    		google.load("elements", "1", {
    			packages: "transliteration"
    		});
    		var langugeto = document.getElementById('languageto').value;
    		var transliterationControl;
    		function onLoad() {
    			var options = {
    				sourceLanguage: 'en',
    				destinationLanguage: [langugeto],
    				transliterationEnabled: true,
    			};
    			// Create an instance on TransliterationControl with the required
    			// options.
    			transliterationControl =
    			  new google.elements.transliteration.TransliterationControl(options);    	
    			// Enable transliteration in the textfields with the given ids.jk
                var ids = [ "urldescription", "quotesstory" , "textstory"];
                transliterationControl.makeTransliteratable(ids);
                transliterationControl.c.qc.t13n.c[3].c.d.keyup[0].ia.F.p = 'https://www.google.com';  // https ssl activation 
    			// Add the STATE_CHANGED event handler to correcly maintain the state
    			// of the checkbox.
    			transliterationControl.addEventListener(    				
    			    google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
    				transliterateStateChangeHandler);
    			// Add the SERVER_UNREACHABLE event handler to display an error message
    			// if unable to reach the server.
    			transliterationControl.addEventListener(    				
    			    google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,
    				serverUnreachableHandler);
    			// Add the SERVER_REACHABLE event handler to remove the error message
    			// once the server becomes reachable.
    			transliterationControl.addEventListener(    				
    			    google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE, serverReachableHandler);
    				// Set the checkbox to the correct state.
    			document.getElementById('checkboxId').checked =
    			  transliterationControl.isTransliterationEnabled();
    			// Populate the language dropdown
    		  }
    		  // Handler for STATE_CHANGED event which makes sure checkbox status
    		  // reflects the transliteration enabled or disabled status.
    		  function transliterateStateChangeHandler(e) {
    			document.getElementById('checkboxId').checked = e.transliterationEnabled;
    		  }
    		  // Handler for dropdown option change event.  Calls setLanguagePair to
    		  // set the new language.
    		  function languageChangeHandler() {
    	        transliterationControl.toggleTransliteration();
    			var dropdown = document.getElementById('languageDropDown');
    			transliterationControl.setLanguagePair(
    				google.elements.transliteration.LanguageCode.ENGLISH,
    				dropdown.options[dropdown.selectedIndex].value);
    		  }
    		  // SERVER_UNREACHABLE event handler which displays the error message.
    		  function serverUnreachableHandler(e) {
    			document.getElementById("errorDiv").innerHTML =
    				"Transliteration Server unreachable";
    		  }
    		  // SERVER_UNREACHABLE event handler which clears the error message.
    		  function serverReachableHandler(e) {
    			document.getElementById("errorDiv").innerHTML = "";
    		  }
    	    google.setOnLoadCallback(onLoad);
    	</script>
    	
    	<div class=""><!-- container-fluid-->
            <div class="main-container">
                <div class="" style="display:flex; flex-wrap:wrap;justify-content:center;">
            		<div class="side1">
        				<div class="sideimg sidebarvj" style="box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12); overflow:visible;">
            				<div class="header">
            					<center><h4>
                					<?php $communitie_about = ''; if(isset($get_communities_adout) && ($get_communities_adout->num_rows() >0)){
                					    foreach($get_communities_adout->result() as $communitie_about){
                					        $communitie_about = strtoupper($communitie_about->gener); 
                                        } } echo $communitie_about; ?>
            					</h4></center>
            					<hr style="margin:3px 0 3px; border-color:#f4f4f4">
        					    <?php if(isset($comm_joines) && ($comm_joines->num_rows() >0)) { ?>
        					        <a href="javascript:void(0);" data-toggle="modal" data-target="#communitymembers"> <?php echo $comm_joines->num_rows(); ?> Members</a>
        					        <a href="javascript:void(0);" class="pull-right" data-toggle="modal" data-target="#communitymembers"> View All </a>
        					        <br> <br>
        					        <center>
										<?php $imgcount = 1; foreach($comm_joines->result() as $comm_joinie) {
											if(!empty($comm_joinie->profile_image) && ($imgcount < 6)){ ?>
											<a href="<?php echo base_url().$comm_joinie->profile_name;?>"><span>
												<img src="<?php echo base_url();?>assets/images/<?php echo $comm_joinie->profile_image;?>" style="width: 40px;height: 40px; border-radius:50%;" alt="<?php echo $comm_joinie->name;?>">
										   </span></a>
										<?php } elseif($imgcount < 6) { ?>
											<a href="<?php echo base_url().$comm_joinie->profile_name;?>"><span>
												<img src="<?php echo base_url();?>assets/images/2.png" style="width:40px;height: 40px; border-radius:50%;" alt="<?php echo $comm_joinie->name;?>">
											</span></a>   
										<?php } ?>
										<?php $imgcount++; } ?>
									</center>
								<?php } else { echo "<center> No Member Joined in the Group </center>"; } ?><br>
        					    <center>
        					        <button class="btn-block btn btn-success unjoin<?php echo $commuid;?>" 
        					            onclick="commuunjoin(<?php echo $commuid;?>,'<?php echo $communitie_about;?>')"> JOINED </button>
        					    </center>
            				</div>
        				</div><br>
        		        <div class="community-h1">
            		    	<div class="sidebarvj" style="box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);">
                				<div class="header">
                					<p><b>OTHER COMMUNITIES <span class="pull-right">
                					    <a href="<?php echo base_url('communities');?>">More</a></span>
                				    </b></p>
                				</div><br>
                				<?php if(isset($get_communities_all) && !empty($get_communities_all)){
                				    $j = 0; foreach($get_communities_all->result() as $row) { if((!in_array($row->id, $join_comm)) && ($j < 15)) { ?>
                    				<div class="row pt-0">
                    					<div class="col-md-12 pd-0" style="padding-left:5px;">
                    					    <span class="pull-left" style="padding-top:8px;">
                    					        <a href="" style="text-transform:uppercase; padding-top:10px; text-overflow:ellipsis;"><b><?php echo $row->gener; ?></b></a>
                    					    </span>
                    					    <span class="pull-right">
            								    <button class="btn btn-success join<?php echo $row->id;?>" style="border-radius:4px!important;" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
                    					    </span>
                    					</div>
                    				</div>
                				    <hr style="margin:3px 0 3px; border-color:#f4f4f4">
                				<?php $j++; } } } ?>
            			    </div>
        		        </div>
        		    </div><!-- COL-MD-3 -->
        		    
            		<div class="side2">
            			<!-- Custom Tabs -->
            			<div class="nav-tabs-custom">
            				<ul class="nav nav-tabs">
            					<li onclick="tab_about(<?php echo $commuid;?>);"><a href="#about" data-toggle="tab" style="background-color: #23678e;">About</a></li>
            					<li class="active"><a href="#post" data-toggle="tab" style="background-color: #23678e;">Posts</a></li>
            					<li onclick="tab_tpost(<?php echo $commuid;?>);"><a href="#tpost" data-toggle="tab" style="background-color: #23678e;">Top Posts</a></li>
            				</ul>
            				<div class="tab-content">
            					<div class="tab-pane" id="about" style="padding:10px;">
            						<div style="margin-top:5px;"><center>
        						        <!--<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner">-->
        						        <img src="<?php echo base_url();?>assets/landing/svg/spinnertab.svg" class="spinner">
        						    </center></div>
            					</div><!-- /.tab-pane -->
            					
            					<div class="tab-pane active" id="post">
            						<?php if (isset($this->session->userdata['logged_in'])) { ?>
                						<div class="box-header with-borders">
                							<div class="user-block">
                								<a><span style="width: 40px;height: 40px;">
                									<?php if(isset($this->session->userdata['logged_in']['profile_image']) &&
                									    !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
                										<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" class="img-circle" alt="<?php echo $this->session->userdata['logged_in']['name'];?>">
                									<?php } else { ?>
                										<img src="<?php echo base_url();?>assets/images/2.png" class="img-circle" alt="User Image">
                									<?php } ?>
                								</span></a>
                								<span class="username" style="padding-top:10px;"><a href="javascript:void(0);">
    											    <?php if(isset($this->session->userdata['logged_in']['name'])){
    											        echo "Hi, ".ucwords($this->session->userdata['logged_in']['name']);
                                                    } ?>
                                                </a></span>
                							</div>
                						</div>
            						<?php } ?>
            						<!-- Tab content -->
            						<div class="box-footer">
            							<ul class="nav nav-tabs" style="border-bottom: none;">
            								<li> <a href="#tab_1" data-toggle="tab">
            									<center> <i class="fa fa-link fa-2x" style="color:#56bc8a;" aria-hidden="true"></i></center>
            									<br><b>LINKS</b>
            								</a> </li>
            								<li class="active"> <a href="#tab_2" data-toggle="tab">
            									<center><i class="fa fa-quote-left fa-2x" style="color:#f2992e;"></i></center>
            									<br><b>QUOTES</b>
            								</a> </li>
            								<li> <a href="#tab_3" data-toggle="tab">
                                                <center><b><span style="color:black;font-size: 35px; padding-top: -20px;">A</span>
                                                    <span style="color:black;font-size: 25px;">A</span></b></center> <b>TEXT</b>
            								</a> </li>
            							</ul>
            							<div class="tab-content">
            								<div class="tab-pane" id="tab_1">
            									<div class="box-footer" style="border-top:none;">
            										<form id="posturlform">
            											<div class="input-group" style="width:100%;">
            												<input type="hidden" name="comm_id" value="<?php echo $commuid; ?>">
            												<input type="hidden" name="type" value="url">
            												<input type="text" name="story" placeholder="Post Your Link Here...." class="form-control input-group" id="previewurl">
            											</div>
    													<span class="text-danger notvalid"></span><br>
            											<div class="input-group" style="width:100%;">
            											    <input type="text" id="urldescription" name="urldescription" placeholder="(Optional) Enter your Link description if any...." class="form-control">
            											    <span class="input-group-btn">
            												    <button type="submit" class="btn btn-success btn-flat">POST</button>
            												</span>
            											</div>
            										</form>
            									</div>
            								</div>
            								<div class="tab-pane active" id="tab_2">
            									<div class="box box-widget quotes" style="background:#fff;">
            										<div class="box-footer box-comments" style="border-top:none;">
            											<form id="postquoteform">
            												<div class="img-push">
            													<input type="hidden" name="comm_id" value="<?php echo $commuid; ?>">					
            													<textarea type="text" name="story" rows="5" cols="13" placeholder="Type QUOTES ......" class="form-control" style="border-radius:5px;border-color:#000; background: #4c3b3b2e; color: #000; resize:none;" id="quotesstory"></textarea>
            													<span class="text-danger noquotes"></span>
            													<input type="hidden" name="quotes" value="quotes">
            													<div class="input-group-btn pull-right" style="padding-right: 51px; margin-top:10px;">
            														<button type="submit" class="btn btn-primary">Post</button>
            													</div>
            												</div>
            											</form>
            											<br><br>
            										</div>
            									</div>
            								</div>
            								<div class="tab-pane" id="tab_3">
            									<div class="box box-widget quotes" style="background:#fff;">
            										<div class="box-footer" style="border-top:none;">
            											<form id="posttextform">
            												<div class="img-push">
            													<input type="hidden" name="comm_id" value="<?php echo $commuid; ?>">					
            													<textarea type="text" name="story" rows="5" cols="13" placeholder="Type Message ......" class="form-control" style="border-radius:5px;resize:none;" id="textstory"></textarea>
            													<span class="text-danger notext"></span>
            													<div class="input-group-btn pull-right" style="padding-right: 51px; margin-top:10px;">
            														<button type="submit" class="btn btn-primary">Post</button>
            													</div>
            												</div>
            											</form>
            											<br><br>
            										</div>
            									</div>
            								</div>
            							</div>
            						</div>
            						
            						<div class="box-header with-border" style="margin-top:20px; padding:0px;">
            							<div class="col-md-12" style="padding:0px">
            								<div class="box box-widget" style="border:1px solid #dddddd;margin-bottom:10px;display:none;" id="previewdiv">
            									<div class="box-header with-borders">
            										<div class="user-block">
            										    <span style="width:40px; height:40px;">
            										    <?php if(isset($this->session->userdata['logged_in']['profile_image']) && !empty($this->session->userdata['logged_in']['profile_image'])){ ?>
            										        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata['logged_in']['profile_image'];?>" alt="<?php echo $this->session->userdata['logged_in']['name'];?>">
            										    <?php }else{ ?>
            										        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
            										    <?php } ?>
            										    </span>
            											<span class="username">
    														<a href="#"><?php echo $this->session->userdata['logged_in']['name'];?> </a>
    													</span>
            											<span class="description"><!--<?php echo date('Y-m-d'); ?> -->1 minute ago</span>
            										</div>
            									</div>
            									<div class="box-body" id="preview"></div>
            								</div>        								
            								<div class="box box-widget delcomm" style="margin-bottom:10px;"></div>
            								<div class="box box-widget posturlform" style="margin-bottom:10px;"></div>
            								<?php if(isset($communities_story_get) && ($communities_story_get->num_rows() > 0)){ ?>
            								    <div id="loadposts">
            									<?php foreach ($communities_story_get->result() as $key) { ?>
            									<div class="box box-widget" style="background:#fff; border:1px solid #dddddd; margin-bottom:10px;" id="delcomm<?php echo $key->id;?>">        
    												<div class="box-header with-borders">
            											<div class="user-block">
            											    <span style="width:40px; height:40px;">
            												<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
            													<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="<?php echo $key->name;?>">
            												<?php } else { ?>
            													<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $key->name;?>">
            												<?php } ?>
            												</span>
            												<span class="username">
            												    <a href="<?php echo base_url().$key->profile_name;?>"><?php echo $key->name;?></a> 
            												    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($key->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    																<span class="dropdown" style="float:right;">
        																<a href="#" class="dropdown-toggle elli" data-toggle="dropdown" title="write" aria-expanded="false">
        																	<i class="fa fa-ellipsis-v"></i>
        																</a>
        																<ul class="dropdown-menu pull-right">
        																	<li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-pencil"></i> EDIT </a></li>
        																	<li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-trash"></i> DELETE </a></li>
        																</ul>
        															</span>
                            					                <?php } else { ?>
                            					                    <span class="dropdown" style="float:right;">
        																<a href="#" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v pull-right"></i></a>
        																<ul class="dropdown-menu pull-right">
        																	<li><a href="#" class="" style="" onclick="reportcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
        																	</li>
        																</ul>
    															    </span>
                            					                <?php } ?>
            												</span>
            												<span class="description datecv"><?php echo get_ydhmdatetime($key->date);?></span>
            											</div>
            										</div>
    												<?php if(isset($key->type) && ($key->type=='url')) { ?>
                										<div class="box-body">
            										        <?php if(isset($key->urldescription) && !empty($key->urldescription) && (strlen($key->urldescription) > 200)){ ?>
                											    <div class="user-block mb-10"><?php echo mb_substr($key->urldescription, 0, 200); ?>
                									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->urldescription,200); ?></span>
                									                <span class="smorelessdots<?php echo $key->id;?>">...</span>
                									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
                											<?php } else{ ?>
                											    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
                											<?php } ?>
                											<?php if(!empty($key->title)) { ?>
                												<div class="media border-box" style="margin-top:2px;">
                													<div class="media-left">
                														<a href="<?php echo $key->titleurl;?>" target="_blank">
                															<?php if(!empty($key->image)) { ?>
        																		<img src="<?php echo $key->image;?>" class="media-object img-v" alt="<?php echo ucfirst($key->title);?>">
        																	<?php } else { ?>
        																		<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v" alt="<?php echo ucfirst($key->title);?>">
                															<?php } ?>
                														</a>
                													</div>
                													<div class="media-body" style="padding-top:15px;">
                														<a href="<?php echo $key->titleurl;?>" target="_blank"> 
                															<h4 class="media-heading"><b><?php echo ucfirst($key->title);?></b></h4>
                														</a>
                														<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
                            											    <p class="sizep edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
                            											<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
                            											    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
                            											<?php } else{ ?>
                            											    <?php if(isset($key->story) && !empty($key->story)){ ?> 
                            											    <?php if (strlen($key->story) > 200){ ?>
                                											    <p class="media-heading edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo mb_substr($key->story, 0, 200); ?>
                                									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
                                									                <span class="smorelessdots<?php echo $key->id;?>">...</span>
                                									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
                                											<?php } else{ ?>
                                											    <p class="media-heading edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
                                											<?php } } ?>
                            											<?php } ?>
                													</div>
                												</div>
                											<?php } else { ?>
                												<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
                    											    <p class="sizep edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
                    											<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
                    											    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
                    											<?php } else{ ?>
                    											    <?php if(isset($key->story) && !empty($key->story)){ ?> 
                    											    <?php if (strlen($key->story) > 200){ ?>
                        											    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo mb_substr($key->story, 0, 200); ?>
                        									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
                        									                <span class="smorelessdots<?php echo $key->id;?>">...</span>
                        									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
                        											<?php } else{ ?>
                        											    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
                        											<?php } } ?>
                    											<?php } ?>
                											<?php } ?>
                										</div>
            										<?php } else { ?>
            											<div class="box-body">
            											    <?php if(isset($key->urldescription) && !empty($key->urldescription)){
                										        if(strlen($key->urldescription) > 200){ ?>
                											    <div class="user-block mb-10"><?php echo mb_substr($key->urldescription, 0, 200); ?>
                									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->urldescription,200); ?></span>
                									                <span class="smorelessdots<?php echo $key->id;?>">...</span>
                									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
                											<?php } else{ ?>
                											    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
                											<?php } } ?>
											
            												<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
                											    <p class="sizep edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
                											<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
                											    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
                											<?php } else{ ?>
                											    <?php if(isset($key->story) && !empty($key->story)){ ?> 
                											    <?php if (strlen($key->story) > 200){ ?>
                    											    <p class="edittext<?php echo $key->id;?>" style="margin:0px;line-height: 1.85em;    font-size: 1.2em;"><?php echo mb_substr($key->story, 0, 200); ?>
                    									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
                    									                <span class="smorelessdots<?php echo $key->id;?>">...</span>
                    									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
                    											<?php } else{ ?>
                    											    <p class="edittext<?php echo $key->id;?>" style="margin:0px;line-height: 1.85em;font-size: 1.2em;"><?php echo $key->story;?></p>
                    											<?php } } ?>
                											<?php } ?>
                										</div>
            										<?php } ?>
            										<div class="box-body">
            											<?php if(isset($commstory_likes) && in_array($key->id, $commstory_likes)) { ?>
                        								    <button class="btn btn-default btn-xs unlike<?php echo $key->id;?>" onclick="unlikestory(<?php echo $key->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
                        								<?php } else { ?>
                        								    <button class="btn btn-default btn-xs like<?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
                        								<?php } ?>
                        								<span style="padding-left:5px;"><a data-toggle="modal" data-target="#soc" href="javascript:void(0);" style="color:#333;"><i class="fa fa-share"></i> Share</a></span>
        												<span class="pull-right text-muted" onClick="comments(<?php echo $key->id;?>);">
        													<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
        													<?php $commentcount = 0; if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
        														foreach($comm_comment_count->result() as $reviews2) { 
        															if($reviews2->story_id == $key->id) {
        																$commentcount = $reviews2->commentcount;
        															} ?>
        													<?php } } ?><span id="old_cmt<?php echo $key->id;?>" style="cursor:pointer"><?php echo $commentcount; ?></span> Comments
        												</span>
        											</div>
        											
            										<!-- /.box-footer -->
            										<div class="box-footer">
            											<div id="community_commentpost<?php echo $key->id; ?>">
            												<?php if (isset($this->session->userdata['logged_in'])) { 
            												    if(isset($this->session->userdata['logged_in']['profile_image']) && 
            												        !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
    															<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height: 37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="<?php echo $this->session->userdata['logged_in']['name'];?>">
            												<?php } else { ?>
    															<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="User Image">
            												<?php } } ?>
            												<div class="input-group">
            												    <input type="hidden" name="story_id" value="<?php echo $key->id; ?>">
            													<input type="text" name="comment" placeholder="Type Comment Message ..." class="form-control" required="">
            													<input type="hidden" name="comm_id" value="<?php echo $commuid; ?>">
            													<span class="input-group-btn">
            														<button type="submit" class="btn btn-success btn-flat" onclick="comm_comments(<?php echo $key->id;?>)"> Comment </button>
            													</span>
            												</div>
            											</div>
            										</div>
            										<!-- /.box-footer -->
            										<div class="box-comments box-footer ajaxcomment<?php echo $key->id;?>" style="background: #fff;padding-bottom:0px;border:0px;"> </div>
            										<?php $comments = get_comments($key->id);
            											if(isset($comments) && ($comments->num_rows()>0)) { ?>
            											<div id="myList<?php echo $key->id;?>" style="display: none;">
                											<?php foreach($comments->result() as $comment){ ?>
                												<div class="box-footer box-comments editdelete<?php echo $comment->id;?>" style="padding-bottom:0px;">
                													<div class="box-comment">
                														<?php if(isset($comment->profile_image) && !empty($comment->profile_image)){ ?>
                														<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="<?php echo ucfirst($comment->name);?>">
                														<?php } else { ?>
                														<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($comment->name);?>">
                														<?php } ?>
                														<div class="comment-text">
                															<span class="username" style="padding-top:6px;">&nbsp; 
                															    <a href="<?php echo base_url().$comment->profile_name;?>"><?php echo ucfirst($comment->name);?></a>
                																<span class="dropdown" style="float:right;">
                                                                                    <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
                                                                                     <i class="fa fa-ellipsis-v"></i> </a> 
                                                                                    <ul class="dropdown-menu pull-right">
                                                                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($comment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                                                        <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $comment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                                                        <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $comment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                                                        <?php } else{ ?>
                                                                                        <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $comment->id;?>,<?php echo $comment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                                                        <?php } ?>
                                                                                    </ul>
                                                                                </span>
                																<span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($comment->date);?></span>
                															</span>
                														</div>
                														<div style="margin:8px 0 6px 2px" class="comment-text">
                														    <?php if(strlen($comment->comment) > 200){ ?>
                														        <div class="more <?php echo $comment->id;?>"><?php echo mb_substr($comment->comment, 0, 200); ?>
                														            <span class="showhide<?php echo $comment->id;?>" style="display:none;"><?php echo substr($comment->comment,200); ?></span>
                														            <span class="smorelessdots<?php echo $comment->id;?>">...</span>
                														            <u onclick="showhide(<?php echo $comment->id;?>)" class="moreless<?php echo $comment->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
                														    <?php } else{ ?>
                														        <div class="more <?php echo $comment->id;?>"><?php echo $comment->comment; ?></div>
                														    <?php } ?>
                															<div style="margin:5px 0;" class="">
                                                                                <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a>
                                                                                <a href="" class="pull-left replycv">I</a>
                                                                                <a href="javascript:void(0)" onClick="displayreplies(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Replies"> 
                                                                                    <span class="old_subcmtcount<?php echo $comment->id;?>"><?php echo get_subcmtcount($comment->id);?></span> REPLIES</a>
                                                                            </div>
                														</div><br>
                														<div class="comment-text">
                														    <div class="input-group postreplycomment<?php echo $comment->id;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
                														</div>
                													</div>
                													
                													<div class="subcomments" style="display:none;" id="mysubList<?php echo $key->id;?>_<?php echo $comment->id;?>">
                													    <center> <span id="spinnertab<?php echo $comment->id;?>">
                                                                            <img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner">
                                                                        </span> </center>
                    													<?php $subcomments = get_subcomments($key->id, $comment->id); 
                    													    if(isset($subcomments) && ($subcomments->num_rows() > 0)){ foreach($subcomments->result() as $subcomment){ ?>
                        													<div class="media editdelete<?php echo $subcomment->id;?>" style="padding-left:10px; margin-top:5px;margin-bottom:5px;">
                        													    <span class="media-left">
                        													        <?php if(isset($subcomment->profile_image) && !empty($subcomment->profile_image)){ ?>
                        													        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $subcomment->profile_image;?>" alt="<?php echo ucfirst($subcomment->name);?>">
                        													        <?php } else { ?>
                        													        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($subcomment->name);?>">
                        													        <?php } ?>
                        													   </span>
                        													    <span class="media-body bodycv">
                        													        <div class=""><!--username-->
                        													            <span class="">&nbsp;<b><a href="<?php echo base_url().$subcomment->profile_name; ?>"><?php echo ucfirst($subcomment->name);?></a></b>
                        													                <span class="dropdown pull-right">
                                                                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                                                                    <i class="fa fa-ellipsis-v"></i> </a> 
                                                                                                <ul class="dropdown-menu pull-right">
                                                                                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($subcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                                                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $subcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                                                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $subcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                                                                    <?php } else{ ?>
                                                                                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $subcomment->id;?>, <?php echo $subcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                                                                    <?php } ?>
                                                                                                </ul>
                                                                                            </span>
                                                                                            <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($subcomment->date);?></span>
                        													            </span><br>
                        													            <?php if(strlen($subcomment->comment) > 200){ ?>
                            														        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo mb_substr($subcomment->comment, 0, 200); ?>
                            														            <span class="showhide<?php echo $subcomment->id;?>" style="display:none;"><?php echo mb_substr($subcomment->comment,200); ?></span>
                            														            <span class="smorelessdots<?php echo $subcomment->id;?>">...</span>
                            														            <u onclick="showhide(<?php echo $subcomment->id;?>)" class="moreless<?php echo $subcomment->id;?>" style="cursor: pointer;color:red;">show-more</u></span>
                            														    <?php } else{ ?>
                            														        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo $subcomment->comment;?></span>
                            														    <?php } ?>
                        													       </div>
                        													   </span>
                        													</div>
                        													<?php } $commlastsubcomment = get_commlastsubcomment($key->id, $comment->id); 
                        													    if($subcomment->id > $commlastsubcomment){ ?>
                        													<a href="javascript:void(0);"><span class="loadsubcomment<?php echo $comment->id;?>" onClick="commloadsubcomment(<?php echo $key->id;?>, <?php echo $comment->id;?>, <?php echo $subcomment->id;?>)"><center>View More</center></span></a>
                        												    <?php } else{ ?>
                        												    <span class="loadsubcomment"></span>
                            											<?php } } ?>
                        											</div>
                												</div>
                										    <?php } $commlastcomment = get_commlastcomment($key->id); if($comment->id > $commlastcomment){ ?>
            										        <a href="javascript:void(0);"><span class="loadmorespan<?php echo $key->id;?>" onClick="commloadmore(<?php echo $key->id;?>, <?php echo $comment->id;?>)"><center>View More</center></span></a>
            										        <?php } else{ ?>
            										        <span class="loadmorespan"></span>
            										        <?php } ?>
            										    </div>
    												<?php } ?>
            									</div>
            									<!-- /.box-footer -->
            								<?php } ?>
            								</div>
            								<div id="load_data_message"></div>
            								<?php } ?>
            							</div>
            						</div>
            					</div><!-- /.tab-pane -->
            					
            					<div class="tab-pane" id="tpost" style="background: #eee;">
            						<div><center>
        						        <img src="<?php echo base_url();?>assets/landing/svg/spinnertab.svg" class="spinner" style="margin-top:8px;">
        						    </center></div>
            					</div>
            					<!-- /.tab-pane -->
            				</div>
            				<!-- /.tab-content -->
            			</div>
            			<!-- nav-tabs-custom -->
            		</div><!-- COL-MD-6 -->
        		
        		<div class="side3">
        			<div class="sidebarvj" style="box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);">
        				<div class="header">
        					<p><b>OTHER COMMUNITIES <span class="pull-right"><a href="<?php echo base_url('communities');?>">More</a></span>
        				    </b></p>
        				</div><br>
        				<?php $j = 0; if(isset($get_communities_all) && !empty($get_communities_all)){
        				foreach($get_communities_all->result() as $row) { if((!in_array($row->id, $join_comm)) && ($j < 15)) { ?>
        				<div class="row pt-0">
        					<div class="col-md-12 pd-0" style="padding-left:5px;">
        					    <span class="pull-left" style="padding-top:8px;">
        					        <a href="" style="text-transform:uppercase; padding-top:10px; text-overflow:ellipsis;"><b><?php echo $row->gener; ?></b></a>
        					    </span>
        					    <span class="pull-right">
        					        <!--<?php if(in_array($row->id, $join_comm)) { ?>
										<button class="btn btn-success unjoin<?php echo $row->id;?>" style="border-radius:4px!important;" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOINED </button>
									<?php } else { ?>
										<button class="btn btn-danger join<?php echo $row->id;?>" style="border-radius:4px!important;" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
									<?php } ?> -->
								    <button class="btn btn-success join<?php echo $row->id;?>" style="border-radius:4px!important;" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
        					    </span>
        					</div>
        				</div>
        				<hr style="margin:3px 0 3px; border-color:#f4f4f4">
        				<?php $j++; } } } ?>
        			</div>
        		</div><!-- COL-MD-3 -->
        	</div>
        	</div>
    	</div>
    </div>
    </section>
</div><!-- Wrapper -->

<div id="communitymembers" class="modal fade" role="dialog">
    <div class="modal-dialog" style="top:20%;">
        <div class="modal-content modalf">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $communitie_about; ?></h4>
            </div>
            <div class="modal-body modal-bodyv">
                <div class="row">
                    <?php if(isset($comm_joines) && ($comm_joines->num_rows() >0)){ foreach($comm_joines->result() as $comm_joinie){ ?>
                        <div class="user-block" style="padding:0 10px; display:flex;">
                            <span style="width:15%;">
        					<?php if(!empty($comm_joinie->profile_image)){ ?>
        					    <a href="<?php echo base_url().$comm_joinie->profile_name;?>">
            		                <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comm_joinie->profile_image;?>" alt="<?php echo ucwords($comm_joinie->username);?>">
            		            </a>
            		        <?php } else{ ?>
            		            <a href="<?php echo base_url().$comm_joinie->profile_name;?>">
            		                <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucwords($comm_joinie->name);?>">
            		            </a>
            		        <?php } ?>
            		       </span>
        		        <span  class="username" style="padding-top:8px;width:52%;margin-left:2px;">
        		            <span style="color:#337ab7;font-size:16.2px;"><a href="<?php echo base_url().$comm_joinie->profile_name; ?>"><?php echo ucwords($comm_joinie->name);?></a></span>
						</span>
						<span class="pull-right" style="width:33%;padding-top:6px;">
						<?php if(isset($following) && isset($this->session->userdata['logged_in']['user_id']) && ($comm_joinie->user_id == $this->session->userdata['logged_in']['user_id'])) { ?>
    				        <button class="vjw btn btn-success pull-right" onclick="yoursfollow();"> FOLLOW </button>
        		        <?php }else if(isset($following) && in_array($comm_joinie->user_id, $following)) { ?>
						    <button class="pull-right vjw btn btn-primary notloginmodal unfollow<?php echo $comm_joinie->user_id;?>" onclick="writerunfollow(<?php echo $comm_joinie->user_id;?>,'<?php echo $comm_joinie->username;?>')"> FOLLOWING </button>
						<?php } else { ?>
						    <button class="pull-right vjw btn btn-success notloginmodal follow<?php echo $comm_joinie->user_id;?>" onclick="writerfollow(<?php echo $comm_joinie->user_id;?>,'<?php echo $comm_joinie->username;?>')"> FOLLOW </button>
						<?php } ?>
						</span>
					</div><hr>
        		    <?php } } ?>
    		    </div>
    		</div>
        </div>
    </div>
</div>
<div id="editcomm_post" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>Update Your Post</center></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="updatecomm_post" action="#"></form>
            </div>
        </div>
    </div>
</div>
<div id="reportcomm_post" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>Report The Post</center></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="reportcommpost" action="#">
                    <textarea name="reportmsg" Placeholder="Why is it inappropriate? Write your reason here..." class="form-control" style="resize:none;"></textarea>
                    <span class="text-danger reportmsg"></span>
                    <input type="hidden" name="comm_story_id" id="comm_story_id" value="">
                    <input type="hidden" name="posted_byid" id="posted_byid" value=""><br>
                    <center>
                        <button type="submit" class="btn btn-danger"> Report </button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- comment update popup code ------>
<div class="modal fade" id="commentedit" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="commenteditdiv"></div>
            </div>
        </div>
	</div>
</div>
<!--comment update popup end ------------->
<!-- report comment popup code ------>
<div class="modal fade" id="reportcomment" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>Report The Comment</h4>
                <input type="hidden" id="reportcommentid">
                <input type="hidden" id="reportcommentuserid">
                <textarea class="form-control" id="reportmsg" placeholder ="Enter your Report Comments"></textarea>
                <br>
                <center><button type="submit" onClick="reportcommentdiv()" class="btn btn-danger">Report</button></center>
            </div>
        </div>
	</div>
</div>
<!--report comment popup end ------------->


<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv ">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="modal-body" style="padding-top:5px;">
				<div class="row">
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="facebookshare">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;"/>
						    <span class="socialsharepopupspan">Faceebok</span>
					    </a>
					</div>
					<div class="col-md-12 pd-5v">
					    <a href="javascript:void(0);" class="whatsappshare">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;"/>
						    <span class="socialsharepopupspan">Whatsapp</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="twittershare">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;"/>
						    <span class="socialsharepopupspan">Twitter</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;"/>
						    <span class="socialsharepopupspan">Copy to link</span></a>
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



<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script>
    function tab_about(comm_id){ // tab about
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>welcome/community_about',
    		data :{'comm_id':comm_id},
    		success:function(data){
    		    $('#about').html(data);
    		}
        });
    }
    function tab_tpost(comm_id){ // tab top posts
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>welcome/community_tpost',
    		data :{'comm_id':comm_id},
    		success:function(data){
    		    $('#tpost').html(data);
    		}
        });
    }
    
    $('#previewurl, #urldescription').keyup(function() { // post links preview
		var searchurl = $('#previewurl').val();
		var community_id = "<?php echo $commuid;?>";
		var urldescription = $('#urldescription').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>welcome/testing",
			data: {'searchurl': searchurl, 'community_id' : community_id, 'urldescription':urldescription},
			dataType: "json",
			success: function(data) {
				if(data == 'wrongurl'){
					$('#previewdiv').css('display','block');
					$('#preview').html('<center><div class="text-danger">You entered wrong URL.</div></center>');
				}else if(data.title) {
				    var posturlimage = data.image;
                    if(posturlimage){   }else{ posturlimage = '<?php echo base_url();?>assets/images/1.jpg'; }
					$('#previewdiv').css('display','block');
					$('#preview').html('<div class="user-block">'+data.urldescription+'</div>'+
					'<div class="media border-box"><div class="media-left"> <a href="'+data.titleurl+'" target="_blank"> '+
					'<img src="'+posturlimage+'" class="media-object img-v" alt="'+data.title+'"> </a> </div>'+
					'<div class="media-body" style="padding-top:15px;"> <a href="'+data.titleurl+'" target="_blank"> '+
					'<h4 class="media-heading"><b>'+data.title+'</b></h4></a> <p class="media-heading edittext360">'+data.story+'</p> </div> </div>');
				} else{
					$('#previewdiv').css('display','block');
					$('#preview').html('<center><div class="text-danger">Something Wrong . Try Again.</div></center>');
				}
			}
		});
	});
	
	$( "form#posturlform" ).submit(function( event ) { //post url form
        event.preventDefault();
        $.post("<?php echo base_url();?>welcome/communities_story",$("form#posturlform").serialize(),function(resultdata) {
            if(resultdata == 'notvalid'){
                $('.notvalid').html('Please Enter URL');
            } else if(resultdata == 'wrongurl'){ 
                $('.notvalid').html('Please Enter a Valid URL');
            } else if(resultdata == 'fail') {
                $('.notvalid').html(' ');
            }else{
                $('#previewdiv').html(' ');
                $('.posturlform').html(resultdata);
                $('#previewurl').val('');
                $('input[name="urldescription"]').val('');
            }
		});
    });
    $( "form#postquoteform" ).submit(function( event ) { //post quotes form
        event.preventDefault();
        $.post("<?php echo base_url();?>welcome/communities_story",$("form#postquoteform").serialize(),function(resultdata) {
            if(resultdata == 'notvalid'){
                $('.notvalid').html('Please Enter URL');
            } else if(resultdata == 'wrongurl'){ 
                $('.notvalid').html('Please Enter a Valid URL');
            } else if(resultdata == 'fail') {
                $('.notvalid').html(' ');
            }else if(resultdata == 'noinput'){
                $('.noquotes').html(' Please Enter Quotes to Post');
            }else{
                $('.posturlform').html(resultdata);
                $('textarea[name="story"]').val('');
            }
		});
    });
    $( "form#posttextform" ).submit(function( event ) { //post text form
        event.preventDefault();
        $.post("<?php echo base_url();?>welcome/communities_story",$("form#posttextform").serialize(),function(resultdata) {
            if(resultdata == 'notvalid'){
                $('.notvalid').html('Please Enter URL');
            } else if(resultdata == 'wrongurl'){ 
                $('.notvalid').html('Please Enter a Valid URL');
            } else if(resultdata == 'fail') {
                $('.notvalid').html(' ');
            }else if(resultdata == 'noinput'){
                $('.notext').html(' Please Enter Text to Post');
            }else{
                $('.posturlform').html(resultdata);
                $('textarea[name="story"]').val('');
            }
		});
    });
    function commujoin(comm_id, gener) { // community join button 
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>welcome/communities_join',
    		data :{'comm_id':comm_id, 'gener':gener},
    		dataType :"json",
    		success:function(data){
    		    if(data == 1){
    		        $('button.join'+comm_id).text('JOINED');
    		        $('button.join'+comm_id).removeClass('btn-success').addClass('btn-success');
    		        $('button.join'+comm_id).attr('onclick','commuunjoin('+comm_id+',"'+gener+'")');
    		        $('button.join'+comm_id).removeClass('join'+comm_id).addClass('unjoin'+comm_id);
    			    alert('You Are Successfully joined to the Community.');
    			}else{
    			    alert('Failed to join the Community.');
    			}
    		}
    	});
    }
    function commuunjoin(comm_id, gener) { // community unjoin button 
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>welcome/communities_join',
    		data :{'comm_id':comm_id, 'gener':gener},
    		dataType :"json",
    		success:function(data){
    		    if(data == 2){
    		        $('button.unjoin'+comm_id).text('JOIN');
    		        $('button.unjoin'+comm_id).removeClass('btn-success').addClass('btn-success');
    		        $('button.unjoin'+comm_id).attr('onclick','commujoin('+comm_id+',"'+gener+'")');
    		        $('button.unjoin'+comm_id).removeClass('unjoin'+comm_id).addClass('join'+comm_id);
    			    alert('You Are Successfully Un Joined the Community.');
    			}else{
    			    alert('Failed to un join the Community.');
    			}
    		}
    	});
    }
</script>
<script>
    function showhide(commentid){ // comments read more & less
        $(".showhide"+commentid).toggle();
        if ($('.moreless'+commentid).text() == "show-less") {
            $('.smorelessdots'+commentid).show();
            $('.moreless'+commentid).text("show-more");
        } else {
            $('.smorelessdots'+commentid).hide();
            $('.moreless'+commentid).text("show-less");
        }
    }
    function showhidedesc(storypostid){ // Story posts read more & less
        $(".showhidedesc"+storypostid).toggle();
        if ($('.smoreless'+storypostid).text() == "show-less") {
            $('.smorelessdots'+storypostid).show();
            $('.smoreless'+storypostid).text("show-more");
        } else {
            $('.smorelessdots'+storypostid).hide();
            $('.smoreless'+storypostid).text("show-less");
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[name="comment"]').on("keydown", function (e) {
            if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                var story_id = $(this).parent().find('input[name="story_id"]').val();
                if(story_id){
                    comm_comments(story_id);
                }
            }
        });
    });
    function comments(story_id){
        $('#myList'+story_id).css('display','block');
    }
    function commloadmore(storyid, commentid){
        $('.loadmorespan'+storyid).hide();
        $('#myList'+storyid).append('<span id="spinnertab'+storyid+'"><center> '+
            '<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner"></center></span>');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadcomments",
            data:{'storyid':storyid, 'commentid':commentid},
            success:function(html){
                //$('#myList'+storyid).append(html);
                $('#spinnertab'+storyid).html(' ');
                $('#spinnertab'+storyid).removeAttr('id');
                $('#myList'+storyid).append(html);
            }
        });
    }
	function comm_comments(story_id){ //Comments post submit
		var inputdata = $('#community_commentpost'+story_id+' :input').serialize();
		var old_cmtcount = $('#old_cmt'+story_id).text();
		//var old_subcmtcount = $('.old_subcmtcount'+commentid).text();
		$.post("<?php echo base_url();?>welcome/communities_comments",inputdata,function(resultdata, status) {
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				alert('Please Enter Comments Message.');
			}else if(result.status == 1){
				$("#community_commentpost"+story_id).find('input[name="comment" ]').val('');
				$('.ajaxcomment'+story_id).css('display','block');
				$('.ajaxcomment'+story_id).prepend('<div class="box-comment">'+
    		        '<img class="img-circle" src="<?php echo base_url();?>assets/images/'+result.response.profile_image+'" alt="'+result.response.name+'">'+
    			    '<div class="comment-text"><span class="username" style="padding-top:6px;">&nbsp; '+result.response.name+
    			        '<span class="dropdown pull-right">'+
                            '<a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">'+
                             '<i class="fa fa-ellipsis-v"></i> </a> '+
                            '<ul class="dropdown-menu pull-right">'+
                                '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response.id+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response.id+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                            '</ul>'+
                        '</span>'+
    			        '<span class="text-muted pull-right datecv">1 minute ago</span></span></div>'+
    		            '<div style="margin:8px 0 6px 2px" class="comment-text"><div class="more '+result.response.id+'">'+result.response.comment+'</div>'+
                        '<div style="margin:5px 0;"><a href="javascript:void(0)" onclick="postReplycomment('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-left replycv" title="Reply">REPLY</a>'+
                        '<a href="" class="pull-left replycv">I</a> '+
                        '<a href="javascript:void(0)" onClick="displayreplies('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-left replycv" title="Reply">'+
                        '<span class="old_subcmtcount'+result.response.id+'">0</span> REPLIES</a></div></div><br>'+
                        '<div class="comment-text"><div class="input-group postreplycomment'+result.response.id+'" style="margin-bottom:5px;"></div></div>'+
    		        
    		    '</div>'+'<div class="subcomments" id="mysubList'+result.response.story_id+'_'+result.response.id+'"></div>');
    		    $('#old_cmt'+story_id).html(parseInt(old_cmtcount)+1);
    		    //$('.old_subcmtcount'+commentid).html(parseInt(old_subcmtcount)+1);
			}else{
				alert('Failed to Post Comment.');
			}
		});
	}
	
	function displayreplies(commentid, comm_id, story_id){
	    $('#mysubList'+story_id+'_'+commentid).css('display','block');
	    setTimeout(function(){ $('#spinnertab'+commentid).html(' '); }, 50);
	}
	function commloadsubcomment(storyid, comment_id, subcommentid ){
        $('.loadsubcomment'+comment_id).hide();
        $('#mysubList'+storyid+'_'+comment_id).append('<span id="spinnertab'+storyid+'_'+comment_id+'"><center> '+
            '<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner"></center></span>');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadsubcomments",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                //$('#mysubList'+storyid+'_'+comment_id).append(html);
                $('#spinnertab'+storyid+'_'+comment_id).html(' ');
                $('#spinnertab'+storyid+'_'+comment_id).removeAttr('id');
                $('#mysubList'+storyid+'_'+comment_id).append(html);
            }
        });
    }
	function postReplycomment(commentid, comm_id, story_id){
	    $('div.postreplycomment'+commentid).html('<input type="text" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Reply Comment..." required>'+
	    '<span class="text-danger addreplaycmt'+commentid+'"></span><span class="input-group-btn">'+
	    '<button type="submit" class="btn btn-success btn-flat" onclick="addreplycomment('+commentid+','+comm_id+','+story_id+')">POST</button></span>');
	    $('#mysubList'+story_id+'_'+commentid).css('display','block');
	    setTimeout(function(){ $('#spinnertab'+commentid).html(' '); }, 50);
    }
	function addreplycomment(commentid, comm_id, story_id) {
	    var comments = $('#replycmts'+commentid).val();
	    //var old_cmtcount = $('#old_cmt'+story_id).text();
	    var old_subcmtcount = $('.old_subcmtcount'+commentid).text();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>welcome/communities_comments',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comm_id': comm_id, 'story_id': story_id,'comment':comments},
        		dataType: "json",
        		success:function(data){
                    $('#replycmts'+commentid).val('');
        		    if(data.status == 2){
                        $('.addreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data.status == 1){
                        $.ajax({
                            url: "<?php echo base_url('welcome/communities_commentslast'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                    var profile_image = result.response[0].profile_image;
                                    if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){
                                    }else{ profile_image = '2.png'; }
                                    var htmlcomment ='<div class="media editdelete'+result.response[0].id+'" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">'+
									    '<span class="media-left"><img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="'+result.response[0].name+'" style="width:25px;"></span>'+
                                        '<span class="media-body bodycv"><span class="username"> &nbsp;'+result.response[0].name+
                                            '<span class="dropdown" style="float:right;">'+
                                                '<a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">'+
                                                 '<i class="fa fa-ellipsis-v"></i></a> '+
                                                '<ul class="dropdown-menu pull-right">'+
                                                    '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response[0].id+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                                    '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response[0].id+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                                                '</ul>'+
                                            '</span>'+
                                            '<span class="text-muted pull-right datecv">1 minute ago</span></span>'+
                                            '<span class="more '+result.response[0].id+'" style="padding-left:10px; word-break:break-word;">'+result.response[0].comment+'</span>'+
                                        '</span>'+
                                    '</div>';
                                    $('#mysubList'+result.response[0].story_id+'_'+result.response[0].comment_id).prepend(htmlcomment);
                                    //$('#old_cmt'+story_id).html(parseInt(old_cmtcount)+1);
                                    $('.old_subcmtcount'+commentid).html(parseInt(old_subcmtcount)+1);
                                }
                            }
                        });
                    }else{
                        $('.addreplaycmt'+commentid).text('Failed to Post your Comments.');
                    }
                }
            });
	    }else{
	        $('.addreplaycmt'+commentid).text('Enter your Comments.');
	    }
	}
	
	function editcommcomment(commentid){
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/editcommcomment",
            data:{'commentid':commentid},
            success:function(response){
                if(response == 0){
                    $('#snackbar').text('Failed to Edit Comment.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
    	            $('#commenteditdiv').html(response);
    	            $('#commentedit').modal('show');
                }
            }
        });
    }
    function updatecommcomment(commentid){
        var comment = $('textarea#ucomment').val();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/updatecommcomment",
            data:{'comment':comment,'commentid': commentid},
            success:function(response){
                if(response == 1){
                    $('#commentedit').modal('hide');
                    $('.'+commentid).text(comment);
                    $('#snackbar').text('Comment Update Successfully.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('Failed to Update Comment.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            }
        });
    }
     function deletecommcomment(commentid){
        $('.deletemessage').html('Are You Sure? Do you want to delete.');
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
            $.ajax({
                type:'POST',
                url:"<?php echo base_url();?>welcome/deletecommcomment",
                data:{'commentid':commentid},
                success:function(response){
                    if(response){
                        var result = jQuery.parseJSON(response);
                        $('#old_cmt'+result.story_id).text(result.delcmtcount);
                        $('.old_subcmtcount'+result.comment_id).text(result.delsubcmtcount);
                        $('.editdelete'+commentid).css('display','none');
                        $('#snackbar').text('Comment Deleted Successfully.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        	            $('#told_cmt'+result.story_id).text(result.delcmtcount);
                        $('.told_subcmtcount'+result.comment_id).text(result.delsubcmtcount);
                    }else{
                        $('#snackbar').text('Failed to Delete Comment.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
            });
        });
    }
    function reportcommcomment(commentid, userid){
        $('#reportcommentid').val(commentid);
        $('#reportcommentuserid').val(userid);
        $('#reportcomment').modal('show');
    }
    function reportcommentdiv(){
        var reportcommentid = $('#reportcommentid').val();
        var reportcommentuserid = $('#reportcommentuserid').val();
        var reportmsg = $('#reportmsg').val();
        $.ajax({
    		url:'<?php echo base_url();?>welcome/reportcommcomment',
    		method: 'POST',
    		data: {'commentid': reportcommentid, 'userid': reportcommentuserid, 'reportmsg': reportmsg},
    		dataType: "json",
    		success:function(data){
    		    if((data.status == 1) && (data.response == 'success')){
        		    $('#snackbar').text('Successfully Reported.').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        	        $('#reportcomment').modal('hide');
    		    }else if((data.status == 2) && (data.response == 'fail')){
    		        $('#snackbar').text('Report Failed. Try Again').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        	        location.reload();
    		    }else{
    		        $('#snackbar').text('Please Enter report Message.').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    		    }
    		}
        });
    }
	
	$(document).ready(function(){
        $('input[name="tcomment"]').on("keydown", function (e) {
            if (e.keyCode === 13) {
                var story_id = $(this).parent().find('input[name="tstory_id"]').val();
                if(story_id){
                    tpostscomm_comments(story_id);
                }
            }
        });
    });
    function tcomments(story_id){
        $('#topmyList'+story_id).css('display','block');
    }
    function tpostscomm_comments(story_id){ //top posts Comments post submit
		var inputdata = $('#tpostscommunity_commentpost'+story_id+' :input').serialize();
		var told_cmtcount = $('#told_cmt'+story_id).text();
		$.post("<?php echo base_url();?>welcome/communities_comments",inputdata,function(resultdata, status) {
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				alert('Please Enter Comments Message.');
			}else if(result.status == 1){
				$("#tpostscommunity_commentpost"+story_id).find('input[name="tcomment" ]').val('');
				$('.tajaxcomment'+story_id).css('display','block');
				$('.tajaxcomment'+story_id).prepend('<div class="box-comment">'+
    		        '<img class="img-circle" src="<?php echo base_url();?>assets/images/'+result.response.profile_image+'" alt="'+result.response.name+'">'+
    			    '<div class="comment-text"><span class="username" style="padding-top:6px;">&nbsp;'+result.response.name+
    			        '<span class="dropdown" style="float:right;">'+
                            '<a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">'+
                             '<i class="fa fa-ellipsis-v"></i> </a> '+
                            '<ul class="dropdown-menu pull-right">'+
                                '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response.id+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response.id+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                            '</ul>'+
                        '</span>'+
    			        '<span class="text-muted pull-right datecv">1 minute ago</span></span>'+
    			    '</div>'+
    			    '<div style="margin:8px 0px 6px 2px" class="comment-text">'+
    		            '<div class="more '+result.response.id+'" style="word-break:break-word;">'+result.response.comment+'</div>'+
    		            '<div style="" class="">'+
                        '<a href="javascript:void(0)" style="font-size:0.8em;color:red;" onclick="toppostReplycomment('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-left" title="Reply"> REPLY</a> <a href="" class="pull-left replycv">I</a>'+
                        '<a href="javascript:void(0)" onClick="toppostdisplayreplies('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-left replycv" title="Replies"> '+
                            '<span class="told_subcmtcount'+result.response.id+'">0</span> REPLIES</a>'+
                        '</div>'+
                    '</div><br>'+
                    '<div class="comment-text">'+
                        '<div class="input-group toppostreplycomment'+result.response.id+'" style="margin-bottom:15px;"></div>'+
    		        '</div>'+
    		    '</div>'+'<div class="topsubcomments" id="topmysubList'+result.response.story_id+'_'+result.response.id+'"></div>');
    		    $('#told_cmt'+story_id).html(parseInt(told_cmtcount)+1);
			}else{
				alert('Failed to Post Comment.');
			}
		});
	}
    function toppostReplycomment(commentid, comm_id, story_id){
	    $('div.toppostreplycomment'+commentid).html('<input type="text" id="topreplycmts'+commentid+'" value="" class="form-control" placeholder="Reply Comment..." required>'+
	    '<span class="text-danger addreplaycmt'+commentid+'"></span><span class="input-group-btn">'+
	    '<button type="submit" class="btn btn-success btn-flat" onclick="topaddreplycomment('+commentid+','+comm_id+','+story_id+')">POST</button></span>');
	    $('#topmysubList'+story_id+'_'+commentid).css('display','block');
	    //setTimeout(function(){ $('#topspinnertab'+commentid).html(' '); }, 50);
	}
	function topaddreplycomment(commentid, comm_id, story_id){
	    var comments = $('#topreplycmts'+commentid).val();
	    //var told_cmtcount = $('#told_cmt'+story_id).text();
	    var told_subcmtcount = $('.told_subcmtcount'+commentid).text();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>welcome/communities_comments',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comm_id': comm_id, 'story_id': story_id,'comment':comments},
        		dataType: "json",
        		success:function(data){
                    $('#topreplycmts'+commentid).val('');
        		    if(data.status == 2){
                        $('.topaddreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data.status == 1){
                        $.ajax({
                            url: "<?php echo base_url('welcome/communities_commentslast'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                    var profile_image = result.response[0].profile_image;
                                    if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){
                                    }else{ profile_image = '2.png'; }
                                    var htmlcomment ='<div class="media editdelete'+result.response[0].id+'" style="margin-bottom:10px;padding-left: 10px;">'+
									    '<span class="media-left"><img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="'+result.response[0].name+'" style="width:25px;"></span>'+
                                        '<span class="media-body bodycv"><span class="username"> &nbsp;'+result.response[0].name+
                                            '<span class="dropdown" style="float:right;">'+
                                                '<a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">'+
                                                 '<i class="fa fa-ellipsis-v"></i></a> '+
                                                '<ul class="dropdown-menu pull-right">'+
                                                    '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response[0].id+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                                    '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response[0].id+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                                                '</ul>'+
                                            '</span>'+
                                            '<span class="text-muted pull-right datecv">1 minute ago</span></span>'+
                                            '<span class="more '+result.response[0].id+'" style="padding-left:10px; word-break:break-word;">'+result.response[0].comment+'</span>'+
                                        '</span>'+
                                    '</div>';
                                    $('#topmysubList'+result.response[0].story_id+'_'+result.response[0].comment_id).prepend(htmlcomment);
                                    //$('#told_cmt'+story_id).html(parseInt(told_cmtcount)+1);
                                    $('.told_subcmtcount'+commentid).html(parseInt(told_subcmtcount)+1);
                                }
                            }
                        });
                    }else{
                        $('.addreplaycmt'+commentid).text('Failed to Post your Comments.');
                    }
                }
            });
	    }else{
	        $('.addreplaycmt'+commentid).text('Enter your Comments.');
	    }
	}
	function toppostdisplayreplies(commentid, comm_id, story_id){
	    $('#topmysubList'+story_id+'_'+commentid).css('display','block');
	    setTimeout(function(){ $('#topspinnertab'+commentid).html(' '); }, 50);
	}
    function topcommloadmore(storyid, commentid){
        $('.toploadmorespan'+storyid).hide();
        $('#topmyList'+storyid).append('<span id="topspinnertab'+storyid+'"><center> '+
            '<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner"></center></span>');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadcomments/topstory",
            data:{'storyid':storyid, 'commentid':commentid},
            success:function(html){
                //$('#topmyList'+storyid).append(html);
                $('#topspinnertab'+storyid).html(' ');
                $('#topspinnertab'+storyid).removeAttr('id');
                $('#topmyList'+storyid).append(html);
            }
        });
    }
    function topcommloadsubcomment(storyid, comment_id, subcommentid ){
        $('.toploadsubcomment'+comment_id).hide();
        $('#topmysubList'+storyid+'_'+comment_id).append('<span id="topspinnertab'+storyid+'_'+comment_id+'"><center> '+
            '<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner"></center></span>');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadsubcomments/topstory",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                //$('#topmysubList'+storyid+'_'+comment_id).append(html);
                $('#topspinnertab'+storyid+'_'+comment_id).html(' ');
                $('#topspinnertab'+storyid+'_'+comment_id).removeAttr('id');
                $('#topmysubList'+storyid+'_'+comment_id).append(html);
            }
        });
    }
</script>
<script type="text/javascript">
    function likestory(id){ // like Story
    	var totallikes = $('#old_like'+id).text();
    	$.ajax({
    		url:'<?php echo base_url();?>welcome/comm_likes',
    		method: 'POST',
    		data: {'story_id':id},
    		dataType:'json',
    		success:function(data){
    		    if(data) {
        			$('#old_like'+id).text(parseInt(totallikes)+1);
        			$('.like'+id).css('color', '#337ab7');
        			$('button.like'+id).attr('onclick', "unlikestory("+id+")");
        			$('.like'+id).removeClass('like'+id).addClass('unlike'+id);
                }
            } 
        });
    }
    function unlikestory(id){ // unlike Story
    	var totallikes = $('#old_like'+id).text();
    	$.ajax({
    		url:'<?php echo base_url();?>welcome/comm_likes',
    		method: 'POST',
    		data: {'story_id':id},
    		dataType:'json',
    		success:function(data){
    		if(data) {
    			$('#old_like'+id).text(parseInt(totallikes)-1);
    			$('.unlike'+id).css('color', '#444');
    			$('button.unlike'+id).attr('onclick', "likestory("+id+")");
    			$('.unlike'+id).removeClass('unlike'+id).addClass('like'+id);
               }
            } 
        });
    }
    function tpostlikestory(id){ // like Story
    	var totallikes = $('#told_like'+id).text();
    	$.ajax({
    		url:'<?php echo base_url();?>welcome/comm_likes',
    		method: 'POST',
    		data: {'story_id':id},
    		dataType:'json',
    		success:function(data){
        		if(data) {
        			$('#told_like'+id).text(parseInt(totallikes)+1);
        			$('.like'+id).css('color', '#337ab7');
        			$('button.like'+id).attr('onclick', "tpostunlikestory("+id+")");
        			$('.like'+id).removeClass('like'+id).addClass('unlike'+id);
                }
            } 
        });
    }
    function tpostunlikestory(id){ // unlike Story
    	var totallikes = $('#told_like'+id).text();
    	$.ajax({
    		url:'<?php echo base_url();?>welcome/comm_likes',
    		method: 'POST',
    		data: {'story_id':id},
    		dataType:'json',
    		success:function(data){
    		    if(data) {
        			$('#told_like'+id).text(parseInt(totallikes)-1);
        			$('.unlike'+id).css('color', '#444');
        			$('button.unlike'+id).attr('onclick', "tpostlikestory("+id+")");
        			$('.unlike'+id).removeClass('unlike'+id).addClass('like'+id);
                }
            }
        })
    }
    function deletecomm_post(comm_story_id, posted_by){
        $('.deletemessage').html('Are You Sure? Do you want to delete.');
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
        	$.ajax({
        		url:'<?php echo base_url();?>welcome/deletecomm_post',
        		method: 'POST',
        		data: {'comm_story_id':comm_story_id, 'posted_by':posted_by},
        		dataType:'json',
        		success:function(data){
        			if(data) {
        				$('#delcomm'+comm_story_id).css('display', 'none');
                   }
                } 
            });
        });
    }
    function editcomm_post(comm_story_id, posted_by){
        $('#editcomm_post').modal('show');
    	$.ajax({
    		url:'<?php echo base_url();?>welcome/editcomm_post',
    		method: 'POST',
    		data: {'comm_story_id':comm_story_id, 'posted_by':posted_by},
    		success:function(data){
    		    if(data) {
    			    $('#updatecomm_post').html(data);
                }
            }
        });
    }
    $( "form#updatecomm_post" ).submit(function( event ) {
		event.preventDefault();
		var ptextid = $("form#updatecomm_post").serializeArray()[0].value;
		var ptext = $("form#updatecomm_post").serializeArray()[1].value;
		var pquotes = '';
		if($("form#updatecomm_post").serializeArray().length > 2) {
		    pquotes = $("form#updatecomm_post").serializeArray()[2].value;
		}
		$.post("<?php echo base_url();?>welcome/updatecomm_post",$("form#updatecomm_post").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
			    if(pquotes == 'quotes'){
			        $('.edittext'+ptextid).html(ptext);
			    }else{
    			    $('.edittext'+ptextid).text(ptext);
			    }
    			$('#editcomm_post').modal('hide');
			}else{
			}
		});
	});
	$( "form#reportcommpost" ).submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>welcome/reportcomm_post",$("form#reportcommpost").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
			    $('#reportcomm_post').modal('hide');
				//alert('report Successfully.');
			}else{
				alert('Failed to report.');
			}
		});
	});
    function reportcomm_post(comm_story_id, posted_by){
        $('#reportcomm_post').modal('show');
        $('#comm_story_id').val(comm_story_id);
        $('#posted_byid').val(posted_by);
    }
</script>
<script>
    $(document).ready(function(){
        var limit = 6;
        var start = 6;
        var action = 'inactive';
        function load_country_data(limit, start) {
            var commuid = "<?php echo $commuid;?>";
            $.ajax({
                url:'<?php echo base_url();?>welcome/loadcommustories/'+commuid,
                method:"POST",
                data:{limit:limit, start:start},
                cache:false,
                success:function(data){
                    $('#loadposts').append(data);
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
            //if($(window).scrollTop() + $(window).height() > $("#loadposts").height() && action == 'inactive'){
            if ($(window).scrollTop() >= (($("#loadposts").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 10);
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        var tlimit = 6;
        var tstart = 6;
        var taction = 'inactive';
        function tload_country_data(tlimit, tstart) {
            var commuid = "<?php echo $commuid;?>";
            $.ajax({
                url:'<?php echo base_url();?>welcome/toploadcommustories/'+commuid,
                method:"POST",
                data:{limit:tlimit, start:tstart},
                cache:false,
                success:function(data){
                    $('#toploadposts').append(data);
                    if(data == '') {
                        $('#tload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        taction = 'active';
                    }else{
                        $('#tload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        taction = "inactive";
                    }
                }
            });
        }
        if(taction == 'inactive') {
            taction = 'active';
            tload_country_data(tlimit, tstart);
        } 
        $(window).scroll(function(){
            //if($(window).scrollTop() + $(window).height() > $("#toploadposts").height() && taction == 'inactive'){
            if ($(window).scrollTop() >= (($("#toploadposts").height() - $(window).height())*0.6) && taction == 'inactive'){
                taction = 'active';
                tstart = tstart + tlimit;
                setTimeout(function(){tload_country_data(tlimit, tstart);}, 10);
            }
        });
    });
</script>