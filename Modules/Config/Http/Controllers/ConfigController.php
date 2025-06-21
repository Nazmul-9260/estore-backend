<?php

namespace Modules\Config\Http\Controllers;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\Config;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('config::config.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('config::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('config::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('config::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function getConfigsDatatable()
    {

        $configs = Config::select(['id', 'name', 'type', 'value', 'status'])->orderBy('id', 'desc');
        //$configs = DB::select("select cc.id, cc.name, cc.type, cc.value from common_configurations cc");


        $configTypes = Config::select('type')->distinct()->get();
        $configStatusList = Config::select('status')->distinct()->get();


        return DataTables::of($configs)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button class="btn btn-sm btn-danger config-delete inline-editing-common" data-id="' . $row->id .  '" >' . 'Delete' . '</button>';
                return $btn;

            })->addColumn('type', function ($row) use ($configTypes) {
                $type = $row->type;
                $options = '';
                foreach ($configTypes as $config) {
                    $options .= '<option data-config-type="' . $config->type  . '" data-config-id="' . $row->id . '" value="' . $config->type . '"' . ($type == $config->type ? 'selected' : '')  . '>' . $config->type . '</option>';
                }
                $dropDown = '<select class="form-control inline-select-configs" name="config_type">'
                    . $options . '</select>';

                return $dropDown;
            })->addColumn('name', function ($row) use ($configTypes) {
                $span = '<span class="form-control inline-edit-configs-name" data-config-id="' . $row->id . '">'
                    . $row->name . '</span>';
                return  $span;
            })->addColumn('status', function ($row) use ($configStatusList) {
                $status = $row->status;
                $options = '';
                foreach ($configStatusList as $config) {
                    $options .= '<option data-config-status="' . $config->status  . '" data-config-id="' . $row->id . '" value="' . $config->status . '"' . ($status == $config->status ? 'selected' : '')  . '>' . ($config->status == '1' ? 'Active' : 'Inactive') . '</option>';
                }
                $dropDown = '<select class="form-control inline-select-configs-status" name="config_status">'
                    . $options . '</select>';

                return $dropDown;
            })->addColumn('value', function ($row) use ($configTypes) {
                $span = '<span class="form-control inline-edit-configs-value" data-config-id="' . $row->id . '">'
                    . $row->value . '</span>';
                return  $span;
            })
            ->rawColumns(['action', 'type', 'name', 'status', 'value'])
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->filterColumn('type', function ($query, $keyword) {
                $query->where('type', 'like', "%{$keyword}%");
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->where('status', 'like', "%{$keyword}%");
            })
            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('name', $order);
            })
            ->make(true);
    }

    public function updateConfigType(Request $request)
    {
        //return $request->all();
        $configId = $request->config_id;
        $value = $request->value;
        $config = Config::find($configId);
        $config->type = $value;
        if ($config->save()) {
            $response = [
                'saved_model' => $config,
                'message' => 'Changes saved successfully!',
                'type' => 'success'
            ];
            return response()->json(['data' => $response], 200);
        } else {
            $response = [
                'message' => 'Error updating config data!',
                'type' => 'error'
            ];
            return response()->json(['data' => $response], 200);
        }
    }

    public function updateConfigName(Request $request)
    {
        //return $request->all();
        $configId = $request->config_id;
        $value = $request->value;
        $config = Config::find($configId);
        $config->name = $value;
        if ($config->save()) {
            $response = [
                'saved_model' => $config,
                'message' => 'Changes saved successfully!',
                'type' => 'success'
            ];
            return response()->json(['data' => $response], 200);
        } else {
            $response = [
                'message' => 'Error updating config data!',
                'type' => 'error'
            ];
            return response()->json(['data' => $response], 200);
        }
    }

    public function getNewDataRowInputTemplate()
    {
        $configTypes = Config::select('type')->distinct()->get();

        return response()->json([
            'config_row_template' => view('config::config.partials.config-dt-row', ['configTypes' => $configTypes])->render()
        ], 200);
    }

    public function storeConfig(Request $request)
    {
        // return $request->all();

        $response = NULL;

        $validator = Validator::make($request->all(), [
            'config_type' => ['required'],
            'config_name' => ['required'],
            'config_value' => ['required', 'numeric'],
            'config_status' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            $response = [
                'message' => 'Error validation config data!',
                'type' => 'error',
                'errors' => $validator->errors()
            ];
            return response()->json(['data' => $response], 400);
        };

        $configDto = [
            'type' => $request->config_type,
            'name' => $request->config_name,
            'value' => $request->config_value
        ];
        $alreadyExistsTypeNameValue = Config::ifUniqueTypeNameValue($configDto);
        $alreadyExistsTypeValue = Config::ifUniqueTypeValue($configDto);
        if ($alreadyExistsTypeNameValue || $alreadyExistsTypeValue) {
            $response = [
                'message' => 'Config data already exits!',
                'type' => 'error',
                'errors' => 'Config data already exits!'
            ];
            return response()->json(['data' => $response], 200);
        }

        $config = new Config();
        $config->name = $request->config_name;
        $config->type = $request->config_type;
        $config->value = $request->config_value;
        $config->status = $request->config_status;

        if ($config->save()) {
            $response = [
                'saved_model' => $config,
                'message' => 'Changes saved successfully!',
                'type' => 'success'
            ];
            return response()->json(['data' => $response], 200);
        } else {
            $response = [
                'message' => 'Error updating config data!',
                'type' => 'error'
            ];
            return response()->json(['data' => $response], 200);
        }
    }

    public function updateConfigValue(Request $request)
    {
        //return $request->all();
        $configId = $request->config_id;
        $value = $request->value;
        $config = Config::find($configId);
        $config->value = $value;
        if ($config->save()) {
            $response = [
                'saved_model' => $config,
                'message' => 'Changes saved successfully!',
                'type' => 'success'
            ];
            return response()->json(['data' => $response], 200);
        } else {
            $response = [
                'message' => 'Error updating config data!',
                'type' => 'error'
            ];
            return response()->json(['data' => $response], 200);
        }
    }

    public function updateConfigStatus(Request $request)
    {
        //return $request->all();
        $configId = $request->config_id;
        $value = $request->value;
        $config = Config::find($configId);
        $config->status = $value;
        if ($config->save()) {
            $response = [
                'saved_model' => $config,
                'message' => 'Changes saved successfully!',
                'type' => 'success'
            ];
            return response()->json(['data' => $response], 200);
        } else {
            $response = [
                'message' => 'Error updating config data!',
                'type' => 'error'
            ];
            return response()->json(['data' => $response], 200);
        }
    }

    public function deleteConfig(Request $request)
    {
        if ($request->has('config_id')) {
            $config = Config::find($request->input('config_id'));
            if ($config->delete()) {
                $response = [
                    'message' => 'deleted successfully!',
                    'type' => 'success'
                ];
                return response()->json(['data' => $response], 200);
            } else {
                $response = [
                    'message' => 'Error deleting config data!',
                    'type' => 'error'
                ];
                return response()->json(['data' => $response], 400);
            }
        }
    }

    public function validateConfigData() {}
}
