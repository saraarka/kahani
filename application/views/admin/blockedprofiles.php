    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <h3> Blocked Profiles </h3>
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <table id="tblpagination" class="display table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Profile Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Language</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="usersearchsortresult">
                <?php if(isset($bprofiles) && ($bprofiles->num_rows() > 0)){ $i = 1; foreach($bprofiles->result() as $bprofile){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/profilestories/<?php echo $bprofile->user_id;?>" target="_blank"><?php echo $bprofile->profile_name;?></a></td>
                        <td><?php echo $bprofile->name.' '.$bprofile->lastname;?></td>
                        <td><?php echo $bprofile->email;?></td>
                        <td><?php echo $bprofile->phone;?></td>
                        <td><?php echo $bprofile->writer_language;?></td>
                        <td>
                            <?php if($bprofile->admin_status == 'unblock'){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockprofile/<?php echo $bprofile->user_id;?>"> Block </a>
                            <?php }else{ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockprofile/<?php echo $bprofile->user_id;?>"> Unblock </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>