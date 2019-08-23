<?php if(isset($storyreports) && ($storyreports->num_rows() > 0)){ ?>
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Reported By</th>
            <th>Message</th>
            <th>Created Date</th>
        </tr>
    </thead>
    <tbody>
    <?php $j = 1; foreach($storyreports->result() as $storyreport){ ?>
        <tr>
            <td>#<?php echo $j;?></td>
            <td><?php echo $storyreport->name.' '.$storyreport->lastname;?></td>
            <td><?php echo $storyreport->report_msg;?></td>
            <td><?php echo substr($storyreport->created_at,0,10);?></td>
        </tr>
    <?php $j++; } ?>
    </tbody>
<?php } ?>