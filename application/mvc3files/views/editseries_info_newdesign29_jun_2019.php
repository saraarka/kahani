<link rel="stylesheet" href="<?php echo base_url();?>assets/css/series.css">

<form action="<?php echo base_url();?>updateseries_info/<?php echo $sid; ?>" id="display_result" method="post" name="registration" enctype="multipart/form-data">
	<div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="navbarv" style="margin-bottom:0px;  background-color:#23678e;">	
    	<div class="navbar-collapse">
    		<ul class="nav navbar-nav pull-right" style="display:flex;">
    			<li class="">
        			<button class="btn btn-warning" type="submit" style="background:none; color:#FFF;border-color: #3c8dbc;margin-top:8.5px;" id="submitform"> UPDATE INFO </button> 
			    </li>
			    <li class="">
        			<a href="<?php echo base_url();?>english" style="background:none; color:#FFF;font:bold;border-color:#3c8dbc;"> CANCEL </a>
			    </li>
    		</ul>
    	</div>
    </div>

	<div class="tops">
		<section class="content contentseries">
			<div style="display:flex; justify-content:center;">
			    <?php if(isset($story_info, $preface) && ($story_info->num_rows() == 1) && ($preface == 'preface')){
			        foreach($story_info->result() as $seriesrow) { ?>
    				<div class="hidec" style="margin-bottom:20px; width:293px;">
    					<div class="row">
    						<label class="btn-default" style="background:none;width:293px; cursor:pointer;" for="upload-file-selector">
    							<div class="box box-widget widget-user boxshv" style="height: 280px; width:293px;">
    								<input type="file" name="cover_image" id="upload-file-selector">
    								<span class="upload-file-selector">
    								    <?php if(isset($seriesrow->cover_image) && !empty($seriesrow->cover_image)) { ?>
    									<img src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->cover_image; ?>" style="width:293px; height:280px;" class="imageThumb" alt="<?php echo $seriesrow->title;?>">
    								    <?php } else{ ?>
    								    <img src="<?php echo base_url();?>assets/images/series-stories.jpg" style="width:293px; height:280px;" class="imageThumb" alt="<?php echo $seriesrow->title;?>">
    								    <?php } ?>
    								    <span style="width:293px;"><span class="remove"> UPDATE </span></span>
    								</span>
    							</div>
    							<span class="text-danger imageerror"></span>
    						</label>
    					</div><br>
    					<div class="row" style="width:293px;">
            				<div class="box box-default boxshv" style="border:none;">
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
                                        <input type="radio" name="pay_story" value="Y" <?php if(isset($seriesrow->pay_story) && $seriesrow->pay_story == 'Y'){ echo 'checked'; } ?>> Yes
                				    </label>
                				    <label style="padding-left:15px;">
                                        <input type="radio" name="pay_story" value="N" <?php if(isset($seriesrow->pay_story) && $seriesrow->pay_story == 'N'){ echo 'checked'; } ?>> No
                				    </label>
                                </div>
                                <span class="text-danger"><?php echo form_error('pay_story');?></span>
        					</div>
            			</div>
    				</div>
    				<div class="side-ed">
        			    <div class="box box-widget widget-user boxshv editor-series"><br>
							<div class="row">
								<div class="box-body form-horizontal">
								    <input type="hidden" name="editstorytype" value="seriespreface">
								    <div class="form-group" id='translControl'>
										<input type="hidden" name="language" id="languageto" value="<?php if(isset($seriesrow->language) && !empty($seriesrow->language)){ echo $seriesrow->language; }else{ echo 'en'; } ?>">
										<input type="hidden" id="checkboxId" checked="checked">
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Title :</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required value="<?php echo $seriesrow->title;?>">
											<span class="text-danger"><?php echo form_error('title');?></span>
										</div>
									</div>
									<?php if(isset($seriesrow->language) && ($seriesrow->language != 'en')){ ?>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Title in English :</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="etitle" name="etitle" placeholder="Re-Enter Title in English" required value="<?php echo $seriesrow->etitle;?>">
										    <span class="text-danger"><?php echo form_error('etitle');?></span>
										</div>
										<div class="col-sm-1 es">
											<a href="" data-toggle="modal" data-target="#que"><i class="fa fa-question-circle"></i></a>
										</div>
									</div>
									<?php } ?>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Pick a Genre :</label>
										<div class="col-sm-8">
										    <select class="form-control" name="genre" required id="gener">
										    	<option value=""> -- Select Gener -- </option>
										    	<?php if(isset($gener) && ($gener->num_rows()>0)){ foreach($gener->result() as $key) { ?>
										    		<option value="<?php echo $key->id; ?>" <?php if($key->id == $seriesrow->genre){ echo 'selected'; }?>><?php echo $key->gener; ?></option>
										    	<?php } } ?>
										    </select>
									        <span class="text-danger"><?php echo form_error('genre');?></span>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Copyrights :</label>
										<div class="col-sm-8">
										    <select class="form-control" name="copyrights" required="" id="copyrights">
										        <option value=""> -- Select Copyrights -- </option>
										    	<option value="All rights reserved" <?php if($seriesrow->copyrights == 'All rights reserved'){ echo 'selected'; }?>>All rights reserved</option>
										    	<option value="Attribution CC BY" <?php if($seriesrow->copyrights == 'Attribution CC BY'){ echo 'selected'; }?>>Attribution CC BY</option>
										    	<option value="Attribution-ShareAlike CC BY-SA" <?php if($seriesrow->copyrights == 'Attribution-ShareAlike CC BY-SA'){ echo 'selected'; }?>>Attribution-ShareAlike CC BY-SA</option>
										    	<option value="Attribution-NonCommercial CC BY-NC" <?php if($seriesrow->copyrights == 'Attribution-NonCommercial CC BY-NC'){ echo 'selected'; }?>>Attribution-NonCommercial CC BY-NC</option>
										    	<option value="Attribution-NonCommercial-ShareAlike CC BY-NC-SA" <?php if($seriesrow->copyrights == 'Attribution-NonCommercial-ShareAlike CC BY-NC-SA'){ echo 'selected'; }?>>Attribution-NonCommercial-ShareAlike CC BY-NC-SA</option>
										    	<option value="Attribution-NonCommercial-NonDerivs CC BY-NC-ND" <?php if($seriesrow->copyrights == 'Attribution-NonCommercial-NonDerivs CC BY-NC-ND'){ echo 'selected'; }?>>Attribution-NonCommercial-NonDerivs CC BY-NC-ND</option>
										    </select>
										    <span class="text-danger"><?php echo form_error('copyrights');?></span>
										</div>
										<div class="col-sm-1 es">
											<span class="es">
												<a href="javascript:void(0);" class="es" data-toggle="modal" data-target="#copy"><i class="fa fa-question-circle"></i></a>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Key words :</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="tags-input" name="keywords" placeholder="Key words related to your story" value="<?php echo $seriesrow->keywords;?>">
										    <span class="text-danger"><?php echo form_error('keywords');?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- col-md-8 -->
				<?php } } else if(isset($story_info, $episodeinfo) && ($story_info->num_rows() == 1) && ($episodeinfo == 'episodeinfo')){
				    foreach($story_info->result() as $serieserow) { ?>
                    <div class="hidec" style="margin-bottom:20px; width:293px;">
                        <div class="row">
                            <label class="btn-default" style="background:none;width:293px; cursor:pointer;" for="upload-file-selector">
                                <div class="box box-widget widget-user boxshv" style="height: 280px; width:293px;">
                                    <input type="file" name="cover_image" id="upload-file-selector">
                                    <span class="upload-file-selector">
                                        <?php if(isset($serieserow->cover_image) && !empty($serieserow->cover_image)) { ?>
                                            <img src="<?php echo base_url();?>assets/images/<?php echo $serieserow->cover_image; ?>" style="width:293px; height:280px;" class="imageThumb" alt="<?php echo $serieserow->title;?>">
                                        <?php } else{ ?>
                                            <img src="<?php echo base_url();?>assets/images/series-stories.jpg" style="width:293px; height:280px;" class="imageThumb" alt="<?php echo $serieserow->title;?>">
                                        <?php } ?>
                                    </span>
                                </div>
                                <span class="text-danger imageerror"></span>
                            </label>
                        </div>
                    </div>
    				<div class="side-ed">
        			    <div class="box box-widget widget-user boxshv editor-series"><br>
							<div class="row">
								<div class="box-body form-horizontal">
								    <input type="hidden" name="editstorytype" value="episodeinfo">
								    <div class="form-group" id='translControl'>
										<input type="hidden" name="language" id="languageto" value="<?php if(isset($serieserow->language) && !empty($serieserow->language)){ echo $serieserow->language; }else{ echo 'en'; } ?>">
										<input type="hidden" id="checkboxId" checked="checked">
									</div>
									<input type="hidden" name="story_id" value="<?php echo $serieserow->story_id; ?>">
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Title :</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required value="<?php echo $serieserow->title;?>">
											<span class="text-danger"><?php echo form_error('title');?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- col-md-8 -->
				<?php } } ?>
			</div>
		</section>
		<section class="content contentseries1">
		    <div class="" style="text-align:center;">
		        <h3>TO EDIT STORY</h3><br>
		        INSTALL OUR APP<br>
		        <a href=""><img src="<?php echo base_url();?>assets/landing/storycarry app.png" class="img-thumbnaile"></a><br>
		        Or<br>
		        OPEN SITE ON DESKTOP
		    </div>
		</section>
	</div>
</form>
<center><div id="snackbar"></div></center>
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
                if((f.size) > 2000000) {
					alert('Upload File Size Should be lessthan 2MB.');
                    $("#upload-file-selector").val('');
                }else{
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $('.upload-file-selector').html("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<span class=\"remove\">REMOVE </span>" +
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


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
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