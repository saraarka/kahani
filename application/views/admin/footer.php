<div id="snackbar"></div>
<footer>
    
</footer>
<script>
    // userslist.php
    $(document).ready(function(){
        $("#usersearchsort").bind("change keyup", function(event){
           var search = $('#search').val();
           var language = $('#language option:selected').val();
           var emailverify = $('#emailverify option:selected').val();
           var monetisation = $('#monetisation option:selected').val();
            $.ajax({
                url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/usersearch",
                type: "POST",
                data: {'search':search, 'language':language, 'emailverify':emailverify, 'monetisation':monetisation},
                success: function(result){
                    $("#usersearchsortresult").html(result);
                }
            });
        });
        
        $("#pstoriessearch").bind("change", function(event){ //profilestories.php
            var type = $('#type option:selected').val();
            var userid = $('#userid').val();
            $.ajax({
                url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/pstoriessearch/"+userid,
                type: "POST",
                data: {'type':type},
                success: function(result){
                    $("#psearchresults").html(result);
                }
            });
        });
        
    });
    function addearnings(userid){
        $('#userid').val(userid);
        $('#addearnings').modal('show');
    }
    function addearningcount(){
        var earningcount = $('#earningcount').val();
        var userid = $('#userid').val();
        $.ajax({
    		url:'<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addearningcount',
    		method: 'POST',
    		data: {'userid':userid, 'earningcount': earningcount},
    		success:function(data){
    		    if(data == 1) {
    		        $('#addearnings').modal('hide');
    		        $('#snackbar').text('Earnings added successfully').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('Failed to add earnings').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            } 
        });
    }
</script>

<script>
    // storieslist.php
    function storyreports(sid){ // reports
        $.ajax({
    		url:'<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/storyreports/'+sid,
    		method: 'POST',
    		success:function(data){
    		    if(data) {
                    $('#reportmsgsitems').html(data);
                    $('#reportmsgslist').modal('show');
                }else if(data == ''){
                    alert('no data');
                }else{
                    alert('no data');
                }
            } 
        });
    }
    
    function adminchoice(sid){
        $.ajax({
    		url:'<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/adminchoice/'+sid,
    		method: 'POST',
    		success:function(data){
    		    if(data == 1){
    		        console.log('success');
    		    }
            } 
        });
    }
    
    $(document).ready(function(){ // search
        $("#storiessearch").bind("change", function(event){
           var type = $('#type option:selected').val();
           var geners = $('#geners option:selected').val();
           var publishedstatus = $('#publishedstatus option:selected').val();
           var monetisation = $('#monetisation option:selected').val();
            $.ajax({
                url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/storiessearch",
                type: "POST",
                data: {'type':type, 'geners':geners, 'publishedstatus':publishedstatus, 'monetisation':monetisation},
                success: function(result){
                    $("#storiessearchresults").html(result);
                }
            });
        });
    });
    
</script>

<script>
    // reports.php
    $(document).ready(function(){
        $("#reportssearch").bind("change", function(event){
           var reportstype = $('#reportstype').val();
            $.ajax({
                url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/reportstypesearch",
                type: "POST",
                data: {'reportstype':reportstype},
                success: function(result){
                    $("#reportssearchresults").html(result);
                }
            });
        });
    });
    
</script>
<script>
    function monitizeuser(userid){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/monitizeuser",
            type: "POST",
            data: {'userid':userid},
            success: function(result){
                if(result == 1){
                    $('#m'+userid).text('yes');
                    $('#ma'+userid).text('Monetised').addClass('btn btn-primary');
                    $('#snackbar').text('User successfully activated to Monitize.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('User Monetisation failed.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            }
        });
    }
    function unmonitizeuser(userid){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unmonitizeuser",
            type: "POST",
            data: {'userid':userid},
            success: function(result){
                if(result == 1){
                    $('#m'+userid).text('no');
                    $('#ma'+userid).text('Removed').addClass('btn btn-primary');
                    $('#snackbar').text('User successfully de activated to Monitize.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('User de activat Monetisation failed.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            }
        });
    }
</script>
<script> // Stories monitization
    function enablesmonetize(storyid){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/enablesmonetize",
            type: "POST",
            data: {'storyid':storyid},
            success: function(result){
                if(result == 1){
                    $('#s'+storyid).text('yes');
                    $('#sa'+storyid).text('Enabled').addClass('btn btn-primary');
                    $('#snackbar').text('Story successfully activated to Monitize.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('Please add at least one Ads to enable Monetisation.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                }
            }
        });
    }
    
    function adsstory(storyid){
        $('#storyid').val(storyid);
        $('#mstoryads').modal('show');
    }
    function adsstoryscript(){ // add advertisements
        var storyid = $('#storyid').val();
        var adscript = $('textarea#adstext').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/adsstory",
            type: "POST",
            data: {'storyid':storyid, 'adscript': adscript},
            success: function(result){
                if(result == 2){
                    $('#snackbar').text('Please enter Ad script.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else if(result == 1){
                    $('#mstoryads').modal('hide');
                    $('#snackbar').text('Ad added succesfully.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        			setTimeout(function(){ location.reload(); }, 2500);
                }else{
                    $('#snackbar').text('Failed to add Ad').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                }
            }
        });
    }
    function disablesmonetize(storyid){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/disablesmonetize",
            type: "POST",
            data: {'storyid':storyid},
            success: function(result){
                if(result == 1){
                    $('#sa'+storyid).text('Enable');
                    $('#s'+storyid).text('no');
                    $('#sa'+storyid).attr('onClick',"enablesmonetize("+storyid+");");
                    $('#snackbar').text('Successfully removed Story Monetisation.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('Remove all ads before disable Monetisation').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                }
            }
        });
    }
    function removead(ads, storyid){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/removead",
            type: "POST",
            data: {'ads':ads, 'storyid' :storyid},
            success: function(result){
                if(result == 1){
                    $('.'+ads+storyid).text('');
                    $('#snackbar').text('Successfully removed Ad.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('Failed to remove Ad.').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                }
            }
        });
    }
    
    //transreqs.php
    function payment(id){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/payment",
            type: "POST",
            data: {'id':id},
            success: function(result){
                if(result == 1){
                    $('#pay'+id).text('Paid').addClass('btn btn-primary');
                    $('#snackbar').text('Payment Success').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('Payment Failed').addClass('show');
        			setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                }
            }
        });
    }
    
</script>