<?php if(isset($notifications['storynotifys']) && ($notifications['storynotifys']->num_rows() >0)) {
foreach($notifications['storynotifys']->result() as $storynotify) {
    if($storynotify->type == 'writerfollow') { ?>
        <div class="user-block" style="cursor:pointer;">
            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->profile_name;?>">
		    <?php if(!empty($storynotify->profile_image)){ ?>
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
			<?php } ?>
            <span class="username">
                    <b> <?php echo $storynotify->sname;?> </b> 
                <span> started following you.</span></span></a>
            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
        </div> <hr>
    <?php } elseif($storynotify->type == 'comment') { ?>
        <div class="user-block" style="cursor:pointer;">
            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$storynotify->redirect_uri;?>">
		    <?php if(!empty($storynotify->profile_image)){ ?>
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
			<?php } ?>
            <span class="username"><span> New episode </span>
                <b> <?php echo $storynotify->stitle;?> </b>
                <span> added to </span>
                <?php $seriesuri = '#'; $seriestitle = '';
                    if(isset($storynotify->title_id) && !empty($storynotify->title_id)){ 
                        $seriesname = get_seriesname($storynotify->title_id);
                        if(isset($seriesname[0]->title)){  $seriestitle = $seriesname[0]->title;  }
                        if(isset($seriesname[0]->sid) && !empty($seriesname[0]->sid)){
                        $seriesuri='index.php/welcome/new_series?id='.$seriesname[0]->sid.'&story_id='.$seriesname[0]->sid;
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else { ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else { ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else { ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
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
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $storynotify->profile_image;?>"> 
			<?php } else { ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
			<?php } ?>
            <span class="username">
                <b> <?php echo $storynotify->sname;?> </b>
                <span> shared your story </span>
                    <b> <?php echo $storynotify->stitle;?> </b><span> to </span>
                    <?php $commuri = '#'; $commname = ''; $communityname = get_commname($storynotify->title_id);
                        if(isset($communityname[0]->id) && !empty($communityname[0]->id)){
                            $commuri = 'index.php/welcome/co_view/'.$communityname[0]->id;  }
                        if(isset($communityname[0]->gener)){ $commname = $communityname[0]->gener; } ?>
                    <b> <?php echo $commname;?> </b>
                </span></a>
            <span class="description"><?php echo date("F j, Y g:i A", strtotime($storynotify->created_at));?></span>
        </div> <hr>
<?php } } } else if(isset($tab2['communitynotifys']) && ($tab2['communitynotifys']->num_rows() >0)) {
    foreach($tab2['communitynotifys']->result() as $communitynotify) {
    if( $communitynotify->type == 'communitystory') { ?>
    <div class="user-block" style="cursor:pointer;">
		<a href="<?php echo base_url().$this->uri->segment(1).'/'.$communitynotify->redirect_uri; ?>">
            <?php if(!empty($communitynotify->profile_image)){ ?>
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
			<?php } ?>
            <span class="username"><b> <?php echo $communitynotify->title;?> </b> <span> new story created by</span> <b><?php echo $communitynotify->from_name;?></b></span>
            <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
        </a>
    </div><hr>
<?php } elseif($communitynotify->type == 'communitycomment') { ?>
    <div class="user-block" style="cursor:pointer;">
		<a href="<?php echo base_url().$this->uri->segment(1).'/'.$communitynotify->redirect_uri; ?>">
            <?php if(!empty($communitynotify->profile_image)){ ?>
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
			<?php } ?>
            <span class="username"><b> <?php echo $communitynotify->title;?> </b> A Community Comment posted by <b> <?php echo $communitynotify->from_name;?></b></span>
            <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
        </a>
    </div>   <hr>
<?php } elseif($communitynotify->type == 'commustorylike') { ?>
    <div class="user-block" style="cursor:pointer;">
		<a href="<?php echo base_url().$this->uri->segment(1).'/'.$communitynotify->redirect_uri; ?>">
		    <?php if(!empty($communitynotify->profile_image)){ ?>
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>"> 
			<?php } else{ ?> 
			    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
			<?php } ?>
            <span class="username"><b> <?php echo $communitynotify->from_name;?></b> liked community post</span>
            <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
        </a>
    </div> <hr>
<?php } } } else if(isset($notifications['suggestions']) && ($notifications['suggestions']->num_rows() >0)) {
    foreach($notifications['suggestions']->result() as $suggestion) { 
        if($suggestion->type == 'suggestion') { ?>
            <div class="user-block" style="cursor:pointer;">
                <a href="#" data-toggle="modal" data-target="#sugnotifymodalp<?php echo $suggestion->id;?>">
			    <?php if(!empty($suggestion->profile_image)) { ?>
				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $suggestion->profile_image;?>"> 
				<?php } else { ?> 
				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png"> 
				<?php } ?>
                <span class="username">
                        <b> <?php echo $suggestion->sname;?> </b>
                    <span> suggested you a story </span>
                    <!--<a href="<?php echo base_url().$suggestion->redirect_uri;?>"> -->
                        <b><?php echo $suggestion->stitle;?></b>
                </span> </a>
                <span class="description"><?php echo date("F j, Y g:i A", strtotime($suggestion->created_at));?></span>
            </div> <hr>
            
            <div id="sugnotifymodalp<?php echo $suggestion->id;?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">
                                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$suggestion->profile_name;?>">
                                <b><?php echo $suggestion->sname;?> </b></a>suggested you a story 
                                <b><?php echo $suggestion->stitle;?> </b>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <p><h5> Read the following Story, it consists of some eye opening facts. </h5></p><br>
                            <p><?php echo $suggestion->description;?></p>
                            <center><a class="btn btn-primary" href="<?php echo base_url().$this->uri->segment(1).'/'.$suggestion->redirect_uri;?>">Open Link</a></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
<?php } } } ?>