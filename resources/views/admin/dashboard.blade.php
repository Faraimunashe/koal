<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-sm-flex align-items-baseline report-summary-header">
                                    <h5 class="font-weight-semibold">Dashboard Summary</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row report-inner-cards-wrapper">
                            <div class=" col-md -6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">Bookings</span>
                                    <h4>{{\App\Models\Booking::where('status', 2)->count()}}</h4>
                                    <span class="report-count">pending status</span>
                                </div>
                                <div class="inner-card-icon bg-success">
                                    <i class="icon-rocket"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">Transactions</span>
                                    <h4>{{\App\Models\Transaction::where('status', 1)->count()}}</h4>
                                    <span class="report-count"> success status</span>
                                </div>
                                <div class="inner-card-icon bg-danger">
                                    <i class="icon-briefcase"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">Diagnosis</span>
                                <h4>{{\App\Models\Diagnosis::count()}}</h4>
                                <span class="report-count"> total count</span>
                            </div>
                            <div class="inner-card-icon bg-warning">
                                <i class="icon-globe-alt"></i>
                            </div>
                            </div>
                            <div class="col-md-6 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">Abattoirs</span>
                                <h4>{{\App\Models\Abattoir::count()}}</h4>
                                <span class="report-count"> slaughter house</span>
                            </div>
                            <div class="inner-card-icon bg-primary">
                                <i class="icon-diamond"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
