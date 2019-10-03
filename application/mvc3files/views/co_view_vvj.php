<style>
.media-heading{
    max-height: 2.8em;
    line-height: 1.4em;
    -webkit-line-clamp: 2;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.box-header with-borders{
	border-bottom: 1px solid #777!important;;
}
.box-comments {
	background: #fff;
}
a span.redvj {
	border:1px solid red; padding:10px 15px; border-radius:5px; color:red;
}
a:hover span.redvj{
	border:1px solid red; background:red; padding:10px 15px; border-radius:5px; color:#fff;
}
.nav-tabs-custom>.nav-tabs>li.active>a, .nav-tabs-custom>.nav-tabs>li.active:hover>a {
	background-color: #23678e;
	color: #fff;
}
.nav-tabs-custom>.nav-tabs>li>a {
	color: #FFF;
	border-radius: 0;
}
.nav-tabs-custom>.nav-tabs>li.active {
	border-bottom-color: #fff!important;
	border-top:none;  
	border-bottom: 3px solid #fff;
}
.nav-tabs>li {
	float: left;
	margin-bottom: 0px;
}
.nav-tabs-custom>.nav-tabs>li {
	border-top: 3px solid transparent;
	margin-right: 5px;
}
.nav-tabs-custom>.nav-tabs>li.active>a {
	border-top-color: transparent;
	border:none!important;
}
.nav-tabs-custom {
	margin-bottom: 20px;
	background: #23678e;
	box-shadow: 0 1px 1px rgba(0,0,0,0.1);
	border-radius: 3px;
}
.sideimg img{
	border-radius:5px;
	box-shadow: 0px 7px 11px rgba(35, 103, 142, 0.5);
}
.box-comments .comment-text{margin-left:0;}
.sidebarvj{
	background: #fff;
	padding: 10px;
	border-bottom-right-radius: 3px;
	border-bottom-left-radius: 3px;
	max-height:480px;
	overflow:scroll;
	overflow-x:hidden;
}
.tooltipv {
	position: relative;
	display: inline-block;
	cursor: pointer;
	color:#000;
}
.tooltipv .tooltipvtext {
	visibility: hidden;
	border-radius: 6px;
	padding: 5px 0;
	position: absolute;
	z-index: 1;
}
.tooltipv:hover .tooltipvtext {
	visibility: visible;
}
.dropdown-menu>li>a {
	color:#333;
}
.cv1v{
	width:1300px;
}
.pt-10{
	margin-top:0px;   
}	
@media (max-width:768px){
	.cv1v{
		width:auto!important;
	}
	.pt-10{
		margin-top:10px;   
	}
	.content {
		/*min-height: 250px;*/
		padding: 0px;margin-right: auto;margin-left: auto;
	}  
	.img-v {
        width: 120PX!important;
        height: 120px!important;
        border-radius: 5px;
    }
    
}
.border-box{
        border:1px solid #ddd;
        padding:5px;
        border-radius:5px;
        margin:0 5px;
    }
div.box-comments:nth-child(n+3) {
	display:none;
}
span.loadmorespan {
	cursor: pointer;
	color: #f00;
}
span.loadmorespantop {
	cursor: pointer;
	color: #f00;
}
.img-v {
	width:203px;
	height:190px;
}
.dv1 {
    min-width: 19%;
    float: right;
    right: 0;
    top: 24px;
    left: 80%;
    width: 10%;
}
.community-h1{
    display:none;
}
@media screen and (max-width:1330px){
    .community-h1{
        display:block!important;
    }
    .community-h{
        display:none!important;
    }
    .justi{
        justify-content:center!important;
    }
    .padd{
        margin-right:15px!important;
    }
}
@media screen and (max-width:1050px){
    /*.side-hide{
        display:none;
    }*/
    .wi{
         justify-content:center!important;
         margin:0 auto;
    }
}
</style>
<div class="" style="margin-top:35px; justify-content:center;">
    <section class="content" style="min-height:auto!important;">
        <input type="hidden" id="languageto" value="<?php if(isset($this->session->userdata['language']) && !empty($this->session->userdata['language'])) { echo $this->session->userdata['language']; } else { echo 'en'; } ?>">
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
    			// Add the STATE_CHANGED event handler to correcly maintain the state
    			// of the checkbox.
    			transliterationControl.addEventListener(    				google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
    				transliterateStateChangeHandler);
    			// Add the SERVER_UNREACHABLE event handler to display an error message
    			// if unable to reach the server.
    			transliterationControl.addEventListener(    				google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,
    				serverUnreachableHandler);
    			// Add the SERVER_REACHABLE event handler to remove the error message
    			// once the server becomes reachable.
    			transliterationControl.addEventListener(    				google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE, serverReachableHandler);
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
    	<div class="container cv1v pd-0">
        	<div class="row">
        		<div class="col-md-3 col-xs-12 pt-10 hidden-xs hidden-sm padd side-hide">
        		    <div class="row">
        				<div class="sideimg sidebarvj" style="border:1px solid #000; overflow:visible;">
            				<div class="header">
            					<center><h4>
                					<?php $communitie_about = ''; if(isset($get_communities_adout) && ($get_communities_adout->num_rows() >0)){ foreach($get_communities_adout->result() as $communitie_about){ $communitie_about = strtoupper($communitie_about->gener); } } echo $communitie_about; ?>
            					</h4></center>
            					<hr style="border: 1px solid #555;">
        					    <?php if(isset($comm_joines) && ($comm_joines->num_rows() >0)) { ?>
        					        <a href="javascript:void(0);"> <?php echo $comm_joines->num_rows(); ?> </a> Members
        					        <a href="javascript:void(0);" class="pull-right" data-toggle="modal" data-target="#communitymembers"> View All </a>
        					        <br> <br>
        					        <center>
										<?php $imgcount = 1; foreach($comm_joines->result() as $comm_joinie) {
											if(!empty($comm_joinie->profile_image) && ($imgcount < 6)){ ?>
											<a href="<?php echo base_url();?>index.php/welcome/profile?id=<?php echo $comm_joinie->user_id;?>"><span>
												<img src="<?php echo base_url();?>assets/images/<?php echo $comm_joinie->profile_image;?>" style="width: 40px;height: 40px; border-radius:50%;">
										   </span></a>
										<?php } elseif($imgcount < 6) { ?>
											<a href="<?php echo base_url();?>index.php/welcome/profile?id=<?php echo $comm_joinie->user_id;?>"><span>
												<img src="<?php echo base_url();?>assets/images/2.png" style="width:40px;height: 40px; border-radius:50%;">
											</span></a>   
										<?php } ?>
										<?php $imgcount++; } ?>
									</center>
								<?php } else { echo "<center> No Member Joined in the Group </center>"; } ?><br><br>
        					    <button class="btn-block btn btn-success unjoin<?php echo $this->uri->segment(3);?>" onclick="commuunjoin(<?php echo $this->uri->segment(3);?>,'<?php echo $communitie_about;?>')"> JOINED </button><br>
            				</div>
        				</div>
        			</div><br>
        			<div class="row community-h1">
        			    <div class="sidebarvj">
        				<div class="header">
        					<p><b>OTHER COMMUNITIES <span class="pull-right"><a href="<?php echo base_url('index.php/Welcome/communities');?>">More</a></span>
        				    </b></p>
        				</div><br>
        				<?php if(isset($get_communities_all) && !empty($get_communities_all)){
        				foreach($get_communities_all->result() as $row) { ?>
        				<div class="row pt-0">
        					<!--<div class="col-md-3" style="padding-right:0px;">
        						<div>
        							<img class="img-circle img-responsive" style="width:47px; height:47px" src="<?php echo base_url();?>assets/images/<?php  echo $row->comm_image;?>" alt="Photo">
        						</div>
        					</div>-->
        					<div class="col-md-12 pd-0" style="padding-left:5px;">
        					    <span class="pull-left" style="padding-top:8px;">
        					        <a href="" style="text-transform:uppercase; padding-top:10px; text-overflow:ellipsis;"><b><?php echo $row->gener; ?></b></a>
        					    </span>
        					    <span class="pull-right">
        					        <?php if(in_array($row->id, $join_comm)) { ?>
											<button class="btn btn-success unjoin<?php echo $row->id;?>" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOINED </button>
										<?php } else { ?>
											<button class="btn btn-danger join<?php echo $row->id;?>" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
										<?php } ?>
        					    </span>
        						<!--<div class="" style="border-radius:0 0 0px 5px;">
        							<a href=""><b><?php echo $row->gener; ?></b></a>
        							<!--<p class="text-justify" style="font-size:12px;"><?php echo substr($row->about_communities,0,50); ?></p>
									<input type="hidden" name="comm_id" value="<?php echo $row->id; ?>">
									<input type="hidden" name="gener" value="<?php echo $row->gener;?>">
									<center>
										<?php if(in_array($row->id, $join_comm)) { ?>
											<button class="btn-block btn btn-success unjoin<?php echo $row->id;?>" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOINED </button>
										<?php } else { ?>
											<button class="btn-block btn btn-danger join<?php echo $row->id;?>" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
										<?php } ?>
									</center>
        						</div>-->
        					</div>
        				</div>
        				<hr style="margin:3px 0 3px; border-color:#999">
        				<?php } } ?>
        			</div>
        			</div>
        		</div><!-- COL-MD-3 -->        		
        		<div class="col-md-6 col-xs-12 col-sm-12 pt-10 justi">			
        			<div class="wi"><!-- Custom Tabs -->
        			<div class="nav-tabs-custom">
        				<ul class="nav nav-tabs">
        					<li><a href="#about" data-toggle="tab">About</a></li>
        					<li class="active"><a href="#post" data-toggle="tab">Post</a></li>
        					<li><a href="#tpost" data-toggle="tab">Top Posts</a></li>
        				</ul>
        				<div class="tab-content" style="padding:0px;background: #ecf0f5;">
        					<div class="tab-pane" id="about" style="padding:10px;background:#fff;">
        						<?php if(isset($get_communities_adout) && !empty($get_communities_adout)){
        							foreach($get_communities_adout->result() as $row) { ?>
        							<div>
        								<img src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="Communities Image" class="img-responsive" style="width:584px; height:190px;">
        								<br><br>
        								<p class="text-justify">
        									<?php echo $row->about_communities; ?> 
        								</p>
        							</div>
        						<?php } } ?>
        					</div>
        					<!-- /.tab-pane -->
        					<div class="tab-pane active" id="post">
        						<?php if (isset($this->session->userdata['logged_in'])) { ?>
        						<div class="box-header with-borders">
        							<div class="user-block">
        								<a>
        									<?php if(isset($this->session->userdata['logged_in']['profile_image']) &&
        									!empty($this->session->userdata['logged_in']['profile_image'])) { ?>
        										<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height: 37px;" class="img-circle" alt="User Image">
        									<?php } else { ?>
        										<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height: 37px;" class="img-circle">
        									<?php } ?>
        								</a>
        								<span class="username" style="padding-top:8px;">
											<a href="#"><?php if(isset($this->session->userdata['logged_in']['name'])){echo "Hi, ".ucwords($this->session->userdata['logged_in']['name']);}?></a>
										</span>
        							</div>
        						</div>
        						<?php } ?>
        						<!-- Tab content -->
        						<div class="box-footer">
        							<ul class="nav nav-tabs">
        								<li>
        									<a href="#tab_1" data-toggle="tab">
        									<center><i class="fa fa-link fa-2x" style="color:#56bc8a;" aria-hidden="true"></i></center> <br><b>LINKS</b>
        									</a>
        								</li>
        								<li class="active">
        									<a href="#tab_2" data-toggle="tab">
        									<center><i class="fa fa-quote-left fa-2x" style="color:#f2992e;"></i></center><br> <b>QUOTES</b>
        									</a>
        								</li>
        								<li>
        									<a href="#tab_3" data-toggle="tab">
        									    <center><b><span style="color:black;font-size: 35px; padding-top: -20px;">A</span><span style="color:black;font-size: 25px;">A</span></b></center> <b>TEXT</b>
        									</a>
        								</li>
        							</ul>
        							<div class="tab-content">
        								<div class="tab-pane" id="tab_1">
        									<div class="box-footer">
        										<form id="posturlform">
        											<div class="input-group" style="width:100%;">
        												<input type="hidden" name="comm_id" value="<?php echo $this->uri->segment(3); ?>">
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
        									<div class="box box-widget" style="background:#fff;box-shadow: none;">
        										<div class="box-footer" style="padding-bottom:35px;">
        											<form id="postquoteform">
        												<div class="img-push">
        													<input type="hidden" name="comm_id" value="<?php echo $this->uri->segment(3); ?>">					
        													<textarea type="text" name="story" rows="5" cols="13" placeholder="Type QUOTES ......" class="form-control" style="border-radius:5px;border-color:#000; background: #4c3b3b2e; color: #000; resize:none;" id="quotesstory"></textarea>
        													<span class="text-danger noquotes"></span>
        													<input type="hidden" name="quotes" value="quotes">
        													<div class="input-group-btn pull-right" style="padding-right: 51px; margin-top:5px;">
        														<button type="submit" class="btn btn-primary">Post</button>
        													</div>
        												</div>
        											</form>
        										</div>
        									</div>
        								</div>
        								<div class="tab-pane" id="tab_3">
        									<div class="box box-widget" style="background:#fff;">
        										<div class="box-footer">
        											<form id="posttextform">
        												<div class="img-push">
        													<input type="hidden" name="comm_id" value="<?php echo $this->uri->segment(3); ?>">					
        													<textarea type="text" name="story" rows="5" cols="13" placeholder="Type Message ......" class="form-control" style="border-radius:5px;" id="textstory"></textarea>
        													<span class="text-danger notext"></span>
        													<div class="input-group-btn pull-right" style="padding-right: 51px; margin-top:5px;">
        														<button type="submit" class="btn btn-primary">Post</button>
        													</div>
        												</div>
        											</form>
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
        											<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
        											<span class="username">
														<a href="#"><?php echo $this->session->userdata['logged_in']['name'];?> </a>
													</span>
        											<span class="description">
														<?php echo date('Y-m-d'); ?>
													</span>
        										</div>
        									</div>
        									<div class="box-body" id="preview"></div>
        								</div>        								
        								<div class="box box-widget delcomm" style="margin-bottom:10px;"></div>
        								<div class="box box-widget posturlform" style="margin-bottom:10px;"></div>
        								<?php if(isset($communities_story_get) && ($communities_story_get->num_rows() > 0)){ 
        									foreach ($communities_story_get->result() as $key) { ?>
        									<div class="box box-widget" style="background:#fff; border:1px solid #dddddd; margin-bottom:10px;" id="delcomm<?php echo $key->id;?>">        
												<?php if(isset($key->type) && ($key->type='url')) { ?>
        										<div class="box-header with-borders">
        											<div class="user-block">
        												<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
        													<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="User Image">
        												<?php } else { ?>
        													<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
        												<?php } ?>
        												<span class="username">
        												    <a href="#"><?php echo $key->name;?></a> 
        												    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($key->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
																<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
																	<i class="fa fa-ellipsis-v pull-right" style="padding:0 0 0 15px"></i>
																</a>
																<ul class="dropdown-menu pull-right" style="margin-top:-30px; right:10px;">
																	<li><a href="#" onclick="deletecomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-trash pr-10"></i> DELETE </a></li>
																	<li><a href="#" onclick="editcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-pencil pr-10"></i> EDIT </a></li>
																</ul>
                        					                <?php } else { ?>
																<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false"><i class="fa fa-ellipsis-v pull-right"></i>
																</a>
																<ul class="dropdown-menu pull-right" style="margin-top:-30px; right:10px;">
																	<li><a href="#" class="" style="" onclick="reportcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-exclamation-triangle pr-10"></i> REPORT </a>
																	</li>
																</ul>
                        					                <?php } ?>
        												</span>
        												<span class="description">
																<?php echo substr($key->date,0,10);?>
														</span>
        											</div>
        										</div>
        										<div class="box-body border-box">
        										    <?php if(isset($key->urldescription) && !empty($key->urldescription)){ echo '<div class="user-block">'.$key->urldescription.'</div>'; } ?>
        											<?php if(!empty($key->title)) { ?>
        												<div class="media">
        													<div class="media-left">
        														<a href="<?php echo $key->titleurl;?>" target="_blank">
        															<?php if(!empty($key->image)) { ?>
																		<img src="<?php echo $key->image;?>" class="media-object img-v">
																	<?php } else { ?>
																		<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v">
        															<?php } ?>
        														</a>
        													</div>
        													<div class="media-body" style="padding-top:15px;">
        														<a href="<?php echo $key->titleurl;?>" target="_blank"> 
        															<h4 class="media-heading"><b><?php echo ucfirst($key->title);?></b></h4>
        														</a>
        														<p class="edittext<?php echo $key->id;?>"><?php echo substr($key->story,0,150);?></p>
        													</div>
        												</div>
        											<?php } else { ?>
        												<p class="edittext<?php echo $key->id;?>"><?php echo $key->story;?></p>
        											<?php } ?>
        										</div>
        										<div class="box-body">
        											<?php if(isset($commstory_likes) && in_array($key->id, $commstory_likes)) { ?>
                    								    <button class="btn btn-default btn-xs unlike<?php echo $key->id;?>" onclick="unlikestory(<?php echo $key->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
                    								<?php } else { ?>
                    								    <button class="btn btn-default btn-xs like<?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
                    								<?php } ?>
        											<span><i class="fa fa-share"></i> Share</span>
        											<span class="pull-right text-muted">
        												<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span> <span id="new_like"></span> Likes &nbsp; 
        												<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
        													foreach($comm_comment_count->result() as $reviews2) { 
        														if($reviews2->story_id == $key->id) { ?>
        															<?php echo $reviews2->commentcount;?> 
        														<?php } ?>
        												<?php } } ?> Comments			
        											</span>
        										</div>
        										<?php } else { ?>
        											<div class="box-header with-borders">
        												<div class="user-block">
        													<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
																<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="User Image">
        													<?php } else { ?>
        														<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
        														<?php } ?>
        													<span class="username">
																<a href="#"><?php echo $key->name;?></a>
															</span>
        													<span class="description">
																<?php echo $key->date;?>
															</span>
        												</div>
        											</div>
        											<div class="box-body">
        												<p class="text-justify">
															<?php echo $key->story;?>
														</p>
        												<button type="submit" class="btn btn-default btn-xs <?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)"><i class="fa fa-heart"></i></button>
        												<span class="pull-right text-muted">
        													<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
        													<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
        														foreach($comm_comment_count->result() as $reviews2) { 
        															if($reviews2->story_id == $key->id) { ?>
        																<?php echo $reviews2->commentcount;?> 
        															<?php } ?>
        													<?php } } ?> Comments			
        												</span>
        											</div>
        										<?php } ?>
        										<!-- /.box-footer -->
        										<div class="box-footer">
        											<div id="community_commentpost<?php echo $key->id; ?>">
        												<?php if (isset($this->session->userdata['logged_in'])) { 
        												    if(isset($this->session->userdata['logged_in']['profile_image']) && 
        												        !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
																	<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height: 37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="User Image">
        												<?php } else { ?>
															<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
        												<?php } } ?>
        												<div class="input-group">
        												    <input type="hidden" name="story_id" value="<?php echo $key->id; ?>">
        													<input type="text" name="comment" placeholder="Type Comment Message ..." class="form-control" required="">
        													<input type="hidden" name="comm_id" value="<?php echo $this->uri->segment(3); ?>">
        													<span class="input-group-btn">
        														<button type="submit" class="btn btn-success btn-flat" onclick="comm_comments(<?php echo $key->id;?>)"> Comment </button>
        													</span>
        												</div>
        											</div>
        										</div>
        										<!-- /.box-footer -->
        										<div class="box-footer box-comments ajaxcomment<?php echo $key->id;?>" style="background: #fff;"> </div>
        										<?php $comments = get_comments($key->id);
        											if(isset($comments) && ($comments->num_rows()>0)) { ?>
        											<div id="myList<?php echo $key->id;?>">
        											    <div class="box-footer box-comments" style="padding-bottom:0px;">
        											        <div class="box-comment">
        											            <?php if(isset($this->session->userdata['logged_in']['profile_image']) && !empty($this->session->userdata['logged_in']['profile_image'])){ ?>
        														<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata['logged_in']['profile_image'];?>" alt="User Image">
        														<?php } else { ?>
        															<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
        														<?php } ?>
        														<div class="comment-text postreplycmt<?php echo $key->id;?>"> </div>
        											        </div>
        											    </div>
            											<?php foreach($comments->result() as $comment){ ?>
            												<div class="box-footer box-comments" style="padding-bottom:0px;">
            													<div class="box-comment">
            														<?php if(isset($comment->profile_image) && !empty($comment->profile_image)){ ?>
            														<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="User Image">
            														<?php } else { ?>
            															<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
            														<?php } ?>
            														<div class="comment-text">
            															<span class="username">&nbsp;
            															    <?php echo $comment->name;?>
            																<span class="text-muted pull-right"><?php echo $comment->date;?></span>
            															</span>	&nbsp;<?php echo $comment->comment;?>
            															<a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-right" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i></a>
            															<div class="input-group postreplycomment<?php echo $comment->id;?>"><!-- Reply comment form --></div>
            														</div>
            													</div>
            												</div>
            										    <?php } ?> 
        										        <span class="loadmorespan" id="<?php echo $key->id;?>"><center>Read More...</center></span>
        										    </div>
												<?php } ?>
        									</div>
        									<!-- /.box-footer -->
        								<?php } } ?>
        							</div>
        						</div>
        					</div>
        					<!-- /.tab-pane -->        
        					<div class="tab-pane" id="tpost">
        						<div class="box-header with-border" style="margin-top:20px; padding:0">
        							<div class="col-md-12" style="padding:0">
        								<div class="box box-widget" style="background:#fff; border:1px solid #dddddd; margin-bottom:10px;display: none;" id="previewdiv">
        									<div class="box-header with-borders">
        										<div class="user-block">
        											<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
        											<span class="username"><a href="#"><?php echo $this->session->userdata['logged_in']['name'];?> </a></span>
        											<span class="description"><?php echo date('Y-m-d'); ?></span>
        										</div>
        									</div>
        									<div class="box-body" id="preview"></div>
        								</div>
        								<?php if(isset($communities_story_get_likes) && !empty($communities_story_get_likes)){ 
        									foreach ($communities_story_get_likes->result() as $key) { ?>
        									<div class="box box-widget" style="background:#fff; border:1px solid #dddddd; margin-bottom:10px;">
        										<?php if(($key->type='url')) { ?>
        										<div class="box-header with-border">
        											<div class="user-block">
        												<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
															<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="User Image">
        												<?php } else { ?>
        													<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
        												<?php } ?>
        												<span class="username"><a href="#"><?php echo $key->name;?></a>
        												    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($key->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
        												    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
        												        <i class="fa fa-ellipsis-v pull-right"></i>
        												    </a>
        												    <ul class="dropdown-menu pull-right" style="margin-top:-30px; right:10px;">
                        					                    <li><a href="#" onclick="deletecomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-trash"></i> Delete </a></li>
                        					                    <li><a href="#" onclick="editcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-pencil"></i> Edit </a></li>
                        					                </ul>
                        					                <?php } else { ?>
                        					                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
        												        <i class="fa fa-ellipsis-v pull-right"></i>
        												    </a>
        												    <ul class="dropdown-menu pull-right" style="margin-top:-30px; right:10px;">
                        					                    <li><a href="#" class="" style="" onclick="reportcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-exclamation-triangle pr-10"></i> Report </a>
        												        </li>
                        					                </ul>
                        					                <?php } ?>
        												</span>
        												<span class="description"><?php echo substr($key->date,0,10);?></span>
        											</div>
        										</div>
        										<div class="box-body">
        											<?php if(!empty($key->title)) { ?>
        												<div class="media">
        													<div class="media-left">
        														<a href="<?php echo $key->titleurl;?>" target="_blank">
        														<?php if((!empty($key->image) && ($key->type == "url"))) { ?>
        													        <img src="<?php echo $key->image;?>" class="media-object img-v">
        													    <?php }elseif((!empty($key->image) && ($key->type != "url"))){ ?>
        													        <img src="<?php echo base_url();?>assets/images/<?php echo $key->image;?>" class="media-object img-v">
        														<?php } else { ?>
        															<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v">
        															<?php } ?>
        														</a>
        													</div>
        													<div class="media-body" style="padding-top:15px;">
        														<a href="<?php echo $key->titleurl;?>" target="_blank"> 
        															<h4 class="media-heading"><b><?php echo ucfirst($key->title);?></b></h4>
        														</a>
        														<p class="edittext<?php echo $key->id;?>"><?php echo substr($key->story,0,150);?>...</p>
        													</div>
        												</div>
        											<?php } else { ?>
        												<p class="edittext<?php echo $key->id;?>"><?php echo $key->story;?></p>
        											<?php } ?>
        										</div>
        										<div class="box-body">
        											<?php if(isset($commstory_likes) && in_array($key->id, $commstory_likes)) { ?>
                    								    <button class="btn btn-default btn-xs unlike<?php echo $key->id;?>" onclick="tpostunlikestory(<?php echo $key->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
                    								<?php } else { ?>
                    								    <button class="btn btn-default btn-xs like<?php echo $key->id;?>" onclick="tpostlikestory(<?php echo $key->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
                    								<?php } ?>
        											<span><i class="fa fa-share"></i> Share</span>	
        											<span class="pull-right text-muted">
        											<span id="told_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span><span id="tnew_like"></span> Likes &nbsp; 
        											<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
        													foreach($comm_comment_count->result() as $reviews2) { 
        														if($reviews2->story_id == $key->id) { ?>
        															<?php echo $reviews2->commentcount;?> 
        														<?php } ?>
        												<?php } } ?> Comments			
        											</span>
        									    </div>
        									<?php } else { ?>
        										<div class="box-header with-borders">
        											<div class="user-block">
        												<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
        												<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="User Image">
        												<?php } else { ?>
        													<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
        													<?php } ?>
        												<span class="username"><a href="#"><?php echo $key->name;?></a></span>
        												<span class="description"><?php echo $key->date;?></span>
        											</div>
        										</div>
        										<div class="box-body">
        											<p class="text-justify"><?php echo $key->story;?></p>
        											<button type="submit" class="btn btn-default btn-xs <?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)"><i class="fa fa-heart"></i></button>
        											<span class="pull-right text-muted">
        											<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
        											<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
        													foreach($comm_comment_count->result() as $reviews2) { 
        														if($reviews2->story_id == $key->id) { ?>
        															<?php echo $reviews2->commentcount;?> 
        														<?php } ?>
        												<?php } } ?> Comments 
        											</span>
        										</div>
        										<?php } ?><!-- /.box-footer -->
        										<div class="box-footer">
        											<div id="tpostscommunity_commentpost<?php echo $key->id; ?>">
        												<?php if (isset($this->session->userdata['logged_in'])) { 
        												    if(isset($this->session->userdata['logged_in']['profile_image']) && 
        												        !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
															<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height: 37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="User Image">
        												<?php } else { ?>
															<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
        												<?php } } ?>
        												<div class="input-group">
        												    <input type="hidden" name="tstory_id" value="<?php echo $key->id; ?>">
        													<input type="text" name="tcomment" placeholder="Type Comment Message ..." class="form-control" required="">
        													<input type="hidden" name="tcomm_id" value="<?php echo $this->uri->segment(3); ?>">
        													<span class="input-group-btn">
        														<button type="submit" class="btn btn-success btn-flat" onclick="tpostscomm_comments(<?php echo $key->id;?>)"> Comment </button>
        													</span>
        												</div>
        											</div>
        										</div>
        										<!-- /.box-footer -->        					
        					                    <div class="box-footer box-comments tajaxcomment<?php echo $key->id;?>" style="background: #fff;"> </div>
        										<?php $comments = get_comments($key->id);
        											if(isset($comments) && ($comments->num_rows()>0)) { ?>
        											<div id="myListtop<?php echo $key->id;?>">
            											<?php foreach($comments->result() as $comment) { ?>
            												<div class="box-footer box-comments">
            													<div class="box-comment">
            														<?php if(isset($comment->profile_image) && !empty($comment->profile_image)){ ?>
            														<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="User Image">
            														<?php } else { ?>
            															<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
            														<?php } ?>
            														<div class="comment-text">
            															<span class="username">
            															<?php echo $comment->name;?>
            															<span class="text-muted pull-right"><?php echo $comment->date;?></span>
            															</span>
            															<?php echo $comment->comment;?>
            														</div>
            													</div>
            												</div>
            										    <?php } ?> 
        										        <span class="loadmorespantop top<?php echo $key->id;?>" id="<?php echo $key->id;?>">
															<center>Read More...</center>
														</span>
        										    </div>
												<?php } ?>
        									</div>
        										<!-- /.box-footer -->
        								<?php } } ?>
        							</div>
        						</div>
        					</div>
        					<!-- /.tab-pane -->
        				</div>
        				<!-- /.tab-content -->
        			</div>
        			<!-- nav-tabs-custom -->
        			</div>
        		</div><!-- COL-MD-6 -->
        		<div class="col-md-3 col-xs-12 pt-10  hidden-xs hidden-sm hidden-md community-h">
        			<div class="sidebarvj">
        				<div class="header">
        					<p><b>OTHER COMMUNITIES <span class="pull-right"><a href="<?php echo base_url('index.php/Welcome/communities');?>">More</a></span>
        				    </b></p>
        				</div><br>
        				<?php if(isset($get_communities_all) && !empty($get_communities_all)){
        				foreach($get_communities_all->result() as $row) { ?>
        				<div class="row pt-0">
        					<!--<div class="col-md-3" style="padding-right:0px;">
        						<div>
        							<img class="img-circle img-responsive" style="width:47px; height:47px" src="<?php echo base_url();?>assets/images/<?php  echo $row->comm_image;?>" alt="Photo">
        						</div>
        					</div>-->
        					<div class="col-md-12 pd-0" style="padding-left:5px;">
        					    <span class="pull-left" style="padding-top:8px;">
        					        <a href="" style="text-transform:uppercase; padding-top:10px; text-overflow:ellipsis;"><b><?php echo $row->gener; ?></b></a>
        					    </span>
        					    <span class="pull-right">
        					        <?php if(in_array($row->id, $join_comm)) { ?>
											<button class="btn btn-success unjoin<?php echo $row->id;?>" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOINED </button>
										<?php } else { ?>
											<button class="btn btn-danger join<?php echo $row->id;?>" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
										<?php } ?>
        					    </span>
        						<!--<div class="" style="border-radius:0 0 0px 5px;">
        							<a href=""><b><?php echo $row->gener; ?></b></a>
        							<!--<p class="text-justify" style="font-size:12px;"><?php echo substr($row->about_communities,0,50); ?></p>
									<input type="hidden" name="comm_id" value="<?php echo $row->id; ?>">
									<input type="hidden" name="gener" value="<?php echo $row->gener;?>">
									<center>
										<?php if(in_array($row->id, $join_comm)) { ?>
											<button class="btn-block btn btn-success unjoin<?php echo $row->id;?>" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOINED </button>
										<?php } else { ?>
											<button class="btn-block btn btn-danger join<?php echo $row->id;?>" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
										<?php } ?>
									</center>
        						</div>-->
        					</div>
        				</div>
        				<hr style="margin:3px 0 3px; border-color:#999">
        				<?php } } ?>
        			</div>
        		</div><!-- COL-MD-3 -->
        	</div>
    	</div>
    </section>
