<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 21.06.2016
 * Time: 17:25
 */
class ConsultantList
{
    /** @var Consultant[] $consultants  */
    public $consultants;

    public function __construct($result)
    {
        /** @var ConsultantList $result */

        foreach($result->items as $item) {
            $this->consultants[] = new Consultant($item);
        }
    }
}