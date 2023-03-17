<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        return view('admin.staff.index', [
            "staffs" => Staff::latest()->filter(request(['search']))->paginate(5)->withQueryString()
           ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.staff.store');
        return view('admin.staff.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
        ]);
        $staff = Staff::create($data);
        if ($request->hasFile('image')) {
            $staff->addMediaFromRequest('image')->toMediaCollection('image');
        }
        toast('Created Staff Successfully', 'success');
        return redirect()->route('admin.staff.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = Staff::findOrFail($id);
        $url = route('admin.staff.update', $staff);
        return view('admin.staff.form', compact('url', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $staff = Staff::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string'
        ]);
        if ($request->hasFile('image')) { // check if a new image has been uploaded
            if ($staff->hasMedia('image')) { // check if an existing image exists
                $staff->getFirstMedia('image')->delete(); // delete the existing image
            }
            $staff->addMediaFromRequest('image')->toMediaCollection('image'); // add the new image
        } else if ($request->input('delete_image')) { // check if the delete image checkbox is checked
            $staff->clearMediaCollection('image'); // delete the existing image
        }

        $staff->update($data);

        toast('Update Staff Successfully', 'success');
        return redirect()->route('admin.staff.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

       alert()->success('SuccessAlert','Delete Data Staff Successfully');
       return redirect()->route('admin.staff.index');
    }
}
