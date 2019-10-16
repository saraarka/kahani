<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Story Carry</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/editor.css">
        <style>
            *{
                -webkit-tap-highlight-color: transparent;
            }
             body{
              margin: 0;
              background: rgb(238, 238, 238);
             }
             
             .write-nav{
              width: 100%;
              height: 60px;
              z-index: 1000;
              position: fixed;
              background: #3c8dbc;
              font-family: Arial, Helvetica, sans-serif;
            }

            .logo1{
                width: 170px;
                /* height: 30px; */
                margin-top: 15px;
                margin-left: 15px;
                display : inline-block;
            }

            .logo-small{
                display : none;
                margin: 11px 20px;
                height: 38px;
            }


            .nav-items-write{
              color: white;
              float: right;
              font-size: 15px;
              display: flex;
              margin-top: 10px;
            }

            .nav-items-write div {
              margin-right: 25px;
              cursor : pointer;
            }

            .save-btn {
              border-radius : 5px;
              border: 1px solid white;
              padding :10px;
              cursor:pointer;
            }

            .save-btn{
              background: #00000c24
            }


            .draft-btn, .cancel-btn{
              margin-top: 11px;
            }

            .dropdown-content {
              display: none;
              position: absolute;
              right:0;
              top:60px;
              box-shadow:0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);
              background-color: #f9f9f9;
              min-width: 160px;
              z-index: 1;
              border-bottom-left-radius: 5px;
              border-bottom-right-radius: 5px;
            }

            .dropdown-content a{
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }
            .dropdown-content a:hover{
                background-color:#eeeeee;
            }
            .removeimg {
                background: #3c8dbc;
                text-align: center;
                width: 293px;
                margin: 15px;
                padding: 3px 0px;
                color: #fff;
            }
            .imageThumb {
                width: 293px;
                height: 280px;
            }
            @media screen and (max-width:760px){
                .logo1{
                    display : none;
              }

                .logo-small{
                   display : inline-block;
              }
            }


            @media screen and (max-width:480px){
                .nav-items-write{
                    margin-top:14px;
                    font-size : 13px;
                }
                .save-btn{
                    padding :7px;
                }
                .draft-btn, .cancel-btn{
                    margin-top: 8px;
                }
                .nav-items-write div {
                    margin-right: 15px;
                }
            }
            /* Popup modal css start */
            .hide-body-scroll{
                overflow-y: hidden;
            }
            .blur{
              -webkit-filter: blur(5px);
              -moz-filter: blur(5px);
              -o-filter: blur(5px);
              -ms-filter: blur(5px);
              filter: blur(5px);
            }


            .modal-wrapper{
                z-index: 1005;
              width:100%;
              height:100%;
              position:fixed;
              font-family: arial,"sans-serif";
              top:0; left:0;
              background:rgba(0,0,0,0.5);
              visibility:hidden;
              opacity:0;
              -webkit-transition: all 0.25s ease-in-out;
              -moz-transition: all 0.25s ease-in-out;
              -o-transition: all 0.25s ease-in-out;
              transition: all 0.25s ease-in-out;
            }

            .modal-wrapper.open{
              opacity:1;
              visibility:visible;
            }

            .modal{
              width:500px;
              max-width : 90%;
              border-radius: 5px;
              max-height : 100%;
              display:block;
              position: absolute;
              left: 50%;
              top: 30%;
              transform : translate(-50%,-30%);
              background:#fff;
              opacity:0;
              -webkit-transition: all 0.5s ease-in-out;
              -moz-transition: all 0.5s ease-in-out;
              -o-transition: all 0.5s ease-in-out;
              transition: all 0.5s ease-in-out;
            }

            .modal-wrapper.open .modal{
              opacity:1;
            }

            .popup-head{
              width:100%;
              border-top-left-radius: 5px;
              border-top-right-radius: 5px;
              height:45px;
              font-size :17px;
              overflow:hidden;
              background:#01bce5;
            }

            .popup-headtext{
                display : inline-block;
                margin:13px;
                color:white;
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
                max-width: 70%;
            }
            .popup-btn-close{
              width : 22px;
              margin: 6px 8px 0px 0px;
              float:right;
            }

            .popup-content{
                padding: 10px;
                font-size: 16px;
                line-height: 25px;
                max-height: 300px;
                min-height: 100px;
                overflow-y: scroll;
            }
            /* Popup modal css end */


            /*snackbar css start */
            /* The snackbar - position it at the bottom and in the middle of the screen */
            #snackbar {
              visibility: hidden; /* Hidden by default. Visible on click */
              min-width: 250px; /* Set a default minimum width */
              background-color: #333; /* Black background color */
              color: #fff; /* White text color */
              text-align: center; /* Centered text */
              border-radius: 2px; /* Rounded borders */
              padding: 16px; /* Padding */
              position: fixed; /* Sit on top of the screen */
              z-index: 1; /* Add a z-index if needed */
              left: 50%; /* Center the snackbar */
              bottom: 30px; /* 30px from the bottom */
              transform: translateX(-50%);
            }

            /* Show the snackbar when clicking on a button (class added with JavaScript) */
            #snackbar.show {
              visibility: visible; /* Show the snackbar */
              /* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
              However, delay the fade out process for 2.5 seconds */
              -webkit-animation: fadein 0.5s, fadeout 0.5s 10.5s;
              animation: fadein 0.5s, fadeout 0.5s 10.5s;
            }

            /* Animations to fade the snackbar in and out */
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
            /*snackbar css end */
        </style>
        <style>
            .top-div-image-popup {
              height: 57px;
              box-shadow: 0 3px 2px -2px rgba(200,200,200,0.2);
              border-bottom: 1px solid #ddd;
              padding-top: 12px;
              text-align: center;
              box-sizing: border-box;
              background: white;
            }

            .top-div-image-popup input {
              height: 31px;
              width: 250px;
              border: none;
              border-radius: 0;
              border-bottom: 2px solid;
              margin-right: 5px;
              outline: none;
              font-size: 16px;
            }

            .top-div-image-popup button {
              cursor: pointer;
              background-color: rgba(0,0,0,0.3);
              width: 45px;
              padding: 8px 0px;
              border: none;
              border-radius: 3px;
              outline: none;
              color: white;
            }

            .defaultimages {
              padding-top: 10px;
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
              height: 260px;
              overflow-Y: auto;
            }

            .defaultimages img {
              border-radius: 5px;
              width: 45%;
              max-width: 127px;
              max-height: 121px;
              border: 3px solid #eeee;
              margin: 1%;
              cursor: pointer;
            }
            img.selectedIMG{
              border : 3px solid #3c8dbc;
            }

            .image-loadmore{
              width: 100%;
              text-align: center;
            }

            .image-loadmore button {
              height: 30px;
              font-size: 14px;
              margin: 10px 0px;
              background: #3c8dbc;
              border: none;
              border-radius: 3px;
              color: white;
              outline: none;
            }

            .upload-own-img-div{
              text-align: center;
              display:flex;
              justify-content: center;
              border-top: 1px solid #ddd;
            }

            .upload-own-img-btn{
              background: none;
              border: 1px solid;
              height: 30px;
              margin: 10px;
              color: #3c8dbc;
              outline: none;
            }
            .default-img-save-button{
              border: 1px solid transparent;
              height: 30px;
              margin: 10px;
              color: #bcb2b2;
              background: #eee;
              outline: none;
            }
            .close-btn{
              position: absolute;
              background: red;
              text-align: center;
              color: white;
              right: 0;
              top: -37px;
              box-shadow: 0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);
              border: none;
              height: 30px;
              font-size: 17px;
              border-radius: 3px;
              cursor: pointer;
              outline: none;
            }
            @media screen and (max-width:470px){
              .default-image-popup {
                width: 300px;
              }
              .top-div-image-popup input {
                width: 200px;
              }
            }
        </style>
    </head>
    <body>
        
        <?php if(isset($series_edit) && ($series_edit->num_rows()>0)){ foreach($series_edit->result() as $row){ ?>
            <div class="write-nav">
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" class="logo1"></a>
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/default/writemobile.png" class="logo-small"></a>
                <div class="nav-items-write">
                    <a href="<?php echo base_url();?>english" style="text-decoration:none;color:#fff;">
                        <div class="cancel-btn">CANCEL</div>
                    </a>
                    <div class="save-btn" onclick="publish()">SAVE</div> <!-- PUBLISH -->
                    <div class="draft-btn">DRAFT</div>
                    <div class="dropdown-content">
                        <a href="javascript:void(0)" onclick="addtodrafts(<?php echo $row->sid;?>,<?php echo $row->story_id;?>)">SAVE DRAFT</a>
                        <a href="javascript:void(0)" onclick="deletedraft(<?php echo $row->sid;?>,<?php echo $row->story_id;?>)">DELETE DRAFT</a>
                    </div>
                </div>
            </div>
            
            <div>
                <form action="<?php echo base_url('updatestory') ?>" id="display_result" method="post" name="registration" enctype="multipart/form-data">            
                    <div class="editorcontainer">
                        <div class="imagemaindiv">
                            <div class="imagebox">
                                <label for="upload-file-selector">
                                    <input type="hidden" id="previewimage" value="<?php echo $row->cover_image;?>">
                                    <input type="hidden" name="cover_image" id="upload-file-selectorserver" style="display:none;">
                                    <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
                                        <span class="upload-file-selector">
                                            <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image;?>" alt="<?php echo $row->title;?>" class="imageThumb" style="cursor: pointer;">
                                        </span>
                                    <?php } else { ?>
                                        <span class="upload-file-selector">
                                            <img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $row->title;?>" class="imageThumb" style="cursor: pointer;">
                                        </span>
                                    <?php } ?>
                                </label>
                                <input type="hidden" name="cover_imagelocalp" class="cover_imagelocalp">
                                <input type="hidden" name="cover_imagelocali" class="cover_imagelocali">
                            </div>
                            <div class="removebtn"></div>
                        </div>
                        
                        <div class="editordiv">
                            <input type="hidden" id="languageto" value="<?php echo $row->language;?>">
                            <input type="text" id="title" name="title" class="enter-title-box" placeholder="ENTER TITLE" required="" value="<?php echo $row->title;?>">
                            <textarea class="storywrite" id="story" name="story" style="resize:none;"><?php if(isset($row->draft_story) && !empty($row->draft_story)){echo $row->draft_story;}else{echo $row->story;}?></textarea>
                            <iframe id="story_ifr" style="display: none;"></iframe>
                            <input type= "hidden" name="hidden" value="<?php echo $row->sid;?>"><!-- sid -->
                            <input type="hidden" id="story_id" name="story_id" value="<?php echo $row->story_id;?>">
                            <input type="hidden" name="draft" id="draft" value="<?php echo $row->draft;?>">
                            <input type="hidden" id="storytype" value="<?php echo $row->type;?>">
                        </div>
                    </div>
                </form>
            </div>
        <?php } } ?>
    
        <center><div id="snackbar"></div></center>
    
