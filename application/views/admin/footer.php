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
                //console.log(result);
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

    function scprofile(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/scprofilelang",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                if(result != '' || result != 0){
                    var scanalytics = '';
                    $.each(result,function (p,q){
                        scanalytics+= '<div class="tagcards"><div class="tagtext"><a href="javascript:void(0);">User Count</a></div><div class="tagnumbertext">'+q.pcount+'</div></div>';
                    });
                    $('.scprofile').html(scanalytics);
                }
            }
        });
    }

    function sctags(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/sctagscountlang",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                if(result != '' || result != 0){
                    var scanalytics = '';
                    $.each(result,function (p,q){
                        scanalytics+= '<div class="tagcards"><div class="tagtext"><a href="javascript:void(0);">Life Event Tags</a></div><div class="tagnumbertext">'+q.tagscount+'</div></div>';
                    });
                    $('.tagpagemaindiv').html(scanalytics);
                }
            }
        });
    }
    
    function scmvstories(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/scmvstorieslang",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                var scmvstories=''; 
                var scmvstories_series=''; var scmvstories_story='';
                var scmvstories_life=''; var scmvstories_nano='';
                if(result.series != '' || result.series != 0){
                    var scmvstories_series = '<h3>Series in a Week</h3><div class="tagpagemaindiv">';
                    $.each(result.series,function (p,q){
                        scmvstories_series+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">'+q.title+'</a></div><div class="tagnumbertext">'+q.week_views+'</div></div>';
                    });
                    scmvstories_series+= '</div>';
                }
                if(result.story != '' || result.story != 0){
                    var scmvstories_story = '<h3>Stories in a Week</h3><div class="tagpagemaindiv">';
                    $.each(result.story,function (p,q){
                        scmvstories_story+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">'+q.title+'</a></div><div class="tagnumbertext">'+q.week_views+'</div></div>';
                    });
                    scmvstories_story+= '</div>';
                }
                if(result.life != '' || result.life != 0){
                    var scmvstories_life = '<h3>Life events in a Week</h3><div class="tagpagemaindiv">';
                    $.each(result.life,function (p,q){
                        scmvstories_life+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">'+q.title+'</a></div><div class="tagnumbertext">'+q.week_views+'</div></div>';
                    });
                    scmvstories_life+= '</div>';
                }
                if(result.nano != '' || result.nano != 0){
                    var scmvstories_nano = '<h3>Nano Stories in a Week</h3><div class="tagpagemaindiv">';
                    $.each(result.nano,function (p,q){
                        scmvstories_nano+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">'+q.story+'</a></div><div class="tagnumbertext">'+q.week_views+'</div></div>';
                    });
                    scmvstories_nano+= '</div>';
                }
                
                scmvstories = scmvstories_series+scmvstories_story+scmvstories_life+scmvstories_nano+'</div>';
                $('.scmvstories').html(scmvstories);
            }
        });
    }

    function scstorieswmy(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/scstorieswmy",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                var serieswmy = ''; var storieswmy = '';
                var lifewmy = ''; var nanowmy = '';

                if(result.seweek != '' || result.seweek != 0){
                    $.each(result.seweek,function (p,q){
                        serieswmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Week</a></div><div class="tagnumbertext">'+q.secount+'</div></div>';
                    });
                    serieswmy+= '</div>';
                }
                if(result.semonth != '' || result.semonth != 0){
                    $.each(result.semonth,function (p,q){
                        serieswmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Month</a></div><div class="tagnumbertext">'+q.secount+'</div></div>';
                    });
                    serieswmy+= '</div>';
                }
                if(result.seyear != '' || result.seyear != 0){
                    $.each(result.seyear,function (p,q){
                        serieswmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Year</a></div><div class="tagnumbertext">'+q.secount+'</div></div>';
                    });
                    serieswmy+= '</div>';
                }
                $('.serieswmy').html(serieswmy);

                if(result.sweek != '' || result.sweek != 0){
                    $.each(result.sweek,function (p,q){
                        storieswmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Week</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    storieswmy+= '</div>';
                }
                if(result.smonth != '' || result.smonth != 0){
                    $.each(result.smonth,function (p,q){
                        storieswmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Month</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    storieswmy+= '</div>';
                }
                if(result.syear != '' || result.syear != 0){
                    $.each(result.syear,function (p,q){
                        storieswmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Year</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    storieswmy+= '</div>';
                }
                $('.storieswmy').html(storieswmy);

                if(result.lweek != '' || result.lweek != 0){
                    $.each(result.lweek,function (p,q){
                        lifewmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Week</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    lifewmy+= '</div>';
                }
                if(result.lmonth != '' || result.lmonth != 0){
                    $.each(result.lmonth,function (p,q){
                        lifewmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Month</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    lifewmy+= '</div>';
                }
                if(result.lyear != '' || result.lyear != 0){
                    $.each(result.lyear,function (p,q){
                        lifewmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Year</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    lifewmy+= '</div>';
                }
                $('.lifewmy').html(lifewmy);

                if(result.nweek != '' || result.nweek != 0){
                    $.each(result.nweek,function (p,q){
                        nanowmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Week</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    nanowmy+= '</div>';
                }
                if(result.nmonth != '' || result.nmonth != 0){
                    $.each(result.nmonth,function (p,q){
                        nanowmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Month</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    nanowmy+= '</div>';
                }
                if(result.nyear != '' || result.nyear != 0){
                    $.each(result.nyear,function (p,q){
                        nanowmy+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Year</a></div><div class="tagnumbertext">'+q.scount+'</div></div>';
                    });
                    nanowmy+= '</div>';
                }
                $('.nanowmy').html(nanowmy);
            }
        });
    }

    function scusercount(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/scuserscountlang",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                var scusercount = ''; 
                if(result.uweek != '' || result.uweek != 0){
                    $.each(result.uweek,function (p,q){
                        scusercount+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Week</a></div><div class="tagnumbertext">'+q.pcount+'</div></div>';
                    });
                    scusercount+= '</div>';
                }
                if(result.umonth != '' || result.umonth != 0){
                    $.each(result.umonth,function (p,q){
                        scusercount+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Month</a></div><div class="tagnumbertext">'+q.pcount+'</div></div>';
                    });
                    scusercount+= '</div>';
                }
                if(result.uyear != '' || result.uyear != 0){
                    $.each(result.uyear,function (p,q){
                        scusercount+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Year</a></div><div class="tagnumbertext">'+q.pcount+'</div></div>';
                    });
                    scusercount+= '</div>';
                }
                $('.scusercount').html(scusercount);
            }
        });
    }

    function sctotalviews(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/sctotalviewslang",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                if(result.views != '' || result.views != 0){
                    var scviews = ''; 
                    $.each(result.views,function (p,q){
                        scviews+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">'+q.type+'</a></div><div class="tagnumbertext">'+q.totalviewcount+'</div></div>';
                    });
                    scviews+= '</div>';
                    $('.scviews').html(scviews);
                }
                if(result.uqviews != '' || result.uqviews != 0){
                    var scuviews = '';
                    $.each(result.uqviews,function (p,q){
                        scuviews+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">'+q.type+'</a></div><div class="tagnumbertext">'+q.uniqueviewcount+'</div></div>';
                    });
                    scuviews+= '</div>';
                }
                $('.scuviews').html(scuviews);

                if(result.emailvcount != '' || result.emailvcount != 0){
                    var everified = '';
                    $.each(result.emailvcount,function (p,q){
                        everified+= '<div class="tagcards"> <div class="tagtext"><a href="javascript:void(0);">Emails Verified</a></div><div class="tagnumbertext">'+q.evcount+'</div></div>';
                    });
                    everified+= '</div>';
                }
                $('.everified').html(everified);
            }
        });
    }

    function scblogs(lang){
        $.ajax({
            url: "<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/scblogslang",
            type: "POST",
            data: {'lang':lang},
            dataType: "json",
            success: function(result){
                if(result.noofblogs != '' || result.noofblogs != 0){
                    var scblogs = '';
                    $.each(result.noofblogs,function (p,q){
                        scblogs+= '<div class="tagcards"><div class="tagtext"><a href="javascript:void(0);">Blogs Count</a></div><div class="tagnumbertext">'+q.blogcount+'</div></div>';
                    });
                    $('.tagpagemaindiv').html(scblogs);
                }
            }
        });
    }
</script>