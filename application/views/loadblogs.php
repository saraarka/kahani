<?php if(isset($blogs) && ($blogs->num_rows() > 0)){ foreach($blogs->result() as $blog){ ?>
<div class="inner-div">
    <a href="<?php echo base_url();?>index.php/welcome/blogdetail/<?php echo $blog->id;?>">
        <img src="<?php echo base_url().'assets/images/'.$blog->slideimage;?>" class="but" alt="build audience">
        <div>
            <h1 class="div-text"><?php echo $blog->caption;?></h1>
        </div>
    </a>
</div>
<?php } } ?>