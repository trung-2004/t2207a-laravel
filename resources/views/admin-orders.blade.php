@extends("admin-layout.layout")
@section("admin-main")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example2"
                                                   class="table table-bordered table-hover dataTable dtr-inline"
                                                   aria-describedby="example2_info">
                                                <thead>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0"
                                                        aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Rendering engine: activate to sort column descending"
                                                        aria-sort="ascending">full name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        create at
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="Engine version: activate to sort column ascending">
                                                        address
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        phone
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        email
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        payment method
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        is paid
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        status
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        view
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $item)
                                                    <tr class="odd">
                                                        <td class="dtr-control sorting_1"
                                                            tabindex="0">{{$item->lastname." ".$item->lastname}}</td>
                                                        <td>{{$item->created_at}}</td>
                                                        <td>{{$item->address}}</td>
                                                        <td>{{$item->phone}}</td>
                                                        <td>{{$item->payment_method}}</td>
                                                        <td>{{$item->email}}</td>
                                                        <td>
                                                            @if($item->is_paid)
                                                                <span class="text-success">Pain</span>
                                                            @else
                                                                <span class="text-danger">UnPain</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @switch($item->satus)
                                                                @case(0) <span
                                                                    class="text text-dark">Pending</span>@break
                                                                @case(1) <span
                                                                    class="text text-blue">Comfirm</span>@break
                                                                @case(2) <span
                                                                    class="text text-warning">Shipping</span>@break
                                                                @case(3) <span
                                                                    class="text text-success">Comlete</span>@break
                                                                @case(4) <span
                                                                    class="text text-danger">Cancel</span>@break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            <a href="{{url("/admin-invoice", ["order" => $item->id])}}"
                                                               class="btn btn-outline-info">View</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {!! $orders->appends(app("request")->input())->links("pagination::bootstrap-4") !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
