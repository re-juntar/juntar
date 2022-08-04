


@component('mail::message')
 
# Hola {{$contacto['name']}} , estas inscripto al evento {{$contacto['evento']}}.  
---

># Datos del evento:

* Nombre del evento: {{ $contacto['evento'] }}        
* fecha del evento : {{ $contacto['fecha'] }}  
* Lugar del evento: {{ $contacto['lugar'] }}  
---
### Desripcion del evento
@component('mail::panel') 
 
{!! $contacto['descripcion'] !!}  
@endcomponent

        
@endcomponent



