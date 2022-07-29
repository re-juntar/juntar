<?php

namespace App\Http\Livewire\Backend;

use Carbon\Carbon;
use App\Models\EndorsementRequest;

use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\DocBlock\Tag;
use Illuminate\Database\DBAL\TimestampType;
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

        $this->setComponentWrapperAttributes([
            'id' => 'eventos',
            'class' => ' text-black bg-gray-200 pt-3 pb-1 lg:p-3 px-3 overflow-hidden rounded-lg m-1 ',
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
            Column::make("Token", 'request_token'),
            Column::make("Fecha de revision", "revision_date"),
            Column::make('Estado', 'endorsed')
                ->format(function ($value, $row, Column $column) {
                    if ($row->endorsed === null) return 'Pendiente';

                    return $row->endorsed == 1 ? 'Avalado' : 'Denegado';
                })->sortable(),
        ];
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
        EndorsementRequest::whereIn('id', $this->getSelected())->update(['endorsed' => 0]);

        $this->clearSelected();
    }
}
