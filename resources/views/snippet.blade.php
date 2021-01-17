@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Copy and paste below snippet in to your web application') }}</div>
                <div class="card-body">
                    <code>
                        <p>{{$token}} </p>
                    </code>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
