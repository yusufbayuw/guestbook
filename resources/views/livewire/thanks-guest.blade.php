<div class="max-w-md mx-auto mt-20 sm:mt-40 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-gray-200">
        Terima kasih sudah berkunjung 🙏
    </h1>
    @if ($lama_kunjungan)        
    <h2 class="text-lg font-bold mb-6 text-center text-gray-800 dark:text-gray-200">
        Anda telah berkunjung selama 
        @php
            $totalSeconds = (int) $lama_kunjungan * 3600;
            $jam = floor($totalSeconds / 3600);
            $menit = floor(($totalSeconds % 3600) / 60);
            $detik = $totalSeconds % 60;
        @endphp
        @if ($jam > 0)
            {{ $jam }} jam {{ $menit }} menit {{ $detik }} detik.
        @elseif ($menit > 0)
            {{ $menit }} menit {{ $detik }} detik.
        @else
            {{ $detik }} detik.
        @endif
    </h2>
    @endif
    <h3 class="text-lg font-bold mb-6 text-center text-gray-800 dark:text-gray-200">Sampai jumpa kembali dikunjungan selanjutnya 😊.</h3>

    <script>
        setTimeout(function() {
            window.location.href = "https://tarunabakti.or.id"; // Ganti dengan rute tujuan
        }, 5000);
    </script>
</div>
