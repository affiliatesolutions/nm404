<?php

defined( 'ABSPATH' ) or die();

class SiteQueue extends SplMaxHeap  {
    private $size=10;

    public function  compare( $value1, $value2 ) {
        return ($value1["dist"] - $value2["dist"] );
    }

    //@override
    public function insert($value){
        if($this->count()>$this->size){
            $chk = $this->top();
            if($chk["dist"]>$value["dist"]) {
                $this->extract();
            } else {
                return;
            }
        }
        parent::insert($value);

    }
}