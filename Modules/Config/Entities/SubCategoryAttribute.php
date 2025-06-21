<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategoryAttribute extends Model
{
    use HasFactory;
    protected $fillable = [];
    public static function getAttributeList($productId,$subCatId)
    {
        $data = SubCategoryAttribute::where('sub_cat_id',$subCatId)-> get();
        $newRow='';
        if($data){
            foreach($data as $dt){
                $values='';
                $data = ProductAttribute::where('product_id',$productId)->where('product_attribute_type_id', $dt->attribute_id)->first();
                if($data){
                    $values =  $data->attribute_value;
                }
                $newRow .= '<tr>';
                $newRow .= '<td>';
                $newRow .='<input class="form-control attribute-value" type="hidden" placeholder="Value" name="product_attribute_type_id[]" value="'.$dt->attribute_id.'">';
                $newRow .= Config::where('value',  $dt->attribute_id)->where('type', 'product_attribute_type')->first()->name;; 
                $newRow .= '</td>';
                $newRow .= '<td>';
                $newRow .='<input class="form-control attribute-value" type="text" value="'.$values.'" placeholder="Value" name="attribute_value[]">';
                $newRow .= '</td>';
                $newRow .= '<td>';
                $newRow .='<input class="form-control remarks" type="text" placeholder="Remarks" name="remarks[]">';
                $newRow .= '</td>';
                $newRow .=' <td><button type="button" class="btn btn-sm btn-danger remove-row">Remove</button></td>';
                $newRow .= '</tr>';
            }
        }
        return $newRow;
    }

 

    protected static function newFactory()
    {
        return \Modules\Config\Database\factories\SubCategoryAttributeFactory::new();
    }
}
