<?php if(isset($profilealloadmore) && ($profilealloadmore->num_rows() >0) && isset($type) && ($type == 'series')){ ?>
    <?php foreach ($profilealloadmore->result() as $valoadseriesrow) { ?>
        <div class="cardls">
			<div class="book-typels"><?php echo $valoadseriesrow->gener;?></div>
			    <a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u",'-', $valoadseriesrow->title).'-'.$valoadseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $valoadseriesrow->title).'-'.$valoadseriesrow->story_id);?>" class="imagesls-style">
    				<?php if(isset($valoadseriesrow->image) && !empty($valoadseriesrow->image)) { ?>
    				    <img src="<?php echo base_url();?>assets/images/<?php echo $valoadseriesrow->image; ?>" alt="<?php echo $valoadseriesrow->title;?>" class="imagemels">
    				<?php }else{ ?>
    					<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $valoadseriesrow->title;?>" class="imagemels">
    				<?php } ?>
    			</a>
			<div>
				<font class="max-linesls">
					<!--<a href="<?php echo base_url('new_series?id='.$valoadseriesrow->sid.'&story_id='.$valoadseriesrow->story_id);?>">-->
					<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u",'-', $valoadseriesrow->title).'-'.$valoadseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $valoadseriesrow->title).'-'.$valoadseriesrow->story_id);?>">
						<?php echo $valoadseriesrow->title;?>
					</a>
				</font> 
			</div>
			<div class="flextestls">
				<font class="bynamels">By <font class="namehere">
				    <a href="<?php echo base_url($this->uri->segment(1).'/'.$valoadseriesrow->profile_name);?>" style="color:#000"> <?php echo $valoadseriesrow->name;?></a></font></font><br>
			</div>
			<div class="flextestls" style="padding-top:4px;">
				<font class="episodesls">
					<?php $keycount = get_episodecount($valoadseriesrow->sid); 
					    if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
					<?php $subsmemcount = get_storysubscount($valoadseriesrow->sid); 
					    if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
				</font><br>
			</div>
			<div class="flextestls" style="padding-top:6px">
				<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($valoadseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
					<button class="readls" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
				<?php }else if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
					<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($valoadseriesrow->sid, $readlatersids)) { ?>
						<button onclick="unreadlater(<?php echo $valoadseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $valoadseriesrow->sid;?>">
						<i class="fa fa-check faicon<?php echo $valoadseriesrow->sid;?>"></i> Read later </button>
					<?php }else { ?>
						<button onclick="readlater(<?php echo $valoadseriesrow->sid;?>)" class="readls notloginmodal readlaterbtnatr<?php echo $valoadseriesrow->sid;?>">
						<i class="fa fa-bookmark faicon<?php echo $valoadseriesrow->sid;?>"></i> Read later </button>
					<?php } ?>
				<?php } else{ ?>
				    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
				<?php } ?>
				<button type="button" class="btn readls dropdown-toggle pull-right" data-toggle="dropdown">
					<span class=""><i class="fa fa-plus"></i></span>
				</button>
				<ul class="dropdown-menu list-inline dropvk">
					<li onclick="groupsuggest(<?php echo $valoadseriesrow->sid; ?>);">
						<a data-toggle="modal" data-target="#groupsuggest" href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
					</li>
					<li onclick="friend(<?php echo $valoadseriesrow->sid;?>);">
						<a data-toggle="modal" data-target="#friendsuggest" href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
					</li>
					<li onclick="socialshare(<?php echo $valoadseriesrow->sid;?>, 'series');">
						<a data-toggle="modal" data-target="#soc" href="javascript:void(0);"><i class="fa fa-share-alt"></i></a>
					</li>
				</ul>
			</div>
		</div>
    <?php } ?>
