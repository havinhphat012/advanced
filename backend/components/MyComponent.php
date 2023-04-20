<?php

namespace backend\components;

use Yii;
use yii\base\Component;

class MyComponent extends Component
{
    public function currencyConvert($currency_from)
    {
        return $currency_from;
    }
}
