@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Добро пожаловать!</h3></div>
            <div class="panel-body">Личный кабинет.</div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <orders :workers="{{ $workers }}"></orders>
            </div>
        </div>
    </div>
@endsection

