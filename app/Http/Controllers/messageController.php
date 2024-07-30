<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Session;
class messageController extends Controller
{
    public function message_user()
    {
        $messages = Message::all();
        return view('admin.messages',['messages' => $messages]);
    }
    public function showMessage(string $id)
    {
        $message = Message::select('*')->where('id', $id)->get();
        Message::where('id',$id)->update(['read'=> 'yes']);
        $unread = Message::select('*')->where('read','no')->get();
        session::put('unread',$unread);
        return view('admin.showMessage',['message' => $message]);
    }
    public function deleteMessage(string $id)
    {
        Message::where('id',$id)->delete();
        return redirect('messages');
    }

}
