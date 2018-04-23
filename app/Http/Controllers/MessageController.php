<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Events\MessageEvent;

class MessageController extends Controller
{
    
    public function index()
    {
    	return view('form');
    }

    public function store(Request $request)
    {

    	$data = $request->all();
    	$message = new Message($data);
    	$message->save();
        $user = (new User)->newQuery()->find($data['user']);
    	$event = new MessageEvent($message, $user);
    	event($event);
    }
}
