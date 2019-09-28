<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css"
    rel="stylesheet" type="text/css" />
    <?php 
if(isset($_POST)){
print_r($_POST);
print_r($_FILES);
}

    ?>
<script type="text/javascript">
    $(function () {
        $("#dialog").dialog({
            modal: true,
            autoOpen: false,
            title: "jQuery Dialog",
            width: 500,
            height: 500
        });
        $("#btnShow").click(function () {
            $('#dialog').dialog('open');
        });
    });
</script>
<form method="POST">

	<input type="file" name="mytestimage" id="mytestimage" value="">
	<input type="text" name="image1" id="mytestimage1">
<input type="submit">
</form>
<input type="button" id="btnShow" value="Show Popup" />
<div id="dialog" style="display: none" align = "center">
    <?php if(isset($listimages) && ($listimages->num_rows() > 0)){
    	foreach($listimages->result() as $row){ if(isset($row->image) && !empty($row->image)){ ?>
    		<img src="<?php echo base_url();?>assets/images/<?php echo $row->image;?>" style="height: 50px;width: 50px;" onClick="chooseimage('<?php echo base_url();?>assets/images/<?php echo $row->image;?>');">
<?php 
    	} } }
    ?>
</div>
<script type="text/javascript">
	function chooseimage(imagepath){
		//$('#mytestimage').val(imagepath);
		//var url = $('img').attr('src');
        //console.log(url);
        //$('input:file').val(imagepath);
		$('#mytestimage1').val(imagepath);	
		$("#dialog").dialog("close");
	}
</script>