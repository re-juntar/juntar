<?php

namespace App\Exports;

use App\Models\Inscription;
use GuzzleHttp\Psr7\Query;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventInscriptionsExport implements FromCollection, FromQuery, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inscription::all();
    }
    public function query()
    {
        return Inscription::query();
    }
    public function map($inscription): array
    {
            
                return [  $inscription->user_id,
                $inscription->user->name,
            ];
            
            
    }

}
