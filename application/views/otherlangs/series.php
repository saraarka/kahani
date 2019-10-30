<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Story Carry</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/infopage.css" rel="stylesheet">
    </head>
    <style>
        .default-image-popup {
          width: 445px;
          position: absolute;
          max-width: 100%;
          background: white;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
        }
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
          height: 121px;
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
          margin: 15px 0px;
        }

        .image-loadmore button {
          height: 30px;
          font-size: 14px;
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
    <body>
        
        <form action="<?php echo base_url().$this->uri->segment(1);?>/series_story_uplode" onsubmit="return validateForm()" name="infoForm" id="display_result" method="post" enctype="multipart/form-data">
            <div class="write-nav">
                <a href="<?php echo base_url().$this->uri->segment(1);?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" class="logo1"></a>
                <a href="<?php echo base_url().$this->uri->segment(1);?>"><img src="<?php echo base_url();?>assets/default/writemobile.png" class="logo-small"></a>
                <div class="nav-items-write">
                    <div class="writing-tips-btn">WRITING TIPS</div>
                    <div><button type="submit" id="submitform" class="start-writing-btn">START WRITING</button></div>
                    <a href="<?php echo base_url().$this->uri->segment(1);?>" style="text-decoration:none;color:#fff;">
                        <div class="cancel-btn">CANCEL</div>
                    </a>
                </div>
            </div>
            
            <div class="infocontainer">
                
                <div class="imagemaindiv">
                    <div class="imagebox">
                        <label for="upload-file-selector">
                            <input type="hidden" name="cover_image" id="upload-file-selectorserver" style="display:none;">
                            <span class="upload-file-selector">
                                <img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>
                                <p class="browseimg">Image SIZE should be smaller than 2MB.</p>
                            </span>
                            <span class="text-danger imageerror"></span>
                        </label>
                        <input type="hidden" name="cover_imagelocalp" class="cover_imagelocalp">
                        <input type="hidden" name="cover_imagelocali" class="cover_imagelocali">
                    </div>
                    <div class="removebtn"></div>
                    <div class="monetize">
                        <div class="monitizediv">MONETISATION
                            <img src="<?php echo base_url();?>assets/default/fa-question.svg" class="monitizetext" width="14px" style="float:right;margin-top: 8px;">
                        </div>
                        <div style="margin-left: 10px">
                            <p style="font-size: 0.9em;">Do you want to Monetize this story ?</p>
                            <label>
                                <input type="radio" name="pay_story" value="Y"> Yes
                            </label>
                            <label style="padding-left:15px;">
                                <input type="radio" name="pay_story" value="N" checked> No
                            </label>
                            <span class="text-danger"><?php echo form_error('pay_story');?></span>
                        </div>
                    </div>
                </div>
                
                <div class="info">
                    <div id='translControl'>
                        <input type="hidden" id="previousenlang">
                        <?php $sesslang = get_langshortname($this->uri->segment(1)); ?>
                        <input type="hidden" id="languageto" value="<?php echo $sesslang;?>">
                        <input type="hidden" id="checkboxId" checked="checked">
                    </div>
                    
                    <div class="formgroup">
                        <label for="SelectLanguage">SELECT LANGUAGE : </label>
                        <select name="language" required="" id="languageDropDown" onchange="javascript:languageChangeHandler()">
                            <option value="">-- Select your writing language --</option>
                            <?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $key) { ?>
                            <option value="<?php echo $key->code; ?>" <?php if($key->code == $sesslang){ echo 'selected';} ?>><?php echo $key->language; ?></option>
                            <?php } } ?>
                        </select>
                        <span class="text-danger vlanguage"><?php echo form_error('language');?></span>
                    </div>
                    
                    <div class="formgroup">
                        <label for="title">ENTER TITLE : </label>
                        <input type="text" id="title" name="title" required placeholder="Enter your story title" style="border: 1px solid #ccc;" autocomplete="off" value="<?php echo set_value('title');?>">
                        <span class="text-danger vtitle"><?php echo form_error('title');?></span>
                    </div>
                    
                    <div class="formgroup" id="etitlestyle" style="<?php if(isset($sesslang) && ($sesslang != 'en')){ }else{ echo 'display:none;'; } ?>">
                        <label for="etitle">RE-ENTER TITLE IN ENGLISH : 
                            <img src="<?php echo base_url();?>assets/default/fa-question.svg" class="titleinenglish" width="16px" style="float:right;"></label>
                        <input type="text" id="etitle" name="etitle" placeholder="Re-enter your story title in english" <?php if(isset($sesslang) && ($sesslang == 'en')){ }else{ echo 'required'; } ?> style="border: 1px solid #ccc;" autocomplete="off" value="<?php echo set_value('etitle');?>">
                        <span class="text-danger vetitle"><?php echo form_error('etitle');?></span>
                    </div>
                    
                    <div class="formgroup">
                        <label for="genre">SELECT GENRE :</label>
                        <select name="genre" id="gener" required>
                            <option value="">-- Select story genre --</option>
                            <?php if(isset($gener) && ($gener->num_rows()>0)){ foreach($gener->result() as $key) { ?>
                                <option value="<?php echo $key->id; ?>" <?php if(set_value('genre') == $key->id){ echo 'selected'; } ?>><?php echo $key->gener; ?></option>
                            <?php } } ?>
                        </select>
                        <span class="text-danger vgenre"><?php echo form_error('genre');?></span>
                    </div>
                    
                    <div class="formgroup">
                        <label for="copyrights">COPYRIGHTS : 
                            <img src="<?php echo base_url();?>assets/default/fa-question.svg" class="copyrightsbtn" width="16px" style="float:right;"></label>
                        <select name="copyrights" id="copyrights" required>
                            <option value="">-- Select copyright policy --</option>
                            <option value="All rights reserved" <?php if(set_value('copyrights') == 'All rights reserved'){ echo 'selected'; } ?>>All rights reserved</option>
                            <option value="Attribution CC BY" <?php if(set_value('copyrights') == 'Attribution CC BY'){ echo 'selected'; } ?>>Attribution CC BY</option>
                            <option value="Attribution-ShareAlike CC BY-SA" <?php if(set_value('copyrights') == 'Attribution-ShareAlike CC BY-SA'){ echo 'selected'; } ?>>Attribution-ShareAlike CC BY-SA</option>
                            <option value="Attribution-NonCommercial CC BY-NC" <?php if(set_value('copyrights') == 'Attribution-NonCommercial CC BY-NC'){ echo 'selected'; } ?>>Attribution-NonCommercial CC BY-NC</option>
                            <option value="Attribution-NonCommercial-ShareAlike CC BY-NC-SA" <?php if(set_value('copyrights') == 'Attribution-NonCommercial-ShareAlike CC BY-NC-SA'){ echo 'selected'; } ?>>Attribution-NonCommercial-ShareAlike CC BY-NC-SA</option>
                            <option value="Attribution-NonCommercial-NonDerivs CC BY-NC-ND" <?php if(set_value('copyrights') == 'Attribution-NonCommercial-NonDerivs CC BY-NC-ND'){ echo 'selected'; } ?>>Attribution-NonCommercial-NonDerivs CC BY-NC-ND</option>
                        </select>
                        <span class="text-danger vcopyrights"><?php echo form_error('copyrights');?></span>
                    </div>
                    
                    <div class="formgroup">
                        <label for="keywords">KEY WORDS : </label>
                        <input type="text" id="tags-input" name="keywords" placeholder="Key words related to your story"  value="<?php echo set_value('keywords');?>">
                        <span class="text-danger"><?php echo form_error('keywords');?></span>
                    </div>
                </div>
                        
            </div>
        </form>
        
        <div id="snackbar"></div>
        
