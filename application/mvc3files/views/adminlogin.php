<style type="text/css">
    body, html {
        background-repeat: no-repeat;
        background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
    }

    .card-container.card {
        max-width: 300px;
        padding: 40px 40px;
    }

    .btn {
        font-weight: 700;
        height: 36px;
        -moz-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        cursor: default;
    }

    /*
     * Card component
     */
    .card {
        background-color: #F7F7F7;
        /* just in case there no content*/
        padding: 20px 25px 30px;
        margin: 0 auto 25px;
        margin-top: 50px;
        /* shadows and rounded borders */
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

    .profile-img-card {
        width: 96px;
        height: 96px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }

    .form-signin .inputEmail,
    .form-signin .inputPassword {
        direction: ltr;
        height: 44px;
        font-size: 16px;
    }

    .form-signin input[type=email],
    .form-signin input[type=password],
    .form-signin input[type=text],
    .form-signin button {
        width: 100%;
        display: block;
        margin-bottom: 20px;
        z-index: 1;
        position: relative;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin .form-control:focus {
        border-color: rgb(104, 145, 162);
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    }

    .btn.btn-signin {
        /*background-color: #4d90fe; */
        background-color: rgb(104, 145, 162);
        /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
        padding: 0px;
        font-weight: 700;
        font-size: 14px;
        height: 36px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        border: none;
        -o-transition: all 0.218s;
        -moz-transition: all 0.218s;
        -webkit-transition: all 0.218s;
        transition: all 0.218s;
    }

    .btn.btn-signin:hover,
    .btn.btn-signin:active,
    .btn.btn-signin:focus {
        background-color: rgb(12, 97, 33);
    }
</style>
<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" /> <br>
        <span class="text-danger msg"></span>
        <form class="form-signin" method="POST" action="#" id="adminlogin">
            
            <input type="email" id="aemail" name="aemail" class="inputEmail form-control" placeholder="Email address" required autofocus>
            <span class="text-danger aemail"></span>

            <input type="password" id="apassword" name="apassword" class="inputPassword form-control" placeholder="Password" required>
            <span class="text-danger apassword"></span>
            
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>

        </form>

    </div>
</div>
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $( "form#adminlogin" ).submit(function( event ) {
        event.preventDefault();
        $.post("<?php echo base_url();?>welcome/adminlogin",$("form#adminlogin").serialize(),function(resultdata, status) {
            $('span.text-danger').empty();
            var result=JSON.parse(resultdata);
            if(result.status == -1){
                $.each(result.validations,function (p,q){
                    $('span.'+p).text(q);
                });
            }else if((result.status == 1) && (result.response == 'success')){
                location.href = "<?php echo base_url(); ?>aenglish/index";
            }else{
                $('.msg').html('Entered wrong username or password');
            }
        });
    });
</script>