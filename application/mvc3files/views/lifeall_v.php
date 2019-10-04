<style>
.wv{
    max-width:950px;
    margin-left:50px;
}
ol, ul {
    margin-top: 0;
    margin-bottom: -2px;
}
/*webkit-box-shadow:0 1px 1px rgba(0,0,0,0.1);box-shadow:0 1px 1px rgba(0,0,0,0.1);*/
.products-list>.item{border-radius:3px;padding:5px 0;background:#fff}
@media (min-width: 1020px){
    .sidebar-toggle{
        display:none
    }
}
blockquote {
    padding: 0px 8px;
    margin: 0 0 20px;
    font-size: 14px;
    border-left: 5px solid #eee;
}
.tooltipv {
    position: relative;
    display: inline-block;
    cursor: pointer;
     color:#000;
}
.tooltipv .tooltipvtext {
    visibility: hidden;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
}
.tooltipv:hover .tooltipvtext {
    visibility: visible;
}
ul.card li:nth-child(n+6) {
    display:none;
}
</style>
<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content wv"> <br>
        <div class="row">
		    <?php if(isset($top_get_life) && ($top_get_life->num_rows() > 0)){ ?>
			<div class="col-md-12">
				<h2>TOP LIFE EVENTS</h2>
			</div>
			<?php foreach($top_get_life->result() as $topliferow) { ?>
			<div class="col-md-4 item1 cardevents jQueryEqualHeight7">
			<!-- Widget: user widget style 1 -->
				<div class="card box box-widget widget-user vjc1">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<a href="<?php echo base_url('index.php/Welcome/only_story_view?id='.$topliferow->sid);?>" style="color:#000;">
					    <?php $bgimage = base_url().'assets/dist/img/photo1.png';
					        if(isset($topliferow->cover_image) && !empty($topliferow->cover_image)) {
					            $bgimage = base_url().'assets/images/'.$topliferow->cover_image;
					   } ?>
						<div class="widget-user-header bg-black" style="background: url('<?php echo $bgimage;?>') center center;">
						</div>
					</a>
					<div class="card-body box-footer">
						<div class="row">
							<div class="col-sm-12">
								<ul class="products-list product-list-in-box">
									<li class="item">
										<div class="card-title">
											<a href="<?php echo base_url('index.php/welcome/only_story_view?id='.$topliferow->sid);?>" class="product-title">
										        <?php echo $topliferow->title;?></a>
										</div>
										<div class="card-text product-description">
											<?php if(($topliferow->writing_style == 'anonymous') && ($topliferow->type == 'life')){ ?>
											    By <span style="color:black;"><b>Anonymous</b></span>
											<?php } else { ?>
											    By <a href="<?php echo base_url('index.php/welcome/profile?id='.$topliferow->user_id);?>">
											        <span style="color:black"><b><?php echo $topliferow->name;?></b></span></a>
											<?php } ?>
										</div>
									</li>
									<!-- /.item -->
								</ul>
							<!-- /.description-block -->
							</div>
						</div>						
						<div class="row">
							<div class="col-md-12">
								<p class="text-justify" style="font-size: 10px; color:#000;">
								    <?php echo substr($topliferow->story,0,65);?> 
								    <a href="<?php echo base_url('index.php/Welcome/only_story_view?id='.$topliferow->sid);?>"> ...Read more</a>
							    </p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<ul class="list-inline">
									<li>
										<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topliferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
						                    <a class="btn btn-default">
						                        <button style="background:none; border:none;" onclick='alert("you can not read later the Story.");'>
										        <i class="fa fa-bookmark"></i> Read later </button></a>
						                <?php }else{ ?>
									        <?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topliferow->sid, $readlatersids)) { ?>
											<a class="btn btn-primary readlaterbtn<?php echo $topliferow->sid;?>">
											    <button style="background:none; border:none;" onclick="unreadlater(<?php echo $topliferow->sid;?>)" class="notloginmodal readlaterbtnatr<?php echo $topliferow->sid;?>">
									            <i class="fa fa-check faicon<?php echo $topliferow->sid;?>"></i> Read later </button></a>
										    <?php }else { ?>
									        <a class="btn btn-default readlaterbtn<?php echo $topliferow->sid;?>">
										        <button style="background:none; border:none;" onclick="readlater(<?php echo $topliferow->sid;?>)" class="notloginmodal readlaterbtnatr<?php echo $topliferow->sid;?>">
								                <i class="fa fa-bookmark faicon<?php echo $topliferow->sid;?>"></i> Read later </button></a>
									       <?php } ?>
    					                <?php } ?>
									</li>									
									<li class="pull-right">
										<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
											<span class=""><i class="fa fa-plus"></i></span>
										</button>
										<ul class="dropdown-menu list-inline">
											<li onclick="groupsuggest(<?php echo $topliferow->sid; ?>);">
												<a data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
											</li>
											<li onclick="friend(<?php echo $topliferow->sid;?>);">
												<a data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
											</li>
											<li>
												<a data-toggle="modal" data-target="#soc" href="">
													<i class="fa fa-share-alt"></i>
												</a>
											</li>
										</ul>
									</li>									
								</ul>
							</div>
						</div>						
					</div>
				</div>
			<!-- /.widget-user -->
			</div>
			<!-- /.col -->
			<?php } } ?>
		</div>
		
		<div class="row">
		    <?php if(isset($get_life) && ($get_life->num_rows() > 0)){ ?>
			<div class="col-md-12">
				<h2>LATEST LIFE EVENTS</h2>
			</div>
			<?php foreach($get_life->result() as $liferow) { ?>
			<div class="col-md-4 item1 cardevents jQueryEqualHeight7">
			<!-- Widget: user widget style 1 -->
				<div class="card box box-widget widget-user vjc1">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<a href="<?php echo base_url('index.php/Welcome/only_story_view?id='.$liferow->sid);?>" style="color:#000;">
					    <?php $bgimage = base_url().'assets/dist/img/photo1.png';
					        if(isset($liferow->cover_image) && !empty($liferow->cover_image)) {
					            $bgimage = base_url().'assets/images/'.$liferow->cover_image;
				        } ?>
						<div class="card-img-top widget-user-header bg-black" style="background: url('<?php echo $bgimage;?>') center center;">
						</div>
					</a>
					<div class="card-body box-footer">
						<div class="row">
							<div class="col-sm-12">
								<ul class="products-list product-list-in-box">
									<li class="item">
										<div class="card-title">
											<a href="<?php echo base_url('index.php/Welcome/only_story_view?id='.$liferow->sid);?>" class="product-title">
											    <?php echo $liferow->title;?>
											</a>
										</div>
										<div class="card-text product-description">
											<?php if(($liferow->writing_style == 'anonymous') && ($liferow->type == 'life')){ ?>
											    By <span><b>Anonymous</b></span>
											<?php } else { ?>
											    By <a href="<?php echo base_url('index.php/welcome/profile?id='.$liferow->user_id);?>">
											        <span><b><?php echo $liferow->name;?></b></span>
											       </a>
											<?php } ?>
										</div>
									</li>
									<!-- /.item -->
								</ul>
							<!-- /.description-block -->
							</div>
						</div>						
						<div class="row">
							<div class="col-md-12">
								<p><?php echo substr($liferow->story,0,150);?>
								    <a href="<?php echo base_url('index.php/Welcome/only_story_view?id='.$liferow->sid);?>"> ... Read more</a>
								</p>
							</div>
						</div>
						<div class="row">
    						<div class="col-md-12">
    							<ul class="list-inline">
    								<li>
    									<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($liferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
						                    <a class="btn btn-default">
						                        <button style="background:none; border:none;" onclick='alert("you can not read later the Story.");'>
										        <i class="fa fa-bookmark"></i> Read later </button></a>
						                <?php }else{ ?>
									        <?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($liferow->sid, $readlatersids)) { ?>
											<a class="btn btn-primary readlaterbtn<?php echo $liferow->sid;?>">
											    <button style="background:none; border:none;" onclick="unreadlater(<?php echo $liferow->sid;?>)" class="notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
									            <i class="fa fa-check faicon<?php echo $liferow->sid;?>"></i> Read later </button></a>
										    <?php }else { ?>
									        <a class="btn btn-default readlaterbtn<?php echo $liferow->sid;?>">
										        <button style="background:none; border:none;" onclick="readlater(<?php echo $liferow->sid;?>)" class="notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
								                <i class="fa fa-bookmark faicon<?php echo $liferow->sid;?>"></i> Read later </button></a>
									       <?php } ?>
    					                <?php } ?>
    								</li>
    								<li class="pull-right">
    									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    										<span class=""><i class="fa fa-plus"></i></span>
    									</button>
    									<ul class="dropdown-menu list-inline">
											<li onclick="groupsuggest(<?php echo $liferow->sid; ?>);">
												<a data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
											</li>
											<li onclick="friend(<?php echo $liferow->sid;?>);">
												<a data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
											</li>
											<li>
												<a data-toggle="modal" data-target="#soc" href="">
													<i class="fa fa-share-alt"></i>
												</a>
											</li>
										</ul>
    								</li>									
    							</ul>
    						</div>
    					</div>
					</div>
				</div>
			<!-- /.widget-user -->
			</div>
			<!-- /.col -->	
			<?php } } ?>
		</div>
        
    </section>
</div>

<!-- group suggest popup code ---- -->
<div class="modal" id="groupsuggest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code ----------- -->
<!-- frind popup code ------>
<div class="modal" id="friendsuggest" role="dialog" aria-hidden="true">
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