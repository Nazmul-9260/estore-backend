<?php

namespace Modules\Config\Actions;

use Modules\Config\Entities\Config;
use Illuminate\Support\Facades\Storage;

class ExportCsv
{

    public function execute()
    {
        /**
         * Create The CSV File, Return CVS File Path to download.
         * 
         */

        $headers = array_keys(Config::find(1)->getAttributes());

        $configs = Config::all()->toArray();

        $configRecordValues = collect($configs)->map(function ($obj) {
            return array_values($obj);
        });

        $fileName = time() . '_export_config_data.csv';

        Storage::disk('public')->put('exports/' . $fileName, '');

        $filePublicPath = storage_path('app/public/exports/' . $fileName);

        $stream = fopen($filePublicPath, 'w');
        fputcsv($stream, $headers);
        foreach ($configRecordValues as $values) {
            fputcsv($stream, $values);
        }
        fclose($stream);

        return $filePublicPath;
    }

    public function execute_documentation()
    {
        /**
         * Contrroller Method Copied
         * 
         */
        $headers = array_keys(Config::find(1)->getAttributes());

        // return $headers;

        $configs = Config::all()->toArray();

        $configRecordValues = collect($configs)->map(function ($obj) {
            return array_values($obj);
        });

        // return $configRecordValues;

        // return $configs;

        // $handle = fopen()

        $fileName = time() . '_export_config_data.csv';

        Storage::disk('public')->put('exports/' . $fileName, '');

        $filePublicPath = storage_path('app/public/exports/' . $fileName);

        //return $filePublicPath;
        //$contents = Storage::disk('public')->get('exports/' . $fileName);
        //return $contents;
        //Perfecto
        //return response()->download($filePublicPath );

        // $stream = fopen($filePublicPath, 'w');
        // fputcsv($stream, $headers);
        // foreach ($configRecordValues as $values) {
        //     fputcsv($stream, $values);
        // }
        // fclose($stream);

        // return response()->download($filePublicPath);
    }
}
