<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Travel Buddy Dashboard" />
	<title>Travel Dashboard</title>
	<link rel="stylesheet" href="<?=base_url();?>/user_guide/_static/css/style.css" />
</head>
<body>
	<div id="container">
		<div id="header">
			<h2>Welcome, <?= $this->session->userdata('username') ?>!</h2>
			<p class="logout"><a href="/Users/logout">Logout</a></p>
		</div>
		<div id="top">
			<p>Your Trip Schedules:</p>
			<table>
				<thead>
					<tr>
						<th>Destination</th>
						<th>Travel Start Date</th>
						<th>Travel End Date</th>
						<th>Plan</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($plans as $value):
					?>
								<tr>
									<td><a href="/Travels/destination/<?= $value['trip_id'] ?>"><?= $value['destination'] ?></a></td>
									<td><?= $value['date_from'] ?></td>
									<td><?= $value['date_to'] ?></td>
									<td><?= $value['description'] ?></td>
								</tr>
					<?php
						endforeach;
					?>
				</tbody>
			</table>
		</div>
		<div id="bottom">
			<p>Other User's Travel Plans:</p>
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Destination</th>
						<th>Travel Start Date</th>
						<th>Travel End Date</th>
						<th>Do You Want to Join?</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($other_plans as $other):
					?>
								<tr>
									<td><?= $other['name'] ?></td>
									<td><a href="/Travels/destination/<?= $other['trip_id'] ?>"><?= $other['destination'] ?></a></td>
									<td><?= $other['date_from'] ?></td>
									<td><?= $other['date_to'] ?></td>
									<td><a href="/Travels/join/<?= $other['trip_id'] ?>">Join</a></td>
								</tr>
					<?php
						endforeach;
					?>
				</tbody>
			</table>
		</div>
		<p class="logout"><a href="/travels/add">Add Travel Plan</a></p>
	</div>
</body>
</html>