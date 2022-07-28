<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Inscription;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class InscriptionTable extends DataTableComponent
{
    protected $model = Inscription::class;

    public string $event;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function builder(): Builder
    {
        return Inscription::where('event_id', $this->event)->where('inscription_date', '<>', 'null');
    }
    
    public function configure(): void
    {
        $this->setPrimaryKey('id');
     
        $this->setHideBulkActionsWhenEmptyEnabled();
        $this->setQueryStringDisabled();
        $this->setColumnSelectDisabled();

        $this->setComponentWrapperAttributes([
            'id' => 'Id',
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
            
            
            Column::make("ID", "id")->hideIf(true),
            // Column::make("Evento", "event.name"),
            Column::make("Nombre", "user.name"),
            Column::make("Apellido", "user.surname"),
            Column::make("DNI", "user.dni"),
            Column::make("Fecha de inscripcion", "inscription_date")
        
        ];
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
