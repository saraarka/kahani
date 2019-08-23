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

.write-nav2{
  display: none;
}
.write-nav2 div{
  width: 50%;
  text-align: center;
  line-height: 50px;
  color: white
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
  border-radius : 5px;
  border: 1px solid white;
  padding :10px;

}

.publish-btn{
  background: #00000c24;
}

.writing-tips-btn{
  background: #00000c24; 
}

.cancel-btn{
  margin-top: 11px;
}

.logo1{
    width: 170px;
    margin-top: 15px;
    margin-left: 15px;
    display : inline-block;
}

.logo-small{
    display : none;
    margin: 11px 20px;
    height: 38px;
}
.prefacemobile {
    display: none;
}
.browseimg {
    margin: -35px;
    font-size: 12px;
    line-height: 22px;
    text-transform: uppercase;
}
.imageThumb {
    width: 293px;
    height: 280px;
}
.removeimg {
    background: #3c8dbc;
    text-align: center;
    width: 293px;
    margin: 15px;
    padding: 3px 0px;
    color: #fff;
}
.storywritepreface {
    overflow-y: scroll;
    padding: 10px 0 10px 0;
    height: 350px;
    max-width: 100%;
    width: 100%;
}
@media screen and (max-width: 1155px){
 .editor {
  width: 750px;
 }   
}

@media screen and (max-width:800px){
    .series-title{
       display: none;
    }
}
@media screen and (max-width:760px){
    .logo1{
        display : none;
  }

    .logo-small{
       display : inline-block;
       
  }
  .preface{
      display: none;
  }
  .prefacemobile{
      display: block;
  }
}

@media screen and (min-width:400px) and (max-width:480px){
    .nav-items-write{
        margin-top:14px;
        font-size : 13px;
    }
    .publish-btn{
        padding :7px;
    }
    .cancel-btn{
        margin-top: 8px;
    }
    .nav-items-write div {
        margin-right: 15px;
    }
    .writing-tips-btn {
       padding :7px;
    } 
}

@media screen and (max-width:399px){
    .publish-btn, .writing-tips-btn{
        display: none;
    }
    .write-nav{
        height: 50px;
    }
    .sidebar {
        margin-top: 13px;
    }
    .nav-items-write{
        margin-top: 6px;
    }
    .write-nav2{
        display: flex;
        height: 50px;
        background: #23678e;;
        font-family: Arial, Helvetica, sans-serif;
        position: fixed;
        top: 50px;
        width: 100%;
        z-index: 1000;
    }
    
    .editorcontainer{
        padding-top: 140px;
    }
    .logo-small {
        height: 28px;
    }
    .prefacemobile{
        font-size: 0.8em;
    }
}

/*snackbar css */
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
  bottom: 30; /* 30px from the bottom */
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
</style>
        
    </head>
    <body>
        
        <div class="write-nav">
            <a href="<?php echo base_url().$this->uri->segment(1);?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" class="logo1"></a>
            <a href="<?php echo base_url().$this->uri->segment(1);?>"><img src="<?php echo base_url();?>assets/default/writemobile.png" class="logo-small"></a>
            <div class="nav-items-write">
                <div class="writing-tips-btn" type="submit" onclick="addepisode()">ADD EPISODE</div>
                <div class="publish-btn" type="submit" onclick="submit()">PUBLISH</div>
                <a href="<?php echo base_url().$this->uri->segment(1);?>" style="text-decoration:none;color:#fff;">
                    <div class="cancel-btn">CANCEL</div>
                </a>
            </div>
        </div>
        <div class="write-nav2">
            <div style="border-right: 1px solid #0a000026;" type="submit" onclick="addepisode()">ADD EPISODE</div>
            <div type="submit" onclick="submit()">PUBLISH</div>
        </div>
        
        <div>
            <?php if(isset($res) && ($res->num_rows() > 0)){ foreach($res->result() as $row) { ?>
            <form action="<?php echo base_url().$this->uri->segment(1);?>/addstory_intro/<?php echo $row->sid;?>" id="display_result" method="POST" enctype="multipart/form-data">
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
                                        <img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $row->title;?>" class="imageThumb">
                                    </span>
                                <?php } ?>
                            </label>
                        </div>
                        <div class="removebtn"></div>
                    </div>
                    
                    <div class="editordiv">
                        <div class="enter-title-box"><?php echo $row->title; ?></div>
                        <center><h4 style="color: #777;" class="preface">INTRODUCE YOUR NEW SERIES TO THE AUDIENCE BY WRITING A PREFACE</h4></center>
                        <center><h4 style="color: #777;" class="prefacemobile">PREFACE - INTRODUCE YOUR SERIES</h4></center>
                        <input type="hidden" id="languageto" value="<?php echo $row->language;?>">
                        <span class="text-danger storyerror"></span>
                        <textarea class="storywritepreface" id="story" name="story" style="resize:none;"><?php echo $row->story;?></textarea>
                        <iframe id="story_ifr" style="display: none;"></iframe>
                        <span class="text-danger"><?php echo form_error('story');?></span>
                        <input type="hidden" name="story_id" value="<?php echo $row->sid; ?>"> 
                        <input type="hidden" name="addepisode" value="" id="addepisode">
                        <input type="hidden" name="draft" value="" id="draft">
                        <input type="hidden" name="pay_story" value="<?php echo $row->pay_story; ?>">
                        <input type="hidden" name="title" value="<?php echo $row->title; ?>">
                    </div>
                </div>
            </form>
            <?php } } ?>
        </div>
        
        <center><div id="snackbar"></div></center>
        
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script>
    function previewContent(){
        var story = tinyMCE.activeEditor.getContent();
        var sid = $('input[name="story_id"]').val();
        var pay_story = $('input[name="pay_story"]').val();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url().$this->uri->segment(1);?>/prefaceautosave",
            data: {'story':story, 'sid':sid, 'pay_story':pay_story},
			success:function(data){
			    console.log(data);
			}
		});
    }
    function submit(){
        $('#addepisode').val(' ');
        $('#draft').val(' ');
        var story = tinyMCE.activeEditor.getContent();
        if(story == '' || story == ' ' || story == 'null'){
            $('#snackbar').text('Please Enter Preface.').addClass('show');
    		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $('#draft').val('');
            $('.publish-btn').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
            $("#display_result").submit();
        }
    }
    
    function addepisode(){
        $('#addepisode').val('yes');
        $('#draft').val('draft');
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        if(story == '' || story == ' ' || story == 'null' || storytext.length < 1){
            $('#snackbar').text('Please Enter Preface first.').addClass('show');
    		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $('#addepisode').val('yes');
            $('#draft').val('draft');
            $('.writing-tips-btn').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
            $("#display_result").submit();
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
	        }
	    });
    } 
    else {
        alert("Your browser doesn't support to File API")
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
              var reader = new FileReader();
              reader.onload = function() {
                /*callback(e.target.result, {
                  alt: ''
                });*/
                var $data = {'file': reader.result };
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().$this->uri->segment(1);?>/uploadstoryimg',
                    data: $data,
                    success: function(response) {
                        callback(response, {
                            alt: ''
                        });
                    },error: function(response) {
                        $('#snackbar').text('Your browser does not support to File API').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                    },
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
        var ids = [ "story","story_ifr" ];
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