<?php

namespace App\Http\Controllers;
use App\Models\TiketAdminMOD;
use App\Models\TiketAminMOD;
use App\Models\TiketEngMOD;
use App\Models\TiketUserMOD;
use App\Models\User;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class TikectUser extends Controller
{
    public function tiketSENDone(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'sender' => 'required|string|lowercase|email|max:255',
            'branch' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $ticket = TiketUserMOD::create($validated);
        return response()->json([
            'status' => 'success',
            'ticket' => $ticket,
        ]);
    }
    public function destroyCancel($id)
    {
        $post = TiketAdminMOD::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully');
    }
    public function assigned(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'assigne' => 'required|string',
            'sender' => 'required|string',
            'company' => 'required|string',
            'branch' => 'required|string',
            'state' => 'required|string',
            'dateCreated' => 'date',
            'description' => 'required|string',
        ]);
        TiketAdminMOD::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Ticket added successfully!'
        ]);

    }
    public function proEng(Request $request)
    {
        $request->validate([
            'AsingId' => 'required|numeric',
            'subject' => 'required|string',
            'sender' => 'required|string',
            'company' => 'required|string',
            'email' => 'required|string|lowercase|email|max:255',
            'branch' => 'required|string',
            'state' => 'required|string',
            'opendate' => 'date',
            'Assinreddate' => 'date',
            'description' => 'required|string',
        ]);
        TiketEngMOD::create($request->all());
        return redirect()->back()->with('success', 'Ticket added successfully!');
    }
    public function destroyuserAdmind($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        $ticket = TiketUserMOD::findOrFail($id);
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully!');
    }
    public function destroyDone($id)
    {
        $ticketDone = TiketEngMOD::findOrFail($id);
        $ticketDone->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully!');
    }
    public function destroyEn($id)
    {
        $ticket = TiketAdminMOD::findOrFail($id);
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully!');
    }
    public function updateState(Request $request, $id)
    {
        try {
            $request->validate([
                'state' => 'required|string'
            ]);
            $ticketsPro = TiketEngMOD::findOrFail($id);
            $ticketsPro->state = $request->state;
            $ticketsPro->save();
            return response()->json(['success' => 'Ticket state updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update ticket state: ' . $e->getMessage()]);
        }
    }
    public function updateTUpdate(Request $request, $id)
    {
        try {
            $request->validate([
                'TUpdate' => 'required|string',
                'OldTUpdate' => 'required|string',
            ]);
            $ticketsPro = TiketEngMOD::findOrFail($id);
            $oldUpdates = $ticketsPro->TUpdate;
            $newUpdate = $request->TUpdate;
            $updates = explode(' , ', $oldUpdates);
            $count = count($updates);
            $newUpdateWithIndex = ($count + 1) . '-> ' . $newUpdate;
            if ($oldUpdates) {
                $ticketsPro->TUpdate = $oldUpdates . ' , ' . $newUpdateWithIndex;
            } else {
                $ticketsPro->TUpdate = $newUpdateWithIndex;
            }
            $ticketsPro->save();
            return response()->json(['success' => 'Ticket update saved successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update ticket: ' . $e->getMessage()]);
        }
    }
    public function fetchUpdates($id)
    {
        try {
            $ticket = TiketEngMOD::findOrFail($id);
            return response()->json([
                'TUpdate' => $ticket->TUpdate,
                'state' => $ticket->state,
                'duration' => today()->diffInDays($ticket->Assinreddate), // Calculate duration if needed
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch data: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function adminupdateState(Request $request, $id)
    {
        try {
            $request->validate([
                'state' => 'required|string',
            ]);

            $ticketsPro = TiketAdminMOD::findOrFail($id);
            $ticketsPro->state = $request->state;
            $ticketsPro->save();

            return redirect()->back()->with('success', 'Ticket state updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update ticket state: ' . $e->getMessage());
        }
    }
    public function userupdateState(Request $request, $id)
    {
        $request->validate([
            'Assigned' => 'required|string',
        ]);
        $ticket = TiketUserMOD::findOrFail($id);
        $ticket->Assigned = $request->input('Assigned');
        $ticket->save();
        return response()->json(['success' => true]);
    }
    public function engupdateState(Request $request, $id)
    {
        try {
            $request->validate([
                'state' => 'required|string',
            ]);
            $ticketsPro = TiketEngMOD::findOrFail($id);
            $ticketsPro->state = $request->state;
            $ticketsPro->save();
            return redirect()->back()->with('success', 'Ticket state updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update ticket state: ' . $e->getMessage());
        }
    }
}




