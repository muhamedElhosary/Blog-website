<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * add middleware with different guards to some functions.
     */
    public function __construct()
    {
        if(Auth::guard('admin')->check())
        {
        $this->middleware('auth:admin')->only(['index','destroy']);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages=Message::paginate(15);
        return view('admin.messages',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        //validate in rules of ContactRequest
        $request->validated();
        Message::create([
        'name'=>$request->name,
        'phone'=>$request->phone,
        'message'=>$request->message,
        'user_id'=>$request->user_id,
    ]);
        
        return redirect()->route('contact.create')->with(['success'=>'message sent successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message=Message::find($id);
        $message->delete();
        return redirect()->route('contact.index');
    }
}
