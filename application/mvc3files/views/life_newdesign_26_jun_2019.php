<!-- Key words tags -->
<link href="<?php echo base_url();?>assets/dist/js/js/tokenize2.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/life.css">

<form action="<?php echo base_url('life_story_uplode') ?>" id="display_result" method="post" name="registration" enctype="multipart/form-data">
	<div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" style="margin-bottom:0px;  background-color:#23678e;">	
    	<div class="navbar-collapse">
    		<ul class="nav navbar-nav pull-right">
    			<li class="">
        			<button class="btn btn-warning" type="submit" style="background:none; color:#FFF;font:bold;border-color: #3c8dbc;margin-top:8.5px;" id="submitform"> START WRITING </button> 
			    </li>
			    <li class="">
        			<a href="<?php echo base_url();?>write-life" class="" style="background:none;color:#FFF;font:bold;border-color:#3c8dbc;"> CANCEL </a>
			    </li>
    		</ul>
    	</div>
    </div>
<!-- Content Wrapper. Contains page content -->
<div class="tops">
	<section class="content contentseries">
        <div style="display:flex; justify-content:center;">
    			<div class="hidec" style="margin-bottom:20px; width:293px;">
    				<div class="row">
                        <label class="btn-default" style="background:none; width: 293px;cursor:pointer;" for="upload-file-selector">
    				        <div class="box box-widget widget-user boxshv vjbs" style="height: 280px; width:293px;">
    							<input type="file" name="cover_image" id="upload-file-selector">
    							<span class="upload-file-selector">
    							    <center style="padding-top:115px;">
    						            <img src="<?php echo base_url() ?>assets/images/flat.png" style="cursor:pointer!important;"/>
    						        </center>
    						    </span>
    						    <div class="box-footer" style="padding-top:83px;border:none!important;font-weight: 200;">
    							    <center>
    							        <p class="text-muted" style="margin:0">Uploading image should be smaller than 2MB. 
    							    </center>
    						    </div>
    						</div>
    						<span class="text-danger imageerror"></span>
    					</label>
    				</div><br>
    				
    				<div class="row">
        				<div class="box box-default boxshv" style="width: 293px; border:none;">
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
    			<!-- /.col -->
    			<div class="side-ed">
        			    <div class="box box-widget widget-user boxshv editor-series"><br>
    					<div class="row">
    						<div class="box-body form-horizontal">
    							<div class="form-group" id='translControl'>
									<label for="" class="col-sm-3 control-label">Select Language : </label>
									<input type="hidden" id="previousenlang">
									<?php $sesslang = get_langshortname($this->uri->segment(1)); ?>
									<input type="hidden" id="languageto" value="<?php echo $sesslang;?>">
									<input type="hidden" id="checkboxId" checked="checked">
									<div class="col-sm-8">
    									<select class="form-control" name="language" required="" id="languageDropDown" onchange="javascript:languageChangeHandler()">
    										<option value=""> Select Language </option>
    										<?php if(isset($languages) && ($languages->num_rows() >0)){ foreach($languages->result() as $key) { ?>
    										<option value="<?php echo $key->code; ?>" <?php if($key->code == $sesslang){ echo 'selected';} ?>><?php echo $key->language; ?></option>
    										<?php } } ?>
    									</select>
    								</div>
								</div>
    							<div class="form-group">
    								<label for="" class="col-sm-3 control-label">Title :</label>
    								<div class="col-sm-8">
    								    <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
    								</div>
    								<div class="col-sm-1"></div>
    							</div>
    							
    							<!--<div class="form-group">
    								<label for="" class="col-sm-3 control-label">Title in English :</label>
    								<div class="col-sm-8">
    								    <input type="text" class="form-control" id="etitle" name="etitle" placeholder="Re-Enter Title in English" required>
    								</div>
    								<div class="col-sm-1 es"><a href="" data-toggle="modal" data-target="#que"><i class="fa fa-question-circle"></i></a></div>
    							</div> -->
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
    								<label for="" class="col-sm-3 control-label">Copyrights :</label>
    								<div class="col-sm-8">
    									<select class="form-control" name="copyrights" required="" id="copyrights">
    									    <option value="">--Select Copyrights --</option>
    										<option value="All rights reserved">All rights reserved</option>
    										<option value="Attribution CC BY">Attribution CC BY</option>
    										<option value="Attribution-ShareAlike CC BY-SA">Attribution-ShareAlike CC BY-SA</option>
    										<option value="Attribution-NonCommercial CC BY-NC">Attribution-NonCommercial CC BY-NC</option>
    										<option value="Attribution-NonCommercial-ShareAlike CC BY-NC-SA">Attribution-NonCommercial-ShareAlike CC BY-NC-SA</option>
    										<option value="Attribution-NonCommercial-NonDerivs CC BY-NC-ND">Attribution-NonCommercial-NonDerivs CC BY-NC-ND</option>
    									</select>
    								</div>
    								<div class="col-sm-1 es"><a href="" data-toggle="modal" data-target="#copy"><i class="fa fa-question-circle"></i></a></div>
    							</div>
    							<div class="form-group">
    								<label for="" class="col-sm-3 control-label">Key words :</label>
    								<div class="col-sm-8">
        								<select name="keywords[]" class="form-control tokenize-custom-demo1" multiple>
                                            <?php if(isset($tagslist) && ($tagslist->num_rows() >0)){ foreach($tagslist->result() as $taglist){ ?>
                                                <option value="<?php echo $taglist->tagname;?>"><?php echo $taglist->tagname;?>  &nbsp; &nbsp; - &nbsp; Tag used in <?php echo $taglist->tagcount;?> Life Events</option>
                                            <?php } } ?>
                                        </select> 
    								</div>
    								<div class="col-sm-1"></div>
    							</div>
    							<div class="form-group">
    								<label for="writing_style" class="col-sm-3 control-label">Display Name :</label>
    								<div class="col-sm-2" style="padding-top:7px;">
    								    <input type="radio" name="writing_style" value="name" checked> By Name<br>
    								</div>
    								<div class="col-sm-3" style="padding-top:7px;">
    								    <input type="radio" name="writing_style" value="anonymous"> By Anonymous<br>
    								</div>
    								<div class="col-sm-4"></div>
    							</div>
    							
    							<div class="row">
    							    <div class="form-group" style="text-align:center">
    							        <div class="textanonymous" style="margin-left:230px;width:300px; padding-top: 7px; color:#7c7c7c; border: 1px solid #ddd; padding: 8px;border-radius: 5px; background: #eee;">
    								        Your name will be displayed to the public.
    								    </div>
    								</div>
    							</div>
    							
    						</div>
    					</div>
    				</div>
    			</div>
		    </div>
	</section>
	
	<section class="content contentseries1">
	    <div class="" style="text-align:center;">
	        <h3>TO START WRITING</h3><br>
	        INSTALL OUR APP<br>
	        <a href=""><img src="<?php echo base_url();?>assets/landing/storycarry app.png" class="img-thumbnaile"></a><br>
	        Or<br>
	        OPEN SITE ON DESKTOP
	    </div>
	</section>
</div>
</form>
<!--</div>-->
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


<!-- Key words tags -->
<script src="<?php echo base_url();?>assets/dist/js/js/tokenize2.js"></script>
<script>
    $('.tokenize-sample-demo1, .tokenize-disabled-demo, .tokenize-events-demo').tokenize2();
    $('.tokenize-custom-demo1').tokenize2({
        tokensAllowCustom: true
    });
</script>
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
function submit(){
 	var c=$("#title").val();
 	var d=$("#writing_style").val();
 	if(c != ""){
	    $("#display_result").submit();
 	}
	else{
	    alert('plase enter Title');
	}
	if(d != ""){
		$("#display_result").submit();
	}
	else{
	    alert('plase enter Pick a Writing Style');
	}
}
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
                            $('.upload-file-selector').html('<center style="padding-top:115px;">'+
                                '<img src="<?php echo base_url() ?>assets/images/flat.png" style="cursor:grab!important;"/> </center>'+
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



<!--  google language conversation -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
        document.getElementById("copyrights").value = '';
        $('.tokenize-custom-demo1 option:selected').prop('selected', false);
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