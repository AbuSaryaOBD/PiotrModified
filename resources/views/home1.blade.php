@extends('layout')

@section('content')
    <h1>{{ __('messages.welcome') }}</h1>
    <h1>@lang('messages.welcome')</h1>
    <p>{{ __('messages.example_with_value', ['name' => 'زيد']) }}</p>

    <p>{{ trans_choice('messages.plural', 0) }}</p>
    <p>{{ trans_choice('messages.plural', 1) }}</p>
    <p>{{ trans_choice('messages.plural', 2) }}</p>
    <p>{{ trans_choice('messages.plural', 3) }}</p>
    <p>{{ trans_choice('messages.plural', 5) }}</p>

    <p>JSON: {{ __('Welcome To Laravel') }}</p>
    <p>JSON: {{ __('Hello :name', ['name' => 'زيد']) }}</p>

@endsection