<?php

namespace App\Exports;

use App\Models\Inscription;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventInscriptionsExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;
    protected $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
        
    }
    
    public function query()
    {
        return Inscription::where('event_id', $this->eventId);
    }

    
    
    public function map($inscription): array
    {

if ($this->eventId == $inscription->event->id)
        return [  
            $inscription->user->surname,
            $inscription->user->name,
            $inscription->user->dni,
            $inscription->user->email,
            $inscription->inscription_date,
        ];
  else   
  return [  
    ];
    
    }
    public function headings(): array
    {
        return [
            'APELLIDO',
            'NOMBRE',
            'DNI',
            'MAIL',
            'INSCRIPTION',
        ];
    }
}
