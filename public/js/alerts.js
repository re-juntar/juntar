livewire.on('confirmation', e => {

    Swal.fire({
        title: 'Esta seguro?',
        text: e.text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',  
        cancelButtonText: 'Cancelar',   
        confirmButtonText: 'Si, ' + e.action + '!'
    }).then((result) => {
        if (result.isConfirmed) {

            livewire.emit(e.method);
            console.log(e.component,e.method )
            Swal.fire(                              
                e.status,
                e.statusText,
                'success',                
                              
            ).then((result) => {
                 if (e.component =='user-events-table') {
                     location.reload();
                 }             
            })            
        }
    })
});

livewire.on('confirmationInscription', e => {

    Swal.fire({
        title: 'Esta seguro?',
        text: e.text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',  
        cancelButtonText: 'Cancelar',   
        confirmButtonText: 'Si, ' + e.action + '!'
    }).then((result) => {
        if (result.isConfirmed) {

            livewire.emitTo(e.component, e.method, e.eventid);
            console.log(e.method,e.component )
            
            //  Swal.fire(                              
            //      e.status,
            //      e.statusText,
            //      'success',                
                              
            //  ).then((result) => {
            //      if (result.isConfirmed) {
            //          location.reload();
            //      }
            //      else {    
            //          location.reload();
            //       }             
            //  })            
        }
    })
});


livewire.on('ins', e => {
    console.log(e.title,e.text)
    let confirmButtonText= 'ok';
    if(e.redirect){
        confirmButtonText= 'Si, quiero logearme';
        }
    Swal.fire({
        title: e.title,
        text: e.text,
        icon: e.icon,
        confirmButtonText: confirmButtonText,
    }                 
    ).then((result) => {
              if (result.isConfirmed && e.redirect) {
                window.location.replace('../login');
              }
                          
          })         
});

