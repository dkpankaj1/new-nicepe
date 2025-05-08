<x-app-layout>
    @section('title', 'Super Distributor')
    @section('page-title', 'Super Distributor')
    @section('breadcrumb', Breadcrumbs::render('admin.super-distributors.show', $superDistributors))

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
    
                    {{-- Basic Information --}}
                    <div class="mb-4">
                        <h4 class="text-primary">Basic Information</h4>
                        <table class="table table-bordered">
                            <tr><td>Name</td><td>{{ $superDistributors->name }}</td></tr>
                            <tr><td>Email</td><td>{{ $superDistributors->email }}</td></tr>
                            <tr><td>Phone</td><td>{{ $superDistributors->phone ?? 'N/A' }}</td></tr>
                            <tr><td>Type</td><td>{{ $superDistributors->type ?? 'N/A' }}</td></tr>
                            <tr><td>Parent</td><td>{{ $superDistributors->parent ?? 'N/A' }}</td></tr>
                            <tr><td>Plan ID</td><td>{{ $superDistributors->plan_id ?? 'N/A' }}</td></tr>
                            <tr>
                                <td>Active Status</td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $superDistributors->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $superDistributors->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    {{-- Address --}}
                    <div class="mb-4">
                        <h4 class="text-primary">Address</h4>
                        <table class="table table-bordered">
                            <tr><td>Address</td><td>{{ $superDistributors->address ?? 'N/A' }}</td></tr>
                            <tr><td>City</td><td>{{ $superDistributors->city ?? 'N/A' }}</td></tr>
                            <tr><td>State</td><td>{{ $superDistributors->state ?? 'N/A' }}</td></tr>
                            <tr><td>Country</td><td>{{ $superDistributors->country ?? 'N/A' }}</td></tr>
                            <tr><td>Postal Code</td><td>{{ $superDistributors->postal_code ?? 'N/A' }}</td></tr>
                        </table>
                    </div>
    
                    {{-- eKYC Information --}}
                    <div class="mb-4">
                        <h4 class="text-primary">eKYC</h4>
                        <table class="table table-bordered">
                            <tr><td>eKYC Status</td><td>{{ $superDistributors->ekyc ? 'Verified' : 'Unverified' }}</td></tr>
                            <tr><td>eKYC Verified At</td><td>{{ $superDistributors->ekyc_verified_at ?? 'N/A' }}</td></tr>
                            <tr><td>Aadhaar Name</td><td>{{ $superDistributors->aadhaarName ?? 'N/A' }}</td></tr>
                            <tr><td>LL Aadhaar Name</td><td>{{ $superDistributors->ekycLLAadhaarName ?? 'N/A' }}</td></tr>
                            <tr><td>Date of Birth</td><td>{{ $superDistributors->dob ?? 'N/A' }}</td></tr>
                            <tr><td>Gender (English)</td><td>{{ $superDistributors->genderEng ?? 'N/A' }}</td></tr>
                            <tr><td>Gender (Hindi)</td><td>{{ $superDistributors->genderHindi ?? 'N/A' }}</td></tr>
                            <tr><td>Care of (Co)</td><td>{{ $superDistributors->ekycCo ?? 'N/A' }}</td></tr>
                            <tr><td>Location</td><td>{{ $superDistributors->ekycLoc ?? 'N/A' }}</td></tr>
                            <tr><td>LL Location</td><td>{{ $superDistributors->ekycLLLoc ?? 'N/A' }}</td></tr>
                            <tr><td>VTC</td><td>{{ $superDistributors->ekycVtc ?? 'N/A' }}</td></tr>
                            <tr><td>LL VTC</td><td>{{ $superDistributors->ekycLLVtc ?? 'N/A' }}</td></tr>
                            <tr><td>District</td><td>{{ $superDistributors->ekycDist ?? 'N/A' }}</td></tr>
                            <tr><td>LL District</td><td>{{ $superDistributors->ekycLLDist ?? 'N/A' }}</td></tr>
                            <tr><td>State</td><td>{{ $superDistributors->ekycState ?? 'N/A' }}</td></tr>
                            <tr><td>LL State</td><td>{{ $superDistributors->ekycLLState ?? 'N/A' }}</td></tr>
                            <tr><td>Pincode</td><td>{{ $superDistributors->ekycPincode ?? 'N/A' }}</td></tr>
                            <tr><td>LL Pincode</td><td>{{ $superDistributors->ekycLLPincode ?? 'N/A' }}</td></tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <img src="data:image/jpeg;base64,{{ $superDistributors->photoBase64 }}"
                                         alt="Client Avatar"
                                         class="h-48 w-48 object-cover rounded-full border-4 border-gray-200">
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    {{-- Back Button --}}
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('admin.super-distributors.index') }}" class="btn btn-secondary">Back</a>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>

