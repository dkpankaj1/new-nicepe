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

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">My Plans</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse (Auth::user()->plan?->planDetails ?? [] as $planDetail)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$planDetail->feature->name}} ({{$planDetail->fee}} {{$generalSetting->currency->code}})
                            @if ($planDetail->status)
                                <span class="badge bg-info">Active</span>
                            @else
                                <a href="{{route('retailer.activation.edit',$planDetail->id)}}" class="btn btn-sm btn-success">Activate</a>
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            No Active Plans
                        </li>
                    @endforelse
                </ul>
            </div>
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
                                <td>{{$transaction->amount}}</td>
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