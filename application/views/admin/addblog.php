    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addblog" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="title">Title: </label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php echo set_value('title');?>">
                    <span class="text-danger"><?php echo form_error('title');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="blogimage">Blog Image: *</label>
                <div class="col-sm-10">
                    <input type="file" name="blogimage" class="form-control">
                    <span class="text-danger"><?php echo form_error('blogimage');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description: </label>
                <div class="col-sm-10">
                    <textarea name="description" id="blogtext" class="form-control" placeholder="Enter blog text" rows="5"><?php echo set_value('description');?></textarea>
                    <span class="text-danger"><?php echo form_error('description');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
            
        </form>
    </div>

<script src="<?php echo base_url();?>assets/dist/js/js/tinymce/tinymce.min.js"></script>
<script>
$(document).ready(function() {
    var timeoutId;
    tinymce.init({
        selector: "#blogtext",
        theme: "modern",
        plugins: ["link image"],
        toolbar: "undo redo | bold italic | aligncenter | link",
        paste_data_images: true,
        image_advtab: false,
        image_description: false,
        image_dimensions: false,
        menubar: false,
        statusbar : false,
        target_list: false,
        link_title: false,
        content_style: 'img {max-width: 100%; display: block; margin: 10 auto} p{word-break: break-all;}',
        /*file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('#upload').trigger('click');
            $('#upload').on('change', function() {
              var file = this.files[0];
              $('button#mceu_18-action').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner">');
              var reader = new FileReader();
              reader.onload = function() {
                //callback(e.target.result, {
                //  alt: ''
                //});
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
                    },complete: function() {
                        $('button#mceu_18-action').html('<i class="mce-ico mce-i-browse"></i>');
                    }
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
        },*/
    });
});
</script>