<?php }else if(isset($profilealloadmore) && ($profilealloadmore->num_rows() >0) && isset($type) && ($type == 'story')){ ?>
    <?php foreach ($profilealloadmore->result() as $valoadstorysrow) { ?>
        <div class="cardls">
			<div class="book-typels"><?php echo $valoadstorysrow->gener;?></div>
			    <a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u",'-', $valoadstorysrow->title).'-'.$valoadstorysrow->sid);?>" class="imagesls-style">
    				<?php if(isset($valoadstorysrow->image) && !empty($valoadstorysrow->image)) { ?>
    				    <img src="<?php echo base_url();?>assets/images/<?php echo $valoadstorysrow->image; ?>" alt="<?php echo $valoadstorysrow->title;?>" class="imagemels">
    				<?php }else{ ?>
    					<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $valoadstorysrow->title;?>" class="imagemels">
    				<?php } ?>
    			</a>
			<div>
				<font class="max-linesls">
					<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u",'-', $valoadstorysrow->title).'-'.$valoadstorysrow->sid);?>">
						<?php echo $valoadstorysrow->title;?>
					</a>
				</font> 
			</div>
			<div class="flextestls">
				<font class="bynamels">By <font class="nameherels" style="padding:1px;">
				    <a href="<?php echo base_url($this->uri->segment(1).'/'.$valoadstorysrow->profile_name);?>" style="color:#000"> <?php echo $valoadstorysrow->name;?></a></font></font><br>
			</div>
			<div class="flextestls" style="padding-top:4px;">
			   	<font class = "episodesls">
			   		<font>
			   			<?php $wordcount = explode(' ', $valoadstorysrow->story);
			    	$time = round(sizeof($wordcount)/50);	?>
			   			<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
			   		<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $valoadstorysrow->views;?>&nbsp;</b></font>
			   		<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
			   			<b>
			   			<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
			   				foreach($reviews21->result() as $reviews2) { 
			   					if($reviews2->sid == $valoadstorysrow->sid) {
			   						echo round($reviews2->rating);
			   					}
			   			} } ?>
			   			</b>
			   		</font>
			   	</font><br>
			</div>
            <div class="flextestls" style="padding-top:6px">
	            	<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($valoadstorysrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
	            		<button class="readls" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
	            	<?php }else if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
	            		<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($valoadstorysrow->sid, $readlatersids)) { ?>
	            			<button onclick="unreadlater(<?php echo $valoadstorysrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $valoadstorysrow->sid;?>">
	            			<i class="fa fa-check faicon<?php echo $valoadstorysrow->sid;?>"></i> Read later </button>
	            		<?php }else { ?>
	            			<button onclick="readlater(<?php echo $valoadstorysrow->sid;?>)" class="readls notloginmodal readlaterbtnatr<?php echo $valoadstorysrow->sid;?>">
	            			<i class="fa fa-bookmark faicon<?php echo $valoadstorysrow->sid;?>"></i> Read later </button>
	            		<?php } ?>
	            	<?php } else{ ?>
    				    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
    				<?php } ?>
	            	
	            	<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
	            		<span class=""><i class="fa fa-plus"></i></span>
	            	</button>
	            	<ul class="dropdown-menu list-inline dropvk">
	            		<li onclick="groupsuggest(<?php echo $valoadstorysrow->sid; ?>);">
	            			<a data-toggle="modal" data-target="#groupsuggest" href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
	            		</li>
	            		<li onclick="friend(<?php echo $valoadstorysrow->sid;?>);">
	            			<a data-toggle="modal" data-target="#friendsuggest" href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
	            		</li>
	            		<li onclick="socialshare(<?php echo $valoadstorysrow->sid;?>, 'story');">
	            			<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
	            				<i class="fa fa-share-alt"></i>
	            			</a>
	            		</li>
	            	</ul>
	            </div>
			</div>
    <?php } ?>
