<link rel="stylesheet" href="<?php echo base_url();?>assets/css/story.css">
<style>
.infocontainer{
  display : flex;
  flex-wrap : wrap;
  margin : 0 auto;
  justify-content: center;
  padding-top: 140px;
  padding-bottom:60px;
  font-family: Arial, Helvetica, sans-serif;
}
.imagebox{
  width : 293px;
  max-width :100%;
  height : 280px;
  background : white;
  margin:0px 15px 15px 15px;
  box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);
  border-radius: 5px;
  text-align: center;
  color: #777;
}
.monetize{
  width:293px;
  height:112px;
  margin: 15px;
  max-width :100%;
  background :white;
  border-radius: 5px;
  box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);
  color: #444;
}
.hidden {
  display:none;
}
.info{
  width: 800px;
  min-height: 407px;
  max-width:100%;
  box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);
  padding: 20px;
  border-radius: 5px;
  margin: 0px 15px 15px 15px;
  box-sizing: border-box;
  background: white;
}
.browseimg{
    margin:70px 5px 0px 5px;
    font-size: 13px;
    line-height: 22px;
    text-transform: uppercase;
}
@media screen and (max-width: 1155px){
    .info {
        width: 750px;
        max-width:95%;
    }  
    .escopy{
        display:none;
    }
}
</style>
<form action="<?php echo base_url();?>story_story_uplode" id="display_result" method="post" name="registration" enctype="multipart/form-data">
	<div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="" style="margin-bottom:0px;  background-color:#23678e;">	
    	<div class="navbar-collapse">
    		<ul class="nav navbar-nav pull-right">
    			<li class="">
        			<button class="btn btn-warning" type="submit" style="background:none; color:#FFF;font:bold;border-color: #3c8dbc;margin-top:8.5px;" id="submitform"> START WRITING </button> 
			    </li>
			    <li class="">
        			<a href="<?php echo base_url();?>english" style="background:none;color:#FFF;font:bold;border-color:#3c8dbc;"> CANCEL </a>
			    </li>
    		</ul>
    	</div>
    </div>
    
    
    
    
    
    <div class="infocontainer">
        <div>
            <div class="imagebox">
                <label for="upload-file-selector">
                    <input type="file" name="cover_image" id="upload-file-selector">
                    <span class="upload-file-selector">
						<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer!important;margin-top:109px;"/>
						<p class="browseimg">UPLOAD image SIZE should be smaller than 2MB.</p>
					</span>
					<span class="text-danger imageerror"></span>
				</label>
            </div>
            <div class="monetize">
        		<div class="box box-default">
        			<div class="box-header with-border">
        				<h5 class="box-title" style="margin:0;">MONETISATION
                        <span class="es"><a href="#" class="es" data-toggle="modal" data-target="#pay">
                            <i class="fa fa-question-circle" style="font-size:18px;float:right;"></i></a>
                        </span>
        				</h5>
        			</div><hr style="margin:0 0 10px 0">
        			<div style="padding:0 10px;"><p style="margin:0;">Do you want to Monetize this story ?</p></div>
        			<div class="checkbox" style="padding:10px 10px 15px 10px; margin-top:0px;">
                        <label style="padding-left:0;">
                            <input type="radio" name="pay_story" value="Y"> Yes
        			    </label>
        			    <label style="padding-left:15px;">
                            <input type="radio" name="pay_story" value="N" checked> No
        			    </label>
                    </div>
                    <span class="text-danger"><?php echo form_error('pay_story');?></span>
        		</div>
            </div>
        </div>
        
        <div class="info">
            <div class="box-body form-horizontal">
            	<div class="form-group" id='translControl'>
					<label for="" class="col-sm-3 control-label">Select Language * : </label>
					<input type="hidden" id="previousenlang">
					<?php $sesslang = get_langshortname($this->uri->segment(1)); ?>
					<input type="hidden" id="languageto" value="<?php echo $sesslang;?>">
					<input type="hidden" id="checkboxId" checked="checked">
					<div class="col-sm-8">
						<select class="form-control" name="language" required="" id="languageDropDown" onchange="javascript:languageChangeHandler()">
							<option value=""> Select Language </option>
							<?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $key) { ?>
							<option value="<?php echo $key->code; ?>" <?php if($key->code == $sesslang){ echo 'selected';} ?>><?php echo $key->language; ?></option>
							<?php } } ?>
						</select>
						<span class="text-danger"><?php echo form_error('language');?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Title :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
					    <span class="text-danger"><?php echo form_error('title');?></span>
					</div>
				</div>
				
				<div class="form-group" id="etitlestyle" style="<?php if(isset($sesslang) && ($sesslang != 'en')){ }else{ echo 'display:none;'; } ?>">
					<label for="" class="col-sm-3 control-label">Title in English :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="etitle" name="etitle" placeholder="Re-Enter Title in English" <?php if(isset($sesslang) && ($sesslang == 'en')){ }else{ echo 'required'; } ?>>
					    <span class="text-danger"><?php echo form_error('etitle');?></span>
					</div>
					<div class="col-sm-1 es">
						<a href="" data-toggle="modal" data-target="#que"><i class="fa fa-question-circle"></i></a>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Pick a Genre * :</label>
					<div class="col-sm-8">
					    <select class="form-control" name="genre" required="" id="gener">
					    	<option value=""> -- Select Gener -- </option>
					    	<?php if(isset($gener) && ($gener->num_rows()>0)){ foreach($gener->result() as $key) { ?>
					    		<option value="<?php echo $key->id; ?>"><?php echo $key->gener; ?></option>
					    	<?php } } ?>
					    </select>
					    <span class="text-danger"><?php echo form_error('genre');?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Copyrights * :</label>
					<div class="col-sm-8">
				    	<select class="form-control" name="copyrights" required="" id="copyrights">
				    	    <option value=""> -- Select Copyrights -- </option>
				    		<option value="All rights reserved" style="margin: 10px;padding: 5px;">All rights reserved</option>
				    		<option value="Attribution CC BY" style="margin: 10px;padding: 5px;">Attribution CC BY</option>
				    		<option value="Attribution-ShareAlike CC BY-SA" style="margin: 10px;padding: 5px;">Attribution-ShareAlike CC BY-SA</option>
				    		<option value="Attribution-NonCommercial CC BY-NC" style="margin: 10px;padding: 5px;">Attribution-NonCommercial CC BY-NC</option>
				    		<option value="Attribution-NonCommercial-ShareAlike CC BY-NC-SA" style="margin: 10px;padding: 5px;">Attribution-NonCommercial-ShareAlike CC BY-NC-SA</option>
				    		<option value="Attribution-NonCommercial-NonDerivs CC BY-NC-ND" style="margin: 10px;padding: 5px;">Attribution-NonCommercial-NonDerivs CC BY-NC-ND</option>
				    	</select>
					    <span class="text-danger"><?php echo form_error('copyrights');?></span>
					</div>
					<div class="col-sm-1 es escopy">
						<a href="" class="es" data-toggle="modal" data-target="#copy"><i class="fa fa-question-circle"></i></a>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Key words :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="tags-input" name="keywords" placeholder="Key words related to your story">
					    <span class="text-danger"><?php echo form_error('keywords');?></span>
					</div>
				</div>
			</div>
        </div>
    </div>
