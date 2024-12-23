<?php

namespace App\Livewire;

use App\Models\Guest;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateGuest extends Component implements HasForms
{

    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama')
                    ->maxLength(255),
                TextInput::make('nomor_hp')
                    ->label('Nomor HP')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Textarea::make('keperluan')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $guest = Guest::create($this->form->getState());
        $guest->uuid = $guest->id . Str::uuid();
        $guest->datang = now();
        $guest->save();

        redirect()->route('show_guest', [
            'uuid' => $guest->uuid,

        ]);
    }

    public function render()
    {
        return view('livewire.create-guest');
    }
}
