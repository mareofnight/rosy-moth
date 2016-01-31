<?php
namespace RosyMoth\Database;

use RosyMoth\Color\Color;
use RosyMoth\Database\DB;
use PDO;

class Finder
{
    const SEARCH_RANGE = 50;
    
    /** @var PDO $db */
    private $db;

    public function __construct(PDO $db = null)
    {
        $this->db = $db ?: DB::getInstance();
    }

    public function itemsByColor(Color $color)
    {
        $query = 'SELECT * FROM ItemColor
            JOIN Item ON Item.itemID = ItemColor.itemID
            WHERE red between :minRed and :maxRed
              And green between :minGreen and :maxGreen
              AND blue between :minBlue and :maxBlue';
        $statement = $this->db->prepare($query);
        $statement->bindValue('redRangeBottom', $color->getRed() - self::SEARCH_RANGE);
        $statement->execute(array(
            'minRed' => $color->getRed() - self::SEARCH_RANGE,
            'maxRed' => $color->getRed() + self::SEARCH_RANGE,
            'minGreen' => $color->getGreen() - self::SEARCH_RANGE,
            'maxGreen' => $color->getGreen() + self::SEARCH_RANGE,
            'minBlue' => $color->getBlue() - self::SEARCH_RANGE,
            'maxBlue' => $color->getBlue() + self::SEARCH_RANGE,
        ));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
