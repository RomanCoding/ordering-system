@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="container">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Добро пожаловать!</h3></div>
                <div class="panel-body">Админ панель.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <admin-panel></admin-panel>
            </div>
        </div>
    </div>
@endsection