<?php }else if(isset($profilealloadmore, $this->session->userdata['logged_in']['user_id']) && ($profilealloadmore->num_rows() >0) && isset($type) && ($type == 'life') && ($userid == $this->session->userdata['logged_in']['user_id'])){ ?>
    <?php foreach ($profilealloadmore->result() as $valiferow) { ?>
        <div class="card1">
            <a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u",'-', $valiferow->title).'-'.$valiferow->sid);?>" class="imagelife-style">
    			<?php if(isset($valiferow->image) && !empty($valiferow->image)) { ?>
    				<img src="<?php echo base_url();?>assets/images/<?php echo $valiferow->image; ?>" alt="<?php echo $valiferow->title;?>" class="imageme1">
    			<?php }else{ ?>
    				<img src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $valiferow->title;?>" class="imageme1">
    			<?php } ?>
			</a>
			<div>
				<font class="max-lines">
					<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u",'-', $valiferow->title).'-'.$valiferow->sid);?>">
						<?php echo $valiferow->title;?>
					</a>
				</font> 
			</div>
			<div class="flextest">
				<?php if(($valiferow->writing_style == 'anonymous') && ($valiferow->type == 'life')){ ?>
					<font class="byname">By <font class="namehere"> Anonymous</font></font><br>
				<?php } else { ?>
					<font class="byname">By <font class="namehere">
					    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$valiferow->profile_name;?>" style="color:#000"> <?php echo $valiferow->name;?></a></font></font>
					<br>
				<?php } ?>
			</div>
			<div class="flextest" style="padding-top:4px;">
				<font class="lifeEvents-text"><?php echo mb_substr(strip_tags($valiferow->story),0,150);?> 
					<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u",'-', $valiferow->title).'-'.$valiferow->sid);?>"></a>
				</font>
			</div>
		
			<div class="flextest" style="padding-top:6px">
				<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($valiferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
					<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
				<?php }else if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
					<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($valiferow->sid, $readlatersids)) { ?>
						<button onclick="unreadlater(<?php echo $valiferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $valiferow->sid;?>">
						<i class="fa fa-check faicon<?php echo $valiferow->sid;?>"></i> Read later </button>
					<?php }else { ?>
						<button onclick="readlater(<?php echo $valiferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $valiferow->sid;?>">
						<i class="fa fa-bookmark faicon<?php echo $valiferow->sid;?>"></i> Read later </button>
					<?php } ?>
				<?php } else{ ?>
				    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
				<?php } ?>
				
				<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
					<span class=""><i class="fa fa-plus"></i></span>
				</button>
				<ul class="dropdown-menu list-inline dropvklife">
					<li onclick="groupsuggest(<?php echo $valiferow->sid; ?>);">
						<a data-toggle="modal" data-target="#groupsuggest"  href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
					</li>
					<li onclick="friend(<?php echo $valiferow->sid;?>);">
						<a data-toggle="modal" data-target="#friendsuggest"  href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
					</li>
					<li onclick="socialshare(<?php echo $valiferow->sid;?>, 'story');">
						<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
							<i class="fa fa-share-alt"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>	
	<?php } ?>
