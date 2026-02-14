<!doctype html>
<html lang="en">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css">
		<link href="css/jumbotron-narrow.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet" />
        <title><?php echo $pageTitle; ?></title>
    </head>
	<body>
		<div class="container">
			<div class="header clearfix">
				<nav>
					<ul class="nav nav-pills pull-right">
						<li role="presentation"><a href="index.php">Home</a></li>
						<!-- Both buttons below should never be visible at the same time -->
						<li role='presentation'><a href='logout.php'>Logout</a></li>
						<li role='presentation'><a href='login.php'>Login</a></li>
					</ul>
				</nav>
				<h3 class="text-muted"><a href="/">The CIS Blog</a></h3>
			</div>
			<div class="row marketing">
				<div class="col-lg-12">