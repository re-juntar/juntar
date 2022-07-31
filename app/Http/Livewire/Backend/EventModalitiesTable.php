<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EventModality;
use Illuminate\Support\Facades\Auth;

class EventModalitiesTable extends DataTableComponent
{
    protected $model = EventModality::class;

    public string $tableName = 'Event_Modalities';

    public array $eventModalities = [];

    protected $listeners = ['deletemodality'];



    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setHideBulkActionsWhenEmptyEnabled();
        $this->setEmptyMessage('No se encontraron modalidades');
        $this->setSearchDisabled();
        $this->setColumnSelectDisabled();
        $this->setQueryStringDisabled();
        $this->setTableAttributes(['class' => ""]);
        $this->setComponentWrapperAttributes([
            'id' => 'eventos',
            'class' => ' text-black bg-gray-200 pt-3 pb-1 lg:p-3 px-3 overflow-hidden rounded-lg m-1 ',
        ]);

        $this->setTrAttributes(function ($row, $index) {
            if ($index % 2 === 0) {
                return [
                    'default' => false,
                    'class' => 'bg-gray-300 text-black',
                ];
            } else {
                return [
                    'default' => false,
                    'class' => 'bg-white-ghost text-black',
                ];
            }

            return ['default' => false];
        });
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.backend.add-modality'
            ],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("IdModalidad", "id")
                ->sortable()
                ->hideIf(true),
            Column::make("Descripcion", "description")
                ->sortable()
                ->searchable(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'confirmDeleteModality' => 'Borrar',
            'editModality' => 'Modificar'
        ];
    }


    public function confirmDeleteModality()
    {
        $this->emit('confirmation', [
            'status' => 'Eliminado!',
            'statusText' => 'Los registros an sido eliminados exitosamente!',
            'text' => 'Estas por eliminar modalidades de evento, los eventos que sean creador posteriormente no podran tener estas modalidades!',
            'method' => 'deletemodality',
            'component' => 'event-modalities',
            'action' => 'Borrar'
        ]);
    }

    public function deletemodality()
    {
        $this->clearSelected();
        foreach ($this->getSelected() as $selectedItem) {
            EventModality::where('id', $selectedItem)->delete();
        }
    }

    public function editModality()
    {
        if (isset($this->getSelected()[0])) {
            $this->emit('showModalityModalEdit', $this->getSelected()[0]);
            $this->clearSelected();
        }
    }
}
