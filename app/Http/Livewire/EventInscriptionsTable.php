<?php

namespace App\Http\Livewire;

use App\Models\Inscription;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class EventInscriptionsTable extends DataTableComponent
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
            Column::make("Nombre", "user.name"),
            Column::make("Apellido", "user.surname"),
            Column::make("Dni", "user.dni"),
            Column::make("Mail", "user.email"),
            Column::make("Fecha de Inscripcion", "inscription_date"),
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
