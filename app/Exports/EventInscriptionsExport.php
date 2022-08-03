<?php

namespace App\Exports;

use App\Models\Event;
use App\Models\User;
use App\Models\Inscription;
use GuzzleHttp\Psr7\Query;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventInscriptionsExport implements FromCollection, FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{

    protected $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
     
        return Inscription::all()->where('event_id', $this->eventId);
    }

    public function query()
    {
        return Inscription::query();
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
            $inscription->event->id,
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
            'Id del evento',
        ];
    }
}
