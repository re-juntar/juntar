<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use App\Models\UserRole;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public string $tableName = 'users';
    public array $users = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        ;$this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No se encontraron usuarios');

        $this->setQueryStringDisabled();
        
        $this->setTableAttributes(['class' => "text-white-ghost"]);

        // $this->setSecondaryHeaderTrAttributes(function ($rows) {
        //     return ['class' => 'text-white-ghost'];
        // });

        // $this->setComponentWrapperAttributes([
        //     'class' => 'text-white-ghost',
        // ]);

        // $this->setTbodyAttributes([
        //     'id' => 'my-id',
        //     'class' => 'this that'
        // ]);

    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Apellido", "surname")
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Role', 'userRole.role.name')
                ->sortable()
                ->searchable(),
            Column::make('Descripcion', 'userRole.role.description')
                ->collapseOnTablet(),
            Column::make("DNI", 'dni'),
            Column::make("Email", "email")
                ->sortable()
                ->collapseOnTablet(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'makeAdmin' => 'Hacer Admin',
            'makeSuperUser' => 'Hacer Super Usuario',
        ];
    }

    public function makeAdmin()
    {
        foreach ($this->getSelected() as $selectedItem) {
            UserRole::where('user_id', $selectedItem)->update(['role_id' => 2]);
        }
        $this->clearSelected();
    }

    public function makeSuperUser()
    {
        foreach ($this->getSelected() as $selectedItem) {
            UserRole::where('user_id', $selectedItem)->update(['role_id' => 1]);
        }
        $this->clearSelected();
    }
}
