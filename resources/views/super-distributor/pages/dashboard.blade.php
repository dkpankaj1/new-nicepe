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
                    <button class="btn btn-primary justify-self-end">Add Money</button>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Services</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    {{-- @foreach (auth()->user()->plan->planDetails as $plan)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{$plan->feature->name}} <span class="badge bg-info">{{$plan->activete ? "Active": "In-Active"}}</span>
                    </li>
                    @endforeach --}}

                </ul>
            </div>
        </div>

        <!-- Latest Transactions Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Latest Transactions</h5>
            </div>
            <div class="card-body">
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
                        <tr>
                            <td>TNX12345</td>
                            <td>$50.00</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>Incoming</td>
                            <td>2025-02-15</td>
                        </tr>
                        <tr>
                            <td>TNX67890</td>
                            <td>$30.00</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>Outgoing</td>
                            <td>2025-02-14</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>