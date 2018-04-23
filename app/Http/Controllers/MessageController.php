<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
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

    	$event = new MessageEvent($message);
    	event($event);
    }
}
