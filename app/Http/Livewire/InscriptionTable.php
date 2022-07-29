<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\EventModality;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class InscriptionTable extends DataTableComponent
{
    protected $model = Inscriptions::class;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public array $inscriptions = [];

    public $event;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        
        $this->setQueryStringDisabled();

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setComponentWrapperAttributes([
            'id' => 'inscriptions',
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
            Column::make("#", "id")->hideIf(true),
            Column::make("#", "event.id")->hideIf(true),
            Column::make("Nombre de Evento", "event.name"),
            Column::make("fecha de Inicio", "event.start_date"),
            Column::make("Fecha de Inscripcion", "inscription_date"),
            Column::make("Modalidad", "event.eventModality.description"),
            Column::make("Link de evento", "event.meeting_link"),
            Column::make("Ubicacion", "event.venue"),
            ButtonGroupColumn::make('acciones')
            ->attributes(function($row) {
                return [
                    'class' => 'space-x-2 ',
                ];
            })
            ->buttons([
                LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => 'ver Evento')
                    ->location(fn ($row) => route('evento', ['id' => $row['event.id']]))
                    ->attributes(function($row) {
                        return [
                            'class' =>' border border-1 border-black rounded p-2 text-blue-100 hover:no-underline',
                        ];
                    }),
            
                LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                ->title(fn($row) => 'ver PyR')
                ->location(fn ($row) => route('evento', ['id' => $row['event.id']]))
                ->attributes(function($row) {
                    return [
                        'class' =>'text-green-500 border border-1 border-black rounded p-2 text-blue-100 hover:no-underline',
                        'wire:click' => '$emit("showPyRModal")',
                    ];
                }),
            ])->collapseOnMobile()
        ];
    }

    public function builder(): Builder
    {
        return Inscription::where(['inscriptions.user_id' => Auth::user()->id ])->where('inscription_date', '<>', 'null');
    }
    
    public function bulkActions(): array
    {
        return [
            "unsubscribe" => "Desinscribir"
        ];
    }

    public function unsubscribe()
    {
        
        $inscription = Inscription::find($this->getSelected());
        $event = Event::findOrFail($this->event);
        if ($event->pre_registration) {
            Inscription::whereIn('id', $this->getSelected())->update(['pre_inscription_date' => date('Y-m-d')]);
            Inscription::whereIn('id', $this->getSelected())->update(['inscription_date' => null]);
        } else {
            Inscription::whereIn('id', $this->getSelected())->delete();
        }

        $this->clearSelected();
        $this->emit('refreshComponent');
    }
}
