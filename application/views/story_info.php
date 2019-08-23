<link href="<?php echo base_url();?>assets/dist/js/js/tokenize2.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/story_info.css">


<form action="<?php echo base_url('welcome/story_info_uplode') ?>" id="display_result" method="post" name="registration" enctype="multipart/form-data">
    <div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="navbarv" style="margin-bottom:0px;  background-color:#23678e;">	
    	<input type="hidden" name="hidden" value="<?php echo $story_info->sid;?>">
    	<div class="navbar-collapse">
    		<ul class="nav navbar-nav pull-right fv">
    			<li>
        			<button class="btn btn-warning" type="submit" style="background:none; color:#FFF;font:bold;border-color: #3c8dbc;margin-top:8px;" id="submitform"> UPDATE INFO</button> 
			    </li>
			    <li>
        			<a href="<?php echo base_url();?>english" class="" style="background:none;color:#FFF;font:bold;border-color:#3c8dbc;"> CANCEL </a>
			    </li>
    		</ul>
    	</div>
    </div>


  <!-- Content Wrapper. Contains page content -->
<div class="tops" style="justify-content:center;">
    <div class="content contentseries">
        <div style="display:flex; justify-content:center;">
		    <div class="hidec" style="margin-bottom:20px; width:293px;">
				<div class="row" style="width:293px;">
				<div class="box box-default" style="box-shadow:0px 0 7px 3px rgba(0,0,0,0.1); border:none; margin-bottom:20px;">
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
                            <input type="radio" name="pay_story" value="Y" <?php if($story_info->pay_story == 'Y'){ echo 'checked';} ?>> Yes
    				    </label>
    				    <label style="padding-left:15px;">
                            <input type="radio" name="pay_story" value="N" <?php if($story_info->pay_story == 'Y'){ }else{ echo 'checked'; } ?>> No
    				    </label>
                    </div>
                    <span class="text-danger"><?php echo form_error('pay_story');?></span>
				</div>
				</div>
			</div>
		
		    <div class="side-ed">
        		<div class="box box-widget widget-user boxshv editor-series">
				<div class="row">
					<div class="box-body form-horizontal">
						<input type="hidden" id="checkboxId" checked="checked">
						<input type="hidden" id="languageto" value="<?php echo $story_info->language;?>">
						<input type="hidden" name="story_id" value="<?php echo $story_info->story_id;?>">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Title :</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required="" value="<?php echo $story_info->title;?>">
								<span class="text-danger"><?php echo $this->session->flashdata('titlemsg'); ?></span>
								<input type="hidden" class="form-control" id="type" name="type"  value="<?php echo $story_info->type;?>">	
							</div>
						</div>
						<?php if(isset($story_info->language) && ($story_info->language != 'en')){ ?>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Title in English:</label>
							<div class="col-sm-9">
							    <input type="text" class="form-control" id="etitle" name="etitle" 
							        placeholder="Title in English" <?php if(isset($story_info->type) && ($story_info->type != "series")){ 
							        echo "required"; } ?> value="<?php echo $story_info->etitle;?>">
							</div>
						</div>
						<?php } ?>
						
						<?php if($story_info->type != 'life'){ ?>
							<div class="form-group">
								<label for="" class="col-sm-3 control-label">Pick a Genre :</label>
								<div class="col-sm-9">
									<select class="form-control" name="genre" required="">
										<option value="<?php echo $story_info->genre;?>"><?php echo $story_info->gener;?></option>
										<?php foreach($gener->result() as $key) { ?>
										<option value="<?php echo $key->id; ?>"><?php echo $key->gener; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						<?php } elseif($story_info->type == 'life'){ ?>
						    <div class="form-group">
								<label for="" class="col-sm-3 control-label">Key words :</label>
								<div class="col-sm-8">
    								<select name="keywords[]" class="form-control tokenize-custom-demo1" multiple>
                                        <?php if(isset($tagslist) && ($tagslist->num_rows() >0)){ 
                                            foreach($tagslist->result() as $taglist){ $userdkeywords = explode(',',$story_info->keywords); ?>
                                            <option value="<?php echo $taglist->tagname;?>" <?php if(in_array($taglist->tagname,$userdkeywords)){echo 'selected';}?>><?php echo $taglist->tagname;?>  &nbsp; &nbsp; - &nbsp; Tag used in <?php echo $taglist->tagcount;?> Life Events</option>
                                        <?php } } ?>
                                    </select> 
								</div>
								<div class="col-sm-1"></div>
							</div>
							<div class="form-group">
								<label for="writing_style" class="col-sm-3 control-label">Display Name :</label>
								<div class="col-sm-2">
								    <input type="radio" name="writing_style" value="name" <?php if($story_info->writing_style == 'name'){ echo 'checked';}?>> By Name<br>
								</div>
								<div class="col-sm-3">
								    <input type="radio" name="writing_style" value="anonymous" <?php if($story_info->writing_style == 'anonymous'){ echo 'checked';}?>> By Anonymous<br>
								</div>
								<div class="col-sm-4"></div>
							</div>
						<?php } ?>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Copyrights :</label>
							<div class="col-sm-9">
								<select class="form-control" name="copyrights" required="" >
									<option value="<?php echo $story_info->copyrights;?>"><?php echo $story_info->copyrights;?></option>
									<option value="All rights reserved">All rights reserved</option>
									<option value="Attribution CC BY">Attribution CC BY</option>
									<option value="Attribution-ShareAlike CC BY-SA">Attribution-ShareAlike CC BY-SA</option>
									<option value="Attribution-NonCommercial CC BY-NC">Attribution-NonCommercial CC BY-NC</option>
									<option value="Attribution-NonCommercial-ShareAlike CC BY-NC-SA">Attribution-NonCommercial-ShareAlike CC BY-NC-SA</option>
									<option value="Attribution-NonCommercial-NonDerivs CC BY-NC-ND">Attribution-NonCommercial-NonDerivs CC BY-NC-ND</option>
								</select>
							</div>
						</div>
					</div>
			    </div>
			    </div>
		    </div>
            </form>
        </div>
	</div>
    <section class="content contentseries1">
	    <div class="" style="text-align:center;">
	        <h3>TO EDIT STORY INFO</h3><br>
	        INSTALL OUR APP<br>
	        <a href=""><img src="<?php echo base_url();?>assets/landing/storycarry app.png" class="img-thumbnaile"></a><br>
	        Or<br>
	        OPEN SITE ON DESKTOP
	    </div>
	</section>
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
<div id="snackbar"></div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $('.upload-file-selector').html("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<span class=\"remove\">Remove </span>" +
                    "</span>");
                    $(".remove").click(function(){
                        $(this).parent(".pip").remove();
                        $('.upload-file-selector').html('<center style="padding-top:135px;"><i class="fa fa-upload"></i> Add Image </center>');
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
<!-- Key words tags -->

<script src="<?php echo base_url();?>assets/dist/js/js/tokenize2.js"></script>
<script>
    $('.tokenize-sample-demo1, .tokenize-disabled-demo, .tokenize-events-demo').tokenize2();
    $('.tokenize-custom-demo1').tokenize2({
        tokensAllowCustom: true
    });
</script>
<script>
    $(document).ready(function(){
        $("#cancel").click(function(){
            var type = $('input[name="type"]').val();
            var sid = $('input[name="hidden"]').val();
            var storyid = $('input[name="story_id"]').val();
            var title = $('input[name="title"]').val();
            if(type == 'series'){
                location.href = "<?php echo base_url();?>admin-series/"+title.replace(/\s+/g, '-')+'-'+sid+'/'+title.replace(/\s+/g, '-')+'-'+storyid;
            }else{
                location.href = "<?php echo base_url();?>admin-story/"+title.replace(/\s+/g, '-')+'-'+sid;
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
        var languageto = document.getElementById('languageto').value;
      var transliterationControl;
      function onLoad() {
        var options = {
            sourceLanguage: 'en',
            destinationLanguage: [languageto],
            transliterationEnabled: true,
        };
        // Create an instance on TransliterationControl with the required
        // options.
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.jk
        var ids = [ "title" ];
        transliterationControl.makeTransliteratable(ids);

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
        			    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 8000);
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