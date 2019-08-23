<link rel="stylesheet" href="<?php echo base_url();?>assets/css/new_series_admin.css">
<style>
    @media screen and (max-width:750px){
        .box.box-widget.widget-user.boxshv.boxshv1 img{
            width:100%;
        }
    }
</style>


<div id="">
    <div class="navbar navbar-inverse navbar-static-top1 contentseries" role="navigation" style="margin-bottom:0px;background-color:#23678e;">		
    	<div class="navbar-collapse">
    		<ul class="nav navbar-nav" style="display: inline-block;">
    		    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 300px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                        <i class="fa fa-bars"></i> 
                        <?php $seriesftitles = ''; if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)){
    		                foreach($seriesftitle->result() as $seriesftitl){ echo $seriesftitles = $seriesftitl->title;} 
    		            }else{ echo 'EPISODES'; } ?>
                    </a>
                    <ul class="dropdown-menu scrollable-menu control-sidebar-menu pull-left" id="action" style="width:280px;height:285px; margin-left: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);border-radius: 10px!important;">
                        <h5 style="margin-top: 15px;margin-left: 18px; margin-right: 15px;">
                            <a href="<?php echo base_url();?>admin-series/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(3);?>" style="color:#3c8dbc;line-height: 1.4em;">
                                <?php echo $seriesftitles; ?></a>
                        </h5>
                        <hr style="margin:0px; border-width: 1px; border-color:#ddd;">
                        <!--<li class="divider"></li>-->
                        <?php $i=1; if(isset($new_episode) && !empty($new_episode)){    foreach($new_episode as $row) {
    				        if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series")){ ?>
							<li data-target="#myCarousel" class="li-color">
								<?php if($row->draft == "draft"){ ?>
                                <a href="<?php echo base_url('series_story/'.$row->sid);?>">
                                    <span class="menu-icon bg-light-blue" style="border-radius:50px;background-color: #000;padding-left: 0px;">
									   <?php echo $i; ?> </span>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading"><?php echo ucfirst($row->title); ?></h4>
									</div>
									<small>&nbsp;&nbsp;&nbsp;<?php echo date("M j, Y", strtotime($row->date));?></small>
								    <small class="pull-right"><?php if($row->draft == "draft"){ echo 'In Drafts'; } ?></small>
								</a>
                                <?php }else{ ?>
                                <a href="<?php echo base_url('admin-series/'.preg_replace('/\s+/', '-', $row->title).'-'.$row->sid.'/'.preg_replace('/\s+/', '-', $row->title).'-'.$row->story_id);?>">
                                    <span class="menu-icon bg-light-blue" style="border-radius:50px;background-color: #000;padding-left: 0px;">
									   <?php echo $i; ?> </span>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading"><?php echo ucfirst($row->title); ?></h4>
									</div>
									<small>&nbsp;&nbsp;&nbsp;<?php echo date("M j, Y", strtotime($row->date));?></small>
								    <small class="pull-right"><?php if($row->draft == "draft"){ echo 'In Drafts'; } ?></small>
								</a>
                                <?php } ?>
							</li>
							<hr style="border-color: #edebeb;; border-width: 1px; margin: 0px;">
                        <?php $i++; } } } ?>
                    </ul>
                </li>
            </ul>
    		<ul class="nav navbar-nav pull-right">
    			<li class="">
        			<button name="episode" class="btn btn-warning" onclick="addepisode()" style="background:none; color:#FFF;border-color: #3c8dbc;margin:8px 6px; padding:6px;"> ADD EPISODE </button> 
			    </li>
			    <li class="">
        			<button class="btn btn-warning" type="submit" onclick="submit()" style="background:none; color:#FFF;border-color: #23678e;margin:8px 6px; padding:6px;"> PUBLISH </button> 
			    </li>
			    <li class="">
        			<button class="btn btn-warning" type="submit" onclick="addtodrafts()" style="background:none; color:#FFF;border-color: #23678e;margin:8px 6px; padding:6px;"> SAVE TO DRAFT </button> 
			    </li>
    		</ul>
    	</div>
    </div>
    
    <div class="tops1" style="padding-bottom:0">
        <form action="<?php echo base_url();?>addepisode/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(3); ?>" method="POST" enctype="multipart/form-data" id="display_result">
    		<section class="content contentseries">
    			<div style="display:flex; flex-wrap:wrap; justify-content:center;">
    				<div class="" style="margin-bottom:20px; width:293px;">
    					<div class="row">
    						<label class="btn-default" style="background:none;width:293px;" for="upload-file-selector">
    							<div class="box box-widget widget-user boxshv" style="height: 280px; width:293px;">
    								<input type="file" name="image" id="upload-file-selector" required="" style="display:none;">
    								<span class="upload-file-selector">
    								    <center style="padding-top:115px;">
    								    <img src="<?php echo base_url() ?>assets/images/flat.png" style="cursor:grab!important;"/>
    								    </center>
    								</span>
    								<div class="box-footer" style="padding-top:85px;border:none!important;font-weight: 200;">
    									<center>
    										<p class="text-muted" style="margin:0">Uploading image should be smaller than 2MB.
    									</center>
    								</div>
    							</div>
    							<span class="text-danger imageerror"></span>
    						</label>
    					</div>
    				</div>
    				<div class="" style="width:800px;">
						<div class="box box-widget widget-user boxshv seriesaddtodrafts" style="padding:0 25px 25px; height:480px;">
						    <?php foreach($new_episode as $row) { if($row->sid === $row->story_id){ ?>
    						<div class="row">
    					        <div class="col-md-12">
        							<div class="box-body">
        								<center>
        									<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
        									<h3 style="margin-top:10px;margin-bottom:10px;line-height: initial;"><b>
        									    <input type="text" id="title" name="title" onclick="addseriesepisode(<?php echo $row->sid;?>)" placeholder="Enter Episode Title" required="" class="form-control draftsave" style="border:none;text-align:center;font-size: 24px;padding:0px;color:#000" value="<?php echo set_value('title');?>">
        									</b></h3>
        									<span class="text-danger"><?php echo form_error('title');?></span>
        								</center>
        							</div>	
    							</div>
    							<div class="col-md-12">
        							<div class="box-body pad" style="margin-top:0px;padding-top: 0; height:363px;">
        								<textarea name="story" rows="15" id="story" onclick="addseriesepisode(<?php echo $row->sid;?>)"  class="draftsave" placeholder="Enter Series Story Here...." required style="resize:none;"><?php echo set_value('story');?></textarea>
        								<iframe id="story_ifr" style="display: none;"></iframe>
        								<input type="hidden" name="series_id" value="<?php echo $story_id; ?>">
        								<input type="hidden" name="genre" value="<?php echo $row->genre; ?>">
        								<input type="hidden" name="copyrights" value="<?php echo $row->copyrights; ?>">
        								<input type="hidden" name="language" value="<?php echo $row->language; ?>">
        								<input type="hidden" name="type" value="<?php echo $row->type; ?>">
        								<input type="hidden" id="draft" name="draft" value="draft">
        								<input type="hidden" id="sid" name="sid" value="">
        								<input type="hidden" name="lastepisode" id="lastepisode" value="">
        							</div>
    							</div>
    						</div>
							<?php } } ?>
						</div>
					</div>
    			</div>
    		</section>
    	</form>
    	<section class="content contentseries1">
    	    <div class="" style="text-align:center;">
    	        <h3>TO EDIT SERIES</h3><br>
    	        INSTALL OUR APP<br>
    	        <a href=""><img src="<?php echo base_url();?>assets/landing/storycarry app.png" class="img-thumbnaile"></a><br>
    	        Or<br>
    	        OPEN SITE ON DESKTOP
    	    </div>
    	</section>
	</div>
