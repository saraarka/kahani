<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
    .sidenav {
      height: 100%;
      width: 250px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      padding-top: 20px;
    }
    .sidenav a {
      padding: 6px 8px 6px 16px;
      text-decoration: none;
      color: #818181;
      display: block;
    }
    .sidenav a:hover {
      color: #f1f1f1;
    }
    .main {
      margin-left: 250px; /* Same as the width of the sidenav */
      padding: 0px 10px;
    }
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
    }
    
    #snackbar {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 1;
      left: 50%;
      bottom: 30px;
      font-size: 17px;
    }
    
    #snackbar.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
    
    @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;} 
      to {bottom: 30px; opacity: 1;}
    }
    
    @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }
    
    @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;} 
      to {bottom: 0; opacity: 0;}
    }
    
    @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }
</style>

    <div class="sidenav">
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/headmenulist">Header Navbar</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addheadmenu">Add Header Navbar</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/leftmenulist">Left Side Navbar</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addleftmenu">Add Left Side Navbar</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/profilemenulist">My Profile </a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addprofilemenu">Add My Profile </a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/userslist">Users List</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/storieslist">Stories List</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/homeslides">Home Banners</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addhomeslide">Add Home Banner</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blogs">Blogs</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addblog">Add Blog</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/reports">All Reports</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/storiesreports">Stories Reports</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/storiescmtreports">Stories Comments Reports</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/communitiesreports">Communities Reports</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/communitiescmtreports">Communities Comments Reports</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/communities">Communities</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addcommunity">Add Community</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/geners">Geners</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/profilemonetize">Profile Monetizsation</a>
        <!--<a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/storiesmonetize">Stories Monetizsation</a> -->
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/enablestoriesmonetize">Enable Stories Monetizsation</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/disablestoriesmonetize">Disable Stories Monetizsation</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/removestoriesmonetize">Remove Stories Monetizsation</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/transreqs">Transaction Requests</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/landingpage">Landing Page Content</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addlandingpage">Add Landing Page Content</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/staticpages">Static Pages</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addstaticpage">Add Static Page</a>
        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/typewrites">Type Writes</a>
    </div>