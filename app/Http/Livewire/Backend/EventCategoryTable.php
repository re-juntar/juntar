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

    protected $listeners = ['deleteCategory', 'activeCategory'];

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
            Column::make("estado", "category_status")
            ->format(function ($value, $row, Column $column) {
                return $row->category_status == 1 ? 'Activo' : 'Deshabilitado';
            }), 
        ];
    }

    public function bulkActions(): array
    {
        return [
            'confirmDeleteModality' => 'Eliminar',
            'confirmActiveModality' => 'Habilitar',
            'update' => 'Modificar',
        ];
    }

    public function deleteCategory()
    {
        //$this->clearSelected();

        foreach ($this->getSelected() as $selectedItem) {
            EventCategory::where('id', $selectedItem)->update(['category_status' => 0]);;
        }        

        $this->clearSelected();
    }

    public function activeCategory()
    {
        //$this->clearSelected();

        foreach ($this->getSelected() as $selectedItem) {
            EventCategory::where('id', $selectedItem)->update(['category_status' => 1]);;
        }        

        $this->clearSelected();
    }

    public function confirmActiveModality()
    {
        $this->emit('confirmation', [            
            'status' => 'Activado!',
            'statusText' => 'Los registros han sido activadas exitosamente!',
            'text' => 'Estas por habilitar una categoria que estaba anteriormente deshabilitada!',
            'method' => 'activeCategory',
            'component' => 'event-category-table',
            'action' => 'Activar'
        ]);
    }

    public function confirmDeleteModality()
    {
        $this->emit('confirmation', [            
            'status' => 'Eliminado!',
            'statusText' => 'Las categorias han sido deshabilitadas exitosamente!',
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
