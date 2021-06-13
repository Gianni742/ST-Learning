    {{-- Success is as dangerous as failure. --}}

{{--Search box: --}}
<div class="absolute mx-4 right-0 -mt-5">
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
        <i class="fas fa-search"></i>
    </span>
    <input class="items-end form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600"
           type="text"
           wire:model="query"
           placeholder="Search">
</div>
{{--End Search box: --}}



{{--buttons start:--}}

</header>

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">

        <div class="container mx-auto px-6 py-8">
            <h3 class="text-gray-700 text-3xl font-bold font-medium text-center">Dashboard</h3>

            <div class="flex flex-wrap -mx-6 mt-4">

                @foreach($classrooms as $classroom)
                    <x-jet-info-card>
                        <x-slot name="url">{{'classrooms.show'}}</x-slot>
                        <x-slot name="id">{{$classroom->id}}</x-slot>
                        <x-slot name="title">{{$classroom->name}}</x-slot>
                        <x-slot name="description">{{$classroom->bio}}</x-slot>
                    </x-jet-info-card>
                @endforeach

                {{--Start card:--}}
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-8">
                    <div class="flex items-center px-5 py-12 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                            <svg class="h-12 w-12 text-white" viewBox="0 0 28 30" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                        fill="currentColor"></path>
                                <path
                                        d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                        fill="currentColor"></path>
                                <path
                                        d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                        fill="currentColor"></path>
                                <path
                                        d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                        fill="currentColor"></path>
                                <path
                                        d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                        fill="currentColor"></path>
                                <path
                                        d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                        fill="currentColor"></path>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <form method="POST" action="{{ route('classrooms.store')}}">
                                @csrf
                                <div class="st-input">
                                    <div class="st-inputGroup">
                                        <input type="text" id="name" name="cr-name" class="no-outline" placeholder="My classroom.." />
                                        <span class="st-add-input">
                                                                    <i class="fas fa-times"></i>
                                                                  </span>
                                        <label for="name">Classroom name:</label>
                                    </div>
                                    <div class="text-gray-500 pb-2">Create a new classroom:</div>
                                    <x-jet-button type="submit">Add classroom</x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{--End card:--}}
                </div>




            </div>
    </main>