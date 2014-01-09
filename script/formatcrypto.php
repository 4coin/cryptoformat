<link rel="stylesheet" href="script/unitlegend.css">
<?php
// i hope this isn't crap.   tshabs 2014 (what is licence‽)
// if you are reading this, you own this code, non-exclusivley. (note: "this code" is the script contained in this file and does not include any dependencies which may be under their own respective licences)
// 

//config vars (you can setup different colour schemes per crypto here if you want; note i am colour blind so it is strongly recommended that you adjust the colours to your choosing)
$config['LTC']['coin_unit'] = "Ł";
$config['LTC']['coin_colour'] = "#BCC6CC";
$config['LTC']['coin_style'] = "strong"; //any html tag, eg u, i, strong, b, span
$config['LTC']['milli_unit'] = "mŁ";
$config['LTC']['milli_colour'] = "#fff8ef";
$config['LTC']['milli_style'] = "span"; //any html tag, eg u, i, strong, b, span
$config['LTC']['micro_unit'] = "µŁ";
$config['LTC']['micro_colour'] = "#C5CFD5";
$config['LTC']['micro_style'] = "i"; //any html tag, eg u, i, strong, b, span
$config['LTC']['smallestunit_colour'] = "#FFF5EA";
$config['LTC']['smallestunit_unit'] = "smallest unit";
$config['LTC']['smallestunit_style'] = "span"; //any html tag, eg u, i, strong, b, span

$config['BTC']['coin_unit'] = "฿";
$config['BTC']['coin_colour'] = "#D9D919";
$config['BTC']['coin_style'] = "strong"; 
$config['BTC']['milli_unit'] = "m฿";
$config['BTC']['milli_colour'] = "#DFDF2A";
$config['BTC']['milli_style'] = "span"; 
$config['BTC']['micro_unit'] = "µ฿";
$config['BTC']['micro_colour'] = "#96963A";
$config['BTC']['micro_style'] = "i";
$config['BTC']['smallestunit_colour'] = "#7C7C06";
$config['BTC']['smallestunit_unit'] = "satoshi";
$config['BTC']['smallestunit_style'] = "span";


function displayLegend($currency, $show_example = false){
    global $config;
    $configs = $config[$currency];

$return = "<table id='unitslegend'>
		<thead>
			<tr>
				<th>Symbol</th>
				<th>Decimal Equivalent ($currency)</th>
				<th>Style</th>
			</tr>
		</thead>
		<tbody>
			<tr>
                <td>$configs[coin_unit]</td>
                <td>1</td>
                <td>".displayCurrency(80.00000000, $currency, false)."</td>
            </tr>
            <tr>
                <td>$configs[milli_unit]</td>
                <td>0.001</td>
                <td>".displayCurrency(0.08000000, $currency, false)."</td>
            </tr>
            <tr>
                <td>$configs[micro_unit]</td>
                <td>0.000001</td>
                <td>".displayCurrency(0.00008000, $currency, false)."</td>
            </tr>
            <tr>
                <td>$configs[smallestunit_unit]</td>
                <td>0.00000001</td>
                <td>".displayCurrency(0.00000080, $currency, false)."</td>
            </tr>";
    if($show_example  == true){
        $return = $return . "<tr>
                <td>Example</td>
                <td>0.00000001</td>
                <td>".displayCurrency(1.14345907, $currency)."<br>".displayCurrency(1.14345907, $currency, true, true)."</td>
            </tr>";
}
	$return = $return . "</tbody>
</table>";
return $return;
    }

