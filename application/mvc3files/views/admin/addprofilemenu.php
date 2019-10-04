<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addprofilemenu" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="navbartype">Menu Navbar Position: *</label>
                <div class="col-sm-10">
                    <select class="form-control" name="navbartype" required>
                        <option value=""> --Select Navbar-- </option>
                        <option value="profile"> Profile </option>
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
                            <option value="writings"> WRITINGS </option>
                            <option value="followers"> FOLLOWERS </option>
                            <option value="views"> VIEWS </option>
                            <option value="edit_profile"> Edit Profile </option>
                            <option value="contact"> Contact </option>
                            <option value="about"> About </option>
                            <option value="comments_on_profile"> Profile Comments </option>
                            <option value="writingtab"> Writing </option>
                            <option value="readingtab"> Reading </option>
                            <option value="viewall"> View All </option>
                            <option value="followbtn"> Follow </option>
                            <option value="followingbtn"> Following </option>
                            <option value="followingtab"> Following Tab </option>
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