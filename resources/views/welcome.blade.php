<x-app-layout>

    <div class="card">
        <div class="card-body">
            <x-data-table id="usersTable" ajax-url="#" :columns="[
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
                ['data' => 'avatar', 'name' => 'avatar', 'title' => 'Img'],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
                ['data' => 'city', 'name' => 'city', 'title' => 'City'],
                ['data' => 'wallet', 'name' => 'wallet', 'title' => 'Wallet'],
                ['data' => 'state', 'name' => 'state', 'title' => 'State'],
                ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
            ]" />
        </div>
    </div>

</x-app-layout>