<script src="<?php echo base_url();?>assets/dist/js/js/jquery.Jcrop.min.js"></script>
<style>
*{
    -webkit-tap-highlight-color:  transparent; 
}
body{
    background: rgb(238, 238, 238);
}
.settings{
    min-width: 856px;
    width: 60%;
    max-width: 1050px;
    border-radius: 3px;
    margin: 50px auto;
    font-family: "Arial", sans-serif;
}
.inner-settings{
    background: white;
    padding: 10px;
    box-sizing: border-box;
    box-shadow: 0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);
    border-radius: 3px;
    margin: 30px 0;
}

.inner-settings h3, .community-heading{
    font-size: 22px;
    margin: 0;
}

.inner-settings hr{
    border: 0;
    height: 1px;
    background: #ddd;
    margin-bottom: 20px;
    width: 100%;
}

.inner-settings textarea{
    margin: 10px 0 15px 0;
    padding: 10px;
    resize: none;
    width: 100%;
    height: 125px;
    box-sizing: border-box;
    font-size: 16px;
    line-height: 26px;
    border: 1px solid #ddd;
    font-family: "Arial", sans-serif;
    overflow-y: auto;
    background-clip: padding-box;
}

.inner-settings input, .inner-settings select{
    margin: 10px 0 20px 0;
    box-sizing: border-box;
    width: 100%;
    border: 1px solid #ddd;
    height: 50px;
    font-size: 20px;
    padding: 0px 10px;
    background: transparent;
    background-clip: padding-box;
}

.update-btn-div{
    text-align: center;
}

.update-btn-div button{
    border: none;
    background: #3c8dbc;
    color: white;
    height: 40px;
    font-size: 15px;
    width: 130px;
    border-radius: 3px;
    margin-bottom: 10px;
    cursor: pointer;
}

.selected-community-div{
    text-align: center;
}

.community-btn-selected{
    padding: 10px;
    text-align: center;
    max-width: 163px;
    background: #3c8dbc;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    color: white;
    margin: 8px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    display: inline-block;
}

.email-verification-btn, .edit-btn-communities, .username-change-btn{
    float: right;
    color: #3c8dbc;
    cursor: pointer;
}

.edit-btn-communities{
    line-height: 28px;
} 

.private-public-btn{
    display: flex;
    padding-top: 4px;
    float: right;
    cursor: pointer;
}

.private-public-btn input{
    margin: 0 0 0 10px;
    height: 18px;
    width: 18px;
}

