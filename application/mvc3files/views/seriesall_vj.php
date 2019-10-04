<style>
.book-type{
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    box-sizing:border-box;
    font-family: 'Josefin Sans', sans-serif;
    font-size: 14px;
    line-height: 20px;
    color: #fff;
    padding: 3px 6px 0px;
    background: #00a65a;
    position: relative;
    top: 0px;
    z-index: 1;
    font-weight: 300;
    text-align:center;
}

.card {
  background-color:white;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
  width: 210px;
  margin: 8px;
  box-sizing:border-box;
  padding:5px;
  display: flex;
  flex-flow: column nowrap;
  font-family: 'Josefin Sans', sans-serif;
}
.max-lines {
  color: #337ab7;
  font-size: 16.5px;
  font-family: 'Roboto', sans-serif;
  max-height: 2.8em;
  line-height: 1.4em;
  font-weight:600;
  display: flex;
  -webkit-line-clamp: 2;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.episodes {
 color:#999;
 font-size:13px;
 font-family: 'Roboto', sans-serif;
}

.read {
 height:32px;
 background-color:#f4f4f4;
 color:black;
 border: none;
 border-radius: 4px;
 /*padding: 10px;*/
}

.byname{
   font-size:13.0px;
   font-family: 'Roboto', sans-serif;
   color:#999;

}

.namehere{
    color:black;
    font-size:12.5px;
    padding:4px;
    font-weight:600;
}

.plus-button {
 height:32px;
 width:35px;
 float:right;
 color:black;
 background-color:#f4f4f4;
 border: none;
 border-radius: 4px;
}

.imageme{
 width:100%;height:180px;
 image-rendering:-webkit-optimize-contrast;
}
.flextest{
  margin-top: auto;
}
@media screen and (min-width: 318px) and (max-width: 357px){
  .card {
  width: 148px;
  margin: 1.5px;
}
.episodes {
 font-size:10px;
}
.imageme{
 height:150px;
}
h2{
	font-size:15px;
	line-height:2.1;
}
.btn{
    font-size:12px;
    padding: 4px 6px;
}
}
@media screen and (min-width: 358px) and (max-width: 395px){
  .card {
  width: 165px;
  margin: 3px;
}
.episodes {
 font-size:10px;
}
.imageme{
 height:155px;
}
.btn{
    font-size:12px;
    padding: 4px 6px;
}
}
@media screen and (min-width: 395px) and (max-width: 450px){
.card {
  width: 183px;
  margin: 3px;
}
.episodes {
 font-size:11.5px;
}
.imageme{
 height:160px;
}
.content-wrapper, .main-footer {
    margin-left: 0px;
    z-index: 820;
}

.btn{
    font-size:12px;
    padding: 4px 6px;
}
}
@media screen and (min-width: 590px) and (max-width: 655px){
  .card {
  width: 168px;
  margin: 3px;
}
.episodes {
 font-size:11px;
}
.imageme{
 height:160px;
}
}
@media screen and (min-width: 590px) and (max-width: 1030px){
	
.card {
  width: 200px;
  margin: 5px;
}
.imageme{
 height:175px;
}
.content-wrapper, .main-footer {
    margin-left: 0px;
    z-index: 820;
}
}
@media screen and (max-width: 1030px){
    .max-lines {
        font-weight:400;
    }
    
    .namehere{
        font-weight:400;
    }
    .wv{
        width:950px;
        margin-left:50px;
    }
}
@media screen and (max-width: 400px) {
.book-type{
    font-size: 12px;
    line-height: 18px;
} 
}
@media screen and (max-width: 340px) {
.book-type{
    font-size: 10px;
    line-height: 16px;
} 
}
.btnr{
	float:right;
	margin-top: 20px;
    margin-bottom: 10px;
}
hr {
    margin-top: 10px;
    margin-bottom: 10px;
    border: 0;
    border-top: 1px solid #777;
}

.nano-stories{
    box-sizing:border-box;
    width: 276px;
    background-color: white;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
    padding:10px;
    position: relative;
    display: flex;
    flex-flow: column nowrap;
    margin: 7px;
}
.circle-image{
    margin-top: 3px;
    width: 52px;
    border-radius: 50%;
    float: left;
    image-rendering:-webkit-optimize-contrast;           
}
.name-nanostories{
    color: black;
    padding-left: 10px;
    font-family: 'Arimo', sans-serif;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.text-in-nanostory{
    color: black;
    font-size: 17px;
    height: 12.4em;
    line-height: 1.4em;
    display: flex;
    -webkit-line-clamp: 9;
    display: -webkit-box;
   -webkit-box-orient: vertical;
    overflow: hidden;
    border-left: 5px solid #eee;
    padding-left: 5px;
}
.lastdiv {
    margin-top: auto;
}

.card1 {
	background-color:white;
	box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
	width: 276px;
	margin: 8px;
	box-sizing:border-box;
	padding:5px;
	display: flex;
	flex-flow: column nowrap;
}

.imageme1{
	width:100%;height:165px;
	image-rendering:-webkit-optimize-contrast;
}

.lifeEvents-text{
	color: black;
	font-size:13px;
	font-family: 'Roboto', sans-serif;
	max-height: 3.6em;
	line-height: 1.2em;
	display: flex;
	-webkit-line-clamp: 3;
	display: -webkit-box;
	-webkit-box-orient: vertical;
	overflow: hidden;
}

.flextest{
  margin-top: auto;
}
.wv{
    width:950px;
    margin-left:50px;
}
</style>
<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content wv">
        <div class="row">
		    <?php if(isset($top_get_series) && ($top_get_series->num_rows() > 0)){ ?>
			<div class="col-md-12">
				<h2>TOP SERIES</h2>
			</div>
		</div>
		<div class="row">
			<div class="MultiCarousel" data-items="1,3,4" data-slide="1" id="MultiCarousel" data-interval="1000" data-flickity-options='{ "freeScroll": true, "wrapAround": true }'>
    			<div class="MultiCarousel-inner" data-flickity='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false }'>
    			<?php foreach($top_get_series->result() as $topseriesrow) { ?>
						<div class="card">
							<div class="book-type"><?php echo $topseriesrow->gener;?></div>
							<?php if(isset($topseriesrow->cover_image) && !empty($topseriesrow->cover_image)) { ?>
							<img src="<?php echo base_url();?>assets/images/<?php echo $topseriesrow->cover_image; ?>" alt="Avatar" class="imageme">
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imageme">
							<?php } ?>
							<div>
								<font class="max-lines">
									<a href="<?php echo base_url('index.php/welcome/new_series?id='.$topseriesrow->sid.'&story_id='.$topseriesrow->story_id);?>" class="product-title">
										<?php echo substr($topseriesrow->title, 0, 40);?>
									</a>
								</font> 
							</div>
							<div class="flextest">
								<font class="byname">By<font class="namehere"><?php echo $topseriesrow->name;?></font></font><br>
							</div>
							
							<div class="flextest" style="padding-top:4px;">
								<font class="episodes">
									<?php $keycount = get_episodecount($topseriesrow->sid); 
									if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | <?php $subsmemcount = get_storysubscount($topseriesrow->sid); 
														if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS</font><br>
							</div>
							
							<div class="flextest" style="padding-top:6px">
								<button class="read"><i class="fa fa-bookmark" aria-hidden="true"></i> Read later</button>
								<button class="plus-button"><i class="fa fa-plus" aria-hidden="true"></i></button>
							</div>
						
						</div>
					
	            <?php } if($get_series->num_rows() > 4){ ?>
        			<div class="">
        			    <div class="card">
							<div style="padding: 140px 54px;">
								<a href="<?php echo base_url();?>index.php/welcome/topviewallhome/series" style="padding: 140px 15px;">
        				        View all</a>
							</div>
						</div>
					
        				<!--<div class="card" style="display: table-cell;  vertical-align: middle;">
        				    <center><a href="<?php echo base_url();?>index.php/welcome/topviewallhome/series" style="padding: 140px 54px;">
        				        View all</a></center>
        				</div>-->
        			</div>
                <?php } ?>
			    </div>
			</div>
		</div><br>
		<?php } ?>
<style>
    option{
        padding:20px;
        font-size:18px;
    }
    select option{
        max-height:15px!important;
        overflow:scroll;
    }
</style>		
		<div class="row">
		    <?php if(isset($get_series) && ($get_series->num_rows() > 0)){ ?>
			<div class="col-md-6 col-xs-6"> <h2>LATEST SERIES </h2>	</div>
			<div class="col-md-3"></div>
			<div class="col-md-3 col-xs-6">
			    <h2><small>
    			    <select class="pull-right form-control" onchange="generfilter(this.value)">
    			        <option value=""> -- Select Gener -- </option>
    			        <?php if(isset($gener) && ($gener->num_rows() > 0)){ foreach($gener->result() as $generrow){ ?>
    			            <option value="<?php echo $generrow->id;?>"><?php echo $generrow->gener;?></option>
    			        <?php } } ?>
    			    </select>
    		    </small>
    		    </h2>
    		</div>
    	</div>
    	<div class="row">
    		<div id="loadmoreall" style="display:flex;flex-wrap: wrap;">
			<?php foreach($get_series->result() as $seriesrow) { ?>
    			<div class="">
					<div class="card">
					    <div class="book-type"><?php echo $seriesrow->gener;?></div>
					    	<?php if(isset($seriesrow->cover_image) && !empty($seriesrow->cover_image)) { ?>
					    	<img src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->cover_image; ?>" alt="Avatar" class="imageme">
					    	<?php }else{ ?>
					    		<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imageme">
					    	<?php } ?>
					    	<div>
					    		<font class="max-lines">
					    			<a href="<?php echo base_url('index.php/welcome/new_series?id='.$seriesrow->sid.'&story_id='.$seriesrow->story_id);?>" class="product-title">
					    				<?php echo substr($seriesrow->title, 0, 40);?>
					    			</a>
					    		</font> 
					    	</div>
						<div class="flextest">
							<font class="byname">By<font class="namehere"><?php echo $seriesrow->name;?></font></font><br>
						</div>
							
					    <div class="flextest" style="padding-top:4px;">
						    <font class="episodes">
							<?php $keycount = get_episodecount($seriesrow->sid); 
								if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | <?php $subsmemcount = get_storysubscount($seriesrow->sid); 
													if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS</font><br>
						</div>
							
							<div class="flextest" style="padding-top:6px">
							    <!--<button class="read"><i class="fa fa-bookmark" aria-hidden="true"></i> Read later</button>-->
							    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($seriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
						                    <a class="btn btn-default btn-1024">
						                        <button style="background:none; border:none;" onclick='alert("you can not read later the Story.");'>
										        <i class="fa fa-bookmark"></i> Read later </button></a>
						                <?php }else{ ?>
									        <?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($seriesrow->sid, $readlatersids)) { ?>
											<a class="btn-1024 btn btn-primary readlaterbtn<?php echo $seriesrow->sid;?>">
											    <button style="background:none; border:none;" onclick="unreadlater(<?php echo $seriesrow->sid;?>)" class="notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
									            <i class="fa fa-check faicon<?php echo $seriesrow->sid;?>"></i> Read later </button></a>
										    <?php }else { ?>
									        <a class="btn-1024 btn btn-default readlaterbtn<?php echo $seriesrow->sid;?>">
										        <button style="background:none; border:none;" onclick="readlater(<?php echo $seriesrow->sid;?>)" class="notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
								                <i class="fa fa-bookmark faicon<?php echo $seriesrow->sid;?>"></i> Read later </button></a>
									       <?php } ?>
    					                <?php } ?>
							        <button type="button" class="btn btn-primary dropdown-toggle pull-right" data-toggle="dropdown">
										<span class=""><i class="fa fa-plus"></i></span>
									</button>
									<ul class="dropdown-menu list-inline" style="position:relative">
										<li onclick="groupsuggest(<?php echo $seriesrow->sid; ?>);">
											<a data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
										</li>
										<li onclick="friend(<?php echo $seriesrow->sid;?>);">
											<a data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
										</li>
										<li>
											<a data-toggle="modal" data-target="#soc" href="">
												<i class="fa fa-share-alt"></i>
											</a>
										</li>
									</ul>
							</div>
							
							</div>
				</div>
			<?php } ?>
			</div>
			<?php } ?>
		</div><br>
    </section>
</div>

<!-- Social Popup ---- -->
	<div class="modal fade" id="soc">
		<div class="modal-dialog" style="width:270px;">
			<div class="modal-content socv">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Social Media Share</h4>
				</div>
				<div class="modal-body" style="padding: 5px 15px;">
					<div class="row">
						<div class="col-md-12 border-bottom">
							<a class="btn btn-primary btn-social-icon btn-facebook" style="border-radius: 50%;"><i class="fa fa-facebook"></i></a> Faceebok
						</div>
						<div class="col-md-12 border-bottom">
							<a class="btn btn-success btn-social-icon btn-google-plus" style="border-radius: 50%;"><i class="fa fa-whatsapp"></i></a> Whatsapp
						</div>
						<div class="col-md-12 border-bottom">
							<a class="btn btn-info btn-social-icon btn-twitter" style="border-radius: 50%;"><i class="fa fa-twitter"></i></a> Twitter
						</div>
						<div class="col-md-12 border-bottom-none">
							<a class="btn btn-default btn-social-icon btn-twitter" style="border-radius: 50%;"><i class="fa fa-link"></i></a> Copy Link
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
<style>
    .border-bottom {
    border-bottom: 1px solid #777;
    padding: 10px;
}
.border-bottom-none{
   padding: 10px 10px 0;
}
</style>

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
	function generfilter(generid){
		if((generid == 0) || (generid == '') || (generid == 'undefined') || (generid == ' ') || (generid == 'null')){
			location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
		}else{
			$.ajax({
				type:'POST',
				url:'<?php echo base_url();?>index.php/welcome/geners',
				data:{'generid' : generid},
				success:function(resultdata){
					$('#loadmoreall').html(resultdata);
				}
			});
		}
	}
</script>

<script>
$(function () { // Gener show More
    $('span.cardmore').click(function () {
        $('ul.card li').slideDown("slow");
        $('span.cardmore').hide();
    });
});
</script>