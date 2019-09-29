<link rel="stylesheet" href="<?php echo base_url();?>assets/css/communities.css">

    <section class="content">
        <div class="container-fluid" style="justify-content:center;">
            <div class="row pd-0">
                <?php if(isset($joinedcommunities) && ($joinedcommunities->num_rows() > 0)) { ?>
        		<h3>MY COMMUNITIES</h3>
        		<hr>
        		<div class="jcm" style="display:flex; flex-wrap:wrap; justify-content:center;" id="jloadmoreall">
        		    <?php foreach($joinedcommunities->result() as $row) { ?>
        			  <div  style="display:flex; flex-wrap:wrap;justify-content:center;">
            			<div class="card-community" style="padding-bottom: 10px;">
                			<div class="box box-widget" style="border-radius:5px;">
                				<div class="box-body" style="padding:0px;">
                				    <a href="<?php echo base_url();?>community/<?php echo preg_replace("~[^\p{M}\w]+~u", '-', $row->gener);?>">
                				        <?php if(!empty($row->comm_image)){ ?>
                					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
                					    <?php } else{ ?>
                					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
                					    <?php } ?>
                					</a> 
                				</div>
                				<div class="box-footer box-comments" style="border-radius:0 0 5px 5px;">
                					<div class="box-comment">
                		                <div class="comment-text">
                		                    <a href="<?php echo base_url();?>community/<?php echo preg_replace("~[^\p{M}\w]+~u", '-', $row->gener);?>" style="float:left;">
                		                        <span class="username"><?php echo $row->gener; ?></span>
                		                    </a>
                		                    <?php if(isset($join_comm) && in_array($row->id, $join_comm)) { ?>
									            <button class="pull-right btn btn-primary notloginmodal unjoin<?php echo $row->id;?>" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')">JOINED</button>
									        <?php } ?>
                						</div>
                					</div>
                		        </div>
                			</div>
            			</div>
        		    </div>
        		    <?php } ?>
        		</div>
        		<div id="jload_data_message"></div>
        		<?php } ?>
        	</div>
        	<div class="row">
        		<?php if(isset($unjoinedcommunities) && ($unjoinedcommunities->num_rows() >0)){ ?>
        		<h3>FEATURED COMMUNITIES</h3>
        		<hr>
        		<div class="jcm" style="display:flex; flex-wrap:wrap; justify-content:center;" id="floadmoreall">
        			<?php foreach($unjoinedcommunities->result() as $row) { ?>
            			<div class="card-community" style="padding-bottom: 10px;">
                			<div class="box box-widget" style="border-radius:5px;">
                				<div class="box-body" style="padding:0px;">
            				        <?php if(!empty($row->comm_image)){ ?>
            					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="<?php echo $row->gener; ?>" style="height:200px; width:100%; border-radius:5px 5px 0 0;">
            					    <?php } else{ ?>
            					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
            					    <?php } ?>
                				</div>
                				<div class="box-footer box-comments" style="border-radius:0 0 5px 5px;">
                					<div class="">
                		                <div class="comment-text">
                		                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                		                	<form action="<?php echo base_url();?>communities_joinform" method="POST">
                							    <span class="username"> <?php echo $row->gener; ?>
                    								<input type="hidden" name="comm_id" value="<?php echo $row->id; ?>">
                    								<input type="hidden" name="gener" value="<?php echo $row->gener;?>">
                    							</span>
                    							<span style="float:right">
                    							    <button class="redvj pull-right btn btn-danger">JOIN</button>
                								</span>
                							</form>
                							<?php } else{ ?>
                							<span class="username"> <?php echo $row->gener; ?></span>
            								<span style="float:right;">
            								    <button class="redvj pull-right notloginmodal btn btn-danger">JOIN</button>
            								</span>
            								<?php } ?>
                						</div>
                					</div>
                		        </div>
                			</div>
            			</div>
        			<?php } ?>
        		</div>
        		<div id="fload_data_message"></div>
        		<?php } ?>
            </div>
            <?php if((!isset($joinedcommunities) || ($joinedcommunities->num_rows()==0)) && (!isset($unjoinedcommunities) || ($unjoinedcommunities->num_rows()==0))){ ?>
            <div class="row">
    			<?php if(isset($get_communities) && ($get_communities->num_rows() >0)){ ?>
    			<h3>COMMUNITIES</h3>
    			<hr>
        		<div class="jcm" style="display:flex; flex-wrap:wrap; justify-content:center;" id="loadmoreall">
        			<?php foreach($get_communities->result() as $row){ ?>
            			<div class="card-community" style="padding-bottom:">
                			<div class="box box-widget" style="border-radius:5px;">
                				<div class="box-body" style="padding:0px;">
                					<?php if(!empty($row->comm_image)){ ?>
            					    <img class="img-responsive lazy"  src="<?php echo base_url();?>assets/images/293-l.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="<?php echo $row->gener; ?>" style="height:200px; width:100%; border-radius:5px 5px 0 0;">
            					    <?php } else { ?>
            					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
            					    <?php } ?>
                				</div>
                				<div class="box-footer box-comments" style="border-radius:0 0 5px 5px;">
                					<div class="box-comment">
                		                <div class="comment-text">
                		                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                		                	<form action="<?php echo base_url();?>communities_joinform" method="POST">
                							    <span class="username"> <?php echo $row->gener; ?>
                    								<input type="hidden" name="comm_id" value="<?php echo $row->id; ?>">
                    								<input type="hidden" name="gener" value="<?php echo $row->gener;?>">
                    							</span>
                    							<span style="float:right;">	<button class="redvj pull-right btn btn-danger">JOIN</button>
                								</span>
                							</form>
                							<?php }else{ ?>
                							<span class="username"> <?php echo $row->gener; ?>
                							</span>
                							<span style="float:right;">
            								    <button class="redvj pull-right notloginmodal btn btn-danger">JOIN</button>
                							</span>
                							<?php } ?>
                						</div>
                					</div>
                		        </div>
                			  </div>
            			</div>
        			<?php } ?>
        		</div>
        		<div id="load_data_message"></div>
        	    <?php } ?>
            </div>
            <?php } ?>
        </div>
    </section>
