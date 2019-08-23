<div class="box-header with-border">
    <div class="row" style="margin:0 -10px;" id="fingloadmore">
        <?php if(isset($following_names) && ($following_names->num_rows() > 0)) {
        foreach($following_names->result() as $followingkey) { ?>
    		<div class="user-block" style="padding:0 10px; display:flex;">
    		    <span style="width:15%;">
    			    <?php if(isset($followingkey->profile_image) && !empty($followingkey->profile_image)) { ?>
    				    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followingkey->profile_image; ?>" alt="<?php echo $followingkey->name;?>">
    				<?php } else { ?>
    					<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followingkey->name;?>">
    				<?php } ?>
    			</span>
    		    <span  class="username" style="padding-top:8px;width:52%;margin-left:2px;">
    			    <a href="<?php echo base_url($this->uri->segment(1).'/'.$followingkey->profile_name);?>" style="margin-left:5px;" class="max-linesf">
    			        <?php echo substr($followingkey->name,0,15);?></a>
    		    </span>
    		    <span class="pull-right" style="width:33%;padding-top:6px;">
    		        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followingkey->user_id)){ ?>
                        <button class="pull-right vjw btn btn-success" onclick="yoursfollow()"> Follow </button>
                    <?php } else { ?>
                        <?php if(isset($following) && in_array($followingkey->user_id, $following)) { ?>
                            <button class="pull-right vjw btn btn-primary notloginmodal unfollow<?php echo $followingkey->user_id;?>" onclick="writerunfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOWING </button>
                        <?php } else { ?>
                            <button class="pull-right vjw btn btn-success notloginmodal follow<?php echo $followingkey->user_id;?>" onclick="writerfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOW </button>
                        <?php } ?>
                    <?php } ?>
    		    </span>
    		</div> <hr style="margin-bottom:8px;">
        <?php } } else { ?>
            <center> <h3> You do not following anyone </h3></center>
           <?php } ?>
    </div>
    <div id="fingload_data_message"></div>
</div>

<script>
    $(document).ready(function(){
        var finglimit = 5;
        var fingstart = 5;
        var fingaction = 'inactive';
        var userid = $('#profile_id').val();
        function fingload_country_data(finglimit, fingstart) {
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/fingloadmore',
                method:"POST",
                data:{limit:finglimit, start:fingstart, user_id: userid},
                cache:false,
                success:function(data){
                    $('#fingloadmore').append(data);
                    if(data == '') {
                        $('#fingload_data_message').html("<center><div class='col-md-12' style='padding-bottom:20px;'> No More Results!</div></center>");
                        fingaction = 'active';
                    }else{
                        $('#fingload_data_message').html("<center><div class='col-md-12' style='padding-bottom:20px;'> Loading ...</div></center>");
                        fingaction = "inactive";
                    }
                }
            });
        }
        if(fingaction == 'inactive') {
            fingaction = 'active';
            fingload_country_data(finglimit, fingstart);
        }
        $(".modal-bodyv").scroll(function() {
        //$(window).scroll(function(){
            if($(".modal-bodyv").scrollTop() + $(".modal-bodyv").height() + 50 > $("#fingloadmore").height() && fingaction == 'inactive'){
                fingaction = 'active';
                fingstart = fingstart + finglimit;
                setTimeout(function(){ fingload_country_data(finglimit, fingstart); }, 100);
           }
        });
    });
</script>