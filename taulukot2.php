<?php
$arvosanat = [5, 3, 4, 2, 5, 1, 4];

echo "Arvosanat:<br>";
foreach ($arvosanat as $arvosana) {
	echo $arvosana . "<br>";
}

$summa = array_sum($arvosanat);
$keskiarvo = $summa / count($arvosanat);
$suurin = max($arvosanat);
$pienin = min($arvosanat);
$maarat = array_count_values($arvosanat);

echo "<br>Summa: " . $summa . "<br>";
echo "Keskiarvo: " . $keskiarvo . "<br>";
echo "Suurin arvosana: " . $suurin . "<br>";
echo "Pienin arvosana: " . $pienin . "<br>";

echo "<br>Arvosanojen lukumäärät:<br>";
foreach ($maarat as $arvosana => $maara) {
	echo $arvosana . ": " . $maara . " kpl<br>";
}
?>
