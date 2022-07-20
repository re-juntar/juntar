<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
             'class' => ' text-black bg-gray-200 p-3',
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
            LinkColumn::make('')
                ->title(fn ($row) => 'VER EVENTO')
                ->location(fn ($row) => route('evento', ['eventoId' => $row['id']])),
        LinkColumn::make('')
                ->title(fn ($row) => 'EDITAR EVENTO')
                ->location(fn ($row) => route('edit-event', ['eventId' => $row['id']])),
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name"),
            // Column::make("Nombre Corto", "short_name"),
            Column::make("Estado", 'eventStatus.description')
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
