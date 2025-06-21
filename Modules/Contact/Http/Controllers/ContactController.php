<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\Contact\Entities\Contact;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('Contact.index')) {
            abort(403);
        }
        $contacts = Contact::orderBy('id', 'desc')->get();

        return view('contact::contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Contact.create')) {
            abort(403);
        }
        return view('contact::contact.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        if (!Auth::user()->hasPermissionTo('Contact.store')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|min:1|max:100',
            'phone' => 'required|min:8|max:14'
        ]);

        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'user_id' => auth()->user()->id
        ]);

        session()->flash('message', 'Contact Created Successfully');

        session()->flash('type', 'success');

        return redirect('contact/contacts');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        if (!Auth::user()->hasPermissionTo('Contact.show')) {
            abort(403);
        }
        $contact = Contact::findOrFail($id);

        return view('contact::contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Contact.edit')) {
            abort(403);
        }
        $contact = Contact::findOrFail($id);

        return view('contact::contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('Contact.update')) {
            abort(403);
        }
        //

        $validated = $request->validate([
            'name' => 'required|min:1|max:100',
            'phone' => 'required|min:8|max:14'
        ]);

        $contact = Contact::findOrFail($id);

        if ($request->has('name')) {
            $contact->name = $request->name;
        }
        if ($request->has('phone')) {
            $contact->phone = $request->phone;
        }

        $contact->save();

        session()->flash('message', 'Contact Updated Successfully');

        session()->flash('type', 'warning');

        return redirect('contact/contacts/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermissionTo('Contact.destroy')) {
            abort(403);
        }
        //

        $contact = Contact::findOrFail($id);

        $contact->delete();

        session()->flash('message', 'Contact Deleted Successfully');

        session()->flash('type', 'danger');

        return redirect('contact/contacts');
    }

    public function getContactsDatatable()
    {
        if (!Auth::user()->hasPermissionTo('Contact.getContactsDatatable')) {
            abort(403);
        }

        $contacts = Contact::select(['id', 'name', 'phone']);

        return DataTables::of($contacts)
            ->addColumn('action', function ($row) {
                return '
                <div class="three-action-btn d-flex flex-nowrap">
                    <a class="show-btn" href="contacts/' . $row->id . '" data-id="' . $row->id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a class="edit-btn" href="contacts/' . $row->id . '/edit" data-id="' . $row->id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <form action="contacts/' . $row->id . '" method="POST" style="display:inline;" >
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button data-id="' . $row->id . '" class="delete-btn" style="border:none;background:none;outline:none" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                </div>
                ';
            })->rawColumns(['action'])
            ->make(true);

        //server side delete btn
        //<button data-id="' . $row->id . '" class="delete-btn" style="border:none;background:none;outline:none" type="submit" onclick="return confirm(\'Are you sure?\')"><i class="fa fa-trash" aria-hidden="true"></i></button>
    }

    /**
     * Ajax CRUD Endpoints
     * 
     * 
     */

    public function storeContactAjax(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Contact.storeContactAjax')) {
            abort(403);
        }
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|min:1|max:100',
                'phone' => 'required|min:8|max:14'
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => ['message' => $validator->errors(), 'type' => 'error']]);
            }

            Contact::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'user_id' => auth()->user()->id
            ]);

            return response()->json(['data' => ['message' => 'Contact Created Successfully', 'type' => 'success']]);
        } else abort(403);
    }

    public function showContactAjax($id)
    {
        if (!Auth::user()->hasPermissionTo('Contact.showContactAjax')) {
            abort(403);
        }
        $contact = Contact::findOrFail($id);

        return response()->json(['data' => ['message' => 'Contact Fetched', 'type' => 'success', 'contact' => $contact]]);
    }

    public function updateContactAjax(Request $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('Contact.updateContactAjax')) {
            abort(403);
        }
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|min:1|max:100',
                'phone' => 'required|min:8|max:14'
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => ['message' => $validator->errors(), 'type' => 'error']]);
            }

            $contact = Contact::findOrFail($id);

            if ($request->has('name')) {
                $contact->name = $request->name;
            }
            if ($request->has('phone')) {
                $contact->phone = $request->phone;
            }

            $contact->save();

            return response()->json(['data' => ['message' => 'Contact Updated Successfully', 'type' => 'success']]);
        } else abort(403);
    }

    public function destroyContactAjax($id)
    {
        if (!Auth::user()->hasPermissionTo('Contact.destroyContactAjax')) {
            abort(403);
        }
        //
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return response()->json(['data' => ['message' => 'Contact Successfully Deleted', 'type' => 'success', 'contact' => $contact]]);
    }




    public function getScopedLayoutViewPage()
    {
        if (!Auth::user()->hasPermissionTo('Contact.getScopedLayoutViewPage')) {
            abort(403);
        }
        return view('contact::contact.scoped');
    }
}
