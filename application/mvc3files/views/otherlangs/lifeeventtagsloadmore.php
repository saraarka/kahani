<?php if(isset($lifeeventtags) && ($lifeeventtags->num_rows() > 0)){ foreach($lifeeventtags->result() as $lifeeventtag) { ?>
    <div class="tagcards">
        <div class="tagtext"><a href="<?php echo base_url().$this->uri->segment(1);?>/searchresult?type=life&searchtext=<?php echo $lifeeventtag->tagname;?>">#<?php echo $lifeeventtag->tagname;?></a></div>
        <div class="tagnumbertext"><?php echo $lifeeventtag->tagcount;?> POSTS</div>
    </div>
<?php } } ?>