<div class="modal-wrapper" id="checkepisode">
    <div class="modal">
        <div class="popup-head">
            <div class="popup-headtext">Is this the Last Episode of this series?</div>
        </div>
        <div class="popup-content">
            <center><h4> If you click on 'YES', You Cannot add any new episode to this series.</h4>
                <button style="background:#3c8dbc;padding: 6px 15px;border: none;color: #fff;border-radius: 5px;" onclick="yesno('no')"> NO </button>
                <button style="padding: 6px 15px;border: none;color: #000;border-radius: 5px;background: #ddd;" onclick="yesno('yes')"> YES </button>
            </center>
        </div>
    </div>
</div>

<div class="modal-wrapper" id="defaultimages">
    <div class="modal">
        <div class="default-image-popup">
            <button class="close-btn">CLOSE</button>
            <div class="top-div-image-popup">
                <input id="searchimage" placeholder="Search image...">
                <button onclick="searchimage()">GO</button>
            </div>
            <div class="defaultimages">
                <?php if(isset($defaultimages) && ($defaultimages->num_rows() > 0)){ foreach($defaultimages->result() as $defaultimage){ ?>
                    <img class="selectimg<?php echo $defaultimage->id;?>" src="<?php echo base_url();?>assets/images/<?php echo $defaultimage->dimage;?>" onclick="selectimg(<?php echo $defaultimage->id;?>)">
                <?php } } ?>
                <div class="image-loadmore"><button>LOAD MORE</button></div>
            </div>
            
            <div class="upload-own-img-div">
                <button class="upload-own-img-btn"><label><input type="file" name="cover_image" id="upload-file-selector" style="display:none;">+ UPLOAD IMAGE</label></button>
                <button class="default-img-save-button">USE THIS IMAGE</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    $(".draft-btn").click(function(e) {
        $(".dropdown-content").toggle();
        e.stopPropagation();
    });
    $(document).click(function(e) {
        if (!$(e.target).is('.dropdown-content')) {
            $(".dropdown-content").css('display','none');
        }
    });
});
</script>
<script>
    $(document).ready(function() {
        $('.upload-file-selector').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('#defaultimages').toggleClass('open');
            return false;
        });
        $('button.close-btn').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('.modal-wrapper').removeClass('open');
            return false;
        });
    });
    var limit = 6;
    var start = 0;
    function loadmoredimages(limit, start){
      var insertimages = $('.defaultimages img:last').attr('class');
        $.ajax({
            url: '<?php echo base_url();?>welcome/loadmoredimages',
            method: "POST",
            data: {limit:limit, start:start},
            cache: false,
            dataType: "json",
            success:function(data){
                if(data.length > 0){
                    var images = '';
                    $.each(data,function (p,q){
                    images+= '<img class="selectimg'+q.id+'" src="<?php echo base_url();?>assets/images/'+q.dimage+'" onclick="selectimg('+q.id+')">';
                    });
                    $('.'+insertimages).after(images);
                }else{
                    $('.image-loadmore').html('No more Results');
                }
            }
        });
    }
    $('.image-loadmore').click(function() {
        start = start + limit;
        loadmoredimages(limit, start);
    });

    function searchimage(){
        var searchimage = $('#searchimage').val();
        //if(searchimage){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>welcome/searchimage",
                data: {'searchimage': searchimage},
                dataType: "json",
                success: function(data) {
                    if(data && data.length > 0){
                        var images = '';
                        $.each(data,function (p,q){
                        images+= '<img class="selectimg'+q.id+'" src="<?php echo base_url();?>assets/images/'+q.dimage+'" onclick="selectimg('+q.id+')">';
                        });
                        $('.defaultimages').html(images);
                    }else{
                        $('.defaultimages').html('No Images found with your search.');
                    }
                }
            });
        //}
    }
    function selectimg(id){
        $('.defaultimages img').removeClass("selectedIMG");
        $('.selectimg'+id).addClass('selectedIMG');
        $('.default-img-save-button').css({'background':'#3c8dbc','color':'white'});
    }
    $('.default-img-save-button').click(function(){
        var checkclass = $('.defaultimages img').hasClass("selectedIMG");
        if(checkclass){
            var imagepath = $('.selectedIMG').attr('src');
            $("#upload-file-selectorserver").val(imagepath);
            removesavedimgs();
            $('.cover_imagelocalp').val('');
            $('.cover_imagelocali').val('');
            $('.upload-file-selector').html("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + imagepath + "\"/>");
            $('.removebtn').html("<div class=\"removeimg\"><span class=\"remove\" style=cursor:pointer;>REMOVE</span></div></span>");

            $('body').toggleClass('hide-body-scroll');
            $('.modal-wrapper').removeClass('open');
            return false;
        }
    });
    $(".removebtn").click(function(){
        $(this).parent(".pip").remove();
        $('.removebtn').html("");
        $("#upload-file-selectorserver").val('');
        $("#upload-file-selector").val('');
        $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>'+
            '<p class="browseimg">Image SIZE should be smaller than 2MB.</p>');
        removesavedimgs();
        $('.cover_imagelocalp').val('');
        $('.cover_imagelocali').val('');
    });
    function removesavedimgs(){
        var cover_imagelocalp = $('.cover_imagelocalp').val();
        var cover_imagelocali = $('.cover_imagelocali').val();
        if(cover_imagelocalp || cover_imagelocali){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>removesavedimgs",
                data: { 'cover_imagelocalp': cover_imagelocalp, 'cover_imagelocali': cover_imagelocali },
                success: function(data) {
                    console.log('removed');
                }
            });
        }
    }
