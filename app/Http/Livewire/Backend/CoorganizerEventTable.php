<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CoorganizerEventTable extends DataTableComponent
{
    protected $model = User::class;

    public string $tableName = 'coorganizerEvents';

    public array $organizerEvents = [];

    

    public function configure(): void
    {
        $this->setPrimaryKey('events.id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No es coorganizador de ningún evento');

        $this->setQueryStringDisabled();
    }

    public function builder(): Builder
    {
        return User::where('users.id', Auth::user()->id)->where('events.id', '>', 0);
    }

    public function columns(): array
    {
        return [
            Column::make("ID Evento", 'organizers.event.id'),
            Column::make("Nombre", 'organizers.event.name'),
            Column::make("Estado", "organizers.event.eventStatus.description"),
            Column::make("Modalidad", "organizers.event.eventModality.description"),
            Column::make("Categoria", "organizers.event.eventCategory.description"),
            // Column::make("Organizador", "organizers.user.id"),
            // Column::make("Created at", "created_at")
            // ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'edit' => 'Editar'
        ];
    }

    // public function edit()
    // {
    //     // Event::whereIn('events.id', $this->getSelected())->update(['event_status_id' => 1]);

    //     $this->clearSelected();

    //     return $this->customView();
    // }

    // public function customView(): string
    // {
    //     return 'includes.custom';
    // }
}
