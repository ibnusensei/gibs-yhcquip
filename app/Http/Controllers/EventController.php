<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.event.event', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.event.store');
        return view('admin.event.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string'
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published') ? true : false;
        $event = Event::create($data);

        if ($request->hasFile('images')) {
            $event->addMediaFromRequest('images')->toMediaCollection('images');
        }

        return redirect()->route('admin.event.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.show', compact('event'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $url = route('admin.event.update', $event);

        return view('admin.event.form', compact('url', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string'
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published') ? true : false;
        $event->update($data);

        if ($request->hasFile('images')) { // check if a new image has been uploaded
            if ($event->hasMedia('images')) { // check if an existing image exists
                $event->getFirstMedia('images')->delete(); // delete the existing image
            }
            $event->addMediaFromRequest('images')->toMediaCollection('images'); // add the new image
        }

        return redirect()->route('admin.event.index');
    }

    /**
     * Create function for publishing event.
     */
    // public function publish(string $id)
    // {
    //     $event = Event::findOrFail($id);
    //     $event->update(['is_published' => !$event->is_published]);
    //     return redirect()->route('admin.event.index');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.event.index');
    }
}
