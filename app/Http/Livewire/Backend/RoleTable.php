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
    }

    public function columns(): array
    {
        return [
            Column::make("ID", 'id')->collapseOnMobile(),
            Column::make("Nombre", 'name')->searchable(),
            Column::make("Descripcion", 'description')->searchable()->collapseOnMobile(),

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
