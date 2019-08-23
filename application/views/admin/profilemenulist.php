<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Navbar Type</th>
                    <th>Menu Type</th>
                    <th>For Menu</th>
                    <th>Language Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($profilemenulist) && ($profilemenulist->num_rows() > 0)){ foreach($profilemenulist->result() as $profilemenu){ ?>
                    <tr>
                        <td><?php echo $profilemenu->navbartype;?></td>
                        <td><?php echo $profilemenu->menu_type;?></td>
                        <td><?php echo $profilemenu->for_menu;?></td>
                        <td><?php echo $profilemenu->menu_name;?></td>
                        <td><?php echo substr($profilemenu->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editprofilemenu/<?php echo $profilemenu->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteprofilemenu/<?php echo $profilemenu->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>