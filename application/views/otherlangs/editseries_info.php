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
    <body>
        
        <form action="<?php echo base_url().$this->uri->segment(1);?>/updateseries_info/<?php echo $sid; ?>" onsubmit="return validateForm()" name="infoForm" method="post" enctype="multipart/form-data">
            <div class="write-nav">
                <a href="<?php echo base_url().$this->uri->segment(1);?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" class="logo1"></a>
                <a href="<?php echo base_url().$this->uri->segment(1);?>"><img src="<?php echo base_url();?>assets/default/writemobile.png" class="logo-small"></a>
                <div class="nav-items-write">
                    <div class="writing-tips-btn">WRITING TIPS</div>
                    <div><button type="submit" id="submitform" class="start-writing-btn">UPDATE INFO</button></div>
                    <a href="<?php echo base_url().$this->uri->segment(1);?>" style="text-decoration:none;color:#fff;">
                        <div class="cancel-btn">CANCEL</div>
                    </a>
                </div>
            </div>
            
            <div class="infocontainer">
                
                <?php if(isset($story_info, $preface) && ($story_info->num_rows() == 1) && ($preface == 'preface')){
                    foreach($story_info->result() as $seriesrow) { ?>
                    <div class="imagemaindiv">
                        <div class="imagebox">
                            <label for="upload-file-selector">
                                <?php if(isset($seriesrow->cover_image) && !empty($seriesrow->cover_image)) { ?>
                                    <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
                                    <span class="upload-file-selector">
                                        <img src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->cover_image;?>" alt="<?php echo $seriesrow->title;?>">
                                    </span>
                                <?php } else { ?>
                                    <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
                                    <span class="upload-file-selector">
                                        <img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;"/>
                                        <p class="browseimg">Image SIZE should be smaller than 2MB.</p>
                                    </span>
                                <?php } ?>
                                <span class="text-danger imageerror"></span>
                            </label>
                        </div>
                        <div class="removebtn"></div>
                        
                        <div class="monetize">
                            <div class="monitizediv">MONETISATION
                                <img src="<?php echo base_url();?>assets/default/fa-question.svg" class="monitizetext" width="14px" style="float:right;margin-top: 8px;">
                            </div>
                            <div style="margin-left: 10px">
                                <p style="font-size: 0.9em;">Do you want to Monetize this story ?</p>
                                <label>
                                    <input type="radio" name="pay_story" value="Y" <?php if(isset($seriesrow->pay_story) && $seriesrow->pay_story == 'Y'){ echo 'checked'; } ?>> Yes
                                </label>
                                <label style="padding-left:15px;">
                                    <input type="radio" name="pay_story" value="N" <?php if(isset($seriesrow->pay_story) && $seriesrow->pay_story == 'N'){ echo 'checked'; } ?>> No
                                </label>
                                <span class="text-danger"><?php echo form_error('pay_story');?></span>
                            </div>
                        </div>
                    </div>
                        
                    <div class="info">
                        <div id='translControl'>
                            <input type="hidden" name="editstorytype" value="seriespreface">
                            <input type="hidden" name="language" id="languageto" value="<?php if(isset($seriesrow->language) && !empty($seriesrow->language)){ echo $seriesrow->language; }else{ echo 'en'; } ?>">
                            <input type="hidden" id="checkboxId" checked="checked">
                        </div>
                        
                        <div class="formgroup">
                            <label for="title">ENTER TITLE : </label>
                            <input type="text" id="title" name="title" value="<?php echo $seriesrow->title;?>" required placeholder="Enter your story title" style="border: 1px solid #ccc;" autocomplete="off">
                            <span class="text-danger vtitle"><?php echo form_error('title');?></span>
                        </div>
                        
                        <?php if(isset($seriesrow->language) && ($seriesrow->language != 'en')){ ?>
                        <div class="formgroup" id="etitlestyle">
                            <label for="etitle">RE-ENTER TITLE IN ENGLISH : 
                                <img src="<?php echo base_url();?>assets/default/fa-question.svg" class="titleinenglish" width="16px" style="float:right;"></label>
                            <input type="text" id="etitle" name="etitle" value="<?php echo $seriesrow->etitle;?>" required placeholder="Re-enter your story title in english" style="border: 1px solid #ccc;" autocomplete="off">
                            <span class="text-danger vetitle"><?php echo form_error('etitle');?></span>
                        </div>
                        <?php } ?>
                        
                        <div class="formgroup">
                            <label for="genre">SELECT GENRE :</label>
                            <select name="genre" id="gener" required="">
                                <option value="">-- Select story genre --</option>
                                <?php if(isset($gener) && ($gener->num_rows()>0)){ foreach($gener->result() as $key) { ?>
                                    <option value="<?php echo $key->id; ?>" <?php if($key->id == $seriesrow->genre){ echo 'selected'; }?>><?php echo $key->gener; ?></option>
                                <?php } } ?>
                            </select>
                            <span class="text-danger vgenre"><?php echo form_error('genre');?></span>
                        </div>
                        
                        <div class="formgroup">
                            <label for="copyrights">COPYRIGHTS : 
                                <img src="<?php echo base_url();?>assets/default/fa-question.svg" class="copyrightsbtn" width="16px" style="float:right;"></label>
                            <select name="copyrights" id="copyrights" required="">
                                <option value="">-- Select copyright policy --</option>
                                <option value="All rights reserved" <?php if($seriesrow->copyrights == 'All rights reserved'){ echo 'selected'; }?>>All rights reserved</option>
                                <option value="Attribution CC BY" <?php if($seriesrow->copyrights == 'Attribution CC BY'){ echo 'selected'; }?>>Attribution CC BY</option>
                                <option value="Attribution-ShareAlike CC BY-SA" <?php if($seriesrow->copyrights == 'Attribution-ShareAlike CC BY-SA'){ echo 'selected'; }?>>Attribution-ShareAlike CC BY-SA</option>
                                <option value="Attribution-NonCommercial CC BY-NC" <?php if($seriesrow->copyrights == 'Attribution-NonCommercial CC BY-NC'){ echo 'selected'; }?>>Attribution-NonCommercial CC BY-NC</option>
                                <option value="Attribution-NonCommercial-ShareAlike CC BY-NC-SA" <?php if($seriesrow->copyrights == 'Attribution-NonCommercial-ShareAlike CC BY-NC-SA'){ echo 'selected'; }?>>Attribution-NonCommercial-ShareAlike CC BY-NC-SA</option>
                                <option value="Attribution-NonCommercial-NonDerivs CC BY-NC-ND" <?php if($seriesrow->copyrights == 'Attribution-NonCommercial-NonDerivs CC BY-NC-ND'){ echo 'selected'; }?>>Attribution-NonCommercial-NonDerivs CC BY-NC-ND</option>
                            </select>
                            <span class="text-danger vcopyrights"><?php echo form_error('copyrights');?></span>
                        </div>
                        
                        <div class="formgroup">
                            <label for="keywords">KEY WORDS : </label>
                            <input type="text" id="tags-input" name="keywords" value="<?php echo $seriesrow->keywords;?>" placeholder="Key words related to your story">
                            <span class="text-danger"><?php echo form_error('keywords');?></span>
                        </div>
                    </div>
                <?php } } ?>
                
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
        var languageval = document.forms["infoForm"]["language"].value;
        var title = document.forms["infoForm"]["title"].value;
        var gener = document.forms["infoForm"]["gener"];
        var generval = gener.options[gener.selectedIndex].value;
        var copyrights = document.forms["infoForm"]["copyrights"];
        var copyrightsval = copyrights.options[copyrights.selectedIndex].value;
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
            return false;
        }
        if(languageval != 'en'){
            var etitle = document.forms["infoForm"]["etitle"].value;
            if(etitle == ""){
                $('.vetitle').html("This field is required");
                return false;
            }
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
                        $('#snackbar').text('You Should have minimum 50 Followers and more than 3 writing to Monitize.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 6000);
                        $('input[value="N"]').prop('checked', 'checked');
                    }else{
                        $('#snackbar').text('Please login.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
            });
        }
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

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    // Load the Google Transliterate API
    google.load("elements", "1", {
        packages: "transliteration"
    });
    var languageto = document.getElementById("languageto").value;
    var transliterationControl;
    function onLoad() {
        var options = {
            sourceLanguage: 'en',
            destinationLanguage: [languageto],
            transliterationEnabled: true,
        };
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
        var dropdown = document.getElementById('languageto').value;
        transliterationControl.setLanguagePair(
        google.elements.transliteration.LanguageCode.ENGLISH, dropdown);
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