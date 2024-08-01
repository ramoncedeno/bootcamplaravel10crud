<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- @dump($errors->get('message')) <!-- Show the error on the form-->

                    <form method="POST" action="{{ route('chirps.store')}}">

                        <!--When using the POST method on forms in Laravel, it is important to include the Blade #csrf
                         directive to protect against CSRF (Cross-Site Request Forgery) attacks.-->
                        @csrf

                        <textarea name="message"

                        class="bg-transparent";
                        placeholder="{{__('What\'s on your mind?')}}"

                        >{{old('message')}}</textarea>

                            <!-- Show the error in the form -->
                            @error('message'){{$message}} @enderror                        

                        <x-primary-button >
                            
                             Chirp </x-primary-button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>