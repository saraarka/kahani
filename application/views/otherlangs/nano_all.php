<link rel="stylesheet" href="<?php echo base_url();?>assets/css/nanoall.css">

<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="main-container1">
		    <div class="row pt-0">
		        <?php if(isset($top_get_nano_all) && ($top_get_nano_all->num_rows() > 0)){ ?>
		    	<div class="col-md-6 col-xs-12 pd-0">
		    		<div class="titlei">Nano Stories</div>
		    	</div>
		    </div>
		    <hr>
		    <div style="display:flex; flex-wrap:wrap;" class="vhw">
				<?php foreach($top_get_nano_all->result() as $nanorow) { ?>
					<div class="nano-stories">
					    <div>
							<?php if(isset($nanorow->profile_image) && !empty($nanorow->profile_image)) { ?>
								<img src="<?php echo base_url();?>assets/images/<?php echo $nanorow->profile_image; ?>" class="circle-image" style="height:50px;" alt="<?php echo $nanorow->name;?>">
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/dist/img/photo1.png" class="circle-image" style="height:50px;" alt="<?php echo $nanorow->name;?>">
							<?php } ?>
							<h3 class="name-nanostories">
							    <a href="<?php echo base_url($this->uri->segment(1).'/'.$nanorow->profile_name);?>" style="color:#000"><?php echo $nanorow->name;?></a>
							    <span style="float:right;">
			                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			                            <i class="fa fa-ellipsis-v" style="font-size:14px;"></i>
			                        </a>
			                        <ul class="dropdown-menu" style="top:50px; float:right; left: 127px;">
			                            <li><a href="javascript:void(0);" onClick=""><i class="fa fa-exclamation-triangle"></i> Report</a></li>
			                        </ul>
			                    </span>
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
							<font style="color:#777" onclick="nanolike(<?php echo $nanorow->sid;?>);">
							    <b class="nanolike<?php echo $nanorow->sid;?>">
							        <span class="nanolikecount<?php echo $nanorow->sid;?>"><?php echo $nanorow->nanolikecount;?></span>
							    </b> 
							    <a href="javascript:void(0);" <?php if(isset($nanolikes) && in_array($nanorow->sid,$nanolikes)){ }else{ echo 'style="color:#777"'; } ?>>
							    <i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</font>
							<div style="float:right;color:#777">
								<a href="javascript:void(0);" class="dropdown-toggle text-muted" data-toggle="dropdown">
									<i class="fa fa-share-alt" aria-hidden="true"></i>
								</a>
								<ul class="dropdown-menu list-inline dropvknano">
									<li onclick="groupsuggest(<?php echo $nanorow->sid; ?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
									</li>
									<li onclick="friend(<?php echo $nanorow->sid;?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
									</li>
									<li onclick="socialshare(<?php echo $nanorow->sid;?>, 'nano');">
										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
									</li>
								</ul>
							</div>
							<font style="float:right;color:#777">
							    <i class="fa fa-eye" aria-hidden="true"></i>
							    <b><span class="nanoviewcount<?php echo $nanorow->sid;?>"><?php echo $nanorow->views; ?></span></b>&nbsp;&nbsp;
							</font>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php } ?>
    	</div>
    </section>
</div>

<!-- Social Popup ---- -->
	<div class="modal fade" id="soc">
		<div class="modal-dialog" style="width:270px;margin:10px auto;">
			<div class="modal-content socv">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Social Media Share</h4>
				</div>
				<div class="modal-body" style="padding: 5px 15px;">
					<div class="row">
						<div class="col-md-12 border-bottom">
							<a class="btn btn-primary btn-social-icon btn-facebook" style="width:45px; height:45px; border-radius: 50%;"><i class="fa fa-facebook" style="font-size: 25px;padding-top: 5px;"></i></a> FACEBOOK
						</div>
						<div class="col-md-12 border-bottom">
							<a class="btn btn-success btn-social-icon btn-google-plus" style="width:45px; height:45px; border-radius: 50%;"><i class="fa fa-whatsapp"  style="font-size: 25px;padding-top: 5px;"></i></a> WHATSAPP
						</div>
						<div class="col-md-12 border-bottom">
							<a class="btn btn-info btn-social-icon btn-twitter" style="width:45px; height:45px; border-radius: 50%;"><i class="fa fa-twitter" style="font-size: 25px;padding-top: 5px;"></i></a> TWITTER
						</div>
						<div class="col-md-12 border-bottom-none">
							<a class="btn btn-default btn-social-icon btn-twitter" style="width:45px; height:45px; border-radius: 50%;"><i class="fa fa-link" style="font-size: 25px;padding-top: 5px;"></i></a> COPY LINK
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
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code ----------- -->
<!-- frind popup code ------>
<div class="modal fade" id="friendsuggest" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttofriend"></div>
		</div>
	</div>
</div>
<!--frind popup end ------------->

<script>
$(function () { // Gener show More
    $('span.cardmore').click(function () {
        $('ul.card li').slideDown("slow");
        $('span.cardmore').hide();
    });
});
</script>

<!-- END STORIES -->


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
    }
</script>
