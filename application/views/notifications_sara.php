<link rel="stylesheet" href="<?php echo base_url();?>assets/css/notifications.css">

<div class="main-container">
    <div class="row mg-0 mgt"></div>
    <div class="" style="min-height:90vh;">
        <div class="">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" style="background: #23678e;">
                     <li class="active"><a href="#tab_1" data-toggle="tab"><b>General</b></a></li>
                     <li><a href="#tab_2" data-toggle="tab"><b>Community </b></a></li>
                     <li><a href="#tab_3" data-toggle="tab"><b>Suggestions</b></a></li>
                </ul>
                <div class="col-md-12" style="background:#fff;border-top:2px solid #ecf0f5;">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1" style="padding-top:8px;">
                            <div class="box-header with-border" style="padding:0px;" id="loadmoreall">
                                <?php if(isset($notifications['storynotifys']) && ($notifications['storynotifys']->num_rows() >0)) {
		                	    foreach($notifications['storynotifys']->result() as $storynotify) {
		                	        if($storynotify->type == 'writerfollow') { ?>
    		                	        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                    <b> <?php echo $storynotify->sname;?> </b> </a>
                                                <span> started following you.</span></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'comment') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> commented on your story </span> 
                                                <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                <b><?php echo $storynotify->stitle;?></b></a></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'replycomment') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> replied to your comment in </span> 
                                                <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                <b><?php echo $storynotify->stitle;?></b></a></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'rating') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> rated your story </span> 
                                                <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                <b><?php echo $storynotify->stitle;?></b></a></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'nanolike') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> liked your nanostory </span></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'seriessubscribe') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> subscribed to your series </span>
                                                <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                    <b><?php echo $storynotify->stitle;?></b></a>
                                                </span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'seriesepisode') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username"><span> New episode </span>
                                                <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                <b> <?php echo $storynotify->stitle;?> </b></a>
                                                <span> added to </span>
                                                <?php $seriesuri = '#'; $seriestitle = '';
                                                    if(isset($storynotify->title_id) && !empty($storynotify->title_id)){ 
                                                        $seriesname = get_seriesname($storynotify->title_id);
                                                        if(isset($seriesname[0]->title)){  $seriestitle = $seriesname[0]->title;  }
                                                        if(isset($seriesname[0]->sid) && !empty($seriesname[0]->sid)){
                                                        $seriesuri='new_series?id='.$seriesname[0]->sid.'&story_id='.$seriesname[0]->sid;
                                                        }
                                                    } ?>
                                                <a href="<?php echo base_url().$seriesuri;?>">
                                                    <b><?php echo $seriestitle;?></b></a>
                                                </span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'startseries') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> started a new series </span>
                                                <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                    <b><?php echo $storynotify->stitle;?></b></a>
                                                </span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'newstory') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> published a new story </span>
                                                <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                    <b><?php echo $storynotify->stitle;?></b></a>
                                                </span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'newnano') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else{ ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> published a new nanostory </span></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'favorite') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)) { ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else { ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> favorited your story </span>
                                                <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                    <b><?php echo $storynotify->stitle;?></b></a>
                                                </span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'procomment') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)) { ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else { ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> commented on your profile </span></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'proreplycomment') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)) { ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else { ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> replied on your profile comment </span></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'groupsuggestion') { ?>
                                        <div class="user-block" style="cursor:pointer;">
        	                			    <?php if(!empty($storynotify->profile_image)) { ?>
        	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
        	                				<?php } else { ?> 
        	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
        	                				<?php } ?>
                                            <span class="username">
                                                <a href="<?php echo base_url();?>profile?id=<?php echo $storynotify->suserid;?>">
                                                <b> <?php echo $storynotify->sname;?> </b></a>
                                                <span> shared your story </span>
                                                    <a href="<?php echo base_url().$storynotify->redirect_uri;?>">
                                                        <b> <?php echo $storynotify->stitle;?> </b></a><span> to </span>
                                                        <?php $commuri = '#'; $commname = ''; $communityname = get_commname($storynotify->title_id);
                                                            if(isset($communityname[0]->id) && !empty($communityname[0]->id)){
                                                                $commuri = 'co_view/'.$communityname[0]->id;  }
                                                            if(isset($communityname[0]->gener)){ $commname = $communityname[0]->gener; } ?>
                                                    <a href="<?php echo base_url().$commuri;?>">
                                                        <b> <?php echo $commname;?> </b></a>
                                                </span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } } ?>
                                <?php } ?>
                            </div>
                            <div id="load_data_message"></div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2" style="padding-top:8px;">
                            <div class="box-header with-border" style="padding:0px;" id="tab2loadmore">
                                <?php if(isset($notifications['communitynotifys']) && ($notifications['communitynotifys']->num_rows() >0)) {
        	    	                foreach($notifications['communitynotifys']->result() as $communitynotify) { 
        	    	                if( $communitynotify->type == 'communitystory') { ?>
                                    <div class="user-block">
                            			<a href="<?php echo base_url().$communitynotify->redirect_uri; ?>">
                				            <?php if(!empty($communitynotify->profile_image)){ ?>
                            				    <img src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>"> 
                            				<?php } else{ ?> 
                            				    <img src="<?php echo base_url();?>assets/images/2.png"> 
                            				<?php } ?>
                                            <span class="username"><b> <?php echo $communitynotify->title;?> </b> <span style="color:#000;font-weight:200;"> new story created by</span> <b><?php echo $communitynotify->from_name;?></b></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
                                        </a>
                                    </div><hr>
                                <?php } elseif($communitynotify->type == 'communitycomment') { ?>
                                    <div class="user-block">
                            			<a href="<?php echo base_url().$communitynotify->redirect_uri; ?>">
            					            <?php if(!empty($communitynotify->profile_image)){ ?>
                            				    <img src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>"> 
                            				<?php } else{ ?> 
                            				    <img src="<?php echo base_url();?>assets/images/2.png"> 
                            				<?php } ?>
                                            <span class="username"><b> <?php echo $communitynotify->title;?> </b> A Community Comment posted by <b> <?php echo $communitynotify->from_name;?></b></span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
                                        </a>
                                    </div>   <hr>
                                <?php } elseif($communitynotify->type == 'commustorylike') { ?>
                                    <div class="user-block">
                            			<a href="<?php echo base_url().$communitynotify->redirect_uri; ?>">
            							    <?php if(!empty($communitynotify->profile_image)){ ?>
                            				    <img src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>"> 
                            				<?php } else{ ?> 
                            				    <img src="<?php echo base_url();?>assets/images/2.png"> 
                            				<?php } ?>
                                            <span class="username"><b> <?php echo $communitynotify->from_name;?></b> liked community post</span>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
                                        </a>
                                    </div> <hr>
                                <?php } } } ?>
                            </div>
                            <div id="tab2load_data_message"></div>
                        </div>
                        <div class="tab-pane" id="tab_3" style="padding-top:8px;">
                            <div class="box-header with-border" style="padding:0px;" id="tab3loadmore">
                                <?php if(isset($notifications['suggestions']) && ($notifications['suggestions']->num_rows() >0)) {
        	                	    foreach($notifications['suggestions']->result() as $suggestion) { 
                                        if($suggestion->type == 'suggestion') { ?>
                                            <div class="user-block">
            	                			    <?php if(!empty($suggestion->profile_image)) { ?>
            	                				    <img src="<?php echo base_url();?>assets/images/<?php echo $suggestion->profile_image;?>"> 
            	                				<?php } else { ?> 
            	                				    <img src="<?php echo base_url();?>assets/images/2.png"> 
            	                				<?php } ?>
                                                <span class="username">
                                                    <a href="<?php echo base_url();?>profile?id=<?php echo $suggestion->suserid;?>">
                                                        <b> <?php echo $suggestion->sname;?> </b>
                                                    </a>
                                                    <span> suggested you a story </span>
                                                    <!--<a href="<?php echo base_url().$suggestion->redirect_uri;?>"> -->
                                                    <a href="#" data-toggle="modal" data-target="#sugnotifymodalp<?php echo $suggestion->id;?>">
                                                        <b><?php echo $suggestion->stitle;?></b>
                                                    </a>
                                                </span>
                                                <span class="description"><?php echo date("F j, Y g:i A", strtotime($suggestion->created_at));?></span>
                                            </div> <hr>
                                            
                                            <div id="sugnotifymodalp<?php echo $suggestion->id;?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">
                                                                <a href="<?php echo base_url();?>profile?id=<?php echo $suggestion->suserid;?>">
                                                                <b><?php echo $suggestion->sname;?> </b></a>suggested you a story 
                                                                <b><?php echo $suggestion->stitle;?> </b>
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><h5> Read the following Story, it consists of some eye opening facts. </h5></p><br>
                                                            <p><?php echo $suggestion->description;?></p>
                                                            <center><a class="btn btn-primary" href="<?php echo base_url().$suggestion->redirect_uri;?>">Open Link</a></center>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php } } } ?>
                            </div>
                            <div id="tab3load_data_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var limit = 15;
        var start = 15;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/welcome/loadnotifications',
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
            if($(window).scrollTop() + $(window).height() > $("#loadmoreall").height() && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 500);
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        var tab2limit = 15;
        var tab2start = 15;
        var tab2action = 'inactive';
        function tab2load_country_data(tab2limit, tab2start) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/welcome/tab2loadnotifications',
                method:"POST",
                data:{limit:tab2limit, start:tab2start},
                cache:false,
                success:function(data){
                    $('#tab2loadmore').append(data);
                    if(data == '') {
                        $('#tab2load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        tab2action = 'active';
                    }else{
                        $('#tab2load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        tab2action = "inactive";
                    }
                }
            });
        }
        if(tab2action == 'inactive') {
            tab2action = 'active';
            tab2load_country_data(tab2limit, tab2start);
        } 
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#tab2loadmore").height() && tab2action == 'inactive'){
                tab2action = 'active';
                tab2start = tab2start + tab2limit;
                setTimeout(function(){tab2load_country_data(tab2limit, tab2start);}, 500);
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        var tab3limit = 15;
        var tab3start = 15;
        var tab3action = 'inactive';
        function tab3load_country_data(tab3limit, tab3start) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/welcome/tab3loadnotifications',
                method:"POST",
                data:{limit:tab3limit, start:tab3start},
                cache:false,
                success:function(data){
                    $('#tab3loadmore').append(data);
                    if(data == '') {
                        $('#tab3load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        tab3action = 'active';
                    }else{
                        $('#tab3load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        tab3action = "inactive";
                    }
                }
            });
        }
        if(tab3action == 'inactive') {
            tab3action = 'active';
            tab3load_country_data(tab3limit, tab3start);
        } 
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#tab3loadmore").height() && tab3action == 'inactive'){
                tab3action = 'active';
                tab3start = tab3start + tab3limit;
                setTimeout(function(){tab3load_country_data(tab3limit, tab3start);}, 500);
            }
        });
    });
</script>