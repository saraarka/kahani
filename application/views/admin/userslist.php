    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Writers List 
            <span class="pull-right" id="usersearchsort">
                Search : <input type="text" class="form-control" id="search">
                Filter: <select class="form-control" id="language"> 
                            <option value=""> -- By Language -- </option>
                            <?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $language){ ?>
                            <option value="<?php echo $language->code;?>"><?php echo $language->language;?> </option>
                            <?php } } ?>
                        </select>
                        <select class="form-control" id="emailverify"> 
                            <option value=""> -- By Email Verification -- </option>
                            <option value="1"> Verified </option>
                            <option value="2"> Not Verified </option>
                        </select>
                        <select class="form-control" id="monetisation"> 
                            <option value=""> -- By Monetisation -- </option>
                            <option value="yes">  Monetised </option>
                            <option value="no"> Not Monetised </option>
                        </select>
            </span>
        </h3>
        <table id="tblpagination" class="display table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Profile Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Language</th>
                    <th>Status</th>
                    <th>Monetisation</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="usersearchsortresult">
                <?php if(isset($userslist) && ($userslist->num_rows() > 0)){ $i = 1; foreach($userslist->result() as $userrow){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/profilestories/<?php echo $userrow->user_id;?>" target="_blank"><?php echo $userrow->profile_name; if($userrow->user_activation == 1){ ?>
                                <span class="glyphicon glyphicon-ok-circle" title="Verified"></span>
                            <?php } ?></a></td>
                        <td><?php echo $userrow->name.' '.$userrow->lastname; ?>
                        </td>
                        <td><?php echo $userrow->email;?></td>
                        <td><?php echo $userrow->phone;?></td>
                        <td><?php echo $userrow->writer_language;?></td>
                        <td><?php if($userrow->user_activation == 1){ echo 'verified'; }else{ echo 'Not verified'; } ?></td>
                        <td><?php echo $userrow->monetisation;?></td>
                        <td><?php echo substr($userrow->created_at,0,10);?></td>
                        <td>
                            <?php if($userrow->admin_status == 'unblock'){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockprofile/<?php echo $userrow->user_id;?>"> Block </a>
                            <?php }else{ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockprofile/<?php echo $userrow->user_id;?>"> Unblock </a>
                            <?php } ?>
                            <?php if($userrow->admin_verify == 'not_verified'){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/verifyprofile/<?php echo $userrow->user_id;?>"> To be Verify</a>
                            <?php } else{ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/notverifyprofile/<?php echo $userrow->user_id;?>"> Verified </a>
                            <?php } ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteprofile/<?php echo $userrow->user_id;?>"  onclick="return confirm('Are you sure? Do you want to Delete the User?')"> Delete </a>
                            <a href="javascript:void(0);" onclick="addearnings(<?php echo $userrow->user_id;?>);"> Add Earnings </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    
    <div id="addearnings" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Total Earnings</h4>
                </div>
                <div class="modal-body">
                    <h5>Enter Total Earnings Count</h5>
                    <input type="hidden" id="userid" value="">
                    <input type="number" class="form-control" id="earningcount" placeholder="Enter earnings" required><br>
                    <center><button type="submit" onclick="addearningcount();" class="btn btn-primary">Submit</button></center>
                </div>
            </div>
        </div>
    </div>
    
    <?php $this->load->view('admin/footer.php'); ?>