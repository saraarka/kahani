<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8"/>
<title>About us - Story Carry </title>
<meta name="title" content="About us - Story Carry">
<meta name="description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
<link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="About us - Story Carry">
<meta property="og:description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
<meta property="og:url" content="https://storycarry.com/about-us">
<meta property="og:type" content="website">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/about.css">
</head>
<body>
    <header>
        <span style="background: linear-gradient(to right, green 0%, #5658ae 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;margin-left:15px;color: white"><a href="<?php echo base_url();?>">StoryCarry.com</a></span>
        <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
            <span class="login-but"><a href="<?php echo base_url();?>">HOME</a></span>
        <?php } else{ ?>
            <span class="login-but"><a href="<?php echo base_url();?>">SIGN UP</a></span>
        <?php } ?>
    </header>

    <div class="top-div"> 
        <div >
            <h1 style="text-align:center;color:black;font-family:arial;" class="about">About Us</h1>
        </div>
        <div class="intro-txt">We all have stories to tell and we don't want <br>stories to end, there are many ways to continue<br> stories and this platform is one of them.</div>
    </div>
    <div style="font-family: 'Muli', sans-serif; text-align: center">
        <h2 class="things">Things you can do in here</h2>
    </div>

<div class="sec-div">
    <div class="apps">
        <div>
            <button style="background:linear-gradient(-60deg, RoyalBlue,aqua);" class="but"><img src="<?php echo base_url();?>assets/images/book-reader-solid.svg" />
            </button>
        </div>
        <font class="title">READ</font>
    </div> 
  
    <div class="apps">
        <div>
            <button style="background:linear-gradient(-60deg, yellow,red);" class="but"><img src="<?php echo base_url();?>assets/images/pen-fancy-solid.svg" />
            </button>
        </div>
        <font class="title">WRITE</font>
    </div> 

    <div class="apps">
        <div>
            <button style="background:linear-gradient(-60deg, rgb(47, 68, 52),red);" class="but"><img src="<?php echo base_url();?>assets/images/book-solid.svg" />
            </button>
        </div>
        <font class="title">STORIES</font>
    </div> 
    
    <div class="apps">
        <div>
            <button style="background:linear-gradient(-60deg, green,pink);" class="but"><img src="<?php echo base_url();?>assets/images/hiking-solid.svg" />
            </button>
        </div>
        <font class="title">LIFE INCIDENTS</font>
    </div> 
    
    <div class="apps">
        <div>
            <button style="background:linear-gradient(-60deg, RoyalBlue,brown);" class="but"><img src="<?php echo base_url();?>assets/images/eye-slash-solid.svg" />
            </button>
        </div>
        <font class="title">BE ANONYMOUS</font>
    </div> 
    
    <div class="apps">
        <div>
            <button style="background:linear-gradient(-60deg, grey,aqua);" class="but"><img src="<?php echo base_url();?>assets/images/users-solid.svg" />
            </button>
        </div>
        <font class="title">CONNECT</font>
    </div> 
    
    
    <div class="apps">
        <div>
            <button style="background:linear-gradient(-45deg, brown,grey);" class="but">
                <img src="<?php echo base_url();?>assets/images/coins-solid.svg" />
            </button>
        </div>
        <font class="title">EARN</font>
    </div> 
</div>

<div class="final-div"> 
    <div class="second-col">
        <img src="<?php echo base_url();?>/assets/landing/aboutusimage.jpeg" class="col-img" alt="Indian online story writing" width="100%" height="100%">
    </div>
    <div class="first-col">
        <h2>Our vision</h2>
        <font style="font-size: 1.3em;float: left;margin-bottom: 26px;">
            <span style="font-weight:bold;color: navy;">
                <i class="fas fa-quote-left"></i> No one else sees the world the way you do, so no one else can tell stories that you 
                have to tell.
            </span>
            <br><br> We aim to bring out those stories and life incidents from you and other 440 million Indians who are estimated to 
            access Internet in next 2 years, by providing a language based reliable self-publishing platform.
        </font>
        <font style="font-size: 0.6em;">Quote by: Charles de Lint</font>
    </div>
</div>

<style>
.swap-on-hover {
    position: relative;	
	margin:  0 auto;
	max-width: 400px;
}
.swap-on-hover img {
    position: absolute;
    top:0;
    left:0;
	overflow: hidden;
	/* Sets the width and height for the images*/
	width: 400px;
	height: 400px;
}
.swap-on-hover .swap-on-hover__front-image {
    z-index: 9999;
    transition: opacity .5s linear;
    cursor: pointer;
}
.swap-on-hover:hover > .swap-on-hover__front-image{
    opacity: 0;
}
</style>

<div class="footer">
    <font style="float:left;font-size: 18px;margin-top: 8px;margin-left:10px;font-family: 'Varela Round', sans-serif;" class="copyright">
        Copyright © 2019 Story Carry
    </font>
    <div class="socialbtns">
        <!--<font style="font-size:14px;color:black;font-family: 'Varela Round', sans-serif;" class="socialmedia">SOCIAL MEDIA : </font>-->
        <a href=""><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/facebook-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="facebook storycarry"></a>
        <a href=""><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/instagram-brands.svg" alt="instagram storycarry" style="margin-right:6px;cursor:pointer; width:21px;height:24px"></a>
        <a href=""><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/twitter-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="twitter storycarry"></a>
        <a href=""><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/quora-brands.svg" style="cursor:pointer;width:21px;height:24px" alt="Quora storycarry"></a>
    </div>
</div>
<div class="footer1">
    <div style="font-size:14px;color:black;font-family: 'Varela Round', sans-serif;">
        <center>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url();?>blog">BLOG</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url();?>contact">CONTACT</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url();?>terms-conditions">TERMS</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url();?>privacy-policy">PRIVACY</a></font>
        </center>
    </div>
</div>

</body>