<link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin_story.css">
<style>
    span.fa.fa-star-o.checked {
        padding-right: 5px;
    }
    @media screen and (max-width:750px){
        .box.box-widget.widget-user.boxshv.boxshv1 p img{
            width:100%;
            text-align:center;
        }
    }
    .box.box-widget.widget-user.boxshv.boxshv1 p img{
        margin: 10px auto;
        display:block;
        max-width:100%;
    }
	/* reading mode css */
    .whitebody{
        background: #FFF !important;
        color:black;
    }
    .blackbody{
        background: #000 !important;
        color:white;
    }
    #reading-modebut{
        cursor: pointer;
        border: 1px solid #ddd;
        background: #eeeeee;
        color: black;
        box-shadow: 1px 1px 0px 0px #00000059;
        font-size: 0.9em;
        padding: 9px;
        letter-spacing: 0.04em;
        border-radius: 3px;
    }
    #reading-modebut:hover{
        background: #ddd;
    }
    .reading-mode-bg {
        display: none;
        font-family: 'Verdana', 'Geneva', sans-serif; 
        padding: 20px 0 20px 0;
    }
    .reading-mode-header{
        position: fixed;
        height: 62px;
        left: 0;
        right: 0;
        background: white;
        top: 0;
        box-shadow: 0 3px 2px -2px rgba(200,200,200,0.2);
        border-bottom: 1px solid #ddd;
    }
    .reading-mode-header-inner{
        width: 1000px;
        max-width: 90%;
        margin: 0 auto;
        color: #000;
    }
    .reading-mode-header-inner button{
        border: 1px solid #ddd;
        font-size: 1em;
        padding: 10px;
        min-width:30px;
        margin-top: 10px;
        outline: none;
        cursor: pointer;
        background: #eeeeee;
        border-radius: 3px;
    }

    .reading-mode-header-innerbody{
        width: 1000px;
        max-width: 90%;
        margin: 0 auto;
    }

    .read-settings{
        float: right;
    }
    .night-mode{
        margin-left: 25px;
    }
    .font-minus, .font-plus{
        margin: 8px;
    }
    .font-num{
        color: black;
    }
    .read-modestory p{
        font-family: 'Verdana', 'Geneva', sans-serif; 
        line-height: 2em;
        letter-spacing: .03em;
        font-size: 16px;
    }
    .read-modestory p img{
        margin: 10px auto;
        display:block;
        max-width:100%;
    }
    @media screen and (max-width:500px){
        .night-modetext{
            display: none;
        }
        .night-mode{
            margin-left: 18px;
        }
    }
    /* reading mode css */
</style>

