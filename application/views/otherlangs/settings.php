<meta name="viewport" content="width=device-width, initial-scale=1">
<Style>
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
</Style>
<div class="settings">
    <div class="inner-settings">
        <h3>GENERAL INFO</h3>
        <hr>
        <div>
            <label>ABOUT : </label>
        </div>
        <textarea placeholder="Introduce Yourself..."></textarea>
        <div>
            <label>FULL NAME : </label>
        </div>
        <input placeholder="Enter Your Name...">
        <div>
            <label>USER NAME : </label><a class="username-change-btn">CHANGE</a>
        </div>
        <input placeholder="Enter Username">
        <div>
            <label>SELECT GENDER : </label>
        </div>
        <select class="form-control" name="gender" required="">
            <option value="null" selected disabled hidden>Select Your Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <div><label>DATE OF BIRTH : </label></div>
        <input type="date" name="dob" value="1992-06-26">
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
        <input placeholder="Enter Your Email Id...">
        <div>
            <label>MOBILE NUMBER : </label>
        </div>
        <input placeholder="Enter Your Mobile Number...">
        <div class="update-btn-div"><button>UPDATE INFO</button></div>
    </div>
    <div class="inner-settings">
        <div>
            <span class="community-heading"><b>PREFERRED GENRES</b></span>
            <a class="edit-btn-communities">EDIT</a>
        </div>
        <hr>
        <div class="selected-community-div">
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
        </div>
    </div>
    <div class="inner-settings">
        <div>
            <span class="community-heading"><b>PREFERRED LANGUAGE</b></span>
            <a class="edit-btn-communities">EDIT</a>
        </div>
        <hr>
        <div class="selected-community-div">
            <p class="community-btn-selected">Social Commentary4trvr4oihoilhoirf45rf</p>
        </div>
    </div>
    <div class="inner-settings">
        <h3>CHANGE PASSWORD</h3>
        <hr>
        <div>
            <label>CURRENT PASSWORD : </label>
        </div>
        <input placeholder="Enter Current Password...">
        <div>
            <label>NEW PASSWORD : </label>
        </div>
        <input placeholder="Enter New Password...">
        <div>
            <label>CONFIRM PASSWORD : </label>
        </div>
        <input placeholder="Confirn New Password...">
        <div class="update-btn-div"><button>UPDATE</button></div>
    </div>
</div>