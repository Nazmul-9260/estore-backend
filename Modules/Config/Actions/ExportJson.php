<?php

namespace Modules\Config\Actions;

use Modules\Config\Entities\Config;
use Illuminate\Support\Facades\Storage;

class ExportJson
{

    public function execute()
    {
        /**
         * Create The JSON File, Return CVS File Path to download.
         * 
         */

        $configs = json_encode(Config::all());

        $fileName = time() . '_export_config_data.JSON';

        Storage::disk('public')->put('exports/' . $fileName, '');

        $filePublicPath = storage_path('app/public/exports/' . $fileName);

        $stream = fopen($filePublicPath, 'w');

        fputs($stream, $configs);

        fclose($stream);

        return $filePublicPath;
    }
}
