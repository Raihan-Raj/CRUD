@extends('AdminLayout.main')
@section('text')
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-start">
                <h5 class="card-title me-2">Total Sell</h5>
                <div class="ms-auto">
                    <div class="toolbar d-flex flex-wrap gap-2 text-end">
                        <button type="button" class="btn btn-light btn-sm">
                            <a href="#">ALL</a>
                        </button>
                        <button type="button" class="btn btn-light btn-sm">
                            <a href="/week/sell">Week</a>
                        </button>
                        <button type="button" class="btn btn-light btn-sm">
                            <a href="/month/sell">Month</a>
                        </button>
                        <button type="button" class="btn btn-light btn-sm active">
                            <a href="/yearly/sell">Yearly</a>
                        </button>
                    </div>
                </div>
            </div>
            <hr class="mb-4">
            <!-- <div class="apex-charts" id="area-chart" dir="ltr"></div>  -->
        </div>
    </div>
@endsection