</script>
<script>
$(document).ready(function() {
    upLoader();
});
function upLoader(){
    if (window.File && window.FileList && window.FileReader) {
        $("#upload-file-selector").on("change", function(e) {
            var previewimage = $('#previewimage').val();
            var storytype = $('#storytype').val();
            var files = e.target.files,
            filesLength = files.length;
	        for (var i = 0; i < filesLength; i++) {
              var f = files[i]

              var fd = new FormData();
              var files = $('#upload-file-selector')[0].files[0];
              fd.append('file',files);
              fd.append('type',storytype);
              $.ajax({
                  url:'<?php echo base_url();?>welcome/localimage',
                  type: 'POST',
                  data: fd,
                  contentType: false,
                  processData: false,
                  cache: false,
                  success: function(response){
                      var responsedata = JSON.parse(response);
                      if(responsedata.picture1 != 0){
                          removesavedimgs();
                          $('.cover_imagelocalp').val(responsedata.picture1);
                          $('.cover_imagelocali').val(responsedata.image);
                          $("#upload-file-selectorserver").val('');

                          $('body').toggleClass('hide-body-scroll');
                          $('.modal-wrapper').removeClass('open');
                          return false;
                          console.log('file uploaded');
                      }else{
                          console.log('file not uploaded');
                      }
                  }
              });
              
              var fileReader = new FileReader();
              fileReader.onload = (function(e) {
                  var file = e.target;
                  $('.upload-file-selector').html("<span class=\"pip\">" +
                      "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>");
                  $('.removebtn').html("<div class=\"removeimg\"><span class=\"remove\" style=cursor:pointer;>REMOVE</span></div></span>");
                  /*$(".remove").click(function(){
                      $(this).parent(".pip").remove();
                      $('.removebtn').html("");
                      $("#upload-file-selector").val('');
                      if(previewimage){
                          $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/'+previewimage+'">');
                      }else {
                          $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>'+
                              '<p class="browseimg">Image SIZE should be smaller than 2MB.</p>');
                      }
                  });*/
              });
              fileReader.readAsDataURL(f);
	        }
	    });
    } 
    else {
        alert("Your browser doesn't support to File API")
    }
}
</script>


