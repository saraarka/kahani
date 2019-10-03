<style>
.book-type[data-v-2fbd156e] {
    font-size: 11px;
    line-height: 20px;
    font-weight: 700;
    color: #fff;
    padding: 0 20px 3px;
    background: #f39c12eb;
    position: absolute;
    top: 15px;
    left: -10px;
    z-index: 1;
    height: 21px;
}
.book-type[data-v-2fbd156e]:before {
    content: "";
    position: absolute;
    border-left: 0 solid transparent;
    border-right: 10px solid transparent;
    border-top: 21px solid #f2a123;
    bottom: -3px;
    left: 50%;
    margin-left: 0;
    left: 100%;
    padding-bottom: 3px;
}
.book-type[data-v-2fbd156e]:after {
    border-right: 10px solid #f2a123;
}
.book-type[data-v-2fbd156e]:after,  .book-type span[data-v-2fbd156e] {
    content: "";
    position: absolute;
    border-top: 0 solid transparent;
    border-bottom: 10px solid transparent;
    top: 100%;
    left: -10px;
    left: 0;
}
.dropdown-menu>li>a {
    display: block;
    padding: 3px 13px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}
.dropdown-menu>li>a:hover {
	color:#fff;
	background-color:#3c8dbc;
}
@media (max-width: 768px){
	.searchv{
		display:none;
	}
}
@media (min-width: 1020px){
	.sidebar-toggle{
		display:none
	}
	.vjhide{
		display:none
	}
}
.vjc1{
	background:#fff;
	box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);
}
ol, ul {
    margin-top: 0;
    margin-bottom: -2px;
}
.products-list>.item{padding:5px 0 0 0; background:#fff}

.content {
    padding: 16px;
}
.sticky {
    position: fixed;
    background-color: #23678e;
    top: 0;
    width: 100%;
    z-index:999;
}
.sticky + .content {
    padding-top:5px;
    z-index:999;
}
input[type=file] {
    display: none;
}
.scrollable-menu {
    height: auto;
    max-height: 350px;
    overflow-x: hidden;
}
.li-color>a:hover {
    background:#d4d4d4;
}
.text-right {
    text-align: center;
    font-size: 16px;
}
.scrollable-menu {
    height: 100vh;
    overflow-x: hidden;
    width:200px;
}
.resizable{
    font-size:15px;
}
.control-sidebar-menu>li>a {
    display: block;
    padding: 10px 15px;
}
.media {
    border: none;
}
.imageThumb {
  cursor: pointer;
  width: 320px;
  height:280px;
}
.pip {
  display: inline-block;
  border-radius: 5px
}
.remove {
  display: block;
  background: #f39c12;
  color: white;
  text-align: center;
  cursor: pointer;
  margin-top: 0px;
}
.remove:hover {
  background: #c73733;
  color: black;
}
.wv{
    width: 950px;
}
.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover{
    background-color:#23678e;
}
</style>
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<?php if(isset($_GET['add']) && ($_GET['add'] == 'yes')){ ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#divqa').css('display','block');
        	$('#storyview').css('display','none');
        });
    </script>
