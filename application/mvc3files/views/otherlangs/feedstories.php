<?php if(isset($storiesfeed) && ($storiesfeed->num_rows() > 0)){ ?>
    <div id="sloadmoreall">
        <?php foreach ($storiesfeed->result() as $storyfeed) { ?>
        <div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;">
            <div class="box-header with-border">
        		<div class="user-block">
        			<?php if(isset($storyfeed->profile_image) && !empty($storyfeed->profile_image)) { ?>
        				<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $storyfeed->profile_image;?>" alt="<?php echo $storyfeed->name;?>">
        			<?php } else { ?>
        				<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storyfeed->name;?>">
        			<?php } ?>
        			<span class="dropdown pull-right">
        				<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="Click Here to Report" aria-expanded="false">
        					<i class="fa fa-ellipsis-v pull-right"></i>
        				</a>
        				<ul class="dropdown-menu pull-right">
        					<li><?php if($storyfeed->type == 'story'){ ?>
        					    <a href="javascript:void(0);" onClick="reportstories(<?php echo $storyfeed->user_id;?>,<?php echo $storyfeed->sid;?>);"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
        					    <?php }else { ?>
        					    <a href="javascript:void(0);" onClick="reportseries(<?php echo $storyfeed->user_id;?>,<?php echo $storyfeed->sid;?>)"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
        					    <?php } ?>
        				    </li>
        				</ul>
        			</span>
        			<span class="username"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$storyfeed->profile_name; ?>"><?php echo $storyfeed->name;?></a></span>
        			<span class="description"><a href="<?php echo base_url().$this->uri->segment(1).'/'.'community/'.$storyfeed->gener; ?>">
        			    <i style="color:#040cff;"><?php echo $storyfeed->gener;?></i></a> - <?php echo get_ydhmdatetime($storyfeed->created_at);?></span>
        		</div>
        	</div>
        	<div class="box-body">
        		<div class="media border-box" style="margin-top:2px;">
        			<div class="media-left">
            		    <?php $hrefurl = "#"; $uriseg = get_langshortname($this->uri->segment(1)); if($storyfeed->type == 'story'){
            		        if(isset($uriseg) && !empty($uriseg) && ($uriseg != 'en')){
            		            $hrefurl = base_url().$this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid;
            		        }else{
            		            $hrefurl = base_url().'story/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid;
            		        }
            		    }elseif($storyfeed->type == 'series'){
            		        if(isset($uriseg) && !empty($uriseg) && ($uriseg != 'en')){
            		            $hrefurl = base_url().$this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid.'/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->story_id;
            		        }else{
            		            $hrefurl = base_url().'series/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid.'/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->story_id;
            		        }
            		    } ?>
        				<a href="<?php echo $hrefurl;?>" target="_blank">
        					<?php if(!empty($storyfeed->cover_image)) { ?>
        				    <img src="<?php echo base_url();?>assets/images/<?php echo $storyfeed->cover_image;?>" class="media-object img-v" alt="<?php echo $storyfeed->title;?>">
        				    <?php } else { ?>
        					<img src="<?php echo base_url();?>assets/default/feed_comm.jpeg" class="media-object img-v" alt="<?php echo $storyfeed->title;?>">
        					<?php } ?>
        				</a>
        			</div>
        			<div class="media-body" style="padding-top:15px;">
        				<a href="<?php echo $hrefurl;?>" target="_blank"> 
        					<h4 class="media-heading"><b><?php echo ucfirst($storyfeed->title);?></b></h4>
        				</a>
        				<p class="media-heading  edittext<?php echo $storyfeed->sid;?>"><?php echo strip_tags($storyfeed->story); ?></p>
        			</div>
        		</div>
        	</div>
        </div>
        <?php } ?>
    </div>
    <div id="sload_data_message"></div>
<?php } else{ ?><center><div style="padding-top:50px;">No Stories yet!</div></center><?php } ?>