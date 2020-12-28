</head>

<body class="hold-transition layout-top-nav layout-footer-fixed lockscreen">
<div class="wrapper">
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand-md navbar-light navbar-white sticky-top">
		<div class="container">
			<a href="" class="navbar-brand">
				<img src="assets/images/logo.png" alt="<?php echo $webapp_nameshort;?>" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light"> <strong><?php echo $webapp_nameshort ;?></strong></span>
			</a>
			<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse order-3" id="navbarCollapse">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a href="?p=home" class="nav-link" title="Home">Home</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link" title="Announcements" onClick="getAnnouncement();">About</a>
					</li>
				</ul>
				
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">
					<!--
					<li class="nav-item nav-item">
						<a href="#" class="nav-link" title="Feedback" onClick="getFeedback();">Feedback</a>
					</li>
					-->
					<li class="nav-item nav-item">
						<a href="./admin/" class="nav-link" title="Admin Login">Admin Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
