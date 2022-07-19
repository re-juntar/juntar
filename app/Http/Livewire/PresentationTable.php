<?php

namespace App\Http\Livewire;

use App\Models\EventModality;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Presentation;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class PresentationTable extends DataTableComponent
{
    protected $model = Presentation::class;

    public $event;
    public $hasPermission;

    public string $tableName = 'Presentations';

    public array $presentations = [];


    public function builder(): Builder
    {
        return Presentation::where('event_id', $this->event)->orderBy('date')->orderBy('start_time')->orderBy('end_time');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('La agenda se encuentra vacía.');

        $this->setSearchDisabled();

        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("IdPresentacion", "id")
                ->hideIf(true),
            Column::make("Nombre", "title")
                ->hideIf(true),
            Column::make("Nombre", 'title')
                ->label(fn ($row, Column $column) => '
                    <p>' . $row->title . '</p>')
                ->html(),
            Column::make("Descripcion", "description")
                ->hideIf(true),
            Column::make("Fecha", "date"),
            Column::make("Hora Inicio", "start_time"),
            Column::make("Hora Fin", "end_time")
                ->hideIf(true),
            Column::make("Presentadores", "exhibitors"),
            Column::make("Recursos")
                ->label(fn ($row, Column $column) => '<a target="_blank" href="' . $row->resources_link . '"><i class="fa fa-paperclip text-awesome"></i></a>')
                ->html()
                ->unclickable(),
        ];
    }

    public function bulkActions(): array
    {
        if ($this->hasPermission) {
            return [
                'editPresentation' => 'Modificar',
                'deletePresentation' => 'Eliminar',
            ];
        } else {
            return [];
        }
    }

    public function deletePresentation()
    {
        if ($this->hasPermission) {
            foreach ($this->getSelected() as $selectedItem) {
                Presentation::where('id', $selectedItem)->delete();
            }
            $this->clearSelected();
        }
    }

    public function editPresentation()
    {
        if (isset($this->getSelected()[0])) {
            $this->emit('showPresentationModalEdit', $this->getSelected()[0]);
            $this->clearSelected();
        }
    }
}
