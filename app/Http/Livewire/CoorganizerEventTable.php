<?php

namespace App\Http\Livewire;

use App\Http\Controllers\EventController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class CoorganizerEventTable extends DataTableComponent
{  
    protected $model = User::class;

    public string $tableName = 'coorganizerEvents';

    public array $organizerEvents = [];

    

    public function configure(): void
    {
        $this->setPrimaryKey('events.id');
        $this->setColumnSelectDisabled();
        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No es coorganizador de ningún evento');

        $this->setQueryStringDisabled();

        $this->setComponentWrapperAttributes([
            'id' => 'eventos',
            'class' => ' text-black',
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

        $this->setComponentWrapperAttributes([
          'id' => 'eventos',
          'class' => ' text-black bg-gray-200 pt-3 pb-1 lg:p-3 px-3 ',
        ]);
        

    }

    public function builder(): Builder
    {
        return User::where('users.id', Auth::user()->id)->where('events.id', '>', 0);
    }

    public function columns(): array
    {   
        
         return [
            Column::make("Nombre", 'organizers.event.name'),          
             Column::make("ID", 'organizers.event.id')->collapseOnMobile(),             
             Column::make("Estado", "organizers.event.eventStatus.description")->collapseOnMobile(),
             ButtonGroupColumn::make('Acciones')
             ->attributes(function($row) {
                 return [
                     'class' => 'space-x-2',
                 ];
             })
             ->buttons([
                 LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                     ->title(fn($row) => ' ')
                     ->location(fn ($row) => route('evento', ['id' => $row['organizers.event.id']]))
                     ->attributes(function($row) {
                         return [
                             'class' => 'fa-solid fa-eye border border-1 border-black rounded p-2 text-blue-100 hover:no-underline',
                         ];
                     }),
                 LinkColumn::make('Edit')
                     ->title(fn($row) => ' ' )
                     ->location(fn ($row) => route('edit-event', ['id' => $row['organizers.event.id']]))
                     ->attributes(function($row) {
                         return [
                             'target' => '_blank',
                             'class' => ' text-red-500 border border-1 border-black rounded bg-blue-500  fa-solid fa-pen-to-square p-2 hover:no-underline',
                         ];
                     }),
             ])->collapseOnMobile(),


         ];


    }



}