<?php if(isset($admin_story_view) && ($admin_story_view->num_rows() == 1)){ foreach($admin_story_view->result() as $row) {
    if(!isset($this->session->userdata['logged_in']['user_id']) || ($row->user_id != $this->session->userdata['logged_in']['user_id'])){
        header('Location: '.base_url().'story/'.preg_replace("~[^\p{M}\w]+~u", '-', $row->title).'-'.$row->sid);
    }
?>
<div class="navbar navbar-inverse navbar-static-top" id="navbarv" style="background-color:#23678e;">	
	<div class="navbar-collapse pd-4">
    	<ul class="nav navbar-nav pull-right" style="display: inline-flex;">
			<li class="dropdown write-d">
                <a class="dropdown-toggle" data-toggle="dropdown" style="cursor:pointer;"><i class="fa fa-edit"></i> EDIT </a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="<?php echo base_url();?>admin_story_view/<?php echo $row->sid;?>"><i class="fa fa-edit pr-10"></i>STORY EDIT </a></li>
                    <li><a href="<?php echo base_url();?>story_info/<?php echo $row->sid;?>"><i class="fa fa-edit pr-10"></i>INFO EDIT </a></li>
               </ul>
            </li>
            <li class="dropdown write-m">
                <a onclick="mobilestoryedit(<?php echo $row->sid; ?>)" data-toggle="modal" data-target="#writeapp" id="notloginmodal"><i class="fa fa-edit"></i> EDIT </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                <ul class="dropdown-menu pull-right"  style="right:10px;">
                    <li onclick="groupsuggest(<?php echo $row->sid;?>);">
						<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users pr-10"></i>COMMUNITY</a>
					</li>
					<li onclick="friend(<?php echo $row->sid;?>);">
						<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user pr-10"></i>SUGGEST</a>
					</li>
					<li onclick="socialshare(<?php echo $row->sid;?>, 'story');">
						<a href="javascript:void(0);" data-toggle="modal" data-target="#soc" title="SOCIAL"><i class="fa fa-share-alt pr-10"></i>SOCIAL</a>
					</li>
                </ul>
            </li>
		</ul>
	</div>
</div>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="tops" style="justify-content:center;">
    <div  style="margin:0 auto;">
	    <div class="main-container">
			<div class="" style="display:flex; flex-wrap:wrap;">
			<?php $cmttype = ''; $storyid = 0;
                foreach($admin_story_view->result() as $row) { 
                    $storyid = $row->sid; $cmttype =  $row->type; ?>
				<div class="sidebox-i-c" style="margin-bottom:20px;">
				    <div class="row pt-0">
					    <?php $image='reading.jpg'; if(isset($row->cover_image) && !empty($row->cover_image)) { $image=$row->cover_image;} ?>
						<div class="vjbs"style="background: url(<?php echo base_url();?>assets/images/<?php echo $image; ?>) no-repeat;background-size: 100% 100%;">
						    <div style="background:rgba(0, 0, 0, 0.8);">
            			        <center>
									<img src="<?php echo base_url();?>assets/images/<?php echo $image; ?>" alt="<?php echo $row->title; ?>" class="img-responsive vjsvi1 img-bv imgs">
								</center>
						    </div>
						</div>
					</div> <br>
					<div class="row pt-0">
						<div class="box box-widget widget-user boxshv boxshv1 profile-img" style="border-radius:5px;">
						    <center>
                                <div class="widget-user-header" style="height:auto;">
                                    <?php if(isset($row->writing_style) && ($row->writing_style == 'anonymous') && ($row->type == 'life')) { ?>
                                        <img src="<?php echo base_url();?>assets/images/anonymous.png" alt="Anonymous" class="img-responsive vjsvi img-circle" style="width:100px;height:90px;">
                                    <?php } else if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                        <img src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image;?>" alt="<?php echo $row->name;?>" class="img-responsive vjsvi img-circle" style="width:100px;height:90px;">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $row->name; ?>" class="img-responsive vjsvi img-circle" style="width:100px;height:90px;">
                                    <?php } ?>
                                </div>
							</center>
							<div class="box-footer" style="padding-top:0; border-top:1px solid #cac8c885;border-radius:5px;">
								<div class="row pt-0">
									<center>
										<div class="col-sm-12">
											<?php if(($row->writing_style == 'anonymous') && ($row->type == 'life')){ ?>
											    <a href="javascript:void(0);" style="color:#000"><h4><b>Anonymous</b></h4></a>
											<?php } else { ?>
											    <a href="<?php echo base_url().$row->profile_name; ?>" style="color:#000"><h4><b><?php echo $row->name; ?></b></h4></a>
											<?php } ?>
										</div>
									</center>
									<div class="col-sm-12"></div>
								</div>
							</div>
						</div>
						<div class="box box-widget widget-user boxshv boxshv1 profile-imgm">
							<div class="box-footer" style="padding-top:0; border-top:1px solid #cac8c885;">
								<div class="row pt-0">
								    <div style="padding-top:10px;">
    									<span class="" style="float:left">
    										<a href="<?php echo base_url().$row->profile_name;?>" style="color:#000"><h4 style="margin-top:10px"><b> <?php echo $row->name; ?></b></h4></a>
    									</span>
    									<span style="float:right">
    										<?php if(isset($following) && in_array($row->user_id, $following)) { ?>
    											<button style="padding-left:15px; padding-right:15px; margin-top: 2px;" class="btn btn-primary unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOWING </button>
    										<?php } else { ?>
    											<button style="padding-left:15px; padding-right:15px; margin-top: 2px;" class="btn btn-success follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOW </button>
    										<?php } ?>
    									</span>
    								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.col -->
			    
			    <?php $storytitle = $row->title; $story = $row->story; $parablock1 = ''; $parablock2 = ''; $parablock3 = ''; $parablock1count = 0; $parablock2count = 0; ?>
				<div class="storyread pd-10-0 storeadpt">
					<div class="box box-widget widget-user boxshv boxshv1"><br>
				        <center><h3 style="padding-left:10px; padding-right:10px;"><b><?php echo $row->title; ?></b></h3></center>
						<div style="padding:20px 20px 0 20px;">
						    <!--<span class="text-right">
						    	<span class="font-size-label" style="display: inline-block; padding-right:15px;">Zoom</span>
						    	<a id="up" class="plus">+</a>
						    	<span id="font-size" style="margin: 0 5px;width: 30px;height: 30px;"></span>
						    	<a id="down"  class="plus">-</a>
						    </span>-->
						    <button id="reading-modebut"><i class="fa fa-book"></i> READING MODE</button>
						    <?php if(($row->type == 'series') && ($row->sid == $row->story_id)){
								$seriesongo_stop = get_seriesongo_stop($row->story_id); if(isset($seriesongo_stop) && !empty($seriesongo_stop)) { ?>
								<span style="float:right"><i class="fa fa-clock-o"></i> <span><?php echo $seriesongo_stop;?></span></span>
							<?php } }else{ ?>
						        <span style="float:right" class="time_story"><i class="fa fa-clock-o"></i> <span id="time123"></span> min read</span>
							<?php } ?>
						</div>
						<ul class="list-inline" style="padding:20px 20px 0 20px; margin-bottom:2px Solid #999;">
							<li style="padding-left:5px;padding-right:5px;"><i class="fa fa-eye"></i> <?php echo $row->views;?></li>
							<li class="ratingli" style="padding-left:5px;padding-right:5px;">
								<?php if(isset($reviews) && !empty($reviews)) {
									$starNumber = explode('.',$reviews);
									for($x=1;$x<=$starNumber[0];$x++) { ?>
										<span class="fa fa-star checked" style="color:rgb(60, 141, 188);" title="<?php echo $x; ?>"></span>
									<?php } if(isset($starNumber[1]) && !empty($starNumber[1])) { if ($starNumber[1] != 0) { ?>
										<span class="fa fa-star-half-full checked" style="color:rgb(60, 141, 188);" title="<?php echo $reviews; ?>"></span>
									<?php $x++;} }
									if($starNumber[0] <= 0){ } 
									while ($x<=5) { echo '<span class="fa fa-star-o checked" style="color:rgb(60, 141, 188);"></span>';$x++;}
								} else{ $y=1; while($y<=5){ echo '<span class="fa fa-star-o checked" style="color:rgb(60, 141, 188);"></span>';$y++; } } ?>
							</li>
							<li class="pull-right" style="padding-left:5px;padding-right:5px;">
								<i class="fa fa-heart" style="color: #337ab7;"></i>
								<span class="favcount"> <?php $favcount = 0; if(isset($row->sid) && !empty($row->sid)){
									$favocount = get_favcount($row->sid); if($favocount){ $favcount = $favocount;}
									}   echo $favcount;?>
								</span>
							</li>
							<li class="pull-right" style="padding-left:5px;padding-right:5px;">
								<a href="#comment">
									<i class="fa fa-comment" style="color: #337ab7;"></i>
									<?php if(isset($comment_like['commentcount'])){ echo $comment_like['commentcount']; } ?>
								</a>
							</li>
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
						    
						<div id="readTime" class="resizable noselect read_story">
						    <!-- <?php echo $row->story; ?><br> -->
							<?php if(isset($parablock1) && !empty($parablock1)){ echo $parablock1; } ?>
						</div>
					</div>
					
					<?php if(isset($parablock2) && !empty($parablock2)){ ?>
					<br><div class="box box-widget widget-user boxshv vjc1">
						    <div id="readTime" class="resizable noselect read_story">
							  <?php echo $parablock2; ?>
							</div>
					    </div>
					<?php } if(isset($parablock3) && !empty($parablock3)){ ?>
					<br><div class="box box-widget widget-user vjc1">
						    <div style="word-wrap: break-word;" id="readTime" class="resizable noselect read_story">
							  <?php echo $parablock3; ?>
							</div>
					    </div>
					<?php } ?>
					
					
					<div class="box-footer" style="padding-top:10px;border: 1px solid #d1d1d1;">
						<div class="row pt-0">
							<div class="col-md-4 col-xs-4">
							    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($row->user_id == $this->session->userdata['logged_in']['user_id'])) { ?>
							        <span style="cursor:pointer" onclick="yoursfavorite(<?php echo $row->sid;?>)" class="favbtn<?php echo $row->sid;?>" title="Favorite">
    									<span class="ratings" style="font-size:14px;">FAVORITE :</span>
    									<i class="fa fa-heart-o favbtn" style="color:#333;padding-top:5px;font-size:18px;"></i>
    								</span>
							    <?php } else { ?>
    							    <?php if(isset($favorites) && in_array($row->sid, $favorites)) { ?>
    									<span style="cursor:pointer" onclick="unfavorite(<?php echo $row->sid;?>)" class="favbtn<?php echo $row->sid;?>" title="Favorite">
    										<span class="ratings" style="font-size:14px;">FAVORITE: </span> <i class="fa fa-heart favbtn" style="color:#ff0000;padding-top:5px;font-size:18px;"></i> </span>
    								<?php } else { ?>
    									<span style="cursor:pointer" onclick="favorite(<?php echo $row->sid;?>)" class="favbtn<?php echo $row->sid;?>" title="Favorite">
    										<span class="ratings" style="font-size:14px;">FAVORITE : </span> <i class="fa fa-heart-o favbtn" style="color:#333;padding-top:5px;font-size:18px;"></i> </span>
    								<?php } ?>
								<?php } ?>
							</div>
							<div class="col-md-4 hidden-xs"></div>
							<div class="col-md-4 text-right col-xs-8">
                                <div style="float: right;" onclick="yoursrating()" title="Rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <span class="ratings" style="font-size:14px; float:right;">RATING : &nbsp; </span>
							</div>
							<div class="col-md-8 favoritemsg text-danger"></div><div class="col-md-4"></div>
						</div>
					</div>
					
					<div class="clearfix"></div><br>
					<?php if(isset($row->keywords) && !empty($row->keywords) && ($row->type == 'life')) {
					    $noofkeywords = explode(',', $row->keywords); ?>
					    <div class="" style="padding:10px; margin:15px 0;">
                            Tags: <?php foreach($noofkeywords as $keyword) { ?>
                                <a style="margin-right: 5px; border-radius: 3px; border: 1px solid #00000052; padding: 7px 7px; color: #8a8a8a;" href="<?php echo base_url();?>searchresult?type=life&searchtext=<?php echo $keyword;?>"><?php echo $keyword;?></a>
                            <?php } ?>
					    </div>
					<?php } ?>
					
					<?php } ?>
					<?php } ?>
					<div class="clearfix"></div>
					<div class="">
					<?php if(isset($recentstories) && ($recentstories->num_rows()>0)){ ?>
						<div class="row pt-0">
							<div class="col-md-6 col-xs-8 pull-left pd-0">
    	                    	<div class="titlei">Recommended</div>
    	                    </div>
    	                </div><hr>
						<div id="StoryCont" class="StoryCont" style="">
		                    <div id="story-slider" class="story-slider series">
					        <?php foreach ($recentstories->result() as $recentstory) { ?>
					            <div class="card">
			                    	<div class="book-type" style="z-index:0"><?php echo $recentstory->gener;?></div>
			                    	<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $recentstory->title).'-'.$recentstory->sid);?>" class="imagess-style">
			                    		<?php if(isset($recentstory->image) && !empty($recentstory->image)) { ?>
			                    		    <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $recentstory->image; ?>" alt="<?php echo $recentstory->title;?>" class="imageme lazy">
			                    		<?php }else{ ?>
			                    			<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $recentstory->title;?>" class="imageme lazy">
			                    		<?php } ?>
			                    	</a>
			                    	<div>
			                    		<font class="max-lines">
			                    			<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $recentstory->title).'-'.$recentstory->sid);?>">
			                    				<?php echo $recentstory->title;?>
			                    			</a>
			                    		</font> 
			                    	</div>
                                    <div class="flextest">
                                        <font class="byname">By
                                            <font class="namehere">
                                                <a href="<?php echo base_url($recentstory->profile_name);?>" style="color:#000"><?php echo $recentstory->name;?></a>
                                            </font>
                                        </font><br>
                                    </div>
			                    	<div class="flextest" style="padding-top:4px;">
			                    		<font class= "episodes">
						                	<font>
						                		<?php $wordcount = explode(' ', $recentstory->story);
						                	    $time = round(sizeof($wordcount)/180); ?>
						                		<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
						                	<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $recentstory->views;?>&nbsp;</b></font>
						                	<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
						                		<b>
						                		<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
						                			foreach($reviews21->result() as $reviews2) { 
						                				if($reviews2->sid == $recentstory->sid) {
						                					echo round($reviews2->rating);
						                				}
						                		} } ?>
						                		</b>
						                	</font>
						                </font><br>
			                    	</div>
			                    	<div class="flextest" style="padding-top:6px;">
                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($recentstory->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                        	<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
                                        <?php } else { ?>
                                        	<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($recentstory->sid, $readlatersids)) { ?>
                                        		<button onclick="unreadlater(<?php echo $recentstory->sid;?>)" class="readdone readlaterbtnatr<?php echo $recentstory->sid;?>">
                                        		<i class="fa fa-check faicon<?php echo $recentstory->sid;?>"></i> Read later </button>
                                        	<?php } else { ?>
                                        		<button onclick="readlater(<?php echo $recentstory->sid;?>)" class="read readlaterbtnatr<?php echo $recentstory->sid;?>">
                                        		<i class="fa fa-bookmark faicon<?php echo $recentstory->sid;?>"></i> Read later </button>
                                        	<?php } ?>
                                        <?php } ?>
                                        <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
                                        	<span class=""><i class="fa fa-plus"></i></span>
                                        </button>
										<ul class="dropdown-menu list-inline dropvk">
											<li onclick="groupsuggest(<?php echo $recentstory->sid; ?>);">
												<a href="javascript:void(0);"><i class="fa fa-users"></i></a>
											</li>
											<li onclick="friend(<?php echo $recentstory->sid;?>);">
												<a href="javascript:void(0);"><i class="fa fa-user"></i></a>
											</li>
											<li onclick="socialshare(<?php echo $recentstory->sid;?>, 'story');">
												<a href="javascript:void(0);"data-toggle="modal" data-target="#soc" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
											</li>
										</ul>
                                    </div>
                                </div>
					        <?php } ?>
					        </div>
					    </div>
					<?php } elseif(isset($recentstorieslife) && ($recentstorieslife->num_rows()>0)) { ?>
                        <div class="row pt-0">
                            <div class="col-md-6 col-xs-8 pull-left pd-0">
                            	<div class="titlei">Recommended</div>
                            </div>
                        </div> <hr>
    	                <div id="StoryContl" class="StoryContlv" style="justify-content:center;">
		                    <div id="story-sliderl" class="story-slider series">
				            <?php foreach ($recentstorieslife->result() as $recentlife) { ?>
                                <div class="card1">
                                    <a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $recentlife->title).'-'.$recentlife->sid);?>" class="imagebcg">
                                        <?php if(isset($recentlife->image) && !empty($recentlife->image)){ ?>
                                        	<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/images/<?php echo $recentlife->image; ?>" alt="<?php echo $recentlife->title;?>" class="imageme1 lazy" style="max-width:266px;max-height:165px;">
                                        <?php } else { ?>
                                        	<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $recentlife->title;?>" class="imageme1 lazy" style="max-width:266px;max-height:165px;">
                                        <?php } ?>
                                    </a>	
                                    <div>
                                        <font class="max-lines1">
                                        	<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $recentlife->title).'-'.$recentlife->sid);?>" style="overflow: hidden;text-overflow:ellipsis;white-space:nowrap;">
                                        		<?php echo $recentlife->title;?>
                                        	</a>
                                        </font> 
                                    </div>
                                    <div class="flextest">
                                    	<?php if(($recentlife->writing_style == 'anonymous') && ($recentlife->type == 'life')){ ?>
                                    		<font class="byname">By<font class="namehere"> Anonymous</font></font><br>
                                    	<?php } else { ?>
                                    		<font class="byname">By<font class="namehere">
                                    		    <a href="<?php echo base_url().$recentlife->profile_name; ?>" style="color:#000 !important;"> <?php echo $recentlife->name;?></a></font></font>
                                    		<br>
                                    	<?php } ?>
                                    </div>
                                    <div class="flextest" style="padding-top:4px;">
                                    	<font class="lifeEvents-text"><?php echo $recentlife->story;?></font>
                                    </div>
                                    <div class="flextest" style="padding-top:6px">
                                    	<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($recentlife->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                    		<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
                                    	<?php } else { ?>
                                    		<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($recentlife->sid, $readlatersids)) { ?>
                                    			<button onclick="unreadlater(<?php echo $recentlife->sid;?>)" class="readdone readlaterbtnatr<?php echo $recentlife->sid;?>">
                                    			<i class="fa fa-check faicon<?php echo $recentlife->sid;?>"></i> Read later </button>
                                    		<?php } else { ?>
                                    			<button onclick="readlater(<?php echo $recentlife->sid;?>)" class="read readlaterbtnatr<?php echo $recentlife->sid;?>">
                                    			<i class="fa fa-bookmark faicon<?php echo $recentlife->sid;?>"></i> Read later </button>
                                    		<?php } ?>
                                    	<?php } ?>
                                    	
                                    	<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
                                    		<span class=""><i class="fa fa-plus"></i></span>
                                    	</button>
										<ul class="dropdown-menu list-inline dropvklife">
											<li onclick="groupsuggest(<?php echo $recentlife->sid; ?>);">
												<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
											</li>
											<li onclick="friend(<?php echo $recentlife->sid;?>);">
												<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
											</li>
											<li onclick="socialshare(<?php echo $recentlife->sid;?>, 'story');">
												<a href="javascript:void(0);"data-toggle="modal" data-target="#soc" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
											</li>
										</ul>
                                    </div>
                                </div>
					        <?php } ?>
				            </div>
				        </div>
				    <?php } ?>
				    </div>
					<div class="clearfix"></div><br>
					<?php $sesslang = get_langshortname($this->uri->segment(1)); ?>
                        <input type="hidden" id="languageto" value="<?php if(isset($sesslang) && !empty($sesslang)){ echo $sesslang;}else{ echo 'en';} ?>">
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
								var ids = [ "comment" ];
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
					<div class="vjbs" id="commentv" style="padding:10px;background: #fff; margin-top:50px">
                        <span><h4><b>Comments</b></h4></span>
                        <div class="box-footer box-comments">
                            <div class="box-comment">
								<form id="commentsend" method="POST">
									<div class="input-group">
										<input type="text" id="comment" name="comment" placeholder="Press enter to post comment ..." class="form-control required">
										<input type="text" id="comments" name="comment" placeholder="Press enter to post comment ..." class="form-control required" style="display:none;">
										<span class="comment text-danger"> </span>
										<input type="hidden" id="storyid" name="id" value="<?php echo $storyid; ?>">
										<span class="input-group-btn">
											<button type="submit" class="btn btn-success btn-flat btnspinner" value="POST">POST</button>
										</span>
									</div><br>
								</form>
								<?php if($row->language != 'en') { ?>
								    <div class="input-group hidden-xs desktopedit">
										Switch to English: &nbsp; <label class="switch">  
											<input type="checkbox" onclick="langchang(this.value)" value="off" id="langchang"> <span class="slider"> </span> 
										</label> &nbsp; <span class="langchang"> Off </span>
									</div><br>
								<?php } ?>
                            </div>
                            <!-- /.box-comment -->
                            <div id="test_comment">
								<ul style="list-style: none; padding:0px;">
                                    <li id="postcmt"> </li>
                                    <div class="" id="loadmoreall">
                                        <?php if(isset($comment_get) && ($comment_get->num_rows() >0)){ foreach($comment_get->result() as $comment){ ?>
                                            <div style="padding-bottom:0px;" class="box-footer padding-0 box-comments commentdelete<?php echo $comment->cid;?>">
                                                <div class="box-comment">
                                                    <?php if(isset($comment->profile_image) && !empty($comment->profile_image)) { ?>
                                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="<?php echo ucfirst($comment->name); ?>">
                                                    <?php } else { ?>
                                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($comment->name); ?>">
                                                    <?php } ?>
                                                    <div class="comment-text">
                                                        <span class="username" style="padding-top:6px;">&nbsp;<b>    
                                                            <a href="<?php echo base_url().$comment->profile_name; ?>">
                                                                <p class="namers"><?php echo ucfirst($comment->name); ?></p></a></b>
                                                            <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $comment->user_id)){ ?>
                                                                <span class="dropdown" style="float:right;">
                                                                    <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu pull-right">
                                                                        <li><a href="javascript:void(0);" onclick="editcomment(<?php echo $comment->cid;?>);"><i class="fa fa-pencil"></i> EDIT </a></li>
                                                                        <li><a href="javascript:void(0);" onclick="deletecomment(<?php echo $comment->cid;?>);"><i class="fa fa-trash"></i> DELETE </a></li>
                                                                    </ul>
                                                                </span>
                                                            <?php } else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                                                                <span class="dropdown" style="float:right;">
                                                                    <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v pull-right"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dv1">
                                                                        <li><a href="javascript:void(0);" onClick="reportcomment(<?php echo $comment->cid;?>, <?php echo $comment->user_id;?>, <?php echo $comment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
                                                                        </li>
                                                                    </ul>
                                                                </span>
                                                            <?php } ?>
                                                            <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($comment->date);?></span>
                                                        </span>
                                                    </div>
                                                    <div class="comment-text" style="margin:4px 0px 6px 2px;">
                                                        <div style="word-break:break-word;" class="more pcomment<?php echo $comment->cid;?>"><?php echo $comment->comment; ?></div>
                                                        <div style="margin:5px 0px;">
                                                            <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->cid;?>, <?php echo $comment->story_id;?>)" class="pull-left replycv"> REPLY </a>
                                                            <span class="pull-left replycv">I</span>
                                                            <a href="javascript:void(0)" onClick="displayreplies(<?php echo $comment->cid;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Replies">
                                                                <span class="old_subcmtcount<?php echo $comment->cid;?>"><?php echo get_storysubcmtcount($comment->cid, $comment->story_id);?></span> REPLIES</a>
                                                        </div>
                                                    </div><br>
                                                    <div class="comment-text"> 
                                                        <div style="margin-bottom:5px;" class="input-group postreplycomment<?php echo $comment->cid;?>"></div>
                                                    </div>
                                                </div>

                                                <!-- SUB COMMENTS -->
                                                <div class="subcomments" style="margin-bottom:0px;" id="mysublist<?php echo $comment->story_id, $comment->cid;?>">
                                                    <?php $replaycomments = get_replaycomments($comment->story_id, $comment->cid); ?>
                                                    <?php if(isset($replaycomments) && ($replaycomments->num_rows() > 0 )){ ?>
                                                    <ul style="list-style: none; padding:0px; margin-top:0px;margin-left:15px;display:none;" class="replycmtlist<?php echo $comment->cid;?>">
                                                        <span id="spinnertab<?php echo $comment->cid;?>"><center>
                                                            <img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner">
                                                        </center></span>
                                                        <li class="postreplycmt<?php echo $comment->cid;?>"></li>
                                                        <?php foreach($replaycomments->result() as $replaycomment){ ?>
                                                            <div style="margin-bottom:5px;margin-top:5px;" class="media commentdelete<?php echo $replaycomment->cid;?>">
                                                                <span class="media-left">
                                                                    <?php if(!empty($replaycomment->profile_image)){ ?>
                                                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $replaycomment->profile_image;?>" style="width:25px;" alt="<?php echo ucfirst($replaycomment->name); ?>">
                                                                    <?php } else{ ?>
                                                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:25px;" alt="<?php echo ucfirst($replaycomment->name); ?>">
                                                                    <?php } ?>
        									                    </span>
        									                    <span class="media-body bodycv">
        									                        <div class="">
                                                                        <span class="">&nbsp;<b><a href="<?php echo base_url().$replaycomment->profile_name; ?>"><?php echo ucfirst($replaycomment->name); ?></a></b>
        											                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $replaycomment->user_id)){ ?>
                                                                            <span class="dropdown" style="float:right;">
                                                                                <a href="javascript:void(0);" class="dropdown-toggle ellisub" data-toggle="dropdown" title="write" aria-expanded="false">
        												                            <i class="fa fa-ellipsis-v"></i>
        												                        </a>
        												                        <ul class="dropdown-menu pull-right">
                        					                                        <li><a href="javascript:void(0);" onClick="editcomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-pencil"></i> EDIT </a></li>
                        					                                        <li><a href="javascript:void(0);" onClick="deletecomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-trash"></i> DELETE </a></li>
                        					                                    </ul>
                        					                                </span>
                    					                                    <?php } else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                    					                                    <span class="dropdown" style="float:right;">
                        					                                    <a href="javascript:void(0);" class="dropdown-toggle ellisub" data-toggle="dropdown" title="write" aria-expanded="false">
        												                            <i class="fa fa-ellipsis-v"></i>
        												                        </a>
        												                        <ul class="dropdown-menu pull-right">
                        					                                        <li><a href="javascript:void(0);" onClick="reportcomment(<?php echo $replaycomment->cid;?>, <?php echo $replaycomment->user_id;?>, <?php echo $replaycomment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
        												                            </li>
                        					                                    </ul>
                    					                                    </span>
                    					                                    <?php } ?>
                    					                                    <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($replaycomment->date);?></span>
        										                        </span><br>
        									                            <span style="padding-left:6px;word-break:break-word;" class="more pcomment<?php echo $replaycomment->cid;?>"><?php echo $replaycomment->comment; ?></span>
        									                        </div>
                                                                </span> 
                                                            </div>
                                                        <?php } ?>
                                                    </ul>
                                                    <?php } else{ ?>
                                                        <ul style="list-style: none; padding:0px; margin-top:15px;">
                                                            <li class="postreplycmt<?php echo $comment->cid;?>"></li>
                                                        </ul>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } } ?>
                                    </div>
                                    <div id="load_data_message"></div>
                                </ul>	
							</div>
				    	</div>
				    </div>
					
				</div>
			</div>
		</div>
	</div>
	
