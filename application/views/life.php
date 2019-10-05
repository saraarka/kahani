<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Story Carry</title>
        <link href="<?php echo base_url();?>assets/css/infopage.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/dist/js/js/tokenize2.css" rel="stylesheet" />
    </head>
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
    <body>
        
        <form action="<?php echo base_url();?>life_story_uplode" onsubmit="return validateForm()" name="infoForm" id="display_result" method="post" enctype="multipart/form-data">
            <div class="write-nav">
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" class="logo1"></a>
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/default/writemobile.png" class="logo-small"></a>
                <div class="nav-items-write">
                    <div class="writing-tips-btn">WRITING TIPS</div>
                    <div><button type="submit" id="submitform" class="start-writing-btn">START WRITING</button></div>
                    <a href="<?php echo base_url();?>english" style="text-decoration:none;color:#fff;">
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
                        <span class="text-danger"><?php echo form_error('language');?></span>
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
                    
                    <div class="formgroup" style="position:relative;">
                        <label for="keywords">KEY WORDS : </label>
                        <!--<select name="keywords[]" class="tokenize-custom-demo1" multiple placeholder="Key words related to your story">-->
                        <select name="keywords[]" class="tokenize-callable-demo1" multiple placeholder="Key words related to your story">
                            <!--<?php if(isset($tagslist) && ($tagslist->num_rows() >0)){ foreach($tagslist->result() as $taglist){ ?>
                                <option value="<?php echo $taglist->tagname;?>"><?php echo $taglist->tagname;?>  &nbsp; &nbsp; - &nbsp; Tag used in <?php echo $taglist->tagcount;?> Life Events</option>
                            <?php } } ?> -->
                        </select>
                        <div class="loader-hide" style="position: absolute;top:50%;left:50%; display:none">
                            <img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner">
                        </div>
                        <span class="text-danger vkeywords"><?php echo form_error('keywords');?></span>
                    </div>
                    
                    <div class="formgroup">
                        <label for="writing_style">DISPLAY NAME : </label><br>
                        <div style="margin-top: 14px;margin-bottom: 25px;">
                            <input type="radio" name="writing_style" value="name" checked> By Name
                            <input type="radio" name="writing_style" value="anonymous" style="margin-left:25px;"> By Anonymous<br>
                        </div>
                        <span class="text-danger vwriting_style"><?php echo form_error('writing_style');?></span>
                    </div>
                    <span class="textanonymous anonymousname">Your name will be displayed to the public.</span>
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
            </div>
            <div class="image-loadmore"><button>LOAD MORE</button></div>
            <div class="upload-own-img-div">
                <button class="upload-own-img-btn"><label><input type="file" name="cover_image" id="upload-file-selector" style="display:none;">+ UPLOAD IMAGE</label></button>
                <button class="default-img-save-button">USE THIS IMAGE</button>
            </div>
        </div>
    </div>
</div>
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<!-- Key words tags -->
<script src="<?php echo base_url();?>assets/dist/js/js/tokenize2.js"></script>
<script>
    /*$('.tokenize-sample-demo1, .tokenize-disabled-demo, .tokenize-events-demo').tokenize2();
    $('.tokenize-custom-demo1').tokenize2({
        tokensAllowCustom: true,
        placeholder: "Key words related to your story",
    });*/
    
    $('.tokenize-callable-demo1').tokenize2({
		tokensAllowCustom: true, // added for new tags
		placeholder: "Key words related to your story",
        dataSource: function(search, object){  // search and get tokens
        $(".loader-hide").show();
            $.ajax('<?php echo base_url();?>lifetagssearch', {
                data: { search: search, start: 1 },
                dataType: 'json',
                success: function(data){
                    $(".loader-hide").hide();
                    var $items = [];
                    $.each(data, function(k, v){
                        $items.push(v);
                    });
                    object.trigger('tokenize:dropdown:fill', [$items]);
                }
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[name="writing_style"]').click(function(){
            var radioValue = $("input[name='writing_style']:checked").val();
            if(radioValue == "anonymous"){
                $('.textanonymous').html('Your name will not be displayed to the public.');
            }else{
                $('.textanonymous').html('Your name will be displayed to the public.');
            }
        });
    });
    
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
        var valid = true;
        if (title == "" || etitle == "") {
            if(title == ""){
                $('.vtitle').html("This field is required");
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
                url: "<?php echo base_url();?>welcome/storymonitizeradio",
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
                        //$('#snackbar').text(' ').addClass('show');
                        //setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
            });
        }
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
                    $('.defaultimages').append(images);
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
        if(searchimage){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>welcome/searchimage",
                data: {'searchimage': searchimage},
                dataType: "json",
                success: function(data) {
                    var images = '';
                    $.each(data,function (p,q){
                    images+= '<img class="selectimg'+q.id+'" src="<?php echo base_url();?>assets/images/'+q.dimage+'" onclick="selectimg('+q.id+')">';
                    });
                    $('.defaultimages').html(images);
                }
            });
        }
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
        $('.cover_imagelocalp').val('');
        $('.cover_imagelocali').val('');
        $("#upload-file-selectorserver").val('');
        $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>'+
            '<p class="browseimg">Image SIZE should be smaller than 2MB.</p>');
    });
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
                        fd.append('type','life');
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

                        $('body').toggleClass('hide-body-scroll');
                        $('.modal-wrapper').removeClass('open');
                        return false;

                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $('.upload-file-selector').html("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>");
                            $('.removebtn').html("<div class=\"removeimg\"><span class=\"remove\" style=cursor:pointer;>REMOVE</span></div></span>");
                            $(".remove").click(function(){
                                $(this).parent(".pip").remove();
                                $('.removebtn').html("");
                                $("#upload-file-selector").val('');
                                $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>'+
                                    '<p class="browseimg">Image SIZE should be smaller than 2MB.</p>');
                            });
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
<!--<script>
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
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $('.upload-file-selector').html("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>");
                            $('.removebtn').html("<div class=\"removeimg\"><span class=\"remove\" style=cursor:pointer;>REMOVE</span></div></span>");
                            $(".remove").click(function(){
                                $(this).parent(".pip").remove();
                                $('.removebtn').html("");
                                $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>'+
                                    '<p class="browseimg">Image SIZE should be smaller than 2MB.</p>');
                            });
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
</script>-->
<script>
    history.pushState(null, document.title, location.href);
    window.addEventListener('popstate', function (event) {
        let leavePage = confirm("you want to go ahead ?");
        if (leavePage) {
            history.back() 
        } else {
            history.pushState(null, document.title, location.href);
        }  
    });
</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    // Load the Google Transliterate API
    google.load("elements", "1", {
        packages: "transliteration"
    });
    var languageto = document.getElementById('languageto').value;
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
        transliterationControl.c.qc.t13n.c[3].c.d.keyup[0].ia.F.p = 'https://www.google.com';  // https ssl activation
        // Add the STATE_CHANGED event handler to correcly maintain the state
        // of the checkbox.
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
        document.getElementById("title").value = '';
        $('.tokenize-callable-demo1 option:selected').prop('selected', false);
        $('li.token').html('').hide();
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