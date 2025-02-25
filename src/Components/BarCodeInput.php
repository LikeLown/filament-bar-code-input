<?php

namespace LikeLown\BarCodeInput\Components;

use Filament\Forms\Components\TextInput;

class BarCodeInput extends TextInput
{
    protected string $view = 'filament-bar-code-input::components.bar-code-input';

    protected $qrBoxHeight = 150;
    protected $qrBoxWidth = 200;
    protected $fps = 10;

    protected static function getFacadeAccessor()
    {
        return \LikeLown\BarCodeInput\Components\BarCodeInput::class;
    }


    public function qrBoxHeight(int|\Closure|null $qrBoxHeight): static
    {

        $this->qrBoxHeight = $qrBoxHeight;

        return $this;
    }

    public function getQrBoxHeight(): int
    {
        return $this->evaluate($this->qrBoxHeight);
    }

    public function qrBoxWidth(int|\Closure|null $qrBoxWidth): static
    {

        $this->qrBoxWidth = $qrBoxWidth;

        return $this;
    }

    public function getQrBoxWidth(): int
    {
        return $this->evaluate($this->qrBoxWidth);
    }

    public function fps(int|\Closure|null $fps): static
    {
        $this->fps = $fps;

        return $this;
    }

    public function getFps(): int
    {
        return $this->evaluate($this->fps);
    }

}
