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

    public function builder(): Builder
    {
        return Inscription::where('event_id', $this->event)->where('pre_inscription_date', '<>', 'null');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", 'user.name'),
            Column::make("Apellido", "user.surname"),
            Column::make("DNI", "user.dni"),
            Column::make("Fecha", "pre_inscription_date")
            // Column::make("Id", "id")
            //     ->sortable(),
            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            "enroll" => "Inscribir"
        ];
    }

    public function enroll()
    {
        Inscription::whereIn('id', $this->getSelected())->update(["pre_inscription_date" => null, "inscription_date" => date('Y-m-d')]);

        $this->clearSelected();
    }
}
