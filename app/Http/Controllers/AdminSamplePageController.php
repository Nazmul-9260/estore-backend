<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class AdminSamplePageController extends Controller
{
    //

    public function getSamplePage()
    {
        return view('admin.sample_pages.index');
    }

    public function getContentPage()
    {

        return view('admin.sample_pages.content');
    }

    public function getDemoPage()
    {

        return view('admin.sample_pages.demo');
    }

    public function getComponentsPage()
    {

        return view('admin.sample_pages.components');
    }

    public function getSummerNotePage()
    {
        return view('admin.sample_pages.summer-note');
    }

    public function getYajraDatatablesPage()
    {

        $users = User::orderBy('id', 'desc')->get();

        return view('admin.sample_pages.datatables-yajra', compact('users'));
    }

    public function getDatatablesPage()
    {

        $users = User::orderBy('id', 'desc')->get();

        return view('admin.sample_pages.datatables-default', compact('users'));
    }

    public function getUsersDataUserList()
    {
        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at',]);

        // return DataTables::of($users)
        //     ->addColumn('view', function ($row) {
        //         return '<a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>';
        //     })->addColumn('edit', function ($row) {
        //         return '<a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
        //     })
        //     ->addColumn('delete', function ($row) {
        //         return '<a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>';
        //     })->rawColumns(['view', 'edit', 'delete'])
        //     ->make(true);

        return DataTables::of($users)
            ->addColumn('action', function ($row) {
                return '
                <div class="three-action-btn d-flex flex-nowrap">
                    <a href="/users/' . $row->id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="/users/' . $row->id . '/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <form action="/users/' . $row->id . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button style="border:none;background:none" type="submit" onclick="return confirm(\'Are you sure?\')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                </div>
                ';
            })->rawColumns(['action'])
            ->make(true);
    }

    public function getDashboardPage()
    {
        return redirect('home');
    }

    public function getModuleSettingsPage()
    {

        return view('admin.sample_pages.module-settings');
    }

    public function getUserSettingsPage()
    {
        return view('admin.sample_pages.user-settings');
    }

    public function getAdminDashboardPageOne()
    {
        return view('admin.sample_pages.admin-dashboard-one');
    }

    public function getAdminDashboardPageTwo()
    {
        return view('admin.sample_pages.admin-dashboard-two');
    }

    public function getAdminDashboardPageThree()
    {
        return view('admin.sample_pages.admin-dashboard-three');
    }

    public function getAdminDashboardPageFour()
    {
        return view('admin.sample_pages.admin-dashboard-four');
    }

    public function getLoginViaPhonePage()
    {
        return view('admin.sample_pages.login-via-phone');
    }
    public function getAppointment()
    {
        return view('admin.sample_pages.appointment_filter');
    }
    public function getPatientDashboard()
    {
        return view('admin.sample_pages.patient-dashboard');
    }
    public function getPatientProfile()
    {
        return view('admin.sample_pages.patient-profile');
    }
    public function getEditableDatatable()
    {
        return view('admin.sample_pages.editable-datatable');
    }
    public function getStepForm()
    {
        return view('admin.sample_pages.step-form');
    }
    public function EmployeeCreate()
    {
        return view('admin.sample_pages.employee-create');
    }
    
}