@media screen and (max-width:870px){
    .settings{
        min-width: 100%;
        width: 100%;
        max-width: 100%;
    }
    .inner-settings h3, .community-heading{
        font-size: 18px;
    }
    .inner-settings input, .inner-settings select{
        font-size: 17px;
    }
    .edit-btn-communities{
        line-height: 20px;
    }
    .private-public-btn{
        padding-top: 0;
    }
}
</style>

    
<?php $writerlanguage = ''; if(isset($editprofile) && ($editprofile->num_rows()>0)){ foreach($editprofile->result() as $row){ 
        $writerlanguage = $row->writer_language; ?>
<div class="wrapper">
    <div class="" style="padding:0px;">
        <form action="<?php echo base_url().$this->uri->segment(1);?>/updateprofile/<?php echo $row->user_id;?>" method="POST" enctype="multipart/form-data" id="updateform">
            <section class="content"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-widget widget-user-2">
                            <?php if(isset($row->banner_image) && !empty($row->banner_image)) { ?>
                            <div class="widget-user-header" style="padding:0; background: url('<?php echo base_url();?>assets/images/<?php echo $row->banner_image; ?>') center center; background-repeat: no-repeat; background-size: auto;  background-size: cover;" id="blah">
                                <div style="height:250px; background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 60px 30px;">
                                    <div class="widget-user-image" style="float:left;">
                                        <?php if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                        <label class="" style="background:none; color:#fff;" for="upload-file-profile">
                                            <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" style="width:75px;height:75px;" alt="<?php echo $row->name; ?>">
                                            <input id="upload-file-profile" name="profile_image" type="file">
                                            <span style="padding:8px; border:1px solid #ddd; cursor:pointer;float:right;margin-top:17px;margin-left:12px;" class="btnspinner"><i class="fa fa-image"></i> Profile Photo</span>
                                        </label>
                                        <?php } else { ?>
                                        <label class="" style="background:none;color:#fff;" for="upload-file-profile">
                                            <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:75px;height:75px;" alt="<?php echo $row->name; ?>">
                                            <input id="upload-file-profile" name="profile_image" type="file">
                                            <span style="padding:10px; border:1px solid #ddd; cursor:pointer;float:right;margin-top:17px;margin-left:12px;" class="btnspinner"><i class="fa fa-image"></i> Profile Photo</span>
                                        </label>
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                        <label class="pull-left" style="padding-left:5%;">
                                            <a href="<?php echo base_url().$this->uri->segment(1);?>/removeprofilepic/<?php echo $row->user_id;?>" class="btn btn-default">Remove</a>
                                        </label>
                                    </div>
                                    
                                    <label class="" style="background:none!important; color:#fff; float:right; margin-top: 35px;" for="upload-file-selector">
                                        <input id="upload-file-selector" name="banner_image" type="file">
                                        <span style="padding:10px; border:1px solid #ddd; cursor:pointer;" class="btnspinnerc"><i class="fa fa-image"></i> Cover Photo</span> 
                                    </label>
                                    <label class="pull-right" style="margin: -15px -100px 0px 0px;">
                                        <a href="<?php echo base_url().$this->uri->segment(1);?>/removeprofilecover/<?php echo $row->user_id;?>" class="btn btn-default">Remove</a>
                                    </label>
                                </div>
                            </div>
                            <?php } else{ ?>
                            <div class="widget-user-header" style="padding:0; background: linear-gradient(-60deg,RoyalBlue,brown); background-repeat: no-repeat; background-size: auto;  background-size: cover;" id="blah">
                                <div style="height:250px; background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 60px 30px;">
                                    <div class="widget-user-image" style="float:left;">
                                        <?php if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                        <label class="" style="background:none; color:#fff;" for="upload-file-profile">
                                            <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" style="width:75px;height:75px;" alt="<?php echo $row->name; ?>">
                                            <input id="upload-file-profile" name="profile_image" type="file">
                                            <span style="padding:10px; border:1px solid #ddd; cursor:pointer;float:right;margin-top:17px;margin-left:12px;" class="btnspinner"><i class="fa fa-image"></i> Profile Photo</span>
                                        </label>
                                        <?php } else { ?>
                                        <label class="" style="background:none; color:#fff;" for="upload-file-profile">
                                            <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:75px;height:75px;" alt="<?php echo $row->name; ?>">
                                            <input id="upload-file-profile" name="profile_image" type="file">
                                            <span style="padding:10px; border:1px solid #ddd; cursor:pointer;float:right;margin-top:17px;margin-left:12px;" class="btnspinner"><i class="fa fa-image"></i> Profile Photo</span>
                                        </label>
                                        <?php } ?>
                                        <label class="pull-left" style="padding-left:5%;">
                                            <a href="<?php echo base_url().$this->uri->segment(1);?>/removeprofilepic/<?php echo $row->user_id;?>" class="btn btn-default">Remove</a>
                                        </label>
                                    </div>
                                    <label class="" style="background:none!important; color:#fff; float:right; margin-top: 35px;" for="upload-file-selector">
                                        <input id="upload-file-selector" name="banner_image" type="file">
                                        <span style="padding:10px; border:1px solid #ddd; cursor:pointer;" class="btnspinnerc"><i class="fa fa-image"></i> Cover Photo</span> 
                                    </label>
                                    <label class="pull-right" style="margin: -15px -100px 0px 0px;">
                                        <a href="<?php echo base_url().$this->uri->segment(1);?>/removeprofilecover/<?php echo $row->user_id;?>" class="btn btn-default">Remove</a>
                                    </label>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-10 col-xs-10 col-md-10">
                                    <center><?php echo $this->session->flashdata('editmsg');?></center>
                                    </div>
                                <div class="col-sm-2 col-xs-2 col-md-2">
                                    <div class="description-block" style="float:right">
                                        <button type='submit' name='edit' class='btn btn-primary'> Update profile </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
            </section>
            <div class="settings">
                <div class="inner-settings">
                    <h3>GENERAL INFO</h3>
                    <hr>
                    <div>
                        <label>ABOUT : </label>
                    </div>
                    <textarea id="editor1" name="aboutus" rows="10" cols="35" required placeholder="Introduce Yourself..." style="resize:none"> <?php echo $row->aboutus; ?> </textarea>
                    <div>
                        <label>FULL NAME : </label>
                    </div>
                    <input placeholder="Enter Your Name..." type="text" name="name" required="" value="<?php echo $row->name; ?>">
                    <div>
                        <label>USER NAME : </label><a class="username-change-btn">CHANGE</a>
                    </div>
                    <input type="text" placeholder="Enter Username" value="<?php echo $row->profile_name; ?>" name="username" <?php if($row->pfnamestatus != 'updated'){ ?>id="username" <?php }else{ ?> readonly <?php } ?>>
                    <span class="text-danger username"></span>
                    <div>
                        <label>SELECT GENDER : </label>
                    </div>
                    <select class="form-control" name="gender" required="">
                        <option value="null" selected disabled hidden>Select Your Gender</option>
                        <option value="male" <?php if($row->gender == 'male'){echo 'selected';} ?>>Male</option>
                        <option value="female" <?php if($row->gender == 'female'){echo 'selected';} ?>>Female</option>
                        <option value="others" <?php if($row->gender == 'others'){echo 'selected';} ?>>Others</option>
                    </select>
                    <div><label>DATE OF BIRTH : </label></div>
                    <input type="date" name="dob" value="<?php echo $row->dob; ?>">
                    <div class="update-btn-div"><button>UPDATE INFO</button></div>
                </div>
                <div class="inner-settings">
                    <div>
                        <span class="community-heading"><b>CONTACT INFO</b></span>
                        <span class="private-public-btn">PRIVATE : <input type="checkbox" name="private" value=""></span>
                    </div>
                    <hr>
                    <div>
                        <label>EMAIL ID : </label>
                        <a class="email-verification-btn">Verify Your E-mail</a>
                    </div>
                    <input type="email" placeholder="Enter Your Email Id..." value="<?php echo $row->email; ?>" name="email">
                    <div>
                        <label>MOBILE NUMBER : </label>
                    </div>
                    <input type="number" placeholder="Enter Your Mobile Number..." value="<?php echo $row->phone; ?>" name="phone" maxlength="10" onkeypress="return NumbersOnly(this,event)">
                    <div class="update-btn-div"><button>UPDATE INFO</button></div>
                </div>
            </form>
                <?php $selectedlang = get_langshortname($this->uri->segment(1)); ?>
                <div class="inner-settings">
                    <div>
                        <span class="community-heading"><b>PREFERRED GENRES</b></span>
                        <a class="edit-btn-communities" href="javascript:void(0);" data-toggle="modal" data-target="#choosecommunitypedit">EDIT</a>
                    </div>
                    <hr>
                    <div class="selected-community-div">
                        <?php if(isset($geners) && ($geners->num_rows() > 0)){ foreach($geners->result() as $gener) { 
                            if(isset($usercomms) && in_array($gener->gener, $usercomms)) { ?>
                            <a class="community-btn-selected removegenre<?php echo $gener->gener; ?>" onclick="removegenre('<?php echo $gener->gener; ?>', '<?php echo $selectedlang;?>')">
                                <?php echo $gener->gener; ?> <span class="pull-right" title="Delete"> X </span>
                            </a>
                        <?php } } } ?>
                        <!--<p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
                        <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
                        <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
                        <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
                        <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
                        <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
                        <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
                        <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>-->
                    </div>
                </div>
                <div class="inner-settings">
                    <div>
                        <span class="community-heading"><b>PREFERRED LANGUAGE</b></span>
                        <a class="edit-btn-communities" href="javascript:void(0);" data-toggle="modal" data-target="#chooselanguagepedit">EDIT</a>
                    </div>
                    <hr>
                    <div class="selected-community-div">
                        <?php if(isset($languages) && ($languages->num_rows() > 0)) { foreach($languages->result() as $language) { 
                            if(isset($row->writer_language) && ($language->code == $row->writer_language)){ ?>
                            <p class="community-btn-selected"><?php echo $language->language; ?></p>
                        <?php } } } ?>
                        <!--<p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>-->
                    </div>
                </div>
                <div class="inner-settings">
                    <h3>CHANGE PASSWORD</h3>
                    <span class="cpwderror"><?php echo $this->session->flashdata('msg'); ?></span>
                    <hr>
                    <div>
                        <label>CURRENT PASSWORD : </label>
                    </div>
                    <input placeholder="Enter Current Password..." type="password" name="oldpassword" id="oldpassword" >
                    <span class="text-danger oldpassword"><?php echo form_error('oldpassword'); ?></span>
                    <div>
                        <label>NEW PASSWORD : </label>
                    </div>
                    <input placeholder="Enter New Password..." type="password" name="password" id="password" >
                    <span class="text-danger password"><?php echo form_error('password'); ?></span>
                    <div>
                        <label>CONFIRM PASSWORD : </label>
                    </div>
                    <input placeholder="Confirn New Password..." type="password" name="repassword" id="repassword" >
                    <span class="text-danger repassword"><?php echo form_error('repassword'); ?></span>
                    <div class="update-btn-div"><button onclick="changepassword()">UPDATE</button></div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="cslangp" value="<?php echo $selectedlang;?>">
    <input type="hidden" id="useridp" value="<?php echo $row->user_id;?>">
<?php } } ?>

