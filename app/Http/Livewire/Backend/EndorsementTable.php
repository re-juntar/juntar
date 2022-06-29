<?php

namespace App\Http\Livewire\Backend;

use Carbon\Carbon;
use App\Models\EndorsementRequest;
use Illuminate\Database\DBAL\TimestampType;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class EndorsementTable extends DataTableComponent
{
    protected $model = EndorsementRequest::class;

    public string $tableName = "endorsement-requests";

    public array $endorsement_requests = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No se encontraron Avales');

        $this->setQueryStringDisabled();

        $this->setTableAttributes(['class' => ""] );

        
    }

    public function columns(): array
    {
        return [
            Column::make("ID Avals", "id"),
            Column::make("Nombre Evento", 'event.name'),
            Column::make("Solicitante", "user.name"),
            Column::make("Token", 'request_token'),
            Column::make("Fecha de revision", "revision_date"),
            Column::make("Estado", "endorsed"),
            
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
        EndorsementRequest::whereIn('id', $this->getSelected())->update(['endorsed' => 1]);
        EndorsementRequest::whereIn('id', $this->getSelected())->update(['revision_date' => Carbon::now()]);

        
        $this->clearSelected();
    }
    public function denyEndorsement()
    {
        EndorsementRequest::whereIn('id', $this->getSelected())->update(['endorsed' => 0]);

        $this->clearSelected();
    }
}

