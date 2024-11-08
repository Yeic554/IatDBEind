@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email verifieren') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Een link is naar uw email gestuurt') }}
                        </div>
                    @endif

                    {{ __('Check uw email link') }}
                    {{ __('Email niet ontvangen?') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Nogmaals een email ontvangen') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
