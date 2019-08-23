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
<style>
.ui-state-active{
	border: 1px solid #aaaaaa00!important;
	border-radius:5px;
	background:rgba(0,0,0,0.1)!important;
}

.ui-widget.ui-widget-content {
    border: 1px solid #aaaaaa00!important;
    border-radius: 5px;
    box-shadow:0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2)!important;
}
.ui-widget-content{
    width:30% !important;
    font-family:Arial,sans-serif!important;
    font-size: 1em!important;
}
.ui-menu .ui-menu-item-wrapper {
    position: relative;
    padding: 3px 1em 3px .4em;
    background-color: #fffff;
}
.ui-menu .ui-menu-item {
    margin: 0px 0px 6px!important;
}

.ui-menu .ui-menu-item-wrapper {
    position: relative;
    padding: 3px 1em 3px .4em;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    line-height: 1.2em;
    word-wrap:break-word;
}
@media screen and (max-width:768px){
    .ui-widget-content{
        width:70% !important;
    }
}
</style>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <header>
        <font style="background: linear-gradient(to right, green 0%, #5658ae 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;margin-left:15px;color: white"><a href="<?php echo base_url();?>">StoryCarry.com</a></font>
        <font class="login-but"><a href="<?php echo base_url();?>">SIGN UP</a></font>
    </header>
    <section class="searchv">
        <div class="bgv">
            <!--<div class="searchvv">
                <a href="<?php echo base_url();?>index.php/welcome/ssearch?searchs=a" style="color:#fff;"></a>
            </div>-->
            <center>
                <div class="searchvv" id="search"> 
                    <form method="GET" id="searchpost" action="<?php echo base_url();?>index.php/welcome/ssearch">
                        <input type="text" name="searchs" id="searchitems" class="form-search" placeholder="Search..."  value="<?php if(isset($searchs) && !empty($searchs)) { echo $searchs; } ?>" required>
                        <button class="search-button">
                            <img src="<?php echo base_url();?>assets/landing/svg/search-solid.svg" height="20">
                        </button>
                    </form>
                </div>
            </center>
        </div>
    </section>
    <div class="main-div">
        <?php if(isset($blogs) && ($blogs->num_rows() > 0)) { foreach($blogs->result() as $blog){ ?>
        <div class="inner-div">
            <a href="<?php echo base_url();?>blogdetail/<?php echo $blog->id;?>">
                <img src="<?php echo base_url().'assets/images/'.$blog->slideimage;?>" class="but" alt="build audience">
                <div>
                    <h1 class="div-text"><?php echo $blog->caption;?></h1>
                </div>
            </a>
        </div>
        <?php } } else { ?>
            <center class="div-text" style="margin-top:4.5em;margin-bottom:0.2em;">
                <h3> No results Found with Your Search </h3>
            </center>
        <?php } ?>
    </div>

</body>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
<script type='text/javascript'>  
    $(document).ready(function() {
        $("#searchitems").autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "<?php echo base_url();?>index.php/welcome/blogsearch",
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