<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Story Carry</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/editor.css">
    </head>
    <body>
        
<style>
*{
    -webkit-tap-highlight-color: transparent;
}
 body{
  margin: 0;
  background: rgb(238, 238, 238);
 }
 
 .write-nav{
  width: 100%;
  height: 60px;
  z-index: 1000;
  position: fixed;
  background: #3c8dbc;
  font-family: Arial, Helvetica, sans-serif;
}

.write-nav2{
  display: none;
}
.write-nav2 div{
  width: 50%;
  text-align: center;
  line-height: 50px;
  color: white
}

.sidebar{
    height: 25px;
    margin-top: 17px;
    margin-left: 15px;
    display : inline-block;
    cursor: pointer;
}

.series-title{
    max-width: 300px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    position: absolute;
    top: 4px;
    left: 47px;
    color: white;
}

.nav-items-write{
  color: white;
  float: right;
  font-size: 15px;
  display: flex;
  margin-top: 10px;
}

.nav-items-write div {
  margin-right: 25px;
  cursor : pointer;
}

.publish-btn, .writing-tips-btn {
  border-radius : 5px;
  border: 1px solid white;
  padding :10px;

}

.publish-btn{
  background: #00000c24;
}

.writing-tips-btn{
  background: #00000c24; 
}

.draft-btn, .cancel-btn{
  margin-top: 11px;
}
.dropdown-content1{
  display: none;
  position: absolute;
  left:15px;
  top:65px;
  border: 1px solid #ddd;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
  background-color: white;
  width:290px;
  height: 285px;
  z-index: 1005;
  border-radius: 10px;
  padding: 6px ;
  overflow-y: scroll;
}
.dropdown-content1 a{
  color: black;
  text-decoration: none;
  padding:10px 15px;
  display: block;
}
.dropdown-content1 a:hover{
    background-color:#eeeeee;
}
.dropdown-content {
  display: none;
  position: absolute;
  right:0;
  top:60px;
  box-shadow:0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);
  background-color: #f9f9f9;
  min-width: 160px;
  z-index: 1005;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
}

