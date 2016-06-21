<?php require('vendor/autoload.php');

$host = '91.121.183.25';
// $host = '45.119.120.2';
$port = 27960;

$address = "udp://$host:$port";
$getStatus = "\377\377\377\377getstatus\n";

$factory = new \Socket\Raw\Factory();
$socket = $factory->createClient($address);
$socket->write($getStatus);

$data = $socket->read(2048);
$socket->close();

$data = explode("\n", $data);

$players = array_filter(array_slice($data, 2));
$players = array_map(function($player){
	$player = explode(' ',$player);

	return [
		'name' => $player[2],
		'ping' => $player[1],
		'score' => $player[0]
	];
}, $players);

//remove the first \
$info = array_slice(explode('\\', $data[1]), 1);
$info = array_chunk($info, 2);

$info = array_map(function($pair) {
	return [
		'name' => $pair[0],
		'value' => $pair[1]
	];
}, $info);

// print_r($info);
// print_r($players);
$rdata = compact('players', 'info');

// use Symfony\Component\HttpFoundation\JsonResponse;
// $response = new JsonResponse();
// $response->setData($rdata);
// @$response->send();
?>

<meta charset="utf-8">

<table>
	<tr>
		<th>name</th>
		<th>score</th>
		<th>ping</th>
	</tr>

<?php foreach($players as $player):?>
	<tr>
		<td><?php echo $player['name']?></td>
		<td><?php echo $player['score']?></td>
		<td><?php echo $player['ping']?></td>
	</tr>
<?php endforeach; ?>
</table>