<link rel="stylesheet" href="<?php echo base_url();?>assets/css/sidebar.css">
    
    <div class="main-container">
    <!--<aside class="main-sidebar hidden-xs hideside"  style="z-index:0;" id="sidebarv">-->
    <aside class="main-sidebar hidden-xs"  style="z-index:0;" id="sidebarv">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="font-size: 18px;">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu tree" data-widget="tree" id="sidebar_menu">
                <!--<li class="header"> &nbsp; </li>-->
                <li class="avj3 <?php if($this->uri->segment(1) == 'english'){ echo 'active'; } ?>" id="home">
                    <a href="<?php echo base_url();?>english">
                        <span class="btn btn-flat btn-success" style="background:#d9b03a; border-color:#d9b03a;"><i class="fa fa-home fa-2x"></i></span>
						<span class="sidea"> Home </span>
                    </a>
                </li>
				<li class="avj1 <?php if($this->uri->segment(1) == 'seriesall'){ echo 'active'; } ?>" id="series">
                    <a href="<?php echo base_url('seriesall');?>">
                        <span class="btn btn-flat btn-danger" style="background:#4285f4; border-color:#4285f4;"><i class="fa fa-indent fa-2x"></i></span>
						<span class="sidea"> Series </span>
                    </a>
                </li>
                <li class="avj2 <?php if($this->uri->segment(1) == 'library'){ echo 'active'; } ?>" id="lib">
                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                    <a href="<?php echo base_url('library');?>">
                        <span class="btn btn-flat btn-info" style="background:#34a853; border-color:#34a853;"><i class="fa fa-book fa-2x"></i></span>
						<span class="sidea"> Library </span>
                    </a>
                    <?php } else{ ?>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#loginmodal">
                        <span class="btn btn-flat btn-info" style="background:#34a853; border-color:#34a853;"><i class="fa fa-book fa-2x"></i></span><span class="sidea"> Library </span>
                    </a>
                    <?php } ?>
                </li>
                <li class="avj5">
                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                    <a href="<?php echo base_url('drafts');?>">
                        <span class="btn btn-flat btn-primary" style="background:dimgrey; border-color:dimgrey;"><i class="fa fa-file fa-2x"></i></span>
						<span class="sidea"> Drafts </span>
                    </a>
                    <?php } else{ ?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#loginmodal">
                        <span class="btn btn-flat btn-primary" style="background:dimgrey; border-color:dimgrey;"><i class="fa fa-file fa-2x"></i></span><span class="sidea"> Drafts </span>
                    </a>
                    <?php } ?>
                </li>
                <li class="treeview avj4 menu-open">
                    <a href="#">
                        <span class="btn btn-flat btn-warning" style="background:orangered; border-color:orangered;"><i class="fa fa-folder fa-2x"></i></span>
						<span class="sidea"> Geners </span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu cardv" style="display:block;">
                        <?php if(isset($gener) && ($gener->num_rows() > 0)) { foreach($gener->result() as $key) { ?>
                            <li><a href="<?php echo base_url('genre/'.preg_replace('/\s+/', '-', $key->gener)); ?>">
                                <?php echo $key->gener;?> </a></li>
                        <?php } } ?>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar --> 
    </aside>
    </div>


<script>
   $(window).load(function(){
      var url = window.location.href;
      $('sidebar_menu li').find('.active').removeClass('active');
      $('sidebar_menu li a').filter(function(){
          return this.href == url;
      }).parent().addClass('active');
  });
</script>


<script>
var didScrolls;
var lastScrollTops = 0;
var deltas = 2;
var sidebarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScrolls = true;
});

setInterval(function() {
    if (didScrolls) {
        hasScrolleds();
        didScrolls = false;
    }
}, 250);

function hasScrolleds() {
    var st = $(this).scrollTop();
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTops - st) <= deltas)
        return;
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTops && st > sidebarHeight){
        // Scroll Down
        $('#sidebarv').removeClass('sticky').addClass('sticky1');
    } else { // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('#sidebarv').removeClass('sticky1').addClass('sticky');
        }
    }
    lastScrollTops = st;
}
</script>