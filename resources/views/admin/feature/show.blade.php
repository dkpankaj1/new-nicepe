<x-app-layout>

    @section('title', 'Feature Details')
    @section('page-title', 'Feature Details')
    @section('breadcrumb', Breadcrumbs::render('admin.features.show', $feature))

    <div class="card">
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $feature->name }}</td>
                        </tr>
                        <tr>
                            <th>Fee</th>
                            <td>{{$generalSetting->currency->symbol}} {{ $feature->fee }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $feature->description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $feature->created_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $feature->updated_at->diffForHumans() }}</td>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('admin.features.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>


        </div>
    </div>


</x-app-layout>