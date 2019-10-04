<div id="snackbar"></div>
<footer>
    
</footer>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tblpagination').DataTable( {
            "pagingType": "full_numbers",
            "bFilter": false,
            "bInfo": false
        } );
    } );
</script>
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

    //// auserslist.php
    $(document).ready(function(){
        $("#ausersearchsort").bind("change keyup", function(event){
           var search = $('#asearch').val();
           var language = $('#alanguage option:selected').val();
           var emailverify = $('#aemailverify option:selected').val();
           var monetisation = $('#amonetisation option:selected').val();
           var gener = $('#ageners option:selected').val();
           var ausertype = $('#ausertype option:selected').val();
           if(ausertype == 'writers'){
                $.ajax({
                    url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/usersearch",
                    type: "POST",
                    data: {'search':search, 'language':language, 'emailverify':emailverify, 'monetisation':monetisation},
                    success: function(result){
                        $("#ausersearchsortresult").html(result);
                    }
                });
           }else{
                $.ajax({
                    url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/ausersearch",
                    type: "POST",
                    data: {'search':search, 'language':language, 'emailverify':emailverify, 'monetisation':monetisation, 'gener':gener},
                    success: function(result){
                        $("#ausersearchsortresult").html(result);
                    }
                });
            }
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
                    $('#snackbar').text('Admin Choice added success').addClass('show');
                    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    setTimeout(function(){ location.reload(); },3500);
                }else{
                    $('#snackbar').text('Failed to add Admin Choice').addClass('show');
                    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            } 
        });
    }
    function removeadminchoice(sid){
        $.ajax({
            url:'<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/removeadminchoice/'+sid,
            method: 'POST',
            success:function(data){
                if(data == 1){
                    console.log('success');
                    $('#snackbar').text('Admin Choice removed success').addClass('show');
                    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    setTimeout(function(){ location.reload(); },3500);
                }else{
                    $('#snackbar').text('Failed to remove Admin Choice').addClass('show');
                    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            } 
        });
    }
    
    $(document).ready(function(){ // search
        $("#storiessearch").bind("change keyup", function(event){
            var search = $('#searchstory').val();
            var type = $('#type option:selected').val();
            var geners = $('#geners option:selected').val();
            var publishedstatus = $('#publishedstatus option:selected').val();
            var monetisation = $('#monetisation option:selected').val();
            $.ajax({
                url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/storiessearch",
                type: "POST",
                data: {'type':type, 'geners':geners, 'publishedstatus':publishedstatus,'monetisation':monetisation,'search':search},
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

    //scanalytics.php
    function languagecount(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/scanalyticslang",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                if(result != '' || result != 0){
                    var scanalytics = '';
                    $.each(result,function (p,q){
                        scanalytics+= '<div class="tagcards"><div class="tagtext"><a href="javascript:void(0);">'+q.type+'</a></div><div class="tagnumbertext">'+q.storiescount+'</div></div>';
                    });
                    $('.tagpagemaindiv').html(scanalytics);
                }
            }
        });
    }

    //scgenres.php
    function scgenres(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/scgenreslang",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                console.log(result);
                var scgenre=''; var scgenres_story=''; var scgenres_series='';
                if(result.stories != '' || result.stories != 0){
                    var scgenres_story = '<h3>All Stories Genre Counts</h3>'+
                    '<div class="tagpagemaindiv">';
                    $.each(result.stories,function (p,q){
                        scgenres_story+= '<div class="tagcards"><div class="tagtext"><a href="javascript:void(0);">'+q.gener+'</a></div><div class="tagnumbertext">'+q.storiescount+'</div></div>';
                    });
                    scgenres_story+= '</div></div>';
                }
                if(result.series != '' || result.series != 0){
                    var scgenres_series = '<h3>All Series Genre Counts</h3>'+
                    '<div class="tagpagemaindiv">';
                    $.each(result.series,function (p,q){
                        scgenres_series+= '<div class="tagcards"><div class="tagtext"><a href="javascript:void(0);">'+q.gener+'</a></div><div class="tagnumbertext">'+q.storiescount+'</div></div>';
                    });
                    scgenres_series+= '</div></div>';
                }
                scgenre = scgenres_story+scgenres_series;
                $('.scgenreslang').html(scgenre);
            }
        });
    }
    
</script>