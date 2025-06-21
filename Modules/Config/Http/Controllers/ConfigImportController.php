<?php

namespace Modules\Config\Http\Controllers;
use Auth;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\Config;

class ConfigImportController extends Controller
{
    /**
     * Import a listing of the Config resource.
     */

    public function importCsv(Request $request)
    {

        //return $request->all();
        //return $request->file('csv');

        $fileName = time() . '_import_data.csv';

        $path = $request->file('csv')->storeAs('public/imports/', $fileName);

        $streamPath = storage_path('app/public/imports/' . $fileName);

        $stream = fopen($streamPath, 'r');

        while (!feof($stream)) {
            $line = fgetcsv($stream);
            // var_dump($line);
            $configObjArr = [
                'type' => $line[0],
                'name' => $line[1],
                'value' => $line[2]
            ];

            $ifUniqueTypeNameValue = Config::ifUniqueTypeNameValue($configObjArr);
            $ifUniqueTypeValue = Config::ifUniqueTypeValue($configObjArr);
            if (!$ifUniqueTypeNameValue || !$ifUniqueTypeValue) {
                $config = new Config();
                $config->name = $configObjArr['name'];
                $config->type = $configObjArr['type'];
                $config->value = $configObjArr['value'];
                $config->status = 0;

                try {
                    if ($config->save()) {
                        echo "Success";
                    }
                } catch (Exception $e) {

                    echo $e->getMessage();
                }
            }
        }
        fclose($stream);

        session()->flash('message', 'Config Data Imported Successfully');

        session()->flash('type', 'success');

        return redirect()->back();

        // $testPath = storage_path('app/public/imports/' . $fileName);
        // return $path;
        // For download both the path works but when creating stream only storage_path()
        // function derived path works
        // return response()->download($path);
        // return response()->download($testPath);
    }

    public function importJson(Request $request)
    {


        $fileName = time() . '_import_data.json';

        $path = $request->file('json')->storeAs('public/imports/', $fileName);

        $streamPath = storage_path('app/public/imports/' . $fileName);

        $configRecords = json_decode(file_get_contents($streamPath));

        $successfulInserts = 0;

        foreach ($configRecords as $record) {
            $configObjArr = [
                'type' => $record->type,
                'name' => $record->name,
                'value' => $record->value
            ];

            $ifUniqueTypeNameValue = Config::ifUniqueTypeNameValue($configObjArr);
            $ifUniqueTypeValue = Config::ifUniqueTypeValue($configObjArr);
            if (!$ifUniqueTypeNameValue || !$ifUniqueTypeValue) {
                $config = new Config();
                $config->name = $configObjArr['name'];
                $config->type = $configObjArr['type'];
                $config->value = $configObjArr['value'];
                $config->status = 0;

                try {
                    if ($config->save()) {
                        echo "Success";
                        $successfulInserts++;
                    }
                } catch (Exception $e) {

                    echo $e->getMessage();
                }
            }
        }

        session()->flash('message', $successfulInserts . ' Config Data ' . 'Imported Successfully');

        session()->flash('type', 'success');

        return redirect()->back();
    }
}
