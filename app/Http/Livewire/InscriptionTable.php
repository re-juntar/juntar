<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Inscription;
use Illuminate\Database\Eloquent\Builder;

class InscriptionTable extends DataTableComponent
{
    protected $model = Inscription::class;

    public string $event;

    public function builder(): Builder
    {
        return Inscription::where('event_id', $this->event)->where('inscription_date', '<>', 'null');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "user.name"),
            Column::make("Apellido", "user.surname"),
            Column::make("DNI", "user.dni"),
            Column::make("Fecha", "inscription_date")
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
            "Inscribir" => "unsubscribe"
        ];
    }

    public function unsubscribe()
    {
        $inscription = Inscription::find($this->getSelected());

        if ($inscription->event->pre_registration) {
            $inscription->update(["pre_inscription_date" => date('Y-m-d'), "inscription_date" => null]);
        } else {
            $inscription->delete();
        }

        $this->clearSelected();
    }
}
