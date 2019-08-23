	<style>
	    /* jquery.Jcrop.min.css v0.9.12 (build:20130126) */
        .jcrop-holder{direction:ltr;text-align:left;}
        .jcrop-vline,.jcrop-hline{background:#FFF url(Jcrop.gif);font-size:0;position:absolute;}
        .jcrop-vline{height:100%;width:1px!important;}
        .jcrop-vline.right{right:0;}
        .jcrop-hline{height:1px!important;width:100%;}
        .jcrop-hline.bottom{bottom:0;}
        .jcrop-tracker{-webkit-tap-highlight-color:transparent;-webkit-touch-callout:none;-webkit-user-select:none;height:100%;width:100%;}
        .jcrop-handle{background-color:#333;border:1px #EEE solid;font-size:1px;height:7px;width:7px;}
        .jcrop-handle.ord-n{left:50%;margin-left:-4px;margin-top:-4px;top:0;}
        .jcrop-handle.ord-s{bottom:0;left:50%;margin-bottom:-4px;margin-left:-4px;}
        .jcrop-handle.ord-e{margin-right:-4px;margin-top:-4px;right:0;top:50%;}
        .jcrop-handle.ord-w{left:0;margin-left:-4px;margin-top:-4px;top:50%;}
        .jcrop-handle.ord-nw{left:0;margin-left:-4px;margin-top:-4px;top:0;}
        .jcrop-handle.ord-ne{margin-right:-4px;margin-top:-4px;right:0;top:0;}
        .jcrop-handle.ord-se{bottom:0;margin-bottom:-4px;margin-right:-4px;right:0;}
        .jcrop-handle.ord-sw{bottom:0;left:0;margin-bottom:-4px;margin-left:-4px;}
        .jcrop-dragbar.ord-n,.jcrop-dragbar.ord-s{height:7px;width:100%;}
        .jcrop-dragbar.ord-e,.jcrop-dragbar.ord-w{height:100%;width:7px;}
        .jcrop-dragbar.ord-n{margin-top:-4px;}
        .jcrop-dragbar.ord-s{bottom:0;margin-bottom:-4px;}
        .jcrop-dragbar.ord-e{margin-right:-4px;right:0;}
        .jcrop-dragbar.ord-w{margin-left:-4px;}
        .jcrop-light .jcrop-vline,.jcrop-light .jcrop-hline{background:#FFF;filter:alpha(opacity=70)!important;opacity:.70!important;}
        .jcrop-light .jcrop-handle{-moz-border-radius:3px;-webkit-border-radius:3px;background-color:#000;border-color:#FFF;border-radius:3px;}
        .jcrop-dark .jcrop-vline,.jcrop-dark .jcrop-hline{background:#000;filter:alpha(opacity=70)!important;opacity:.7!important;}
        .jcrop-dark .jcrop-handle{-moz-border-radius:3px;-webkit-border-radius:3px;background-color:#FFF;border-color:#000;border-radius:3px;}
        .solid-line .jcrop-vline,.solid-line .jcrop-hline{background:#FFF;}
        .jcrop-holder img,img.jcrop-preview{max-width:none;}
        input.jcrop-keymgr{ display:none !important;}
	</style>
    
<div>
    <?php if(isset($image) && !empty($image)){  ?>
    <img src="<?php echo base_url();?>assets/images/<?php echo $image; ?>" id="cropbox" class="img"><br />
    <?php } else { ?>
    <img src="<?php echo base_url();?>assets/images/2.png" id="cropbox" class="img" /><br />
    <?php } ?>
</div>
<div id="btn">
    <input type='button' id="crop" value='SAVE' class="pull-right btn btn-primary">
</div>


<script>
    $(document).ready(function(){
        var size;
        $('#cropbox').Jcrop({
            aspectRatio: 1,
            boxWidth: 450,   //Maximum width you want for your bigger images
            boxHeight: 400,  //Maximum Height for your bigger images
            onSelect: function(c){
                console.log(c);
                size = {x:c.x, y:c.y, w:c.w, h:c.h};
                $("#crop").css("visibility", "visible");
            }
        });
        $("#crop").click(function(){
            var img = $("#cropbox").attr('src');
            $("#cropped_img").show();
            if(size){
                $.ajax({
        			url: "<?php echo base_url().$this->uri->segment(1);?>/image_crop",
        			type: 'POST',
        			data: {'img': img,'x': size.x,'y': size.y,'w': size.w,'h': size.h },
        			success: function (resultdata) {
        			    $(".img-circle").attr('src',resultdata);
        			    setTimeout(function(){ $("#upload_profileimg").modal('hide'); }, 1000);
        			    setTimeout(function(){ location.reload(); }, 100);
        			}
                });
            }else{
                $.ajax({
        			url: "<?php echo base_url().$this->uri->segment(1);?>/image_crop",
        			type: 'POST',
        			data: {'fullimg': img },
        			success: function (resultdata) {
        			    $(".img-circle").attr('src',resultdata);
        			    setTimeout(function(){ $("#upload_profileimg").modal('hide'); }, 1000);
        			    setTimeout(function(){ location.reload(); }, 100);
        			}
                });
            }
        });
    });
</script>