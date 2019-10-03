<link rel="stylesheet" href="<?php echo base_url();?>assets/css/series_edit.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/editor.css">
    <?php if(isset($series_edit) && ($series_edit->num_rows()>0)){ foreach($series_edit->result() as $row){ ?>
        <div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="navbarv" style="margin-bottom:0px;  background-color:#23678e;">	
        	<div class="navbar-collapse">
        		<ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="<?php echo base_url('admin-series/'.preg_replace('/\s+/', '-', $row->title).'-'.$row->sid.'/'.preg_replace('/\s+/', '-', $row->title).'-'.$row->story_id); ?>"> CANCEL </a>
                    </li>
                    <li><a href="javascript:void(0)" onclick="publish()" style="color:#FFF; border: none;"> PUBLISH </a>  </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">DRAFT</a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0)" onclick="addtodrafts(<?php echo $row->sid;?>,<?php echo $row->story_id;?>)"> SAVE DRAFT</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" onclick="deletedraft(<?php echo $row->sid;?>,<?php echo $row->story_id;?>)"> DELETE DRAFT</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
            
        <div>
            <form action="<?php echo base_url('updatestory') ?>" id="display_result" method="post" name="registration" enctype="multipart/form-data">            
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
                                        <img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $row->title;?>" class="imageThumb">
                                        <span class="pip" style="width:293px;"><span class="remove"> Update </span></span>
                                    </span>
                                <?php } ?>
                            </label>
                        </div>
                    </div>
                    
                    <div class="editordiv">
                        <input type="hidden" id="languageto" value="<?php echo $row->language;?>">
                        <input type="text" name="title" class="enter-title-box" placeholder="ENTER TITLE" required="" value="<?php echo $row->title;?>">
                        <textarea class="storywrite" id="story" name="story" style="resize:none;"><?php if(isset($row->draft_story) && !empty($row->draft_story)){echo $row->draft_story;}else{echo $row->story;}?></textarea>
                        <iframe id="story_ifr" style="display: none;"></iframe>
                        <input type= "hidden" name="hidden" value="<?php echo $row->sid;?>"><!-- sid -->
                        <input type="hidden" id="story_id" name="story_id" value="<?php echo $row->story_id;?>">
                        <input type="hidden" name="draft" id="draft" value="<?php echo $row->draft;?>">
                    </div>
                </div>
            </form>
        </div>
    <?php } } ?>
    
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
        var ids = [ "story","story_ifr" ];
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
                        $('.upload-file-selector').html('<center style="padding:135px;">'+
                            '<img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:grab!important;"/></center>');
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
        var sid = "<?php echo $this->uri->segment(2); ?>";
        var story = tinyMCE.activeEditor.getContent();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
            data: {'story':story },
			success:function(data){
			    console.log('Saved to drafts.');
			}
		});
    }
    function addtodrafts(sid, story_id){
        var story = tinyMCE.activeEditor.getContent();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
            data: {'story':story},
			success:function(data){
			    if(data == 1){
			        $('#snackbar').text('Saved to drafts.').addClass('show');
    		        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
			        console.log('failed to save in Draft');
			    }
			}
		});
    }
    function deletedraft(sid, story_id){
        var title = $('input[name="title"]').val();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/savedeletedraft/"+sid,
			success:function(data){
			    if(data == 1){
                    console.log('Deleted.');
                    location.href = "<?php echo base_url();?>admin-series/"+title.replace(/\s+/g, "-")+"-"+sid+"/"+title.replace(/\s+/g, "-")+"-"+story_id;
			    }
			}
		});
    }
    function submit(){
        var story = tinyMCE.activeEditor.getContent();
        if(story == '' || story == ' ' || story == 'null'){
            $('#snackbar').text('Please Enter Story.').addClass('show');
    		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $("#display_result").submit();// save button on click
        }
    }
    function publish(){
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        if((story.replace(/\s/g,'')).length < 1){ //if(storytext.length < 200){
            $('#snackbar').text('Please enter story').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $('#draft').val(' '); 
            $('#checkepisode').modal('show');
        }
    }
    function yesno(value){
        $('#draft').val(' ');
        if(value == 'yes'){
            $('#lastepisode').val('yes');
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
