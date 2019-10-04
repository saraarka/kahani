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
					<?php $i=1; $j=0; foreach($new_episode as $row) { if($j==0) {$rowin='active';} 
					if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series")){ ?>
					<li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="li-color" style="margin-left: 4px;">
						<a href="<?php echo base_url('new_series_admin?id='.$row->sid.'&story_id='.$row->story_id);?>">
							<span class="menu-icon bg-light-blue" style="border-radius:50px;background-color: #000;padding-left: 0px;">
							    <!--<input type="checkbox" name="publishsids" value="<?php echo $row->sid;?>"> -->
							   <?php echo $i; ?>
							</span>
							<div class="menu-info">
            				    <h4 class="control-sidebar-subheading"><?php echo ucfirst($row->title); ?></h4>
							</div>
							<small>&nbsp;&nbsp;&nbsp;<?php echo date("M j, Y", strtotime($row->date));?> </small>
							<small class="pull-right"><?php if($row->draft == "draft"){ echo ' In drafts'; } ?></small>
						</a>
					</li><hr style="border-color: #edebeb; border-width: 1px; margin: 0px;">
					<?php $i++; } } ?>
				</ul>
			</li>
			<!--<input type="hidden" class="checkseriesornot" checkseries="1"> -->
			<?php } } } ?>			
		</ul>
		
		<ul class="nav navbar-nav pull-right " style="display:flex;">
			<li class="">
    			<button class="btn btn-warning" type="submit" onclick="submit()" style="background:none; color:#FFF;border-color: #23678e;padding:0px; margin:15px;"> PUBLISH </button> 
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
    				<div class="box box-widget widget-user boxshv" style="padding:0 25px 25px;">
    					<div class="row">
    					    <div class="col-md-12">
        						<div class="box-body">
        							<center><h1 style="margin-top:10px;margin-bottom:0px;"><b><?php echo $row->title; ?></b></h1></center>
        							<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
        						</div>
    						</div>
        					<div class="col-md-12">
        						<div class="box-body pad" style="margin-top:0px;">
        						    <?php if(isset($row->type) && ($row->type == 'series')) { ?>
        						        <form action="<?php echo base_url();?>index.php/welcome/seriesaddstory/<?php echo $row->sid;?>" id="display_result" method="POST" enctype="multipart/form-data">
        						        <!--<input type="hidden" class="checkseriesornot" checkseries="1">
        						        <input type="hidden" name="storysids" id="storysids" value=""> -->
        						    <?php } else { ?>
                                    <form action="<?php echo base_url();?>addstory/<?php echo $row->sid;?>" id="display_result" method="POST" enctype="multipart/form-data">
                                    <?php } ?>
                                        <span class="storytype" storytype="<?php echo $row->type;?>"></span>
                                        <textarea id="story" name="story" rows="15" cols="95" class="form-control" style="resize:none;" ><?php echo $row->story;?></textarea>
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
    				</div>
    			</div><!-- col-md-8 -->
            <?php } } ?>
		</div>
	</section><!-- /.content -->
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

<!--<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>-->

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
        if(storytype == 'series'){
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
        tinyMCE.activeEditor.on('keypress', function(ed, e) {
            //$('#story').bind('keyup', function(e) {
            $('#draft').val('draft');
            var sid = $('#story_id').val();
            //var story = $('textarea#story').val();
            var story = tinyMCE.activeEditor.getContent();
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
        //var story = $('textarea#story').val();
        var story = tinyMCE.activeEditor.getContent();
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

<!--<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/js/js/tinymce/skins/lightgray/skin.min.css">
<script src="<?php echo base_url();?>assets/dist/js/js/tinymce/tinymce.js"></script>
<script>
    tinymce.init({
        selector: '#story',
        plugins: ["image"],
        menubar: false,
        statusbar : false,
        image_description: false,
        image_dimensions: false,
	    height: 300,
        toolbar: "bold italic | alignleft aligncenter alignright | link image",
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
</script>-->
<style>
    @media screen and (max-width:750px){
        .box.box-widget.widget-user.boxshv.boxshv1 img{
            width:100%;
        }
    }
</style>
<!--
<script type="text/javascript" src="<?php echo base_url();?>assets/tinymcetextarea/tinymce.min.js"></script>
<script>
    tinymce.init({
	/* replace textarea having class .tinymce with tinymce editor */
	selector: "textarea#story",
	
	/* theme of the editor */
	theme: "modern",
	skin: "lightgray",
	
	/* width and height of the editor */
	width: "100%",
	height: 300,
	
	/* display statusbar */
	statubar: true,
	
	/* plugin */
	plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste textcolor"
	],

	/* toolbar */
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
	
	/* style */
	style_formats: [
		{title: "Headers", items: [
			{title: "Header 1", format: "h1"},
			{title: "Header 2", format: "h2"},
			{title: "Header 3", format: "h3"},
			{title: "Header 4", format: "h4"},
			{title: "Header 5", format: "h5"},
			{title: "Header 6", format: "h6"}
		]},
		{title: "Inline", items: [
			{title: "Bold", icon: "bold", format: "bold"},
			{title: "Italic", icon: "italic", format: "italic"},
			{title: "Underline", icon: "underline", format: "underline"},
			{title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
			{title: "Superscript", icon: "superscript", format: "superscript"},
			{title: "Subscript", icon: "subscript", format: "subscript"},
			{title: "Code", icon: "code", format: "code"}
		]},
		{title: "Blocks", items: [
			{title: "Paragraph", format: "p"},
			{title: "Blockquote", format: "blockquote"},
			{title: "Div", format: "div"},
			{title: "Pre", format: "pre"}
		]},
		{title: "Alignment", items: [
			{title: "Left", icon: "alignleft", format: "alignleft"},
			{title: "Center", icon: "aligncenter", format: "aligncenter"},
			{title: "Right", icon: "alignright", format: "alignright"},
			{title: "Justify", icon: "alignjustify", format: "alignjustify"}
		]}
	]
});
</script> -->
<input name="image" type="file" id="upload" class="hidden" onchange="">
<!--<script src="https://pratilipi.s.llnwi.net/third-party/tinymce-4.5.1/tinymce.min.js"></script>-->
<script src="<?php echo base_url();?>assets/dist/js/js/tinymce/tinymce.min.js"></script>
<script>
$(document).ready(function() {
  tinymce.init({
    selector: "#story",
    theme: "modern",
    plugins: ["link image"],
    toolbar: "bold italic | alignleft aligncenter alignright | image",
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
    }
  });
});
</script>
