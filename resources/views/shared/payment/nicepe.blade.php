<x-app-layout>
    @section('title', 'Payment - Redirect..')

    <center>
        <h2>Please do not close or refresh the page. Redirecting to the payment gateway...</h2>
    </center>

    <form action="{{ $baseUrl }}" method="post" id="nicepe_form">
        @foreach ($transactionData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="checksum" value="{{ $checksum }}">
    </form>

    @push('pageScript')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('nicepe_form').submit();
            });
        </script>
    @endpush
</x-app-layout>