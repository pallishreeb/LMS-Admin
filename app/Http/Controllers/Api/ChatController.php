<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
        // Function to retrieve chat messages
        // public function getMessages()
        // {
        //     $messages = ChatMessage::with('user')->orderBy('created_at', 'asc')->get();
    
        //     return response()->json(['messages' => $messages]);
        // }
        public function getMessages(Request $request)
{
    try {
        $user_id = $request->input('user_id');

        // Add condition to fetch messages only for the specified user_id
        $messages = ChatMessage::with('user')
            ->when($user_id, function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['messages' => $messages]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error fetching messages'], 500);
    }
}
  
        // Function to send a new chat message
        public function sendMessage(Request $request)
        {
            $request->validate([
                'message' => 'required|string',
            ]);
        
            $message = new ChatMessage([
                'message' => $request->input('message'),
                'user_id' => $request->input('user_id'),
            ]);
    
            $message->save();
    
            return response()->json(['message' => 'Message sent successfully']);
        }



        //delete a message
        public function deleteMessage(Request $request, $id)
{
    try {
        $user = Auth::user();
        $message = ChatMessage::findOrFail($id);

        // Check if the user is authorized to delete the message
        if ($user->id !== $message->user_id && !$user->is_admin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Use a database transaction to ensure consistency
        DB::beginTransaction();

        $message->delete();

        // Commit the transaction
        DB::commit();

        return response()->json(['message' => 'Message deleted successfully']);
    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();

        return response()->json(['error' => 'Error deleting message'], 500);
    }
}
}
