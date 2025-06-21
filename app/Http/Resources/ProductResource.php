<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Config\Entities\Product;
use Modules\Config\Entities\ProductQa;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            "id" => $this->id,
            "name" => $this->title,
            "image" => asset($this->image),
            "brand" => $this->productBrand ? $this->productBrand->name : null,
            "price" => $this->sell_price,
            "discount" => $this->discount_percentage ?: 0,
            "vatPercentage" => $this->tax_class,
            "dealStartTime" => "2024-11-03T12:00:00Z",
            "dealDuration" => "86400000",
            "category" => $this->productCategory ? $this->productCategory->title : null,
            "subCategory" => $this->productSubCategory ? $this->productSubCategory->title : null,
            "categoryId" => $this->category_id,
            "subCategoryId" => $this->subcategory_id,
            "brandId" => $this->brand_id,
            "tags" => $this->productTagNames(),
            "images" => $this->productImages->map(function ($image) {
                return asset($image->product_image);
            }),
            "quickOverview" => $this->details,
            "specifications" => $this->specification,
            "qAndA" => ProductQaResource::collection($this->productQas),
            "reviewsList" => ProductReviewResource::collection($this->productReviews),
            "showPrice" => $this->productShowPrice(),
            "attributes" => ProductAttributeResource::collection($this->productAttributes()),
            "files" => ProductFileResource::collection($this->productFiles)

        ];
    }
}
