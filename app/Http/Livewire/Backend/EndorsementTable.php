<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\PermissionController;
use App\Models\AcademicUnitUser;
use Carbon\Carbon;
use App\Models\EndorsementRequest;

use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\DocBlock\Tag;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class EndorsementTable extends DataTableComponent
{
    protected $model = EndorsementRequest::class;

    public string $tableName = "endorsement-requests";

    public array $endorsement_requests = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setQueryStringDisabled();
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Filtro')
                ->options([
                    '' => 'Elegir una opcion',
                    'pendiente' => 'Pendientes',
                    'avalado' => 'Avalado',
                    'denegado' => 'Denegado',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === 'denegado') {
                        $builder->where('endorsement_requests.endorsed', 0);
                    } elseif ($value === 'avalado') {
                        $builder->where('endorsement_requests.endorsed', 1);
                    } elseif ($value === 'pendiente') {
                        $builder->where('endorsement_requests.endorsed', null);
                    }
                }),
        ];

    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Nombre Evento", 'event.name')->searchable(),
            Column::make("Solicitante", "user.name")->searchable(),
            Column::make("Unidad academica", "academicUnit.short_name"),
            Column::make("Token", 'request_token'),
            Column::make("Fecha de revision", "revision_date"),
            Column::make('Estado', 'endorsed')
                ->format(function ($value, $row, Column $column) {
                    if ($row->endorsed === null) return 'Pendiente';

                    return $row->endorsed == 1 ? 'Avalado' : 'Denegado';
                })->sortable(),
        ];
    }

    public function builder(): Builder
    {
        if(PermissionController::isAdmin()) return EndorsementRequest::where('events.id', '>', 0);

        
        $userAcademicUnits = AcademicUnitUser::all()->where('user_id', Auth::user()->id);

        $userAcademicUnits = array_reduce(
            $userAcademicUnits->toArray(),
            fn ($current, $userAcademicUnit) => [...$current, $userAcademicUnit['academic_unit_id']],
            []
        );

        return EndorsementRequest::whereIn('academic_unit_id', $userAcademicUnits)->where('events.id', '>', 0);
    }

    public function bulkActions(): array
    {
        return [
            'acceptEndorsement' => 'Aceptar Aval',
            'denyEndorsement' => 'Rechazar Aval',
        ];
    }

    public function acceptEndorsement()
    {
        EndorsementRequest::whereIn('id', $this->getSelected())
            ->update(['endorsed' => 1, 'revision_date' => Carbon::now()]);

        $this->clearSelected();
    }
    public function denyEndorsement()
    {
        EndorsementRequest::whereIn('id', $this->getSelected())->update(['endorsed' => 0, 'revision_date' => Carbon::now()]);

        $this->clearSelected();
    }
}
