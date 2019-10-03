<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8"/>
        <title>Contact - Story Carry </title>
        <meta name="title" content="Contact - Story Carry">
        <meta name="description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="Contact - Story Carry">
        <meta property="og:description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
        <meta property="og:url" content="https://storycarry.com/contact">
        <meta property="og:type" content="website">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/contact.css">
    </head>
    <body>
        <header>
            <span style="background: linear-gradient(to right, green 0%, #5658ae 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;margin-left:15px;color: white"><a href="<?php echo base_url();?>">StoryCarry.com</a></span>
            <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                <span class="login-but"><a href="<?php echo base_url().$this->uri->segment(1);?>">HOME</a></span>
            <?php } else{ ?>
                <span class="login-but"><a href="<?php echo base_url().$this->uri->segment(1);?>">SIGN UP</a></span> 
            <?php } ?>
        </header>
        <div class="con">
            <h2 class="textfont1">SUBMIT A REQUEST</h2>
            <center>
                <span style="text-transform: uppercase;height: 1.5em;"><?php echo $this->session->flashdata('msg'); ?></span>
            </center>
            <form method="POST" action="<?php echo base_url().$this->uri->segment(1);?>/contact" enctype="multipart/form-data"> 
                <select name="request_for" required>
                    <option value=""> --Select your option --</option>
                    <option value="rci">Report a copyright infringement</option>
                    <option value="rab">Report a bug</option>
                    <option value="gf">General feedback</option>
                    <option value="tb">Talk business</option> 
                    <option value="ot">Others</option>
                </select>
                <input class="in" type="text" name="name" placeholder="Name" required="required"/>
                <input class="in" type="email" name="email" placeholder="Email" required="required"/>
                <input class="in" type="text" name="link" placeholder="Link"/>
                <textarea placeholder="Description" name="descr" required="required"></textarea>
                <input style="margin-top:10px" name="file" type="file" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" class="filer">
                <div class="submit-button">
                    <button type="submit" name="submit">SUBMIT</button>
                </div>
            </form>
            <hr style="border: 0.2px solid #e4e4e4;margin-top:28px;">
            <div class="mail-div">
                <div>
                    <span><b>GENERAL</b></span><br><span class="emailid-text">hello@storycarry.com</span>
                </div>
                <div>
                    <span><b>BUSINESS</b></span><br><span class="emailid-text">business@storycarry.com</span>
                </div>
                <div>
                    <span><b>REPORT</b></span><br><span class="emailid-text">report@storycarry.com</span>
                </div>
            </div>
        </div>
    
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
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>about">ABOUT</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>blog">BLOG</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>terms-conditions">TERMS</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url().$this->uri->segment(1);?>privacy-policy">PRIVACY</a></font>
            </center>
            </div>
        </div>
    </body>
</html>