<div class="modal-wrapper" id="monitizetext">
    <div class="modal">
        <div class="popup-head">
            <div class="popup-headtext">TEXT HERE</div>   
            <div style="display : inline-block;float : right"><a class="popup-btn-close trigger" href="javascript:;">
                <img src="<?php echo base_url();?>assets/default/closeicon.svg"></a>
            </div>
        </div>
        <div class="popup-content">
            viewport element gives the browser instructions on how to control the page's dimensions and 
            scalingviewport element gives the browser instructions on how to control the page's dimensions 
            and scalingviewport element gives the browser instructions on how to control the page's dimensions
            and scalingviewport element gives the browser instructions on how to control the page's dimensions 
            and scalingviewport element gives the browser instructions on how to control the page's dimensions
            and scalingviewport element gives the browser instructions on how to control the page's dimensions
            and scalingviewport element gives the browser instructions on how to control the page's dimensions
            and scalingviewport element gives the browser instructions on how to control the page's dimensions and scalingviewport
            element gives the browser instructions on how to control the page's dimensions and scalingviewport 
        </div>
    </div>
</div>       
      
<div class="modal-wrapper" id="writing-tips-btn">
    <div class="modal">
        <div class="popup-head">
            <div class="popup-headtext">TEXT HERE  writing-tips-btn</div>   
            <div style="display : inline-block;float : right"><a class="popup-btn-close trigger" href="javascript:;">
                <img src="<?php echo base_url();?>assets/default/closeicon.svg"></a>
            </div>
        </div>
        <div class="popup-content">
            writing-tips-btn
        </div>
    </div>
