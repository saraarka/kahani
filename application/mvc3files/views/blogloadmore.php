<?php if(isset($blogsload) && ($blogsload->num_rows() > 0)) { foreach($blogsload->result() as $blog) { ?>
    <div class="inner-div">
        <a href="<?php echo base_url();?>blog/<?php echo preg_replace("~[^\p{M}\w]+~u", '-', $blog->caption).'-'.$blog->id;?>">
            <img src="<?php echo base_url().'assets/images/'.$blog->slideimage;?>" class="but" alt="build audience">
            <div>
                <h1 class="div-text"><?php echo $blog->caption;?></h1>
            </div>
        </a>
    </div>
<?php } } ?>