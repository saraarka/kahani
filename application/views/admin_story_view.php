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
            .publish-btn, .writing-tips-btn {
                font-size: 15px;
                border-radius : 5px;
                border: 1px solid white;
                padding :10px;
                cursor:pointer;
            }
            .publish-btn{
                background: #00000c24
            }
            
            .writing-tips-btn{
                background:#00000c24; 
            }
            .draft-btn, .cancel-btn {
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
                .logo1 {
                    display : none;
                }
                .logo-small {
                    display : inline-block;
                }
            }
            @media screen and (max-width:600px){
                .writing-tips-btn {
                    display: none;
                } 
            }
            @media screen and (max-width:480px){
                .nav-items-write{
                    margin-top:14px;
                    font-size : 13px;
                }
                .publish-btn{
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
            @media screen and (min-width: 395px) and (max-width: 450px){
                #mceu_15 {
                    width:285px;
                    left:16px;
                }
                #mceu_19 {
                    width:160px;
                }
                #mceu_20 {
                    width:215px;
                }
                #mceu_18 {
                    width:285px;
                }
                #mceu_17 {
                    left:70px;
                }
                #mceu_21 {
                    left:215px;
                }
            }
        </style>
    </head>
    <body>

    <?php if(isset($editstory) && ($editstory->num_rows() == 1)){ foreach($editstory->result() as $row){ ?>
        <div class="write-nav">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" class="logo1"></a>
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/default/writemobile.png" class="logo-small"></a>
            <div class="nav-items-write">
                <div><button onclick="submit()" class="publish-btn" style="color:#FFF;"> PUBLISH </button></div>
                <div class="draft-btn">DRAFT</div>
                <div class="dropdown-content">
                    <a href="javascript:void(0);" onclick="addtodrafts(<?php echo $row->sid;?>)">SAVE DRAFT</a>
                    <a href="javascript:void(0);" onclick="deletedraft(<?php echo $row->sid;?>)">DELETE DRAFT</a>
                </div>
                <!--<a href="<?php echo base_url();?>admin-story/<?php echo preg_replace("~[^\p{M}\w]+~u",'-',$row->title).'-'.$row->sid;?>" style="text-decoration:none;color:#fff;">-->
                <a href="<?php echo base_url();?>english" style="text-decoration:none;color:#fff;">
                    <div class="cancel-btn">CANCEL</div>
                </a>
            </div>
        </div>
        
        <div>
            <form action="<?php echo base_url();?>welcome/saveupdatestory/<?php echo $row->sid;?>" method="POST" enctype="multipart/form-data" id="updatestory">
                <div class="editorcontainer">
                    <div class="imagemaindiv">
                        <div class="imagebox">
                            <label for="upload-file-selector"> 
                                <input type="hidden" id="previewimage" value="<?php echo $row->cover_image;?>">
                                <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
                                <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
                                    <span class="upload-file-selector">
                                        <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image;?>" alt="<?php echo $row->title;?>" class="imageThumb">
                                    </span>
                                <?php } else { ?>
                                    <span class="upload-file-selector">
                                        <img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $row->title;?>" class="imageThumb">
                                    </span>
                                <?php } ?>
                            </label>
                            <span class="text-danger"><?php echo $this->session->flashdata('errmsg');?></span>
                        </div>
                        <div class="removebtn"></div>
                    </div>
                    <div class="editordiv">
                        <div class="enter-title-box"><?php echo $row->title; ?></div>
                        <input type="hidden" id="languageto" value="<?php echo $row->language;?>">
                        <input type="hidden" id="title" name="title" value="<?php echo $row->title;?>">
                        <textarea class="storywrite" id="story" name="story" style="resize:none;"><?php if(isset($row->draft_story) && !empty($row->draft_story)){echo $row->draft_story;}else{echo $row->story;}?></textarea>
                        <iframe id="story_ifr" style="display: none;"></iframe>
                        <input type="hidden" name="type" value="<?php echo $row->type;?>">
                    </div>
                </div>
            </form>
        </div>
    <?php } } ?>
    
    <div id="snackbar"></div>
    
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
        var ids = [ "story","title","story_ifr" ];
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

<script>
$(document).ready(function() {
    upLoader();
});
function upLoader(){
    if (window.File && window.FileList && window.FileReader) {
        $("#upload-file-selector").on("change", function(e) {
            var previewimage = $('#previewimage').val();
            var files = e.target.files,
            filesLength = files.length;
	        for (var i = 0; i < filesLength; i++) {
                var f = files[i]
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
                        if(previewimage){
                            $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/'+previewimage+'">');
                        }else {
                            $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>'+
                                '<p class="browseimg">Image SIZE should be smaller than 2MB.</p>');
                        }
                    });
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
        var story = tinyMCE.activeEditor.getContent();
        var sid = "<?php echo $this->uri->segment(2); ?>";
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
            data: {'story':story},
			success:function(data){
                console.log('saved to Draft');
			}
		});
    }
    function addtodrafts(sid){
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        if(((storytext.replace(/\s/g,'')).length > 0) || (story.indexOf('/images/storyimgs/') != -1)){
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
                data: {'story':story},
    			success:function(data){
    			    if(data == 1){
    			        console.log('saved to drafts.');
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
    function deletedraft(sid){
        var x = confirm("Are you sure you want to delete?");
        if (x) {
            var title = $('#title').val();
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/savedeletedraft/"+sid,
    			success:function(data){
    			    if(data == 1){
                        console.log('Deleted.');
                        location.href = "<?php echo base_url();?>admin-story/"+title.replace(/\s+/g,"-")+"-"+sid;
    			    }
    			}
    		});
        }else{
            return false;
        }
    }
    function submit(){
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        if(((storytext.replace(/\s/g,'')).length > 0) || (story.indexOf('/images/storyimgs/') != -1)){
            $("#updatestory").submit();  // save button on click
        }else{
            $('#snackbar').text('Please enter story').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
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
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
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