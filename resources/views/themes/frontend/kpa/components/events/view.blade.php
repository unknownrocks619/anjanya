@php
    $backgroundImage =  asset('frontend/kpa/assets/images/service/bg-03.jpg');
    $events = App\Plugins\Events\Http\Models\Event::where('active',true)
                                                    ->where('event_start_date','>=',now()->format('Y-m-d'))
                                                    // ->where('event_end_date','<=' , now()->format('Y-m-d'))
                                                    ->limit(6)
                                                    ->get();
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $backgroundImage = $componentValue['backgroundImage'];
    $heading = $componentValue['title'];
    $subHeading = $componentValue['subtitle'];
    $description    = $componentValue['description']
@endphp

<!-- service accordion area -->
<div class="rts-accordion-area service rts-section-gap">
    <div class="accordion-service-bg bg_image ptb--120 ptb_md--80 ptb_sm--60" style="background-image: url({{$backgroundImage}});background-position: right;background-repeat: no-repeat;background-size:contain">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="accordion-service-inner">
                        <div class="title-area-start">
                            <span class="sub color-primary">{{$subHeading}}</span>
                            <h2 class="title">{{$heading}}</h2>
                            @if($description)
                                <div class="my-3">
                                    {!! $description !!}
                                </div>
                            @endif
                        </div>
                        <div class="accordion-area">
                            <div class="accordion" id="accordionExample">
                                @if( empty ($events) )
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Making Easy Business Growth
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Business Solution Model
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Finbiz Company Solution
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Management Process
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                Managing Invesment
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($events as $event)
                                        @php
                                            $carbonEventDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $event->event_start_date);

                                        @endphp
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{$event->event_slug}}_{{$event->getKey()}}" aria-expanded="true" aria-controls="collapseOne">
                                                    {{$event->event_title}}
                                                </button>
                                            </h2>
                                            <div id="{{$event->event_slug}}_{{$event->getKey()}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    {{ strip_tags($event->intro_description) }}
                                                    <br />
                                                    <span class="badge bg-success">
                                                        Event Date: {{$carbonEventDate->format('dS F Y')}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- service accordion area End -->
