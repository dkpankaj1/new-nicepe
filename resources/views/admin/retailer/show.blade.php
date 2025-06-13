

<x-app-layout>
    @section('title', 'Retailer')
    @section('page-title', 'Retailer')
    @section('breadcrumb', Breadcrumbs::render('admin.retailers.show', $retailer))

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
    
                    {{-- Basic Information --}}
                    <div class="mb-4">
                        <h4 class="text-primary">Basic Information</h4>
                        <table class="table table-bordered">
                            <tr><td>Name</td><td>{{ $retailer->name }}</td></tr>
                            <tr><td>Email</td><td>{{ $retailer->email }}</td></tr>
                            <tr><td>Phone</td><td>{{ $retailer->phone ?? 'N/A' }}</td></tr>
                            <tr><td>Type</td><td>{{ $retailer->type ?? 'N/A' }}</td></tr>
                            <tr><td>Parent</td><td>{{ $retailer->parent ?? 'N/A' }}</td></tr>
                            <tr><td>Plan ID</td><td>{{ $retailer->plan_id ?? 'N/A' }}</td></tr>
                            <tr>
                                <td>Active Status</td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $retailer->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $retailer->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    {{-- Address --}}
                    <div class="mb-4">
                        <h4 class="text-primary">Address</h4>
                        <table class="table table-bordered">
                            <tr><td>Address</td><td>{{ $retailer->address ?? 'N/A' }}</td></tr>
                            <tr><td>City</td><td>{{ $retailer->city ?? 'N/A' }}</td></tr>
                            <tr><td>State</td><td>{{ $retailer->state ?? 'N/A' }}</td></tr>
                            <tr><td>Country</td><td>{{ $retailer->country ?? 'N/A' }}</td></tr>
                            <tr><td>Postal Code</td><td>{{ $retailer->postal_code ?? 'N/A' }}</td></tr>
                        </table>
                    </div>
    
                    {{-- eKYC Information --}}
                    <div class="mb-4">
                        <h4 class="text-primary">eKYC</h4>
                        <table class="table table-bordered">
                            <tr><td>eKYC Status</td><td>{{ $retailer->ekyc ? 'Verified' : 'Unverified' }}</td></tr>
                            <tr><td>eKYC Verified At</td><td>{{ $retailer->ekyc_verified_at ?? 'N/A' }}</td></tr>
                            <tr><td>Aadhaar Name</td><td>{{ $retailer->aadhaarName ?? 'N/A' }}</td></tr>
                            <tr><td>LL Aadhaar Name</td><td>{{ $retailer->ekycLLAadhaarName ?? 'N/A' }}</td></tr>
                            <tr><td>Date of Birth</td><td>{{ $retailer->dob ?? 'N/A' }}</td></tr>
                            <tr><td>Gender (English)</td><td>{{ $retailer->genderEng ?? 'N/A' }}</td></tr>
                            <tr><td>Gender (Hindi)</td><td>{{ $retailer->genderHindi ?? 'N/A' }}</td></tr>
                            <tr><td>Care of (Co)</td><td>{{ $retailer->ekycCo ?? 'N/A' }}</td></tr>
                            <tr><td>Location</td><td>{{ $retailer->ekycLoc ?? 'N/A' }}</td></tr>
                            <tr><td>LL Location</td><td>{{ $retailer->ekycLLLoc ?? 'N/A' }}</td></tr>
                            <tr><td>VTC</td><td>{{ $retailer->ekycVtc ?? 'N/A' }}</td></tr>
                            <tr><td>LL VTC</td><td>{{ $retailer->ekycLLVtc ?? 'N/A' }}</td></tr>
                            <tr><td>District</td><td>{{ $retailer->ekycDist ?? 'N/A' }}</td></tr>
                            <tr><td>LL District</td><td>{{ $retailer->ekycLLDist ?? 'N/A' }}</td></tr>
                            <tr><td>State</td><td>{{ $retailer->ekycState ?? 'N/A' }}</td></tr>
                            <tr><td>LL State</td><td>{{ $retailer->ekycLLState ?? 'N/A' }}</td></tr>
                            <tr><td>Pincode</td><td>{{ $retailer->ekycPincode ?? 'N/A' }}</td></tr>
                            <tr><td>LL Pincode</td><td>{{ $retailer->ekycLLPincode ?? 'N/A' }}</td></tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <img src="data:image/jpeg;base64,{{ $retailer->photoBase64 }}"
                                         alt="Client Avatar"
                                         class="h-48 w-48 object-cover rounded-full border-4 border-gray-200">
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    {{-- Back Button --}}
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('admin.retailers.index') }}" class="btn btn-secondary">Back</a>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
