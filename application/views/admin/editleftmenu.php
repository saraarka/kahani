<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editleftmenu) && ($editleftmenu->num_rows() == 1)){ foreach($editleftmenu->result() as $leftmenurow){ ?>
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/updateleftmenu/<?php echo $leftmenurow->id;?>" method="POST">
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="navbartype">Menu Navbar Position: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="navbartype" required>
                            <option value=""> --Select Navbar-- </option>
                            <option value="leftside" <?php if($leftmenurow->navbartype == 'leftside'){ echo 'selected'; } ?>> Left Sidebar </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="menu_type">Menu Type: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="menu_type" required>
                            <option value=""> --Select Menu Type-- </option>
                            <option value="mainmenu" <?php if($leftmenurow->menu_type == 'mainmenu'){ echo 'selected'; } ?>> Main Menu </option>
                            <option value="submenu" <?php if($leftmenurow->menu_type == 'submenu'){ echo 'selected'; } ?>> Sub Menu </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="for_menu">For the Menu of: *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="for_menu" required>
                            <option value=""> --Select For the Menu of-- </option>
                            <optgroup label="For Main Menu">
                                <option value="home" <?php if($leftmenurow->for_menu == 'home'){ echo 'selected'; } ?>> Home </option>
                                <option value="series" <?php if($leftmenurow->for_menu == 'series'){ echo 'selected'; } ?>> Series </option>
                                <option value="library" <?php if($leftmenurow->for_menu == 'library'){ echo 'selected'; } ?>> Library </option>
                                <option value="drafts" <?php if($leftmenurow->for_menu == 'drafts'){ echo 'selected'; } ?>> Drafts </option>
                                <option value="geners" <?php if($leftmenurow->for_menu == 'geners'){ echo 'selected'; } ?>> Geners </option>
                            </optgroup>
                            <optgroup label="For Sub Menu">
                                <option value=""> </option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="menu_name">Enter Language Title: *</label>
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" name="menu_name" placeholder="Enter Language Title" value="<?php echo $leftmenurow->menu_name;?>">
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