 @extends('layouts.backend.app')
 @section('content')
 <div class="main-content" style="min-height: 619px;">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>
      <h5>Order Status</h5>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Process</h4>
              </div>
              <div class="card-body">
                {{ $data['process'] }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-info">
              <i class="far fa-paper-plane"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>On The Way</h4>
              </div>
              <div class="card-body">
                {{ $data['ontheway'] }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-times-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Cancel</h4>
              </div>
              <div class="card-body">
                {{ $data['cancel'] }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="far fa-check-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
               Accepted
              </div>
              <div class="card-body">
                {{ $data['accepted'] }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
 @endsection
