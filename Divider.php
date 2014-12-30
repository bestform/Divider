<?php

namespace Bestform\Divider;


class Divider
{
    static $PARTS_MONEY_EURO = [1, 2, 5, 10, 20, 50, 100, 200, 500, 1000, 2000, 5000, 10000, 200000, 500000];
    /**
     * @var array
     */
    private $parts;

    function __construct(array $parts = null)
    {
        $this->parts = $parts ?: self::$PARTS_MONEY_EURO;
        $this->checkParts();
        usort($this->parts, function($a, $b){return $b > $a;});
    }


    /**
     * @param $amount
     * @return array
     */
    public function divide($amount)
    {
        $result = [];
        foreach($this->parts as $value){
            $partsOfValueInAmount = floor($amount / $value);
            if(0.0 === $partsOfValueInAmount){
                continue;
            }
            $result[$value] = $partsOfValueInAmount;
            $amount -= $partsOfValueInAmount * $value;
        }

        if(0 < $amount){
            $result["REST"] = $amount;
        }

        return $result;
    }

    private function checkParts()
    {
        foreach($this->parts as $part){
            if(is_float($part)){
                throw new \InvalidArgumentException("No floats allowed because all hell breaks loose, when working with them in this context (which most probably is money. Do not use floats for money.)");
            }
        }
    }

}