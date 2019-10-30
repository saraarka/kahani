<?php if(isset($defaultimages) && ($defaultimages->num_rows() > 0)){
	foreach($defaultimages->result() as $defaultimage){ ?>
    	<img class="selectimg<?php echo $defaultimage->id;?>" src="<?php echo base_url();?>assets/images/<?php echo $defaultimage->dimage;?>" onclick="selectimg(<?php echo $defaultimage->id;?>)">
	<?php } ?>
	<div class="image-loadmore"><button onclick="searchimage(6, <?php echo $sstart;?>)">LOAD MORE</button></div>
<?php } ?>