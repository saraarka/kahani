<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8"/>
<title>Blog - Story Carry </title>
<meta name="title" content="Blog - Story Carry">
<meta name="description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
<link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
<meta property="og:title" content="Blog - Story Carry">
<meta property="og:description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
<meta property="og:url" content="https://storycarry.com/about-us">
<meta property="og:type" content="website">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/blog.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <header>
        <font style="background: linear-gradient(to right, green 0%, #5658ae 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;margin-left:15px;color: white"><a href="<?php echo base_url();?>">StoryCarry.com</a></font>
        <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
            <font class="login-but"><a href="<?php echo base_url();?>">HOME</a></font>
        <?php } else{ ?>
            <font class="login-but"><a href="<?php echo base_url();?>">SIGN UP</a></font>
        <?php } ?>
    </header>
    <section class="searchv">
        <div class="bgv">
            <center> 
                <div class="searchvv" id="search">
                    <form method="GET" id="searchpost" action="<?php echo base_url();?>welcome/ssearch">
                        <input type="text" name="searchs" id="searchitems" class="form-search" placeholder="Search..."  value="<?php if(isset($searchs) && !empty($searchs)) { echo $searchs; } ?>" required>
                        <button class="search-button">
                            <img src="<?php echo base_url();?>assets/landing/svg/search-solid.svg" height="20">
                        </button>
                    </form>
                </div>
            </center>
        </div>
    </section>
    
    <?php if(isset($blogs) && ($blogs->num_rows() > 0)) { ?>
        <div class="main-div" id="loadmoreall">
            <?php foreach($blogs->result() as $blog) { ?>
                <div class="inner-div">
                    <a href="<?php echo base_url();?>blog/<?php echo preg_replace('/\s+/', '-', $blog->caption).'-'.$blog->id;?>">
                        <img src="<?php echo base_url().'assets/images/'.$blog->slideimage;?>" class="but" alt="build audience">
                        <div>
                            <h1 class="div-text"><?php echo $blog->caption;?></h1>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div id="load_data_message"></div>
    <?php } ?>
    
    
    <div class="footer">
        <font style="float:left;font-size: 18px;margin-top: 8px;margin-left:10px;font-family: 'Varela Round', sans-serif;" class="copyright">
            Copyright <i class="fa fa-copyright" aria-hidden="true" style="font-size:12px;"></i> 2018 Being Reader
        </font>
        <div class="socialbtns">
            <a href="javascript:void(0);"><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/facebook-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="facebook storycarry"></a>
            <a href="javascript:void(0);"><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/instagram-brands.svg" alt="instagram storycarry" style="margin-right:6px;cursor:pointer; width:21px;height:24px"></a>
            <a href="javascript:void(0);"><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/twitter-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="twitter storycarry"></a>
            <a href="javascript:void(0);"><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/quora-brands.svg" style="cursor:pointer;width:21px;height:24px" alt="Quora storycarry"></a>
        </div>
    </div>
    <div class="footer1">
        <div style="font-size:14px;color:black;font-family:'Varela Round',sans-serif;">
            <center>
                <font  class="hover-tems"><a href="<?php echo base_url();?>about">ABOUT</a></font>
                <font  class="hover-tems"><a href="<?php echo base_url();?>contact">CONTACT</a></font>
                <font  class="hover-tems"><a href="<?php echo base_url();?>terms-conditions">TERMS</a></font>
                <font  class="hover-tems"><a href="<?php echo base_url();?>privacy-policy">PRIVACY</a></font>
            </center>
        </div>
    </div>
</body>
<script type='text/javascript'>  
    $(document).ready(function() {
        $("#searchitems").autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "<?php echo base_url();?>welcome/blogsearch",
                    type: 'post',
                    dataType: "json",
                    data: {search: request.term},
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#searchitems').val(ui.item.label);
				location.href = ui.item.link;    
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        var limit = 3;
        var start = 3;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url();?>blogloadmore',
                method:"POST",
                data:{limit:limit, start:start},
                cache:false,
                success:function(data){
                    $('#loadmoreall').append(data);
                    if(data == '') {
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-bottom:10px;'> No More Results!</div></center>");
                        action = 'active';
                    }else{
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-bottom:10px;'> Loading ...</div></center>");
                        action = "inactive";
                    }
                }
            });
        }
        if(action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        } 
        $(window).scroll(function(){
            if ($(window).scrollTop() >= (($("#loadmoreall").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 10);
            }
        });
    });
</script>