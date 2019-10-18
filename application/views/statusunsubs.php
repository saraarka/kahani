<style type="text/css">
	.mail-but{
		border-radius: 5px;
		background:#3c8dbc;
		color: white;
		width: 300px;
		border: none;
		cursor: pointer;
		outline: none;
		letter-spacing:0.04em;
		padding: 15px 15px 15px 15px;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
		font-size: 16px;
	}
</style>
<div style="width: 100%; text-align: center;">
	<?php if(isset($sunsubs) && ($sunsubs == 'sunsubs')){ ?>
		<div style="padding-top: 20%; text-align: center;">
			<div>
				<img src="<?php echo base_url();?>assets/default/unsubssucces.png" class="img-responsive">
			</div>
			<div style="font-family: arial,sans-serif; margin: 5px 0px;"><center>SUCCESSFULLY UNSUBSCRIBED</center></div>
		</div>
	<?php } else if(isset($sunsubs) && ($sunsubs == 'wunsubs')){ ?>
		<div style="padding-top: 20%; text-align: center;">
			<div>
				<img src="<?php echo base_url();?>assets/default/unsubswarning.png" class="img-responsive">
			</div>
			<div style="font-family: arial,sans-serif; margin: 5px 0px;"><center>ALREADY UNSUBSCRIBED</center></div>
		</div>
	<?php } else{ ?>
		<div style="padding-top: 20%; text-align: center;">
			<div>
				<img src="<?php echo base_url();?>assets/default/unsubsfail.png" class="img-responsive">
			</div>
			<div style="font-family: arial,sans-serif; margin: 5px 0px;"><center>UNSUBSCRIPTION FAILED</center></div>
		</div>
	<?php } ?>
	<a href="<?php echo base_url();?>"> <button class="mail-but">GO BACK TO STORYCARRY</button></a>
</div>