<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EventCategory;

class EventCategoryTable extends DataTableComponent
{
    protected $model = EventCategory::class;

    public string $tableName = "event_categories";

    public array $eventsCategory = [];

    protected $listeners = ['deleteCategory'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setSearchStatus(false);

        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.backend.add-event-category',
            ],
        ]);

        $this->setComponentWrapperAttributes([
            'id' => 'eventos',
            'class' => ' text-black bg-gray-200 pt-3 pb-1 lg:p-3 px-3 overflow-hidden rounded-lg m-1 ',
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
            Column::make("#", "id"),
            Column::make("Categoria", "description"),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'confirmDeleteModality' => 'Eliminar',
            'update' => 'Modificar',
        ];
    }

    public function deleteCategory()
    {
        $this->clearSelected();
        EventCategory::whereIn('id', $this->getSelected())->delete();

        $this->clearSelected();
    }

    public function confirmDeleteModality()
    {
        $this->emit('confirmation', [            
            'status' => 'Eliminado!',
            'statusText' => 'Los registros an sido eliminados exitosamente!',
            'text' => 'Estas por eliminar Categorias de evento, los eventos que sean creador posteriormente no podran tener estas Categorias!',
            'method' => 'deleteCategory',
            'component' => 'event-category-table',
            'action' => 'Borrar'
        ]);
    }

    public function update()
    {
        $this->emit('showCategoryModal', $this->getSelected()[0]);
        $this->clearSelected();
    }
}
