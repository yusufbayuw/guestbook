<div class="max-w-md mx-auto mt-20 sm:mt-40 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    
    <img src="{{asset('images/brand.png')}}" alt="" class="h-200 mb-5">
    
    <div>
        <form wire:submit="create" class="space-y-4">
            {{ $this->form }}

            <button type="submit" class="w-full py-2 px-4 bg-blue-600 dark:bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors duration-300">
                Kirim
            </button>
        </form>

        <x-filament-actions::modals />
    </div>
    
</div>
