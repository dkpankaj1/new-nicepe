<x-app-layout>

    @section('title', 'Dashboard')
    @section('page-title', 'Dashboard')


    <div class="container py-5">
        <!-- User Profile Section -->
        <div class="card mb-4">

            <div class="card-body d-flex align-items-center">
                <img src="{{auth()->user()->avatar}}" alt="User Image" class="rounded-circle me-3" width="100"
                    height="100">
                <div>
                    <h4 id="user-name">{{auth()->user()->name}}</h4>
                    <p id="user-email" class="mb-1">{{auth()->user()->email}}</p>
                    <p id="user-wallet">Wallet Balance: <strong>{{auth()->user()->wallet}}
                            {{$generalSetting->currency->code}}</strong></p>
                    <a href="{{route('retailer.wallet-recharge.create')}}" class="btn btn-primary justify-self-end">Add
                        Money</a>
                </div>
            </div>

        </div>



        <div class="row">
            <div class="col-12 py-1">
                <h4>Plans</h4>
            </div>
            @forelse($plan->details ?? [] as $detail)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{$detail->icon}}" alt="icon" width="32" height="32" style="border-radius: 50%">
                                </div>
                                <div class="flex-grow-1 ms-3 text-truncate">
                                    <h6 class="my-0 fw-medium text-dark fs-15"> {{$detail->feature_name}}</h6>
                                    @if ($detail->isactive == true)
                                        <small class="text-success fs-13 fw-medium mb-0">Active</small>
                                    @else
                                        <small class="text-muted fs-13 fw-medium mb-0">
                                            <a href="{{route('distributor.myplan.activation',$detail->id)}}"
                                                class="link text-decoration-underline text-primary">
                                                Click To Activate
                                            </a>
                                        </small>
                                    @endif

                                </div>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            No Active Plans
                        </div> <!-- end card-body -->
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Latest Transactions Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Latest Transactions</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Direction</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{$transaction->transaction_id}}</td>
                                <td>{{$transaction->amount}} {{$generalSetting->currency->code}}</td>
                                <td>{{$transaction->status}}</td>
                                <td>{{$transaction->transaction_direction}}</td>
                                <td>{{$transaction->created_at->diffForHumans()}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">no transaction</td>
                            </tr>
                        @endforelse   
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>