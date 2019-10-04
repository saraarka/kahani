<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addleftmenu" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="navbartype">Menu Navbar Position: *</label>
                <div class="col-sm-10">
                    <select class="form-control" name="navbartype" required>
                        <option value=""> --Select Navbar-- </option>
                        <option value="leftside"> Left Sidebar </option>
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
                            <option value="home"> Home </option>
                            <option value="series"> Series </option>
                            <option value="library"> Library </option>
                            <option value="drafts"> Drafts </option>
                            <option value="geners"> Geners </option>
                        </optgroup>
                        <optgroup label="For Sub Menu">
                            <?php if(isset($geners) && ($geners->num_rows() > 0)){ foreach($geners->result() as $gener){ ?>
                            <option value="<?php echo $gener->id;?>"> <?php echo $gener->gener;?></option>
                            <?php } } ?>
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