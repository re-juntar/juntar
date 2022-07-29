<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class EventTable extends DataTableComponent
{
    protected $model = Event::class;

    public string $tableName = "events";

    public array $events = [];

    protected $listeners = ['confirmpublish', 'confirmMakeDraft', 'confirmDisable', 'confirmEnd'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No se encontraron eventos');

        $this->setQueryStringDisabled();

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

        // $this->setTableAttributes(['class' => "text-white-ghost"]);
    }

    public function columns(): array
    {
        return [
            LinkColumn::make('Evento')
            ->title(fn ($row) => 'Ver')
            ->location(fn ($row) => route('evento', ['id' => $row['id']])),
            Column::make("ID Usuario", "user.id"),
            Column::make("Nombre Usuario", "user.name"),
            Column::make("ID Evento", 'id'),
            Column::make("Nombre", 'name'),
            Column::make("Estado", "eventStatus.description")->searchable(),
            Column::make("Modalidad", "eventModality.description"),
            Column::make("Cateogoria", "eventCategory.description")
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
            'makeDraft' => 'Hacer Borrador'
        ];
    }

    public function confirmpublish()
    {

        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 1]);

        $this->clearSelected();
    }

    public function publish()
    {
        $this->emit('confirmation', [
            'selected' => $this->getSelected(),
            'status' => 'Publicado!',
            'statusText' => 'Los eventos han sido publicados exitosamente!',
            'text' => 'Estas por cambiar el estado de los eventos a publico!',
            'method' => 'confirmpublish',
            'component' => 'event-table',
            'action' => 'publicar'
        ]);
        //$this->emit('publicar',$this->getSelected(), $method, $component,$action);
        // Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 1]);

        //$this->clearSelected();
    }

    public function disable()
    {

        $this->emit('confirmation', [
            'selected' => $this->getSelected(),
            'status' => 'Eliminado!',
            'statusText' => 'Los eventos han sido deshabilitados exitosamente!',
            'text' => 'Estas por deshabilitar un evento, esta accion es irreversible! ',
            'method' => 'confirmDisable',
            'component' => 'event-table',
            'action' => 'Deshablitiar'
        ]);

        // Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 2]);

        // $this->clearSelected();

    }
    public function confirmDisable()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 2]);

        $this->clearSelected();
    }

    public function end()
    {

        $this->emit('confirmation', [
            'selected' => $this->getSelected(),
            'status' => 'Finalizado!',
            'statusText' => 'Los eventos han sido Finalizados exitosamente!',
            'text' => 'Estas por cambiar el estado de los eventos a finalizado! ',
            'method' => 'confirmEnd',
            'component' => 'event-table',
            'action' => 'Finalizar Evento'
        ]);

    }


    public function confirmEnd(){
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 3]);

        $this->clearSelected();
    }

    public function makeDraft()
    {
        $this->emit('confirmation', [
            'selected' => $this->getSelected(),
            'status' => 'Borrador!',
            'statusText' => 'Los eventos se cambiaron a estado borrador exitosamente!',
            'text' => 'Estas por cambiar el estado de los eventos a borrador!',
            'method' => 'confirmMakeDraft',
            'component' => 'event-table',
            'action' => 'Hacer Borrador'
        ]);
        // Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 4]);
        // $this->clearSelected();
    }
    public function confirmMakeDraft()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 4]);
        $this->clearSelected();
        // return redirect(request()->header('Referer'));
    }
}
