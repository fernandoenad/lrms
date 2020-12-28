</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed sidebar-collapse pace-primary">
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item">
				<a href="?p=auth" class="nav-link">User Sign-on</a>
			</li>
		</ul>
	</nav>
	
	<aside class="main-sidebar sidebar-dark-info elevation-4">
		<a href="?p=auth" class="brand-link">
			<img src="../assets/images/logo.png" alt="School Logo" class="brand-image img-circle elevation-3"
				style="opacity: .8">
			<span class="brand-text font-weight-light"><?php echo $webapp_nameshort;?></span>
		</a>
	
		<div class="sidebar">	  
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="?p=auth" class="nav-link">
							<i class="nav-icon fas fa-home"></i>
							<p>User Sign-on</p>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</aside>

<script type="text/javascript">	
function promptInProgress(page){
	alert('Page construction for '+page+' is in progress...');
}
</script>	