<div id="emailverify" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4>Verification Code Sent to your registered Email. <br>Check Your Inbox and Verify.</h4></center>
            </div>
        </div>
    </div>
</div>

<div id="que" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4>You Can Change your Username Only Once.</h4></center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="choosecommunitypedit">
    <div class="modal-dialog modalv">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h5titile">PREFEfdgfdgfdgfdgfdgRRED GENRES
                <span class="pull-right"><button type="button" class="close" data-dismiss="modal">&times;</button></span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 0px;">
                    <center>
                        <form id="choosecommupedit" method="POST">
                            <div  style="height:250px; overflow-y:scroll">
                            <?php if(isset($geners) && ($geners->num_rows() > 0)){ foreach($geners->result() as $gener) { ?>
                                <div class="col-md-4">
                                    <?php if(in_array($gener->gener, $usercomms)){ ?>
                                    <label class="btn btn-primary btn-block choosecomm" style="padding: 10px 5px 10px 0px; font-size:17px;margin-bottom:5px;" id="<?php echo $gener->id;?>">
                                        <input type="checkbox" class="checkbox<?php echo $gener->id;?>" name="choosecomm[]" value="<?php echo $gener->id;?>" style="height:1px;" checked="checked"><?php echo $gener->gener; ?>
                                    </label>
                                    <?php } else{ ?>
                                    <label class="btn btn-default btn-block choosecomm" style="padding: 10px 5px 10px 0px; font-size:17px;margin-bottom:5px;" id="<?php echo $gener->id;?>">
                                        <input type="checkbox" class="checkbox<?php echo $gener->id;?>" name="choosecomm[]" value="<?php echo $gener->id;?>" style="height:1px;"><?php echo $gener->gener; ?>
                                    </label>
                                    <?php } ?>
                                </div>
                            <?php } } ?>
                            </div>
                            <div class="col-xs-12"><br>
                                <button type="submit" class="btn btn-primary choosecommsave"> Save </button>
                            </div>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chooselanguagepedit">
    <div class="modal-dialog modalv">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h5titile">PREFERRED LANGUAGE
                <span class="pull-right"><button type="button" class="close" data-dismiss="modal">&times;</button></span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 0px;">
                    <center>
                        <form id="chooselangpedit" action="#" method="POST">
                            <div style="height:250px; overflow-y:scroll">
                                <?php if(isset($languages) && ($languages->num_rows() >0)) { foreach ($languages->result() as $language) { ?>
                                    <div class="col-md-4">
                                        <a href="javascript:void(0);" class="btn btn-default btn-block community-btn langbtn <?php echo $language->code;?>" onclick="chooselangpbtn('<?php echo $language->code;?>')" 
                                            style="<?php if($writerlanguage == $language->code){ echo 'background:#3c8dbc; color:#FFF;'; } else { echo 'background: #fff;'; } ?>padding: 5px;margin-bottom:5px;border: 1px solid #adadad;width: 100%;">
                                            <?php echo $language->language; ?>
                                        </a>
                                    </div>
                                <?php } } ?>
                                <input type="hidden" id="plang" value="<?php echo $writerlanguage;?>">
                            </div>
                            <div class="col-xs-12"><br>
                                <button type="submit" class="btn btn-primary chooselangsave"> Save </button>
                            </div>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="upload_profileimg" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Profile Image (You Can Crop)</h4>
            </div>
            <div class="modal-body" id="cropboxmodaldiv"> </div>
            <div class="modal-footer"> </div>
        </div>
    </div>
