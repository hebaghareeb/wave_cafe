<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;
use App\Models\Beverages;
use App\Models\Message;
use Auth;
use Session;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function drinks()
    {
        $categories = Category::latest()->limit(3)->get();
        $beverages = Beverages::all();
        $special = Beverages::select('*')->where('special','yes')->get();
        return view('index',['categories' => $categories, 'beverages' => $beverages,'special' => $special]);
    }
    public function addMessage(Request $request)
    {
        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->content = $request->content;
        if(Auth::user() != null)
            $message->user_id = Auth::user()->id;
         else 
            $message->user_id = '0';
        $message->save();
        return redirect('homepage');
    }
    public function unreadMessage()
    {
        $unread = Message::select('*')->where('read','no')->get();
        session::put('unread',$unread);
        return view('admin.adminPanel');//,['unread' => $unread]);
    }
}
