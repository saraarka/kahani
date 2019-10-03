<style>
    html { 
        background: url(<?php echo base_url();?>assets/landing/images/errorvj.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    body{
        padding-top:60px;
        padding-bottom:0px;
    }
    .main-content{
        position: fixed;
        top: 50%;
        left: 50%;
        margin-top: -100px;
        margin-left: -100px;
    }
    .img-error{
        max-width:250px;
    }
    .backto:hover{
        background: linear-gradient(-60deg, #c471ed,#f64f59);
    }
    .backto{
        border-radius: 5px;
        background: linear-gradient(-60deg, #f64f59,#c471ed);
        color: white;
        width: auto;
        border: none;
        cursor: pointer;
        outline: none;
        padding: 15px 10px 15px 10px;
        margin-bottom: 10px;
        margin-top: 30px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
        font-size: 16px;
        font-family: 'Nunito', sans-serif;
    }
    @media screen and (max-width:500px){
        .main-content{
            position: fixed;
            top: 33%;
            left: 18%;
            margin-top: 0px;
            margin-left: 0px;
        }
    }
    @media screen and (max-width:360px){
        .main-content{
            position: fixed;
            top: 33%;
            left: 15%;
            margin-top: 0px;
            margin-left: 0px;
        }
    }
    @media screen and (max-width:320px){
        .main-content{
            position: fixed;
            top: 33%;
            left: 11%;
            margin-top: 0px;
            margin-left: 0px;
        }
    }
</style>
<div class="bg">
    <div class="">
        <div class="main-content" style="">
            <div style="text-align:center;">
                <img src="<?php echo base_url();?>assets/landing/svg/404.svg"  class="img-error"/>
                <br><br>
                404 PAGE NOT FOUND <br>
                <a href="<?php echo base_url();?>"><button class="backto"> Back To Home Page</button></a>
            </div>
        </div>
</div>
</div>