<?php
function laskeSauvanPituus(float $pituus, string $kayttotarkoitus): float
{
	$kertoimet = [
		'luistelu' => 0.9,
		'perinteinen' => 0.85,
		'sauvakavely' => 0.68
	];

	return $pituus * $kertoimet[$kayttotarkoitus];
}

$sauvanPituus = null;
$virhe = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$pituus = filter_input(INPUT_POST, 'pituus', FILTER_VALIDATE_FLOAT);
	$kayttotarkoitus = $_POST['kayttotarkoitus'] ?? '';

	if ($pituus === false || $pituus <= 0) {
		$virhe = 'Anna positiivinen pituus senttimetreinä.';
	} elseif (!in_array($kayttotarkoitus, ['luistelu', 'perinteinen', 'sauvakavely'], true)) {
		$virhe = 'Valitse sauvan käyttötarkoitus.';
	} else {
		$sauvanPituus = laskeSauvanPituus($pituus, $kayttotarkoitus);
	}
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
	<meta charset="UTF-8">
	<title>Sauvan pituuslaskuri</title>
</head>
<body>
	<h1>Sauvan pituuslaskuri</h1>

	<form method="post">
		<p>
			<label for="pituus">Henkilön pituus (cm):</label><br>
			<input type="number" id="pituus" name="pituus" min="1" step="0.1" required>
		</p>

		<p>
			<label for="kayttotarkoitus">Sauvan käyttötarkoitus:</label><br>
			<select id="kayttotarkoitus" name="kayttotarkoitus" required>
				<option value="">Valitse käyttötarkoitus</option>
				<option value="luistelu">Luisteluhiihto</option>
				<option value="perinteinen">Perinteinen hiihto</option>
				<option value="sauvakavely">Sauvakävely</option>
			</select>
		</p>

		<button type="submit">Laske sauvan pituus</button>
	</form>

	<?php if ($virhe !== ''): ?>
		<p><?= htmlspecialchars($virhe, ENT_QUOTES, 'UTF-8') ?></p>
	<?php elseif ($sauvanPituus !== null): ?>
		<p>Sopiva sauvan pituus: <?= number_format($sauvanPituus, 1, ',', ' ') ?> cm</p>
	<?php endif; ?>
</body>
</html>
