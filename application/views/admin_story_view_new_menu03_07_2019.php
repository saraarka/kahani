<link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin_story_view.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/editor.css">

    <?php if(isset($editstory) && ($editstory->num_rows() == 1)){ foreach($editstory->result() as $row){ ?>
        <div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="navbarv" style="margin-bottom:0px;  background-color:#23678e;">	
        	<div class="navbar-collapse">
                <ul class="nav navbar-nav pull-right" style="display:inline-flex;">
                    <li>
                        <a href="<?php echo base_url();?>admin-story/<?php echo preg_replace('/\s+/','-',$row->title).'-'.$row->sid;?>"> CANCEL</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><button class="btn-primary" onclick="submit()" style="color:#FFF; border: none; background:none;"> SAVE </button></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">DRAFTS</a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0)" onclick="addtodrafts(<?php echo $row->sid;?>)"> SAVE DRAFT </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" onclick="deletedraft(<?php echo $row->sid;?>)"> DELETE DRAFT </a>
                            </li>
                        </ul>
                    </li>
    			</ul>
    		</div>
    	</div>
    
        <div>
            <form action="<?php echo base_url();?>welcome/saveupdatestory/<?php echo $row->sid;?>" method="POST" enctype="multipart/form-data" id="updatestory">
                <div class="editorcontainer">
                    <div>
                        <div class="imagebox">
                            <label for="upload-file-selector">
                                <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
                                    <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
                                    <span class="upload-file-selector">
                                        <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image;?>" alt="<?php echo $row->title;?>">
                                    </span>
                                <?php } else { ?>
                                    <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
                                    <span class="upload-file-selector">
                                        <img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $row->title;?>" class="imageThumb">
                                    </span>
                                <?php } ?>
                            </label>
                            <span class="text-danger"><?php echo $this->session->flashdata('errmsg');?></span>
                        </div>
                    </div>
                    <div class="editordiv">
                        <div class="enter-title-box"><?php echo $row->title; ?></div>
                        <input type="hidden" id="languageto" value="<?php echo $row->language;?>">
                        <input type="hidden" id="title" name="title" value="<?php echo $row->title;?>">
                        <textarea class="storywrite" id="story" name="story" style="resize:none;"><?php if(isset($row->draft_story) && !empty($row->draft_story)){echo $row->draft_story;}else{echo $row->story;}?></textarea>
                        <iframe id="story_ifr" style="display: none;"></iframe>
                        <input type="hidden" name="type" value="<?php echo $row->type;?>">
                    </div>
                </div>
            </form>
        </div>
    <?php } } ?>

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
        var ids = [ "story","sub_title","title","story_ifr" ];
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
<script>
    function previewContent(){
        var story = tinyMCE.activeEditor.getContent();
        var sid = "<?php echo $this->uri->segment(2); ?>";
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
            data: {'story':story},
			success:function(data){
                console.log('saved to Draft');
			}
		});
    }
    function addtodrafts(sid){
        var story = tinyMCE.activeEditor.getContent();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
            data: {'story':story},
			success:function(data){
			    if(data == 1){
			        console.log('saved to drafts.');
			        $('#snackbar').text('Saved to drafts').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
			        console.log('failed to save in Draft');
			    }
			}
		});
    }
    function deletedraft(sid){
        var x = confirm("Are you sure you want to delete?");
        if (x) {
            var title = $('#title').val();
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/savedeletedraft/"+sid,
    			success:function(data){
    			    if(data == 1){
                        console.log('Deleted.');
                        location.href = "<?php echo base_url();?>admin-story/"+title.replace(/\s+/g,"-")+"-"+sid;
    			    }
    			}
    		});
        }else{
            return false;
        }
    }
    function submit(){
        var story = tinyMCE.activeEditor.getContent();
        if((story.replace(/\s/g,'')).length < 0){ //if(story.length < 200){
            //$('#snackbar').text('Please enter minimum 200 characters to save').addClass('show');
            $('#snackbar').text('Please enter story').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $("#updatestory").submit(); // save button on click
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