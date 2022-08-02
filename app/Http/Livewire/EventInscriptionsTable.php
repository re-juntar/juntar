<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Answer;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

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
            Column::make("Nombre", "user.name")->hideIf(true),
            Column::make("Nombre Apellido", "user.surname")
            ->format(function ($value, $row, Column $column) {
                return '<p class="">'.$row['user.name'].' '.$row['user.surname'].'</p>';
            })->html(),
            Column::make("Dni", "user.dni"),
            Column::make("Mail", "user.email"),
            Column::make("Fecha de Inscripcion", "inscription_date"),

            Column::make("", 'id')->format(
                function ($value, $row, Column $column) {
                    $answer = Answer::all()->where('inscription_id', $value);
                    return view('livewire.add-questions-and-anwers', ['answer' => $answer])->withValue($value);
                }
            ),
        ];
    }

    public function builder(): Builder
    {   
        return Inscription::where('event_id', $this->event)->where('inscription_date', '<>', 'null');
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
