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



    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setHideBulkActionsWhenEmptyEnabled();
        $this->setEmptyMessage('No se encontraron modalidades');
        $this->setSearchDisabled();
        $this->setColumnSelectDisabled();
        $this->setQueryStringDisabled();
        $this->setTableAttributes(['class' => ""]);
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
            'editModality' => 'Modificar',
        ];
    }

    public function editModality()
    {
        if (isset($this->getSelected()[0])) {
            $this->emit('showModalityModalEdit', $this->getSelected()[0]);
            $this->clearSelected();
        }
    }
}
