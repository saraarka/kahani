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
				<span>FORGET PASSWORD LINK</span>
			</div>
			<div style="text-align:center">
				<p class="notification-text">
					Forgot password link should expire in 5 hours.
				</p>
				<?php if(isset($forgotpwdurl) && !empty($forgotpwdurl)){ ?>
					<a href="<?php echo $forgotpwdurl;?>" class="mail-but" style="color: #fff; text-decoration: none;">CLICK HERE</a>
				<?php } else{ ?>
					<button class="mail-but">CLICK HERE</button>
				<?php } ?>
				<hr style="border:none;border-top:1px solid #dddddd;margin:25px 0;">
			</div>
		</div>
	</body>
</html>