<?php } ?>
<div id="storyview" style="background: #fff !important;">	
	<div class="navbar navbar-inverse navbar-static-top" role="navigation" id="navbarv" style="background-color: #23678e;border-color: #23678e;">	
    	<div class="navbar-collapse">
    		<ul class="nav navbar-nav" style="display:inline-block;">
    		    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;background-color: #23678e;word-wrap:break-word;"><i class="fa fa-bars"></i> 
                        <?php $seriesftitles = ''; if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)){ 
    		            foreach($seriesftitle->result() as $seriesftitl){ echo $seriesftitles = $seriesftitl->title;} }else { echo 'EPISODES'; } ?>
                    </a>
                    <ul class="dropdown-menu scrollable-menu control-sidebar-menu pull-left" id="action" style="width:280px;height:285px;">
                        <h5 style="margin-top: 15px;margin-left: 30px;">
                            <a href="<?php echo base_url();?>index.php/welcome/new_series_admin?id=<?php echo $_GET['story_id'];?>&story_id=<?php echo $_GET['story_id'];?>">
                                <?php echo $seriesftitles; ?></a>
                        </h5>
                        <hr style="margin-top: 5px;margin-bottom: 5px; border-style: inset; border-width: 1px;">
                        <li class="divider"></li>
                        <?php $i=1; $j=0; foreach($new_episode as $row) { if($j==0) {$rowin='active';} 
    				    if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series")){ ?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="li-color" style="margin-left:4px;">
                            <a href="<?php echo base_url('index.php/welcome/new_series_admin?id='.$row->sid.'&story_id='.$row->story_id);?>">
        					    <span class="menu-icon bg-light-blue"><?php echo $i; ?> </span>
        					    <div class="menu-info">
        					        <h4 class="control-sidebar-subheading" style="overflow: hidden;white-space:pre;text-overflow: ellipsis;-webkit-appearance: none;"><?php echo ucfirst($row->title); ?></h4>
        					    </div>
        				        <small>&nbsp;&nbsp;&nbsp;<?php echo date("M j, Y", strtotime($row->date));?></small>
        					</a>
                        </li>
                        <?php $i++; } } ?>
                    </ul>
                </li>
            </ul>
    		<ul class="nav navbar-nav pull-right fv">
    		    <?php foreach($admin_story_view->result() as $row) {
    		        if(isset($lastepisode) && ($lastepisode->num_rows() > 0) && 
    		            isset($this->session->userdata['logged_in']['user_id']) && 
    		            ($this->session->userdata['logged_in']['user_id'] == $row->user_id)){  ?>
        			<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-edit"></i> Edit</a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="<?php echo base_url();?>index.php/welcome/series_edit/<?php echo $row->sid; ?>"><i class="fa fa-edit"></i>STORY EDIT</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>index.php/welcome/story_info/<?php echo $row->sid; ?>"><i class="fa fa-edit"></i>INFO EDIT</a>
                            </li>
                        </ul>
                    </li>
                    <?php } elseif(isset($this->session->userdata['logged_in']['user_id']) && 
                        ($this->session->userdata['logged_in']['user_id'] == $row->user_id)){  ?>
                    <li>
                        <button name="episode" id="viewqa" class="btn btn-warning" style="margin-top: 8px;background-color: #23678e;border-color: #3c8dbc;"><i class="fa fa-edit" ></i>Add Episode</button>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;"><i class="fa fa-edit"></i> Edit</a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="<?php echo base_url();?>index.php/welcome/series_edit/<?php echo $row->sid; ?>"><i class="fa fa-edit"></i>STORY EDIT</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>index.php/welcome/story_info/<?php echo $row->sid; ?>"><i class="fa fa-edit"></i>INFO EDIT</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                <?php } ?>
    		</ul>
    	</div>
    </div>
    <div class="" style="background:#fff!important; padding-bottom:100px;">
        <section class="content">
		    <div class="container">
		        <div class="row"> 
				<?php if(isset($new_series) && ($new_series->num_rows() > 0)){ foreach($new_series->result() as $row){ 
				    if(!isset($this->session->userdata['logged_in']['user_id']) || ($row->user_id != $this->session->userdata['logged_in']['user_id'])){
                        header('Location: '.base_url().'index.php/welcome/new_series?id='.$row->sid.'&story_id='.$row->story_id);
                    } ?>
        			<div class="col-md-3" style="margin-bottom:20px;">
        			    <div class="row">
            			    <div class="box box-widget widget-user vjbs">
    							<?php if(isset($row->cover_image) && ($row->cover_image)) { ?>
    							    <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image; ?>" alt="" class="img-responsive vjsvi1 img-bv" style="width:320px;height:280px;">
    						    <?php } else { ?>
    							    <img src="<?php echo base_url();?>assets/images/1.jpg" alt="" class="img-responsive vjsvi1 img-bv" style="width:320px;height:280px;">
                                <?php } ?>
        					</div>
        				</div><br>
        				<div class="row">
							<div class="box box-widget widget-user vjc1">
								<center>
									<?php if(isset($row->image) && ($row->image)) { ?>
									<div class="widget-user-header" style="padding:0px !important; height:auto;"> 
										<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" alt="User Avatar" class="img-responsive vjsvi" style="width: 190px;">
									</div>
									<?php } else { ?>
									<div class="widget-user-header" style="padding:0px !important; height:auto;"> 
										<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Avatar" class="img-responsive vjsvi" style="width: 190px;">
									</div>
									<?php } ?>
								</center>
								<div class="box-footer" style="padding-top:0">
									<div class="row">
										<div class="col-sm-12">
											<center><a href="#" style="color:#000"><h4 style="margin-top:10px"><b><?php echo $row->name; ?></b></h4></a></center>
										</div>
										<div class="col-sm-12">
											
										</div>
									</div>
								</div>
							</div>
						</div><br>
        			</div>
        			<?php $parablock1 = ''; $parablock2 = ''; $parablock3 = ''; $parablock1count = 0; $parablock2count = 0; ?>
        			<div class="col-md-8 pd-0">
        				<div class="box box-widget widget-user vjc1"><br>
        				    <center><h2><b><?php echo ucfirst($row->title); ?></b></h2></center><br>
        				    &nbsp; &nbsp; <span class="text-right">
                                    <span class="font-size-label" style="display: inline-block;">Font Size</span>
                                    <a id="up" style="width: 30px;height: 30px;">+</a>
                                    <span id="font-size" style="margin: 0 5px;width: 30px;height: 30px;"></span>
                                    <a id="down">-</a>
                                </span>
                                <ul class="list-inline" style="padding:20px 20px 0 20px; margin-bottom:2px Solid #999;">
            						<li><i class="fa fa-eye"></i> <?php echo $row->views;?></li>
            						<li>
                    					<?php if(isset($reviews) && !empty($reviews)) {
            								$starNumber = explode('.',$reviews[0]->rating);
            								for($x=1;$x<=$starNumber[0];$x++) { ?>
            									<span class="fa fa-star checked" style="color:#FFDF00;" title="<?php echo $x; ?>"></span>
            								<?php } if(isset($starNumber[1]) && !empty($starNumber[1])) { if ($starNumber[1] != 0) { ?>
            									<span class="fa fa-star-half-full checked" style="color:#FFDF00;" title="<?php echo $reviews[0]->rating; ?>"></span>
            								<?php $x++;} } 
            								$abcd = ''; if($starNumber[0] <= 0){ $abcd = 'style="color:#FFDF00;"';} 
            								while ($x<=5) { echo '<span class="fa fa-star checked" '.$abcd.'></span>';$x++;}
            							} ?>
            						</li>
            						<li class="pull-right">
            						    <i class="fa fa-heart" style="color: #337ab7;"></i>
            					        <span class="favcount"> <?php $favcount = 0; if(isset($_GET['id']) && !empty($_GET['id'])){
            					            $favocount = get_favcount($_GET['id']); if($favocount){ $favcount = $favocount; }
            					            } echo $favcount;?>
            				            </span>
            						</li>
            						<li class="pull-right">
            						    <a href="#commentv">
            							    <i class="fa fa-comment"></i>
            							    <?php if(isset($comment_like['commentcount'])){ echo $comment_like['commentcount']; } ?> 0
            							</a>
            						</li>
            						<?php if(($row->type == 'series') && ($row->sid == $row->story_id)){ 
            						    $seriesongo_stop = get_seriesongo_stop($row->story_id); if(isset($seriesongo_stop) && !empty($seriesongo_stop)) { ?>
            						    <li class="pull-right"><i class="fa fa-clock-o"></i> <span><?php echo $seriesongo_stop;?></span></li>
            						<?php } } else { ?>
            						<li class="pull-right"><i class="fa fa-clock-o"></i> <span id="time123"></span> నిమిషాల కథ</li>
            						<?php } ?>
            					</ul><hr>
        							<?php $paragraphs = explode(PHP_EOL, $row->story); 
            						    if(isset($paragraphs) && (count($paragraphs) > 0)){ foreach($paragraphs as $paragraph){
            						        $paracount = count(explode(' ',$paragraph));
            						        if( ($parablock1count >= 0) && ($parablock1count <= 500)) {
            						            $parablock1count = $parablock1count+$paracount;
            						            $parablock1 = $parablock1.'<p>'.$paragraph.'</p>';
            						        }elseif(($parablock1count > 500) && (($parablock2count >= 0) && ($parablock2count <= 500))){
            						            $parablock2count = $parablock2count+$paracount;
            						            $parablock2 = $parablock2.'<p>'.$paragraph.'</p>';
            						            //echo $parablock2;
            						        }elseif(($parablock1count > 500) && ($parablock2count > 500)){
            						            $parablock3 = $parablock3.'<p>'.$paragraph.'</p>';
            						        }
            						    }   } ?>
            						    
            						<div style="padding:20px;text-align: justify;word-wrap: break-word;" id="readTime" class="resizable noselect">
            							<?php if(isset($parablock1) && !empty($parablock1)){ echo $parablock1; } ?>
            						</div>
            					</div>
            					
    					<?php if(isset($parablock2) && !empty($parablock2)){ ?>
    					<br><div class="box box-widget widget-user vjc1">
    						    <div style="padding:20px;text-align: justify;word-wrap: break-word;" id="readTime" class="resizable noselect">
    							  <?php echo $parablock2; ?>
    							</div>
    					    </div>
    					<?php } if(isset($parablock3) && !empty($parablock3)){ ?>
    					<br><div class="box box-widget widget-user vjc1">
    						    <div style="padding:20px;text-align: justify;word-wrap: break-word;" id="readTime" class="resizable noselect">
    							  <?php echo $parablock3; ?>
    							</div>
    					    </div>
    					<?php } ?>
            					
    					<div class="box-footer" style="padding-top:10px;border: 1px solid #d1d1d1;">
    					    <div class="row">
    						    <div class="col-md-4">
        						    <?php if(isset($favorites) && in_array($_GET['id'], $favorites)){ ?>
            						    <span>
            						        Favorite <i class="fa fa-2x fa-heart favbtn" style="color:#ff0000;"></i> </span>
        						    <?php } else{ ?>
        						        <span>
        						            Favorite <i class="fa fa-2x fa-heart-o favbtn" style="color:#333;"></i> </span>
        						    <?php } ?>
    						    </div>
    						    <div class="col-md-4"></div>
    						    <div class="col-md-4 text-right"> Rating :
        							<span class="rating" style="text-align:left;">
        							    <input id="star5" type="radio" value="5" class="radio-btn hide" />
        								<label for="star5" style="font-size:20px;">☆</label>
        								<input id="star4" type="radio" value="4" class="radio-btn hide" />
        								<label for="star4" style="font-size:20px;">☆</label>
        								<input id="star3" type="radio" value="3" class="radio-btn hide" />
        								<label for="star3" style="font-size:20px;">☆</label>
        								<input id="star2" type="radio" value="2" class="radio-btn hide" />
        								<label for="star2" style="font-size:20px;">☆</label>
        								<input id="star1" type="radio" value="1" class="radio-btn hide" />
        								<label for="star1" style="font-size:20px;">☆</label>
        							</span>
    						    </div>
    						    <div class="col-md-8 favoritemsg text-danger"></div><div class="col-md-4"></div>
    						</div>
    					</div>
    					<div class="row">
    					    <div class="col-md-3 col-xs-6" style="margin-top:8px;">
    				            <button class="btn btn-success" id="opens">SEE ALL EPISODES</button>
    				        </div>
    				        <div class="col-md-6 hidden-xs"></div>
    				        <div class="col-md-3 col-xs-6" style="margin-top:8px;">
    				            <center>
    				        		<?php if(isset($nextepisode)){ foreach($nextepisode as $row) { if($_GET['id'] === $_GET['story_id']){ ?>
    				        		    <a href="<?php echo base_url('index.php/Welcome/new_series?id='.$row->sid.'&story_id='.$_GET['story_id']);?>" class="pull-right">
    				        			<button class="btn btn-success"> Start Reading >></button></a>
    				        		<?php } else { ?>
    				        			<a href="<?php echo base_url('index.php/Welcome/new_series?id='.$row->sid.'&story_id='.$_GET['story_id']);?>" class="pull-right">
    				        			<button class="btn btn-success"> Next Episode >></button></a>
    				        	    <?php } } } ?>
    				        	</center>
    				        </div>
    				    </div>
    				    <div class="clearfix"></div> <br>
    				    
    				    <div class="wv">
							<?php if(isset($recentseries) && ($recentseries->num_rows() > 0)){ ?>
								<div class="box-header with-border">
									<h3 class="box-title">Related Series</h3>
								</div>
								<br>
							<?php foreach ($recentseries->result() as $recentstory) { ?>
							<div class="col-md-3 item1 mvj jQueryEqualHeight3">
								<div class="card box box-widget widget-user" style="box-shadow: 1px 1px 1px rgba(0,0,0,0.1);">
									<a href="<?php echo base_url('index.php/welcome/new_series?id='.$recentstory->sid.'&story_id='.$recentstory->story_id);?>">
                					    <?php $bgimage = base_url().'assets/dist/img/photo1.png';
                					        if(isset($recentstory->cover_image) && !empty($recentstory->cover_image)) {
                					            $bgimage = base_url().'assets/images/'.$recentstory->cover_image;
                					        } ?>
                						<div class="card-img-top widget-user-header bg-black" style="background: url('<?php echo $bgimage;?>') center center;">
                							<div data-v-2fbd156e="" class="book-type STORY">
                								<?php echo $recentstory->gener;?>
                								<span data-v-2fbd156e=""></span>
                							</div>
                						</div>
                					</a>
									<div class="card-body box-footer" style="padding-top:0px;">
                						<div class="row">
                							<div class="col-sm-12">
                								<ul class="products-list product-list-in-box">
                									<li class="item">
                										<div class="card-title" style="word-wrap:break-word;">
                											<a href="<?php echo base_url('index.php/welcome/new_series?id='.$recentstory->sid.'&story_id='.$recentstory->story_id);?>" class="product-title" style="word-wrap:break-word;">
                											    <?php echo substr($recentstory->title,0,40);?></a>
                										</div>	
                										<div class="card-text product-description">
                										    By <a href="<?php echo base_url('index.php/welcome/profile?id='.$recentstory->id);?>">
                										        <span style="color:black"><b><?php echo ucfirst($recentstory->name);?></b></span>
                										      </a>
                										</div>
                									</li>
                								</ul>
                							</div>
                						</div>
										<!--/.row -->
										<div class="row">
                							<div class="col-md-12">
                								<ul class="list-inline">
                									<li class="text-muted border-right">
                										<?php $keycount = get_episodecount($recentstory->sid); 
                            							    if(isset($keycount)){ echo $keycount; }else{ echo 0; } ?> Episodes
                									</li>
                									<li class="text-muted">
                										<?php $subsmemcount = get_storysubscount($recentstory->sid); 
                                    					    if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> Members
                									</li>
                								</ul>
                							</div>
                						</div>
										<!-- /.row -->
										<div class="row">
											<div class="col-md-12" style="padding-top:10px;">
												<ul class="list-inline">
                									<li>
                										<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($recentstory->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                						                    <a class="btn btn-default">
                						                        <button style="background:none; border:none;" onclick='alert("you can not read later the Story.");'>
                										        <i class="fa fa-bookmark"></i> Read later </button></a>
                						                <?php }else{ ?>
                									        <?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($recentstory->sid, $readlatersids)) { ?>
                											<a class="btn btn-primary readlaterbtn<?php echo $recentstory->sid;?>">
                											    <button style="background:none; border:none;" onclick="unreadlater(<?php echo $recentstory->sid;?>)" class="notloginmodal readlaterbtnatr<?php echo $recentstory->sid;?>">
                									            <i class="fa fa-check faicon<?php echo $recentstory->sid;?>"></i> Read later </button></a>
                										    <?php }else { ?>
                									        <a class="btn btn-default readlaterbtn<?php echo $recentstory->sid;?>">
                										        <button style="background:none; border:none;" onclick="readlater(<?php echo $recentstory->sid;?>)" class="notloginmodal readlaterbtnatr<?php echo $recentstory->sid;?>">
                								                <i class="fa fa-bookmark faicon<?php echo $recentstory->sid;?>"></i> Read later </button></a>
                									       <?php } ?>
                    					                <?php } ?>
                									</li>
                									<li class="pull-right">
                										<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                										    <span class=""><i class="fa fa-plus"></i></span>
                										</button>
                										<ul class="dropdown-menu list-inline">
                											<li onclick="groupsuggest(<?php echo $recentstory->sid; ?>);">
                												<a data-toggle="modal" data-target="#groupsuggest" style="padding: 3px 17px;"><i class="fa fa-users"></i></a>
                											</li>
                											<li onclick="friend(<?php echo $recentstory->sid;?>);">
                												<a data-toggle="modal" data-target="#friendsuggest" style="padding: 3px 17px;"><i class="fa fa-user"></i></a>
                											</li>
                											<li>
                												<a data-toggle="modal" data-target="#soc" style="padding: 3px 17px;">
                													<i class="fa fa-share-alt"></i>
                												</a>
                											</li>
                										</ul>
                									</li>
                								</ul>
											</div>
										</div>
									</div>
								</div>
							<br><br>
							</div>
							<?php } } ?>
						</div>
    				</div>
            		<div class="clearfix"></div>
        		<?php } } ?><br>
        		
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-8">
							<div class="vjbs" id="commentv" style="padding:10px;">
								<span><h4><b>Comments Here</b></h4></span>
								<div class="box-footer box-comments">
									<div class="box-comment">
										<form id="commentsend" method="POST">      
											<div class="input-group">
												<input type="text" id="comment" name="comment" placeholder="Press enter to post comment ..." class="form-control required">
												<input type="text" id="comments" name="comment" placeholder="Press enter to post comment ..." class="form-control required" style="display:none;">
												<span class="p_usernamev text-danger"></span>
												<input type="hidden" id="storyid" name="id" value="<?php  echo $_GET['id']; ?>">
												<span class="input-group-btn">
													<input type="submit" class="btn btn-success btn-flat" value="POST">
												</span>
											</div>
										</form><br>
										<div class="input-group">
											Switch to English: &nbsp; <label class="switch">  
												<input type="checkbox" onclick="langchang(this.value)" value="off" id="langchang"> <span class="slider"> </span> 
											</label> &nbsp; <span class="langchang"> Off </span>
										</div><br>
									</div>
									<!-- /.box-comment -->
									<div id="test_comment">
										<ul style="list-style: none; padding:0px;">
											<li id="postcmt"> </li>
											<?php if(isset($comment_get) && ($comment_get->num_rows() >0)) { foreach($comment_get->result() as $comment){ ?>
												<li style="margin-bottom:15px;" class="commentdelete<?php echo $comment->cid;?>">
													<div class="media">
														<div class="media-left">
															<?php if(!empty($comment->profile_image)){ ?>
																<img src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" style="border-radius: 50%;width:50px;height:50px;">
															<?php } else{ ?>
																<img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:50px;height:50px;">
															<?php } ?>
														</div>
														<div class="media-body">
															<b><?php echo ucfirst($comment->name); ?></b> &nbsp; &nbsp; <small> <?php echo date("M j, Y g:i A", strtotime($comment->date));?></small>
															<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $comment->user_id)){ ?>
															<span class="pull-right" onClick="editcomment(<?php echo $comment->cid;?>);"><i class="fa fa-pencil"></i> Edit</span>
															<span class="pull-right" onClick="deletecomment(<?php echo $comment->cid;?>);"><i class="fa fa-trash"></i> Delete</span>
															<?php }else{ ?>
															<span class="pull-right" onClick="reportcomment(<?php echo $comment->cid;?>, <?php echo $comment->user_id;?>, <?php echo $comment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> Report Spam</span>
															<?php } ?>
															<p class="pcomment<?php echo $comment->cid;?>"><?php echo $comment->comment; ?></p>
															<a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->cid;?>, <?php echo $comment->story_id;?>)" style="color:#de1800;"> REPLY </a>
															<div class="input-group postreplycomment<?php echo $comment->cid;?>"></div>
															<?php $replaycomments = get_replaycomments($comment->story_id, $comment->cid); ?>
															<?php if(isset($replaycomments) && ($replaycomments->num_rows() > 0 )){ ?>
															<ul style="list-style: none; padding:0px; margin-top:15px;">
																<li class="postreplycmt<?php echo $comment->cid;?>"></li>
																<?php foreach($replaycomments->result() as $replaycomment){ ?>
																	<li style="margin-bottom:15px;" class="commentdelete<?php echo $replaycomment->cid;?>">
																		<div class="media">
																			<div class="media-left">
																				<?php if(!empty($replaycomment->profile_image)){ ?>
																					<img src="<?php echo base_url();?>assets/images/<?php echo $replaycomment->profile_image;?>" style="border-radius: 50%;width:40px;height:40px;">
																				<?php } else{ ?>
																					<img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px;height:40px;">
																				<?php } ?>
																			</div>
																			<div class="media-body" style="background-color:#ddd; border-radius:5px; padding: 0px 10px;">
																				<b><?php echo ucfirst($replaycomment->name); ?></b> &nbsp; &nbsp; <small> <?php echo date("M j, Y g:i A", strtotime($replaycomment->date));?></small>
																				<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $replaycomment->user_id)){ ?>
																				<span class="pull-right" onClick="editcomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-pencil"></i> Edit</span>
																				<span class="pull-right" onClick="deletecomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-trash"></i> Delete</span>
																				<?php }else{ ?>
																				<span class="pull-right" onClick="reportcomment(<?php echo $replaycomment->cid;?>, <?php echo $replaycomment->user_id;?>, <?php echo $replaycomment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> Report Spam</span>
																				<?php } ?>
																				<p class="pcomment<?php echo $replaycomment->cid;?>"><?php echo $replaycomment->comment; ?></p>
																			</div>
																		</div>
																	</li>
																<?php } ?>
															</ul>
															<?php } else{ ?>
																<ul style="list-style: none; padding:0px; margin-top:15px;">
																	<li class="postreplycmt<?php echo $comment->cid;?>"></li>
																</ul>
															<?php } ?>
														</div>
													</div>
												</li> 
											<?php } } ?>
										</ul>		
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	        </div>
		</section>
    </div>
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('button#viewqa').click(function(){
			$('#divqa').css('display','block');
			$('#storyview').css('display','none');
		})
	});
