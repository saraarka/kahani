    <?php $this->load->view('admin/header.php');?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addheadmenu" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="navbartype">Menu Navbar Position: *</label>
                <div class="col-sm-10">
                    <select class="form-control" name="navbartype" required>
                        <option value=""> --Select Navbar-- </option>
                        <option value="header"> Header </option>
                        <!--<option value="leftside"> Left Sidebar </option>
                        <option value="profile"> Profile </option> -->
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="menu_type">Menu Type: *</label>
                <div class="col-sm-10">
                    <select class="form-control" name="menu_type" required>
                        <option value=""> --Select Menu Type-- </option>
                        <option value="mainmenu"> Main Menu </option>
                        <option value="submenu"> Sub Menu </option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="for_menu">For the Menu of: *</label>
                <div class="col-sm-10">
                    <select class="form-control" name="for_menu" required>
                        <option value=""> --Select For the Menu of-- </option>
                        <optgroup label="For Main Menu">
                            <option value="write"> Write </option>
                            <option value="communities"> Communities </option>
                            <option value="your_feed"> Your Feed </option>
                            <option value="life_events"> Life Events </option>
                            <option value="notifications"> Notifications </option>
                            <option value="profile"> Profile </option>
                            <option value="login"> Login </option>
                            <option value="about"> About </option>
                            <option value="blog"> Blog </option>
                            <option value="faq"> Faq </option>
                            <option value="contact"> Contact </option>
                            <option value="terms"> Terms </option>
                            <option value="privacy"> Privacy </option>
                        </optgroup>
                        <optgroup label="For Sub Menu">
                            <option value="series"> Write Series </option>
                            <option value="story"> Write Story </option>
                            <option value="nano"> Write Nano Story </option>
                            <option value="life"> Write Life Events</option>
                            <option value="my_profile"> My Profile </option>
                            <option value="settings"> Profile Settings </option>
                            <option value="transactions"> Profile Transactions </option>
                            <option value="draft"> Profile Drafts </option>
                            <option value="signout"> Profile Sign Out </option>
                            <option value="show_more"> Show More </option>
                        </optgroup>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="menu_name">Enter Language Title: *</label>
                <div class="col-sm-10"> 
                    <input type="text" class="form-control" name="menu_name" placeholder="Enter Language Title">
                </div>
            </div>
        
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </form>
    </div>