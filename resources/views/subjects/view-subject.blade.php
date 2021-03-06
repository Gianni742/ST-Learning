<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Subjects:') }}
        </h2>
    </x-slot>

    <div x-data="{ sidebarOpen: false }" class="flex h-auto bg-gray-200">
        <x-jet-nav-sidebar>
            <x-slot name="url">{{"Classrooms"}}</x-slot>
        </x-jet-nav-sidebar>

        <div class="w-full">
            {{--header start:--}}
            <header class="flex py-8 px-6 bg-white border-b-4 border-indigo-600">
                {{--Expand btn: --}}
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                    </svg>
                </button>
                <div class="cr-header">
                    <h2>
                        <a href="/classrooms/{{$subject->fk_classroom_id}}" class="st-hover font-bold text-lg">{{$parent_page_name}}</a>
                    @if($is_child_page)
                        <span class="font-bold">{{'>'}}</span>
                        <a href="{{url()->current()}}" class="st-hover font-bold">{{$subject->name}}</a>
                    @endif
                    </h2>
                </div>
            </header>

            <main class="overflow-x-hidden overflow-y-auto bg-gray-200">

               <div class="container subject-grid-container py-8 mx-auto">
                        <div class="st-card st-card--headers"><h4>General info:</h4></div>
                        <div class="st-card st-card--headers"><h4>Notes:</h4></div>

                        @php $adminName = 'Made by: ' . $adminName  @endphp

                        <div class="st-card card-editable subject-info shadow-sm">
                                <div class="st-item-flex">
                                    <h3 class="text-3xl mt-5">{{$subject->name}}</h3>
                                </div>

                                <form method="POST" action="{{ route('subjects.update', [$subject->fk_classroom_id, $subject->id])}}">
                                    {{csrf_field()}}
                                    @method('PUT')
                                    <textarea {{$user_role == 'spectator' ? 'disabled' : ''}}  placeholder="Set a bio for this classroom:" class="no-outline" name="sub_bio">{{$subject->bio}}</textarea>


                                    @if($user_role == 'admin' || $user_role == 'user')
                                    {{--// Subject settings:--}}
                                    @livewire('subject-settings', ['subject' => $subject])
                                    {{--// Subject settings:--}}
                                    @endif

                                </form>
                        </div>


                            <div class="notes-container st-scroll-custom">
                                @foreach($subject_notes as $note)
                                    <x-jet-card-note>
                                        <x-slot name="classroom_id">{{$subject->fk_classroom_id}}</x-slot>
                                        <x-slot name="subject_id">{{$subject->id}}</x-slot>
                                        <x-slot name="note_id">{{$note->id}}</x-slot>
                                        <x-slot name="title">{{$note->name}}</x-slot>
                                        <x-slot name="description">{{$note->content}}</x-slot>
                                        <x-slot name="madeBy">{{$adminName}}</x-slot>
                                    </x-jet-card-note>
                                @endforeach

                         @if($user_role == 'admin' || $user_role == 'user')
                                {{--Limit creation to max 20 notes per classroom:--}}
                                @if((count($subject_notes)) < 20)
                                    <form id="addNote" method="POST" action="{{ route('notes.store', ['classroom_id' => $subject->fk_classroom_id, 'subject_id' => $subject->id])}}">
                                        @csrf
                                        <div class="createNote st-card cursor-pointer st-card--note shadow-sm hover:opacity-50">
                                            <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">{{ 'Create new..' }}</h4>
                                            <div class="pt-8 pb-4"></div>
                                            </div>
                                        </div>
                                        <div class="p-1 bg-indigo-600 bg-opacity-75"></div>
                                    </form>
                                @endif
                            </div>
                            {{-- end of notes --}}
                        @endif

                           <div class="st-card st-card--headers"><h4>Useful links:</h4></div>
                           <div class="st-card--headers"><h4></h4></div>

                             {{-- Subject links: --}}
                            <div class="st-card card-editable shadow-sm">
                                <div class="st-scroll-custom useful-links pr-5">
                                    @livewire('subject-links', ['subject' => $subject, 'user_role' => $user_role])
                                </div>
                            </div>

                </div>
            </main>
        </div>
    </div>
</x-app-layout>