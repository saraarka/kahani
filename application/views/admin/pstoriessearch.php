<!--<?php if(isset($pstoriessearch) && ($pstoriessearch->num_rows() > 0)){ $j = 1; foreach($pstoriessearch->result() as $pstorysearch){ ?>
    <tr>
        <td>#<?php echo $j;?></td>
        <td><?php echo $pstorysearch->title;?></td>
        <td><?php echo $pstorysearch->name.' '.$pstorysearch->lastname;?></td>
        <td><?php echo $pstorysearch->type;?></td>
        <td><?php echo $pstorysearch->gener;?></td>
        <td><?php echo $pstorysearch->language;?></td>
        <td><?php echo $pstorysearch->views;?></td>
        <td><?php echo $pstorysearch->uniqueviews;?></td>
        <td><?php echo $pstorysearch->draft;?></td>
        <td><?php echo $pstorysearch->pay_story;?></td>
        <td><?php echo substr($pstorysearch->date,0,10);?></td>
        <td>
            <?php if($pstorysearch->type == 'story'){ ?>
            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $pstorysearch->sid;?>);"> Admin Choice </a>
            <?php } ?>
            <a href="javascript:void(0);" onClick="storyreports(<?php echo $pstorysearch->sid;?>);"> Report </a>
            <a href="<?php echo base_url();?>index.php/telugu_admin/deletestory/<?php echo $pstorysearch->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
        </td>
    </tr>
<?php $j++; } } ?>-->
<?php if(isset($pstoriessearch) && ($pstoriessearch->num_rows() > 0)){ $j = 1; foreach($pstoriessearch->result() as $pstorysearch){ 
    if(($pstorysearch->type == 'series') && ($pstorysearch->sid == $pstorysearch->story_id)){ ?>
    <tr>
        <td>#<?php echo $j;?></td>
        <?php $storyurl = base_url().'index.php/'.$this->uri->segment(1).'/new_series?id='.$pstorysearch->sid.'&story_id='.$pstorysearch->sid; ?>
        <td><a href="<?php echo $storyurl; ?>" target="_blank"><?php echo $pstorysearch->title;?></a></td>
        <td><?php echo $pstorysearch->name.' '.$pstorysearch->lastname;?></td>
        <td><?php echo $pstorysearch->type;?></td>
        <td><?php echo $pstorysearch->gener;?></td>
        <td><?php echo $pstorysearch->language;?></td>
        <td><?php echo $pstorysearch->views;?></td>
        <td><?php echo $pstorysearch->uniqueviews;?></td>
        <td><?php echo $pstorysearch->draft;?></td>
        <td><?php echo $pstorysearch->pay_story;?></td>
        <td><?php echo substr($pstorysearch->date,0,10);?></td>
        <td>
            <?php if($pstorysearch->type == 'story'){ ?>
            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $pstorysearch->sid;?>);"> Admin Choice </a>
            <?php } ?>
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $pstorysearch->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
        </td>
    </tr>
<?php $j++; }else if(($pstorysearch->type == 'series') && ($pstorysearch->sid != $pstorysearch->story_id)){ ?>
<?php } else{ ?>
    <tr>
        <td>#<?php echo $j;?></td>
        <?php $storyurl = '#';   if(($pstorysearch->type == 'story') || ($pstorysearch->type == 'life')){
            $storyurl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$pstorysearch->sid; } ?>
        <td><a href="<?php echo $storyurl; ?>" target="_blank"><?php echo $pstorysearch->title;?></a></td>
        <td><?php echo $pstorysearch->name.' '.$pstorysearch->lastname;?></td>
        <td><?php echo $pstorysearch->type;?></td>
        <td><?php echo $pstorysearch->gener;?></td>
        <td><?php echo $pstorysearch->language;?></td>
        <td><?php echo $pstorysearch->views;?></td>
        <td><?php echo $pstorysearch->uniqueviews;?></td>
        <td><?php echo $pstorysearch->draft;?></td>
        <td><?php echo $pstorysearch->pay_story;?></td>
        <td><?php echo substr($pstorysearch->date,0,10);?></td>
        <td>
            <?php if($pstorysearch->type == 'story'){ ?>
            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $pstorysearch->sid;?>);"> Admin Choice </a>
            <?php } ?>
            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $pstorysearch->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
        </td>
    </tr>
<?php $j++; } } } ?>