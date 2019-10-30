
<html lang="en">
    
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
<meta charset="utf-8"/>
<title>PRIVACY - Story Carry </title>
<meta name="title" content="PRIVACY - Story Carry">
<meta name="description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
<link rel="shortcut icon" href="logotop.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta property="og:title" content="PRIVACY - Story Carry">
<meta property="og:description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
<meta property="og:url" content="<?php echo base_url();?>privacy">
<meta property="og:type" content="website">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/terms.css">
</head>
<body>
<header>
        <font style="background: linear-gradient(to right, green 0%, #5658ae 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;margin-left:15px;color: white"><a href="<?php echo base_url();?>">StoryCarry.com</a></font>
        <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
            <font class="login-but"><a href="<?php echo base_url();?>">HOME</a></font>
        <?php } else{ ?>
            <font class="login-but pull-right" style="float:right;"><a href="<?php echo base_url();?>">SIGN UP</a></font>
        <?php } ?>
    </header>
<div class="main-content"> 
    <div class="body-padding">
        <div class="">
            <h1 style="text-align:center;color:black;font-family:arial;" class="termsv">PRIVACY POLICY</h1>
        </div>
        <div class="terms-text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </div>
        <div class="terms-text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </div>
        <div class="terms-text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </div>
        <div class="terms-text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </div>
        <div class="terms-text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </div>
        <div class="terms-text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </div>
    </div>
</div>
<div class="footer">
        <font style="float:left;font-size: 18px;margin-top: 8px;margin-left:10px;font-family: 'Varela Round', sans-serif;" class="copyright">
        Copyright © 2019 Story Carry
        </font>
        <div class="socialbtns">
    <img src="<?php echo base_url();?>/assets/landing/svg/facebook-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="facebook storycarry">
    <img src="<?php echo base_url();?>/assets/landing/svg/instagram-brands.svg" alt="instagram storycarry" style="margin-right:6px;cursor:pointer; width:21px;height:24px">
    <img src="<?php echo base_url();?>/assets/landing/svg/twitter-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="twitter storycarry">
   <img src="<?php echo base_url();?>/assets/landing/svg/quora-brands.svg" style="cursor:pointer;width:21px;height:24px" alt="Quora storycarry">
        
        </div>
        </div>
<div class="footer1">
    <div style="font-size:14px;color:black;font-family: 'Varela Round', sans-serif;">
        <center>
            <font class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>about" style="color:#000;">ABOUT</a></font>
            <font class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>blog" style="color:#000;">BLOG</a></font>		
            <font class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>contact" style="color:#000;">CONTACT</a></font>		            <font class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>contact" style="color:#000;">CONTACT</a></font>
            <font class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>terms-conditions" style="color:#000;">TERMS</a></font>
        </center>
    </div>
</div>
</body>