<?php if(isset($reportssearch) && ($reportssearch->num_rows() > 0)){ $j = 1; foreach($reportssearch->result() as $reportsearch){ ?>
    <tr>
        <td>#<?php echo $j;?></td>
        <?php if(isset($reportsearch->type) && (($reportrow->type == 'story') || ($reportrow->type == 'life'))){
                $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$reportsearch->story_id;
            }elseif(isset($reportsearch->type) && ($reportsearch->type == 'series')){
                 $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/new_series?id='.$reportsearch->story_id.'&story_id='.$reportsearch->story_id;
            }else{ $redirecturl = '#'; } ?>
        <td><a href="<?php echo $redirecturl;?>" target="_blank"><?php echo $reportsearch->title;?></a></td>
        <td><?php echo $reportsearch->postedtoname.' '.$reportsearch->postedtolastname;?></td>
        <td><?php echo $reportsearch->reported_by;?></td>
        <td><?php echo $reportsearch->type;?></td>
        <td><?php echo $reportsearch->report_msg;?></td>
        <td><?php echo substr($reportsearch->created_at,0,10);?></td>
        <td>
        <?php if(isset($reportsearch->type) && ($reportsearch->type == 'story')){ ?>
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockstory/<?php echo $reportsearch->story_id;?>"> Block </a>
        <?php } elseif(isset($reportsearch->type) && ($reportsearch->type == 'series')){ ?>
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockseries/<?php echo $reportsearch->story_id;?>"> Block </a>
        <?php } else { ?>
            <a href="#"> Block </a>
        <?php } ?>
        <?php if(isset($reportsearch->type) && ($reportsearch->type == 'story')){ ?>
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $reportsearch->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
        <?php } elseif(isset($reportsearch->type) && ($reportsearch->type == 'series')){ ?>
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteseries/<?php echo $reportsearch->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
        <?php } else { ?>
            <a href="#" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
        <?php } ?>
        </td>
    </tr>
<?php $j++; } } ?>