<?php

namespace Modules\Inventory\Entities;
use DB;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    public static function getDropDownList($fieldName, $id=NULL){
        $str = "<option value=''>Select One</option>";
        $lists = self::orderBy($fieldName,'asc')->get();
        if($lists){
            foreach($lists as $list){
                if($id !=NULL && $id == $list->id){
                    $str .= "<option  value='".$list->id."' selected>".$list->$fieldName."</option>";
                }else{
                    $str .= "<option  value='".$list->id."'>".$list->$fieldName."</option>";
                }

            }
        }
        return $str;
    }

    public static function stockQtyOfThisModel($productid) {
        $data = DB::table('inventories')
            ->select(DB::raw('sum(stock_in) as tStockIn'), DB::raw('sum(stock_out) as tStockOut'))
            ->where('inventories.product_id','=', $productid)
            ->first();
        if($data){
                $totalStockIn = $data->tStockIn;
                $totalStockOut = $data->tStockOut;
               return  ($totalStockIn - $totalStockOut);
        }else{
            return 0;
        }
    }

}
