<?php

namespace App\Services;

use App\Models\HeroSlider;

class SliderService
{
    private $model;

    public function __construct(HeroSlider $model)
    {
        $this->model = $model;
    }

    public function getHeroSliders()
    {
        return $this->model::query()->orderBy('id', 'asc')->get();
    }
}
