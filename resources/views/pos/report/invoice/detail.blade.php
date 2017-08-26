<div id="report-print">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px; margin-top: 10px;">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 " style="text-align: center;">
            <img src="{{asset('/pos/img/logo.jpg')}}" width="90" height="90" alt="">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align: center;">
            <span style="font-size: 24px;"><b>POS SHOP REPORT</b></span><br>
            <span style="font-size: 18px;"><b>INVOICE DETAIL</b></span>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">

        </div>
    </div>
    @foreach($rows as $row)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: solid 1px darkgrey; margin-bottom: 10px;">
            <div style="font-size:14px;">
                <table style="width: 100%; margin-bottom: 10px; margin-top: 10px;">
                    <tbody style="font-size: 14px;">
                    <tr style="text-align:center;">
                        <td style="vertical-align:middle;text-align:left; padding-left:10px;"><span><b>Invoice Number</b></span> : {{$row->invoice_number}}</td>
                        <td style="vertical-align:middle;text-align:left;"><span><b>Invoice Date</b></span> : {{$row->_date_}}</td>
                    </tr>
                    <tr style="text-align:center;">
                        <td style="vertical-align:middle;text-align:left; padding-left:10px;"><span><b>Customer Name</b></span> : {{$row->customer->name}}</td>
                        <td style="vertical-align:middle;text-align:left;"><span><b>Deposit</b></span> : {{$row->deposit}}</td>
                    </tr>
                    <tr style="text-align:center;">
                        <td style="vertical-align:middle;text-align:left; padding-left:10px;"><span><b>Complete Date</b></span> : {{$row->complete_date}}</td>
                        <td style="vertical-align:middle;text-align:left;"><span><b>Complete Price</b></span> : $ {{$row->complete_price}}</td>
                    </tr>
                    <tr style="text-align:center;">
                        <td style="vertical-align:middle;text-align:left; padding-left:10px;"><span><b>Status</b></span> : {{$row->status}}</td>
                        <td style="vertical-align:middle;text-align:left;"><span><b>Description</b></span> : {{$row->description}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <style>
                .no_border_btm tr td{
                    border:none !important;
                }
            </style>
            <table class="table-condensed receipt no_border_btm" style="width:100%;">
                <thead>
                <tr style="border:1px dotted black !important; font-size:14px;">
                    <th>No</th>
                    <th>Code</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Unit</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Discount</th>
                    <th class="text-center">Amount</th>
                </tr>
                </thead>
                <tbody style="border-bottom:2px solid black; font-size: 12px;">
                @php
                    $key = 1;
                    $invoice_details = \App\Models\InvoiceDetail::where('ref_id','=',$row->id)->get();
                    $grand_total = 0;
                    $sub_total = 0;
                    $total_discount = 0;
                @endphp
                @foreach($invoice_details as $invoice_detail)

                    @php
                        $item_field = \App\Models\Item::find($invoice_detail->item_id);
                        $amount = (($invoice_detail->qty)*($invoice_detail->price))-($invoice_detail->discount);
                        $grand_total+= $amount;
                        $sub_total+= ($invoice_detail->price);
                        $total_discount+= ($invoice_detail->discount);
                    @endphp
                    <tr class="item">
                        <td class="text-left">{{$key++}}</td>
                        <td class="text-left">{{$invoice_detail->item_code}}</td>
                        <td class="text-left">{{$item_field->title}}</td>
                        <td class="text-left">{{$item_field->unit}}</td>
                        <td class="text-right">{{number_format($invoice_detail->qty)}}</td>
                        <td class="text-right">$ {{number_format($invoice_detail->price)}}</td>
                        <td class="text-right">$ {{number_format($invoice_detail->discount)}}</td>
                        <td class="text-right">$ {{number_format($amount)}}</td>

                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <table style="width: 100%; margin-top: 5px;">
                <tr>
                    <td style="text-align:left;">សរុប</td>
                    <td style="text-align:right;">Sub Total (USD) :</td>
                    <td style="text-align:right;">$ {{number_format($sub_total)}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;">បញ្ចុះតំលៃ</td>
                    <td style="text-align:right;width:35%;">Discount (USD) :</td>
                    <td style="text-align:right;">$ {{number_format($total_discount)}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;">សរុបចុងក្រោយ</td>
                    <td style="text-align:right;width:40%;">Grand Total (USD) :</td>
                    <td style="text-align:right;">$ {{number_format($grand_total)}}</td>
                </tr>

            </table>
        </div>
    @endforeach

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
    {!! $rows->links() !!}
</div>