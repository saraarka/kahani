<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8"/>
<title>Blog - Story Carry </title>
<meta name="title" content="Blog - Story Carry">
<meta name="description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
<link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="Blog - Story Carry">
<meta property="og:description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
<meta property="og:url" content="<?php echo base_url(); ?>blog">
<meta property="og:type" content="website">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/blog_detail.css">
</head>

<body>
<header>
    <font style="background: linear-gradient(to right, green 0%, #5658ae 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;margin-left:15px;color: white"><a href="<?php echo base_url();?>">StoryCarry.com</a></font>
    <font class="login-but"><a href="<?php echo base_url();?>">SIGN UP</a></font>
</header>
<div class="container1"> 
    <div class="content" >
        <?php if(isset($blogs) && ($blogs->num_rows() > 0)){ foreach($blogs->result() as $blog){ ?>
        <div style="background: white;padding: 10px;">   
            <div class="top-content">
                <font style="font-size:1.8em;line-height: 1.2em;"><?php echo $blog->caption;?></font>
                <div style="font-size:0.75em;margin-left:2px;margin-top: 10px;color:#676565;">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> <font><?php echo substr($blog->created_at,0,10);?></font>
                </div>
                <center>
                    <img src="<?php echo base_url().'assets/images/'.$blog->image;?>" alt="BeingReader" class="main-image">
                </center>
            </div>
            <div class="down-content">
                <p>
                    <?php echo $blog->description;?>
                </p>
            </div>
        </div>
        
        <div class="content3" style="background:white; margin-top:45px;">
            <div class="comments">
                <form method="POST" action="#" style="margin-block-end:0px;" id="blogcomments">
                    <div class="editor" style="border-left:none; border-right:none;">
                        <div id="text" name="comment" class="editor-content" contenteditable></div>
                    </div>
                    <div class="insert-text" style="background:#f0f0f0;">
                        <span class="loading">POSTING...</span>
                        <span class="total-comment"><?php if(isset($blogcommentscount) && ($blogcommentscount->num_rows() > 0)){ echo $blogcommentscount->num_rows(); } ?></span>
                        <br>
                        <center>
                            <input type="hidden" name="blog_id" id="blog_id" value="<?php echo $blog->id;?>">
                            <!--<input type="submit" name="submit" id="submit" value="POST" style="width:80px;border:none;outline:none;background:rgb(60, 141, 188);color:white;padding:5px;cursor:pointer;" />-->
                            <button type="submit" name="submit" id="submit" class="btncospin" style="width:80px;border:none;outline:none;background:rgb(60, 141, 188);color:white;padding:5px;cursor:pointer;">POST</button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
        <?php } } ?>
        <?php if(isset($blogcomments) && ($blogcomments->num_rows() > 0)) { ?>
        <div id="loadmoreall" style="background: #f0f0f0;">
            <div class="list-comments">
                <?php foreach($blogcomments->result() as $blogcomment) { ?>
                    <div><?php echo $blogcomment->comment; ?></div>
                <?php } ?>
            </div>
        </div>
        <div id="load_data_message"></div>
        <?php } ?>
    </div>
</div>

<div class="footer">
    <font style="float:left;font-size: 18px;margin-top: 8px;margin-left:10px;font-family: 'Varela Round', sans-serif;" class="copyright">
        Copyright <i class="fa fa-copyright" aria-hidden="true" style="font-size:12px;"></i> 2018 Being Reader
    </font>
    <div class="socialbtns">
        <a href=""><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/facebook-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="facebook storycarry"></a>
        <a href=""><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/instagram-brands.svg" alt="instagram storycarry" style="margin-right:6px;cursor:pointer; width:21px;height:24px"></a>
        <a href=""><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/twitter-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="twitter storycarry"></a>
        <a href=""><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/quora-brands.svg" style="cursor:pointer;width:21px;height:24px" alt="Quora storycarry"></a>
    </div>
</div>
<div class="footer1">
    <div style="font-size:14px;color:black;font-family: 'Varela Round', sans-serif;">
        <center>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url();?>about">ABOUT</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url();?>contact">CONTACT</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url();?>terms-conditions">TERMS</a></font>
            <font style="margin-right:10px" class="hover-tems"><a href="<?php echo base_url();?>privacy-policy">PRIVACY</a></font>
        </center>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('form#blogcomments').submit(function( event ) {
		event.preventDefault();
		var totalCom = $(".total-comment").text();
		var blogid = $('#blog_id').val();
		var text = $("#text").html();
		if(text === "") {
            $("#text").focus();
        }else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/blog_comments",
                data: {'comment': text, 'blogid':blogid},
                cache: false,
                success: function(data){
                    $(".list-comments").prepend("<div>"+text+"</div>");
                    $("#text").html("");
                    $(".total-comment").text(parseInt(totalCom)+1);
                }
            });
        }
    });
});
</script>
<script>
    $(document).ready(function(){
        var limit = 5;
        var start = 5;
        var action = 'inactive';
        function load_country_data(limit, start) {
            var blog_id = "<?php echo $blog->id; ?>";
            if(blog_id){
                $.ajax({
                    url:'<?php echo base_url().$this->uri->segment(1);?>/blogloadcomments',
                    method:"POST",
                    data:{limit:limit, start:start, blog_id: blog_id},
                    cache:false,
                    success:function(data){
                        $('#loadmoreall').append(data);
                        if(data == '') {
                            $('#load_data_message').html("<center> No More Results!</center>");
                            action = 'active';
                        }else{
                            $('#load_data_message').html("<center> Loading ...</center>");
                            action = "inactive";
                        }
                    }
                });
            }
        }
        if(action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        } 
        $(window).scroll(function(){
            if ($(window).scrollTop() >= (($("#loadmoreall").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 500);
            }
        });
    });
</script>
</body>
</html>