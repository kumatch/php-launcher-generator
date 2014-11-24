<?php
namespace Path\To\Test;

use DateTime;

class FooBar
{
    protected $date;

    public function __construct(DateTime $date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }
}