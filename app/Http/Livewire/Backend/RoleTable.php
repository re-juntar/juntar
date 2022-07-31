<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Role;

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;

    public string $tableName = "roles";


    public array $roles = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setHideBulkActionsWhenEmptyEnabled();
        $this->setSearchDisabled();
        $this->setCollapsingColumnsEnabled();
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.backend.add-role'
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
            Column::make("ID", 'id')->collapseOnMobile(),
            Column::make("Nombre", 'name')->searchable(),
            Column::make("Descripcion", 'description')->searchable()->collapseOnMobile(),

            // Column::make("Descripcion", 'description')->format(
            //     fn($value, $row, Column $column) => view('livewire.backend.add-role')->withValue($value)
            // ),

            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'update' => 'Modificar'
        ];
    }

    public function update()
    {
        if (isset($this->getSelected()[0])) {
            $this->emit('showRoleModalEdit', $this->getSelected()[0]);
            $this->clearSelected();
        }
    }
}
