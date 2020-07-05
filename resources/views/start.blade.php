@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <h2 class="border-bottom text-center">Standart Vue + Laravel</h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-broup mr-2" role="group" aria-label="First group">
                <a type="button" href="#1" class="btn btn-secondary">Example component</a>
                <a type="button" href="#2" class="btn btn-secondary">Vue -> Blade</a>
                <a type="button" href="#3" class="btn btn-secondary">Vue -> AJAX</a>
                <a type="button" href="#4" class="btn btn-secondary">Some</a>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-primary" role="alert">
    A simple primary alert—check it out!
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="owl-carousel owl-theme mt-5" id="1">
            <div class="row m-2" data-hash="1">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#1 Example component</h2>
                            <example-component></example-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-2" data-hash="2" id="2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#2 Vue -> Blade train</h2>
                            <prop-component :urldata="{{ json_encode($url_data) }}"></prop-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-2" data-hash="3" id="3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#3 Vue -> AJAX train</h2>
                            <ajax-component></ajax-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-2" data-hash="3" id="4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#3 Vue -> AJAX train</h2>
                            <some-component></some-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