.dropdown-content a{
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content a:hover{
    background-color:#eeeeee;
}
 

.preface-name{
    color:#3c8dbc !important;
    font-size: 1em;
    line-height: 1.5em;
}
.preface-name:hover{
    background-color:transparent !important;
}
.episode-div{
    padding-top: 8px;
    box-sizing: border-box;
    width: 35px;
    height:35px;
    border-radius:50%;
    background-color: #3c8dbc;
    text-align: center;
    color: rgb(255, 255, 255);
}
.episode-name{
    max-width: 209px;
    font-size:14px;
    margin-bottom :5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.episode-date{
    font-size:10px;
}
@media screen and (max-width: 1155px){
 .editordiv {
  width: 750px;
 }   
}

@media screen and (max-width:800px){
    .series-title{
       display: none;
    }
}

@media screen and (min-width:400px) and (max-width:480px){
    .nav-items-write{
        margin-top:14px;
        font-size : 13px;
    }
    .publish-btn{
        padding :7px;
    }
    .draft-btn, .cancel-btn{
        margin-top: 8px;
    }
    .nav-items-write div {
        margin-right: 15px;
    }
    .writing-tips-btn {
       padding :7px;
    } 
}

@media screen and (max-width:399px){
    .publish-btn, .writing-tips-btn{
        display: none;
    }
    .write-nav{
        height: 50px;
    }
    .sidebar {
        margin-top: 13px;
    }
    .nav-items-write{
        margin-top: 6px;
    }
    .write-nav2{
        display: flex;
        height: 50px;
        background: #23678e;;
        font-family: Arial, Helvetica, sans-serif;
        position: fixed;
        top: 50px;
        width: 100%;
        z-index: 1000;
    }
    .dropdown-content {
        top: 100px;
    }
    .dropdown-content1 {
        top: 102px;
        left : 10px;
    }
    .editorcontainer{
        padding-top: 140px;
    }
}

/* Popup modal css start */
.hide-body-scroll{
    overflow-y: hidden;
}
.blur{
  -webkit-filter: blur(5px);
  -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -ms-filter: blur(5px);
  filter: blur(5px);
}


.modal-wrapper{
    z-index: 1005;
  width:100%;
  height:100%;
  position:fixed;
  font-family: arial,"sans-serif";
  top:0; left:0;
  background:rgba(0,0,0,0.5);
  visibility:hidden;
  opacity:0;
  -webkit-transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -o-transition: all 0.25s ease-in-out;
  transition: all 0.25s ease-in-out;
}

.modal-wrapper.open{
  opacity:1;
  visibility:visible;
}

.modal{
  width:500px;
  max-width : 90%;
  border-radius: 5px;
  max-height : 100%;
  display:block;
  position: absolute;
  left: 50%;
  top: 30%;
  transform : translate(-50%,-30%);
  background:#fff;
  opacity:0;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}

.modal-wrapper.open .modal{
  opacity:1;
}

.popup-head{
  width:100%;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  height:45px;
  font-size :16px;
  overflow:hidden;
  background:#01bce5;
}

.popup-headtext{
    display : inline-block;
    margin:13px;
    color:white;
    max-width: 90%;
}
.popup-btn-close{
  width : 22px;
  margin: 6px 8px 0px 0px;
  float:right;
}

.popup-content{
    padding: 10px;
    font-size: 16px;
    line-height: 25px;
    max-height: 300px;
    min-height: 100px;
    overflow-y: scroll;
}
/* Popup modal css end */


/*snackbar css start */
/* The snackbar - position it at the bottom and in the middle of the screen */
#snackbar {
  visibility: hidden; /* Hidden by default. Visible on click */
  min-width: 250px; /* Set a default minimum width */
  background-color: #333; /* Black background color */
  color: #fff; /* White text color */
  text-align: center; /* Centered text */
  border-radius: 2px; /* Rounded borders */
  padding: 16px; /* Padding */
  position: fixed; /* Sit on top of the screen */
  z-index: 1; /* Add a z-index if needed */
  left: 50%; /* Center the snackbar */
  bottom: 30px; /* 30px from the bottom */
  transform: translateX(-50%);
}

/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show {
  visibility: visible; /* Show the snackbar */
  /* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
  However, delay the fade out process for 2.5 seconds */
  -webkit-animation: fadein 0.5s, fadeout 0.5s 10.5s;
  animation: fadein 0.5s, fadeout 0.5s 10.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
/*snackbar css end */

</style>

</head>

<body>
    
    <div class="write-nav">
        <img src="<?php echo base_url();?>assets/default/bars-solid.svg" class="sidebar">
        <div class="dropdown-content1" id="dropdown">
            <?php $seriesftitles = ''; if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)){
                foreach($seriesftitle->result() as $seriesftitl){ $seriesftitles = $seriesftitl->title; } 
                }else{ $seriesftitles = 'EPISODES'; } ?>
            
            <a href="<?php echo base_url().$this->uri->segment(1);?>/admin-series/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(4);?>" style="color:#3c8dbc;line-height: 1.4em;">
                <?php echo $seriesftitles; ?></a>
            <hr style="border-top: 1px solid #ddd;">
            
            <?php $i=1; if(isset($new_episode) && !empty($new_episode)){    foreach($new_episode as $row) {
                if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series")){
                if($row->draft == "draft"){ ?>
                    <a href="<?php echo base_url($this->uri->segment(1).'/series_series/'.$row->sid);?>" style="display:flex;font-family: Arial, sans-serif;">
                        <div class="episode-div"><?php echo $i; ?></div>     
                        <div style="padding: 0px 8px;">
                            <div class="episode-name"><?php echo ucfirst($row->title); ?></div> 
                            <div class="episode-date"><?php echo date("M j, Y", strtotime($row->date));?>
                            <span style="position:absolute;right:11px;">In Drafts</span></div>
                        </div>
                    </a>
                <?php }else{ ?>
                    <a href="<?php echo base_url($this->uri->segment(1).'/admin-series/'.preg_replace('/\s+/', '-', $row->title).'-'.$row->sid.'/'.preg_replace('/\s+/', '-', $row->title).'-'.$row->story_id);?>" style="display:flex;font-family: Arial, sans-serif;">
                        <div class="episode-div"><?php echo $i; ?></div>     
                        <div style="padding: 0px 8px;">
                            <div class="episode-name"><?php echo ucfirst($row->title); ?></div> 
                            <div class="episode-date"><?php echo date("M j, Y", strtotime($row->date));?>
                            <span style="position:absolute;right:11px"> &nbsp; </span></div>
                        </div>
                    </a>
                <?php } ?>
                <hr style="border: 0.5px solid #ddd;margin:0">
            <?php $i++; } } } ?>
        </div>
        <p class="series-title sidebar"><?php echo $seriesftitles; ?></p>
        
        <div class="nav-items-write">
            <div class="writing-tips-btn" name="episode" onclick="addepisode()">ADD EPISODE</div>
            <div class="publish-btn" type="submit" onclick="submit()">PUBLISH</div>
            <div class="draft-btn">DRAFT</div>
            <div class="dropdown-content">
                <a href="javascript:void(0);" type="submit" onclick="addtodrafts()">SAVE DRAFT</a>
                <a href="#">DELETE DRAFT</a>
            </div>
            <a href="<?php echo base_url().$this->uri->segment(1);?>" style="text-decoration:none;color:#fff;">
                <div class="cancel-btn">CANCEL</div>
            </a>
        </div>
    </div>
    <div class="write-nav2">
        <div style="border-right: 1px solid #0a000026;" name="episode" onclick="addepisode()">ADD EPISODE</div>
        <div type="submit" onclick="submit()">PUBLISH</div>
    </div>
    
    <div>
        <form action="<?php echo base_url().$this->uri->segment(1);?>/addepisode/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(4); ?>" method="POST" enctype="multipart/form-data" id="display_result">
            <div class="editorcontainer">
                <div class="imagemaindiv">
                    <div class="imagebox">
                        <label for="upload-file-selector">
                            <input type="file" name="image" id="upload-file-selector" required="" style="display:none;">
                            <span class="upload-file-selector">
                                <img src="<?php echo base_url();?>assets/images/flat.png" style="cursor:pointer;padding:124px;">
                                <p class="browseimg">image SIZE should be smaller than 2MB.</p>
                            </span>
                            <span class="text-danger imageerror"></span>
                        </label>
                    </div>
                    <div class="removebtn"></div>
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
    
    <div id="snackbar"></div>
    
