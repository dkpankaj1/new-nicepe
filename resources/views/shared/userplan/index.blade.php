<x-app-layout>
    @section('title', 'My Plan')
    @section('page-title', 'My Plan')
    @section('breadcrumb')
        {!! $breadcrumb !!}
    @endsection

    <div class="row justify-content-center my-3">
        <div class="pricing-box col-xl-4 col-md-6">
            <div class="card card-h-full">

                @if (isset($plan))
                    <div class="d-flex flex-column inner-box card-body p-4">
                        <div class="plan-header flex-shrink-0">
                            <h5 class="plan-title">{{$plan->name}}</h5>
                            <p class="plan-subtitle">{{$plan->description}}</p>
                        </div>

                        <ul class="flex-grow-1 plan-stats list-unstyled">
                            @foreach ($plan->details as $detail)
                                <li>
                                    @if($detail->isactive)

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-check2 text-success" viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                                        </svg>

                                        {{$detail->feature_name}} ({{$detail->fee}}){{$generalSetting->currency->code}}

                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-x-lg text-danger" viewBox="0 0 16 16">
                                            <path
                                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                        </svg>
                                        {{$detail->feature_name}} ({{$detail->fee}}){{$generalSetting->currency->code}}
                                        - <a href="{{route($activationRoute, $detail->id)}}">Activate Now</a>

                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="d-flex flex-column inner-box card-body p-4">
                        <div class="plan-header flex-shrink-0">
                            <h5 class="plan-title">No Active Plan</h5>
                        </div>
                    </div>
                @endif

            </div> <!-- end Pricing_card -->
        </div> <!-- end col -->
    </div>

</x-app-layout>