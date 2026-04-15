<?php

namespace App\Http\Controllers;

use App\Models\EmailRequest;
use Illuminate\Http\Request;

class LacakController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'nomor_tiket' => 'exists:email_requests,nomor_tiket'
        ]);

        $emailRequest = EmailRequest::where('nomor_tiket', $request->nomor_tiket)->first();
        return view('lacak-tiket', compact('emailRequest'));
    }
}
