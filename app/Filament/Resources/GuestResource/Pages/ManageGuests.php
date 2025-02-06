<?php

namespace App\Filament\Resources\GuestResource\Pages;

use Filament\Actions;
use App\Models\Gedung;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\GuestResource;
use Filament\Resources\Pages\ManageRecords;

class ManageGuests extends ManageRecords
{
    protected static string $resource = GuestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = ['semua' => Tab::make('semua')->badge($this->getModel()::whereNull('pulang')->count())];

        //$tabs = [];

        $gedungs = Gedung::withCount('guest')
            ->has('guest')
            ->get();

        foreach ($gedungs as $gedung) {
            $name = $gedung->nama;
            $slug = str($name)->slug()->toString();

            $tabs[$slug] = Tab::make($name)
                ->badge($this->getModel()::whereNull('pulang')->where('gedung_id', $gedung->id)->count())
                ->badgeColor("primary")
                ->modifyQueryUsing(function ($query) use ($gedung) {
                    return $query->where('gedung_id', $gedung->id);
                });
        }

        return $tabs;
    }
}
