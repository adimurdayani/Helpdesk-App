<?php

namespace App\Http\Controllers;

use App\Models\EmailRequest;
use Illuminate\Http\Request;

class EmailRequestController extends controller
{
    public function index()
    {
        $emailRequest = EmailRequest::all();
        return view('email-request' , compact($emailRequest));
    }
}
