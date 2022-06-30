<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Inscription;
use App\Models\Presentation;
use Illuminate\Database\Eloquent\Builder;

class PreinscriptionTable extends DataTableComponent
{
    protected $model = Inscription::class;

    public string $event;

    public function builder(): Builder{
        return Presentation::where('event_id', $this->event);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", 'user.name')
            // Column::make("Id", "id")
            //     ->sortable(),
            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }
}
