<!--<?php if(isset($storiessearch) && ($storiessearch->num_rows() > 0)){ $j = 1; foreach($storiessearch->result() as $storysearch){ ?>
    <tr>
        <td>#<?php echo $j;?></td>
        <td><?php echo $storysearch->title;?></td>
        <td><?php echo $storysearch->name.' '.$storysearch->lastname;?></td>
        <td><?php echo $storysearch->type;?></td>
        <td><?php echo $storysearch->gener;?></td>
        <td><?php echo $storysearch->language;?></td>
        <td><?php echo $storysearch->views;?></td>
        <td><?php echo $storysearch->uniqueviews;?></td>
        <td><?php echo $storysearch->draft;?></td>
        <td><?php echo $storysearch->pay_story;?></td>
        <td><?php echo substr($storysearch->date,0,10);?></td>
        <td>
            <?php if($storysearch->type == 'story'){ ?>
            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $storysearch->sid;?>);"> Admin Choice </a>
            <?php } ?>
            <a href="javascript:void(0);" onClick="storyreports(<?php echo $storysearch->sid;?>);"> Report </a>
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $storysearch->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
        </td>
    </tr>
<?php $j++; } } ?> -->

<?php if(isset($storiessearch) && ($storiessearch->num_rows() > 0)){ $j = 1;  foreach($storiessearch->result() as $storysearch){ 
    if(($storysearch->type == 'series') && ($storysearch->sid == $storysearch->story_id)){ ?>
    <tr>
        <td>#<?php echo $j;?></td>
        <?php $storyurl = base_url().'index.php/'.$this->uri->segment(1).'/new_series?id='.$storysearch->sid.'&story_id='.$storysearch->sid; ?>
        <td><a href="<?php echo $storyurl; ?>" target="_blank" style="word-break: break-word;"><?php echo $storysearch->title;?></a></td>
        <td><?php echo $storysearch->name.' '.$storysearch->lastname;?></td>
        <td><?php echo $storysearch->type;?></td>
        <td><?php echo $storysearch->gener;?></td>
        <td><?php echo $storysearch->language;?></td>
        <td><?php echo $storysearch->views;?></td>
        <td><?php echo $storysearch->uniqueviews;?></td>
        <td><?php echo $storysearch->draft;?></td>
        <td><?php echo $storysearch->pay_story;?></td>
        <td><?php echo substr($storysearch->date,0,10);?></td>
        <td>
            <?php if($storysearch->type == 'story'){ ?>
            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $storysearch->sid;?>);"> Admin Choice </a>
            <?php } ?>
            <!--<a href="javascript:void(0);" onClick="storyreports(<?php echo $storysearch->sid;?>);"> Report </a> -->
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $storysearch->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
            <a href="javascript:void(0);" onClick="adsstory(<?php echo $storysearch->sid;?>);"> Ads </a>
        </td>
    </tr>
<?php $j++; }else if(($storysearch->type == 'series') && ($storysearch->sid != $storysearch->story_id)){ ?>
<?php } else{ ?>
    <tr>
        <td>#<?php echo $j;?></td>
        <?php $storyurl = '#';   if(($storysearch->type == 'story') || ($storysearch->type == 'life')){
            $storyurl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$storysearch->sid; } ?>
        <td><a href="<?php echo $storyurl; ?>" target="_blank" style="word-break: break-word;"><?php echo $storysearch->title;?></a></td>
        <td><?php echo $storysearch->name.' '.$storysearch->lastname;?></td>
        <td><?php if($storysearch->type == 'nano') { ?>
            <a href="<?php echo base_url().'welcome/nano_view/'.$storysearch->sid; ?>" target="_blank"><?php echo $storysearch->type;?></a></td>
        <?php }else{ echo $storysearch->type; } ?>
        <td><?php echo $storysearch->gener;?></td>
        <td><?php echo $storysearch->language;?></td>
        <td><?php echo $storysearch->views;?></td>
        <td><?php echo $storysearch->uniqueviews;?></td>
        <td><?php echo $storysearch->draft;?></td>
        <td><?php echo $storysearch->pay_story;?></td>
        <td><?php echo substr($storysearch->date,0,10);?></td>
        <td>
            <?php if($storysearch->type == 'story'){ ?>
            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $storysearch->sid;?>);"> Admin Choice </a>
            <?php } ?>
            <!--<a href="javascript:void(0);" onClick="storyreports(<?php echo $storysearch->sid;?>);"> Report </a> -->
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $storysearch->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
            <a href="javascript:void(0);" onClick="adsstory(<?php echo $storysearch->sid;?>);"> Ads </a>
        </td>
    </tr>
<?php $j++; } } } ?>