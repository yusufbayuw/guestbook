<?php

namespace App\Livewire;

use App\Models\Guest;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Livewire\Component;

class ShowGuest extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    public $uuid;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function guestInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record(Guest::where('uuid', $this->uuid)->first())
            ->schema([
                TextEntry::make('nama')
                    ->size(TextEntry\TextEntrySize::Large),
                TextEntry::make('nomor_hp')
                    ->size(TextEntry\TextEntrySize::Large),
                TextEntry::make('alamat')
                    ->size(TextEntry\TextEntrySize::Large),
                TextEntry::make('keperluan')
                    ->size(TextEntry\TextEntrySize::Large),
            ]);
    }

    public function goHome()
    {
        $guest = Guest::where('uuid', $this->uuid)->first();
        $guest->pulang = now();

        $hoursDifference = $guest->pulang->diffInHours($guest->datang);
        $minutesDifference = $guest->pulang->diffInMinutes($guest->datang) % 60;

        $decimalHours = $hoursDifference + ($minutesDifference / 60);
        $guest->lama_kunjungan = abs($decimalHours);

        $guest->save();

        redirect()->route('thanks_guest', ['uuid' => $guest->uuid]);
    }

    public function render()
    {
        return view('livewire.show-guest');
    }
}