</div>



<div class="modal fade" id="report_comment" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Report Your Comments</h4>
			</div>
			<div class="modal-body">
				<form id="reportcomment">
					<textarea class="form-control input-sm" name="reportcmt" id="reportcmt" placeholder="Enter Repost message"></textarea>
					<span class="text-danger reportcmt"></span>
					<input type="hidden" name="reportcommentid" value="" id="reportcommentid">
					<input type="hidden" name="report_userid" value="" id="report_userid">
					<input type="hidden" name="report_storyid" value="" id="report_storyid"><br>
					<input type="hidden" name="report_storytype" value="<?php echo $cmttype;?>_comment" id="report_storytype">
					<center>
					    <button class="btn btn-primary reportspinner" type="submit"> Submit </button>
					</center>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit_comment" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update your Comments</h4>
			</div>
			<div class="modal-body">
				<form id="editcomment" >
					<textarea class="form-control input-sm" name="comment" id="editcmt" placeholder="Enter comment"></textarea>
					<span class="text-danger comment"></span>
					<input type="hidden" id="commentid" name="commentid"><br>
					<center>
					    <button class="btn btn-primary updatespinner" type="submit"> Update </button>
					</center>
				</form>
			</div>
		</div>
	</div>
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
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px; margin-top:-10px;"/> <p class="socialsharepopupspan">Facebook</p></a>
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

