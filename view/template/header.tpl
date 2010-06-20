<html>
	<head>
		<LINK href="../style/css/basic.css" rel="stylesheet" type="text/css">
		<title>LEROY</title>
	</head>
	<body> Leroy's Awesome Art and Shit
		<ul class="links">
			<li><a href="main" title="Home">Home</a></li> 
			<li><a href="finished_work" title="Gallery">Finished Work</a></li>
			<li><a href="sketches" title="Gallery">Sketches</a></li> 
			<li><a href="posts" title="Gallery">View Posts</a></li> 
 
			{if $loggedIn}
			<li><a href="upload" title="Upload">Upload (leroy only)</a></li> 
			<li><a href="post" title="Post">Post(leroy only)</a></li> 
			<li><a href="logout" title="Logout">Logout</a></li> 
			{else}
			<li><a href="login" title="Login">Login (leroy only)</a></li>
			{/if}
		</ul>
		


			