</div>

<div class="modal-wrapper" id="titleinenglish">
    <div class="modal">
        <div class="popup-head">
            <div class="popup-headtext">TEXT HERE titleinenglish</div>   
            <div style="display : inline-block;float : right"><a class="popup-btn-close trigger" href="javascript:;">
                <img src="<?php echo base_url();?>assets/default/closeicon.svg"></a>
            </div>
        </div>
        <div class="popup-content">
            titleinenglish
        </div>
    </div>
</div>    
        
<div class="modal-wrapper" id="copyrightsbtn">
    <div class="modal">
        <div class="popup-head">
            <div class="popup-headtext">TEXT HERE copyrightsbtn</div>   
            <div style="display : inline-block;float : right"><a class="popup-btn-close trigger" href="javascript:;">
                <img src="<?php echo base_url();?>assets/default/closeicon.svg"></a>
            </div>
        </div>
        <div class="popup-content">
            copyrightsbtn
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
                <!--<button class="upload-own-img-btn">+ UPLOAD IMAGE</button>-->
                <button class="upload-own-img-btn"><label><input type="file" name="cover_image" id="upload-file-selector" style="display:none;">+ UPLOAD IMAGE</label></button>
                <button class="default-img-save-button">USE THIS IMAGE</button>
            </div>
        </div>
    </div>
</div>

        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap-tagsinput.min.js"></script>
<script>
    $('#tags-input').tagsinput({});
</script>
<script>
     /* Popup script */
    $( document ).ready(function() {
        $('.monitizetext').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('#monitizetext').toggleClass('open');
            return false;
        });
        
        $('.writing-tips-btn').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('#writing-tips-btn').toggleClass('open');
            return false;
        });
        
        $('.titleinenglish').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('#titleinenglish').toggleClass('open');
            return false;
        });
        
        $('.copyrightsbtn').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('#copyrightsbtn').toggleClass('open');
            return false;
        });
        
        $('.trigger').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('.modal-wrapper').removeClass('open');
             return false;
        });
    });
    /* Popup script */
