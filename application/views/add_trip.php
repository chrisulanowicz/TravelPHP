<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Add a travel plan" />
	<title>Add Plan</title>
	<link rel="stylesheet" href="<?=base_url();?>/user_guide/_static/css/style.css" />
</head>
<body>
	<div id="container">
		<div id="header">
			<p class="logout"><a href="/Users/logout">Logout</a></p>
			<p class="logout"><a href="/travels">Home</a></p>
		</div>
		<div id="main_content">
			<h2>Add a Trip</h2>
			<div class="errors">
				<?php
					if($this->session->flashdata('errors'))
					{
						echo $this->session->flashdata('errors');
					}
				?>
			</div>
			<form action="/travels/new_plan" method="post">
				<p>Destination: 
					<input type="text" name="destination" />
				</p>
				<p>Description:
					<input type="text" name="description" />
				</p>
				<p>Travel Date From:
					<input type="date" name="date_from" />
				</p>
				<p>Travel Date To:
					<input type="date" name="date_to" />
				</p>
				<input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id') ?>" />
				<input class="button" type="submit" value="Add" />
			</form>
		</div>
	</div>
</body>
</html>