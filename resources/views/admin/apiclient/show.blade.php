<x-app-layout>
    @section('title', 'Api Client')
    @section('page-title', 'Api Client')
    @section('breadcrumb', Breadcrumbs::render('admin.api-clients.show', $client))

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
    
                    {{-- Basic Information --}}
                    <div class="mb-4">
                        <h4 class="text-primary">Basic Information</h4>
                        <table class="table table-bordered">
                            <tr><td>Name</td><td>{{ $client->name }}</td></tr>
                            <tr><td>Email</td><td>{{ $client->email }}</td></tr>
                            <tr><td>Phone</td><td>{{ $client->phone ?? 'N/A' }}</td></tr>
                            <tr><td>Type</td><td>{{ $client->type ?? 'N/A' }}</td></tr>
                            <tr><td>Parent</td><td>{{ $client->parent ?? 'N/A' }}</td></tr>
                            <tr><td>Plan ID</td><td>{{ $client->plan_id ?? 'N/A' }}</td></tr>
                            <tr>
                                <td>Active Status</td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $client->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $client->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    {{-- Address --}}
                    <div class="mb-4">
                        <h4 class="text-primary">Address</h4>
                        <table class="table table-bordered">
                            <tr><td>Address</td><td>{{ $client->address ?? 'N/A' }}</td></tr>
                            <tr><td>City</td><td>{{ $client->city ?? 'N/A' }}</td></tr>
                            <tr><td>State</td><td>{{ $client->state ?? 'N/A' }}</td></tr>
                            <tr><td>Country</td><td>{{ $client->country ?? 'N/A' }}</td></tr>
                            <tr><td>Postal Code</td><td>{{ $client->postal_code ?? 'N/A' }}</td></tr>
                        </table>
                    </div>
    
                    {{-- eKYC Information --}}
                    <div class="mb-4">
                        <h4 class="text-primary">eKYC</h4>
                        <table class="table table-bordered">
                            <tr><td>eKYC Status</td><td>{{ $client->ekyc ? 'Verified' : 'Unverified' }}</td></tr>
                            <tr><td>eKYC Verified At</td><td>{{ $client->ekyc_verified_at ?? 'N/A' }}</td></tr>
                            <tr><td>Aadhaar Name</td><td>{{ $client->aadhaarName ?? 'N/A' }}</td></tr>
                            <tr><td>LL Aadhaar Name</td><td>{{ $client->ekycLLAadhaarName ?? 'N/A' }}</td></tr>
                            <tr><td>Date of Birth</td><td>{{ $client->dob ?? 'N/A' }}</td></tr>
                            <tr><td>Gender (English)</td><td>{{ $client->genderEng ?? 'N/A' }}</td></tr>
                            <tr><td>Gender (Hindi)</td><td>{{ $client->genderHindi ?? 'N/A' }}</td></tr>
                            <tr><td>Care of (Co)</td><td>{{ $client->ekycCo ?? 'N/A' }}</td></tr>
                            <tr><td>Location</td><td>{{ $client->ekycLoc ?? 'N/A' }}</td></tr>
                            <tr><td>LL Location</td><td>{{ $client->ekycLLLoc ?? 'N/A' }}</td></tr>
                            <tr><td>VTC</td><td>{{ $client->ekycVtc ?? 'N/A' }}</td></tr>
                            <tr><td>LL VTC</td><td>{{ $client->ekycLLVtc ?? 'N/A' }}</td></tr>
                            <tr><td>District</td><td>{{ $client->ekycDist ?? 'N/A' }}</td></tr>
                            <tr><td>LL District</td><td>{{ $client->ekycLLDist ?? 'N/A' }}</td></tr>
                            <tr><td>State</td><td>{{ $client->ekycState ?? 'N/A' }}</td></tr>
                            <tr><td>LL State</td><td>{{ $client->ekycLLState ?? 'N/A' }}</td></tr>
                            <tr><td>Pincode</td><td>{{ $client->ekycPincode ?? 'N/A' }}</td></tr>
                            <tr><td>LL Pincode</td><td>{{ $client->ekycLLPincode ?? 'N/A' }}</td></tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <img src="data:image/jpeg;base64,{{ $client->photoBase64 }}"
                                         alt="Client Avatar"
                                         class="h-48 w-48 object-cover rounded-full border-4 border-gray-200">
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    {{-- API and Account --}}
                    <div class="mb-4">
                        <h4 class="text-primary">API & Account</h4>
                        <table class="table table-bordered">
                            <tr><td>API Key</td><td>{{ $client->api_key ?? 'N/A' }}</td></tr>
                            <tr><td>API Secret</td><td>{{ $client->api_secret ? '********' : 'N/A' }}</td></tr>
                            <tr><td>Wallet</td><td>{{ $client->wallet ?? 'N/A' }}</td></tr>
                            <tr><td>Email Verified At</td><td>{{ $client->email_verified_at ?? 'N/A' }}</td></tr>
                            <tr><td>Deleted At</td><td>{{ $client->deleted_at ?? 'N/A' }}</td></tr>
                        </table>
                    </div>
    
                    {{-- Back Button --}}
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('admin.api-clients.index') }}" class="btn btn-secondary">Back</a>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
