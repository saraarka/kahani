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
            <span style="color:#337ab7;font-size:16.2px;">
                <a href="<?php echo base_url().$comm_joinie->profile_name; ?>"><?php echo ucwords($comm_joinie->name);?></a></span>
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
<script>
$(document).ready(function(){
    var mlimit = 5;
    var mstart = 5;
    var maction = 'inactive';
    function mload_country_data(mlimit, mstart) {
        var commuid = "<?php echo $commuid;?>";
        $.ajax({
            url:'<?php echo base_url();?>welcome/memloadcommu/'+commuid,
            method:"POST",
            data:{limit:mlimit, start:mstart},
            cache:false,
            success:function(data){
                $('#mloadposts').append(data);
                if(data == '') {
                    $('#mload_data_message').html("<center><div class='col-md-12'> No More Results!</div></center>");
                    maction = 'active';
                }else{
                    $('#mload_data_message').html("<center><div class='col-md-12> Loading ...</div></center>");
                    maction = "inactive";
                }
            }
        });
    }
    if(maction == 'inactive') {
        maction = 'active';
        mload_country_data(mlimit, mstart);
    } 
    $('.modal-bodyv.mloadposts').scroll(function(){
        if ($('.modal-bodyv.mloadposts').scrollTop() >= (($("#mloadposts").height() - $('.modal-bodyv.mloadposts').height())*0.6) && maction == 'inactive'){
            maction = 'active';
            mstart = mstart + mlimit;
            setTimeout(function(){mload_country_data(mstart, mlimit);}, 10);
        }
    });
});
</script>