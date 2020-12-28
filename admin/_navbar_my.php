</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed pace-primary">
<div class="wrapper">
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item active">
				<a href="?p=my" class="nav-link" title="Home">Home</a>
			</li>
			<!--
			<li class="nav-item">
				<a href="#" class="nav-link" title="Annoucements" onClick="getAnnouncement();">Announcements</a>
			</li>
			-->
		</ul>
		
		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<!--
			<li class="nav-item nav-item">
				<a href="#" class="nav-link" title="Feedback" onClick="getFeedback();">
					<i class="fa fa-comment"></i>
				</a>
			</li>
			-->
			<li class="nav-item dropdown user-menu">
				<?php $avatar_path = (file_exists("../assets/avatars/".$logged_userID.".jpg") ? $logged_userID : "avatar-0");?>
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<img src="../assets/avatars/<?php echo $avatar_path;?>.jpg" class="user-image img-circle elevation-2" alt="User Image">
					<span class="d-none d-md-inline"><?php echo $logged_userFullname;?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<!-- User image -->
					<li class="user-header bg-info">
						<img src="../assets/avatars/<?php echo $avatar_path;?>.jpg" class="img-circle elevation-2" alt="User Image">
						<p>
							<?php echo $logged_userFullname;?><br>
							<?php echo ($logged_userRole == 1 ? "Administrator" : "User");?>
						</p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
						<a href="?p=profile" class="btn btn-default btn-flat" title="Modify profile"><i class="fas fa-edit"></i> Edit Profile</a>
						<a href="?p=logout" class="btn btn-default btn-flat float-right"><i class="fas fa-sign-out-alt"></i> Logout</a>
					</li>
				</ul>
			</li>
		</ul>
		
		
	</nav>
	
	<aside class="main-sidebar sidebar-dark-info elevation-4">
		<a href="?p=my" class="brand-link">
			<img src="../assets/images/logo.png" alt="School Logo" class="brand-image img-circle elevation-3"
				style="opacity: .8">
			<span class="brand-text font-weight-light"><?php echo $webapp_nameshort;?></span>
		</a>
	
		<div class="sidebar">	  
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="?p=my" class="nav-link <?php echo ($_GET['p'] == "my" ? "active" : "");?>">
							<i class="nav-icon fas fa-home"></i>
							<p>Home</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?p=content" class="nav-link <?php echo ($_GET['p'] == "content" ? "active" : "");?>">
							<i class="nav-icon fas fa-book"></i>
							<p>Contents</p>
						</a>
					</li>
					<?php if($logged_userRole == 1){ ?>
					<li class="nav-item">
						<a href="?p=user" class="nav-link <?php echo ($_GET['p'] == "user" ? "active" : "");?>">
							<i class="nav-icon fas fa-users"></i>
							<p>User Management</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?p=configuration" class="nav-link <?php echo ($_GET['p'] == "configuration" ? "active" : "");?>">
							<i class="nav-icon fas fa-photo-video"></i>
							<p>Content Management</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?p=setting" class="nav-link <?php echo ($_GET['p'] == "setting" ? "active" : "");?>">
							<i class="nav-icon fas fa-cog"></i>
							<p>Site Settings</p>
						</a>
					</li>
					<?php } ?>
				</ul>
			</nav>
		</div>
	</aside>
	
