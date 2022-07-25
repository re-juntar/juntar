<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AcademicUnitUser;

class AcademicUnitUserTable extends DataTableComponent
{
    protected $model = AcademicUnitUser::class;

    public function configure(): void
    {
        $this->setPrimaryKey('user_id');

        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No se encontraron usuarios');

        $this->setQueryStringDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make('Usuario', 'user.name'),
            Column::make('Unidad academica', "academicUnit.name")
        ];
    }
}
