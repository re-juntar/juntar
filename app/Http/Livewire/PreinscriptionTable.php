<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Inscription;
use Illuminate\Database\Eloquent\Builder;

class PreinscriptionTable extends DataTableComponent
{
    protected $model = Inscription::class;

    public string $event;

    public string $tableName = "events";

    public array $events = [];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function builder(): Builder
    {
        return Inscription::where('event_id', $this->event)->where('pre_inscription_date', '<>', 'null');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setQueryStringDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")->hideIf(true),
            Column::make("Nombre", 'user.name'),
            Column::make("Apellido", "user.surname"),
            Column::make("DNI", "user.dni"),
            Column::make("Fecha", "pre_inscription_date")
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
        Inscription::whereIn('id', $this->getSelected())->update(['inscription_date' => date('Y-m-d')]);

        $this->clearSelected();
        $this->emit('refreshComponent');
    }
}
