<link rel="stylesheet" href="<?php echo base_url();?>assets/css/series_story.css">

<div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="navbarv" style="margin-bottom:0px;  background-color:#23678e;">	
	<div class="navbar-collapse">
		
		<ul class="nav navbar-nav" style="display: inline-block;">
			<?php if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)) { foreach($seriesftitle->result() as $seriesftitl) { if($seriesftitl->type == 'series') { ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 300px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
				    <i class="fa fa-bars"></i> <?php echo $seriesftitles = $seriesftitl->title; ?></a>
				<ul class="dropdown-menu scrollable-menu control-sidebar-menu pull-left" id="action" style="width:280px;height:285px; margin-left: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);border-radius: 10px!important;">
					<h5 style="margin-top: 15px;margin-left: 18px; margin-right: 15px;"><a href="" style="color:#3c8dbc;line-height: 1.4em;"> <?php echo $seriesftitles; ?></a></h5>
					<hr style="margin:0px; border-width: 1px; border-color:#ddd;">
					<?php $i=1; foreach($new_episode as $row) {
					if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series")){ ?>
					<li data-target="#myCarousel" class="li-color">
						<a href="<?php echo base_url('admin-series/'.preg_replace('/\s+/', '-', $row->title)."-".$row->sid.'/'.preg_replace('/\s+/', '-', $row->title)."-".$row->story_id);?>">
							<span class="menu-icon bg-light-blue" style="border-radius:50px;background-color: #000;padding-left: 0px;">
							   <?php echo $i; ?>
							</span>
							<div class="menu-info">
            				    <h4 class="control-sidebar-subheading"><?php echo ucfirst($row->title); ?></h4>
							</div>
							<small>&nbsp;&nbsp;&nbsp;<?php echo date("M j, Y", strtotime($row->date));?> </small>
							<small class="pull-right"><?php if($row->draft == "draft"){ echo ' In drafts'; } ?></small>
							<div class="clearfix"></div>
						</a>
					</li><hr style="border-color: #edebeb; border-width: 1px; margin: 0px;">
					<?php $i++; } } ?>
				</ul>
			</li>
			<?php } } } ?>			
		</ul>
		
		<ul class="nav navbar-nav pull-right " style="display:inline-block;">
			<li class="">
    			<button class="btn btn-warning" type="submit" onclick="submit()" style="background:none; color:#FFF;border-color: #23678e;padding:0px; margin:15px 15px 14px;"> PUBLISH </button> 
		    </li>
		    <li class="dropdown">
				<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="background:none;border-color:#3c8dbc;color:#fff;"> DRAFT</a>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="javascript:void(0);" type="submit" onclick="addtodrafts()">SAVE DRAFT</a>
					</li>
					<li>
						<a href="javascript:void(0);" type="submit" onclick="deletedraft(<?php echo $this->uri->segment(2);?>)">DELETE DRAFT</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>

