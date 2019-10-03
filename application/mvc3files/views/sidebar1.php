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
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header"></li>
			<li class="treeview active">
				<a href="#"><i class="fa fa-home"></i> <span>Home</span></a>
			</li>
			<li class="treeview">
				<a href="#"><i class="fa fa-indent"></i> <span>Series</span></a>
			</li>
			<li><a href="<?php echo base_url('index.php/welcome/library');?>"><i class="fa fa-book"></i> <span>Library</span></a></li>
			<li class="treeview">
				<a href="#"><i class="fa fa-folder"></i> <span>Geners</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu card" style="display:block;">
					<?php foreach($gener->result() as $key) { ?>
					<li> <a href="<?php echo base_url('index.php/welcome/home_filters?id='.$key->id); ?>"><?php echo $key->gener;?> </a> </li>
					<?php } ?>
					<hr style="margin:5px 0px;">
					<center><span class="cardmore"><a href="#" style="color:#dd4b39;font-size:14px;">Show More </a></span></center>
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