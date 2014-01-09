<?php
require_once('script/formatcrypto.php');


echo 'displayCurrency(1.14345907, "LTC")<br />';
echo displayCurrency(1.14345907, 'LTC');
echo "<br><br>";
echo 'displayCurrency(1.14345907, "LTC", true, true)<br />';
echo displayCurrency(1.14345907, 'LTC', true, true);
echo "<br><br>";
echo 'displayCurrency(0.04000000, "LTC", false)<br />';
echo displayCurrency(0.04000000, 'LTC', false);
echo "<br><br>";
echo 'displayCurrency(0.14345000, "LTC", false)<br />';
echo displayCurrency(0.14345000, 'LTC', false);
echo "<br><br>";
echo 'displayCurrency(0.00054000, "LTC", false)<br />';
echo displayCurrency(0.00054000, 'LTC', false);

echo "<br><br>";
echo 'displayCurrency(8546.00005400, "LTC", false)<br />';
echo displayCurrency(8546.00005400, 'LTC', false);

echo "<br><br>";
echo 'displayCurrency(8546.54000000, "LTC", false)<br />';
echo displayCurrency(8546.54000000, 'LTC', false);
echo "<br><br>";
echo 'displayCurrency(0.00002020, "LTC", false)<br />';
echo displayCurrency(0.00002020, 'LTC', false);
echo "<br><br>";
echo 'displayCurrency(8546.00005400, "BTC", false)<br />';
echo displayCurrency(8546.00005400, 'BTC', false);
echo "<br><br>";
echo 'displayLegend("BTC", true)<br />';
echo displayLegend('BTC', true);
?>
