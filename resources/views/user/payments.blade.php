<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center mb-4">
                            <h4 class="card-title mb-sm-0">Transactions</h4>
                            <a href="{{ route('admin-transaction-report') }}" class="text-dark ml-auto mb-3 mb-sm-0"> print transactions</a>
                        </div>
                        <div class="table-responsive border rounded p-1">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">Reference #</th>
                                        <th class="font-weight-bold">Activity</th>
                                        <th class="font-weight-bold">Method</th>
                                        <th class="font-weight-bold">Amount</th>
                                        <th class="font-weight-bold">Status</th>
                                        <th class="font-weight-bold">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>
                                                {{$item->reference}}
                                            </td>
                                            <td>{{$item->action}}</td>
                                            <td>{{$item->method}}</td>
                                            <td>{{$item->amount}}</td>
                                            <td>
                                                <div class="badge badge-{{get_trans_status($item->status)->badge}} p-2">{{ get_trans_status($item->status)->label }}</div>
                                            </td>
                                            <td>{{$item->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex mt-4 flex-wrap">
                            <nav class="ml-auto">
                                {{$transactions->links('pagination::bootstrap-4')}}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