</div>

<script>
    function useremailstatus(uemailstatus) {
        if(uemailstatus == 'private'){
            $('#uemailstatus').attr('checked','true');
            $('#uemailstatus').val('public');
            $('span.uemailstatus').text('Public');
        }else{
            $('#uemailstatus').attr('checked', false);
            $('#uemailstatus').val('private');
            $('span.uemailstatus').text('Private');
        }
    }
    
    function userphonestatus(uphonestatus) {
        if(uphonestatus == 'private'){
            $('#uphonestatus').attr('checked','true');
            $('#uphonestatus').val('public');
            $('span.uphonestatus').text('Public');
        }else{
            $('#uphonestatus').attr('checked', false);
            $('#uphonestatus').val('private');
            $('span.uphonestatus').text('Private');
        }
    }
    
    $("#username").keyup(function() {
        var username = $(this).val();
        $.ajax({
            url: "<?php echo base_url().$this->uri->segment(1);?>/username",
            type: 'POST',
            data: {'username': username},
            success: function (resultdata) {
                if(resultdata == 1){
                     $('.username').text('Username available. Click on Update.');
                }else if(resultdata == 2){
                     $('.username').text('The Username field is required.');
                }else if(resultdata == 3){
                     $('.username').text('Username should be at least 5 characters.');
                }else if(resultdata == 4){
                     $('.username').text('Username already taken. Choose another.');
                }
            }
        });
    });
    
     $("span.profile_name").on('click',function() {
        var username = $('#username').val();
        $.ajax({
            url: "<?php echo base_url().$this->uri->segment(1);?>/updateusername",
            type: 'POST',
            data: {'username': username},
            success: function (resultdata) {
                console.log(resultdata);
                if(resultdata == 1){
                    $('.username').text('Updated Success!');
                }else if(resultdata == 2){
                    $('.username').text('The Username field is not empty.');
                }else if(resultdata == 3){
                    $('.username').text('Username already taken. Try with another.');
                }else if(resultdata == 4){
                    $('.username').text('Failed to update Username.');
                }
            }
        });
    });
    
    $("span.profile_email").on('click',function() {
        var useremail = $('#useremail').val();
        $.ajax({
            url: "<?php echo base_url().$this->uri->segment(1);?>/resendemail",
            type: 'POST',
            data: {'email': useremail},
            dataType: 'json',
            success: function (resultdata) {
                $('#emailverify').modal('show');
                console.log(resultdata);
            }
        });
    });

    function changepassword(){
        var oldpassword = $('#oldpassword').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        var profileid = "<?php echo $this->session->userdata['logged_in']['user_id'];?>";
        $('span.text-danger').html(' ');
        $.ajax({
            url: "<?php echo base_url().$this->uri->segment(1);?>/changepassword",
            type: "post",
            data: {'oldpassword': oldpassword, 'password': password, 'repassword': repassword },
            success: function(resultdata) {
                var result=JSON.parse(resultdata);
               if(result.status == -1){
                    $.each(result.validations,function (p,q){
                        $('span.'+p).text(q);
                    });
                }else if((result.status == 1) && (result.response == 'success')){
                    location.href = "<?php echo base_url().$this->uri->segment(1);?>/my_profile/"+profileid;
                }else if((result.status == 2) && (result.response == 'wrongoldpwd')){
                    $('span.oldpassword').text('Please Enter Correct Old Password.');
                }else {
                    $('span.cpwderror').text(' Password Change Request Failed. Try Again');
                }
            }
        });
    }
    
    function removegenre(genre, language){
        $('.deletemessage').html('Are You Sure? Do you want to delete.');
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
            $.ajax({
                url: "<?php echo base_url().$this->uri->segment(1);?>/unchoosecommu/bynamelang",
                type: 'POST',
                data: {'genre': genre, 'language':language},
                success: function (resultdata) {
                    if(resultdata){
                        $('.removegenre'+genre).css('display','none');
                        $('#snackbar').text('prefered gener deleted successfully.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                    }
                }
            });
        });
    }
    
    function chooselangpbtn(language){
        $('#plang').val(language);
        $('.langbtn').css('background','#fff');
        $('.langbtn').css('color','#000');
        $('.'+language).css('background','#3c8dbc');
        $('.'+language).css('color','#fff');
    }
    $( "form#chooselangpedit" ).submit(function( event ) {
        event.preventDefault();
        var planguage = $('#plang').val();
        var userid = $('#useridp').val();
        if(planguage){
            $.ajax({
                url: "<?php echo base_url().$this->uri->segment(1);?>/chooselanguage",
                type: 'POST',
                data: {'choselanguage': planguage, 'userid':userid },
                success: function (resultdata) {
                    if(resultdata){
                        $('#snackbar').text('prefered Language updated successfully.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                        setTimeout(function(){ location.reload(); }, 1000);
                    }
                }
            });
        }
    });

    $( document ).ready(function() {
        var commids = [];
        $('.choosecomm').on('click', function(){
           var chosenid = $(this).attr('id');
            if($('.checkbox'+chosenid).prop('checked')){
                commids.push(chosenid);
                $(this).removeClass('btn-default').addClass('btn-primary').css({"background":"#3c8dbc", "color": "#fff"});
            }else if($('#'+chosenid).hasClass('btn-primary')){
                $('#'+chosenid).removeClass('btn-primary').addClass('btn-default').css({"background":"#fff", "color":"#000"});
                $('.checkbox'+chosenid).prop('checked',false);
            }
            var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
            if(choosecommcount >= 2){
                $('.choosecommsave').css({"display":"block", "background":"#3c8dbc", "color": "white"});
            }else{
                $('.choosecommsave').css({"display":"block!important", "background":"#fff", "color": "#fff"});
            }
        });
        
            //Sign up choose communities
        $( "form#choosecommupedit" ).submit(function( event ) {
            event.preventDefault();
            var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
            var cslangp = $('#cslangp').val();
            var useridp = $('#useridp').val();
            if(choosecommcount >= 2){
                $.ajax({
                    url: "<?php echo base_url().$this->uri->segment(1);?>/choosecommu",
                    type: 'POST',
                    data: {'commids': commids, 'cslang': cslangp, 'userid':useridp },
                    success: function (resultdata) {
                        $('#snackbar').text('prefered communities updated successfully.').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                        setTimeout(function(){ location.reload(); }, 500);
                    }
                });
            }else{
                $('.choosecommsave').css('display','none');
            }
        });
    });
</script>

<script type="text/javascript">
    $("#upload-file-profile").change(function() {
        $('.btnspinner').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
        var $formData = new FormData();
        $formData.append('profileimg', $("#upload-file-profile").get(0).files[0]);
        $.ajax({
            url: "<?php echo base_url().$this->uri->segment(1);?>/upload_profileimg",
            type: 'POST',
            data: $formData,
            processData: false,
            contentType: false,
            success: function (resultdata) {
                if(resultdata){
                   $('#cropboxmodaldiv').html(resultdata);
                    //$('#cropbox').removeAttr('src');
                    //$('#cropbox').attr('src',resultdata);
                    $('#upload_profileimg').modal('show');
                }else{
                    $('#upload_profileimg').modal('show');
                }
                $('.btnspinner').html('Profile Image');
            }
        });
    });
    $("#upload-file-selector").change(function() {
        var $formData = new FormData();
        var bannerimage = $("#upload-file-selector").get(0).files[0];
        if(bannerimage.name){
            $('#updateform').submit();
        }
    });
</script>