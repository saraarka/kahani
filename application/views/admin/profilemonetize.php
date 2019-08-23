    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Profile Monetisation Requests </h3>
        <table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Profile Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Language</th>
                    <th>Monetisation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="usersearchsortresult">
                <?php if(isset($mprofiles) && ($mprofiles->num_rows() > 0)){ $i = 1; foreach($mprofiles->result() as $mprofile){ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <td><a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/profilestories/<?php echo $mprofile->user_id;?>" target="_blank"><?php echo $mprofile->profile_name;?></a></td>
                        <td><?php echo $mprofile->name.' '.$mprofile->lastname;?></td>
                        <td><?php echo $mprofile->email;?></td>
                        <td><?php echo $mprofile->phone;?></td>
                        <td><?php echo $mprofile->writer_language;?></td>
                        <td id="m<?php echo $mprofile->user_id;?>"><?php echo $mprofile->monetisation;?></td>
                        <td>
                            <?php if(($mprofile->monetisation == 'no') && ($mprofile->mstatus == 'monitize')){ ?>
                            <a href="javascript:void(0);" id="ma<?php echo $mprofile->user_id;?>" onClick="monitizeuser(<?php echo $mprofile->user_id;?>)">Monetise</a>
                            <?php } elseif(($mprofile->monetisation == 'yes') && ($mprofile->mstatus == 'unmonitize')){ ?>
                            <a href="javascript:void(0);" id="ma<?php echo $mprofile->user_id;?>" onClick="unmonitizeuser(<?php echo $mprofile->user_id;?>)">Remove Monetise</a>
                            <?php } ?>
                            <a href="javascript:void(0);" onClick="profileads(<?php echo $mprofile->user_id;?>)">Ads</a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>