function displayCurrency($actual_value, $currency, $show_whole_thing = true, $show_all_units = false, $coin_unit_on_left = true){
global $config;
    $configs = $config[$currency];
    if(is_numeric($actual_value)){
        $actual_value = sprintf("%01.8f", $actual_value); //
        $coins = floor ( $actual_value );
        $subunits = explode(".",$actual_value);

        $millis = substr($subunits[1], 0,3);
        $millis = sprintf("%03d", $millis);
        $micros = substr($subunits[1], 3,3);
        $micros = sprintf("%03d", $micros);
        $smallestunit =substr($subunits[1], 6,2);
        $smallestunit = sprintf("%02d", $smallestunit);
 
        if($show_whole_thing == true){
            if($show_all_units == true){
                $result = " <font color='$configs[coin_colour]'><$configs[coin_style]>$coins</$configs[coin_style]>.</font><font color='$configs[milli_colour]'><$configs[milli_style]>$millis$configs[milli_unit]</$configs[milli_style]></font> <font color='$configs[micro_colour]'><$configs[micro_style]>$micros$configs[micro_unit]</$configs[micro_style]></font> <font color='$configs[smallestunit_colour]'><$configs[smallestunit_style]>$smallestunit$configs[smallestunit_unit]</$configs[smallestunit_style]></font>";
            }else{
                $result = " <font color='$configs[coin_colour]'><$configs[coin_style]>$coins</$configs[coin_style]>.</font><font color='$configs[milli_colour]'><$configs[milli_style]>$millis</$configs[milli_style]></font> <font color='$configs[micro_colour]'><$configs[micro_style]>$micros</$configs[micro_style]></font> <font color='$configs[smallestunit_colour]'><$configs[smallestunit_style]>$smallestunit</$configs[smallestunit_style]></font>";
                }
            $unit = "<font color='$configs[coin_colour]'>".$configs['coin_unit']."</font>";
                if($coin_unit_on_left == true){
                    $return = $unit . " " . $result ;
                    }else{
                        $return =  $result . " " . $unit;
                        }
        }else{
                $started = false;
            if($smallestunit > 0){
                $result = "<font color='$configs[smallestunit_colour]'><$configs[smallestunit_style]>$smallestunit</$configs[smallestunit_style]></font>";
                $unit = "<font color='$configs[smallestunit_colour]'>$configs[smallestunit_unit]</font>";
                $return = $result . " " . $unit ;
                $started = true;
                }
            if($micros > 0 || $started == true){
                if($micros == 0 && $millis == 0 && $coins == 0){
                    //dont show anything
                    }elseif($micros > 0 && $millis == 0 && $coins == 0){
                $result = "<font color='$configs[micro_colour]'><$configs[micro_style]>".ltrim($micros,'0')."</$configs[micro_style]></font>".$result;
                }else{
                $result = "<font color='$configs[micro_colour]'><$configs[micro_style]>$micros</$configs[micro_style]></font>".$result;
                }
                if($micros > 0 && !isset($unit)){ 
                    $unit = "<font color='$configs[micro_colour]'>".$configs['micro_unit']."</font>";
                    }
                $return = $result . " " . $unit ;
                $started = true;
                }
            if($millis > 0 || $started == true){
                if($millis == 0 && $coins == 0){
                    //dont show anything
                    }elseif($millis > 0 && $coins == 0){
                $result = "<font color='$configs[milli_colour]'><$configs[milli_style]>".ltrim($millis,'0')."</$configs[milli_style]></font>".$result;
                }else{
                    $result = "<font color='$configs[milli_colour]'><$configs[milli_style]>$millis</$configs[milli_style]></font>".$result;
                    }
                if($millis > 0 && !isset($unit)){ 
                    $unit = "<font color='$configs[milli_colour]'>".$configs['milli_unit']."</font>";
                }
                $return = $result . " " . $unit ;
                $started = true;
                }
            if($coins > 0 || $started == true){
                if($coins > 0){ 
                $result = "<font color='$configs[coin_colour]'><$configs[coin_style]>".ltrim($coins, '0')."</$configs[coin_style]>.</font>".$result;
                    $unit = "<font color='$configs[coin_colour]'>".$configs['coin_unit']."</font>";
                   if($coin_unit_on_left == true){
                    $return = $unit . " " . $result ;
                    }else{
                        $return =  $result . " " . $unit;
                        }
                }

                
                $started = true;
                }
        }
        return $return;
}else{
    return "Thats not a number dummy";
}
}

?>
