<link rel="stylesheet" href="<?php echo base_url();?>assets/css/series_preview.css">

<div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="" style="margin-bottom:0px;  background-color:#23678e;">	
	<div class="navbar-collapse">
		<ul class="nav navbar-nav pull-right">
			<li>
    			<button class="btn btn-warning" type="submit" style="background:none; color:#FFF;border-color: transparent;margin:15px; padding:0;" onclick="addepisode()"> ADD EPISODE </button> 
		    </li>

		    <li>
    			<button class="btn btn-warning" type="submit" onclick="submit()" style="background:none; color:#FFF;border-color: transparent;margin:15px; padding:0;"> PUBLISH </button> 
		    </li>
		    <li>
    			<button class="btn btn-warning" type="submit" onclick="<?php echo base_url().$this->uri->segment(1);?>" style="background-color:transparent; color:#FFF;font:bold;border-color: #23678e;margin:15px; padding:0;"> CANCEL </button>
		    </li>
	    </ul>
	</div>
</div>

<div class="tops">
	<section class="content contentseries">
	   <?php if(isset($res) && ($res->num_rows() > 0)){ foreach($res->result() as $row) { ?>
	   <form action="<?php echo base_url().$this->uri->segment(1);?>/addstory_intro/<?php echo $row->sid;?>" id="display_result" method="POST">
        	<div style="display:flex; justify-content:center;">
	            	<div class="hidec" style="margin-bottom:20px; width:293px;">
	            	    <div class="row">
        			    <div class="box box-widget widget-user boxshv" style="height: 280px; width:293px;">
    					    <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
    						    <img src="<?php echo base_url(); ?>assets/images/<?php echo $row->cover_image; ?>" style="height: 280px; width:293px; box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);">
    					    <?php }else{ ?>
    					        <img src="<?php echo base_url(); ?>assets/default/series-stories.jpg" style="height: 280px; width:293px; box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);">
    					    <?php } ?>
    					</div>
    					</div>
        			</div>
        			<div class="side-ed">
    				<div class="box box-widget widget-user boxshv  editor-series">
            				<div class="row">
            				    <div class="col-md-12">
            						<div class="box-body" style="padding-top:0px; ">
            							 <center><h1 style="margin-top:10px;margin-bottom:0px;line-height: initial; -webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;overflow: hidden;">
            							    <b><?php echo $row->title; ?></b>
            							 </h1></center>
            							<center><h4 class="text-muted" style="margin-top:15px;margin-bottom:0px;">INTRODUCE YOUR NEW SERIES TO THE AUDIENCE BY WRITING A PREFACE</h4></center>
            							<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
            						</div>
            					</div>
            					<div class="col-md-12">
            						<div class="box-body pad" style="margin-top:0px;padding-top: 0; height:363px;">
            							<span class="text-danger storyerror"></span>
                                        <textarea id="story" class="storywritev" name="story" required="" style="resize:none;"><?php echo $row->story;?></textarea>
                                        <iframe id="story_ifr" style="display: none;"></iframe>
                                        <span class="text-danger"><?php echo form_error('story');?></span>
                                        <input type="hidden" name="story_id" value="<?php echo $row->sid; ?>"> 
                                        <input type="hidden" name="addepisode" value="" id="addepisode">
                                        <input type="hidden" name="draft" value="" id="draft">
                                        <input type="hidden" name="pay_story" value="<?php echo $row->pay_story; ?>">
                                        <input type="hidden" name="title" value="<?php echo $row->title; ?>">
            						</div> <!-- /.box-body -->
            					</div>
            				</div>
            			</div>
        			</div><!-- col-md-8 -->
	        </div>
        </form>
    <?php } } ?>
	</section> <!-- /.content -->
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
        var ids = [ "story","story_ifr" ];
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
<!--<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script> -->

<script>
    function previewContent(){
        var story = tinyMCE.activeEditor.getContent();
        var sid = $('input[name="story_id"]').val();
        var pay_story = $('input[name="pay_story"]').val();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url().$this->uri->segment(1);?>/prefaceautosave",
            data: {'story':story, 'sid':sid, 'pay_story':pay_story},
			success:function(data){
			    console.log(data);
			}
		});
    }
    function submit(){
        $('#addepisode').val(' ');
        $('#draft').val(' ');
        //var story = $('textarea[name="story"]').val();
        var story = tinyMCE.activeEditor.getContent();
        if(story == '' || story == ' ' || story == 'null'){
            //$('.storyerror').html('<center> Please Enter Preface.</center>');
            $('#snackbar').text('Please Enter Preface.').addClass('show');
    		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $('#draft').val('');
            $("#display_result").submit();
        }
    }
    
    function addepisode(){
        $('#addepisode').val('yes');
        $('#draft').val('draft');
        //var story = $('textarea[name="story"]').val();
        var story = tinyMCE.activeEditor.getContent();
        var textstory = $(story).text();
        var storywords = textstory.replace(/\s+/g, " ");
        var storywordcount = storywords.split(" ").length;
        if(story == '' || story == ' ' || story == 'null' || storywordcount <= 2){
            $('#snackbar').text('Please Enter Preface first.').addClass('show');
    		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $('#addepisode').val('yes');
            $('#draft').val('draft');
            $("#display_result").submit();
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
                            $('.upload-file-selector').html('<center style="padding-top:135px;"><i class="fa fa-upload"></i> Add Image </center>');
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
                    url: '<?php echo base_url().$this->uri->segment(1);?>/uploadstoryimg',
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
