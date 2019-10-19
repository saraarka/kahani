<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			.main-div{
			  width: 850px;
			  box-sizing:border-box;
			  padding:10px;
			  max-width:100%;
			  margin:0 auto;
			  font-family: 'arial', sans-serif;
			}

			.navbar{
			  width: 100%;
			  background: #3c8dbc;
			  color: white;
			  height: 50px;
			  border-radius: 5px;
			  font-weight: 400;
			  font-size: 1.2em;
			  padding: 0 15px;
			  box-sizing: border-box;
			  text-align: center;
			  line-height:50px
			}

			.navbar img{
			  margin-top: 6px;
			  float: left;
			}

			.mail-but{
			    border-radius: 5px;
			    background:#3c8dbc;
			    color: white;
			    width: 230px;
			    border: none;
			    cursor: pointer;
			    outline: none;
			    letter-spacing:0.04em;
			    padding: 15px 15px 15px 15px;
			    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
			    font-size: 16px;
			}

			.notification-text{
			  margin: 27px 10px;
			  font-size: 18px;
			}

			.text-link{
			  color:#3c8dbc;
			  cursor:pointer;
			}
		</style>
	</head>
	<body>
		<div class="main-div">
			<div class="navbar">
				<img src="<?php echo base_url();?>assets/default/writemobile.png" height="37px" width="auto">
				<span><?php if(isset($logotext) && !empty($logotext)){ echo $logotext; }else{ echo 'STORY CARRY'; }?></span>
			</div>
			<div style="text-align:center">
				<p class="notification-text">
					<span class="text-link"><?php if(isset($name) && !empty($name)){ echo $name; }else{ echo 'User'; }?></span>

					 <?php if(isset($bodytext) && !empty($bodytext)){ echo $bodytext; } ?>
					 
					<span class="text-link">
						<a href="<?php if(isset($storyurl) && !empty($storyurl)){ echo base_url().$storyurl; }?>">
							<?php if(isset($title) && !empty($title)){ echo $title; }else{ echo 'Story'; }?>
						</a>.
					</span>
				</p>
				<a href="<?php if(isset($storyurl) && !empty($storyurl)){ echo base_url().$storyurl; }?>" class="mail-but" style="color: #fff; text-decoration: none;">VIEW ON STORYCARRY</a>
				<hr style="border:none;border-top:1px solid #dddddd;margin:25px 0;">
				<p style="font-size:0.7em;color:#aaaaaa;margin:0 10px;">
					To stop receiving these emails from StoryCarry in the future, please 
					<span class="text-link">
					<?php if(isset($emailto) && !empty($emailto)){
						$unsubsurl = base_url().'emailunsubs/'.md5($emailto);
					}else{
						$unsubsurl = '#';
					} ?>
						<a href="<?php echo $unsubsurl;?>"> unsubscribe</a>
					</span>.
				</p> 
			</div>
		</div>
	</body>
</html>