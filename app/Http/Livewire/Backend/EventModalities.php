<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EventModality;
use Illuminate\Support\Facades\Auth;

class EventModalities extends DataTableComponent
{
    protected $model = EventModality::class;

    public string $tableName = 'Event_Modalities';

    public array $eventModalities = [];



    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No se encontraron modalidades');

        $this->setQueryStringDisabled();

        $this->setTableAttributes(['class' => ""]);

        
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
            Column::make("Editar")->label(fn ($row, Column $column) => '<a class="text-awesome" href="' . route('editModality', ['id' => $row->id]) . '"><i class="fa-solid fa-pen-to-square"></i></a>')->html(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'deleteModality' => 'Borrar',
        ];
    }
    public function deleteModality()
    {
        foreach ($this->getSelected() as $selectedItem) {
            EventModality::where('id', $selectedItem)->delete();
        }
        session()->flash('message', 'Product Deleted Successfully.');
        $this->clearSelected();
    }
}
