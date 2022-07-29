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

    protected $listeners = ['confirmAdmin', 'confirmSuper'];


    public function configure(): void
    {
        $this->setPrimaryKey('id');;
        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No se encontraron usuarios');

        $this->setQueryStringDisabled();

        // $this->setTableAttributes(['class' => "text-white-ghost"]);

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

        $this->setComponentWrapperAttributes([
            'id' => 'eventos',
            'class' => 'text-black bg-gray-200 pt-3 pb-1 lg:p-3 px-3 overflow-hidden rounded-lg m-1 >',
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
        $this->emit('confirmation', [            
            'status' => 'Administrador!',
            'statusText' => 'Los usuarios han sido cambiado a rol adminisitrador exitosamente!',
            'text' => 'Estas por cambiar el rol de los usuarios seleccionados a rol Administrador! ',
            'method' => 'confirmAdmin',
            'component' => 'user-table',
            'action' => 'hacer Adminisitrador'
        ]);
    }

    public function confirmAdmin(){
        foreach ($this->getSelected() as $selectedItem) {
            UserRole::where('user_id', $selectedItem)->update(['role_id' => 2]);
        }
        $this->clearSelected();
    }

    public function makeSuperUser()
    {   
        $this->emit('confirmation', [            
            'status' => 'Super Usuario!',
            'statusText' => 'Los usuarios han sido cambiado a rol Super Usuario exitosamente!',
            'text' => 'Estas por cambiar el rol de los usuarios seleccionados a rol Super Usuario! ',
            'method' => 'confirmSuper',
            'component' => 'user-table',
            'action' => 'hacer Super Usuario'
        ]);

    }

    public function confirmSuper(){
        foreach ($this->getSelected() as $selectedItem) {
            UserRole::where('user_id', $selectedItem)->update(['role_id' => 1]);
        }
        $this->clearSelected();
    }
}
