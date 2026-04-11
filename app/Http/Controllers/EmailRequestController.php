<?php

namespace App\Http\Controllers;

use App\Models\EmailRequest;
use Illuminate\Http\Request;

class EmailRequestController extends Controller
{
    public function index()
    {
        $emailRequest = EmailRequest::all();
        return view('email_request', compact($emailRequest));
    }
}
