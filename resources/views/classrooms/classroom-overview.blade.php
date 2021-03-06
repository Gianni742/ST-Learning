<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Classrooms:') }}
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

                    {{--Search box: --}}
                        @livewire('search-classrooms');
                    {{--End Search box: --}}

                    <div class="cr-header">
                        <h2>
                            <p class="font-bold">Your personal classrooms:</p>
                        </h2>
                    </div>


                </header>
                {{--End header:--}}

                <main class="overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container py-8 mx-auto">

                            <div class="st-container" id="dynamic_cr_results">

                                @foreach($classrooms as $classroom)
                                    <x-jet-info-card>
                                        <x-slot name="card_type">{{'st-card--classroom'}}</x-slot>
                                        <x-slot name="url">{{'classrooms'}}</x-slot>
                                        <x-slot name="id">{{$classroom->id}}</x-slot>
                                        <x-slot name="title">{{$classroom->name}}</x-slot>
                                        <x-slot name="description">{{$classroom->bio}}</x-slot>
                                        <x-slot name="createdBy">{{$classroom->created_by}}</x-slot>
                                        <x-slot name="memberCount">{{$classroom->member_count}}</x-slot>
                                    </x-jet-info-card>
                                @endforeach

                            <x-jet-card-submit></x-jet-card-submit>

                            </div>

                            {{--Pagination:--}}
                            <x-jet-pagination-nav>
                                <x-slot name="items">{{$classrooms->links()}}</x-slot>
                            </x-jet-pagination-nav>
                            {{--Pagination:--}}
                    </div>
                </main>
            </div>
        </div>

</x-app-layout>