<script>
    function previewContent(){
        var sid = "<?php echo $this->uri->segment(2); ?>";
        var story = tinyMCE.activeEditor.getContent();
        $.ajax({
      			type: "POST",
            url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
            data: {'story':story },
      			success:function(data){
      			    console.log('Saved to drafts.');
      			}
    		});
    }
    function addtodrafts(sid, story_id){
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        if(((storytext.replace(/\s/g,'')).length > 0) || (story.indexOf('/images/storyimgs/') != -1)){
          $.ajax({
        			type: "POST",
              url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
              data: {'story':story},
        			success:function(data){
        			    if(data == 1){
        			        $('#snackbar').text('Saved to drafts.').addClass('show');
            		        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        			    }else{
        			        console.log('failed to save in Draft');
        			    }
        			}
      		});
        }else{
            $('#snackbar').text('Please enter story.').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }
    }
    function deletedraft(sid, story_id){
        var title = $('input[name="title"]').val();
          $.ajax({
    			type: "POST",
          url: "<?php echo base_url();?>welcome/savedeletedraft/"+sid,
    			success:function(data){
              if(data == 1){
                  console.log('Deleted.');
                  location.href = "<?php echo base_url();?>admin-series/"+title.replace(/\s+/g, "-")+"-"+sid+"/"+title.replace(/\s+/g, "-")+"-"+story_id;
              }
    			}
    		});
    }
    /*function submit(){
        var story = tinyMCE.activeEditor.getContent();
        if(((storytext.replace(/\s/g,'')).length > 0) || (story.indexOf('/images/storyimgs/') != -1)){
            $("#display_result").submit();// save button on click
        }else {
            $('#snackbar').text('Please enter Story').addClass('show');
    		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }
    }*/
    function publish(){
        previewContent();
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        if(((storytext.replace(/\s/g,'')).length > 0) || (story.indexOf('/images/storyimgs/') != -1)){
            $('#draft').val(' '); 
            $('body').toggleClass('hide-body-scroll');
            $('#checkepisode').toggleClass('open');
            return false;
        }else {
            $('#snackbar').text('Please enter story').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }
    }
    function yesno(value){
        $('#draft').val(' ');
        if(value == 'yes'){
            $('#lastepisode').val('yes');
            setTimeout($("#display_result").submit(),2000);
        }else{
            $("#display_result").submit();
        }
    }
