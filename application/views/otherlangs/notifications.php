<link rel="stylesheet" href="<?php echo base_url();?>assets/css/notifications.css">

<div class="main-container">
    <div class="row mg-0 mgt"></div>
    <div class="" style="min-height:90vh;">
        <div class="">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" style="background: #23678e;">
                    <li class="active"><a href="#tab_1" data-toggle="tab"><b>GENERAL</b></a></li>
                    <li onclick="communitynotis()"><a href="#tab_2" data-toggle="tab"><b>COMMUNITY </b></a></li>
                    <li onclick="suggestnotis()"><a href="#tab_3" data-toggle="tab"><b>SUGGESTIONS</b></a></li>
                </ul>
                <div class="col-md-12" style="background:#fff;border-top:2px solid #ecf0f5;">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1" style="padding-top:8px;">
                            <div class="box-header with-border" style="padding:0px;" id="loadmoreall">
                                <?php if(isset($notifications['storynotifys']) && ($notifications['storynotifys']->num_rows() >0)) {
		                	    foreach($notifications['storynotifys']->result() as $storynotify) {
		                	        if($storynotify->type == 'writerfollow') { ?>
    		                	        <div class="user-block" style="cursor:pointer;">
    		                	            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->profile_name;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username"><b> <?php echo $storynotify->sname;?> </b> 
                                                <span> started following you.</span></span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'comment') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> commented on your story </span> 
                                                <b><?php echo $storynotify->stitle;?></b></span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'replycomment') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img  class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> replied to your comment in </span> 
                                                <b><?php echo $storynotify->stitle;?></b></span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'rating') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> rated your story </span> 
                                                <b><?php echo $storynotify->stitle;?></b></span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'nanolike') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->profile_name;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> liked your nanostory </span></span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'seriessubscribe') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> subscribed to your series </span>
                                                    <b><?php echo $storynotify->stitle;?></b>
                                                </span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'seriesepisode') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username"><span> New episode </span>
                                                <b> <?php echo $storynotify->stitle;?> </b>
                                                <span> added to </span>
                                                <?php $seriesuri = '#'; $seriestitle = '';
                                                    if(isset($storynotify->title_id) && !empty($storynotify->title_id)){ 
                                                        $seriesname = get_seriesname($storynotify->title_id);
                                                        if(isset($seriesname[0]->title)){  $seriestitle = $seriesname[0]->title;  }
                                                        if(isset($seriesname[0]->sid) && !empty($seriesname[0]->sid)){
                                                            if(isset($seriesname[0]->language) && ($seriesname[0]->language != 'en')){
                                                                $segmenturi = get_langfullname($seriesname[0]->language);
                                                                $seriesuri=$segmenturi.'/series/'.preg_replace('/\s+/', '-', $seriesname[0]->title).'-'.$seriesname[0]->sid.'/'.preg_replace('/\s+/', '-', $seriesname[0]->title).'-'.$seriesname[0]->story_id;
                                                            }else{
                                                                $seriesuri=$uri.'series/'.preg_replace('/\s+/', '-', $seriesname[0]->title).'-'.$seriesname[0]->sid.'/'.preg_replace('/\s+/', '-', $seriesname[0]->title).'-'.$seriesname[0]->story_id;
                                                            }
                                                        }
                                                    } ?>
                                                    <b><?php echo $seriestitle;?></b>
                                                </span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'startseries') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> started a new series </span>
                                                    <b><?php echo $storynotify->stitle;?></b>
                                                </span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'newstory') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> published a new story </span>
                                                    <b><?php echo $storynotify->stitle;?></b>
                                                </span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'newnano') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->profile_name;?>">
        	                			    <?php if(!empty($storynotify->profile_image)){ ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else{ ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> published a new nanostory </span></span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'favorite') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)) { ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else { ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> favorited your story </span>
                                                    <b><?php echo $storynotify->stitle;?></b>
                                                </span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'procomment') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->profile_name;?>">
        	                			    <?php if(!empty($storynotify->profile_image)) { ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else { ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> commented on your profile </span></span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'proreplycomment') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->profile_name;?>">
        	                			    <?php if(!empty($storynotify->profile_image)) { ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else { ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> replied on your profile comment </span></span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } elseif($storynotify->type == 'groupsuggestion') { ?>
                                        <div class="user-block" style="cursor:pointer;">
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
        	                			    <?php if(!empty($storynotify->profile_image)) { ?>
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } else { ?> 
        	                				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storynotify->sname;?>">
        	                				<?php } ?>
                                            <span class="username">
                                                <b> <?php echo $storynotify->sname;?> </b>
                                                <span> shared your story </span>
                                                    <b> <?php echo $storynotify->stitle;?> </b><span> to </span>
                                                    <?php $commuri = '#'; $commname = ''; $communityname = get_commname($storynotify->title_id);
                                                        if(isset($communityname[0]->id) && !empty($communityname[0]->id)){
                                                            $commuri = 'co_view/'.$communityname[0]->id;  }
                                                        if(isset($communityname[0]->gener)){ $commname = $communityname[0]->gener; } ?>
                                                    <b> <?php echo $commname;?> </b>
                                                </span></a>
                                            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
                                        </div> <hr>
                                    <?php } } ?>
                                <?php } ?>
                            </div>
                            <div id="load_data_message"></div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2" style="padding-top:8px;">
                            <div style="margin-top:25px; margin-bottom: 30px;"><center>
                		        <img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner"></center>
                		    </div>
                        </div>
                        <div class="tab-pane" id="tab_3" style="padding-top:8px;">
                            <div style="margin-top:25px; margin-bottom: 30px;"><center>
                		        <img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner"></center>
                		    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function communitynotis(){
        $.ajax({
    		url: "<?php echo base_url().$this->uri->segment(1);?>/communitynotis",
    		type: 'POST',
    		success: function (resultdata) {
                $('#tab_2').html(resultdata);
    		}
	    });
    }
    function suggestnotis(){
        $.ajax({
    		url: "<?php echo base_url().$this->uri->segment(1);?>/suggestnotis",
    		type: 'POST',
    		success: function (resultdata) {
                $('#tab_3').html(resultdata);
    		}
	    });
    }
    
    $(document).ready(function(){
        var limit = 15;
        var start = 15;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/loadnotifications',
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
            if ($(window).scrollTop() >= (($("#loadmoreall").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 500);
            }
        });
    });
</script>