</script>
<script>
    function validateForm() {
        $('.text-danger').html(" ");
        var language = document.forms["infoForm"]["languageDropDown"];
        var languageval = language.options[language.selectedIndex].value;
        var title = document.forms["infoForm"]["title"].value;
        var gener = document.forms["infoForm"]["gener"];
        var generval = gener.options[gener.selectedIndex].value;
        var copyrights = document.forms["infoForm"]["copyrights"];
        var copyrightsval = copyrights.options[copyrights.selectedIndex].value;
        var valid = true;
        if (title == "" || etitle == "" || generval == "" || copyrightsval == "") {
            if(title == ""){
                $('.vtitle').html("This field is required");
            }
            if(generval.length == ""){
                $('.vgenre').html("This field is required");
            }
            if(copyrightsval.length == ""){
                $('.vcopyrights').html("This field is required");
            }
            valid = false;
            return false;
        }
        if(languageval != 'en'){
            var etitle = document.forms["infoForm"]["etitle"].value;
            if(etitle == ""){
                $('.vetitle').html("This field is required");
                valid = false;
                return false;
            }
        }
        if(valid === true){
            $('.start-writing-btn').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
        }
    }
    
    $('input[name="pay_story"]').click(function() {
        var paystoryval = $('input[name="pay_story"]:checked').val();
        if(paystoryval == 'Y'){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/storymonitizeradio",
                success: function(data) {
                    if(data == 1){
                        $('#snackbar').text('Requested for Monitization.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }else if(data == 2){
                        $('input[name="pay_story"]').prop('checked', false);
                        $('#snackbar').text('You must have 50 followers and 3 writings to monetize this story.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 6000);
                         $('input[value="N"]').prop('checked', 'checked');
                    }else{
                        $('#monitizereqfill').modal('show');
                    }
                }
            });
        }
    });
</script>
<script type="text/javascript">
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

        var limit = 6;
        var start = 0;
        function loadmoredimages(limit, start){
          var insertimages = $('.defaultimages img:last').attr('class');
          $('.image-loadmore button').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
            $.ajax({
                url: '<?php echo base_url().$this->uri->segment(1);?>/loadmoredimages',
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
                        $('.image-loadmore button').html('LOAD MORE');
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
        $("#searchimage").keyup(function(event) {
            if (event.keyCode === 13) {
                searchimage();
            }
        });
    });
    function searchimage(slimit = false, sstart = false){
        var searchimage = $('#searchimage').val();
        $('.image-loadmore button').html('<img src="<?php echo base_url();?>assets/landing/svg/spinner.svg" class="spinner" style="height:18px;width:18px;border-radius:50%;">');
        if(slimit && sstart){
        }else{
          var slimit = 6;
          var sstart = 0;
        }
        if(searchimage && searchimage != ''){
            if(sstart == 0){
              $('.defaultimages').html('<img src="<?php echo base_url();?>assets/landing/svg/spinnertab.svg" class="spinner" style="border-style: none;height: 32px;">');
            }
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/searchimage",
                data: {'searchimage':searchimage,'limit':slimit,'start':sstart},
                success: function(data) {
                    $('.image-loadmore button').html('LOAD MORE');

                    if(data && sstart == 0){
                      $('.defaultimages').html(data);
                    }else if(data){
                      $('.image-loadmore').html('').removeClass('image-loadmore');
                      $('.defaultimages').append(data);
                    }else if(sstart != 0 && data == ''){
                      $('.image-loadmore').html('No More Results');
                    }else{
                        $('.defaultimages').html('No Images found with your search.');
                    }
                }
            });
        }else{
            $('#snackbar').text('Enter text for Image Search.').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }
    }
    function selectimg(id){
        $('.defaultimages img').removeClass("selectedIMG");
        $('.selectimg'+id).addClass('selectedIMG');
        $('.default-img-save-button').css({'background':'#3c8dbc','color':'white'});
    }
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
                var files = e.target.files,
                filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    if((f.size) > 2000000) {
                        alert('Upload File Size Should be lessthan 2MB.');
                        $("#upload-file-selector").val('');
                    }else{

                        var fd = new FormData();
                        var files = $('#upload-file-selector')[0].files[0];
                        fd.append('file',files);
                        fd.append('type','series');
                        $.ajax({
                            url:'<?php echo base_url().$this->uri->segment(1);?>/localimage',
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
                                $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>'+
                                    '<p class="browseimg">Image SIZE should be smaller than 2MB.</p>');
                            });*/
                        });
                        fileReader.readAsDataURL(f);
                    }
                }
            });
        } 
        else {
            alert("Your browser doesn't support to File API")
        }
    }