</div><!-- Wrapper -->
<div id="communitymembers" class="modal fade" role="dialog">
    <div class="modal-dialog" style="top:20%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $communitie_about; ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php if(isset($comm_joines) && ($comm_joines->num_rows() >0)){ foreach($comm_joines->result() as $comm_joinie){
                        echo "<div class='col-md-12'>";
    					  if(!empty($comm_joinie->profile_image)){ ?>
    					    <a href="<?php echo base_url();?>index.php/welcome/profile?id=<?php echo $comm_joinie->user_id;?>">
        		                <img src="<?php echo base_url();?>assets/images/<?php echo $comm_joinie->profile_image;?>" style="width: 50px;height: 50px; border-radius:50%; padding: 5px;">
        		            </a>
        		        <?php } else{ ?>
        		            <a href="<?php echo base_url();?>index.php/welcome/profile?id=<?php echo $comm_joinie->user_id;?>">
        		                <img src="<?php echo base_url();?>assets/images/2.png" style="width: 50px;height: 50px; border-radius:50%; padding: 5px;">
        		            </a>
        		        <?php } ?>
        		        <div class="tooltipv">
        		            <span><?php echo ucwords($comm_joinie->username);?></span>
                            <span class="tooltipvtext" style="width:280px; background: #eee;">
							    <div class="box box-widget widget-user col-md-12" style="padding:10px 10px 0 10px;">
							        <a href="<?php echo base_url();?>index.php/welcome/profile?id=<?php echo $comm_joinie->user_id;?>">
    							        <?php if(isset($comm_joinie->banner_image) && !empty($comm_joinie->banner_image)) { ?>
    							            <div class="widget-user-header bg-black" style="background: url('<?php echo base_url();?>assets/images/<?php echo $comm_joinie->banner_image;?>') center; height:80px;"></div>
    							        <?php } else { ?>
    							            <div class="widget-user-header bg-black" style="background: url('../../dist/img/photo1.png') center; height:80px;"></div>
    							        <?php } ?>
    								    <div class="widget-user-image" style="top:18px;">
        									<?php if(isset($comm_joinie->profile_image) && !empty($comm_joinie->profile_image)) { ?>
        										<img src="<?php echo base_url();?>assets/images/<?php echo $comm_joinie->profile_image;?>" class="img-circle" style="width: 90px;height: 90px; border-radius:50%;">
        									<?php } else { ?>
        										<img src="<?php echo base_url();?>assets/images/1.jpg" class="img-circle" alt="User Image" style="width: 90px; height: 90px; border-radius:50%;">
        									<?php } ?>
        								</div><br>
        							</a>
								    <h3 class="widget-user-username"><center><?php echo ucfirst($comm_joinie->username);?></center></h3>
    								<div class="box-footer" style="padding-top:0px;">
    									<?php $writings_joins = get_writingsjoins($comm_joinie->user_id); 
    									    if(isset($writings_joins)){ 
    									?>
    									<div class="row">
    										<ul class="list-inline" style="padding:10px 10px; background: #eee;">
    											<li class="border-right">
    												<i class="fa fa-edit"></i> <?php echo $writings_joins['userwcount'];?>
    											</li>
    											<li class="border-right">
    												<i class="fa fa-group"></i> <?php echo $writings_joins['usergcount'];?>
    											</li>
    											<li class="pull-right">
    												<?php if(isset($following) && in_array($comm_joinie->user_id, $following)) { ?>
                    								    <button class="btn btn-primary unfollow<?php echo $comm_joinie->user_id;?>" onclick="writerunfollow(<?php echo $comm_joinie->user_id;?>,'<?php echo $comm_joinie->username;?>')" style="margin-top: -7px;"> Following </button>
                    								<?php } else { ?>
                    								    <button class="btn btn-success follow<?php echo $comm_joinie->user_id;?>" onclick="writerfollow(<?php echo $comm_joinie->user_id;?>,'<?php echo $comm_joinie->username;?>')" style="margin-top: -7px;"> Follow </button>
                    								<?php } ?>
    											</li>
    										</ul>
    									</div>
    									<?php } ?>
    							    </div>
							    </div>
							</span>
						</div>
        		        <?php if(isset($following) && in_array($comm_joinie->user_id, $following)) { ?>
						    <button class="btn btn-primary pull-right unfollow<?php echo $comm_joinie->user_id;?>" onclick="writerunfollow(<?php echo $comm_joinie->user_id;?>,'<?php echo $comm_joinie->username;?>')"> Following </button>
						<?php } else { ?>
						    <button class="btn btn-success pull-right follow<?php echo $comm_joinie->user_id;?>" onclick="writerfollow(<?php echo $comm_joinie->user_id;?>,'<?php echo $comm_joinie->username;?>')"> Follow </button>
						<?php } ?>
        		    <?php echo "</div>"; } } ?>
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
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$('#previewurl, #urldescription').keyup(function() {
		var searchurl = $('#previewurl').val();
		var community_id = "<?php echo $this->uri->segment(3);?>";
		var urldescription = $('#urldescription').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>index.php/welcome/testing",
			data: {'searchurl': searchurl, 'community_id' : community_id, 'urldescription':urldescription},
			dataType: "json",
			success: function(data) {
				if(data == 'wrongurl'){
					$('#previewdiv').css('display','block');
					$('#preview').html('<center><div class="text-danger">You entered wrong URL.</div></center>');
				}else if(data.title) {
					$('#previewdiv').css('display','block');
					$('#preview').html('<div class="user-block">'+data.urldescription+'</div><div class="media"><div class="media-left"> <a href="'+data.titleurl+'" target="_blank"> <img src="'+data.image+'" class="media-object" style="height: 215px; width: 215px;"> </a> </div>	<div class="media-body"> <a href="'+data.titleurl+'" target="_blank"> <h4 class="media-heading">'+data.title+'</h4></a> <p>'+data.story+'</p> </div> </div>');
				} else{
					$('#previewdiv').css('display','block');
					$('#preview').html('<center><div class="text-danger">Something Wrong . Try Again.</div></center>');
				}
			}
		})
	});
