<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EventModality;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class EventModalities extends DataTableComponent
{
    protected $model = EventModality::class;

    public string $tableName = 'Event_Modalities';

    public array $eventModalities = [];



    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setEmptyMessage('No se encontraron modalidades');

        $this->setQueryStringDisabled();

        $this->setTableAttributes(['class' => "text-white-ghost"]);

        // $this->setPrimaryKey('id')
        // ->setTableRowUrl(function($row) {
        //     return route('addModality', $row);
        // });
        // ->setTableRowUrlTarget(function($row) {
        //     if ($row->isExternal()) {
        //         return '_blank';
        //     }

        //     return '_self';
        // });
    
    }

    // public function builder(): Builder 
    // {
    //      return EventModality::where('id', Auth::user()->id);

    // }

    public function columns(): array
    {
        return [
            Column::make("IdEvento", "id")
                ->sortable(),

            Column::make("Descripcion", "description")
                ->sortable(),
            // LinkColumn::make('Action')
            //     ->title(fn ($row) => 'Editar')
            //     ->location(fn ($row) => route('admin.users.edit', $row)),
            // LinkColumn::make('Action')
            //     ->title(fn ($row) => 'Borrar')
            //     ->location(fn ($row) => route('admin.users.edit', $row)),
            /*             Column::make('Editar')
            ->format(function($value) {
                return '<strong>Hola</strong>';
            }) */
            // ->asHtml(),
            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
            
        ];
    }

    public function bulkActions(): array
    {
        return [
            'deleteModality' => 'Borrar',
            'editModality' => 'Editar Modalidad',
        ];
    }
    public function deleteModality()
    {
        EventModality::where('id', $this->getSelected())->delete();
        // $this->getSelected();

        $this->clearSelected();
        //return redirect()->to('/gestionar/avales', ['item' => $item] );
        // return redirect('/contact-us')->with('error', "mensaje");
        //  return return redirect()->action('${App\Http\Controllers\HomeController@index}', ['parameterKey' => 'value']);
    }

    public function editModality(){
       $id = $this->getSelected()[0];
        // $modality = $evntModality::find($id);
             return redirect()->to('/gestionar/modalidades/editar/'.$id);
            
    }
}

