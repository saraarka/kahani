<?php if(isset($drafts) && ($drafts->num_rows() > 0)) { foreach($drafts->result() as $draft) { ?>
    <div class="deletedraft<?php echo $draft->sid;?>">
        <div class="row pt-0">
            <div class="col-md-10 col-xs-10" style="word-wrap:break-word;padding-left:0;padding-right:0;">
                <h2 style="margin-top:0;margin-bottom:5px;line-height: initial;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;overflow: hidden; width:80%;"><?php echo $draft->title;?></h2>
                <div style="margin:0; line-height: initial;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;overflow: hidden; width:90%;">
                    <?php echo strip_tags(substr($draft->story, 0, 50));?>
                </div>
            </div>
            <div class="col-md-2 col-xs-1 pull-right" style="padding-left:0;padding-right:0;">
                <div class="dropdown  pull-right">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="padding-top: 0px; padding-bottom: 10px;">
					    <span><i class="fa fa-ellipsis-v"></i></span>
					</a>
                    <ul class="dropdown-menu pull-right">
                        <li class="desktopedit">
                            <?php if($draft->type == 'series') { ?>
                        	<a href="<?php echo base_url();?>series_series/<?php echo $draft->sid;?>"><i class="fa fa-edit pr-10"></i> EDIT</a>
                        	<?php }else { ?>
                        	<a href="<?php echo base_url();?>series_story/<?php echo $draft->sid;?>"><i class="fa fa-edit pr-10"></i> EDIT</a>
                        	<?php } ?>
                        </li>
                        <li class="mobileedit">
                            <?php if($draft->type == 'series') { ?>
                        	<a onclick="mobileseriesedit(<?php echo $draft->sid; ?>)" data-toggle="modal" data-target="#writeapp" id="notloginmodal"><i class="fa fa-edit pr-10"></i> EDIT</a>
                        	<?php } else { ?>
                        	<a onclick="mobilestoryedit(<?php echo $draft->sid; ?>)" data-toggle="modal" data-target="#writeapp" id="notloginmodal"><i class="fa fa-edit pr-10"></i> EDIT</a>
                        	<?php } ?>
                        </li>
                        <li>
                        	<a href="javascript:void(0);" onclick="deletedraft(<?php echo $draft->sid;?>)"><i class="fa fa-trash pr-10"></i> DELETE</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="padding-left:0;padding-right:0;">
            <p>Last updated <?php echo date("F j, Y", strtotime($draft->date));?></p>
            <hr style="margin-top:2px;">
        </div>
    </div>
<?php } } ?>