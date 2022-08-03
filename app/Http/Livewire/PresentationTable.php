<?php

namespace App\Http\Livewire;

use App\Models\Answer;
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
            Column::make("IdPresentacion", "id")->hideIf(true),
            Column::make("Nombre", "title")->hideIf(true),
            Column::make("Titulo", 'id')->format(
                function ($value, $row, Column $column) {
                    $presentation = Presentation::findOrFail($row->id);
                    return view('livewire.more-information-presentation', ['presentation' => $presentation])->withValue($value);
                }
            ),
            Column::make("Descripcion", "description")->hideIf(true),
            Column::make("Fecha", "date"),
            Column::make("Hora Inicio", "start_time")->collapseOnTablet(),
            Column::make("Hora Fin", "end_time")->hideIf(true),
            Column::make("Presentadores", "exhibitors")
                ->format(function ($value, $row,  Column $column) {
                    if ($row['exhibitors']) return '<p>' . $value . '</p>';
                    else return '<p>Sin Presentadores</p>';
                })->html()->collapseOnTablet(),
            Column::make("Recursos", "resources_link")
                ->format(function ($value, $row,  Column $column) {
                    if ($row['resources_link']) return '<a target="_blank" href="' . $value . '" rel="noopener noreferrer"><i class="fa fa-paperclip text-awesome"></i></a>';
                    else return '<p>Sin Recursos</p>';
                })->html()->collapseOnTablet(),
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
            return redirect('evento/' . $this->event);
        }
    }

    public function editPresentation()
    {
        if (isset($this->getSelected()[0])) {
            return redirect()->route('edit-presentation', ['eventId' => $this->event, 'presentationId' => $this->getSelected()[0]]);
            $this->clearSelected();
        }
    }
}
