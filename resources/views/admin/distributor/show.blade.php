
<x-app-layout>
    @section('title', 'Distributor')
    @section('page-title', 'Distributor')
    @section('breadcrumb', Breadcrumbs::render('admin.distributors.show', $distributor))

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
    
                    {{-- Basic Information --}}
                    <div class="mb-4">
                        <h4 class="text-primary">Basic Information</h4>
                        <table class="table table-bordered">
                            <tr><td>Name</td><td>{{ $distributor->name }}</td></tr>
                            <tr><td>Email</td><td>{{ $distributor->email }}</td></tr>
                            <tr><td>Phone</td><td>{{ $distributor->phone ?? 'N/A' }}</td></tr>
                            <tr><td>Type</td><td>{{ $distributor->type ?? 'N/A' }}</td></tr>
                            <tr><td>Parent</td><td>{{ $distributor->parent ?? 'N/A' }}</td></tr>
                            <tr><td>Plan ID</td><td>{{ $distributor->plan_id ?? 'N/A' }}</td></tr>
                            <tr>
                                <td>Active Status</td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $distributor->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $distributor->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    {{-- Address --}}
                    <div class="mb-4">
                        <h4 class="text-primary">Address</h4>
                        <table class="table table-bordered">
                            <tr><td>Address</td><td>{{ $distributor->address ?? 'N/A' }}</td></tr>
                            <tr><td>City</td><td>{{ $distributor->city ?? 'N/A' }}</td></tr>
                            <tr><td>State</td><td>{{ $distributor->state ?? 'N/A' }}</td></tr>
                            <tr><td>Country</td><td>{{ $distributor->country ?? 'N/A' }}</td></tr>
                            <tr><td>Postal Code</td><td>{{ $distributor->postal_code ?? 'N/A' }}</td></tr>
                        </table>
                    </div>
    
                    {{-- eKYC Information --}}
                    <div class="mb-4">
                        <h4 class="text-primary">eKYC</h4>
                        <table class="table table-bordered">
                            <tr><td>eKYC Status</td><td>{{ $distributor->ekyc ? 'Verified' : 'Unverified' }}</td></tr>
                            <tr><td>eKYC Verified At</td><td>{{ $distributor->ekyc_verified_at ?? 'N/A' }}</td></tr>
                            <tr><td>Aadhaar Name</td><td>{{ $distributor->aadhaarName ?? 'N/A' }}</td></tr>
                            <tr><td>LL Aadhaar Name</td><td>{{ $distributor->ekycLLAadhaarName ?? 'N/A' }}</td></tr>
                            <tr><td>Date of Birth</td><td>{{ $distributor->dob ?? 'N/A' }}</td></tr>
                            <tr><td>Gender (English)</td><td>{{ $distributor->genderEng ?? 'N/A' }}</td></tr>
                            <tr><td>Gender (Hindi)</td><td>{{ $distributor->genderHindi ?? 'N/A' }}</td></tr>
                            <tr><td>Care of (Co)</td><td>{{ $distributor->ekycCo ?? 'N/A' }}</td></tr>
                            <tr><td>Location</td><td>{{ $distributor->ekycLoc ?? 'N/A' }}</td></tr>
                            <tr><td>LL Location</td><td>{{ $distributor->ekycLLLoc ?? 'N/A' }}</td></tr>
                            <tr><td>VTC</td><td>{{ $distributor->ekycVtc ?? 'N/A' }}</td></tr>
                            <tr><td>LL VTC</td><td>{{ $distributor->ekycLLVtc ?? 'N/A' }}</td></tr>
                            <tr><td>District</td><td>{{ $distributor->ekycDist ?? 'N/A' }}</td></tr>
                            <tr><td>LL District</td><td>{{ $distributor->ekycLLDist ?? 'N/A' }}</td></tr>
                            <tr><td>State</td><td>{{ $distributor->ekycState ?? 'N/A' }}</td></tr>
                            <tr><td>LL State</td><td>{{ $distributor->ekycLLState ?? 'N/A' }}</td></tr>
                            <tr><td>Pincode</td><td>{{ $distributor->ekycPincode ?? 'N/A' }}</td></tr>
                            <tr><td>LL Pincode</td><td>{{ $distributor->ekycLLPincode ?? 'N/A' }}</td></tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <img src="data:image/jpeg;base64,{{ $distributor->photoBase64 }}"
                                         alt="Client Avatar"
                                         class="h-48 w-48 object-cover rounded-full border-4 border-gray-200">
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    {{-- Back Button --}}
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('admin.distributors.index') }}" class="btn btn-secondary">Back</a>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
