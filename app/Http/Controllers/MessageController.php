<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Ads;
use App\Models\User;
use App\Models\Message;
use App\Models\MessageRel;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $messages = User::find(Auth::user()->id)->ads()->orderBy('updated_at', 'desc')->paginate(15);
            return view('messages.index', compact('messages'));
        }

        return redirect("login");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllConvos()
    {
        if (Auth::check()) {

            $convos = DB::table('messages')
                // ->select('*')
                // ->where('to_id', Auth::user()->id)
                // ->orWhere('from_id', Auth::user()->id)
                // ->get();
            ->join('message_rels', function ($join) {
                $join->on('messages.id', '=', 'message_rels.message_id')
                    ->where('messages.to_id', Auth::user()->id);
            })
            ->get();

            // $messages = User::find(Auth::user()->id)->ads()->orderBy('updated_at', 'desc')->paginate(15);
            return view('messages.index', compact('convos'));
        }

        return redirect("login");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConvo($from_id)
    {
        if (Auth::check()) {

            $data_rel = [
                'status' => 'R'
            ];
            if (MessageRel::where('to_id', Auth::user()->id)->where('from_id', $from_id)->exists()) {

                MessageRel::find(MessageRel::where('to_id', Auth::user()->id)->where('from_id', $from_id)->first()->id)->update($data_rel);
            }

            $convo = DB::table('messages')

                ->select('*')
                ->where(function ($query) use ($from_id) {
                    $query->where('from_id', '=', Auth::user()->id)
                        ->orWhere('to_id', '=', Auth::user()->id);
                })
                ->where(function ($query) use ($from_id) {
                    $query->where('to_id', '=', $from_id)
                        ->orWhere('from_id', '=', $from_id);
                })
                ->get();

            // $messages = User::find(Auth::user()->id)->ads()->orderBy('updated_at', 'desc')->paginate(15);
            // echo $from_id;
            return view('messages.convo', compact('convo'))->with('id', $from_id);
        }

        return redirect("login");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newMessage($id)
    {
        if (Auth::check()) {
            $user_to = User::find($id)->name;
            $messages = User::find(Auth::user()->id)->ads()->orderBy('updated_at', 'desc')->paginate(15);
            return view('messages.newMessage', compact('messages'))->with('user_to', $user_to)->with('id', $id);
        }

        return redirect("login");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postMessage(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:60'
        ]);

        $data = [
            'from_u' => Auth::user()->name,
            'from_id' => Auth::user()->id,
            'to_id' => $id,
            'content' => $request->input('content')
        ];

        $message = new Message();
        $message->fill($data);
        $message->save();
        $lastId = DB::table('messages')->latest('id')->first();
        // var_dump($lastId);
        $data_rel = [
            'message_id' => $lastId->id,
            'from_id' => Auth::user()->id,
            'to_id' => $id,
            'status' => 'U'
        ];
        $data_rel2 = [
            'message_id' => $lastId->id,
            'from_id' => $id,
            'to_id' => Auth::user()->id,
            'status' => 'R'
        ];
        if (MessageRel::where('from_id', Auth::user()->id)->exists()) {
            MessageRel::find(MessageRel::where('from_id', Auth::user()->id)->first()->id)->update($data_rel);
        } else {
            $rel = new MessageRel();
            $rel->fill($data_rel);
            $rel->save();

            $rel2 = new MessageRel();
            $rel2->fill($data_rel2);
            $rel2->save();
        }

        if (Message::where('from_id', $id)->where('to_id', Auth::user()->id)->exists()) {

            return redirect()->route('convo', $id)->with('message', 'Your message was sent !');
        }

        return redirect()->route('messages', $id)->with('message', 'Your message was sent !');

    }
}
