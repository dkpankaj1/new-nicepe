<x-app-layout>
    @section('title', 'My Account')
    @section('page-title', 'My Account')
    @section('breadcrumb', Breadcrumbs::render('distributor.account.index'))

    @push('page-head')
        <style>
            .profile-card {
                max-width: 400px;
                margin: auto;
                text-align: center;
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .profile-img {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                border: 4px solid #fff;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }

            .profile-info {
                text-align: left;
            }

            .profile-info p {
                margin: 5px 0;
            }

            .social-links a {
                margin: 0 10px;
                font-size: 20px;
                color: #007bff;
                transition: 0.3s;
            }

            .social-links a:hover {
                color: #0056b3;
            }
        </style>
    @endpush


    <div class="card">
        <div class="card-body">

            <div class="align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ $user->avatar }}" class="rounded-2 avatar-xxl" alt="image profile">
                    <div class="overflow-hidden ms-4">
                        <h4 class="m-0 text-dark fs-20">{{ $user->name }}</h4>
                        <p class="my-1 text-muted fs-16">{{ $user->email }}</p>
                    </div>    
                </div>
                <hr>
                <a class="btn btn-primary" href="{{ route('distributor.account.update') }}">Edit Profile</a>
            </div>


        </div>
    </div>
</x-app-layout>