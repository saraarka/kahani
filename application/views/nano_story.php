<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Story Carry</title>
        <link href="<?php echo base_url();?>assets/css/infopage.css" rel="stylesheet">
        <style>
            .storywrite {
                font-family: Arial, Helvetica, sans-serif;
                padding: 10px 0 10px 0;
                height: 350px;
                max-width: 100%;
                width: 100%;
                resize: none;
                padding: 0px 0px 0px 5px;
                font-size: 15px;
                letter-spacing: .03em;
                line-height: 1.8em;
                margin: 0;
            }
            h6 {
                font-size: 12px;
                margin-top: 10px;
                margin-bottom: 10px;
                font-family: inherit;
                font-weight: 500;
                line-height: 1.1;
                color: inherit;
            }
            textarea:focus {
                outline-offset: 0px;
                outline: none;
            }
            
            /* popup delete cancel buttons css start */
            .btn{
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -ms-touch-action: manipulation;
                touch-action: manipulation;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 4px;
            }
            .btn-primary{
                color: rgb(255, 255, 255);
                background-color: #3c8dbc;
                border-color: #3c8dbc;
            }
            /* popup delete cancel buttons css end */
            

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
    </head>
    <body>
        <div class="write-nav">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" class="logo1"></a>
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/default/writemobile.png" class="logo-small"></a>
            <div class="nav-items-write">
                <div class="writing-tips-btn">WRITING TIPS</div>
                <div><button type="submit" class="start-writing-btn" onclick="submit()"> PUBLISH </button></div>
                <a href="<?php echo base_url();?>english" style="text-decoration:none;color:#fff;">
                    <div class="cancel-btn">CANCEL</div>
                </a>
            </div>
        </div>
            
        <div class="infocontainer">
            <div class="info">
                <form action="<?php echo base_url('nano_insert');?>" method="post" id="display_result">
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
                    <div class="display: flex;">
                        <img src="<?php echo base_url();?>assets/default/fa-question.svg" class="nanoinfor" width="14px" style="float:left; padding-right: 10px;">
                        <h6 class="pull-left" id="count_message"></h6>
                    </div>
                    <textarea class="storywrite" id="story" name="story" placeholder="Start Writing Here...." maxlength="1000" minlength="1"><?php echo set_value('story');?></textarea>
                </form>
            </div>
        </div>
        <div id="snackbar"></div>
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
        <div class="modal-wrapper" id="nanoinfor">
            <div class="modal">
                <div class="popup-head">
                    <div class="popup-headtext">TEXT HERE  nanoinfor</div>   
                    <div style="display : inline-block;float : right"><a class="popup-btn-close trigger" href="javascript:;">
                        <img src="<?php echo base_url();?>assets/default/closeicon.svg"></a>
                    </div>
                </div>
                <div class="popup-content">
                   nanoinfor count
                </div>
            </div>
        </div>

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    var text_max = 1000;
    $('#count_message').html(text_max + ' Remaining');
    $('#story').keyup(function() {
        var text_length = $('#story').val().length;
        var text_remaining = text_max - text_length;
        $('#count_message').html(text_remaining + ' Remaining');
    });
</script>
<script>
    $( document ).ready(function() {
        $('.writing-tips-btn').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('#writing-tips-btn').toggleClass('open');
            return false;
        });
        
        $('.nanoinfor').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('#nanoinfor').toggleClass('open');
            return false;
        });
        
        $('.trigger').click(function() {
            $('body').toggleClass('hide-body-scroll');
            $('.modal-wrapper').removeClass('open');
            return false;
        });
        
    });
</script>
<script>
function submit(){
    var storytext = $('textarea#story').val();
    if(storytext.length > 0){
        $('.start-writing-btn').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
        $("#display_result").submit();
    }else{
        $('#snackbar').text('Enter story.').addClass('show');
		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    }
}
</script>
<!-- Delete confirm popup start -->
<div class="modal-wrapper" id="confirmdelpopup">
    <div class="modal">
        <div class="popup-head">
            <div class="popup-headtext">Are You Sure? Do you want to Delete?</div>
        </div>
        <div class="popup-content">
            <p class="deletemessage"></p>
            <center>
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delconfirmed">Delete</button>
                <button type="button" data-dismiss="modal" class="btn delcancelled">Cancel</button>
            </center>
        </div>
    </div>
</div>
<!-- Delete confirm popup end -->
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
    var languageto = document.getElementById("languageto").value;
    var transliterationControl;
    var oldValue = $('select#languageDropDown option:selected').val();
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
        var ids = [ "story" ];
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
        var storytext = document.getElementById("story").value;
        if(storytext){
            $('.deletemessage').html('The content you have written will be cleared if you switch language.');
            $('#confirmdelpopup').addClass('open').one('click', '#delconfirmed', function (e) {
                var dropdown = document.getElementById('languageDropDown');
                document.getElementById("story").value = '';
                document.getElementById("count_message").innerHTML = '1000 Remaining';
                var previousenlang = document.getElementById("previousenlang").value;
                    $('body').toggleClass('hide-body-scroll');
                    $('.modal-wrapper').removeClass('open');
                if(dropdown.options[dropdown.selectedIndex].value == 'en'){
                    document.getElementById("previousenlang").value = 'en';
                    transliterationControl.toggleTransliteration();
                }else if(previousenlang == 'en' && dropdown.options[dropdown.selectedIndex].value != 'en'){
                    transliterationControl.toggleTransliteration();
                    document.getElementById("previousenlang").value = '';
                    transliterationControl.setLanguagePair(
                    google.elements.transliteration.LanguageCode.ENGLISH,
                    dropdown.options[dropdown.selectedIndex].value);
                }else{
                    transliterationControl.setLanguagePair(
                    google.elements.transliteration.LanguageCode.ENGLISH,
                    dropdown.options[dropdown.selectedIndex].value);
                }
                oldValue = dropdown.options[dropdown.selectedIndex].value;
            });
            $('#confirmdelpopup').addClass('open').one('click', '.delcancelled', function (e) {
                document.getElementById('languageDropDown').value = oldValue;
                $('body').toggleClass('hide-body-scroll');
                $('.modal-wrapper').removeClass('open');
            });
        }else{
            var dropdown = document.getElementById('languageDropDown');
            document.getElementById("story").value = '';
            var previousenlang = document.getElementById("previousenlang").value;
            if(dropdown.options[dropdown.selectedIndex].value == 'en'){
                document.getElementById("previousenlang").value = 'en';
                transliterationControl.toggleTransliteration();
            }else if(previousenlang == 'en' && dropdown.options[dropdown.selectedIndex].value != 'en'){
                transliterationControl.toggleTransliteration();
                document.getElementById("previousenlang").value = '';
                transliterationControl.setLanguagePair(
                google.elements.transliteration.LanguageCode.ENGLISH,
                dropdown.options[dropdown.selectedIndex].value);
            }else{
                transliterationControl.setLanguagePair(
                google.elements.transliteration.LanguageCode.ENGLISH,
                dropdown.options[dropdown.selectedIndex].value);
            }
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
