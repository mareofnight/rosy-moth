<?php
require_once('../Color/Color.php');
require_once('../Database/DB.php');
require_once('../Database/Finder.php');
use RosyMoth\Color\Color;

$color = Color::createFromHex($_GET['color']);
$finder = new \RosyMoth\Database\Finder();
$fabrics = $finder->itemsByColor($color);
echo json_encode($fabrics);
