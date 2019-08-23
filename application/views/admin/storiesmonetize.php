    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Stories Monetisation List </h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Writer</th>
                    <th>Type</th>
                    <!--<th>Unique Views</th>-->
                    <th>Ads 1</th>
                    <th>Ads 2</th>
                    <th>Ads 3</th>
                    <th>Ads 4</th>
                    <th>Monitize</th>
                    <th>Monitize Status</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="storiessearchresults">
                <?php if(isset($mstories) && ($mstories->num_rows() > 0)){ $i = 1; foreach($mstories->result() as $mstory){ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <td><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$mstory->sid; ?>" target="_blank"><?php echo $mstory->title;?></a></td>
                        <td><?php echo $mstory->name.' '.$mstory->lastname;?></td>
                        <td><?php echo $mstory->type;?></td>
                        <!--<td><?php echo $mstory->uvcount;?></td>-->
                        <td class="sadd1<?php echo $mstory->sid;?>"><?php echo $mstory->sadd1; if(!empty($mstory->sadd1)){ ?>
                            <a onClick="removead('sadd1',<?php echo $mstory->sid;?>);">X</a><?php } ?>
                        </td>
                        <td class="sadd2<?php echo $mstory->sid;?>"><?php echo $mstory->sadd2; if(!empty($mstory->sadd2)){ ?>
                            <a onClick="removead('sadd2',<?php echo $mstory->sid;?>);">X</a><?php } ?>
                        </td>
                        <td class="sadd3<?php echo $mstory->sid;?>"><?php echo $mstory->sadd3; if(!empty($mstory->sadd3)){ ?>
                            <a onClick="removead('sadd3',<?php echo $mstory->sid;?>);">X</a><?php } ?>
                        </td>
                        <td class="sadd4<?php echo $mstory->sid;?>"><?php echo $mstory->sadd4; if(!empty($mstory->sadd4)){ ?>
                            <a onClick="removead('sadd4',<?php echo $mstory->sid;?>);">X</a><?php } ?>
                        </td>
                        <td><?php echo $mstory->pay_story;?></td>
                        <td id="s<?php echo $mstory->sid;?>"><?php echo $mstory->smonetisation;?></td>
                        <td><?php echo substr($mstory->date,0,10);?></td>
                        <td>
                            <?php if(($mstory->pay_story == 'Y') && (($mstory->smonetisation == 'yes'))){ ?>
                            <a href="javascript:void(0);" onClick="disablesmonetize(<?php echo $mstory->sid;?>);" id="sa<?php echo $mstory->sid;?>"> Disable </a>
                            <?php } else if(($mstory->pay_story == 'Y') && (($mstory->smonetisation == 'no'))){ ?>
                            <a href="javascript:void(0);" onClick="enablesmonetize(<?php echo $mstory->sid;?>);" id="sa<?php echo $mstory->sid;?>"> Enable </a>
                            <?php } else if(($mstory->pay_story == 'N') && (($mstory->smonetisation == 'yes'))){ ?>
                            <a href="javascript:void(0);" onClick="disablesmonetize(<?php echo $mstory->sid;?>);"> Remove </a><!-- removesmonetize -->
                            <?php } ?>
                            <a href="javascript:void(0);" onClick="adsstory(<?php echo $mstory->sid;?>);"> Ads </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    
    <div id="mstoryads" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ads Script</h4>
                </div>
                <div class="modal-body">
                    <h5>Enter Ad Script</h5>
                    <input type="hidden" id="storyid" value="">
                    <textarea class="form-control" id="adstext" placeholder="Your ad script goes here" required></textarea><br>
                    <center><button type="submit" onclick="adsstoryscript();" class="btn btn-primary">Submit</button></center>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>