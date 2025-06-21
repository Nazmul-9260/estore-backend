<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Config extends Model
{
    protected $table = 'master_common_configurations';
    protected $guarded = [];

    public function scopeActive()
    {
        return Config::where('status', 1);
    }

    public static function ifUniqueTypeNameValue(array $data)
    {
        $configObj = Config::query()->where('type', $data['type'])->where('name', $data['name'])
            ->where('value', $data['value'])->first();

        if ($configObj) {
            return true;
        } else {
            return false;
        }
    }

    public static function headTitleOnly($type, $value)
    {
        if ($type != '' && $value != '')
            $lists = Config::where("type", $type)->where('value', $value)->first();
        if ($lists)
            return $lists->name;
        else
        return '';
    }

    public static function ifUniqueTypeValue(array $data)
    {
        $configObj = Config::query()->where('type', $data['type'])->where('value', $data['value'])->first();

        if ($configObj) {
            return true;
        } else {
            return false;
        }
    }

    public static function lookup($type)
    {
        $dropDownList = '';

        $data = self::query()->active()->where('type', $type)->get();

        foreach ($data as $k => $entity) {
            $dropDownList .= '<option value="' . $entity->value . '">' . $entity->name . '</option>';
        }
        ;

        return $dropDownList;
    }
    public static function dropDownList($type, $value = NULL)
    {
        $lists = Config::where('type', $type)->where('status', 1)->get();
        $str = "<option value=''>Select One</option>";
        if ($lists) {
            foreach ($lists as $list) {
                if ($value != NULL && $value == $list->value) {
                    $str .= "<option value='" . $list->value . "' selected>" . $list->name . "</option>";
                } else {
                    $str .= "<option value='" . $list->value . "'>" . $list->name . "</option>";
                }
            }
        }
        return $str;
    }

    public static function dropDownListWithExclude($type, $attr='')
    {
        $lists = Config::where('type', $type)->where('status', 1)->whereRaw("value NOT IN('')")->get();
        $str = "<option value=''>Select One</option>";
        if ($lists) {
            foreach ($lists as $list) {
                $str .= "<option value='" . $list->value . "'>" . $list->name . "</option>";
            }
        }
        return $str;
    }

    public static function lookupGetDropDownList($type)
    {
        $dropDownList = '';

        $data = self::query()->where('type', $type)->get();

        foreach ($data as $k => $entity) {
            $dropDownList .= '<option value="' . $entity->value . '"' . '>' . $entity->name . '</option>';
        }
        ;

        return $dropDownList;
    }


    public static function lookupGetDropDownListWithSelected($type, $selectedValue)
    {
        $dropDownList = '';

        $data = self::query()->where('type', $type)->get();

        foreach ($data as $k => $entity) {
            $dropDownList .= '<option value="' . $entity->value . '"' . ($selectedValue == $entity->value ? 'selected' : '') . '>' . $entity->name . '</option>';
        }
        ;

        return $dropDownList;
    }
}