</script>

<input name="image" type="file" id="upload" class="hidden" onchange="">
<script src="<?php echo base_url();?>assets/dist/js/js/tinymce/tinymce.min.js"></script>
<script>
$(document).ready(function() {
    var timeoutId;
    tinymce.init({
        selector: "#story",
        theme: "modern",
        plugins: ["link image"],
        toolbar: "undo redo | bold italic | aligncenter | link image",
        paste_data_images: true,
        image_advtab: false,
        image_description: false,
        image_dimensions: false,
        menubar: false,
        statusbar : false,
        target_list: false,
        link_title: false,
        content_style: 'img {max-width: 100%; display: block; margin: 0 auto} p{word-break: break-all;}',
        file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('#upload').trigger('click');
            $('#upload').on('change', function() {
              var file = this.files[0];
              $('button#mceu_18-action').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner">');
              var reader = new FileReader();
              reader.onload = function() {
                /*callback(e.target.result, {
                  alt: ''
                });*/
                var $data = {'file': reader.result };
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url();?>welcome/uploadstoryimg',
                    data: $data,
                    success: function(response) {
                        callback(response, {
                            alt: ''
                        });
                    },error: function(response) {
                        $('#snackbar').text('Your browser does not support to File API').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                    },complete: function() {
                        $('button#mceu_18-action').html('<i class="mce-ico mce-i-browse"></i>');
                    }
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },
        setup :  function(ed) {
            ed.on("keypress keyup", function(e){
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function() {
                    previewContent();
                }, 100);
            });
        },
    });
});
</script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    // Load the Google Transliterate API
    google.load("elements", "1", {
        packages: "transliteration"
    });
    var langugeto = document.getElementById('languageto').value;
    var transliterationControl;
    function onLoad() {
        var options = {
            sourceLanguage: 'en',
            destinationLanguage: [langugeto],
            transliterationEnabled: true,
        };
        // Create an instance on TransliterationControl with the required
        // options.
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.jk
        var ids = [ "story","story_ifr", "title" ];
        transliterationControl.makeTransliteratable(ids);
        transliterationControl.c.qc.t13n.c[3].c.d.keyup[0].ia.F.p = 'https://www.google.com';  // https ssl activation 
        // Add the STATE_CHANGED event handler to correcly maintain the state
        // of the checkbox.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
            transliterateStateChangeHandler);

        // Add the SERVER_UNREACHABLE event handler to display an error message
        // if unable to reach the server.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,
            serverUnreachableHandler);

        // Add the SERVER_REACHABLE event handler to remove the error message
        // once the server becomes reachable.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE,
            serverReachableHandler);

        // Set the checkbox to the correct state.
        document.getElementById('checkboxId').checked =
          transliterationControl.isTransliterationEnabled();

        // Populate the language dropdown
      }

      // Handler for STATE_CHANGED event which makes sure checkbox status
      // reflects the transliteration enabled or disabled status.
      function transliterateStateChangeHandler(e) {
        document.getElementById('checkboxId').checked = e.transliterationEnabled;
      }

      // Handler for dropdown option change event.  Calls setLanguagePair to
      // set the new language.
      function languageChangeHandler() {
		transliterationControl.toggleTransliteration();
        var dropdown = document.getElementById('languageDropDown');
        transliterationControl.setLanguagePair(
            google.elements.transliteration.LanguageCode.ENGLISH,
            dropdown.options[dropdown.selectedIndex].value);
      }

      // SERVER_UNREACHABLE event handler which displays the error message.
      function serverUnreachableHandler(e) {
        document.getElementById("errorDiv").innerHTML =
            "Transliteration Server unreachable";
      }

      // SERVER_UNREACHABLE event handler which clears the error message.
      function serverReachableHandler(e) {
        document.getElementById("errorDiv").innerHTML = "";
      }
  google.setOnLoadCallback(onLoad);
</script>