<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>


		<div id="listarea">
			<ul id="musiclist">
			<?php
				if (isset($_REQUEST['playlist'])) {
					echo "<h3><a href='music.php'>Back</a></h3>";
					echo "<h3><a href='music.php?playlist={$_REQUEST['playlist']}&shuffle=on'>Shuffle</a></h3>";
					echo "<h3><a href='music.php?playlist={$_REQUEST['playlist']}&bysize=on'>By Size</a></h3>";
				}
				else{
				echo "<h3><a href='music.php?shuffle=on'>Shuffle</a></h3>";
				echo "<h3><a href='music.php?bysize=on'>By Size</a></h3>";
				}
			?>
			<?php 
				include 'lib.php';
				if (!isset($_REQUEST['playlist']))
				$songs = glob(".\\songs\\*.mp3");
				else
				$songs = file(".\\songs\\" . $_REQUEST["playlist"], FILE_IGNORE_NEW_LINES);
				if(isset($_REQUEST['shuffle']))
					shuffle($songs);
				if(isset($_REQUEST['bysize']))
					echo "<p>Sort by File Size is Not Ready Yets</p>";
					

				if (isset($_REQUEST['playlist'])) 
				echo "<hr><h2>Playlists: " . $_REQUEST['playlist'] . "</h1>";
				foreach ($songs as $song) {
					if ($song[0] != "#"	) {
			?>
				<li class="mp3item">
					<a href="songs/<?=basename($song)?>"><?=basename($song)?></a>
					( <?=getSize(filesize(".\\songs\\" . basename($song))); ?>)
				</li>
			<?php }} ?>
			<?php 
				if (!isset($_REQUEST['playlist'])) {
				echo "<hr><h2>Playlists</h2>";
				$playlists = glob(".\\songs\\*");
				foreach ($playlists as $playlist) {
					$name = basename($playlist);
					$extension = pathinfo($playlist, PATHINFO_EXTENSION);
					if($extension == 'txt' || $extension == 'm3u'){
						?>
				<li class="playlistitem">
					<a href="music.php?playlist=<?=basename($playlist)?>"><?=basename($playlist)?></a>
				</li>
			<?php }}} ?>
			</ul>
		</div>
	</body>
</html>
