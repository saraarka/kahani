<?php if(isset($blogcomments) && ($blogcomments->num_rows() > 0)){ ?>
    <div class="list-comments">
        <?php foreach($blogcomments->result() as $blogcomment) { ?>
            <div><?php echo $blogcomment->comment; ?></div>
        <?php } ?>
    </div>
<?php } ?>