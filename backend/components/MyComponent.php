<?php

namespace backend\components;

use Yii;
use yii\base\Component;

class MyComponent extends Component
{
    public function hello()
    {
        echo 'Welcome to the channel';
    }
}
