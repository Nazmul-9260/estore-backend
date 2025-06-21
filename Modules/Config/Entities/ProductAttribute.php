<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = "product_attributes";

    protected $guarded = [];

    public function attributeName()
    {
        $productAttributeConfig =
            DB::table('master_common_configurations')
            ->where('type', 'product_attribute_type')->where('value', $this->product_attribute_type_id)->first();

        return $productAttributeConfig->name;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }
}
