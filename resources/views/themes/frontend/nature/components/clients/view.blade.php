@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $clients = \App\Plugins\Clients\Http\Models\Client::get();
@endphp
<!-- Clients -->
<section class="client-section">
    <div class="container">
        <h5 class="divider-title">
            <span>{{$componentValue['name']}}</span>
        </h5>
        <div class="client-wrap client-slider text-center">
            @foreach ($clients as $client)
                <div class="clients-item">
                    <figure>
                        <img src="{{\App\Classes\Helpers\Image::getImageAsSize($client->image,'s')}}" alt="{{$client->client_name}}">
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Clients -->
