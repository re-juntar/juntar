<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\ListenerOptions;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;


class UserEventsTable extends DataTableComponent
{
    protected $model = Event::class;

    public string $tableName = "userEventsTable";

    public array $userEventsTable = [];

    protected $listeners = ['confirmpublish', 'confirmMakeDraft', 'confirmDisable', 'confirmEnd'];

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



        $this->setTrAttributes(function ($row, $index) {
            if ($index % 2 === 0) {
                return [
                    'default' => false,
                    'class' => 'bg-gray-300 text-black',
                ];
            } else {
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
            Column::make("Id", "id")
                ->sortable()->collapseOnMobile(),
            Column::make("Estado", 'eventStatus.description')->collapseOnMobile(),
            ButtonGroupColumn::make('Acciones')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                        ->title(fn ($row) => ' ')
                        ->location(fn ($row) => route('evento', ['id' => $row['id']]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'fa-solid fa-eye border border-1 border-black rounded p-2 text-blue-100 hover:no-underline',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn ($row) => ' ')
                        ->location(fn ($row) => route('edit-event', ['id' => $row['id']]))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'text-red-500 border border-1 border-black rounded bg-blue-500  fa-solid fa-pen-to-square p-2 hover:no-underline',
                            ];
                        }),
                ])->collapseOnMobile()
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
            'component' => 'user-events-table',
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
            'component' => 'user-events-table',
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
            'component' => 'user-events-table',
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
            'component' => 'user-events-table',
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
