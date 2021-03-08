@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-primary">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">10</div>
                        <div>NEWS</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-info">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">10</div>
                        <div>NEWS</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-warning">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">10</div>
                        <div>NEWS</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-danger">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">10</div>
                        <div>NEWS</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection