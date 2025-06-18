<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index() {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chat.index', compact('users'));
    }

    public function getMessages(User $user) {
        $messages = Message::where(function ($q) use ($user) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->with('repliedMessage')->orderBy('created_at')->get();

        return view('chat.index', [
            'users' => User::where('id', '!=', Auth::id())->get(),
            'activeUser' => $user,
            'messages' => $messages
        ]);
    }

    public function send(Request $request) {
        $path = null;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'attachment' => $path,
            'reply_to' => $request->reply_to
        ]);

        return back();
    }
}
?>