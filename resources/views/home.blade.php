@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        <p class="mt-3">Anda akan dialihkan ke halaman Pokedex dalam <span id="countdown">3</span> detik...
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let countdown = 3;
        const countdownElement = document.getElementById('countdown');

        const interval = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;

            if (countdown === 0) {
                clearInterval(interval);
                window.location.href = "{{ url('/') }}";
            }
        }, 1000);
    </script>
@endsection
