<?php

require_once '../autoloader.php';
$storage = new sqlite_storage();
$storage->start();
if (isset($_POST['device_id']) && isset($_POST['key'])) {
	switch($_POST['action']) {
		case 'Add user':
			$storage->add_device($_POST['device_id'], $_POST['key']);
			break;
		case 'Remove':
			$storage->remove_device($_POST['device_id'], $_POST['key']);
			break;
		default:
			throw new unknown_action_exception('Unknown action "'.$_POST['action'].'"');
			break;
	}
	$storage->stop();
	header('Location: '.$_SERVER['REQUEST_URI'], true, 303);
	die();
}
$devices = $storage->get_devices();
$storage->stop();
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8>
<title>Users</title>
</head>
<body>
<h1>Users</h1>
<h2>Current users</h2>
<table>
	<tr>
		<th>Device</th>
		<th>Key</th>
		<th>Created</th>
		<th>Actions</th>
	</tr>
	<?php
		foreach ($devices as $device) {
			echo '<tr>';
			echo '<td>'.$device['device_id'].'</td>';
			echo '<td>'.$device['key'].'</td>';
			echo '<td>'.$device['created'].'</td>';
			echo '<td>';
			echo <<<EOT
<form method="post">
<input type="hidden" name="device_id" value="{$device['device_id']}">
<input type="hidden" name="key" value="{$device['key']}">
<input type="submit" name="action" value="Remove">
</form>
EOT;
			echo '</td>';
			echo '</tr>';
		}
	?>
</table>
<h2>Add user</h2>
<form method="post">
	<input type="text" name="device_id" placeholder="Device ID" /><br />
	<input type="text" name="key" placeholder="Key" /><br />
	<input type="submit" name="action" value="Add user" />
</form>
</body>
</html>
