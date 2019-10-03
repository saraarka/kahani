<link rel="stylesheet" href="<?php echo base_url();?>assets/css/series_story.css">

<div class="navbar navbar-inverse navbar-static-top" role="navigation" id="navbarv" style="margin-bottom:0px;  background-color:#23678e;">	
	<div class="navbar-collapse pd-4">
	    
	    <ul class="nav navbar-nav" style="display: inline-block;">
			<?php if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)) { foreach($seriesftitle->result() as $seriesftitl) { if($seriesftitl->type == 'series') { ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;background-color: #23678e;word-wrap:break-word;">
				    <i class="fa fa-bars"></i> <?php echo $seriesftitles = $seriesftitl->title; ?></a>
				<ul class="dropdown-menu scrollable-menu control-sidebar-menu pull-left" id="action" style="width:280px;height:285px;">
					<h5 style="margin-top: 15px;margin-left: 30px;"> <?php echo $seriesftitles; ?></h5>
					<hr style="margin-top: 5px;margin-bottom: 5px; border-style: inset; border-width: 1px;">
					<?php $i=1; $j=0; foreach($new_episode as $row) { if($j==0) {$rowin='active';} 
					if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series")){ ?>
					<li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="li-color" style="margin-left: 4px;">
						<a href="<?php echo base_url('index.php/welcome/new_series_admin?id='.$row->sid.'&story_id='.$row->story_id);?>">
							<span class="menu-icon bg-light-blue" style="border-radius: 50px; background-color: #000;">
							   <?php echo $i; ?>
							</span>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading" style="overflow: hidden;white-space:pre;text-overflow: ellipsis;-webkit-appearance: none;"><?php echo ucfirst($row->title); ?></h4>
							</div>
							<small>&nbsp;&nbsp;&nbsp;<?php echo date("M j, Y", strtotime($row->date));?> </small>
						</a>
					</li><hr style="margin:0px;">
					<?php $i++; } } ?>
				</ul>
			</li>
			<input type="hidden" class="checkseriesornot" checkseries="1">
			<?php } } } ?>			
		</ul>
		
		<ul class="nav navbar-nav pull-right fv pt-5" style="display:flex;">
			<li class="mg-5">
    			<button class="btn btn-warning" type="submit" onclick="submit()" style="background-color:#23678e; color:#FFF;font:bold;border-color: #23678e;padding-top:5px;"> PUBLISH </button> 
		    </li>
		    <li class="dropdown">
				<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;border-color:#3c8dbc;color:#fff; padding-top:5px;"> DRAFT</a>
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

<!--<div class="navbar navbar-inverse navbar-static-top">	
	<div class="navbar-collapse">		
		<ul class="nav navbar-nav" style="display: inline-block;">
			<?php if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)) { foreach($seriesftitle->result() as $seriesftitl) { if($seriesftitl->type == 'series') { ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;background-color: #23678e;word-wrap:break-word;">
				    <i class="fa fa-bars"></i> <?php echo $seriesftitles = $seriesftitl->title; ?></a>
				<ul class="dropdown-menu scrollable-menu control-sidebar-menu pull-left" id="action" style="width:280px;height:285px;">
					<h5 style="margin-top: 15px;margin-left: 30px;"> <?php echo $seriesftitles; ?></h5>
					<hr style="margin-top: 5px;margin-bottom: 5px; border-style: inset; border-width: 1px;">
					<?php $i=1; $j=0; foreach($new_episode as $row) { if($j==0) {$rowin='active';} 
					if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series")){ ?>
					<li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="li-color" style="margin-left: 4px;">
						<a href="<?php echo base_url('index.php/welcome/new_series_admin?id='.$row->sid.'&story_id='.$row->story_id);?>">
							<span class="menu-icon bg-light-blue" style="border-radius: 50px; background-color: #000;">
							   <?php echo $i; ?>
							</span>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading" style="overflow: hidden;white-space:pre;text-overflow: ellipsis;-webkit-appearance: none;"><?php echo ucfirst($row->title); ?></h4>
							</div>
							<small>&nbsp;&nbsp;&nbsp;<?php echo date("M j, Y", strtotime($row->date));?> </small>
						</a>
					</li><hr style="margin:0px;">
					<?php $i++; } } ?>
				</ul>
			</li>
			<input type="hidden" class="checkseriesornot" checkseries="1">
			<?php } } } ?>			
		</ul>		
		<ul class="nav navbar-nav pull-right fv">
			<li><a href="javascript:void(0);" type="submit" onclick="submit()" style="color:#FFF; border: none;background-color:none;"> PUBLISH </a></li>
			<li class="dropdown">
				<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;border-color:#3c8dbc;color:#fff;"> Draft</a>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="javascript:void(0);" type="submit" onclick="addtodrafts()">Save Draft</a>
					</li>
					<li>
						<a href="javascript:void(0);" type="submit" onclick="deletedraft(<?php echo $this->uri->segment(3);?>)">Delete Draft</a>
					</li>
				</ul>
			</li>
		</ul>		
	</div>
