    <style>
    	ul.card li:nth-child(n+6) {
    		display:none;
    	}
    	.card-text:last-child{
    		margin-bottom:0;
    	}
    	.cardmore > a {
    		color:#dd4b39;
    	}
    </style>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto; font-size: 18px;">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="header"> &nbsp; </li>
                <?php $home = ''; $series = ''; $library = ''; $geners = ''; $activeuri = '';
                    $activeuri = $this->uri->segment(2);
                    if($activeuri == 'seriesall'){
                        $series = 'active';
                    }else if($activeuri == 'toberead'){
                        $library = 'active';
                    }else if($activeuri == 'geners'){
                        $geners = 'active';
                    }else{
                        $home = 'active';
                    }
                ?>
                <li class="<?php echo $home;?>">
                    <a href="<?php echo base_url();?>index.php/welcome/home">
                        <i class="fa fa-home"></i> <span> Home </span>
                    </a>
                </li>
                <li class="<?php echo $series;?>">
                    <a href="<?php echo base_url('index.php/Welcome/seriesall');?>">
                        <i class="fa fa-indent"></i><span> Series </span>
                    </a>
                </li>
                <li class="<?php echo $library;?>">
                    <a href="<?php echo base_url('index.php/Welcome/toberead');?>">
                        <i class="fa fa-book"></i><span> Library </span>
                    </a>
                </li>
                <li class="treeview menuopen <?php echo $geners;?>">
                    <a href="#">
                        <i class="fa fa-folder"></i><span> Geners </span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu card" style="display:block;">
                        <?php if(isset($gener) && ($gener->num_rows() > 0)) { foreach($gener->result() as $key) { ?>
                        <li><a href="<?php echo base_url('index.php/welcome/geners?id='.$key->id); ?>" style="font-size:16px;color:#000;">
                            <?php echo $key->gener;?> </a></li>
                        <?php } } ?>
                        <hr style="margin:5px 0px;">
    					<center><span class="cardmore">
    					    <a href="#" style="color:#dd4b39;font-size:16px;"> Show More </a></span>
    				    </center>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar --> 
    </aside>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function () { // Gener show More
		$('span.cardmore').click(function () {
			$('ul.card li').slideDown("slow");
			//$('ul.card li').show('slide');
			$('span.cardmore').hide();
		});
	});
</script>