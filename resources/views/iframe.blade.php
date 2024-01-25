@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <iframe src="https://www.google.com/" frameborder="0"></iframe> --}}
        <div class="row justify-content-center">
            <div class="col-12">
                <iframe class="col-12 embed-responsive-item" src="https://www.google.com/search?igu=1" style="height: 100vh; width:100vw;"></iframe>
                {{-- <iframe class="row justify-content-center" src="https://www.google.com/search?igu=1" style="height: 100vh; width:100vw;"></iframe> --}}
            </div>
        </div>
    </div>
@endsection
