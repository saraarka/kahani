    <?php if(isset($usersearch) && ($usersearch->num_rows() > 0)){ $j = 1; foreach($usersearch->result() as $usersearchrow){ ?>
        <tr>
            <td>#<?php echo $j;?></td>
            <td><a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/profilestories/<?php echo $usersearchrow->user_id;?>" target="_blank"><?php echo $usersearchrow->profile_name;?></a></td>
            <td><?php echo $usersearchrow->name.' '.$usersearchrow->lastname;?></td>
            <td><?php echo $usersearchrow->email;?></td>
            <td><?php echo $usersearchrow->phone;?></td>
            <td><?php echo $usersearchrow->writer_language;?></td>
            <td><?php if($usersearchrow->user_activation == 1){ echo 'verified'; }else{ echo 'Not verified'; } ?></td>
            <td><?php echo $usersearchrow->monetisation;?></td>
            <td><?php echo substr($usersearchrow->created_at,0,10);?></td>
            <td>
                <?php if($usersearchrow->admin_status == 'unblock'){ ?>
                <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockprofile/<?php echo $usersearchrow->user_id;?>"> Block </a>
                <?php }else{ ?>
                <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockprofile/<?php echo $usersearchrow->user_id;?>"> Unblock </a>
                <?php } ?>
                <?php if($usersearchrow->admin_verify == 'not_verified'){ ?>
                <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/verifyprofile/<?php echo $usersearchrow->user_id;?>"> To be Verify</a>
                <?php } else{ ?>
                <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/notverifyprofile/<?php echo $usersearchrow->user_id;?>"> Verified </a>
                <?php } ?>
                <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteprofile/<?php echo $usersearchrow->user_id;?>"  onclick="return confirm('Are you sure? Do you want to Delete the User?')"> Delete </a>
            </td>
        </tr>
    <?php $j++; } } ?>