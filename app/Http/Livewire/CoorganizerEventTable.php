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

class CoorganizerEventTable extends DataTableComponent
{  
    protected $model = User::class;

    public string $tableName = 'coorganizerEvents';

    public array $organizerEvents = [];

    

    public function configure(): void
    {
        $this->setPrimaryKey('events.id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No es coorganizador de ningún evento');

        $this->setQueryStringDisabled();

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

    public function builder(): Builder
    {
        return User::where('users.id', Auth::user()->id)->where('events.id', '>', 0);
    }

    public function columns(): array
    {   
        
         return [
            LinkColumn::make('')
                 ->title(fn ($row) => 'VER EVENTO')
                 ->location(fn ($row) => route('evento', ['eventoId' => $row['organizers.event.id']])),
            LinkColumn::make('')
                 ->title(fn ($row) => 'EDITAR EVENTO')
                 ->location(fn ($row) => route('edit-event', ['eventId' => $row['organizers.event.id']])),
             Column::make("ID Evento", 'organizers.event.id'),
             Column::make("Nombre", 'organizers.event.name'),
             Column::make("Estado", "organizers.event.eventStatus.description"),

             // Column::make("Organizador", "organizers.user.id"),
            //   Column::make("Created at", "created_at")
            //   ->sortable(),
            //   Column::make("Updated at", "updated_at")
            //       ->sortable(),
         ];


        // return [
        //     LinkColumn::make('ver')
        //     ->title(fn ($row) => 'VER EVENTO')
        //     ->location(fn ($row) => route('evento', ['eventoId' => $row['organizers.event.id']])),
        //     LinkColumn::make('editar')
        //     ->title(fn ($row) => 'EDITAR EVENTO')
        //     ->location(fn ($row) => route('edit-event', ['eventId' => $row['organizers.event.id']])),
        //     Column::make("Id", "organizers.event.id")
        //         ->sortable(),
        //     Column::make("Nombre", "organizers.event.name"),
        //     Column::make("Nombre Corto", "organizers.event.short_name"),
        //     Column::make("Estado", 'organizers.event.eventStatus.description')
        //     // Column::make("Nombre Organizador", "user.name"),
        //     // Column::make("Apellido Organizador", 'user.surname')
        //     // Column::make("Created at", "created_at")
        //     //     ->sortable(),
        //     // Column::make("Updated at", "updated_at")
        //     //     ->sortable(),
        // ];
    }


    // public function edit()
    // {
    //     // Event::whereIn('events.id', $this->getSelected())->update(['event_status_id' => 1]);

    //     $this->clearSelected();

    //     return $this->customView();
    // }

    // public function customView(): string
    // {
    //     return 'includes.custom';
    // }
}