</script>
<div id="divqa" style="display: none;">
    <div class="navbar navbar-inverse navbar-static-top" role="navigation" id="navbarv">	
    	<div class="navbar-collapse" style="background-color: #23678e;">
    		<ul class="nav navbar-nav" style="display: inline-block;">
    		    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;color:#fff;"><i class="fa fa-bars"></i> 
                        <?php $seriesftitles = ''; if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)){ 
    		            foreach($seriesftitle->result() as $seriesftitl){ echo $seriesftitles = $seriesftitl->title;} }else{ echo 'EPISODES';} ?>
                    </a>
                    <ul class="dropdown-menu scrollable-menu control-sidebar-menu pull-left" id="action" style="width:280px;height:285px;">
                        <h5 style="margin-top: 15px;margin-left: 30px;">
                            <a href="<?php echo base_url();?>index.php/welcome/new_series_admin?id=<?php echo $_GET['story_id'];?>&story_id=<?php echo $_GET['story_id'];?>">
                                <?php echo $seriesftitles; ?></a>
                        </h5>
                        <hr style="margin-top: 5px;margin-bottom: 5px; border-style: inset; border-width: 1px;">
                        <li class="divider"></li>
                        <?php $i=1; $j=0; foreach($new_episode as $row) { if($j==0) {$rowin='active';} 
    				    if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series")){ ?>
							<li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="li-color" style="margin-left:4px;">
								<a href="<?php echo base_url('index.php/welcome/new_series_admin?id='.$row->sid.'&story_id='.$row->story_id);?>">
									<span class="menu-icon bg-light-blue">
									   <?php echo $i; ?> </span>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading"><?php echo ucfirst($row->title); ?></h4>
									</div>
									<small>&nbsp;&nbsp;&nbsp;<?php echo date("M j, Y", strtotime($row->date));?></small>
								</a>
							</li>
                        <?php $i++; } } ?>
                    </ul>
                </li>
            </ul>
    		<ul class="nav navbar-nav pull-right fv">
    		    <li style="margin:8px;"><button name="episode" class='btn btn-warning' onclick="addepisode()" style="background-color: #23678e;border-color: #3c8dbc;"><i class="fa fa-edit"></i> Add Episode</button><li>
                <li style="margin:8px;"><button class="btn btn-primary" type="submit" onclick="submit()" style="color:#FFF; border: none;"> PUBLISH </button><li>
                <li style="margin:8px;"><button class="btn btn-primary" onclick="addtodrafts()" style="color:#FFF; border: none;"> Save to Draft </button><li>
    		</ul>
    	</div>
    </div>
    <form action="<?php echo base_url();?>index.php/welcome/addepisode" method="POST" enctype="multipart/form-data" id="display_result">
		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<label class="btn-default" style="background:none; width: 320px;" for="upload-file-selector">
							<div class="box box-widget widget-user" style="height: 280px; width:320px;">
								<input type="file" name="cover_image" id="upload-file-selector" required="" style="display:none;">
								<span class="upload-file-selector"><center style="padding-top:115px;">
								<img src="<?php echo base_url() ?>assets/images/flat.png" style="cursor:grab!important;"/> </center></span>
								<div class="box-footer" style="padding-top:92px;border:none!important;font-weight: 200;">
									<center>
										<p class="text-muted" style="margin:0">Must be in JPG or PNG format, smaller than 2MB. 
									</center>
								</div>
							</div>
							<span class="text-danger imageerror"></span>
						</label>
					</div>
					<div class="col-md-8" style="padding-left:55px;">
						<div class="box box-widget widget-user vjc1 seriesaddtodrafts"><br>
							<div class="box-body">
								<center>
									<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
									<h2><b><input type="text" id="title" name="title" onclick="addseriesepisode(<?php echo $_GET['id'];?>)" placeholder="Enter Episode Title" required="" class="form-control draftsave" style="border:none;text-align:center;font-size: 30px;padding: 30px 0px;" value="<?php echo set_value('title');?>"></b></h2>
									<span class="text-danger"><?php echo form_error('title');?></span>
								</center>
							</div>	
							<div class="box-body">
								<textarea name="story" id="story" onclick="addseriesepisode(<?php echo $_GET['id'];?>)" rows="18" class="form-control draftsave" placeholder="Enter Series Story Here...." required style="resize:none;"></textarea>
								<input type="hidden" name="series_id" value="<?php echo $_GET['story_id']; ?>">
								<input type="hidden" name="genre" value="<?php echo $row->genre; ?>">
								<input type="hidden" name="copyrights" value="<?php echo $row->copyrights; ?>">
								<input type="hidden" name="language" value="<?php echo $row->language; ?>">
								<input type="hidden" name="type" value="<?php echo $row->type; ?>">
								<input type="hidden" id="draft" name="draft" value="draft">
								<input type="hidden" id="sid" name="sid" value="">
								<input type="hidden" name="lastepisode" id="lastepisode" value="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</form>
