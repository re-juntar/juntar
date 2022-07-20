<?php

namespace App\Http\Livewire;

use App\Http\Controllers\EventController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;


class UserEventsTable extends DataTableComponent
{
    protected $model = Event::class;

    public string $tableName = "userEventsTable";

    public array $userEventsTable = [];

    public function builder(): Builder
    {
        return Event::where('user_id', Auth::user()->id)->where('event_status_id', '<>', 2);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('Aún no ha organizado ningún evento');

        $this->setQueryStringDisabled();

        $this->setColumnSelectDisabled();

         $this->setComponentWrapperAttributes([
             'id' => 'eventos',
             'class' => ' text-black bg-gray-200 pt-3 pb-1 lg:p-3 px-3 ',
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
            Column::make("Nombre", "name"),
        //     LinkColumn::make('Accion')
        //         ->title(fn ($row) => 'VER EVENTO')
        //         ->location(fn ($row) => route('evento', ['eventoId' => $row['id']]))->collapseOnMobile(),
        // LinkColumn::make('Accion')                
        //         ->title(fn ($row) => 'EDITAR EVENTO')
        //         ->location(fn ($row) => route('edit-event', ['eventId' => $row['id']]))
        //         ->attributes(fn($row) => [
        //             'class' => 'rounded-full text-white',
        //             'alt' => $row->name . ' Avatar',
        //         ]),             
            Column::make("Id", "id")
                ->sortable()->collapseOnMobile(),
            
            // Column::make("Nombre Corto", "short_name"),
            Column::make("Estado", 'eventStatus.description')->collapseOnMobile(),
            ButtonGroupColumn::make('Acciones')
            ->attributes(function($row) {
                return [
                    'class' => 'space-x-2',
                ];
            })
            ->buttons([
                LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => ' ')
                    ->location(fn ($row) => route('evento', ['eventoId' => $row['id']]))
                    ->attributes(function($row) {
                        return [
                            'class' =>'fa-solid fa-eye border border-1 border-black rounded p-2 text-blue-100 hover:no-underline',
                        ];
                    }),
                LinkColumn::make('Edit')
                    ->title(fn($row) => ' ' )
                    ->location(fn ($row) => route('edit-event', ['eventId' => $row['id']]))
                    ->attributes(function($row) {
                        return [
                            'target' => '_blank',
                            'class' => 'text-red-500 border border-1 border-black rounded bg-blue-500  fa-solid fa-pen-to-square p-2 hover:no-underline',
                        ];
                    }),
            ])->collapseOnMobile(),
            // Column::make("Nombre Organizador", "user.name"),
            // Column::make("Apellido Organizador", 'user.surname')
            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'publish' => 'Publicar',
            'disable' => 'Deshabilitar',
            'end' => 'Finalizar',
            'makeDraft' => 'Hacer Borrador',
        ];
    }

    public function publish()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 1]);

        $this->clearSelected();
    }
    public function disable()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 2]);

        $this->clearSelected();
    }
    public function end()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 3]);

        $this->clearSelected();
    }
    public function makeDraft()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 4]);

        $this->clearSelected();
    }
}
