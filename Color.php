<?php
namespace Root;


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

    public function createHex()
    {
        // convert to RGB
        // construct
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

    public function getRedRange()
    {
        return array($this->red - 10, $this->red + 10);
    }
}
