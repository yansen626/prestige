@extends('layouts.frontend')

@section('pageTitle', 'Order | NAMA')
@section('content')
    <section class="bg-white">
            <div class="container">
                <div class="row" style="margin-bottom:5%;">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12">
                            <h1>Order {{$order->order_number}}</h1>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                            <br/>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 mb-20">
                                <div class="col-md-3"><h5>Date</h5></div>
                                <div class="col-md-9"><h5>: {{$order->created_at}}</h5> </div>
                            </div>
                            <div class="col-md-12 mb-20">
                                <div class="col-md-3"><h5>Shipping</h5></div>
                                <div class="col-md-9"><h5>: {{$order->shipping_option}}</h5> </div>
                            </div>
                            <div class="col-md-12 mb-20">
                                <div class="col-md-3"><h5>Status</h5></div>
                                <div class="col-md-9"><h5>: {{$order->order_status->name}}</h5> </div>
                            </div>
                            @if($order->payment_option == 2)
                                <div class="col-md-12 mb-20">
                                    <a href="{{route('admin.orders.bank_confirmation')}}">Confirm Payment</a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($order->order_status_id == 4)
                                <div class="col-md-12 mb-20">
                                    <div class="col-md-3"><h5>Receipt</h5></div>
                                    <div class="col-md-9"><h5>: {{$order->track_code}}</h5> </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <button class="btn btn--secondary btn--bordered"
                                            onclick="rajaongkirAjaxGetWaybill('{{$order->track_code}}', '{{$order->shipping_option}}')"
                                            style="width: 220px;margin-bottom:2%;">
                                        TRACK ORDER
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="col-md-12">
                                    <div class="col-md-7 border-bottom-black mb-20">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">PRODUCT</div>
                                        <div class="col-md-2">QUANTITY</div>
                                        <div class="col-md-4 right">TOTAL</div>
                                    </div>
                                    <div class="col-md-5 border-bottom-black mb-20 hidden-xs hidden-sm">
                                        SHIPPING TO
                                    </div>
                                    <hr class="hidden-xs hidden-sm" style="height:1px;border:none;color:#333;background-color:#333;" />
                                    <div class="col-md-7">
                                        @foreach($orderProduct as $product)
                                            <div class="col-md-12 mb-10">
                                                <div class="col-md-2 ">
                                                    @php($productImage = \App\Models\ProductImage::where('product_id', $product->product->id)->where('is_main_image', 1)->first())
                                                    <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="product" style="width: 100%"/>
                                                </div>
                                                <div class="col-md-4">
                                                    {{$product->product->name}}<br>
                                                    @if(!empty($product->product_info))
                                                        Customization :<br>
                                                        {!! $product->product_info !!}
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    Quantity : {{$product->qty}}
                                                </div>
                                                <div class="col-md-4 right">
                                                    {{env('KURS_IDR')}} {{$product->grand_total_string}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-md-12 border-bottom-black mb-20 hidden-md hidden-lg">
                                            SHIPPING TO
                                        </div>
                                        <div class="col-md-12 border-bottom-black mb-20">
                                            {{$order->address->description}}, {{$order->address->street}},
                                            {{$order->address->suburb}}, {{$order->address->postal_code}}, {{$order->address->state}}, {{$order->address->country->name}},
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SUBTOTAL</div>
                                            <div class="col-md-6 right">{{env('KURS_IDR')}} {{$order->sub_total_string}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SERVICE</div>
                                            <div class="col-md-6 right">{{env('KURS_IDR')}} {{$order->payment_charge_string}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SHIPPING</div>
                                            <div class="col-md-6 right">{{env('KURS_IDR')}} {{$order->shipping_charge_string}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">TAX</div>
                                            <div class="col-md-6 right">{{env('KURS_IDR')}} {{$order->tax_amount_string}}</div>
                                        </div>
                                        <div class="col-md-12 border-bottom-black mb-20">
                                            <div class="col-md-6 bold">VOUCHER</div>
                                            <div class="col-md-6 right">({{env('KURS_IDR')}} <span id="voucher_amount_span">{{$order->voucher_amount_string}}</span>)</div>
                                            <input type="hidden" name="voucher_amount" id="voucher_amount" value="0">
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold"><h5>TOTAL</h5></div>
                                            <div class="col-md-6 right bold"><h5>{{env('KURS_IDR')}} {{$order->grand_total_string}}</h5></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
    </section>
@endsection
@include('partials.frontend._waybill-detail')

@section('styles')
    <style>
        .border-bottom-black {
            border-bottom: 1px solid #000000 !important;
            padding-bottom: 10px;
        }
        .right{
            text-align: right;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">

        // Ajax function to get rajaongkir waybill details
        function rajaongkirAjaxGetWaybill(tmpWaybill, tmpCourier){

            var courierValueSplitted = tmpCourier.split('-');
            // alert(courierValueSplitted[0]);
            $.ajax({
                url: '{{ route('ajax.rajaongkir.waybill') }}',
                type: 'POST',
                data: {
                    'waybill': tmpWaybill,
                    'courier': courierValueSplitted[0]
                },
                success: function(data) {
                    //console.log(data);
                    if(data.code === 200){
                        for(var i=0;i<data.manifest.length;i++){
                            $('#waybill').prepend(
                                "<div class='col-md-12' style='padding-top:10px;'>" +
                                "<span> Date = " + data.manifest[i].manifest_date + " " + data.manifest[i].manifest_time + "</span>" +
                                "</div>" +
                                "<div class='col-md-12 border-bottom-black '>" +
                                "<span> " + data.manifest[i].manifest_description + "</span>" +
                                "</div>"
                            );

                        }
                        var height = data.manifest.length * 70;
                        $(".modal-body").height(height);
                        $("#waybill-detail").modal('show');
                        console.log(data.manifest);
                    }
                    else{
                        console.log("error");
                    }
                },
                error: function(response){
                    console.log(response);
                }
            });
        }
    </script>
@endsection