<?php }else if(isset($profilealloadmore) && ($profilealloadmore->num_rows() >0) && isset($type) && ($type == 'nano')){ ?>
    <?php foreach($profilealloadmore->result() as $valoadnanorow) { ?>
		<div class="nano-stories" style="margin:8px;">
        	<div>
                <?php if(isset($valoadnanorow->profile_image) && !empty($valoadnanorow->profile_image)) { ?>
                	<img src="<?php echo base_url();?>assets/images/<?php echo $valoadnanorow->profile_image; ?>" class="circle-image" alt="<?php echo $valoadnanorow->name;?>" style="height:50px;">
                <?php }else{ ?>
                	<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" alt="<?php echo $valoadnanorow->name;?>" style="height:50px;">
                <?php } ?>
                <h3 class="name-nanostories">
        		    <a href="<?php echo base_url($this->uri->segment(1).'/'.$valoadnanorow->profile_name);?>" style="color:#000"><?php echo $valoadnanorow->name;?></a>
        		    <?php if($valoadnanorow->user_id == $this->session->userdata['logged_in']['user_id']){ ?>
            		    <span class="dropdown" style="float:right;margin-top:-2.8px;">
            		        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            		            <i class="fa fa-ellipsis-v" style="font-size:14px;"></i>
            		        </a>
            		        <ul class="dropdown-menu pull-right">
            		            <li><a href="javascript:void(0);" onClick="editnano(<?php echo $valoadnanorow->sid;?>);"><i class="fa fa-edit pr-10"></i> EDIT</a></li>
        		                <li><a href="javascript:void(0);" onClick="deletenano(<?php echo $valoadnanorow->sid;?>);"><i class="fa fa-trash pr-10"></i> DELETE</a></li>
            		        </ul>
            		    </span>
        		    <?php } ?>
        	    </h3>
            </div>
        	<div>
        		<hr style="width:100%;">
        		<a href="#" style="color:#000" data-toggle="modal" data-target="#modal-default<?php echo $valoadnanorow->sid;?>">
				    <font class="text-in-nanostory" onclick="nanoviewsadd(<?php echo $valoadnanorow->sid;?>);"><?php echo $valoadnanorow->story; ?></font>
				</a>
        	</div>
        	<div class="lastdiv">
				<hr style="width:100%;">
				<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
				    if(isset($nanolikes) && in_array($valoadnanorow->sid,$nanolikes)) { ?>
					<font>
					    <span class="nanolikecount<?php echo $valoadnanorow->sid;?>"><?php echo $valoadnanorow->nanolikecount;?></span>
					    <a href="javascript:void(0);" onclick="nanodislike(<?php echo $valoadnanorow->sid;?>);" class="nanolike<?php echo $valoadnanorow->sid;?>" title="Unlike">
							<i class="fa fa-heart favbtn<?php echo $valoadnanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
						</a>
					</font>
				    <?php } else { ?>
				    <font>
				        <span class="nanolikecount<?php echo $valoadnanorow->sid;?>"><?php echo $valoadnanorow->nanolikecount;?></span>
					    <a href="javascript:void(0);" onclick="nanolike(<?php echo $valoadnanorow->sid;?>);" class="nanolike<?php echo $valoadnanorow->sid;?>" title="like">
							<i class="fa fa-heart-o favbtn<?php echo $valoadnanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
						</a>
					</font>
				    <?php } }else { ?>
				    <font>
					    <span class="nanolikecount<?php echo $valoadnanorow->sid;?>"><?php echo $valoadnanorow->nanolikecount;?></span>
					    <a href="javascript:void(0);" class="notloginmodal" title="like">
							<i class="fa fa-heart-o favbtn<?php echo $valoadnanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
						</a>
					</font>
				<?php } ?>
				<div style="float:right;color:#777">
					<a href="javascript:void(0);" class="dropdown-toggle text-muted" data-toggle="dropdown">
						<i class="fa fa-share-alt" aria-hidden="true"></i>
					</a>
					<ul class="dropdown-menu list-inline dropvknano">
						<li onclick="groupsuggest(<?php echo $valoadnanorow->sid; ?>);">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
						</li>
						<li onclick="friend(<?php echo $valoadnanorow->sid;?>);">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
						</li>
						<li onclick="socialshare(<?php echo $valoadnanorow->sid;?>, 'nano');">
							<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
						</li>
					</ul>
				</div>
				<font style="float:right;color:#777">
				    <i class="fa fa-eye" aria-hidden="true"></i>
				    <b><span class="nanoviewcount<?php echo $valoadnanorow->sid;?>"><?php echo $valoadnanorow->views; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</font>
			</div>
        </div>
	<?php } ?>
    <?php if(isset($profilealloadmore) && ($profilealloadmore->num_rows() > 0) && isset($type) && ($type == 'nano')){
        foreach($profilealloadmore->result() as $vamodalnanorow) { ?>
		<div class="modal fade" id="modal-default<?php echo $vamodalnanorow->sid;?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					    <div>
					        <?php if(isset($vamodalnanorow->profile_image) && !empty($vamodalnanorow->profile_image)) { ?>
								<img src="<?php echo base_url();?>assets/images/<?php echo $vamodalnanorow->profile_image; ?>" alt="<?php echo $vamodalnanorow->name;?>" class="user-image img-circle" style="height:50px;">
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $vamodalnanorow->name;?>" class="user-image img-circle" style="height:50px;">
							<?php } ?>
                		    <h3 class="name-nanostories" style="margin-top: -40px; margin-left: 50px;">
                		        <a href="<?php echo base_url($this->uri->segment(1).'/'.$vamodalnanorow->profile_name);?>" style="color:#000"><?php echo $vamodalnanorow->name;?></a>
                		        <span class="pull-right">
                		            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:4px;">
        						        <span aria-hidden="true">&times;</span>
        					        </button>
                		        </span>
                		    </h3>
                		</div>
					</div>
					<div class="modal-body modal-bodyv" style="overflow-y:scroll;">		
						<font class="text-in-nanostory-p" style="border-left:none; overflow-y:scroll;"><?php echo $vamodalnanorow->story; ?></font>		
					</div>
					<div class="modal-footer">
						<ul class="list-inline">
							<li class="text-muted pull-left" style="display:flex;">
                                <?php if(isset($this->session->userdata['logged_in']['user_id'])){
                                    if(isset($nanolikes) && in_array($vamodalnanorow->sid,$nanolikes)) { ?>
                                	    <span class="nanolikecount<?php echo $vamodalnanorow->sid;?>"><?php echo $vamodalnanorow->nanolikecount;?></span>
                                	    <a href="javascript:void(0);" onclick="nanodislike(<?php echo $vamodalnanorow->sid;?>);" class="nanolike<?php echo $vamodalnanorow->sid;?>" title="Unlike">
                                			<i class="fa fa-heart favbtn<?php echo $vamodalnanorow->sid;?>" style="color:#f00; padding-left:3px;font-size:20px;"></i>
                                		</a>
                                	<?php } else { ?>
                                		<span class="nanolikecount<?php echo $vamodalnanorow->sid;?>"><?php echo $vamodalnanorow->nanolikecount;?></span>
                                	    <a href="javascript:void(0);" onclick="nanolike(<?php echo $vamodalnanorow->sid;?>);" class="nanolike<?php echo $vamodalnanorow->sid;?>" title="like">
                                			<i class="fa fa-heart-o favbtn<?php echo $vamodalnanorow->sid;?>" style="color:#f00; padding-left:3px;font-size:20px;"></i>
                                		</a>
                                <?php } } else{ ?>
                                    <span class="nanolikecount<?php echo $vamodalnanorow->sid;?>"><?php echo $vamodalnanorow->nanolikecount;?></span>
                                    <a href="javascript:void(0);" class="notloginmodal" title="like">
                                		<i class="fa fa-heart-o favbtn<?php echo $vamodalnanorow->sid;?>" style="color:#f00; padding-left:3px;font-size:20px;"></i>
                                	</a>
                                <?php } ?>
                            </li>
							<li class="pull-right">
                            	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                                <ul class="dropdown-menu list-inline dropvknano1">
                                    <li onclick="groupsuggest(<?php echo $vamodalnanorow->sid; ?>);">
									    <a data-toggle="modal" data-target="#groupsuggest" href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
									</li>
									<li onclick="friend(<?php echo $vamodalnanorow->sid;?>);">
										<a data-toggle="modal" data-target="#friendsuggest" href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
									</li>
									<li onclick="socialshare(<?php echo $vamodalnanorow->sid;?>, 'nano');">
										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
									</li>
                                </ul>
                            </li>
						</ul>
					</div>
				</div> <!-- /.modal-content -->
			</div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->
    <?php } } ?>
<?php } ?>