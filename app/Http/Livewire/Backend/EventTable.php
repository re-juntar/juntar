<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class EventTable extends DataTableComponent
{
    protected $model = Event::class;

    public string $tableName = "events";

    public array $events = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No se encontraron eventos');

        $this->setQueryStringDisabled();

        $this->setTableAttributes(['class' => "text-white-ghost"]);
    }

    public function columns(): array
    {
        return [
            LinkColumn::make('Evento')
            ->title(fn ($row) => 'Ver')
            ->location(fn ($row) => route('evento', ['eventoId' => $row['id']])),
            Column::make("ID Usuario", "user.id"),
            Column::make("Nombre Usuario", "user.name"),
            Column::make("ID Evento", 'id'),
            Column::make("Nombre", 'name'),
            Column::make("Estado", "eventStatus.description")->searchable(),
            Column::make("Modalidad", "eventModality.description"),
            Column::make("Cateogoria", "eventCategory.description")
            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'publish' => 'Publicar',
            'disable' => 'Deshabilitar',
            'end' => 'Finalizar',
            'makeDraft' => 'Hacer Borrador'
        ];
    }

    public function publish()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 1]);

        $this->clearSelected();
    }
    public function disable()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 2]);

        $this->clearSelected();
    }
    public function end()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 3]);

        $this->clearSelected();
    }
    public function makeDraft()
    {
        Event::whereIn('id', $this->getSelected())->update(['event_status_id' => 4]);

        $this->clearSelected();
    }
}