</div>-->
<div class="tops">
    <!-- Main content -->
	<section class="content">
	    <div style="display:flex; justify-content:center;">
		    <?php if(isset($res) && ($res->num_rows() > 0)){ foreach($res->result() as $row) { ?>
    			<div class="" style="margin-bottom:20px; width:293px;">
    				<div class="row">
    				<form method="POST" action="#" id="uploaddraftimage">
						<label class="btn-default" style="background:none; width: 320px;" for="upload-file-selector">
						    <input type="hidden" name="story_id" value="<?php echo $row->sid; ?>">
    				        <div class="box box-widget widget-user boxshv" style="height: 290px; width:293px;">
    				            <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
    				                <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
        				            <span class="upload-file-selector">
        				                <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image; ?>" style="width:293px; height:290px;" class="imageThumb">
        				            </span>
    					        <?php } else{ ?>
    					            <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
        							<span class="upload-file-selector"><center style="padding-top:115px;">
        						    <img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:grab!important;"/> </center></span>
        						    <div class="box-footer" style="padding-top:92px;border:none!important;font-weight: 200;">
        							    <center>
        							        <p class="text-muted" style="margin:0">Must be in JPG or PNG format, smaller than 2MB. 
        							    </center>
        						    </div>
    					        <?php } ?>
    					    </div>
    					</label>
    				</form>
    				</div>
    			</div>
    			<!-- /.col -->
    			<div class="" style="width:800px;">
    				<div class="box box-widget widget-user boxshv" style="padding:25px;">
    					<div class="row">
    						<div class="box-body">
    							<center><h2><b><?php echo $row->title; ?></b></h2></center></h4></center>
    							<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
    						</div>
    						<div class="box-body pad">
                                <form action="<?php echo base_url();?>addstory/<?php echo $row->sid;?>" id="display_result" method="POST" enctype="multipart/form-data">
                                    <textarea id="story" name="story" rows="15" cols="113" class="form-control" style="resize:none;" ><?php echo $row->story;?></textarea>
                                    <iframe id="story_ifr" style="display: none;"></iframe>
                                    <span class="text-danger"><?php echo form_error('story');?><?php echo $this->session->flashdata('msg');?></span>
                                    <input type="hidden" id="story_id" name="story_id" value="<?php echo $row->sid; ?>">
                                    <input type="hidden" id="draft" name="draft" value="<?php echo $row->draft; ?>">
                                    <input type="hidden" name="fromdraft" value="fromdraft"> 
                                    <input type="hidden" id="lastepisode" name="lastepisode" value="">
    							</form>
    						</div><!-- /.box-body -->
    					</div>
    				</div>
    			</div><!-- col-md-8 -->
            <?php } } ?>
		</div>
	</section><!-- /.content -->
</div>
<!-- ./wrapper -->

<div id="checkepisode" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <center><h4> Are you Sure! Is It Your Last Episode ? </h4>
                <button class="btn btn-warning" onclick="yesno('no')"> No </button>
                <button class="btn btn-default" onclick="yesno('yes')"> Yes </button>
            </center>
          </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>

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
        var checkseries = $('.checkseriesornot').attr('checkseries');
        if(checkseries == 1){
            $('#checkepisode').modal('show');
        }else{
            $("#display_result").submit();
        }
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
    $("input:reset").click(function() {
       $('#story').val('');
    });
</script>
<script>
    $(document).ready( function() {
        $('#story').bind('keyup', function(e) {
            $('#draft').val('draft');
            var sid = $('#story_id').val();
            var story = $('textarea#story').val();
            var draft = $('#draft').val();
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>index.php/welcome/addtodrafts",
                data: {'sid':sid, 'story':story, 'draft':draft},
    			success:function(data){
                    console.log('saved to Draft');
    			}
    		});
        });
    });
    function addtodrafts(){
        var sid = $('#story_id').val();
        var story = $('textarea#story').val();
        var draft = $('#draft').val();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/addtodrafts",
            data: {'sid':sid, 'story':story, 'draft':draft},
			success:function(data){
                //alert('saved to Draft');
                $('#snackbar').text('saved to Draft').addClass('show');
    			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}
		});
    }
    function deletedraft(sid){
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/deletedraft",
            data: {'sid':sid, 'draft':'draft'},
			success:function(data){
			    if(data == 1){
                    console.log('Deleted.');
                    $('#snackbar').text('Deleted').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    location.href = "<?php echo base_url();?>home";
			    }
			}
		});
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
            				url: "<?php echo base_url();?>index.php/welcome/uploaddraftimage",
            				type: 'POST',
            				data: $formData,
            				processData: false,
                            contentType: false,
            				success: function (resultdata) {
            				    console.log('success');
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

<!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
    selector: '#story',
    height: 500,
    theme: 'modern',
    plugins: [
      'advlist autolink lists link image hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars  ',
      'insertdatetime nonbreaking save contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools'
    ],
    toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    image_advtab: true
});
</script> -->
<!--
<script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "#story",
    plugins: ["image"],
    menubar: false,
    toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    image_advtab: true
});
</script>
<script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
-->
<style>
.mce-notification.mce-has-close {
    padding-right: 15px;
    display: none;
}
.mce-statusbar{
    display: none !important;
}
</style>
<script src="https://cloud.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#story',
        plugins: ["image, lists"],
        menubar: false,
        toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        images_upload_url: 'upload.php', // without images_upload_url set, Upload tab won't show up
    
        images_upload_handler: function (blobInfo, success, failure) { // override default upload handler to simulate successful upload
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '<?php echo base_url();?>welcome/uploadstoryimg');
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
    });
</script>