<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserEventsTable extends DataTableComponent
{
    protected $model = Event::class;

    public string $tableName = "userEventsTable";

    public array $userEventsTable = [];

    public function builder(): Builder
    {
        return Event::where('user_id', Auth::user()->id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('Aún no ha organizado ningún evento');

        $this->setQueryStringDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name"),
            Column::make("Nombre Corto", "short_name"),
            Column::make("Nombre Organizador", "user.name"),
            Column::make("Apellido Organizador", 'user.surname')
            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }
}
