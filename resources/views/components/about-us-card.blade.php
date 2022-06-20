<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="flex flex-col justify-center items-center">
    <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" alt="Profile" class="w-8/12 rounded-full">
    <div>
        <h2 class="my-3"> {{ $miembro['nombre'] }}</h2>
    </div>
    <div class="flex items-center justify-between">
        @foreach ($miembro['redes'] as $red => $redLink)
            <a href="{{$redLink}}" class="h-6 w-6 mx-1" target="_blank" rel="noreferrer">
                <i class="fa-brands fa-{{$red}} fa-xl"></i>
            </a>
        @endforeach
    </div>
</div>