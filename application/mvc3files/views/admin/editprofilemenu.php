<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editprofilemenu) && ($editprofilemenu->num_rows() == 1)){ foreach($editprofilemenu->result() as $editprofile){ ?>
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/updateprofilemenu/<?php echo $editprofile->id;?>" method="POST">
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="navbartype">Menu Navbar Position: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="navbartype" required>
                            <option value=""> --Select Navbar-- </option>
                            <option value="profile" <?php if($editprofile->navbartype == 'profile'){ echo 'selected'; } ?>> Profile </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="menu_type">Menu Type: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="menu_type" required>
                            <option value=""> --Select Menu Type-- </option>
                            <option value="mainmenu" <?php if($editprofile->menu_type == 'mainmenu'){ echo 'selected'; } ?>> Main Menu </option>
                            <option value="submenu" <?php if($editprofile->menu_type == 'submenu'){ echo 'selected'; } ?>> Sub Menu </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="for_menu">For the Menu of: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="for_menu" required>
                        <option value=""> --Select For the Menu of-- </option>
                        <optgroup label="For Main Menu">
                            <option value="writings" <?php if($editprofile->for_menu == 'writings'){ echo 'selected'; } ?>> WRITINGS </option>
                            <option value="followers" <?php if($editprofile->for_menu == 'followers'){ echo 'selected'; } ?>> FOLLOWERS </option>
                            <option value="views" <?php if($editprofile->for_menu == 'views'){ echo 'selected'; } ?>> VIEWS </option>
                            <option value="edit_profile" <?php if($editprofile->for_menu == 'edit_profile'){ echo 'selected'; } ?>> Edit Profile </option>
                            <option value="contact" <?php if($editprofile->for_menu == 'contact'){ echo 'selected'; } ?>> Contact </option>
                            <option value="about" <?php if($editprofile->for_menu == 'about'){ echo 'selected'; } ?>> About </option>
                            <option value="comments_on_profile" <?php if($editprofile->for_menu == 'comments_on_profile'){ echo 'selected'; } ?>> Comment On Your Profile </option>
                            <option value="writingtab" <?php if($editprofile->for_menu == 'writingtab'){ echo 'selected'; } ?>> Writing </option>
                            <option value="readingtab" <?php if($editprofile->for_menu == 'readingtab'){ echo 'selected'; } ?>> Reading </option>
                            <option value="viewall" <?php if($editprofile->for_menu == 'viewall'){ echo 'selected'; } ?>> View All </option>
                            <option value="followbtn" <?php if($editprofile->for_menu == 'followbtn'){ echo 'selected'; } ?>> Follow </option>
                            <option value="followingbtn" <?php if($editprofile->for_menu == 'followingbtn'){ echo 'selected'; } ?>> Following </option>
                        </optgroup>
                    </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="menu_name">Enter Language Title: *</label>
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" name="menu_name" placeholder="Enter Language Title" value="<?php echo $editprofile->menu_name;?>">
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