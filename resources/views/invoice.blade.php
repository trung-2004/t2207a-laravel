@extends("layouts.layoutace")
@section("name")
    InVoice
@endsection
@section("main")
    <div class="container mt-5 mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border: none">
                    <div class="d-flex flex-row p-3">
                        <div class="d-flex flex-column"> <h2 class="font-weight-bold">Tax Invoice</h2> <h5>INV-001</h5> </div>
                    </div>
                    <hr>
                    <div class="table-responsive p-2">
                        <table class="table table-borderless">
                            <tbody>
                            <tr class="add">
                                <td class="font-weight-bold">BILLING TO:</td>
                                <td class="font-weight-bold">INVOICE</td>
                            </tr>
                            <tr class="content">
                                <td>Google <br>Attn: John Smith Pymont <br>Australia</td>
                                <td>Date: 07/02/2021 <br> Due date: 09/09/2022</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="products p-2">
                        <table class="table table-borderless">
                            <tbody>
                            <tr class="add">
                                <td class="font-weight-bold">Description</td>
                                <td class="font-weight-bold">Qty</td>
                                <td class="font-weight-bold">Price</td>
                                <td class="font-weight-bold text-center">Total</td>
                            </tr>
                            @foreach($order->products as $item)
                                <tr class="content">
                                    <td>{{$item->order_id}}</td>
                                    <td>{{$item->pivot->buy_qty}}</td>
                                    <td>${{$item->pivot->price}}</td>
                                    <td class="text-center">${{$item->pivot->price*$item->pivot->buy_qty}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="row p-3">
                        <div class="col-lg-6">
                            <p class="font-weight-bold">PAYMENT METHOD</p>
                            <p>By bank London State Bank</p>
                            <p>LN34 00 1258 99 6874 15587</p>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-clear">
                                <tbody>
                                <tr>
                                    <td class="left"><strong>Subtotal</strong></td>
                                    <td class="right">${{$total}}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Discount (20%)</strong></td>
                                    <td class="right">$160</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>VAT (10%)</strong></td>
                                    <td class="right">$90</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Total</strong></td>
                                    <td class="right"><strong>${{$total}}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="p-3">
                        <h5 class="font-weight-bold">TERMS AND CONDITIONS</h5>
                        <p>The origins of the first contellation date back to prehistoric times. Their purpose was to tell stories of their beliefs, experiences, creation, of mythology</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
