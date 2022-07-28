
@component('mail::message')
 
# Hola!!. Se ha generado una consulta desde la seccion *contactanos* del sitio JUNTAR 
---
># Datos del remitente

* Nombre: {{ $contacto['name'] }}        
* Email : {{ $contacto['email'] }}  
* Asunto: {{ $contacto['subject'] }}  
---
### Mensaje:
@component('mail::panel')

{{$contacto['query']}}
@endcomponent

        
@endcomponent






      
