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

        $this->setHideBulkActionsWhenEmptyEnabled();
        $this->setQueryStringDisabled();
        $this->setColumnSelectDisabled();

        $this->setComponentWrapperAttributes([
            'id' => 'Id',
            'class' => ' text-black bg-gray-200 pt-3 pb-1 lg:p-3 px-3 ',
          ]);

          $this->setTrAttributes(function($row, $index) {
            if ($index % 2 === 0) {
              return [
                'default' => false,
                'class' => 'bg-gray-300 text-black',
              ];
            }
            else{
               return [
                 'default' => false,
                 'class' => 'bg-white-ghost text-black',
               ];
             }

            return ['default' => false];
        });
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")->hideIf(true),
            Column::make("Nombre", 'user.name'),
            Column::make("Apellido", "user.surname"),
            Column::make("DNI", "user.dni"),
            Column::make("Fecha de pre-inscripcion", "pre_inscription_date")
        ];
    }

    public function bulkActions(): array
    {
        return [
            "enroll" => "Inscribir",
            "decline" => "Rechazar"
        ];
    }

    public function enroll()
    {
        Inscription::whereIn('id', $this->getSelected())->update(['pre_inscription_date' => null]);
        Inscription::whereIn('id', $this->getSelected())->update(['inscription_date' => date('Y-m-d')]);

        $this->clearSelected();
        $this->emit('refreshComponent');
    }
    public function decline()
    {
        Inscription::whereIn('id', $this->getSelected())->delete();
        $this->clearSelected();
        $this->emit('refreshComponent');
    }
}
