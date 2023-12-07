@extends('layouts.app')

@section('content')
<div class="mx-auto usersection">
    <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">Messagerie</h3>
    <div class=" max-w-6xl flex messsagebox">
        <div class="w-1/3 p-5 messCard">
            <h3 class=" text-xl pl-2 mb-5 font-semibold">Conversation</h3>
            <h4>Global</h4>
            <hr>
         
            <div class="cursor-pointer flex justify-center items-center h-28 max-h-28 p-5 conversation">
                <div class="h-full w-1/5">
                    <div class="w-full h-full rounded-full overflow-hidden">
                        <img src="{{ asset('images/pdp/nopdp.png')}}" alt="" class="rounded-full w-full h-full object-cover">
                    </div>
                   
                </div >
                <div class="flex overflow-hidden h-32 flex-col p-5 w-3/5">
                    <div class="font-semibold">
                        Discussion  de groupe
                    </div>
                    <div class="h-full overflow-hidden">
                        <p>{{ $conversationGlobal->last_message }}</p>
                    </div>
                </div>
                <div class="w-1/5 flex justify-end">
                    <span>
                        @if ($conversationGlobal->seconds_diff < 60)
                         {{ $conversationGlobal->seconds_diff }} s
                        @elseif ($conversationGlobal->seconds_diff < 3600)
                        {{ floor($conversationGlobal->seconds_diff / 60) }} Min
                        @elseif ($conversationGlobal->seconds_diff < 86400)
                        {{ floor($conversationGlobal->seconds_diff / 3600) }} H
                        @elseif ($conversationGlobal->seconds_diff < 604800)
                        {{ floor($conversationGlobal->seconds_diff / 86400) }} J
                        @else
                        le {{ $conversationGlobal->created_at}}
                        @endif
                    </span>

                </div>
            </div>
     
            <h4>Privee</h4>
            <hr>
            <div class="h-full w-full overflow-hidden">
                <div class="messagecontent overflow-y-scroll">

                    <div class="cursor-pointer flex justify-center items-center h-28 conversation">
                        <i class="bx bxs-plus-circle text-5xl"></i>
                    </div>
                  {{--    <div class="cursor-pointer flex justify-center items-center h-28 max-h-28 p-5 conversation">
                        <div class="h-full w-1/5">
                            <div class="w-full h-full rounded-full overflow-hidden">
                                <img src="{{ asset('images/pdp/' . Illuminate\Support\Facades\Auth::user()->pdp) }}" alt="" class="rounded-full w-full h-full object-cover">
                            </div>
                           
                        </div >
                        <div class="flex overflow-hidden flex-col p-5 w-3/5">
                            <div class="font-semibold">
                                @admin
                            </div>
                            <div>
                                <p>Salut!</p>
                            </div>
                        </div>
                        <div class="w-1/5">
                            <span>5:13</span>
                        </div>
                    </div>  --}}
                </div>
            </div>
           
        </div>

   
        <div class="max-h-screen p-5 relative w-2/3 messCard">
            <div class="w-full h-32 title_messagebox">
                <div class="flex h-full justify-center items-center">
                    <div class="w-1/5 h-full rounded-full overflow-hidden">
                        <img src="{{ asset('images/pdp/nopdp.png')}}" alt="" class="rounded-full w-full h-full object-cover">
                    </div>
                    <div class="w-4/5 text-center text-3xl font-semibold">
                        Discussion de groupe
                    </div>
                </div>
            </div>
            <form class="" action="{{ route('message.add') }}" method="POST">
                @csrf
                <div class="mb-5 w-full">
                    <div class="mb-5  flex justify-center items-center input-field">

                            <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->id}}">
 
                            <input type="hidden" name="the_conversation" value="1">
                           
                            <input type="text" name='messagecontent' placeholder="Ecrivez un message" class="w-11/12  bg-none">
                            <button><i class="bx bxs-send"></i></button>
                    </div>
                </div>
            </form>
            <div class="h-5/6 w-full overflow-hidden ">
                <div class="messagecontent Messagestyle overflow-y-scroll">
                    @foreach ($boxconversationGlobal as $message)
                        @if($message->id_user === \Illuminate\Support\Facades\Auth::user()->id)
                        <div class="relative  flex justify-start">
                            <div class="mb-8 w-9/12 message Mymessage">
                                <p>{{ $message->Libelle }}</p>
                            </div>
                            <div class="absolute bottom-2">
                                <span class="text-xs" >par {{ $message->name }}</span>
                            </div>
                        </div>
                        @else
                        <div class="relative  flex justify-end">
                            <div class="mb-8  w-9/12 message Othermessage">
                                <p>{{ $message->Libelle }}</p>
                            </div>
                            <div class="absolute bottom-2">
                                <span class="text-xs" >par {{ $message->name }}</span>
                            </div>
                        </div>
                        @endif
                   @endforeach
                   
                   
                 
                   
                   
                   
                   
                   
                   
                   

                </div>
               
            </div>
           
            <div>

            </div>
        </div>
    </div>
  
</div>
@endsection