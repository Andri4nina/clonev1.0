<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Messagerie;
use Illuminate\Http\Request;
use Illuminate\Validation\NestedRules;

class MessageController extends Controller
{
    public function index(Request $request)
    {
     /* Prendre les derniers discussion */
     $conversationGlobal = Conversation::select('conversations.*','messageries.Libelle as last_message' ,'messageries.created_at as last_message_date')
     ->leftJoin('messageries', 'messageries.id_conversation', '=', 'conversations.id')
     ->where('type', 'global')
     ->where('conversations.id', '1')
     ->latest('messageries.created_at') 
     ->selectRaw('TIMESTAMPDIFF(SECOND, messageries.created_at, NOW()) AS seconds_diff')
     ->first();
 
     $boxconversationGlobal = Conversation::select('conversations.*','messageries.*' ,'users.name')
     ->leftJoin('messageries', 'messageries.id_conversation', '=', 'conversations.id')
     ->leftJoin('users', 'users.id', '=', 'messageries.id_user')
     ->where('type', 'global')
     ->where('conversations.id', '1')
     ->latest('messageries.created_at') 
     ->get();
 


        return view('message.message', compact('conversationGlobal','boxconversationGlobal'));
        
    }



    public function addmessage(Request $request){
        $request->validate([
            'messagecontent' => 'required',
        ]);

        $message = new Messagerie();
        $message->id_user = $request->input('the_user');
        $message->id_conversation = $request->input('the_conversation');
        $message->Libelle = $request->input('messagecontent');
       
        $message->save();
        return redirect()->back();
    }
}
