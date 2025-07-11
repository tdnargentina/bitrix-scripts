
<?php
$massiv = [
["one", "two","three"],
["раз","два", "три"],
["uno","dos","tres"]
];

$vivod = print_r($massiv);

echo $vivod. "<br>";

$content = "";
foreach ($massiv as $ma){
	foreach ($ma as $m){
		$content .= $m . " ";
		
	}
}

echo $content;



?>
