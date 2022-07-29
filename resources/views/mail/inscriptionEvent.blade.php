


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
 
 
 #La informacion del evento sera inviada de forma adjunta en esta mail. Gracias por participar!!
@endcomponent

        
@endcomponent



