<?php
echo '<pre>';
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo 'test';

require_once('../Database/DB.php');
require_once('../Color/Color.php');
use RosyMoth\Color\Color;


$db = RosyMoth\Database\DB::getAdminInstance();
$truncateeColors = $db->prepare('TRUNCATE TABLE ItemColor');
$truncateeColors->execute();
$truncateItems = $db->prepare('TRUNCATE TABLE Item');
$truncateItems->execute();

$items = json_decode(file_get_contents('dummydata.json'));

foreach ($items as $item) {
    foreach ($item->subtypes as $subtype) {
        $itemStatement = $db->prepare(
            'INSERT INTO Item (vendorID, vendorItemID, displayName, subtype) '.
            'VALUES (1, :vendorItemID, :displayName, :subtype)'
        );
        $itemStatement->bindValue('vendorItemID', $item->vendorItemID);
        $itemStatement->bindValue('displayName', $item->displayName);
        $itemStatement->bindValue('subtype', $subtype->subtype);
        $itemStatement->execute();
        $itemID = $db->lastInsertId();
        foreach ($subtype->colors as $hexColor) {
            $color = Color::createFromHex($hexColor);
            $colorStatement = $db->prepare('INSERT INTO ItemColor (itemID, red, green, blue) '.
                'VALUES (:itemID, :red, :green, :blue)');
            $colorStatement->bindValue('itemID', $itemID);
            $colorStatement->bindValue('red', $color->getRed());
            $colorStatement->bindValue('green', $color->getGreen());
            $colorStatement->bindValue('blue', $color->getBlue());
            $colorStatement->execute();
        }
    }
}

//$db = new PDO('mysql:host=localhost;dbname=mareofni_rosymoth', 'mareofni_rmAdmin', 'rosymoth100');
//$statement = $db->prepare('INSERT INTO Vendor (displayName) VALUES (:name)');
//$statement->bindValue('name', 'Fabric.com');
//$statement->execute();