</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    // Load the Google Transliterate API
    google.load("elements", "1", {
        packages: "transliteration"
    });
    var languageto = document.getElementById("languageto").value;
    var transliterationControl;
    function onLoad() {
        if(languageto == 'en'){
            document.getElementById("previousenlang").value = 'en';
            var options = {
                sourceLanguage: 'en',
                destinationLanguage: ['te','hi','ml','ta','bn','gu','kn','mr','ru','pa','or'],
                transliterationEnabled: false,
            };
        }else{
            var options = {
                sourceLanguage: 'en',
                destinationLanguage: [languageto,'te','hi','ml','ta','bn','gu','kn','mr','ru','pa','or'],
                transliterationEnabled: true,
            };
        }
        // Create an instance on TransliterationControl with the required // options.
        transliterationControl = new google.elements.transliteration.TransliterationControl(options);
        // Enable transliteration in the textfields with the given ids.
        var ids = [ "title" ];
        transliterationControl.makeTransliteratable(ids);
        // Add the STATE_CHANGED event handler to correcly maintain the state
        // of the checkbox.
        transliterationControl.c.qc.t13n.c[3].c.d.keyup[0].ia.F.p = 'https://www.google.com';  // https ssl activation 
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
            transliterateStateChangeHandler);
        // Add the SERVER_UNREACHABLE event handler to display an error message
        // if unable to reach the server.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE, serverUnreachableHandler);
        // Add the SERVER_REACHABLE event handler to remove the error message
        // once the server becomes reachable.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE, serverReachableHandler);
        // Set the checkbox to the correct state.
        document.getElementById('checkboxId').checked = transliterationControl.isTransliterationEnabled();
        // Populate the language dropdown
        var destinationLanguage = transliterationControl.getLanguagePair().destinationLanguage;
    }
    // Handler for STATE_CHANGED event which makes sure checkbox status
    // reflects the transliteration enabled or disabled status.
    function transliterateStateChangeHandler(e) {
        document.getElementById('checkboxId').checked = e.transliterationEnabled;
    }
    // Handler for dropdown option change event.  Calls setLanguagePair to
    // set the new language.
    function languageChangeHandler() {
        var dropdown = document.getElementById('languageDropDown');
            document.getElementById("title").value = ''; // removing change language text start
            document.getElementById("gener").value = '';
            document.getElementById("copyrights").value = '';
            $('#tags-input').tagsinput('removeAll'); // removing change language text end
        var previousenlang = document.getElementById("previousenlang").value;
        if(dropdown.options[dropdown.selectedIndex].value == 'en'){
            document.getElementById("etitlestyle").style.display = "none";
            document.getElementById("previousenlang").value = 'en';
            transliterationControl.toggleTransliteration();
        }else if(previousenlang == 'en' && dropdown.options[dropdown.selectedIndex].value != 'en'){
            document.getElementById("etitlestyle").style.display = "block";
            transliterationControl.toggleTransliteration();
            document.getElementById("previousenlang").value = '';
            transliterationControl.setLanguagePair(
            google.elements.transliteration.LanguageCode.ENGLISH,
            dropdown.options[dropdown.selectedIndex].value);
        }else{
            document.getElementById("etitlestyle").style.display = "block";
            transliterationControl.setLanguagePair(
            google.elements.transliteration.LanguageCode.ENGLISH,
            dropdown.options[dropdown.selectedIndex].value);
        }
    }
    // SERVER_UNREACHABLE event handler which displays the error message.
    function serverUnreachableHandler(e) {
        document.getElementById("errorDiv").innerHTML = "Transliteration Server unreachable";
    }
    // SERVER_UNREACHABLE event handler which clears the error message.
    function serverReachableHandler(e) {
        document.getElementById("errorDiv").innerHTML = "";
    }
    google.setOnLoadCallback(onLoad);
</script>
        
    </body>
</html>