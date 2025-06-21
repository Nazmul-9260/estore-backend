<?php

namespace Modules\Config\Entities;

use Modules\Sales\Entities\SalesOrderLine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = "products";

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function productSubCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'subcategory_id', 'id');
    }

    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id', 'id');
    }

    public function productTags()
    {
        $productId = $this->id;

        $productTagsValueList = DB::table('product_tags')->where('product_id', $productId)->pluck('product_tag_id');

        $tags = DB::table('master_common_configurations')
            ->whereIn('value', $productTagsValueList)->where('type', 'product_tag')->get();

        return $tags;
    }

    public function productTagNames()
    {
        $productId = $this->id;

        $productTagsValueList = DB::table('product_tags')->where('product_id', $productId)->pluck('product_tag_id');

        $tags = DB::table('master_common_configurations')
            ->whereIn('value', $productTagsValueList)->where('type', 'product_tag')->get();

        return $tags->map(function ($tag) {
            return $tag->name;
        });
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

    public static function getSellPrice($id)
    {

        $price = self::leftJoin('product_sell_prices as ps', 'ps.product_id', '=', 'products.id')->select('products.*', 'ps.sell_price')->first();

        return $price;
    }

    public static function title($id)
    {
        return  self::where('id', $id)->first()->title;
    }

    public function productImages()
    {
        return $this->hasMany(ProductDetails::class, 'product_id', 'id');
    }

    public function salesOrderLine()
    {
        return $this->hasOne(SalesOrderLine::class, 'product_id', 'id');
    }

    public function productQas()
    {
        return $this->hasMany(ProductQa::class, 'product_id', 'id');
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')->orderBy('id', 'desc');
    }

    public function productShowPrice()
    {
        $productShowPriceValue = $this->price_show_status;

        $productShowPrice = DB::table('master_common_configurations')
            ->where('type', 'product_price_show_status')->where('value', $productShowPriceValue)->first();

        return $productShowPrice->name;
    }

    public function productAttributes()
    {
        $productAttributes = ProductAttribute::where('product_id', $this->id)->active()->get();

        return $productAttributes;
    }

    public function productFiles()
    {
        return $this->hasMany(ProductFile::class, 'product_id', 'id')->active();
    }
}
