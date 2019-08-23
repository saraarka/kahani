<div class="box-header with-border" style="padding:0px;" id="tab3loadmore">
    <?php if(isset($notifications['suggestions']) && ($notifications['suggestions']->num_rows() >0)) {
	    foreach($notifications['suggestions']->result() as $suggestion) { 
            if($suggestion->type == 'suggestion') { ?>
                <div class="user-block">
                    <a href="#" data-toggle="modal" data-target="#sugnotifymodalp<?php echo $suggestion->id;?>">
    			    <?php if(!empty($suggestion->profile_image)) { ?>
    				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/<?php echo $suggestion->profile_image;?>" alt="<?php echo $suggestion->sname;?>">
    				<?php } else { ?> 
    				    <img class="user-blockvi" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $suggestion->sname;?>">
    				<?php } ?>
                    <span class="username">
                            <b> <?php echo $suggestion->sname;?> </b>
                        <span> suggested you a story </span>
                        <!--<a href="<?php echo base_url().$suggestion->redirect_uri;?>"> -->
                            <b><?php echo $suggestion->stitle;?></b>
                    </span></a>
                    <span class="description"><?php echo date("F j, Y g:i A", strtotime($suggestion->created_at));?></span>
                </div> <hr>
                
                <div id="sugnotifymodalp<?php echo $suggestion->id;?>" class="modal fade" role="dialog" style="padding-right: 0px!important;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="border:0">
                                <button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
                                <h4 class="modal-title">
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$suggestion->profile_name;?>">
                                    <b><?php echo $suggestion->sname;?> </b></a>suggested you a story 
                                    <b><?php echo $suggestion->stitle;?> </b>
                                </h4>
                            </div>
                            <div class="modal-body" style="padding-top:0;">
                                <!--<p><h5> Read the following Story, it consists of some eye opening facts. </h5></p><br>-->
                                <p style="margin:0;"><?php echo $suggestion->description;?></p>
                                <div style="margin-top:25px;">
                                    <center><a class="btn btn-primary" href="<?php echo base_url().$this->uri->segment(1).'/'.$suggestion->redirect_uri;?>">Open Link</a></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php } } } ?>
</div>
<div id="tab3load_data_message"></div>

<script>
    $(document).ready(function(){
        var tab3limit = 15;
        var tab3start = 15;
        var tab3action = 'inactive';
        function tab3load_country_data(tab3limit, tab3start) {
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/tab3loadnotifications',
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
            if ($(window).scrollTop() >= (($("#tab3loadmore").height() - $(window).height())*0.6) && tab3action == 'inactive'){
                tab3action = 'active';
                tab3start = tab3start + tab3limit;
                setTimeout(function(){tab3load_country_data(tab3limit, tab3start);}, 500);
            }
        });
    });
</script>