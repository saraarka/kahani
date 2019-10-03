<div class="box-header with-border" style="padding:0px;" id="tab2loadmore">
    <?php if(isset($notifications['communitynotifys']) && ($notifications['communitynotifys']->num_rows() >0)) {
        foreach($notifications['communitynotifys']->result() as $communitynotify) { 
        if( $communitynotify->type == 'communitystory') { ?>
        <div class="user-block">
			<a href="<?php echo base_url().$this->uri->segment(1).'/'.$communitynotify->redirect_uri; ?>">
	            <?php if(!empty($communitynotify->profile_image)){ ?>
				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>" alt="<?php echo $communitynotify->sname;?>">
				<?php } else{ ?> 
				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $communitynotify->sname;?>">
				<?php } ?>
                <span class="username"><b> <?php echo $communitynotify->title;?> <span> new story created by</span> <?php echo $communitynotify->from_name;?></b></span>
                <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
            </a>
        </div><hr>
    <?php } elseif($communitynotify->type == 'communitycomment') { ?>
        <div class="user-block">
			<a href="<?php echo base_url().$this->uri->segment(1).'/'.$communitynotify->redirect_uri; ?>">
	            <?php if(!empty($communitynotify->profile_image)){ ?>
				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>" alt="<?php echo $communitynotify->sname;?>">
				<?php } else{ ?> 
				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $communitynotify->sname;?>">
				<?php } ?>
                <span class="username"><b> <?php echo $communitynotify->title;?> </b> A Community Comment posted by <b> <?php echo $communitynotify->from_name;?></b></span>
                <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
            </a>
        </div>   <hr>
    <?php } elseif($communitynotify->type == 'commustorylike') { ?>
        <div class="user-block">
			<a href="<?php echo base_url().$this->uri->segment(1).'/'.$communitynotify->redirect_uri; ?>">
			    <?php if(!empty($communitynotify->profile_image)){ ?>
				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $communitynotify->profile_image;?>" alt="<?php echo $communitynotify->sname;?>">
				<?php } else{ ?> 
				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $communitynotify->sname;?>">
				<?php } ?>
                <span class="username"><b> <?php echo $communitynotify->from_name;?></b> liked community post</span>
                <span class="description"><?php echo date("F j, Y g:i A", strtotime($communitynotify->created_at));?></span>
            </a>
        </div> <hr>
    <?php } } } ?>
</div>
<div id="tab2load_data_message"></div>

<script>
    $(document).ready(function(){
        var tab2limit = 15;
        var tab2start = 15;
        var tab2action = 'inactive';
        function tab2load_country_data(tab2limit, tab2start) {
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/tab2loadnotifications',
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
            if ($(window).scrollTop() >= (($("#tab2loadmore").height() - $(window).height())*0.6) && tab2action == 'inactive'){
                tab2action = 'active';
                tab2start = tab2start + tab2limit;
                setTimeout(function(){tab2load_country_data(tab2limit, tab2start);}, 500);
            }
        });
    });
</script>