<?php

namespace App\Exports;

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
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
     
        return Inscription::with('user')->get();
    }

    public function query()
    {
        return Inscription::query()->with('user');
    }

    
    
    public function map($inscription): array
    {
        return [  
            $inscription->user->name,
            $inscription->user->surname,
            $inscription->user->dni,
            $inscription->user->email,
            $inscription->inscription_date,
            $inscription->event->id,
        ];
    
    }
    public function headings(): array
    {
        return [
            'NOMBRE',
            'APELLIDO',
            'DNI',
            'MAIL',
            'INSCRIPTION',
            'Id del evento',
        ];
    }
}