</div>


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


<div id="checkepisode" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <center><h4> Are you Sure! Is It Your Last Episode ? </h4>
                <button class="btn btn-warning" style="background:#3c8dbc; border-colro:#3c8dbc;" onclick="yesno('no')"> No </button>
                <button class="btn btn-default" onclick="yesno('yes')"> Yes </button>
            </center>
          </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    upLoader();
});
function upLoader(){
    if (window.File && window.FileList && window.FileReader) {
        $("#upload-file-selector").on("change", function(e) {
           var sid = $('#sid').val();
           var storyid = $('#storyid').val();
           var data = new FormData();
            data.append('image', this.files[0]); 
            data.append('seimage_sid', sid); 
            $.ajax({
                method: 'POST',
                address: '<?php echo base_url();?>welcome/addepisodeimage',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    //console.log(response);
                    if((response != 0) && ($.isNumeric(response))){
                        $('#sid').val(response);
                    }
                },
            });
            var files = e.target.files,
            filesLength = files.length;
	        for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                if((f.size) > 2000000) {
                    $('.imageerror').html('<center>Upload File Size Should be lessthan 2MB.</center>');
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
<script>
    function addseriesepisode(seriesid){
        var sid = $('#sid').val();
        if(sid == '' || sid == ' ' || sid == 'null'){
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/addseriesepisode/"+seriesid,
    			success:function(data){
    			    if(data != 0){
    			        $('#sid').val(data);
    			        $("#story").prop('onclick', null);  $("textarea#story").removeAttr('onclick');
    			        $("#title").prop('onclick', null);  $("#title").removeAttr('onclick');
    			    }
    			}
    		});
        }
    };

    $(document).ready( function() {
        $('.draftsave').bind('keypress', function(e) {
            var storytextarea = tinyMCE.activeEditor.getContent();
            var inputdata = $('.seriesaddtodrafts').find('input').serialize()+"&story="+storytextarea;
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/seriesaddtodrafts",
                data: inputdata,
    			success:function(data){
    			    //console.log(data);
    			}
    		})
        });
    });
    
    function previewContent(){
        var storytextarea = tinyMCE.activeEditor.getContent();
        var inputdata = $('.seriesaddtodrafts').find('input').serialize()+"&story="+storytextarea;
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/seriesaddtodrafts",
            data: inputdata,
			success:function(data){
			    //console.log(data);
			}
		});
    }
    function addtodrafts(){
        var storytextarea = tinyMCE.activeEditor.getContent();
        var inputdata = $('.seriesaddtodrafts').find('textarea, input').serialize()+"&story="+storytextarea;
        $.ajax({
    		type: "POST",
            url: "<?php echo base_url();?>welcome/seriesaddtodrafts",
            data: inputdata,
    		success:function(data){
    		    //console.log(data);
    		    $('#snackbar').text('Story Successfully Saved to Drafts').addClass('show');
        	    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                //location.reload();
    		}
    	});
    }
 
    function addepisode(){
        var storytextarea = tinyMCE.activeEditor.getContent();
        var title = $('#title').val();
        if((storytextarea.length < 10) || (title.length < 1)){
            $('#snackbar').text('Please enter Title & Story for Current Episode').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            var inputdata = $('.seriesaddtodrafts').find('input').serialize()+"&story="+storytextarea;
            $.ajax({
        		type: "POST",
                url: "<?php echo base_url();?>welcome/seriesaddtodrafts",
                data: inputdata,
        		success:function(data){
        		    location.reload();
        		}
        	});
        }
    }
    function submit(){
        var story = tinyMCE.activeEditor.getContent();
        if(story.length < 200){
            $('#snackbar').text('Please enter minimum 200 characters to publish').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $('#checkepisode').modal('show');
        }
    }
    function yesno(value){
        if(value == 'yes'){
            $('#lastepisode').val('yes');
            $('#draft').val(' '); 
            setTimeout($("#display_result").submit(),2000);
        }else{
            $("#display_result").submit();
        }
    }
</script>


<input name="image" type="file" id="upload" class="hidden" onchange="">
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
