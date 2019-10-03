<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editmenu) && ($editmenu->num_rows() == 1)){ foreach($editmenu->result() as $menurow){ ?>
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/updateheadmenu/<?php echo $menurow->id;?>" method="POST">
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="navbartype">Menu Navbar Position: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="navbartype" required>
                            <option value=""> --Select Navbar-- </option>
                            <option value="header" <?php if($menurow->navbartype == 'header'){ echo 'selected'; } ?>> Header </option>
                            <!--<option value="leftside" <?php if($menurow->navbartype == 'leftside'){ echo 'selected'; } ?>> Left Sidebar </option>
                            <option value="profile" <?php if($menurow->navbartype == 'profile'){ echo 'selected'; } ?>> Profile </option>-->
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="menu_type">Menu Type: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="menu_type" required>
                            <option value=""> --Select Menu Type-- </option>
                            <option value="mainmenu" <?php if($menurow->menu_type == 'mainmenu'){ echo 'selected'; } ?>> Main Menu </option>
                            <option value="submenu" <?php if($menurow->menu_type == 'submenu'){ echo 'selected'; } ?>> Sub Menu </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="for_menu">For the Menu of: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="for_menu" required>
                            <option value=""> --Select For the Menu of-- </option>
                            <optgroup label="For Main Menu">
                                <option value="write" <?php if($menurow->for_menu == 'write'){ echo 'selected'; } ?>> Write </option>
                                <option value="communities" <?php if($menurow->for_menu == 'communities'){ echo 'selected'; } ?>> Communities </option>
                                <option value="your_feed" <?php if($menurow->for_menu == 'your_feed'){ echo 'selected'; } ?>> Your Feed </option>
                                <option value="life_events" <?php if($menurow->for_menu == 'life_events'){ echo 'selected'; } ?>> Life Events </option>
                                <option value="notifications" <?php if($menurow->for_menu == 'notifications'){ echo 'selected'; } ?>> Notifications </option>
                                <option value="profile" <?php if($menurow->for_menu == 'profile'){ echo 'selected'; } ?>> Profile </option>
                                <option value="login" <?php if($menurow->for_menu == 'login'){ echo 'selected'; } ?>> Login </option>
                            </optgroup>
                            <optgroup label="For Sub Menu">
                                <option value="series" <?php if($menurow->for_menu == 'series'){ echo 'selected'; } ?>> Write Series </option>
                                <option value="story" <?php if($menurow->for_menu == 'story'){ echo 'selected'; } ?>> Write Story </option>
                                <option value="nano" <?php if($menurow->for_menu == 'nano'){ echo 'selected'; } ?>> Write Nano Story </option>
                                <option value="life" <?php if($menurow->for_menu == 'life'){ echo 'selected'; } ?>> Write Life Events</option>
                                <option value="my_profile" <?php if($menurow->for_menu == 'my_profile'){ echo 'selected'; } ?>> My Profile </option>
                                <option value="settings" <?php if($menurow->for_menu == 'settings'){ echo 'selected'; } ?> > Profile Settings </option>
                                <option value="transactions" <?php if($menurow->for_menu == 'transactions'){ echo 'selected'; } ?>> Profile Transactions </option>
                                <option value="draft" <?php if($menurow->for_menu == 'draft'){ echo 'selected'; } ?>> Profile Drafts </option>
                                <option value="signout" <?php if($menurow->for_menu == 'signout'){ echo 'selected'; } ?>> Profile Sign Out </option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="menu_name">Enter Language Title: *</label>
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" name="menu_name" placeholder="Enter Language Title" value="<?php echo $menurow->menu_name;?>">
                    </div>
                </div>
            
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </form>
        <?php } } ?>
    </div>