<link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin_story_view.css">
<div id="storyview">
    <?php if(isset($editstory) && ($editstory->num_rows()>0)){ foreach($editstory->result() as $row){ ?>
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
    <form action="<?php echo base_url();?>welcome/saveupdatestory/<?php echo $row->sid;?>" method="POST" enctype="multipart/form-data" id="updatestory">
        <div class="tops" style="">
            <div class="content contentseries">
                <div style="display:flex; flex-wrap:wrap;justify-content:center;">
		            <div class="" style="margin-bottom:20px; width:293px;">
        		        <div class="row">
        		            <label class="btn-default" style="background:none;width:293px;" for="upload-file-selector">
        				        <div class="box box-widget widget-user boxshv" style="height: 280px; width:293px;">
        				            <?php if(isset($row->cover_image) && !empty($row->cover_image)) { ?>
        				                <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
            				            <span class="upload-file-selector">
            				                <img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image; ?>" class="imageThumb">
            				            </span>
        					        <?php } else { ?>
        					            <input type="file" name="cover_image" id="upload-file-selector" style="display:none;">
        					            <span class="upload-file-selector"><center style="padding-top:135px;">
							            <img src="<?php echo base_url() ?>assets/images/flat.png" style="cursor:grab!important;" class=""/></center></span>
        					        <?php } ?>
        					    </div>
        					</label>
        					<span class="text-danger"><?php echo $this->session->flashdata('errmsg');?></span>
            			</div>
            	    </div>
                	<div class="" style="width:800px;">
						<div class="box box-widget widget-user boxshv" style="padding:25px;">
        					<div class="box-body form-horizontal">
        					    <center><h2 style="margin-top:0;margin-bottom:0;"><b><?php echo $row->title; ?></b></h2></center>
        					</div>
        					<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
        					<input type="hidden" id="title" name="title" value="<?php echo $row->title;?>">
    						<div class="box-body pad">
								<textarea id="story" name="story" rows="13" cols="113" style="resize:none;" class="form-control" required><?php if(isset($row->draft_story) && !empty($row->draft_story)){echo $row->draft_story;}else{echo $row->story;}?></textarea>
								<iframe id="story_ifr" style="display: none;"></iframe>
    						</div>
        					<input type="hidden" name="type" value="<?php echo $row->type;?>">
        				</div><br><br>
        			</div>
            	</div>
            </div>
            <section class="content contentseries1">
        	    <div class="" style="text-align:center;">
        	        <h3>TO EDIT STORY</h3><br>
        	        INSTALL OUR APP<br>
        	        <a href=""><img src="<?php echo base_url();?>assets/landing/storycarry app.png" class="img-thumbnaile"></a><br>
        	        Or<br>
        	        OPEN SITE ON DESKTOP
        	    </div>
        	</section>
        </div>
    </form>
    <?php } } else { ?>
    <div id="navbarv">
	    <div class="pull-left">
		    <a class="dropdown notifications-menu" style="float:left; margin-right:0px !important">
				<span><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a></span>
                <ul class="dropdown-menu" >
        			<center>
        				<button name="episode" id="viewqa"class="btn btn-primary">Add Episode</button>
        			</center>
					<?php $i=1; if(isset($get_episode)) { $j=0; foreach($get_episode->result() as $rowindicate){ ?>
                	<?php $rowin=''; if($j==0) {$rowin='active';} ?>
    				<li data-target="#myCarousel" data-slide-to="<?php echo $j;?>" class="li-color">
    					<span class="menu-icon bg-light-blue" style="border-radius: 30px;padding:8px;background-color: #000;">
    						<a><?php echo $i; ?><?php echo ucfirst($rowindicate->title); ?></a>
    					</span>
    				</li>
				    <span class="pull-right">
						<a href="<?php echo base_url();?>welcome/admin_story_view/<?php echo $rowindicate->sid; ?>" style="width: 44px;">
              				<span><i class="fa fa-edit"></i></span>
            			</a>
        		    </span>
			        <?php $j++; $i++; } } ?>
			    </ul>
		    </a>  
		</div>
		<?php foreach($admin_story_view->result() as $row) { ?>
		<div class="pull-right">
			<a href="#"></a>
			<a href="#"></a>
			<a href="#"></a>
			<!--<a href="<?php echo base_url();?>index.php/Welcome/admin_story_view/<?php echo $row->sid; ?>">Edit</a>-->
		</div>
		<?php } ?>
	</div>
    <div class="" style="background:#fff;">
        <div class="" style=""></div>
        <section class="content" style="margin-top:0px;">
		    <div class="container">
		        <div class="row">
			        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false"><!-- Wrapper for slides -->		
					    <div class="carousel-inner" style="margin-top:10px;">
						    <?php $i=0; foreach($get_episode->result() as $row){ ?>
						    <?php $itemactive=''; if($i==0) {$itemactive='active';} ?>
							<div class="item <?php echo $itemactive; ?>"><br>
                    			<div class="col-md-3" style="margin-bottom:20px;">
                    				<div class="row">
                    					<div class="box box-widget widget-user vjbs">
                    					    <a href="">
                    							<img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image; ?>" alt="" style="width:320px; height:280px;" class="img-responsive">
                    						</a>
                    					</div>
                    				</div><br>
                        			<!--<div class="row">
                    					<center>
                    						<a href="<?php echo base_url('index.php/Welcome/crowd?id='.$row->sid);?>" class="btn btn-warning btn-block">Apply For Funding</a>
                    					</center>	
                        			</div>-->
                    			</div>
                    			<div class="col-md-8">
                    				<div class="box box-widget widget-user vjc1" style="padding:25px;"><br>
                    					<div class="row">
                    						<!--<div class="box-body">
                    							<center>
                    								<h2><b><?php echo $row->title; ?></b></h2>
                    							</center>
                    							<center>
                    								<h4 class="text-muted"><?php echo $row->sub_title; ?></h4>
                    							</center>
                    						</div>-->
                						    <div style="padding:20px;text-align: justify;">
                                                <div class=""><br>
                									<center><h2><b><?php echo ucfirst($row->title); ?></b></h2></center><br>
                									<div class="">
                										<p><?php echo $row->story; ?></p>
                									</div>
                								</div>
                						    </div>
                    					</div>
                    				</div>
                    			</div>
		                    </div>
                            <?php $i++; } ?>
                        </div>
                    </div>
                </div>
        		<div class="row">
        		    <div class="col-md-3"></div>
        			<div class="col-md-8">
        			    <div class="vjbs" style="padding:10px;">
            				<!--<span class="pull-right text-muted"></span>-->
            				<h3> Comment's for Your Stories</h3>
            				<div class="box-footer box-comments">
        					    <!-- /.box-footer -->
        					    <!--<div class="box-comment">
            						<form action="<?php echo base_url('index.php/Welcome/comment'); ?>" method="POST">
            							<div class="img-push"> 
            								<div class="row">
            									<div class="col-md-9">
                                                   <textarea class="form-control input-sm" name="comment"  placeholder="Press enter to post comment"></textarea>
                                                   <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                                </div>
                                                <div class="col-md-2">
                                               	    <button class="btn btn-success"> comment </button>
                                                </div>
                                            </div>
            							</div>
            						</form><br>
            					</div>-->
            					<!-- /.box-comment -->
            					<div class="box-comment">
                					<?php foreach($comment_get->result() as $key) { ?>
                					<img class="img-circle img-sm" src="<?php echo base_url();?>assets/dist/img/user5-128x128.jpg" alt="User Image">
            						<div class="comment-text">
            							<span class="username">
            								<?php echo $key->name; ?>
            								<span class="text-muted pull-right"><?php echo $key->date; ?></span>
            							</span><!-- /.username -->
            						    <?php echo $key->comment; ?>
            						</div>
            						<?php } ?>
            					</div>
        				    </div>
        			    </div>
        			</div>
        		 </div>
		    </div>
	    </section>
    </div>
    <?php } ?>
    <aside class="control-sidebar control-sidebar-dark">
        <div class="tab-content">
            <div class="tab-pane active" id="">
             	<!--<center>
        			<button name="episode" id="viewqa"class="btn btn-primary">Add Episode</button>
        		</center> // edit story admin_story url-->
        		<!--<center>
        			<h3 class="control-sidebar-heading">యశోద కుటుంబం</h3>
        		</center>-->
                <ul class="control-sidebar-menu">
                    <!--<?php $i=1; if(isset($get_episode)) { $j=0; foreach($get_episode->result() as $rowindicate){ ?>
           	        <?php $rowin=''; if($j==0) {$rowin='active';} ?>
                    <li>
                       <a href="" data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="">
            				<span class="menu-icon bg-light-blue"><?php echo $i; ?></span>
                          <div class="menu-info">
                            <h4 class="control-sidebar-subheading"><b><?php echo ucfirst($rowindicate->title); ?></b></h4>
            				<p><b><?php echo ucfirst($rowindicate->title); ?> </b></p>
                         </div>
                       </a>
                        <a href="<?php echo base_url();?>index.php/Welcome/admin_story_view/<?php echo 
            				$rowindicate->sid; ?>">
                          <span><i class="fa fa-edit"></i></span>
                        </a>
                    </li>
                    <?php $j++; $i++; } } ?>-->
                </ul>
            </div>
        </div>
    </aside>
