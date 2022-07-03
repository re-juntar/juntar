<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EventCategory;

class EventCategoryTable extends DataTableComponent
{
    protected $model = EventCategory::class;

    public string $tableName = "event_categories";

    public array $eventsCategory = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setSearchStatus(false);

        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.backend.add-event-category',
            ],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Categoria", "description"),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'delete' => 'Eliminar',
            'update' => 'Modificar',
        ];
    }

    public function delete()
    {
        EventCategory::whereIn('id', $this->getSelected())->delete();

        $this->clearSelected();
    }

    public function update()
    {
        $this->emit('showCategoryModal', $this->getSelected()[0]);
        $this->clearSelected();
    }
}
