<?php

namespace Modules\Config\Http\Controllers;
use Auth;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Modules\Config\Actions\ExportCsv;
use Modules\Config\Actions\ExportJson;

class ConfigExportController extends Controller
{
    private $exportCsvAction;

    private $exportJsonAction;

    public function __construct(ExportCsv $exportCsv, ExportJson $exportJson)
    {
        $this->exportCsvAction = $exportCsv;

        $this->exportJsonAction = $exportJson;
    }

    public function exportCsv()
    {
        /**
         * Returns file path of the exported file.
         * Export listing of the resource as csv format.
         */

        $filePath = $this->exportCsvAction->execute();

        return response()->download($filePath);
    }

    public function exportJson()
    {
        /**
         * Returns file path of the exported file.
         * Export listing of the resource as json fromat.
         */

        $filePath = $this->exportJsonAction->execute();

        return response()->download($filePath);
    }
}
