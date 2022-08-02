<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Inscription;
use Illuminate\Database\Eloquent\Builder;

class PreinscriptionTable extends DataTableComponent
{
    protected $model = Inscription::class;

    public string $event;

    public string $tableName = "events";

    public array $events = [];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function builder(): Builder
    {
        return Inscription::where('event_id', $this->event)->where('inscription_date', '=', 'null');
    }

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
            Column::make("ID", "id")->hideIf(true),
            Column::make("Nombre", 'user.name')->hideIf(true),
            Column::make("Nombre Apellido", "user.surname")
            ->format(function ($value, $row, Column $column) {
                return '<p class="">'.$row['user.name'].' '.$row['user.surname'].'</p>';
            })->html(),
            Column::make("DNI", "user.dni"),
            Column::make("Fecha", "pre_inscription_date")
        ];
    }

    public function bulkActions(): array
    {
        return [
            "enroll" => "Inscribir"
        ];
    }

    public function enroll()
    {
        Inscription::whereIn('id', $this->getSelected())->update(['inscription_date' => date('Y-m-d')]);

        $this->clearSelected();
        $this->emit('refreshComponent');
    }
}