<!--report stories popup end ------------->
<div class="modal fade" id="reportstories" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Report Story</b></h4>
			</div>
			<div class="modal-body">
    		    <input type="hidden" id="reportuserid">
    		    <input type="hidden" id="reportstoryid">
    		    <input type="hidden" id="reportstorytype" value="<?php echo $cmttype;?>">
    		    <textarea id="reportmsg" class="form-control"></textarea> <br>
    		    <center><button class="btn btn-danger" Onclick="reportstoriesdiv();"> Report </button></center>
            </div>
		</div>
	</div>
</div>
<!--report stories popup end ------------->


</div> <!-- div all close reading story view page-->
<div class="reading-mode-bg">
    <div class="reading-mode-header">
        <div class="reading-mode-header-inner">
            <div class="read-settings">
                <button class="font-plus fontsize" onclick="fontincrese()">+</button>
                <span class="font-num">16</span>
                <button class="font-minus fontsize" onclick="fontdecrese()">-</button>
                <button class="night-mode"><img src="<?php echo base_url();?>assets/default/moon-solid.svg" style="height: 12px;">
                    <span class="night-modetext">NIGHT MODE</span>
                </button>
            </div>
            <button class="reading-mode-close"><i class="fa fa-arrow-left"></i>
                <span> BACK</span>
            </button>
        </div>
    </div>
    <div class="reading-mode-header-innerbody" id="reading-mode-bg">
        <h2 style="text-align: center;margin-bottom: 25px;"><?php echo $storytitle; ?></h2>
        <div class="read-modestory"><?php echo $story;?></div>
    </div>
