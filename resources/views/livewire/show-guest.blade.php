<div class="max-w-md mx-auto mt-20 sm:mt-40 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <div class="mb-10">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-gray-200">
            Selamat Berkunjung👋🏻
        </h1>
        <h2 class="text-lg font-bold mb-1 text-center text-gray-800 dark:text-gray-200">
            dimohon jangan tutup halaman ini
        </h2>
        <p class="text-sm font-bold text-center text-gray-800 dark:text-gray-200">
            klik tombol pulang ketika Anda selesai berkunjung
        </p>
        <button wire:click='goHome'
            class="w-full py-2 mt-1 px-4 bg-blue-600 dark:bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors duration-300">
            🚶Pulang
        </button>
        <p>&nbsp;</p>
    </div>
    
    <div>
        <div class="mb-8">
            {{ $this->guestInfolist }}
        </div>      
    </div>
</div>