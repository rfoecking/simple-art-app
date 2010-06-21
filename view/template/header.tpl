<html>
	<head>
		<LINK href="../style/css/basic.css" rel="stylesheet" type="text/css">
		<title>LEROY</title>
	</head>
	<body>
	<div id="page-container">
	<div id="header"><h1>leroy van vliet</h1></div>
	<div id="nav">
		<ul class="links">
			<li><a href="main" title="Home">home</a></li> 
			<li><a href="finished_work" title="Gallery">finished work</a></li>
			<li><a href="sketches" title="Gallery">sketches</a></li> 
			<li><a href="contact" title="About">about/contact</a></li>
			{if $loggedIn}
			<li><a href="upload" title="Upload">upload</a></li> 
			<li><a href="post" title="Post">post</a></li> 
			<li><a href="logout" title="Logout">logout</a></li> 
			{else}
			<li><a href="login" title="Login">login</a></li>
			{/if}
		</ul>		
		</div>
		<div id="content">
		


			