</div>


<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>


<script type="text/javascript">
    var totalWords = document.getElementById("readTime").innerHTML;
    var words= totalWords.split(/\s/g).length;
    var timeToRead = words / 180;
    var timeInt = Math.round(timeToRead);
    document.getElementById("time123").innerHTML = timeInt;
</script>


<script type="text/javascript">
	$( "form#commentsend" ).submit(function( event ) {
		event.preventDefault();
		$('.btnspinner').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner" style="height:18px !important; width:18px !important;">');
		$('#comment').empty();
		$('#comments').empty();
	    var comment = $('#comment').val();
	    if((comment == '') || (comment == 'undefined')){
	        comment = $('#comments').val();
	    }
	    var storyid = $('#storyid').val();
		if(comment.length > 0){
    		$.post("<?php echo base_url(); ?>welcome/comment",{'comment':comment,'storyid':storyid},function(output,status){
    		    $('.btnspinner').html('POST');
    			$("li#postcmt").prepend(output);
    			$("#comment").val('');
    			$("#comments").val('');
    			$("#load_data_message").html('');
    		});
		}else{
		    $('.btnspinner').html('POST');
		    $('#snackbar').text('Please enter Comment message.').addClass('show');
    		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
		}
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
	/*$(document).ready(function(){
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
	});*/
</script>
<script> // comments
    function deletecomment(commentid){
	    $('.deletemessage').html("Are you sure you want to delete the Comment?");
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>welcome/deletepro_comment/'+commentid,
                success:function(response){
                    if(response){
                        var result = jQuery.parseJSON(response);
                        $('.old_subcmtcount'+result.comment_id).text(result.delsubcmtcount);
                        $('div.commentdelete'+commentid).css('display','none');
                        $('#snackbar').text('Comment Deleted Successfully.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                    }else{
                        $('#snackbar').text('Failed to Delete Comment.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                    }
                }
            });
        });
	}
    function reportcomment(commentid, user_id, story_id){
	    $('#report_comment').modal('show');
	    $('#reportcommentid').val(commentid);
	    $('#report_storyid').val(story_id);
	    $('#report_userid').val(user_id);
	}
	$("form#reportcomment").submit(function( event ) {
		event.preventDefault();
        $('.reportspinner').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner" style="height:18px !important; width:18px !important;">');
		//$.post("<?php echo base_url();?>index.php/welcome/reportcomment",$("form#reportcomment").serialize(),function(resultdata){
		$.post("<?php echo base_url();?>welcome/reportstoriescomment",$("form#reportcomment").serialize(),function(resultdata){
            $('.reportspinner').html('REPORT');
			if(resultdata == 2){
				$('span.reportcmt').text('Please Enter your Report Message');
			}else if(resultdata == 1){
			    console.log('success');
			    $('#report_comment').modal('hide');
			}else{
			    console.log('fail');
			}
		});
	});
	
    function editcomment(commentid){
        $('#edit_comment').modal('show');
        $.ajax({
    		url:'<?php echo base_url();?>welcome/editpro_comment/'+commentid,
    		method: 'POST',
    		dataType: "json",
    		success:function(data){
    			if(data.response[0].comment) {
    			    $('textarea#editcmt').val(data.response[0].comment);
    			    $('#commentid').val(commentid);
               }else{
                   $('#edit_comment').modal('hide');
               }
            } 
        });
    }
    $( "form#editcomment" ).submit(function( event ) {
		event.preventDefault();
        $('.updatespinner').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner" style="height:18px !important; width:18px !important;">');
		var comments = $('textarea#editcmt').val();
		var cid = $('#commentid').val();
		$.post("<?php echo base_url();?>welcome/updatecomment",{'comment':comments,'cid':cid},function(resultdata){
            $('.updatespinner').html('Update');
			if(resultdata == 2){
				$('span.comment').text('Please Enter Comment');
			}else if(resultdata == 1){
			    console.log('success');
			    $('.pcomment'+cid).html(comments);
			    $('#edit_comment').modal('hide');
			}else{
			    console.log('fail');
			}
		});
	});
	function postReplycomment(commentid, storyid){
	    $('div.postreplycomment'+commentid).html('<input type="text" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Replay Comment..." required>'+
	    '<span class="text-danger addreplaycmt'+commentid+'"></span><input type="hidden" name="storyid" value="'+storyid+'">'+
	    '<span class="input-group-btn"><button type="submit" class="btn btn-success btn-flat btnspinner'+commentid+'"  onclick="addreplycomment('+commentid+','+storyid+')">POST</button></span>');
	    $('.replycmtlist'+commentid).css('display','block');
	    setTimeout(function(){ $('#spinnertab'+commentid).html(' '); }, 50);
	}
	function displayreplies(commentid, storyid){
	    $('.replycmtlist'+commentid).css('display','block');
	    setTimeout(function(){ $('#spinnertab'+commentid).html(' '); }, 50);
	}
	function addreplycomment(commentid, storyid){
	    var comments = $('#replycmts'+commentid).val();
	    var old_subcmtcount = $('.old_subcmtcount'+commentid).text();
	    $('.btnspinner'+commentid).html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner" style="height:18px !important; width:18px !important;">');
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>welcome/addstoryreplycomment',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comment':comments, 'story_id': storyid},
        		dataType: "json",
        		success:function(data){
        		    if(data == 2){
                        //$('.addreplaycmt'+commentid).text('Enter your Comments.');
                        $('.btnspinner'+commentid).html('POST');
                        $('#snackbar').text('Enter your Comments.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    } else if(data == 1) {
                        $.ajax({
                            url: "<?php echo base_url('welcome/pro_commentpost'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                $('.btnspinner'+commentid).html('POST');
                                if(result.response){
                                    $('#replycmts'+commentid).val('');
                                    //var profileimage = '<?php echo base_url();?>assets/images/'+result.response[0].profile_image;
                                    var profileimage = "<?php echo $this->session->userdata['logged_in']['profile_image'];?>";
                                    if(profileimage){ }else{ profileimage = '2.png'; }
                                    var htmlcomment = '<div style="margin-bottom:5px;margin-top:5px;" class="media commentdelete'+result.response[0].cid+'">'+
                                        '<span class="media-left"><img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/'+profileimage+'" alt="'+result.response[0].name+'"></span>'+
                                        '<span class="media-body bodycv">'+
                                        '<div class="">'+
                                        '<span class="">&nbsp;<b><a href="javascript:void(0);" style="color: #337ab7;">'+result.response[0].name+'</a></b>'+
                                        '<span class="dropdown" style="float:right;">'+
                                        '<a href="javascript:void(0);" class="dropdown-toggle ellisub" data-toggle="dropdown" aria-expanded="false">'+
    					                '<i class="fa fa-ellipsis-v" style="color: #337ab7;"></i></a><ul class="dropdown-menu pull-right">'+
    	                                    '<li><a href="javascript:void(0);" onClick="editcomment('+result.response[0].cid+');"><i class="fa fa-pencil"></i> EDIT </a></li>'+
    	                                    '<li><a href="javascript:void(0);" onClick="deletecomment('+result.response[0].cid+');"><i class="fa fa-trash"></i> DELETE </a></li>'+
    	                                '</ul></span><span class="text-muted pull-right datecv">1 minute ago</span></span><br>'+
    				                    '<span style="padding-left:6px;word-break:break-word;" class="more pcomment'+result.response[0].cid+'">'+result.response[0].comment+'</span></div></span></div>'; ///'+result.response[0].date+'
                                        $('li.postreplycmt'+result.response[0].comment_id).prepend(htmlcomment);
                                        $('.old_subcmtcount'+commentid).text(parseInt(old_subcmtcount)+1);
                                }else{
                                }
                            }
                        })
                        
                    }else{
                        //$('.addreplaycmt'+commentid).text('Failed to Post your Comments.');
                        $('#snackbar').text('Failed to Post your Comments.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
            });
	    }else{
	        //$('.addreplaycmt'+commentid).text('Enter your Comments.');
            $('.btnspinner'+commentid).html('POST');
            $('#snackbar').text('Enter your Comments.').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
	    }
	}