</div>
<div id="checkepisode" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <center><h4> Are you Sure! Is It Your Last Episode ? </h4>
                <button class="btn btn-warning" onclick="yesno('no')"> No </button>
                <button class="btn btn-default" onclick="yesno('yes')"> Yes </button>
            </center>
          </div>
        </div>
    </div>
</div>
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
        var ids = [ "story","title","comment" ];
        transliterationControl.makeTransliteratable(ids);
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
            google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE,
            serverReachableHandler);
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- group suggest popup code ---- -->
<div class="modal" id="groupsuggest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code ----------- -->
<!-- frind popup code ------>
<div class="modal" id="friendsuggest" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttofriend"></div>
		</div>
	</div>
</div>
<!--frind popup end ------------->

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
$(document).ready(function() {
    upLoader();
});
function upLoader(){
    if (window.File && window.FileList && window.FileReader) {
        $("#upload-file-selector").on("change", function(e) {
           var sid = $('#sid').val();
           var storyid = "<?php $_GET['id'];?>";
           var data = new FormData();
            data.append('cover_image', this.files[0]); 
            data.append('seimage_sid', sid); 
            $.ajax({
                method: 'POST',
                address: '<?php echo base_url();?>index.php/welcome/addepisodeimage',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if((response != 0) && ($.isNumeric(response))){
                        $('#sid').val(response);
                    }
                },
            });
            var files = e.target.files,
            filesLength = files.length;
	        for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                if((f.size) > 2000000) {
                    $('.imageerror').html('<center>Upload File Size Should be lessthan 2MB.</center>');
                    $("#upload-file-selector").val('');
                }else{
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $('.upload-file-selector').html("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<span class=\"remove\">Remove </span>" +
                        "</span>");
                        $('.box-footer').css('display','none');
                        $(".remove").click(function(){
                            $(this).parent(".pip").remove();
                            $('.upload-file-selector').html('<center style="padding-top:115px;"><img src="<?php echo base_url() ?>assets/images/flat.png" style="cursor:grab!important;"/> </center>'+
    						    '<div class="box-footer" style="padding-top:92px;border:none!important;font-weight: 200;">'+
							    '<center><p class="text-muted" style="margin:0">Must be in JPG or PNG format, smaller than 2MB. </center></div>');
                        });  
                    });
                    fileReader.readAsDataURL(f);
                }
	        }
	    });
    } 
    else {
        alert("Your browser doesn't support to File API")
    }
}
</script>
<script type="text/javascript">
function applyads(){
    var id = $('#ads_id').val();
    $.ajax({
    	type : 'POST',
    	url :'<?php echo base_url(); ?>index.php/welcome/applyads',
    	data :{'id':id},
    	dataType :"json",
    	success:function(data){
    		if(data.result === 'success'){
    			alert('Request Send Successfully');
    		} else {
    			alert('You already Send Request');
    		}
    		
		}
	})
}
</script> 
<script>
function addseriesepisode(seriesid){
    var sid = $('#sid').val();
    if(sid == '' || sid == ' ' || sid == 'null'){
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/addseriesepisode/"+seriesid,
			success:function(data){
			    if(data != 0){
			        $('#sid').val(data);
			        $("#story").prop('onclick', null);
			        $("#title").prop('onclick', null);
			    }
			}
		});
    }
};
$(document).ready( function() {
    $('.draftsave').bind('keyup', function(e) {
        var inputdata = $('.seriesaddtodrafts').find('textarea, input').serialize();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/seriesaddtodrafts",
            data: inputdata,
			success:function(data){
			    console.log(data);
			}
		})
    });
});
function addtodrafts(){
    var inputdata = $('.seriesaddtodrafts').find('textarea, input').serialize();
    $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/welcome/seriesaddtodrafts",
        data: inputdata,
		success:function(data){
		    console.log(data);
            location.href = "<?php echo base_url();?>index.php/welcome/new_series_admin?id=<?php echo $_GET['id'];?>&story_id=<?php echo $_GET['id'];?>";
		}
	});
}
function addepisode(){
    var inputdata = $('.seriesaddtodrafts').find('textarea, input').serialize();
    $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/welcome/seriesaddtodrafts",
        data: inputdata,
		success:function(data){
		    console.log(data);
            location.href = "<?php echo base_url();?>index.php/welcome/new_series_admin?id=<?php echo $_GET['id'];?>&story_id=<?php echo $_GET['id'];?>&add=yes";
		}
	});
}
function submit(){
    $('#checkepisode').modal('show');
}
function yesno(value){
    if(value == 'yes'){
        $('#lastepisode').val('yes');
        $('#draft').val(' '); 
        setTimeout($("#display_result").submit(),2000);
        //$("#display_result").submit();
    }else{
        $("#display_result").submit();
    }
}
</script>
<script type="text/javascript">
$( "form#commentsend" ).submit(function( event ) {
	event.preventDefault();
	$('#comment').empty();
	$('#comments').empty();
    var comment = $('#comment').val();
    if((comment == '') || (comment == 'undefined')){
        comment = $('#comments').val();
    }
    var storyid = $('#storyid').val();
	$.post("<?php echo base_url(); ?>index.php/Welcome/comment",{'comment':comment,'storyid':storyid},function(output,status){
		$("li#postcmt").prepend(output);
		$("#comment").val('');
		$("#comments").val('');
	});
});
</script>
<script>
function langchang(abcdlang) {
    $('#comment').val('');
	$('#comments').val('');
    if(abcdlang == 'off'){
        $('#comment').css('display','none');
        $('#comments').css('display','block');
        $('#langchang').val('on');
        $('span.langchang').text('On');
    }else{
        $('#comment').css('display','block');
        $('#comments').css('display','none');
        $('#langchang').val('off');
        $('span.langchang').text('Off');
    }
}
</script>
<script>
$(document).ready(function(){
    var resize = new Array('p','.resizable');
    resize = resize.join(',');
    //resets the font size when "reset" is clicked
    var resetFont = $(resize).css('font-size');
    $(".reset").click(function(){
        $(resize).css('font-size', resetFont);
    });
    //increases font size when "+" is clicked
    $(".increase").click(function(){
        var originalFontSize = $(resize).css('font-size');
        var originalFontNumber = parseFloat(originalFontSize, 10);
        var newFontSize = originalFontNumber*1.2;
        $(resize).css('font-size', newFontSize);
        return false;
    });
    //decrease font size when "-" is clicked
    $(".decrease").click(function(){
        var originalFontSize = $(resize).css('font-size');
        var originalFontNumber = parseFloat(originalFontSize, 10);
        var newFontSize = originalFontNumber*0.8;
        $(resize).css('font-size', newFontSize);
        return false;
    });
});
</script>
<script>
function getSize() {
    size = $(".resizable").css("font-size");
    size = parseInt(size, 10);
    $( "#font-size" ).text(  size  );
}
//get inital font size
getSize();
$( "#up" ).on( "click", function() {
  // parse font size, if less than 50 increase font size
    if ((size + 2) <= 50) {
        $( ".resizable" ).css( "font-size", "+=2" );
        $( "#font-size" ).text(  size += 2 );
    }
});
$( "#down" ).on( "click", function() {
    if ((size - 2) >= 12) {
        $( ".resizable" ).css( "font-size", "-=2" );
        $( "#font-size" ).text(  size -= 2  );
    }
});
</script>
<script type="text/javascript">
   var totalWords = document.getElementById("readTime").innerHTML;
   var words= totalWords.split(/\s/g).length;
   var timeToRead = words / 70;
   //alert(words);
   var timeInt = Math.round(timeToRead);
   document.getElementById("time123").innerHTML = timeInt;
</script>

<script>//dropdown opens on all episodes
$('document').ready(function() {
    $("#opens").on("click", function() {
        $("#action").toggle();
    });
})
</script>
<script>
    window.onscroll = function() {myFunction()};
    var navbarv = document.getElementById("navbarv");
    var sticky = navbarv.offsetTop;
    function myFunction() {
        if (window.pageYOffset > sticky) {
            navbarv.classList.add("sticky")
        } else {
            navbarv.classList.remove("sticky");
        }
    }
</script>


<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 45px;
      height: 20px;
    }
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      border-radius: 34px;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 0px;
      bottom: 0px;
      background-color: white;
      border-radius: 50%;
      -webkit-transition: .4s;
      transition: .4s;
    }
    input:checked + .slider {
      background-color: #2196F3;
    }
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
</style>