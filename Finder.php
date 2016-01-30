<?php
namespace Root;

class Finder
{
    public function getFabrics(Color $color)
    {
        $query = 'SELECT * from hasColor
            JOIN fabric ON fabric.fabricID = hasColor.fabricID
            WHERE
                (:redRangeTop between maxRed and minRed
                OR :redRangeBottom between maxRed and minRed
                OR maxRed betweeen :redRangeTop and :redRangeBottom
                OR minRed between :redRangeTop and :redRangeBottom)
                AND (:greenRangeTop between maxGreen and minGreen
                OR :greenRangeBottom between maxGreen and minGreen
                OR maxGreen betweeen :greenRangeTop and :greenRangeBottom
                OR minGreen between :greenRangeTop and :greenRangeBottom)
                AND (:blueRangeTop between maxBlue and minBlue
                OR :blueRangeBottom between maxBlue and minBlue
                OR maxBlue betweeen :blueRangeTop and :blueRangeBottom
                OR minBlue between :blueRangeTop and :blueRangeBottom)';
    }
}
