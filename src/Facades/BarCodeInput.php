<?php

namespace LikeLown\BarCodeInput\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LikeLown\BarCodeInput\BarCodeInput
 */
class BarCodeInput extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LikeLown\BarCodeInput\BarCodeInput::class;
    }
}
