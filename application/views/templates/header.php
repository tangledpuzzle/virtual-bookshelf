<!DOCTYPE html>
<html lang="en">
<head>
    <title>Virtual Bookshelf</title>
	<link rel="stylesheet" type="text/css" href="../../../css/global.css" >
	<link rel="stylesheet" type="text/css" href="../../../bs/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="../../../bs/css/bootstrap-theme.css" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Project helper functions. -->
	<script type="text/javascript" src="../../../js/r2p.js"></script>
</head>
<body>
	<div class="container white-div clear-top">
		<div class="row">
			<header>
				<a href="<?php echo base_url(); ?>"><img id="logo" class="center-block img-responsive" src="../../../img/virtual_bookshelf.png" alt="Virtual Bookshelf Website Logo" width="589" height="69"></a>
				<nav class="navbar navbar-inverse">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/booklist">Books</a></li>
						<!-- Unimplemented: <li><a href="<?php echo base_url(); ?>index.php/booksearch">Search Books</a></li> -->
						<li><a href="<?php echo base_url(); ?>index.php/userlist">Users</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right" > 
						<?php
						if (isset( $auth_user_id ))
						{
							echo '<li><span class="navbar-text">' . "Hello, $ScreenName" . '</span></li>';
							echo '<li><a href="' . base_url() . 'index.php/myprofile">My Profile</a></li>';
							echo '<li><a href="' . base_url() . 'index.php/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
						}
						else
						{
							echo '<li><a href="' . base_url() . 'index.php/register"><span class="glyphicon glyphicon-user"></span> Register</a></li>';
							echo '<li><a href="' . base_url() . 'index.php/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
						}
						?>
					</ul>
				</nav>
			</header>
		</div>
	
	<div class="row main-content">
		<section>