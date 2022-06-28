<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EndorsementRequest;

class EndorsementTable extends DataTableComponent
{
    protected $model = EndorsementRequest::class;

    public string $tableName = "endorsement-requests";

    public array $endorsement_requests = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID Usuario", "id"),
        ];
    }
}