</div>
<script>
window.onscroll = function() {myFunction()};
var navbarv = document.getElementById("navbarv");
var sticky = navbarv.offsetTop;
function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbarv.classList.add("sticky")
    } else {
        navbarv.classList.remove("sticky");
    }
}
</script>



<script type="text/javascript">
	$(document).ready(function() {
		$('#viewqa').click(function(){
			$('#divqa').css('display','block');
			$('#storyview').css('display','none');
		})
	});
</script>
<div id="divqa" style="display: none;">
	<form action="<?php echo base_url();?>welcome/addepisode/" method="POST" enctype="multipart/form-data">
        <div id="navbarv">
          	<!--<div class="pull-left">
    			<a href="#" data-toggle="control-sidebar" style="float:left; margin-right:0px !important"><i class="fa fa-bars"></i></a>
    		</div>-->
    		<div class="pull-right">
    			<a href="#"></a>
    			<a href="#"></a>
    			<a href="#"></a>
    			<a><button type='submit' name='edit' class='btn btn-primary' onclick="submit()"> Add Episode</button></a>
    		</div>
	    </div>
        <div class="" style="background:#fff;">
            <div class="" style=""></div>
            <section class="content" style="margin-top:0px;">
        	    <div class="container">
        		    <div class="row">
            			<div class="col-md-3" style="margin-bottom:20px;">
            				<div class="row">
            					<div class="box box-widget widget-user vjbs" style="height:313px;">
            						UPLOAD STORY COVER IMAGE
            						<input type="file" name="cover_image" id="i_files" >
                                     <a>
                						<div  class="col-md-12" style="">
            							    <center>
            									<label id="thumbnil"  class="btn-default" style="background:none;" for="upload-file-selector"></label>
            								</center>
                						</div>
                					 </a>
            					</div>
            				</div><br>
            			</div>
            			<div class="col-md-8">
            			    <div class="box box-widget widget-user vjc1" style="padding:25px;"><br>
            					<div class="row">
            						<div class="box-body">
            							<center>
            								<input type="hidden" id="languageto" value="<?php echo $row->language;?>">
            								<h2><b><input type="text" name="title" id="title" style="text-align:center;border: none" placeholder="TITLE" required=""></b></h2>
            							</center>
            							<center>
            								<h4><input type="text" name="sub_title" id="sub_title"  style="text-align:center;border: none" placeholder="sub_title"></h4>
            							</center>
            						</div>
            						<div class="box-body pad">
                						<textarea id="story" name="story" rows="18" cols="99"></textarea>
                						<input type="hidden" name="series_id" value="<?php echo $_GET['id']; ?>">
                						<input type="hidden" name="writing_style" value="<?php echo $row->writing_style; ?>">
                						<input type="hidden" name="genre" value="<?php echo $row->genre; ?>">
                						<input type="hidden" name="copyrights" value="<?php echo $row->copyrights; ?>">
                						<input type="hidden" name="language" value="<?php echo $row->language; ?>">
                						<!--<input type="hidden" name="cover_image" value="<?php echo $row->cover_image; ?>">-->
                						<input type="hidden" name="type" value="<?php echo $row->type; ?>">
            					    </div>
            					</div>
            				</div>
            			</div>
        		    </div>
        		</div>
    	    </section>
        </div>
    </form>
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
    /*$(document).ready( function() {
        tinyMCE.activeEditor.on('keypress keyup', function(ed, e) {
            var sid = "<?php echo $this->uri->segment(2); ?>";
            var story = tinyMCE.activeEditor.getContent();
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>index.php/welcome/saveaddtodrafts/"+sid,
                data: {'story':story},
    			success:function(data){
                    console.log('saved to Draft');
    			}
    		});
        });
    });*/
    function previewContent(){
        var story = tinyMCE.activeEditor.getContent();
        var sid = "<?php echo $this->uri->segment(2); ?>";
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/saveaddtodrafts/"+sid,
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
            url: "<?php echo base_url();?>index.php/welcome/saveaddtodrafts/"+sid,
            data: {'story':story},
			success:function(data){
			    if(data == 1){
			        console.log('saved to Draft');
			        //location.href = "<?php echo base_url();?>index.php/welcome/admin_story?id="+sid;
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
                url: "<?php echo base_url();?>index.php/welcome/savedeletedraft/"+sid,
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
        if(story.length < 200){
            $('#snackbar').text('Please enter minimum 200 characters to save').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $("#updatestory").submit(); // save button on click
        }
    }
</script>
<!-- Before editor adding -->
<!--
<script>
    $(document).ready( function() {
        $('#story').bind('keypress', function(e) {
            var sid = "<?php echo $this->uri->segment(3); ?>";
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
    function addtodrafts(sid){
        var story = $('textarea#story').val();
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/saveaddtodrafts/"+sid,
            data: {'story':story},
			success:function(data){
			    if(data == 1){
			        console.log('saved to Draft');
			        location.href = "<?php echo base_url();?>index.php/welcome/admin_story?id="+sid;
			    }else{
			        console.log('failed to save in Draft');
			    }
			}
		});
    }
    function deletedraft(sid){
        $.ajax({
			type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/savedeletedraft/"+sid,
			success:function(data){
			    if(data == 1){
                    console.log('Deleted.');
                    location.href = "<?php echo base_url();?>index.php/welcome/admin_story?id="+sid;
			    }
			}
		});
    }
    function submit(){
        var story = $('textarea#story').val();
        if(story.length < 200){
            $('#snackbar').text('Please enter minimum 200 characters to save').addClass('show');
        	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else{
            $("#updatestory").submit(); // save button on click
        }
    }
</script>-->


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
