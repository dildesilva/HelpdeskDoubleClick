<?php

namespace App\Http\Controllers;

use App\Models\doneEnftiket;
use Illuminate\Http\Request;

class Engdonetiket extends Controller
{
    public function doneENGtikets(Request $request)
    {
        $validated = $request->validate([
            'tokenNo' => 'required|numeric',
            'client' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'State' => 'required|string|max:255',
            'TUpdate' => 'string|max:255',
            'email' => 'required|email|max:255',
            'engid' => 'required|numeric',
        ], [
            'tokenNo.required' => 'Token number is required.',
            'client.required' => 'Client name is required.',
            'subject.required' => 'Subject is required.',
            'State.required' => 'State is required.',
            'email.required' => 'Email is required.',
            'engid.required' => 'Engineer ID is required.',

        ]);
        doneEnftiket::create([
            'tokenNo' => $request->tokenNo,
            'client' => $request->client,
            'subject' => $request->subject,
            'State' => $request->State,
            'email' => $request->email,
            'engid' => $request->engid,
            'TUpdate' => $request->TUpdate,
        ]);
        session()->flash('success', 'Branch created successfully.');
        return redirect()->back();
    }
}
