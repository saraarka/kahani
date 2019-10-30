<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/index.css">
<!--<script src="<?php echo base_url();?>assets/js/index.js"></script>-->
<style>
@supports (-webkit-overflow-scrolling: touch) {
    .dropvk {
        margin-top: -80px !important;
        float: right;
        position: relative;
        padding-left: 3px;
    }
}

@supports not (-webkit-overflow-scrolling: touch) {
    .dropvk {
        margin-top: -112px;
        float: right;
        position: relative;
        padding-left: 3px;
    }
}
</style>
<script>
    $(document).ready(function(){
        $("#home").addClass("active");
    });
</script>
<div class="clear-fix"></div>
<div class="content-wrapper">

    <!-- Slider -->
	<section class="content" style="margin-bottom:30px;">
		<div class="main-container carctop sliderh">
			<!-- /.box-header -->
			<div class="">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				    <?php $i=0; if(isset($banner) && ($banner->num_rows() >0)){ ?>
				    <a class="left-btnc car1" href="#carousel-example-generic" data-slide="prev">
						<i class="fa fa-arrow-left ic1 fa-2x"></i>
					</a>
					<a class="right-btnc car2" href="#carousel-example-generic" data-slide="next">
						<i class="fa fa-arrow-right ic1 fa-2x"></i>
					</a>
					<div class="carousel-inner" style="box-shadow:0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2)!important">
						<?php foreach ($banner->result() as $row){
						    $itemactive=''; if($i==0){ $itemactive ='active';} ?>
						<div class="item <?php echo $itemactive; ?>">
							<img src="<?php echo base_url();?>assets/images/<?php echo $row->slideimage; ?>" class="mb_image1">
							<div class="carousel-caption">
							    <a href="<?php if(!empty($row->slideurl)){ echo $row->slideurl; }else{ echo '#'; }; ?>">
							        <?php echo $row->caption; ?></a>
							</div>
						</div>
						<?php $i++; } ?>
					</div>
					<div class="clear-fix"></div>
					<?php } else { ?>
					    <div class="carousel-inner"></div>
					<?php } ?>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="clear-fix"></div>
			<!-- /.box -->
		</div>
    </section>
    <!-- Slider -->
    <!-- Main content -->
	<section class="content" style="padding-bottom:0;">
	    <?php $readlatersids = get_storiesreadlater('readlater'); $divisioncount = 0; ?>
	    <div style="min-height:20vh;">
	    <!-- // Admin Choice STORIES start-->
		<div class="main-container">
		    <div class="clear-fix"></div>
		    <?php if(isset($adminchoices) && ($adminchoices->num_rows() > 0)){ $divisioncount = $divisioncount + $adminchoices->num_rows(); ?>
		    <div class="titleindex" style="clear:both;"> <span class="titlei">Admin Choice</span></div><hr>
		    <div>
		        <div id="StoryConta" class="StoryCont" style="text-align:left;">
    				<div id="story-slidera" class="story-slider">
    				<?php foreach($adminchoices->result() as $adminchoice) { ?>
    					<div class="card">
    						<div class="book-type"><?php echo $adminchoice->gener;?></div>
    						<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $adminchoice->title).'-'.$adminchoice->sid);?>" class="imagess-style">
        						<?php if(isset($adminchoice->image) && !empty($adminchoice->image)) { ?>
        						    <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $adminchoice->image; ?>" alt="<?php echo $adminchoice->title;?>" class="imageme lazy">
        						<?php }else{ ?>
        							<img  src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $adminchoice->title;?>" class="imageme lazy">
        						<?php } ?>
    						</a>
    						<div>
    							<font class="max-lines">
    								<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $adminchoice->title).'-'.$adminchoice->sid);?>" class="product-title"><?php echo $adminchoice->title;?></a>
    							</font> 
    						</div>
    						<div class="flextest">
    							<font class="byname">By<font class="namehere"><a href="<?php echo base_url($adminchoice->profile_name);?>" style="color:#000"> <?php echo $adminchoice->name;?></a></font>
    						    </font><br>
    						</div>
    						<div class="flextest" style="padding-top:4px;">
    							<font class="episodes">
    								<font>
    									<?php $wordcount = explode(' ', $adminchoice->story);
    					        	        $time = round(sizeof($wordcount)/180);	?>
    									<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
    								<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $adminchoice->views;?>&nbsp;</b></font>
    								<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    									<b>
    									<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    										foreach($reviews21->result() as $reviews2) { 
    											if($reviews2->sid == $adminchoice->sid) {
    												echo round($reviews2->rating);
    											}
    									} } ?>
    									</b>
    								</font>
    							</font><br>
    						</div>
    						<div class="flextest" style="padding-top:6px">
    							<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($adminchoice->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    								<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    							<?php } else { ?>
    								<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($adminchoice->sid, $readlatersids)) { ?>
    									<button onclick="unreadlater(<?php echo $adminchoice->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $adminchoice->sid;?>">
    									<i class="fa fa-check faicon<?php echo $adminchoice->sid;?>"></i> Read later </button>
    								<?php } else { ?>
    									<button onclick="readlater(<?php echo $adminchoice->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $adminchoice->sid;?>">
    									<i class="fa fa-bookmark faicon<?php echo $adminchoice->sid;?>"></i> Read later </button>
    								<?php } ?>
    							<?php } ?>
    							<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    								<span class=""><i class="fa fa-plus"></i></span>
    							</button>
    							<ul class="dropdown-menu list-inline dropvk">
    								<li onclick="groupsuggest(<?php echo $adminchoice->sid; ?>);">
    									<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    								</li>
    								<li onclick="friend(<?php echo $adminchoice->sid;?>);">
    									<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    								</li>
    								<li onclick="socialshare(<?php echo $adminchoice->sid;?>, 'story');">
    									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
    								</li>
    							</ul>
    						</div>
    					</div>
    				<?php } ?>
    				</div>
			    </div>
		    </div>
		    <button id="right-btna" style="visibility:hidden;" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i> </button>
	    	<button id="left-btna" style="visibility:hidden;" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i> </button>
	    <?php } ?>
	    </div><!-- // Admin Choice STORIES end-->
		
		<!-- // Your network STORIES start-->
		<div class="main-container">
		    <div class="clear-fix"></div>
		    <?php if(isset($yournetworks) && ($yournetworks->num_rows() > 0)){ $divisioncount = $divisioncount + $yournetworks->num_rows(); ?>
		    <div class="titleindex">
		        <span class="titlei">Your Networks</span>
		        <?php if($yournetworks->num_rows() >= 7){ ?>
		    	<a href="<?php echo base_url();?>viewallyournetwork">
		    	    <span class="view pull-right">VIEW MORE</span>
		    	</a>
		    	<?php } ?>
		    </div><hr>
		    <div>
		        <div id="StoryContyn" class="StoryCont" style="text-align:left;">
    				<div id="story-slideryn" class="story-slider">
    				<?php foreach($yournetworks->result() as $yournetwork) { ?>
    					<div class="card">
    						<div class="book-type"><?php echo $yournetwork->gener;?></div>
    						<?php $yournetworktitle = preg_replace("~[^\p{M}\w]+~u", '-', $yournetwork->title);
    						    $yournwurl = base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $yournetworktitle).'-'.$yournetwork->sid);
        						$langfullname = get_langfullname($yournetwork->language); 
        						if(isset($langfullname) && !empty($langfullname)){
        						    //$yournwurl = base_url($langfullname.'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $yournetworktitle).'-'.$yournetwork->sid);
        						    $yournwurl = base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $yournetworktitle).'-'.$yournetwork->sid);
        						} ?>
    						<a href="<?php echo $yournwurl;?>" class="imagess-style">
        						<?php if(isset($yournetwork->image) && !empty($yournetwork->image)) { ?>
        						    <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/images/<?php echo $yournetwork->image; ?>" alt="<?php echo $yournetwork->title;?>" class="imageme lazy">
        						<?php } else { ?>
        							<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $yournetwork->title;?>" class="imageme lazy">
        						<?php } ?>
    						</a>
    						<div>
    							<font class="max-lines"><a href="<?php echo $yournwurl; ?>" class="product-title"><?php echo $yournetwork->title;?></a></font> 
    						</div>
    						<div class="flextest">
    							<font class="byname">By<font class="namehere"><a href="<?php echo base_url($yournetwork->profile_name);?>" style="color:#000"> <?php echo $yournetwork->name;?></a></font></font><br>
    						</div>
    						<div class="flextest" style="padding-top:4px;">
    							<font class="episodes">
    								<font>
    									<?php $wordcount = explode(' ', $yournetwork->story);
    					        	        $time = round(sizeof($wordcount)/180);	?>
    									<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;
    								</font>
    								<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $yournetwork->views;?>&nbsp;</b></font>
    								<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    									<b>
    									<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    										foreach($reviews21->result() as $reviews2) { 
    											if($reviews2->sid == $yournetwork->sid) {
    												echo round($reviews2->rating);
    											}
    									} } ?>
    									</b>
    								</font>
    							</font><br>
    						</div>
    						<div class="flextest" style="padding-top:6px">
    							<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($yournetwork->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    								<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    							<?php } else { ?>
    								<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($yournetwork->sid, $readlatersids)) { ?>
    									<button onclick="unreadlater(<?php echo $yournetwork->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $yournetwork->sid;?>">
    									<i class="fa fa-check faicon<?php echo $yournetwork->sid;?>"></i> Read later </button>
    								<?php } else { ?>
    									<button onclick="readlater(<?php echo $yournetwork->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $yournetwork->sid;?>">
    									<i class="fa fa-bookmark faicon<?php echo $yournetwork->sid;?>"></i> Read later </button>
    								<?php } ?>
    							<?php } ?>
    							<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    								<span class=""><i class="fa fa-plus"></i></span>
    							</button>
    							<ul class="dropdown-menu list-inline dropvk">
    								<li onclick="groupsuggest(<?php echo $yournetwork->sid; ?>);">
    									<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    								</li>
    								<li onclick="friend(<?php echo $yournetwork->sid;?>);">
    									<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    								</li>
    								<li onclick="socialshare(<?php echo $yournetwork->sid;?>, 'story');">
    									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
    								</li>
    							</ul>
    						</div>
    					</div>
    				<?php } if($yournetworks->num_rows() >= 7) { ?>
    					<div class="card" style="justify-content: center">
    					    <a href="<?php echo base_url();?>viewallyournetwork" style="padding: 150px 0px;">
        						<font class="max-lines" style="padding-left:52px">VIEW MORE</font>
        					</a>
    					</div>
    				<?php } ?>
    				</div>
			    </div>
		    </div>
            <?php if($yournetworks->num_rows() > 4){ ?>
    	        <button id="right-btnyn" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i> </button>
    	    	<button id="left-btnyn" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i> </button>
            <?php }else{ ?>
                <button id="right-btnyn" style="visibility: hidden;" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i> </button>
                <button id="left-btnyn" style="visibility: hidden;" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i> </button>
            <?php } ?>
	    <?php } ?>
	    </div><!-- // Your network STORIES end-->

		<div class="main-container">
		    <div class="clear-fix"></div>
		    <!-- Top Series Start -->
		    <?php if(isset($top_get_series) && ($top_get_series->num_rows() > 0)){ $divisioncount = $divisioncount + $top_get_series->num_rows(); ?>
    		    <div class="titleindex" style="clear:both;">
    		        <span class="titlei">top series</span>
    		        <?php if($top_get_series->num_rows() >= 7){ ?>
    		    	<a href="<?php echo base_url();?>series/top">
    		    	    <span class="view pull-right">VIEW MORE</span>
		    	    </a>
    		    	<?php } ?>
    		    </div><hr>
		        <div id="StoryCont" class="StoryCont" style="text-align:left;">
				    <div id="story-slider" class="story-slider series">
        				<?php foreach($top_get_series->result() as $topseriesrow) { ?>
        					<div class="card">
        						<div class="book-type"><?php echo $topseriesrow->gener;?></div>
    							<!--<a href="<?php echo base_url('new_series?id='.$topseriesrow->sid.'&story_id='.$topseriesrow->story_id);?>"> -->
    							<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->story_id);?>" class="imagess-style">
        							<?php if(isset($topseriesrow->image) && !empty($topseriesrow->image)) { ?>
        							    <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/images/<?php echo $topseriesrow->image; ?>" alt="<?php echo $topseriesrow->title;?>" class="imageme lazy">
        							<?php }else{ ?>
        								<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $topseriesrow->title;?>" class="imageme lazy">
        							<?php } ?>
    							</a>
        						<div>
        							<font class="max-lines">
        								<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->story_id);?>">
        									<?php echo $topseriesrow->title;?>
        								</a>
        							</font> 
        						</div>
        						<div class="flextest">
        							<font class="byname">By<font class="namehere"><a href="<?php echo base_url($topseriesrow->profile_name);?>" style="color:#000"> <?php echo $topseriesrow->name;?></a></font>
        							</font><br>
        						</div>
        						<div class="flextest" style="padding-top:4px;">
        							<font class="episodes">
        								<?php $keycount = get_episodecount($topseriesrow->sid);
            								if(isset($keycount)){ echo $keycount; }else{ echo 0; } ?> EPISODES | 
            							<?php $subsmemcount = get_storysubscount($topseriesrow->sid);
            								if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
        							</font><br>
        						</div>
        						<div class="flextest" style="padding-top:6px">
            						<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
            							<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
            						<?php }else{ ?>
        								<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topseriesrow->sid, $readlatersids)) { ?>
        									<button onclick="unreadlater(<?php echo $topseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topseriesrow->sid;?>">
        									<i class="fa fa-check faicon<?php echo $topseriesrow->sid;?>"></i> Read later </button>
        								<?php }else { ?>
        									<button onclick="readlater(<?php echo $topseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topseriesrow->sid;?>">
        									<i class="fa fa-bookmark faicon<?php echo $topseriesrow->sid;?>"></i> Read later </button>
        								<?php } ?>
        							<?php } ?>
        							<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        								<span class=""><i class="fa fa-plus"></i></span>
        							</button>
        							<ul class="dropdown-menu list-inline  dropvk">
        								<li onclick="groupsuggest(<?php echo $topseriesrow->sid; ?>);">
        									<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
        								</li>
        								<li onclick="friend(<?php echo $topseriesrow->sid;?>);">
        									<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
        								</li>
        								<li onclick="socialshare(<?php echo $topseriesrow->sid;?>, 'series');">
        									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
        								</li>
        							</ul>
        						</div>
        					</div>        
        			    <?php } if($top_get_series->num_rows() >= 7){ ?>
        					<div class="card" style="justify-content: center">
        					    <a href="<?php echo base_url();?>series/top" style="padding: 150px 0px;">
            						<font class="max-lines" style="padding-left:52px">VIEW MORE</font>
            					</a>
        					</div>
    					<?php } ?>
				    </div>
			    </div>
                <?php if($top_get_series->num_rows() > 4){ ?>
    		        <button id="right-btn" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
    		    	<button id="left-btn" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
                <?php } else{ ?>
                    <button id="right-btn" style="visibility: hidden;" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
                    <button id="left-btn" style="visibility: hidden;" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
                <?php } ?>
		    <?php } ?>
		</div>	<!-- // Top SERIES end -->
		<div class="clear-fix"></div>
		
		
		<!--  Latest SERIES start-->
		<div class="main-container">
		    <?php if(isset($get_series) && ($get_series->num_rows() > 0)){ $divisioncount = $divisioncount + $get_series->num_rows(); ?>
    			<div class="titleindex" style="clear:both;">
    		        <span class="titlei">latest series</span>
    		        <?php if($get_series->num_rows() >= 7){ ?>
    		    	<a href="<?php echo base_url();?>series/latest">
    		    	    <span class="view pull-right">VIEW MORE</span>
    		    	</a>
    		    	<?php } ?>
    		    </div><hr>
    			<div id="StoryContls" class="StoryCont" style="text-align:left;">
    				<div id="story-sliderls" class="story-slider">
    					<?php foreach($get_series->result() as $seriesrow) { ?>
    						<div class="card">
    							<div class="book-type"><?php echo $seriesrow->gener;?></div>
    							<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->story_id);?>" class="imagess-style">
        							<?php if(isset($seriesrow->image) && !empty($seriesrow->image)) { ?>
        							    <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->image; ?>" alt="<?php echo $seriesrow->title;?>" class="imageme lazy">
        							<?php }else{ ?>
        								<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $seriesrow->title;?>" class="imageme lazy">
        							<?php } ?>
    							</a>
    							<div>
    								<font class="max-lines">
    									<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->story_id);?>">
    										<?php echo $seriesrow->title;?>
    									</a>
    								</font> 
    							</div>
    							<div class="flextest">
    								<font class="byname">By<font class="namehere"><a href="<?php echo base_url($seriesrow->profile_name);?>" style="color:#000"> <?php echo $seriesrow->name;?></a></font>
    								</font><br>
    							</div>
    							<div class="flextest" style="padding-top:4px;">
    								<font class="episodes">
    									<?php $keycount = get_episodecount($seriesrow->sid); 
    									    if(isset($keycount)){ echo $keycount; }else{ echo 0; } ?> EPISODES | 
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
    								<ul class="dropdown-menu list-inline  dropvk">
    									<li onclick="groupsuggest(<?php echo $seriesrow->sid; ?>);">
    										<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    									</li>
    									<li onclick="friend(<?php echo $seriesrow->sid;?>);">
    										<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    									</li>
    									<li onclick="socialshare(<?php echo $seriesrow->sid;?>, 'series');">
    										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
    									</li>
    								</ul>
    							</div>
    						</div>        
    					<?php } if($get_series->num_rows() >= 7) { ?>
    						<div class="card" style="justify-content: center">
    						    <a href="<?php echo base_url();?>series/latest" style="padding: 150px 0px;">
        							<font class="max-lines" style="padding-left:52px">VIEW MORE</font>
    							</a>
    						</div>
    					<?php } ?>
    				</div>
    			</div>
                <?php if($get_series->num_rows() > 4){ ?>
        			<button id="right-btnls" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
        			<button id="left-btnls" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i> </button>
                <?php } else{ ?>
                    <button id="right-btnls" style="visibility: hidden;" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
                    <button id="left-btnls" style="visibility: hidden;" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i> </button>
                <?php } ?>
		    <?php } ?>
		</div><!-- // Latest SERIES end-->
	    <div class="clear-fix"></div>
	    
	    
		<!--  TOP STORIES start-->
		<div class="main-container">
		    <?php if(isset($top_get_storys) && ($top_get_storys->num_rows() > 0)){ $divisioncount = $divisioncount + $top_get_storys->num_rows(); ?>
			<div class="titleindex" style="clear:both;">
    		    <span class="titlei">TOP STORIES</span>
    		    <?php if($top_get_storys->num_rows() >= 7){ ?>
    			<a href="<?php echo base_url();?>stories/top">
    			    <span class="view pull-right">VIEW MORE</span>
    			</a>
    			<?php } ?>
    		</div><hr>
			<div>
				<div id="StoryContts" class="StoryCont" style="text-align:left;">
					<div id="story-sliderts" class="story-slider">
					<?php foreach($top_get_storys->result() as $topstorysrow) { ?>
						<div class="card">
							<div class="book-type"><?php echo $topstorysrow->gener;?></div>
							<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $topstorysrow->title).'-'.$topstorysrow->sid);?>" class="imagess-style">
    							<?php if(isset($topstorysrow->image) && !empty($topstorysrow->image)) { ?>
    							    <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/images/<?php echo $topstorysrow->image; ?>" alt="<?php echo $topstorysrow->title;?>" class="imageme lazy">
    							<?php }else{ ?>
    								<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $topstorysrow->title;?>" class="imageme lazy">
    							<?php } ?>
							</a>
							<div>
								<font class="max-lines">
									<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $topstorysrow->title).'-'.$topstorysrow->sid);?>" class="product-title">
									    <?php echo $topstorysrow->title;?>
									</a>
								</font> 
							</div>
							<div class="flextest">
								<font class="byname">By<font class="namehere"><a href="<?php echo base_url($topstorysrow->profile_name);?>" style="color:#000"> <?php echo $topstorysrow->name;?></a></font>
							    </font><br>
							</div>
							<div class="flextest" style="padding-top:4px;">
								<font class = "episodes">
									<font>
										<?php $wordcount = explode(' ', $topstorysrow->story);
									        $time = round(sizeof($wordcount)/180);	?>
										<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $topstorysrow->views;?>&nbsp;</b></font>
									<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
										<b>
										<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
											foreach($reviews21->result() as $reviews2) { 
												if($reviews2->sid == $topstorysrow->sid) {
													echo round($reviews2->rating);
												}
										} } ?>
										</b>
									</font>
								</font><br>
							</div>
							<div class="flextest" style="padding-top:6px">
								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topstorysrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
									<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
								<?php }else{ ?>
									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topstorysrow->sid, $readlatersids)) { ?>
										<button onclick="unreadlater(<?php echo $topstorysrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topstorysrow->sid;?>">
										<i class="fa fa-check faicon<?php echo $topstorysrow->sid;?>"></i> Read later </button>
									<?php }else { ?>
										<button onclick="readlater(<?php echo $topstorysrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topstorysrow->sid;?>">
										<i class="fa fa-bookmark faicon<?php echo $topstorysrow->sid;?>"></i> Read later </button>
									<?php } ?>
								<?php } ?>
								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
									<span class=""><i class="fa fa-plus"></i></span>
								</button>
								<ul class="dropdown-menu list-inline  dropvk">
									<li onclick="groupsuggest(<?php echo $topstorysrow->sid; ?>);">
										<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
									</li>
									<li onclick="friend(<?php echo $topstorysrow->sid;?>);">
										<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
									</li>
									<li onclick="socialshare(<?php echo $topstorysrow->sid;?>, 'story');">
										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
									</li>
								</ul>
							</div>
						</div>
					<?php } if($top_get_storys->num_rows() >= 7){ ?>
						<div class="card" style="justify-content: center">
						    <a href="<?php echo base_url();?>stories/top" style="padding:150px 0px;">
    							<font class="max-lines" style="padding-left:52px">VIEW MORE</font>
    						</a>
						</div>
					<?php } ?>
					</div>
				</div>
                <?php if($top_get_storys->num_rows() > 4){ ?>
    				<button id="right-btnts" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
    				<button id="left-btnts" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
                <?php } else{ ?>
                    <button id="right-btnts" style="visibility: hidden;" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
                    <button id="left-btnts" style="visibility: hidden;" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
                <?php } ?>
			</div>
			<?php } ?>
		</div> <!-- // TOP STORIES end -->
		<div class="clear-fix"></div>
		
		<!--  LATEST STORIES start-->
		<div class="main-container">
		    <?php if(isset($get_storys) && ($get_storys->num_rows() > 0)){ $divisioncount = $divisioncount + $get_storys->num_rows(); ?>
		    <div class="titleindex" style="clear:both;">
    		    <span class="titlei">latest STORIES</span>
    		    <?php if($get_storys->num_rows() >= 7){ ?>
    			<a href="<?php echo base_url();?>stories/latest">
    			    <span class="view pull-right">VIEW MORE</span>
    			</a>
    			<?php } ?>
    		</div><hr>
		    <div>
		        <div id="StoryConttsl" class="StoryCont" style="text-align:left;">
    				<div id="story-slidertsl" class="story-slider">
    				<?php foreach($get_storys->result() as $storysrow) { ?>
    					<div class="card">
    						<div class="book-type"><?php echo $storysrow->gener;?></div>
    						<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $storysrow->title).'-'.$storysrow->sid);?>" class="imagess-style">
        						<?php if(isset($storysrow->image) && !empty($storysrow->image)) { ?>
        						    <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg"  data-src="<?php echo base_url();?>assets/images/<?php echo $storysrow->image; ?>" alt="<?php echo $storysrow->title;?>" class="imageme lazy">
        						<?php }else{ ?>
        							<img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $storysrow->title;?>" class="imageme lazy">
        						<?php } ?>
    						</a>
    						<div>
    							<font class="max-lines">
    								<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $storysrow->title).'-'.$storysrow->sid);?>" class="product-title">
    								    <?php echo $storysrow->title;?>
    								</a>
    							</font> 
    						</div>
    						<div class="flextest">
    							<font class="byname">By<font class="namehere"><a href="<?php echo base_url($storysrow->profile_name);?>" style="color:#000"> <?php echo $storysrow->name;?></a></font>
    						    </font><br>
    						</div>
    						<div class="flextest" style="padding-top:4px;">
    							<font class="episodes">
    								<font>
    									<?php $wordcount = explode(' ', $storysrow->story);
    					        	        $time = round(sizeof($wordcount)/180);	?>
    									<b><?php if($time == 0){ echo 1; }else{ echo $time; } ?></b> Min Story&nbsp;
    								</font>
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
    							<ul class="dropdown-menu list-inline  dropvk">
    								<li onclick="groupsuggest(<?php echo $storysrow->sid; ?>);">
    									<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    								</li>
    								<li onclick="friend(<?php echo $storysrow->sid;?>);">
    									<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    								</li>
    								<li onclick="socialshare(<?php echo $storysrow->sid;?>, 'story');">
    									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
    								</li>
    							</ul>
    						</div>
    					</div>
    				<?php } if($get_storys->num_rows() >= 7){ ?>
    					<div class="card" style="justify-content: center">
    					    <a href="<?php echo base_url();?>stories/latest" style="padding:150px 0px;">
        						<font class="max-lines" style="padding-left:52px">VIEW MORE</font>
        					</a>
    					</div>
    				<?php } ?>
    				</div>
			    </div>
		    </div>
            <?php if($get_storys->num_rows() > 4){ ?>
    	        <button id="right-btntsl" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i> </button>
    	    	<button id="left-btntsl" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i> </button>
            <?php } else{ ?>
                <button id="right-btntsl" style="visibility: hidden;" class="right-btn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i> </button>
                <button id="left-btntsl" style="visibility: hidden;" class="left-btn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i> </button>
            <?php } ?>
	    <?php } ?>
	    </div> <!-- // LATEST STORIES end-->
		<div class="clear-fix"></div>
		
		<!-- TOP LIFE EVENTS start-->
		<div class="main-container">
		<?php if(isset($top_get_life) && ($top_get_life->num_rows() > 0)){ $divisioncount = $divisioncount + $top_get_life->num_rows(); ?>
    		<div class="titleindex" style="clear:both;">
    		    <span class="titlei">TOP LIFE EVENTS</span>
    		    <?php if($top_get_life->num_rows() >= 5){ ?>
    			<a href="<?php echo base_url();?>lifeevents/top">
    			    <span class="view pull-right">VIEW MORE</span>
    			</a>
    			<?php } ?>
    		</div><hr>
		    <div id="StoryContl" class="StoryCont" >
				<div id="story-sliderl" class="story-slider" >
					<?php $i=0; foreach($top_get_life->result() as $topliferow) { if($i < 5){ ?>
						<div class="card1">
							<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $topliferow->title).'-'.$topliferow->sid);?>" class="imagelife-style">
    							<?php if(isset($topliferow->image) && !empty($topliferow->image)) { ?>
    								<img src="<?php echo base_url();?>assets/images/lazy-d266-j.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $topliferow->image; ?>" alt="<?php echo $topliferow->title;?>" class="imageme1 lazy">
    							<?php }else{ ?>
    								<img src="<?php echo base_url();?>assets/images/lazy-d266-j.jpg"  data-src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $topliferow->title;?>" class="imageme1 lazy">
    							<?php } ?>
						    </a>
							<div>
    							<font class="max-lines">
    								<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $topliferow->title).'-'.$topliferow->sid);?>">
    									<?php echo $topliferow->title;?>
    								</a>
    							</font> 
							</div>
							<div class="flextest">
								<?php if(($topliferow->writing_style == 'anonymous') && ($topliferow->type == 'life')){ ?>
									<font class="byname">By<font class="namehere"> Anonymous</font></font><br>
								<?php } else { ?>
									<font class="byname">By<font class="namehere"><a href="<?php echo base_url($topliferow->profile_name);?>" style="color:#000"> <?php echo $topliferow->name;?></a>
									    </font>
								    </font><br>
								<?php } ?>
							</div>
							<div class="flextest" style="padding-top:4px;">
								<font class="lifeEvents-text"><?php echo substr(strip_tags($topliferow->story),0,150);?></font>
							</div>
							<div class="flextest" style="padding-top:6px">
								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topliferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
									<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
								<?php }else{ ?>
									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topliferow->sid, $readlatersids)) { ?>
										<button onclick="unreadlater(<?php echo $topliferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topliferow->sid;?>">
										<i class="fa fa-check faicon<?php echo $topliferow->sid;?>"></i> Read later </button>
									<?php }else { ?>
										<button onclick="readlater(<?php echo $topliferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topliferow->sid;?>">
										<i class="fa fa-bookmark faicon<?php echo $topliferow->sid;?>"></i> Read later </button>
									<?php } ?>
								<?php } ?>
								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
									<span class=""><i class="fa fa-plus"></i></span>
								</button>
								<ul class="dropdown-menu list-inline dropvklife">
									<li onclick="groupsuggest(<?php echo $topliferow->sid; ?>);">
										<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
									</li>
									<li onclick="friend(<?php echo $topliferow->sid;?>);">
										<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
									</li>
									<li onclick="socialshare(<?php echo $topliferow->sid;?>, 'story');">
										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
									</li>
								</ul>
							</div>
						</div>
					<?php } $i++;}if($top_get_life->num_rows() >= 5) { ?>
						<div class="card1" style="justify-content: center">
						    <a href="<?php echo base_url();?>lifeevents/top" style="padding:140px 0px;">
    							<font class="max-lines" style=" text-align:center;">VIEW MORE</font>
    						</a>
						</div>
					<?php } ?>
				</div>
			</div>
            <?php if($top_get_life->num_rows() > 3) { ?>
        		<button id="right-btnl" class="right-btn right-btnl"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
    			<button id="left-btnl" class="left-btn right-btnl"><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
            <?php } else{ ?>
                <button id="right-btnl" style="visibility: hidden;" class="right-btn right-btnl"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
                <button id="left-btnl" style="visibility: hidden;" class="left-btn right-btnl"><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
            <?php } ?>
		<?php } ?>
		</div>
		<div class="clear-fix"></div><!-- TOP LIFE EVENTS end -->
		
		
		<!-- LATEST LIFE EVENTS start-->
		<div class="main-container">
		    <?php if(isset($get_life) && ($get_life->num_rows() > 0)){ $divisioncount = $divisioncount + $get_life->num_rows(); ?>
	        <div class="titleindex" style="clear:both;">
    		    <span class="titlei hidden-sm hidden-xs">Latest life events</span>
		        <span class="titlei hidden-md hidden-lg">New life events</span>
    		    <?php if($get_life->num_rows() >= 5){ ?>
    			<a href="<?php echo base_url();?>lifeevents/latest">
    			    <span class="view pull-right">VIEW MORE</span>
    			</a>
    			<?php } ?>
    		</div><hr>
		    <div id="StoryContll" class="StoryCont" >
			    <div id="story-sliderll" class="story-slider" >
					<?php $i = 0; foreach($get_life->result() as $liferow) { if($i < 5){ ?>
						<div class="card1">
							<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $liferow->title).'-'.$liferow->sid);?>" class="imagelife-style">
    							<?php if(isset($liferow->image) && !empty($liferow->image)) { ?>
    								<img src="<?php echo base_url();?>assets/images/lazy-d266-j.jpg"  data-src="<?php echo base_url();?>assets/images/<?php echo $liferow->image; ?>" alt="<?php echo $liferow->title;?>" class="imageme1 lazy">
    							<?php }else{ ?>
    								<img src="<?php echo base_url();?>assets/images/lazy-d266-j.jpg"  data-src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $liferow->title;?>" class="imageme1 lazy">
    							<?php } ?>
    						</a>
							<div>
    							<font class="max-lines">
    								<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u", '-', $liferow->title).'-'.$liferow->sid);?>">
    									<?php echo $liferow->title;?>
    								</a>
    							</font> 
							</div>
							<div class="flextest">
								<?php if(($liferow->writing_style == 'anonymous') && ($liferow->type == 'life')){ ?>
									<font class="byname">By<font class="namehere"> Anonymous</font></font><br>
								<?php } else { ?>
									<font class="byname">By<font class="namehere"><a href="<?php echo base_url($liferow->profile_name);?>" style="color:#000"> <?php echo $liferow->name;?></a>
									    </font>
									</font><br>
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
										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
									</li>
								</ul>
							</div>
						</div>
					<?php } $i++; } if($get_life->num_rows() >= 5){ ?>
						<div class="card1" style="justify-content: center">
						    <a href="<?php echo base_url();?>lifeevents/latest" style="padding:140px 0px;">
    							<font class="max-lines" style=" text-align:center;">VIEW MORE</font>
    						</a>
						</div>
					<?php } ?>
				</div>
		    </div>
            <?php if($get_life->num_rows() > 3){ ?>
    	        <button id="right-btnll" class="right-btn right-btnl"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
    		    <button id="left-btnll" class="left-btn right-btnl"><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
            <?php } else{ ?>
                <button id="right-btnll" style="visibility: hidden;" class="right-btn right-btnl"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
                <button id="left-btnll" style="visibility: hidden;" class="left-btn right-btnl"><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
	        <?php } ?>
            <?php } ?>
	    </div><!-- // LATEST LIFE EVENTS end-->
	    <div class="clear-fix"></div>
	    
	    
	    <!-- NANO STORIES start-->
		<div class="main-container">
		    <?php $nanolikes = array(); $nanolikes = get_storiesreadlater('nanolike');
		    if(isset($get_nano) && ($get_nano->num_rows() > 0)){ $divisioncount = $divisioncount + $get_nano->num_rows(); ?>
			<div class="titleindex" style="clear:both;">
    		    <span class="titlei">NANO STORIES</span>
		        <?php if($get_nano->num_rows() >= 5) { ?>
    			<a href="<?php echo base_url();?>shortstories">
    			    <span class="view pull-right">VIEW MORE</span>
    			</a>
    			<?php } ?>
    		</div><hr>
		    <div id="StoryContn" class="StoryCont">
				<div id="story-slidern" class="story-slider">
					<?php $j = 0; foreach($get_nano->result() as $nanorow) { if($j < 5){ ?>
						<div class="nano-stories">
							<div>
								<?php if(isset($nanorow->profile_image) && !empty($nanorow->profile_image)) { ?>
									<img src="<?php echo base_url();?>assets/images/<?php echo $nanorow->profile_image; ?>" class="circle-image" style="height:50px;" alt="<?php echo $nanorow->name;?>">
								<?php }else{ ?>
									<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" style="height:50px;" alt="<?php echo $nanorow->name;?>">
								<?php } ?>
								<h3 class="name-nanostories">
								    <a href="<?php echo base_url($nanorow->profile_name);?>" style="color:#000"><?php echo $nanorow->name;?></a>
								</h3>
							</div>
							<div>
								<hr style="width:100%; margin-top:12px;">
								<a href="javascript:void(0);" style="color:#000" data-toggle="modal" data-target="#modal-default<?php echo $nanorow->sid;?>">
								    <font class="text-in-nanostory" id="sharescreen<?php echo $nanorow->sid;?>" onclick="nanoviewsadd(<?php echo $nanorow->sid;?>);"><?php echo $nanorow->story; ?></font>
								</a>
							</div>
							<div class="lastdiv">
								<hr style="width:100%;">
								<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
								    if(isset($nanolikes) && in_array($nanorow->sid,$nanolikes)) { ?>
    								<font>
    								    <a href="javascript:void(0);" onclick="nanodislike(<?php echo $nanorow->sid;?>);" class="nanolike<?php echo $nanorow->sid;?>" title="Unlike">
    										<i class="fa fa-heart favbtn<?php echo $nanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
    									</a>
                                        <span class="nanolikecount<?php echo $nanorow->sid;?>"><?php echo $nanorow->nanolikecount;?></span>
    								</font>
    							    <?php } else { ?>
    							    <font>
    								    <a href="javascript:void(0);" onclick="nanolike(<?php echo $nanorow->sid;?>);" class="nanolike<?php echo $nanorow->sid;?>" title="like">
    										<i class="fa fa-heart-o favbtn<?php echo $nanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
    									</a>
    									<span class="nanolikecount<?php echo $nanorow->sid;?>"><?php echo $nanorow->nanolikecount;?></span>
    								</font>
    							    <?php } }else { ?>
    							    <font>
    								    <a href="javascript:void(0);" class="notloginmodal" title="like">
    										<i class="fa fa-heart-o" style="color:#f00; padding-top:5px;"></i>
    									</a>
    									<span><?php echo $nanorow->nanolikecount;?></span>
    								</font>
    							<?php } ?>
								<div style="float:right;color:#777">
									<a href="javascript:void(0);" class="dropdown-toggle text-muted" data-toggle="dropdown">
										<i class="fa fa-share-alt" aria-hidden="true"></i>
									</a>
									<ul class="dropdown-menu list-inline dropvknano">
    									<li onclick="groupsuggest(<?php echo $nanorow->sid; ?>);">
    										<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    									</li>
    									<li onclick="friend(<?php echo $nanorow->sid;?>);">
    										<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    									</li>
										<li onclick="socialshare(<?php echo $nanorow->sid;?>, 'nano');">
											<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
										</li>
									</ul>
								</div>
								<font style="float:right;color:#777">
								    <i class="fa fa-eye" aria-hidden="true"></i>
								    <b><span class="nanoviewcount<?php echo $nanorow->sid;?>"><?php echo $nanorow->views; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</font>
							</div>
						</div>
					<?php } $j++; } if($get_nano->num_rows() >= 5) {  ?>
					<div class="nano-stories" style="justify-content: center">
					    <a href="<?php echo base_url();?>shortstories" style="padding:168px 0px;">
    						<font class="max-lines" style=" text-align:center;">VIEW MORE</font>
    					</a>
					</div>
					<?php } ?>
				</div>
			</div>
            <?php if($get_nano->num_rows() > 3) { ?>
    			<button id="right-btnn" class="right-btn right-btnn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
    			<button id="left-btnn" class="left-btn left-btnn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
			<?php } else{ ?>
                <button id="right-btnn" style="visibility: hidden;" class="right-btn right-btnn"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
                <button id="left-btnn" style="visibility: hidden;" class="left-btn left-btnn" ><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
            <?php } ?>
            <?php } ?>
		</div>
			
		<?php if(isset($get_nano) && ($get_nano->num_rows() > 0)){ foreach($get_nano->result() as $nanomodalrow) { ?>
    		<div class="modal fade" id="modal-default<?php echo $nanomodalrow->sid;?>">
    			<div class="modal-dialog" style="max-width:500px;">
    				<div class="modal-content modal-nano" style="padding: 0px ;">
    					<div class="modal-header" style="padding:18px;border-bottom-color: #e5e5e5;">
    						<div class="">
    						    <?php if(isset($nanomodalrow->profile_image) && !empty($nanomodalrow->profile_image)) { ?>
									<img src="<?php echo base_url();?>assets/images/<?php echo $nanomodalrow->profile_image; ?>" class="user-image img-circle" style="height:50px;" alt="<?php echo $nanomodalrow->name;?>">
								<?php }else{ ?>
									<img src="<?php echo base_url();?>assets/images/2.png" class="img-circle" style="height:50px;" alt="<?php echo $nanomodalrow->name;?>">
								<?php } ?>
    							<h3 class="name-nanostories" style="margin-top: -45px; margin-left: 50px;">
    							    <a href="<?php echo base_url($nanomodalrow->profile_name);?>" style="color:#000"><?php echo $nanomodalrow->name;?></a>
    			                    <span class="pull-right">
    			                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:4px;">
                                	        <span aria-hidden="true">&times;</span>
                                        </button>
    			                    </span>
    			                </h3>
    						</div>
    					</div>
    					<div class="modal-body modal-bodyv" style="overflow-y:scroll;padding:15px">
    						<font class="text-in-nanostory-p" style="border-left:none; overflow-y:scroll;"><?php echo $nanomodalrow->story; ?></font>
    					</div>
    					<div class="modal-footer">
    						<ul class="list-inline">
    							<li class="text-muted pull-left" style="display:flex;">
    						        <?php if(isset($this->session->userdata['logged_in']['user_id'])){
    								    if(isset($nanolikes) && in_array($nanomodalrow->sid,$nanolikes)) { ?>
        								    <a href="javascript:void(0);" onclick="nanodislike(<?php echo $nanomodalrow->sid;?>);" class="nanolike<?php echo $nanomodalrow->sid;?>" title="Unlike">
        										<i class="fa fa-heart favbtn<?php echo $nanomodalrow->sid;?>" style="color:#f00; padding-right:3px;font-size:20px;"></i>
        									</a> &nbsp;
        									<span class="nanolikecount<?php echo $nanomodalrow->sid;?>" style="color:#000;"><?php echo $nanomodalrow->nanolikecount;?></span>
        								<?php } else { ?>
        								    <a href="javascript:void(0);" onclick="nanolike(<?php echo $nanomodalrow->sid;?>);" class="nanolike<?php echo $nanomodalrow->sid;?>" title="like">
        										<i class="fa fa-heart-o favbtn<?php echo $nanomodalrow->sid;?>" style="color:#f00; padding-right:3px;font-size:20px;"></i>
        									</a> &nbsp;
        									<span class="nanolikecount<?php echo $nanomodalrow->sid;?>" style="color:#000;"><?php echo $nanomodalrow->nanolikecount;?></span>
        							<?php } } else{ ?>
    								    <a href="javascript:void(0);" class="notloginmodal" title="like">
    										<i class="fa fa-heart-o favbtn<?php echo $nanomodalrow->sid;?>" style="color:#f00; padding-right:3px;font-size:20px;"></i>
    									</a> &nbsp;
    									<span class="nanolikecount<?php echo $nanomodalrow->sid;?>" style="color:#000;"><?php echo $nanomodalrow->nanolikecount;?></span>
        						    <?php } ?>
    							</li>
    							<li class="pull-right">
                                	<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                                    <ul class="dropdown-menu list-inline dropvknano1">
                                        <li onclick="groupsuggest(<?php echo $nanomodalrow->sid; ?>);">
										    <a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    									</li>
    									<li onclick="friend(<?php echo $nanomodalrow->sid;?>);">
    										<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    									</li>
										<li onclick="socialshare(<?php echo $nanomodalrow->sid;?>, 'nano');">
											<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
										</li>
                                    </ul>
                                </li>
    						</ul>
    					</div>
    				</div> <!-- /.modal-content -->
    			</div> <!-- /.modal-dialog -->
            </div> <!-- /.modal -->
        <?php } } ?><!-- // NANO STORIES end-->
		<div class="clear-fix"></div>
	    
	    <!-- WRITERS -->
        <div class="main-container">
            <?php if(isset($get_writer) && ($get_writer->num_rows() > 0)){ $divisioncount = $divisioncount + $get_writer->num_rows(); ?>
    	    <div class="titleindex" style="clear:both;">
    		    <span class="titlei">TOP WRITERS</span>
		        <?php if($get_writer->num_rows() >= 5){ ?>
    			<a href="<?php echo base_url();?>writers">
    			    <span class="view pull-right">VIEW MORE</span>
    			</a>
    			<?php } ?>
    		</div><hr>
                <div id="StoryContw" class="StoryCont" style="">
    	            <div id="story-sliderw" class="story-slider" >
    	            	<?php $i = 0; foreach($get_writer->result() as $writerrow) { if($i < 5){ ?>
    	            		<div class="card1" style="height:215px">
    	            		    <?php if(isset($writerrow->pbanner_image) && !empty($writerrow->pbanner_image)){ ?>
    					        <div class="imageme1 lazy" style="height:115px; " data-bg="url(<?php echo base_url();?>assets/images/<?php echo $writerrow->pbanner_image; ?>)">
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
    					        <?php }else{ ?>
    					        <div class="imageme1" style="height:115px; background-position:center; background: linear-gradient(-60deg,RoyalBlue,brown); background-size:cover">
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
                                        <?php }else{ ?>
                                            <?php if(isset($following) && in_array($writerrow->user_id, $following)) { ?>
                                                <button class="vjw btn btn-primary notloginmodal unfollow<?php echo $writerrow->user_id;?>" onclick="writerunfollow(<?php echo $writerrow->user_id;?>,'<?php echo $writerrow->name;?>')"> FOLLOWING </button>
                                            <?php }else{ ?>
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
    	            	<?php $i++; } }  if($get_writer->num_rows() >= 5){ ?>
						<div class="card1" style="justify-content: center">
						    <a href="<?php echo base_url();?>writers" style="padding:90px 0px;">
    							<font class="max-lines" style=" text-align:center;">VIEW MORE</font>
    						</a>
						</div>
					<?php } ?>
    	            </div>
                </div>
                <button id="right-btnw" class="right-btn right-btnw"><i class="fa fa-hand-o-right ic1 fa-2x" aria-hidden="true"></i></button>
    	        <button id="left-btnw" class="left-btn left-btnw"><i class="fa fa-hand-o-left ic1 fa-2x" aria-hidden="true"></i></button>
            <?php } ?>
	    </div> <!-- // WRITERS -->
	    <div class="clear-fix"></div>
	    
	    <div class="clear-fix"></div>
	    
	    
	    <?php if($divisioncount <= 0){ ?>
	        <center>
	        <div style="margin:10.8% auto">
	            <div style="width:150px;">
	                <img src="<?php echo base_url();?>assets/images/nodata.svg" class="img-responsive" style="width:100%;" alt="No Data">
	            </div>
	            <div style="font-family: arial,sans-serif;margin-top:5px;">NO STORIES FOUND</div>
	        </div>
	        </center>
	    <?php } ?>
	    </div>
	    <div class="main-container">
	        <div class="footer">
                <font style="float:left;font-size: 18px;margin-top: 8px;margin-left:10px;font-family: 'Varela Round', sans-serif;" class="copyright">
                    Copyright <i class="fa fa-copyright" aria-hidden="true" style="font-size:12px;"></i> 2018 Being Reader
                </font>
                <div class="socialbtns">
                    <a href="javascript:void(0);" class="socialshare"><i class="fa fa-facebook-square hover-tems" aria-hidden="true" style="margin-right:8px"></i></a>
                    <a href="javascript:void(0);" class="socialshare"><i class="fa fa-instagram hover-tems" aria-hidden="true" style="margin-right:6px"></i></a>
                    <a href="javascript:void(0);" class="socialshare"><i class="fa fa-twitter-square hover-tems" aria-hidden="true" style="margin-right:6px"></i></a>
                    <a href="javascript:void(0);" class="socialshare"><i class="fa fa-youtube-square hover-tems" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="footer1">
                <div style="font-size:14px;color:black;font-family: 'Varela Round', sans-serif;">
                    <center>
                        <font class="hover-tems"><a href="<?php echo base_url();?>about">ABOUT</a></font>
                        <font class="hover-tems"><a href="<?php echo base_url();?>contact">CONTACT</a></font>
                        <font class="hover-tems"><a href="<?php echo base_url();?>terms-conditions">TERMS</a></font>
                        <font class="hover-tems"><a href="<?php echo base_url();?>privacy-policy">PRIVACY</a></font>
                    </center>
                </div>
            </div>
	    </div>
    </section>
</div>

<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px; margin-bottom:-2px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="" style="padding-top:10px;">
				<div class="row">
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="facebookshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;margin-top:-8px;"/><p class="socialsharepopupspan">Facebook</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
					    <a href="javascript:void(0);" class="whatsappshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;margin-top:-8px;"/><p class="socialsharepopupspan">Whatsapp</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="twittershare socsh">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;margin-top:-8px;"/> <p class="socialsharepopupspan">Twitter</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')" class="socsh">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px;height:40px;margin-top:-8px;"/> <p class="socialsharepopupspan">Copy to link</p></a>
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


<script src="<?php echo base_url();?>assets/js/index.js"></script>
<!--<script src="/__/firebase/6.0.4/firebase-app.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/6.0.2/firebase-firestore.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
$(document).ready(function() {
    $("input[name='notificationtype']").change(function() {
    	var divenable = $(this).val();
    	if(divenable == 'group'){
    		$('#group').show();
    		$('#single').hide();
    	}else if(divenable == 'single') {
    		$('#group').hide();
    		$('#single').show();
    	}else{
    		$('#group').hide();
    		$('#single').hide();
    	}
    });
});
</script> 
<script type="text/javascript">
    $('#group').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>welcome/notification",
            data: $('#group').serialize(),
            dataType: 'json',
            success: function (data) {
               // console.log(data);
            	$('.ertitle').html(''); $('.ermessage').html('');
            	if(data.title) {
           		$('.ertitle').html("<span class='text-danger alert-danger'> Title Field Required. </span>");
           	}else if(data.message) {
           		 $('.ermessage').html("<span class='text-danger alert-danger'> Message Field Required. </span>");
           	}else if(data == 1){
                	alert("Group Notifications Sent Success");
                	window.location.reload();
                }else{
                	alert("Failed to Sent Group Notifications! Please try Again.");
                	window.location.reload();
                }
            },
            error: function (data) {
                alert("Failed to Sent Group Notifications! Please try Again.");
                window.location.reload();
            },
        });
    });
</script>-->
<script>
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
    });
</script>