<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="View Trip Info" />
	<title>Destination</title>
	<link rel="stylesheet" href="<?=base_url();?>/user_guide/_static/css/style.css" />
</head>
<body>
	<div id="container">
		<div id="header">
			<p class="logout"><a href="/Users/logout">Logout</a></p>
			<p class="logout"><a href="/travels">Home</a></p>
		</div>
		<div id="main_content">
			<h2><?= $trip['destination'] ?></h2>
			<p>Planned By: <?= $trip['name'] ?></p>
			<p>Description: <?= $trip['description'] ?></p>
			<p>Travel Date From: <?= $trip['date_from'] ?></p>
			<p>Travel Date To: <?= $trip['date_to'] ?></p>
		</div>
		<div id="bottom">
			<h2>Other users' joining the trip:</h2>
			<?php
				foreach($others as $other):
			?>
					<p><?= $other['name'] ?></p>
			<?php
				endforeach;
			?>
		</div>
	</div>
</body>
</html>