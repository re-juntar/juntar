<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Inscription;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class InscriptionTable extends DataTableComponent
{
    protected $model = Inscription::class;

    public $events;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setQueryStringDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")->hideIf(true),
            Column::make("Nombre", "user.name"),
            Column::make("Apellido", "user.surname"),
            Column::make("DNI", "user.dni"),
            Column::make("Fecha", "inscription_date")
        ];
    }

    public function builder(): Builder
    {
        return Inscription::whereIn('event_id', $this->events[0])->where('inscription_date', '<>', 'null', '1');
    }

    public function bulkActions(): array
    {
        return [
            "unsubscribe" => "Desinscribir"
        ];
    }

    public function unsubscribe()
    {
        $event = Event::findOrFail($this->getSelected()[0]);

        if ($event->pre_registration) {
            Inscription::whereIn('id', $this->getSelected())->update(['pre_inscription_date' => date('Y-m-d')]);
            Inscription::whereIn('id', $this->getSelected())->update(['inscription_date' => null]);
        } else {
            Inscription::whereIn('id', $this->getSelected())->delete();
        }

        $this->clearSelected();
        $this->emit('refreshComponent');
    }
}