</script>
<script>
    $(document).ready(function(){
        var limit = 2;
        var start = 2;
        var action = 'inactive';
        var numcomments = $('.box-footer.padding-0.box-comments').length;
        function load_country_data(limit, start) {
            var story_id = $('#storyid').val();
            if(story_id){
                $.ajax({
                    url:'<?php echo base_url();?>welcome/storyloadcomments',
                    method:"POST",
                    data:{limit:limit, start:start, story_id: story_id},
                    cache:false,
                    success:function(data){
                        $('#loadmoreall').append(data);
                        if(data == '') {
                            $('#load_data_message').html("<center> No More Results!</center>");
                            action = 'active';
                        }else{
                            $('#load_data_message').html("<center> Loading ...</center>");
                            action = "inactive";
                        }
                        if(numcomments < 1){
                            $('#load_data_message').html("<center> No comments yet!</center>");
                        }
                    }
                });
            }
        }
        if(action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        } 
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#loadmoreall").height() && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 500);
            }
        });
    });
</script>

<script>
var didScrolls;
var lastScrollTops = 0;
var deltas = 5;
var sidebarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScrolls = true;
});

setInterval(function() {
    if (didScrolls) {
        hasScrolleds();
        didScrolls = false;
    }
}, 350);

function hasScrolleds() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTops - st) <= deltas)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTops && st > sidebarHeight){
        // Scroll Down
        $('#navbarv').removeClass('sticky').addClass('sticky1');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('#navbarv').removeClass('sticky1').addClass('sticky');
        }
    }
    
    lastScrollTops = st;
}
</script>
<script>
    var rightButton = $("#right-btn");
    var leftButton = $("#left-btn");
    var container = $("#StoryCont");
    var slideCont = $("#story-slider");
    if($("#story-slider > div").length<5){
      $('#right-btn').hide();
      $('#left-btn').hide();
    }
    var maxcount=$("#story-slider > div").length;
    var marLeft = 0, maxX = maxcount*210, diff = 0 ;
    
    function slide() {
    marLeft-=218;
    if( marLeft < -maxX ){ 
      marLeft = -maxX+183 ;
    }
      slideCont.animate({"margin-left" : marLeft + "px"}, 300);
    }
    
    function slideBack() {
      marLeft +=218;
      if ( marLeft > 0 ) { marLeft = 0 ;}
      slideCont.animate({"margin-left" : marLeft + "px"}, 300);
    }
    rightButton.click(slide);
    leftButton.click(slideBack);
    
    /*touch code from here*/
    
    $(container).on("mousedown touchstart", function(e) {
      
      var startX = e.pageX || e.originalEvent.touches[0].pageX;
      diff = 0;
    
      $(container).on("mousemove touchmove", function(e) {
        
          var xt = e.pageX || e.originalEvent.touches[0].pageX;
          diff = (xt - startX) * 100 / window.innerWidth;
        if( marLeft == 0 && diff > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeft == -maxX && diff < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(container).on("mouseup touchend", function(e) {
      $(container).off("mousemove touchmove");
      if(  marLeft == 0 && diff > 4 ) { 
          sliderCont.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeft == -maxX  && diff < 4 ){
           sliderCont.animate({"margin-left" : -maxX  + "px"},100);  
       } else {
          if (diff < -10) {
            slide();
          } else if (diff > 10) {
            slideBack();
          } 
      }
    });
</script>
<!-- Life Events-->

<script>
var rightButtonl = $("#right-btnl");
var leftButtonl = $("#left-btnl");
var containerl = $("#StoryContl");
var slideContl = $("#story-sliderl");
if($("#story-sliderl > div").length<3){
    $('#right-btnl').hide();
    $('#left-btnl').hide();
}
var maxcountl=$("#story-sliderl > div").length;
var marLeftl = 0, maxXl = maxcountl*267, diffl = 0 ;

function slidel() {
marLeftl-=284;
if( marLeftl < -maxXl ){ 
  marLeftl = -maxXl+250;
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
</script>
<!-- //Life Events-->

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
        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
    }
</script>


<script>
    let change = true;
      $("#reading-modebut").click(()=>{
          $(".div-all").css('display','none')
          $("body").addClass('whitebody')
          $(".reading-mode-bg").css('display','block')
      })
      
      $(".night-mode").click(()=>{
          if(change){
          $("body").addClass('blackbody')
          //$(".reading-mode-bg").css({"color":"white"})
          $(".night-mode").css('background','lightyellow')
          change = false;
          } else {
          change = true;
          $("body").removeClass('blackbody').addClass('whitebody')
          //$(".reading-mode-bg").css({"color":"black"})
          $(".night-mode").css('background','#eeeeee')
          }
      })
      
      $(".reading-mode-close").click(()=>{
          $(".reading-mode-bg").css({'display':'none'})
          $("body").removeClass('blackbody').removeClass('whitebody')
          $(".div-all").css('display','block')
          $(".night-mode").css('background','#eeeeee')
      })

    function fontincrese(){
        var fontsize = parseInt($('.font-num').text());
        if(fontsize < 24){
            fontsize+=2;
            $('.read-modestory p').css('font-size', fontsize+'px');
            $('.read-modestory').css('font-size', fontsize+'px');
            $('.font-num').text(fontsize);
        }
    }

    function fontdecrese(){
        var fontsize = parseInt($('.font-num').text());
        if(fontsize > 16){
            fontsize-=2;
            $('.read-modestory p').css('font-size', fontsize+'px');
            $('.read-modestory').css('font-size', fontsize+'px');
            $('.font-num').text(fontsize);
        }
    }
</script>

<script>
function mobilestoryedit(sid){
    if( isMobile.Android() ) document.getElementById("apptext").innerHTML = `DOWNLOAD <a style="color:blue;" href="https://play.google.com/store/apps/details?id=com.google.android.apps.inputmethod.hindi&hl=en_IN">GOOGLE INDIC</a> KEYBOARD & <a href="<?php echo base_url();?>admin_story_view/${sid}" style="color:blue">EDIT STORY</a> OR <a href="<?php echo base_url();?>story_info/${sid}" style="color:blue">EDIT STORY INFO</a> IN INDIAN LANGUAGES.`
    if( isMobile.iOS() ) document.getElementById("apptext").innerHTML = `DOWNLOAD <a style="color:blue" href="https://play.google.com/store/apps/details?id=com.reverie.swalekh&hl=en">SWALEKHA</a> KEYBOARD & <a href="<?php echo base_url();?>admin_story_view/${sid}" style="color:blue">EDIT STORY</a> OR <a href="<?php echo base_url();?>story_info/${sid}" style="color:blue">EDIT STORY INFO</a> IN INDIAN LANGUAGES.`
    if( isMobile.Windows() ) document.getElementById("apptext").innerHTML = `OPEN SITE ON DESKTOP`
}
</script>
<script>
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
    });
</script>