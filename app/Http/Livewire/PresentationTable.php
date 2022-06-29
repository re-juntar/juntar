<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Presentation;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class PresentationTable extends DataTableComponent
{
    protected $model = Presentation::class;

    public string $event;

    public function builder(): Builder
    {
        return Presentation::where('event_id', $this->event)->orderBy('start_time');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setTableAttributes(['class' => 'text-white-ghost']);
    }

    public function columns(): array
    {
        return [
            // Column::make("Id", "id")
            //     ->sortable(),
            Column::make("Nombre", "title"),
            Column::make("Fecha", "date"),
            Column::make("Hora Inicio", "start_time"),
            Column::make("Hora Fin", "end_time"),
            Column::make("Presentadores", "exhibitors"),
            Column::make("Recursos", 'resources_link')->hideIf(true),
            LinkColumn::make('Recursos')
                ->title(fn ($row) => 'Recursos')
                ->location(fn ($row) => route('redirection', ['url' => $row['resources_link']])),
            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }
}
