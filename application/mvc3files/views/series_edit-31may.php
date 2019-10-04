<link rel="stylesheet" href="<?php echo base_url();?>assets/css/series_edit.css">

<?php if(isset($series_edit) && ($series_edit->num_rows()>0)){ foreach($series_edit->result() as $row){ ?>
<div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="navbarv" style="margin-bottom:0px;  background-color:#23678e;">	
	<div class="navbar-collapse">
		<ul class="nav navbar-nav pull-right">
		    <li>
		        <a href="<?php echo base_url('admin-series/'.preg_replace('/\s+/', '-', $row->title).'-'.$row->sid.'/'.preg_replace('/\s+/', '-', $row->title).'-'.$row->story_id); ?>"> CANCEL </a>
		    </li>
		    <!--<li><a href="javascript:void(0)" onclick="submit()" style="color:#FFF; border: none;"> SAVE </a>  </li>-->
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

<div id="storyview">
    <form action="<?php echo base_url('updatestory') ?>" id="display_result" method="post" name="registration" enctype="multipart/form-data">
        <input type= "hidden" name="hidden" value="<?php echo $row->sid;?>">
</div>
<div class="tops">
    <div style="" class="content contentseries">
        <div style="display:flex; justify-content:center;">
			    <div class="" style="margin-bottom:20px; width:293px;">
    				<div class="row">
    				    <label class="btn-default" style="background:#fff;box-shadow:0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2)!important;" for="upload-file-selector">
				            <div class="box box-widget widget-user boxshv" style="height: 280px; width:293px;">
    				            <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
    				                <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
        				            <span class="upload-file-selector">
        				                <center>
        				                    <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image; ?>" class="imageThumb" style="height:280px;width:293px;">
        				                </center>
        				            </span>
    					        <?php } else { ?>
    					            <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
    					            <span class="upload-file-selector">
    					                <center style="padding:135px;">
    					                    <img src="<?php echo base_url() ?>assets/images/flat.png" style="cursor:grab!important;"/>
    					                </center>
    					           </span>
    					       <?php } ?>
					       </div>
					    </label>
                    </div><br>
			    </div>
			    <div class="" style="width:800px;">
    				<div class="box box-widget widget-user boxshv" style="padding:25px;  height:416px; padding-top: 0;">
						<div class="box-body" style="padding:0px 10px;">
							<center><h2 style="padding-top:20px;padding-bottom:20px; margin:0"><b><?php echo $row->title; ?></b></h2></center>
						</div> 
						<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
						<div class="pad">
							<input type="hidden" id="story_id" name="story_id" value="<?php echo $row->story_id;?>">
							<textarea id="story" name="story" rows="13" cols="95" class="form-control" style="resize:none;"><?php if(isset($row->draft_story) && !empty($row->draft_story)){echo $row->draft_story;}else{echo $row->story;}?></textarea>
						    <iframe id="story_ifr" style="display: none;"></iframe>
						    <input type="hidden" name="draft" id="draft" value="<?php echo $row->draft;?>">
						    <input type="hidden" name="title" value="<?php echo $row->title;?>">
						</div>
				    </div>
			    </div>
		    </div>
	</div>
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
</form>
<?php } } ?>

<!--
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
		$('#viewqa').click(function(){
			$('#divqa').css('display','block');
			$('#storyview').css('display','none');
		})
    });
</script> -->
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
    /*$(document).ready( function() {
        tinyMCE.activeEditor.on('keypress keyup', function(ed, e) {
            var sid = "<?php echo $this->uri->segment(2); ?>";
            var story = tinyMCE.activeEditor.getContent();
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>index.php/welcome/saveaddtodrafts/"+sid,
                data: {'story':story },
    			success:function(data){
    			    //console.log('Story saved to drafts.');
                    //$('#snackbar').text('Story saved to drafts.').addClass('show');
    		        //setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}
    		});
        });
    });*/
    function previewContent(){
        var sid = "<?php echo $this->uri->segment(2); ?>";
        var story = tinyMCE.activeEditor.getContent();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>welcome/saveaddtodrafts/"+sid,
            data: {'story':story },
			success:function(data){
			    console.log('Story saved to drafts.');
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
			        $('#snackbar').text('saved to Draft').addClass('show');
    		        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			        //console.log('saved to Draft');
			        //location.href = "<?php echo base_url();?>new_series_admin?id="+sid+"&story_id="+story_id;
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
        if(story.length < 200){
            $('#snackbar').text('Please enter minimum 200 characters to publish').addClass('show');
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


<!-- before editor start-->
<!--
<script>
    $(document).ready( function() {
        $('#story').bind('keypress', function(e) {
            var sid = "<?php echo $this->uri->segment(2); ?>";
            var story = $('textarea#story').val();
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>index.php/welcome/saveaddtodrafts/"+sid,
                data: {'story':story},
    			success:function(data){
                    console.log('saved to Draft');
    			}
    		});
        });
    });
    function addtodrafts(sid, story_id){
        var story = $('textarea#story').val();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/saveaddtodrafts/"+sid,
            data: {'story':story},
			success:function(data){
			    if(data == 1){
			        console.log('saved to Draft');
			        location.href = "<?php echo base_url();?>new_series_admin?id="+sid+"&story_id="+story_id;
			    }else{
			        console.log('failed to save in Draft');
			    }
			}
		});
    }
    function deletedraft(sid, story_id){
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/savedeletedraft/"+sid,
			success:function(data){
			    if(data == 1){
                    console.log('Deleted.');
                    location.href = "<?php echo base_url();?>new_series_admin?id="+sid+"&story_id="+story_id;
			    }
			}
		});
    }
    function submit(){
        var story = $('textarea[name="story"]').val();
        if(story == '' || story == ' ' || story == 'null'){
            $('#snackbar').text('Please Enter Story.').addClass('show');
    		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $("#display_result").submit();// save button on click
        }
    }
</script> --> <!-- before editor end-->

<script>
var didScrolls;
var lastScrollTops = 0;
var deltas = 5;
var sidebarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScrolls = true;
});

setInterval(function() {
    if (didScrolls) {
        hasScrolleds();
        didScrolls = false;
    }
}, 350);

function hasScrolleds() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTops - st) <= deltas)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTops && st > sidebarHeight){
        // Scroll Down
        $('#navbarv').removeClass('sticky').addClass('sticky1');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('#navbarv').removeClass('sticky1').addClass('sticky');
        }
    }
    
    lastScrollTops = st;
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
