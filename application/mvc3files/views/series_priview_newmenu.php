<link rel="stylesheet" href="<?php echo base_url();?>assets/css/series_preview.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/editor.css">

        <div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="" style="margin-bottom:0px;  background-color:#23678e;">	
            <div class="navbar-collapse">
                <ul class="nav navbar-nav pull-right">
                    <li>
                    	<button class="btn btn-warning" type="submit" onclick="addepisode()" style="background:none; color:#FFF;border-color: transparent;margin:15px; padding:0;"> ADD EPISODE </button> 
                    </li>
                    <li>
                    	<button class="btn btn-warning" type="submit" onclick="submit()" style="background:none; color:#FFF;border-color: transparent;margin:15px; padding:0;"> PUBLISH </button> 
                    </li>
                    <li>
                    	<button class="btn btn-warning" type="submit" onclick="<?php echo base_url();?>english" style="background-color:transparent; color:#FFF;font:bold;border-color: #23678e;margin:15px; padding:0;"> CANCEL </button>
                    </li>
                </ul>
            </div>
        </div>
        
        <div>
            <?php if(isset($res) && ($res->num_rows() > 0)){ foreach($res->result() as $row) { ?>
            <form action="<?php echo base_url();?>welcome/addstory_intro/<?php echo $row->sid;?>" id="display_result" method="POST">
                <div class="editorcontainer">
                    <div>
                        <div class="imagebox">
                            <label for="upload-file-selector">
                                <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
                                    <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
                                    <span class="upload-file-selector">
                                        <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image;?>" alt="<?php echo $row->title;?>" class="imageThumb">
                                        <span class="pip" style="width:293px;"><span class="remove"> Update </span></span>
                                    </span>
                                <?php } else { ?>
                                    <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
                                    <span class="upload-file-selector">
                                        <img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $row->title;?>" class="imageThumb">
                                        <span class="pip" style="width:293px;"><span class="remove"> Update </span></span>
                                    </span>
                                <?php } ?>
                            </label>
                        </div>
                    </div>
                        
                    <div class="editordiv">
                        <div class="enter-title-box"><?php echo $row->title; ?></div>
                        <center><h4 style="color: #777;">INTRODUCE YOUR NEW SERIES TO THE AUDIENCE BY WRITING A PREFACE</h4></center>
                        <input type="hidden" id="languageto" value="<?php echo $row->language;?>">
                        <span class="text-danger storyerror"></span>
                        <textarea class="storywrite" id="story" name="story" style="resize:none;"><?php echo $row->story;?></textarea>
                        <iframe id="story_ifr" style="display: none;"></iframe>
                        <span class="text-danger"><?php echo form_error('story');?></span>
                        <input type="hidden" name="story_id" value="<?php echo $row->sid; ?>"> 
                        <input type="hidden" name="addepisode" value="" id="addepisode">
                        <input type="hidden" name="draft" value="" id="draft">
                        <input type="hidden" name="pay_story" value="<?php echo $row->pay_story; ?>">
                        <input type="hidden" name="title" value="<?php echo $row->title; ?>">
                    </div>
                </div>
            </form>
            <?php } } ?>
        </div>
        

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


<script>
    function previewContent(){
        var story = tinyMCE.activeEditor.getContent();
        var sid = $('input[name="story_id"]').val();
        var pay_story = $('input[name="pay_story"]').val();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/prefaceautosave",
            data: {'story':story, 'sid':sid, 'pay_story':pay_story},
			success:function(data){
			    console.log(data);
			}
		});
    }
    function submit(){
        $('#addepisode').val(' ');
        $('#draft').val(' ');
        var story = tinyMCE.activeEditor.getContent();
        if(story == '' || story == ' ' || story == 'null'){
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
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        if(story == '' || story == ' ' || story == 'null' || storytext.length < 1){
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
        height: 330,
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
