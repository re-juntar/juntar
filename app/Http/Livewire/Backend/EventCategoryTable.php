<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class EventCategoryTable extends DataTableComponent
{
    protected $model = EventCategory::class;

    public string $tableName = "event_categories";

    public array $eventsCategory = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setHideBulkActionsWhenEmptyEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Categoria", "description"),
        ];
    }
}
