<style>
.tagpagemaindiv {
  width: 90%;
  display: flex;
  flex-wrap: wrap;
  margin: 0 auto;
  justify-content: center;
}

.tagcards {
  width: 140px;
  text-align: center;
  border-radius: 5px;
  box-shadow: 0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);
  font-family: Arial, Helvetica, sans-serif;
  background: white;
  margin: 10px;
  box-sizing: border-box;
}

.tagtext {
  font-size: 18px;
  line-height: 50px;
  color: #5353ff;
  padding: 0px 5px;
  cursor: pointer;
  white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.tagnumbertext {
  font-size: 12px;
  line-height: 30px;
  background: #efefef;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  color: #9d8f8f;
  padding: 0px 5px;
}

@media screen and (min-width: 1600px){
  .tagpagemaindiv {
     width: 75%;
  }
}

@media screen and (max-width: 620px){
  .tagpagemaindiv {
     width: 100%;
  }
}
</style>
    <?php if(isset($lifeeventtags) && ($lifeeventtags->num_rows() > 0)){ ?>
        <div class="tagpagemaindiv" id="loadmoreall">
            <?php foreach($lifeeventtags->result() as $lifeeventtag) { ?>
                <div class="tagcards">
                    <div class="tagtext"><a href="<?php echo base_url();?>searchresult?type=life&searchtext=<?php echo $lifeeventtag->tagname;?>">#<?php echo $lifeeventtag->tagname;?></a></div>
                    <div class="tagnumbertext"><?php echo $lifeeventtag->tagcount;?> POSTS</div>
                </div>
            <?php } ?>
        </div>
        <div id="load_data_message"></div>
    <?php } ?>
    
<script>
    $(document).ready(function(){
        var limit = 50;
        var start = 50;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url();?>welcome/lifeeventtagsloadmore',
                method:"POST",
                data:{limit:limit, start:start},
                cache:false,
                success:function(data){
                    $('#loadmoreall').append(data);
                    if(data == '') {
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        action = 'active';
                    }else{
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        action = "inactive";
                    }
                }
            });
        }
        if(action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        } 
        $(window).scroll(function(){
            if ($(window).scrollTop() >= (($("#loadmoreall").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 10);
            }
        });
    });
</script>