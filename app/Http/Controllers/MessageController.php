<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Mail\ProductInquiry;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Message::orderBy('name', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        //
        $message = new Message();
        $message->name = $request->name;
        $message->email = $request-> email;
        $message->subject = $request->subject;
        $message->flag = $request-> flag;
        $message->guest_id = $request->guest_id;
        $message->user_id = intval($request->user_id);
        $message->user_email = $request->user_email;
        $message->product_user = intval($request->product_user);
        $message->product_id = intval($request->product_id);
        $message->product_name = $request->product_name;
        $message->product_image = $request->product_image;
        $message->description = $request-> description;
        $message->profileurl = $request-> profileurl;

        $message->save();
        // $message->user_email
        Mail::to('nsambai72@gmail.com')->send(new ProductInquiry($message));
        return[
            "data" => $message,
            "status" => 200,
            "message" =>"successfully created message"
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }



    public function delete($id)
    {
        //
        $message = Message::find($id);
        $message->delete();
        $response = [
            'message' => 'product successfully Deleted',
            'success' => true,

        ];

        return $response;
    }
}
