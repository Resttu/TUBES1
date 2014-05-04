<?php
libxml_use_internal_errors(true);

$html = file_get_contents('http://techno.okezone.com/breaking/56');
$html = str_replace(
    '<meta charset="utf-8" />',
    '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">',
    $html
);

$dom = new DOMDocument();
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);



$nodes = $xpath->query('//*[@id="subkanal-judul"]', NULL);
$name = $nodes->item(0)->nodeValue;
echo ":<table width='500' border='1'><tr><td>" . $name . "\n</td></tr></table><br>";

$nodes = $xpath->query('//div[@id="welcome"]');
$headerNode = $nodes->item(0);
$nodes = $xpath->query('', $headerNode);
$name = $nodes->item(0)->nodeValue;
echo "Name: " . $name . "\n<br>";

$nodes = $xpath->query('//*[@class="subkanal-content-list fl"]');

foreach ($nodes as $node) {
    $childNodes = $xpath->query('span', $node);
    $key = $childNodes->item(0)->nodeValue;
    $value = $childNodes->item(1)->nodeValue;
    echo $key . ' ' . $value . "\n";
}

?>
