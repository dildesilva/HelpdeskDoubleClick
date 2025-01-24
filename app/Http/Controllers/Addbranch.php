<?php

namespace App\Http\Controllers;

use App\Models\addbranchM;
use Illuminate\Http\Request;

class Addbranch extends Controller
{
    public function addbranchdd(Request $request)
    {
        $messages = [
            'name.required' => 'The Branch name is required.',
            'contact.required' => 'The phone number is required.',
            'location.required' => 'The location is required.',
            'company.required' => 'The company name is required.',
        ];
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'company' => 'required|string|max:255',
        ], $messages);

        addbranchM::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'location' => $request->location,
            'company' => $request->company,
        ]);
        session()->flash('success', 'Branch created successfully.');
        return redirect()->back();
    }
}