<input type="hidden" id="sessionid" value="<?php if(isset($this->session->userdata['logged_in']['user_id'])){ echo $this->session->userdata['logged_in']['user_id']; }?>">    
    
    
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!--<script type="text/javascript">
$( document ).ready(function() {
	$("input[name='star']").click(function(){
		var rating = $(this).val();
		$.ajax({
			url: '<?php echo base_url();?>welcome/rating',
			method: 'POST',
			data: {'rating':rating,'sid':sid},
			dataType:'json',
			success: function(data){
				//alert(data);
				console.log('Rated success');
			}
		})
	});
});
</script> -->
<script>
function commuunjoin(comm_id, gener) { // community unjoin button 
    $.ajax({
		type :'POST',
		url :'<?php echo base_url(); ?>welcome/communities_join',
		data :{'comm_id':comm_id, 'gener':gener},
		dataType :"json",
		success:function(data){
		    if(data == 2){
		        $('button.unjoin'+comm_id).text('JOIN');
		        $('button.unjoin'+comm_id).removeClass('btn-success').addClass('btn-danger');
		        $('button.unjoin'+comm_id).attr('onclick','commujoin('+comm_id+',"'+gener+'")');
		        $('button.unjoin'+comm_id).removeClass('unjoin'+comm_id).addClass('join'+comm_id);
		        location.reload();
			    //alert('You Are Successfully Un Joined the Community.');
			}else{
			    alert('Failed to un join the Community.');
			}
		}
	});
}
</script>


<script>
    $(document).ready(function(){ // without login load more
        var limit = 8;
        var start = 8;
        var action = 'inactive';
        function load_country_data(limit, start) {
            var sessionid = $('#sessionid').val();
            if((sessionid == 0) || (sessionid == '') || (sessionid == 'undefined')){
                $.ajax({
                    url:'<?php echo base_url();?>welcome/loadcommunities',
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
    $(document).ready(function(){ // featured communities load more
        var flimit = 8;
        var fstart = 8;
        var faction = 'inactive';
        function fload_country_data(flimit, fstart) {
            var sessionid = $('#sessionid').val();
            if(sessionid){
                $.ajax({
                    url:'<?php echo base_url();?>welcome/floadcommunities',
                    method:"POST",
                    data:{limit:flimit, start:fstart},
                    cache:false,
                    success:function(data){
                        $('#floadmoreall').append(data);
                        if(data == '') {
                            $('#fload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                            faction = 'active';
                        }else{
                            $('#fload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                            faction = "inactive";
                        }
                    }
                });
            }
        }
        if(faction == 'inactive') {
            faction = 'active';
            fload_country_data(flimit, fstart);
        } 
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#floadmoreall").height() && faction == 'inactive'){
                faction = 'active';
                fstart = fstart + flimit;
                setTimeout(function(){fload_country_data(flimit, fstart);}, 500);
            }
        });
    });
</script>


<script>
    $(document).ready(function(){ //joined communities loadmore
        var jlimit = 8;
        var jstart = 8;
        var jaction = 'inactive';
        function jload_country_data(jlimit, jstart) {
            var sessionid = $('#sessionid').val();
            if(sessionid){
                $.ajax({
                    url:'<?php echo base_url();?>welcome/jloadcommunities',
                    method:"POST",
                    data:{limit:jlimit, start:jstart},
                    cache:false,
                    success:function(data){
                        $('#jloadmoreall').append(data);
                        if(data == '') {
                            $('#jload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'></div></center>");
                            jaction = 'active';
                        }else{
                            $('#jload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                            jaction = "inactive";
                        }
                    }
                });
            }
        }
        if(jaction == 'inactive') {
            jaction = 'active';
            jload_country_data(jlimit, jstart);
        } 
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#jloadmoreall").height() && jaction == 'inactive'){
                jaction = 'active';
                jstart = jstart + jlimit;
                setTimeout(function(){jload_country_data(jlimit, jstart);}, 500);
            }
        });
    });
</script>
<script>
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
    });
</script>