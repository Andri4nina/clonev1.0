@extends('layouts.app')

@section('content')
<section class="w-full max-w-6xl  mx-auto">
    <div class="mx-auto usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">Messagerie</h3>
        <div class="w-full lg:w-6xl  min-h-screen flex flex-col-reverse lg:flex-row messsagebox">
            <div class="w-full lg:w-1/3 p-5 messCard">
                <h3 class=" text-xl pl-2 mb-5 font-semibold">Conversation</h3>
                <h4>Global</h4>
                <hr>

                <div class="cursor-pointer flex justify-center items-center h-28 max-h-28 p-5 conversation">
                    <div class="h-full w-1/5">
                        <div class="w-full h-full rounded-full overflow-hidden">
                            <img src="{{ asset('images/component/image/logo_court.png')}}" alt="" class="rounded-full w-full h-full object-contain ">
                        </div>

                    </div >
                    <div class="flex overflow-hidden h-32 flex-col p-5 w-3/5">
                        <div class="font-semibold">
                            Discussion  de groupe
                        </div>
                        <div class="h-full overflow-hidden">
                            <p>{!! nl2br(e($conversationGlobal->last_message))!!}</p>
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
                <hr>

                <h4>les utilisateurs connecte</h4>
                <div>
                    @foreach($users as $user)
                        <li class="text-xs my-5 flex justify-between ">
                            <div class="flex gap-2 justify-center items-center">
                                <div class="overflow-hidden  w-10 h-10 rounded-full">
                                    <img src="{{ asset('images/pdp/'.$user->pdp )}}" alt="" class="object-cover w-full h-full nopdpimg">
                                </div>
                                <div>
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class=" flex gap-2 justify-center items-center text-sm font-bold ">
                                <div>
                                    <div class="bg-green-600 w-3 h-3 rounded-full userstatus"></div>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </div>


            </div>


            <div class="overflow-hidden max-h-screen p-5 relative w-full lg:w-2/3 messCard">
                <div class="w-full h-32 title_messagebox">
                    <div class="flex h-full justify-center items-center">
                        <div class="w-1/5 h-full rounded-full overflow-hidden">
                            <img src="{{ asset('images/component/image/logo_court.png')}}" alt="" class="rounded-full w-full h-full object-cover ">
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
                <div class="h-5/6 w-full overflow-hidden " id="messagerie">
                    <div class="messagecontent Messagestyle h-auto mb-5 overflow-y-scroll">
                        @foreach ($boxconversationGlobal as $message)
                            @if($message->id_user === \Illuminate\Support\Facades\Auth::user()->id)
                            <div class="relative  flex justify-start">
                                <div class="mb-8 w-9/12 message Mymessage">
                                    <p>{!! nl2br(e($message->Libelle ))!!}</p>
                                </div>
                                <div class="absolute bottom-2">
                                    <span class="text-xs" >par Vous</span>
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
            </div>
        </div>
    </div>
</section>

@endsection