<div class="tops">
    <!-- Main content -->
	<section class="content contentseries">
	    <div style="display:flex; justify-content:center;">
		    <?php if(isset($res) && ($res->num_rows() > 0)){ foreach($res->result() as $row) { ?>
    			<div class="hidec" style="margin-bottom:20px; width:293px;">
    				<div class="row">
    				<form method="POST" action="#" id="uploaddraftimage">
						<label class="btn-default" style="background:none; width: 320px;" for="upload-file-selector">
						    <input type="hidden" name="story_id" value="<?php echo $row->sid; ?>">
    				        <div class="box box-widget widget-user boxshv" style="height: 290px; width:293px;">
    				            <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
    				                <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
        				            <span class="upload-file-selector">
        				                <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image; ?>" style="width:293px; height:290px;" class="imageThumb" alt="<?php echo $row->title;?>">
        				            </span>
    					        <?php } else{ ?>
    					            <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
        							<span class="upload-file-selector"><center style="padding-top:115px;">
        						    <img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:grab!important;"/> </center></span>
        						    <div class="box-footer" style="padding-top:92px;border:none!important;font-weight: 200;">
        							    <center>
        							        <p class="text-muted" style="margin:0">Uploading image should be smaller than 2MB.
        							    </center>
        						    </div>
    					        <?php } ?>
    					    </div>
    					</label>
    				</form>
    				</div>
    			</div>
    			<!-- /.col -->
    			<div class="side-ed">
        			<div class="box box-widget widget-user boxshv editor-series">
						<div class="box-body" style="padding:0px 10px;">
							<!--<center><h2 style="padding-top:20px;padding-bottom:20px; margin:0"><b><?php echo $row->title; ?></b></h2></center> -->
							<?php if(isset($row->type) && (($row->type == 'story') || $row->type == 'life')) { ?>
							    <center><h2 style="padding-top:20px;padding-bottom:20px; margin:0">
							        <b><?php echo $row->title; ?></b>
						        </h2></center>
						    <?php } ?>
        				</div>
        					<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
        					<div class="pad">
    						    <?php if(isset($row->type) && ($row->type == 'series')) { ?>
    						        <form action="<?php echo base_url();?>welcome/seriesaddstory/<?php echo $row->sid;?>" id="display_result" method="POST" enctype="multipart/form-data">
        						        <?php if(isset($row->title) && empty($row->title)){ ?>
        						        <h2 style="padding-top:20px;padding-bottom:20px; margin:0"><b><input type="text" id="title" name="title" placeholder="Enter Episode Title" class="form-control" style="border:none;text-align:center;font-size: 24px;color:#000" value="<?php echo $row->title;?>"></b></h2>
        						        <?php } else{ ?>
        						        <h2 style="padding-top:20px;padding-bottom:20px; margin:0"><b><input type="text" id="title" class="form-control" style="border:none;text-align:center;font-size: 24px;color:#000" value="<?php echo $row->title;?>"></b></h2>
        						        <?php } ?>
        						        <span class="storytype" storytype="<?php echo $row->type;?>"></span>
                                        <textarea id="story" name="story" class="storywritev" style="resize:none;"><?php echo $row->story;?></textarea>
                                        <iframe id="story_ifr" style="display: none;"></iframe>
                                        <span class="text-danger"><?php echo form_error('story');?><?php echo $this->session->flashdata('msg');?></span>
                                        <input type="hidden" id="story_id" name="story_id" value="<?php echo $row->sid; ?>">
                                        <input type="hidden" id="draft" name="draft" value="<?php echo $row->draft; ?>">
                                        <input type="hidden" name="fromdraft" value="fromdraft"> 
                                        <input type="hidden" id="lastepisode" name="lastepisode" value="">
                                        <input type="hidden" id="imgstorytextcount" value="<?php if(isset($row->cover_image) && !empty($row->cover_image)){ echo 1; }else{ echo 0; } ?>">
        							</form>
    						    <?php } else { ?>
                                <form action="<?php echo base_url();?>addstory/<?php echo $row->sid;?>" id="display_result" method="POST" enctype="multipart/form-data">
                                    <span class="storytype" storytype="<?php echo $row->type;?>"></span>
                                    <textarea id="story" name="story" class="storywritev" style="resize:none;"><?php echo $row->story;?></textarea>
                                    <iframe id="story_ifr" style="display: none;"></iframe>
                                    <span class="text-danger"><?php echo form_error('story');?><?php echo $this->session->flashdata('msg');?></span>
                                    <input type="hidden" id="story_id" name="story_id" value="<?php echo $row->sid; ?>">
                                    <input type="hidden" id="draft" name="draft" value="<?php echo $row->draft; ?>">
                                    <input type="hidden" name="fromdraft" value="fromdraft"> 
                                    <input type="hidden" id="lastepisode" name="lastepisode" value="">
                                    <input type="hidden" name="writing_style" value="<?php echo $row->writing_style; ?>">
                                    <input type="hidden" id="imgstorytextcount" value="<?php if(isset($row->cover_image) && !empty($row->cover_image)){ echo 1; }else{ echo 0; } ?>">
    							</form>
                                <?php } ?>
                                    
    						</div><!-- /.box-body -->
        			</div>
    			</div><!-- col-md-8 -->
            <?php } } ?>
		</div>
	</section><!-- /.content -->
	<section class="content contentseries1">
	    <div class="" style="text-align:center;">
	        <h3>TO EDIT SERIES</h3><br>INSTALL OUR APP<br>
	        <a href=""><img src="<?php echo base_url();?>assets/landing/storycarry app.png" class="img-thumbnaile"></a><br> Or<br>
	        OPEN SITE ON DESKTOP
	    </div>
	</section>
</div>
<!-- ./wrapper -->

<div id="checkepisode" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <center><h4> Are you Sure! Is It Your Last Episode ? </h4>
                <button class="btn btn-primary" style="background:#3c8dbc; border-color:#3c8dbc;" onclick="yesno('no')"> No </button>
                <button class="btn btn-default" onclick="yesno('yes')"> Yes </button>
            </center>
          </div>
        </div>
    </div>
</div>

<!--<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>-->