</script> 
<script type="text/javascript">
    function likestory(id){ // like Story
    	var totallikes = $('#old_like'+id).text();
    	$.ajax({
    		url:'<?php echo base_url();?>index.php/welcome/comm_likes',
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
    		url:'<?php echo base_url();?>index.php/welcome/comm_likes',
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
        })
    }
    function tpostlikestory(id){ // like Story
    	var totallikes = $('#told_like'+id).text();
    	$.ajax({
    		url:'<?php echo base_url();?>index.php/welcome/comm_likes',
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
    		url:'<?php echo base_url();?>index.php/welcome/comm_likes',
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
    	$.ajax({
    		url:'<?php echo base_url();?>index.php/welcome/deletecomm_post',
    		method: 'POST',
    		data: {'comm_story_id':comm_story_id, 'posted_by':posted_by},
    		dataType:'json',
    		success:function(data){
    			if(data) {
    				$('#delcomm'+comm_story_id).css('display', 'none');
               }
            } 
        });
    }
    function editcomm_post(comm_story_id, posted_by){
        $('#editcomm_post').modal('show');
    	$.ajax({
    		url:'<?php echo base_url();?>index.php/welcome/editcomm_post',
    		method: 'POST',
    		data: {'comm_story_id':comm_story_id, 'posted_by':posted_by},
    		success:function(data){
    		    if(data) {
    			    $('#updatecomm_post').html(data);
                }
            }
        });
    }
    function reportcomm_post(comm_story_id, posted_by){
        $('#reportcomm_post').modal('show');
        $('#comm_story_id').val(comm_story_id);
        $('#posted_byid').val(posted_by);
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
	function comm_comments(story_id){ //Comments post submit
		var inputdata = $('#community_commentpost'+story_id+' :input').serialize();
		$.post("<?php echo base_url();?>index.php/welcome/communities_comments",inputdata,function(resultdata, status) {
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				alert('Please Enter Comments Message.');
			}else if(result.status == 1){
				$("#community_commentpost"+story_id).find('input[name="comment" ]').val('');
				$('.ajaxcomment'+story_id).css('display','block');
				$('.ajaxcomment'+story_id).html('<div class="box-comment"><img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image"><div class="comment-text"><span class="username">'+result.response.name+'<span class="text-muted pull-right">'+result.response.date+'</span></span>'+result.response.comment+'</div></div>');
			}else{
				alert('Failed to Post Comment.');
			}
		})
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
	function tpostscomm_comments(story_id){ //top posts Comments post submit
		var inputdata = $('#tpostscommunity_commentpost'+story_id+' :input').serialize();
		$.post("<?php echo base_url();?>index.php/welcome/communities_comments",inputdata,function(resultdata, status) {
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				alert('Please Enter Comments Message.');
			}else if(result.status == 1){
				$("#tpostscommunity_commentpost"+story_id).find('input[name="tcomment" ]').val('');
				$('.tajaxcomment'+story_id).css('display','block');
				$('.tajaxcomment'+story_id).html('<div class="box-comment"><img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image"><div class="comment-text"><span class="username">'+result.response.name+'<span class="text-muted pull-right">'+result.response.date+'</span></span>'+result.response.comment+'</div></div>');
			}else{
				alert('Failed to Post Comment.');
			}
		})
	}
</script>

<script>
function commujoin(comm_id, gener) { // community join button 
    $.ajax({
		type :'POST',
		url :'<?php echo base_url(); ?>index.php/welcome/communities_join',
		data :{'comm_id':comm_id, 'gener':gener},
		dataType :"json",
		success:function(data){
		    if(data == 1){
		        $('button.join'+comm_id).text('JOINED');
		        $('button.join'+comm_id).removeClass('btn-danger').addClass('btn-success');
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
		url :'<?php echo base_url(); ?>index.php/welcome/communities_join',
		data :{'comm_id':comm_id, 'gener':gener},
		dataType :"json",
		success:function(data){
		    if(data == 2){
		        $('button.unjoin'+comm_id).text('JOIN');
		        $('button.unjoin'+comm_id).removeClass('btn-success').addClass('btn-danger');
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
$(function () {
    $('span.loadmorespan').click(function () { var listid = $(this).attr('id'); //alert(listid);
        $('#myList'+listid+' div:hidden').slice(0,5).show();
        if ($('#myList'+listid+' div').length == $('#myList'+listid+' div:visible').length) {
            $('span#'+listid).hide();
        }
    });
});
</script>
<script>
$(function () {
    $('span.loadmorespantop').click(function () { var listid = $(this).attr('id');
        $('#myListtop'+listid+' div:hidden').slice(0,5).show();
        if ($('#myListtop'+listid+' div').length == $('#myListtop'+listid+' div:visible').length) {
            $('span.top'+listid).hide();
        }
    });
});
</script>
<script>
    $( "form#posturlform" ).submit(function( event ) { //post url form
        event.preventDefault();
        $.post("<?php echo base_url();?>index.php/welcome/communities_story",$("form#posturlform").serialize(),function(resultdata) {
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
        $.post("<?php echo base_url();?>index.php/welcome/communities_story",$("form#postquoteform").serialize(),function(resultdata) {
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
        $.post("<?php echo base_url();?>index.php/welcome/communities_story",$("form#posttextform").serialize(),function(resultdata) {
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
    $( "form#updatecomm_post" ).submit(function( event ) {
		event.preventDefault();
		var ptextid = $("form#updatecomm_post").serializeArray()[0].value;
		var ptext = $("form#updatecomm_post").serializeArray()[1].value;
		var pquotes = '';
		if($("form#updatecomm_post").serializeArray().length > 2) {
		    pquotes = $("form#updatecomm_post").serializeArray()[2].value;
		}
		$.post("<?php echo base_url();?>index.php/welcome/updatecomm_post",$("form#updatecomm_post").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
			    if(pquotes == 'quotes'){
			        $('.edittext'+ptextid).html('<b><q>'+ptext+'</q></b>');
			    }else{
    			    $('.edittext'+ptextid).text(ptext.substr(0, 100));
			    }
    			    $('#editcomm_post').modal('hide');
			}else{
			}
		});
	});
	$( "form#reportcommpost" ).submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>index.php/welcome/reportcomm_post",$("form#reportcommpost").serialize(),function(resultdata, status) {
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
</script>
<script>
    function postReplycomment(commentid, comm_id, story_id){
	    $('div.postreplycomment'+commentid).html('<input type="text" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Replay Comment..." required>'+
	    '<span class="text-danger addreplaycmt'+commentid+'"></span><span class="input-group-btn">'+
	    '<button type="submit" class="btn btn-success btn-flat" onclick="addreplycomment('+commentid+','+comm_id+','+story_id+')">POST</button></span>');
	}
	function addreplycomment(commentid, comm_id, story_id){
	    var comments = $('#replycmts'+commentid).val();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>index.php/welcome/communities_comments',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comm_id': comm_id, 'story_id': story_id,'comment':comments},
        		dataType: "json",
        		success:function(data){
        		    if(data == 2){
                        $('.addreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data == 1){
                        $.ajax({
                            url: "<?php echo base_url('index.php/welcome/communities_commentslast'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                var htmlcomment = '<li style="margin-bottom:10px;" class="commentdelete'+result.response[0].cid+'">'+
                                    '<div class="media"><div class="media-left"><img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px;height: 40px;">'+
                                    '</div> <div class="media-body" style="background-color:#ddd; border-radius:5px; padding: 0px 10px;">'+
                                    '<b>'+result.response[0].name+'</b>'+
                                    '<span class="pull-right" onClick="editcomment('+result.response[0].cid+');"><i class="fa fa-pencil"></i> Edit</span>'+
                                    '<span class="pull-right" onClick="deletecomment('+result.response[0].cid+');"><i class="fa fa-trash"></i> Delete</span>'+
                                    '<p class="pcomment'+result.response[0].cid+'">'+result.response[0].comment+'</p></div></div></li>';
                                    $('li.postreplycmt'+result.response[0].comment_id).prepend(htmlcomment);
                                }else{
                                    
                                }
                            }
                        })
                    }else{
                        $('.addreplaycmt'+commentid).text('Failed to Post your Comments.');
                    }
                }
            });
	    }else{
	        $('.addreplaycmt'+commentid).text('Enter your Comments.');
	    }
	}
</script>