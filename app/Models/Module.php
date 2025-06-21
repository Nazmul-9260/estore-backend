<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Submodule;

class Module extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function submodules()
    {
        return $this->hasMany(Submodule::class);
    }
}