<script src="<?php echo base_url();?>assets/dist/js/js/tinymce/tinymce.min.js"></script>
<script>
$(document).ready(function() {
    tinymce.init({
        selector: "#story",
        theme: "modern",
        plugins: ["link image"],
        toolbar: "undo redo | bold italic | alignleft aligncenter alignright | link image",
        paste_data_images: true,
        image_advtab: false,
        image_description: false,
        image_dimensions: false,
        menubar: false,
        statusbar : false,
        target_list: false,
        link_title: false,
        height: 360,
        content_style: 'img {max-width: 100%; display: block; margin: 0 auto}',
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
                    url: '<?php echo base_url();?>welcome/uploadstoryimg',
                    data: $data,
                    success: function(response) {
                        callback(response, {
                            alt: ''
                        });
                    },error: function(response) {
                        $('#snackbar').text('Your browser does not support to File API').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    },
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },
        setup :  function(ed) {
            ed.on("keypress keyup", function(e){
               previewContent();
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
        var ids = [ "story", "story_ifr" ];
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
    function submit(){
        var storytype = $('.storytype').attr('storytype');
        $('#draft').val('');
        
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        var imgstorytextcount = $('#imgstorytextcount').val();
        if((story.replace(/\s/g,'')).length > 0){
            if(storytype == 'series'){
                if(($('#title').length == 1) && ($('#title').val())){
                    $('#checkepisode').modal('show');
                }else{
                    $('#snackbar').text('Saved to drafts. Title required to publish. ').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            }else{
                $("#display_result").submit();
            }
        }else{
            $('#snackbar').text('Please enter Story').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }
        /*if((imgstorytextcount == 1) || (storytext.length >= 200)){
            if(storytype == 'series'){
                if(($('#title').length == 1) && ($('#title').val())){
                    $('#checkepisode').modal('show');
                }else{
                    $('#snackbar').text('Story saved to drafts. Title required to publish. ').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            }else{
                $("#display_result").submit();
            }
        }else{
            $('#snackbar').text('Please enter minimum 200 characters to publish').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }*/
    }
    function yesno(value){
        if(value == 'yes'){
            $('#lastepisode').val('yes');
            setTimeout($("#display_result").submit(),2000);
        }else{
            $("#display_result").submit();
        }
    }
</script>

<script>
    $(document).ready( function() {
        $('#title').bind('keypress keyup', function() {
            var sid = $('#story_id').val();
            var story = tinyMCE.activeEditor.getContent();
            var draft = $('#draft').val();
            var title = $('#title').val();
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/addtodrafts",
                data: {'sid':sid, 'story':story, 'draft':draft, 'title':title},
    			success:function(data){
                    console.log('title saved to drafts');
    			}
    		});
        });
    });
    function previewContent(){
        $('#draft').val('draft');
        var sid = $('#story_id').val();
        var story = tinyMCE.activeEditor.getContent();
        var draft = $('#draft').val();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/addtodrafts",
            data: {'sid':sid, 'story':story, 'draft':draft},
			success:function(data){
                console.log('saved to drafts');
			}
		});
    }
    function addtodrafts(){
        var sid = $('#story_id').val();
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        var draft = $('#draft').val();
        var storytype = $('.storytype').attr('storytype');
        if(storytype == 'series'){ 
            if((storytext.length < 1) && (($('#title').length == 1) && ($('#title').val()).length < 1 )){
                $('#snackbar').text('Please enter title or story').addClass('show');
        		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
            }else if((storytext.length < 1) && ($('#title').length != 1)){
                $('#snackbar').text('Please enter story').addClass('show');
        		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
            }else{
                $.ajax({
        			type: "POST",
                    url: "<?php echo base_url();?>welcome/addtodrafts",
                    data: {'sid':sid, 'story':story, 'draft':draft},
        			success:function(data){
                        $('#snackbar').text('Saved to drafts').addClass('show');
            			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        			}
        		});
            }
        }else{
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/addtodrafts",
                data: {'sid':sid, 'story':story, 'draft':draft},
    			success:function(data){
                    $('#snackbar').text('Saved to drafts').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}
    		});
        }
    }
    function deletedraft(sid){
        var x = confirm("Are you sure you want to delete?");
        if (x) {
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/deletedraft",
                data: {'sid':sid, 'draft':'draft'},
    			success:function(data){
    			    if(data == 1){
                        $('#snackbar').text('Draft deleted.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                        location.href = "<?php echo base_url();?>english";
    			    }
    			}
    		});
        }else{
            return false;
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
                    //alert('Upload File Size Should be lessthan 2MB.');
                    $('#snackbar').text('Upload File Size Should be lessthan 2MB.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
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
                        
                        var form = $('form#uploaddraftimage')[0];
                        var $formData = new FormData(form);
                        $formData.append('file', $("#upload-file-selector").get(0).files[0]);
                        $.ajax({
            				url: "<?php echo base_url();?>welcome/uploaddraftimage",
            				type: 'POST',
            				data: $formData,
            				processData: false,
                            contentType: false,
            				success: function (resultdata) {
            				    console.log('success');
            				    $('#imgstorytextcount').val(1);
            				}
                        });
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
        //alert("Your browser doesn't support to File API")
        $('#snackbar').text('Your browser does not support to File API').addClass('show');
    	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    }
}
</script>
<input name="image" type="file" id="upload" class="hidden" onchange="">