<div class="modal-wrapper" id="checkepisode">
    <div class="modal">
        <div class="popup-head">
            <div class="popup-headtext">Is this the Last Episode of this series?</div>
        </div>
        <div class="popup-content">
            <center><h4> If you click on 'YES', You Cannot add any new episode to this series.</h4>
                <button style="background:#3c8dbc;padding: 6px 15px;border: none;color: #fff;border-radius: 5px;" onclick="yesno('no')"> NO </button>
                <button style="padding: 6px 15px;border: none;color: #000;border-radius: 5px;background: #ddd;" onclick="yesno('yes')"> YES </button>
            </center>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".draft-btn").click(function(e) {
        $(".dropdown-content").toggle();
        e.stopPropagation();
    });
    
    $(".sidebar").click(function(e){
        $(".dropdown-content1").toggle();
        e.stopPropagation();
    });
    
    $(document).click(function(e) {
        if (!$(e.target).is('.dropdown-content')) {
            $(".dropdown-content").css('display','none');
        }
        if (!$(e.target).is('.dropdown-content1')) {
            $(".dropdown-content1").css('display','none');
        }
    });
});
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
                    url:"<?php echo base_url().$this->uri->segment(1);?>/addepisodeimage",
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
                url: "<?php echo base_url().$this->uri->segment(1);?>/addseriesepisode/"+seriesid,
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
                    url: "<?php echo base_url().$this->uri->segment(1);?>/seriesaddtodrafts",
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
            url: "<?php echo base_url().$this->uri->segment(1);?>/seriesaddtodrafts",
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
        if(((storytext.replace(/\s/g,'')).length > 0) || (storytextarea.indexOf('/images/storyimgs/') != -1) || ((title.replace(/\s/g,'')).length > 0)){
            var inputdata = $('.seriesaddtodrafts').find('input').serialize()+"&story="+storytextarea;
            $('.writing-tips-btn').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/seriesaddtodrafts",
                data: inputdata,
                success:function(data){
                    location.reload();
                }
            });
        }else{
            $('#snackbar').text('Enter Title & Story for Current Episode').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
        }
    }
    
    function submit(){ // click on publish btn
        var story = tinyMCE.activeEditor.getContent();
        var storytext = $(story).text();
        var title = $('#title').val();
        if( (((storytext.replace(/\s/g,'')).length > 1) || (story.indexOf('/images/storyimgs/') != -1)) && (title.length > 1) ){
            $('body').toggleClass('hide-body-scroll');
            $('#checkepisode').toggleClass('open');
            return false;
        }
        if(title.length < 1){
            $('#snackbar').text('Enter Title').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        }else {
            $('#snackbar').text('Enter story').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
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
                url: "<?php echo base_url().$this->uri->segment(1);?>/seriesaddtodrafts",
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
    var timeoutId;
    tinymce.init({
        selector: "#story",
        theme: "modern",
        plugins: ["link image"],
        toolbar: "undo redo | bold italic | aligncenter | link image",
        paste_data_images: true,
        image_advtab: false,
        image_description: false,
        image_dimensions: false,
        menubar: false,
        statusbar : false,
        target_list: false,
        link_title: false,
        content_style: 'img {max-width: 100%; display: block; margin: 10 auto} p{word-break: break-all;}',
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
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function() {
                    previewContent();
                }, 100);
            });
        },
    });
});
</script>


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

    </body>
</html>