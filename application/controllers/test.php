<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 20.07.2016
 * Time: 11:29
 */
class Test_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function action_index() {
        echo php_sapi_name(); exit;
        var_dump(Auth::check());
        return;
        echo Hash::make("serd12"); exit;
        echo $this->wilsonScore(100000, 0); exit;
    }

    /**
     * @param int $up
     * @param int $down
     * @return float
     */
    public function wilsonScore($up, $down)
    {
        $confidence = 1.959964;
        $total = $up + $down;
        if(!$total) {
            return 0;
        }
        $phat           = 1.0 * $up / $total;
        $numerator      = $phat + $confidence * $confidence / (2 * $total) - $confidence * sqrt($phat * (1 - $phat) / $total + $confidence * $confidence / (4 * $total));
        $denominator    = 1 + $confidence * $confidence / $total;
        return (float)$numerator / $denominator;
    }


}
