<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{

    protected $table = "product_sub_categories";

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public static function title($id)
    {
        return  self::where('id', $id)->first()->title;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id', 'id');
    }

    public static function getDropDownList($fieldName, $id = NULL)
    {
        $str = "<option value=''>Select One</option>";
        $lists = self::orderBy($fieldName, 'asc')->get();
        if ($lists) {
            foreach ($lists as $list) {
                if ($id != NULL && $id == $list->id) {
                    $str .= "<option  value='" . $list->id . "' selected>" . $list->$fieldName . "</option>";
                } else {
                    $str .= "<option  value='" . $list->id . "'>" . $list->$fieldName . "</option>";
                }
            }
        }
        return $str;
    }
}
