<?php 
require ('functions.php');

$host = '45.119.120.2';
$port = 27960;

$data = getUrtServerStatus($host, $port, 15);
$maxClients = $data['info']['sv_maxclients'];
$totalPlayers = count($data['players']);
$mapName = $data['info']['mapname'];
?>

<meta charset="utf-8">
<meta http-equiv="refresh" content="30">
<title> <?php echo "$totalPlayers/$maxClients - $mapName"; ?></title>

<p>Currently playing: <?php echo $totalPlayers; ?>/<?php echo $maxClients; ?></p>
<p>Map Name: <?php echo $data['info']['mapname']?></p>

<?php if(count($data['players'])): ?>
<table>
	<tr>
		<th>name</th>
		<th>score</th>
		<th>ping</th>
	</tr>

<?php foreach($data['players'] as $player):?>
	<tr>
		<td><?php echo $player['name']?></td>
		<td><?php echo $player['score']?></td>
		<td><?php echo $player['ping']?></td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