</form>
<!-- Title in English -->
<div id="que" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>Some text in the modal.</p>
			</div>
		</div>
	</div>
</div>
<!-- copyright -->
<div id="copy" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>Some text in the modal.</p>
			</div>
		</div>
	</div>
</div>

<!-- pay monitize -->
<div id="pay" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Some text.</p>
            </div>
        </div>
    </div>
</div>

<!-- pay monitize -->
<div id="monitizereqfill" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <center>
                    <span>Monetization request will be sent after you publish this story, you can check the status in transactions page.</span>
                </center>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap-tagsinput.min.js"></script>
<script>
    $('#tags-input').tagsinput({});
</script>

<script>
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
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<span class=\"remove\">Remove </span>" +
                        "</span>");
                        $('.box-footer').css('display','none');
                        $(".remove").click(function(){
                            $(this).parent(".pip").remove();
                            $('.upload-file-selector').html('<center style="padding-top:115px;"><img src="<?php echo base_url() ?>assets/images/flat.png" style="cursor:grab!important;"/> </center>'+
    						    '<div class="box-footer" style="padding-top:92px;border:none!important;font-weight: 200;">'+
							    '<center><p class="text-muted" style="margin:0">Must be in JPG or PNG format, smaller than 2MB. </center></div>');
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
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/js/jsapidownload.js"></script>-->
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