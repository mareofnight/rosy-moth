<?php
namespace RosyMoth\Color;

class Color
{
    private $red;
    private $green;
    private $blue;

    public function __construct($red, $green, $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public static function createFromHex($hexCode)
    {
        $hexCode = self::normalizeHexCode($hexCode);
        return new self(
            hexdec(substr($hexCode, 0, 2)),//red
            hexdec(substr($hexCode, 2, 2)),//green
            hexdec(substr($hexCode, 4, 2))//blue
        );

    }

    public function getRed()
    {
        return $this->red;
    }

    public function getBlue()
    {
        return $this->blue;
    }

    public function getGreen()
    {
        return $this->green;
    }

    private static function normalizeHexCode($hexCode)
    {
        preg_match('/[\w\d]{6}|[\w\d]{3}/', $hexCode, $regexResult);
        $hexCode = $regexResult[0];
        if (strlen($hexCode) === 6) {
            return $hexCode;
        }
        $red = substr($hexCode, 0, 1);
        $green = substr($hexCode, 1, 1);
        $blue = substr($hexCode, 2, 1);
        return "$red$red$green$green$blue$blue";
    }
}
