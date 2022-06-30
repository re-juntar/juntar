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

        $this->setTableAttributes(['class' => "text-white-ghost"]);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", 'id'),
            Column::make("Descripcion", 'description'),             

            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }

    // public function bulkActions(): array
    // {
    //     return [
    //         'publish' => 'Publicar',
    //         'disable' => 'Deshabilitar',
    //         'end' => 'Finalizar',
    //         'makeDraft' => 'Hacer Borrador'
    //     ];
    // }

    // public function publish()
    // {
    //     Role::whereIn('id', $this->getSelected())->update(['event_status_id' => 1]);

    //     $this->clearSelected();
    // }
    // public function disable()
    // {
    //     Role::whereIn('id', $this->getSelected())->update(['event_status_id' => 2]);

    //     $this->clearSelected();
    // }
    // public function end()
    // {
    //     Role::whereIn('id', $this->getSelected())->update(['event_status_id' => 3]);

    //     $this->clearSelected();
    // }
    // public function makeDraft()
    // {
    //     Role::whereIn('id', $this->getSelected())->update(['event_status_id' => 4]);

    //     $this->clearSelected();
    // }
}
