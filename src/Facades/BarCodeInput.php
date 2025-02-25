<?php

namespace LikeLown\BarCodeInput\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LikeLown\BarCodeInput\Components\BarCodeInput
 */
class BarCodeInput extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LikeLown\BarCodeInput\Components\BarCodeInput::class;
    }
}
