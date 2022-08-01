<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

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
            Column::make("fechas", "inscription_date")->hideIf(true),
            Column::make("fechas", "event.end_date")->hideIf(true),
            Column::make("Nombre de Evento", "event.name"),
            Column::make("fechas", "event.start_date")
                ->format(function ($value, $row, Column $column) {
                    return '<p class=""><b>Fecha de inicio:</b> '.$row['event.start_date'].'</p>
                    <p class=""><b>Fecha de inscripcion:</b> '.$row['inscription_date'].'</p>';
                })->html(),
            Column::make("Modalidad", "event.eventModality.description"),
            Column::make("Ubicacion", "event.venue")->hideIf(true),
            Column::make("Donde", "event.meeting_link")
                ->format(function ($meeting_link, $row, Column $column) {
                    if ($row['event.venue'] !== null && $meeting_link === null)return  '<p><b>Lugar : </b>'.$row['event.venue'].'</p>';
                    if ($meeting_link !== null && $row['event.venue'] === null) return  '<p><b>Enlace: </b><a href='.$meeting_link.' class="text-awesome" target="_blank">link al Evento </a></p>';
                    if ($meeting_link !== null && $row['event.venue'] !== null) return  '<p><b>Enlace: </b><a href='.$meeting_link.' class="text-awesome" target="_blank">link al Evento </a></p>
                        <p><b>Lugar : </b>'.$row['event.venue'].'</p>';
                    if ($meeting_link === null && $row['event.venue'] === null) return '<span class="flex justify-center">-</span>';
                })->html(),
            Column::make("", 'event.id')->format(
                fn ($value, $row, Column $column) => view('livewire.add-specific-event')->withValue($value)
            ),
            Column::make("", 'id')->format(
                fn ($value, $row, Column $column) => view('livewire.add-questions-and-anwers-button')->withValue($value)
            ),
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
        $Inscription = Inscription::findOrFail($this->getSelected()[0]);

        if ($Inscription->pre_registration_date) {
            Inscription::whereIn('id', $this->getSelected())->update(['pre_inscription_date' => date('Y-m-d')]);
            Inscription::whereIn('id', $this->getSelected())->update(['inscription_date' => null]);
        } else {
            Inscription::whereIn('id', $this->getSelected())->delete();
        }

        $this->clearSelected();
        $this->emit('refreshComponent');
    }
}
