<link rel="stylesheet" href="<?php echo base_url();?>assets/css/newepisode.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/editor.css">
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
    
    <div>
        <form action="<?php echo base_url();?>addepisode/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(3); ?>" method="POST" enctype="multipart/form-data" id="display_result">
		    <div class="editorcontainer">
    		    <div>
                    <div class="imagebox">
    					<label for="upload-file-selector">
    						<input type="file" name="image" id="upload-file-selector" required="" style="display:none;">
    						<span class="upload-file-selector">
                                <img src="<?php echo base_url();?>assets/images/flat.png" style="margin-top:109px;">
                                <p class="browseimg">UPLOAD image SIZE should be smaller than 2MB.</p>
                            </span>
                            <span class="text-danger imageerror"></span>
    					</label>
    				</div>
    			</div>
			
    		    <div class="editordiv seriesaddtodrafts">
    			    <?php foreach($new_episode as $writerow) { if($writerow->sid == $writerow->story_id){ ?>
    					<input type="hidden" id="languageto" value="<?php echo $writerow->language;?>">
    					
    					<input id="title" name="title" class="enter-title-box draftsave" required="" placeholder="ENTER TITLE" value="<?php echo set_value('title');?>">
    					<span class="text-danger"><?php echo form_error('title');?></span>
                        <textarea id="story" name="story" class="storywrite draftsave" required style="resize:none;"><?php echo set_value('story');?></textarea>
                        <iframe id="story_ifr" style="display: none;"></iframe>
    					<input type="hidden" name="series_id" value="<?php echo $story_id; ?>">
    					<input type="hidden" name="genre" value="<?php echo $writerow->genre; ?>">
    					<input type="hidden" name="copyrights" value="<?php echo $writerow->copyrights; ?>">
    					<input type="hidden" name="language" value="<?php echo $writerow->language; ?>">
    					<input type="hidden" name="type" value="series"> <!-- <?php echo $writerow->type; ?> -->
    					<input type="hidden" id="draft" name="draft" value="draft">
    					<input type="hidden" id="sid" name="sid" value="">
    					<input type="hidden" name="lastepisode" id="lastepisode" value="">
    				<?php } } ?>
    			</div>
			</div>
	    </form>
	</div>

<div id="checkepisode" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <center><h4> Are you Sure! Is It Your Last Episode ? </h4>
                <button class="btn btn-warning" style="background:#3c8dbc; border-color:#3c8dbc;" onclick="yesno('no')"> No </button>
                <button class="btn btn-default" onclick="yesno('yes')"> Yes </button>
            </center>
          </div>
        </div>
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


<script>
    $(document).ready(function(){
        $("#upload-file-selector").on("change", function() {
            var sid = $('#sid').val();
            var seriesid = $('input[name="series_id"]').val();
            var name = this.files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                $('.imageerror').html('<center>Invalid Image</center>');
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("upload-file-selector").files[0]);
            var f = document.getElementById("upload-file-selector").files[0];
            var fsize = f.size||f.fileSize;
            if(fsize > 2000000){
                $('.imageerror').html('<center>Upload File Size Should be lessthan 2MB.</center>');
            }else {
                form_data.append("cover_image", document.getElementById('upload-file-selector').files[0]);
                form_data.append('seimage_sid', sid);
                form_data.append('seriesid', seriesid);
                $.ajax({
                    url:"<?php echo base_url();?>welcome/addepisodeimage",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                        //$('.upload-file-selector').html("<label class='text-success'>Image Uploading...</label>");
                    },   
                    success:function(datares){
                        var data = JSON.parse(datares);
                        if(data.picture){
                            $('.upload-file-selector').html('<img src="<?php echo base_url();?>assets/images/'+data.picture+'" class="imageThumb">');
                        }
                        if(data.sid && data.sid != 0){
                            $('#sid').val(data.sid);
                            sidcount++;
                        }
                    }
                });
            }
        });
    });
</script>
<script>
var sidcount = 0;
    function addseriesepisode(seriesid){
        var sid = $('#sid').val();
        if((sidcount == 0) && (sid == '' || sid == ' ' || sid == 'null' || sid == 0)){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>welcome/addseriesepisode/"+seriesid,
                success:function(data){
                    if(data != 0){
                        $('#sid').val(data);
                        sidcount++;
                        previewContent();
                    }
                }
            });
        }
    };
    
    $(document).ready( function() {
        $('.draftsave').bind('keypress keyup', function(e) {
            var sid = $('#sid').val();
            if((sidcount == 0) && (sid == '' || sid == ' ' || sid == 'null' || sid == 0)){
                var seriesid = $('input[name="series_id"]').val();
                addseriesepisode(seriesid); sidcount++;
            } else if(sid && (sidcount > 0) && (sid != '' || sid != 0 ) ) {
                var storytextarea = tinyMCE.activeEditor.getContent();
                var inputdata = $('.seriesaddtodrafts').find('input').serialize()+"&story="+storytextarea;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>welcome/seriesaddtodrafts",
                    data: inputdata,
                    success:function(data){
                        console.log('title textarea ready document save');
                    }
                });
            }
        });
    });
    
    function addtodrafts(){ // save draft btn click
        var storytextarea = tinyMCE.activeEditor.getContent();
        var inputdata = $('.seriesaddtodrafts').find('textarea, input').serialize()+"&story="+storytextarea;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>welcome/seriesaddtodrafts",
            data: inputdata,
            success:function(data){
                $('#snackbar').text('Saved to drafts.').addClass('show');
                setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
            }
        });
    }
    
    function addepisode(){ // click add new episode btn
        var storytextarea = tinyMCE.activeEditor.getContent();
        var storytext = $(storytextarea).text();
        var title = $('#title').val();
        if((storytext.length < 1) || (title.length < 1)){
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
    
    function submit(){ // click on publish btn
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        var title = $('#title').val();
        if(title.length < 1){
            $('#snackbar').text('Enter Title').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else if(storytext.length < 1){
            $('#snackbar').text('Enter story').addClass('show');
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
    
    function previewContent(){
        var sid = $('#sid').val();
        if((sidcount == 0) && (sid == '' || sid == ' ' || sid == 'null' || sid == 0)){
            var seriesid = $('input[name="series_id"]').val();
            addseriesepisode(seriesid); sidcount++;
        } else if(sid && (sidcount > 0) && (sid != '' || sid != 0 ) ) {
            var storytextarea = tinyMCE.activeEditor.getContent();
            var inputdata = $('.seriesaddtodrafts').find('input').serialize()+"&story="+storytextarea;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>welcome/seriesaddtodrafts",
                data: inputdata,
                success:function(data){
                    console.log('editor autosave ');
                }
            });
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