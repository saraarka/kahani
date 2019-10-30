<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Story Carry</title>
</head>
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

<body>
	<div style="width: 100%; text-align: center;">
		<?php if(isset($response) && ($response == 'sunsubs')){ ?>
			<div style="padding-top: 15%; text-align: center;">
				<div style="font-family: arial,sans-serif; margin: 5px 0px;"><center>SUCCESSFULLY UNSUBSCRIBED</center></div>
			</div>
		<?php } else if(isset($response) && ($response == 'wunsubs')){ ?>
			<div style="padding-top: 15%; text-align: center;">
				<div style="font-family: arial,sans-serif; margin: 5px 0px;"><center>ALREADY UNSUBSCRIBED</center></div>
			</div>
		<?php } else{ ?>
			<div style="padding-top: 15%; text-align: center;">
				<div style="font-family: arial,sans-serif; margin: 5px 0px;"><center>UNSUBSCRIPTION FAILED</center></div>
			</div>
		<?php } ?>
		<a href="<?php echo base_url();?>"> <button class="mail-but">GO BACK TO STORYCARRY</button></a>
	</div>
</body>
</html>