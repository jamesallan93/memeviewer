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

                    @if(!auth()->user()->subscriptions->count())

                    <p>Select a plan</p>
                    <plan-selector :plans="{{$plans}}"></plan-selector>

                    @else

                    <p>{{auth()->user()->name}} your plan is <strong>{{auth()->user()->subscription()->name}}</strong></p>
                    <p>description: <br>{{auth()->user()->subscription()->description}}</p>
                    <p>Registered at <br>{{auth()->user()->subscription()->starts_at->format('M, d Y')}} </p>
                    <p>Plan ends at <br>{{auth()->user()->subscription()->ends_at->format('M, d Y')}} </p>
                    <hr>
                    <meme-viewer :imgs="{{json_encode($memes_imgs)}}"></meme-viewer>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection