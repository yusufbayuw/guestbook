<?php

namespace App\Livewire;

use App\Models\Guest;
use Livewire\Component;

class ThanksGuest extends Component
{
    public $uuid;
    public $guest;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->guest = Guest::where('uuid', $uuid)->first();
    }

    public function render()
    {
        return view('livewire.thanks-guest', [
            'lama_kunjungan' => $this->guest->lama_kunjungan,
        ]);
    }
}
