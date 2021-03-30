<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{__('message.invoice')}} - {{$invoice->invoice_number}}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
            /*padding-right: 140px !important;*/
            /*padding-left: 140px !important;*/
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        th{
            text-align: inherit;
        }
        thead{
            background-color: #F93822;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
            padding-top: 15px !important;
        }
        .status-red{
            color: red;

        }
        .status-green{
            color: green;

        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: white;
            color: #000;
            /*padding-right: 50px !important;*/
            /*padding-left: 50px !important;*/
        }

        .information2{
            background-color: #F93822;
            color: #000;
            padding-right: 70px !important;
            padding-left: 70px !important;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }

        .bold{
            font-weight: bold;
        }
    </style>

</head>
<body>

<div class="information" style="">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">

                <pre>
                    <div style="">
<b>{{$customer->name}}</b>
{{$customer->address}}
{{$customer->zip}}
{{$customer->country}}

                    @if( $customer->phone >= 1)

{{$customer->phone}}
                    @endif
                    @if( $customer->kvk >= 1)

{{$customer->kvk}}
                    @endif
                    @if( $customer->btw >= 1)
{{$customer->btw}}
</div>
@endif
<br /><br />
                    </pre>
                    <pre>
{{__('message.invoice_date')}}: {{date('d/m/yy', strtotime($invoice->invoice_date))}} <br>
{{__('message.expiry_date')}}: {{$invoice->expiry_date}} <br>
{{--Status: @if($invoice->status == 1) <a class="status-green">Paid</a> @elseif($invoice->status == 0) <a class="status-red">Pending</a> @endif--}}
</pre>


            </td>
            <td align="center">

            </td>
            <td align="right" style="width: 40%;">
                 <pre>
                <img style="width: 200px; position: fixed; top: 18px; right:294px; " src="{{ base_path() }}/public/img/leinnavlogo2.jpg" />

<div class="bold"> Leinnav Beveiliging & Brandwachten</div>
Narcissenstraat 79 /A
3073CL ROTTERDAM
Nederland

                </pre>
            <pre>
                    KvK: 604081380000
BTW: NL225558063B01
IBAN: NL80ABNA0428496814
Tel: 0610069196
E- mail: rhniel@hotmail.com
                </pre>
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    <h3>{{__('message.invoice')}} # {{$invoice->invoice_number}}</h3>
    <table width="100%">
        <thead>
        <tr>
            <th>{{__('message.place_of_work')}}</th>
            <th>{{__('message.hr_worked')}}</th>
            <th>{{__('message.p_hr')}}</th>
            <th>{{__('message.total')}}</th>
        </tr>
        </thead>
        <tbody>


        @foreach($invoicechildd as $invoicechild )
        <tr>
            <td>{{$invoicechild->place_of_work}} <br>Uren {{$invoicechild->start_time}} - {{$invoicechild->end_time}}<br>{{date('d-m-yy', strtotime($invoicechild->service_date))}}</td>

            <td>{{$invoicechild->wh}}</td>
            <td>{{str_replace('.',',', $invoicechild->price_per_hour)}}</td>
            <td align="left">€ {{str_replace('.',',',$invoicechild->total)}}</td>
        </tr>
            @endforeach

        </tbody>

        <tfoot>

        <tr>
            <td colspan="2"></td>
            <td align="left">Sub-Totaal:</td>
            <td align="left" class="gray">€ {{str_replace('.',',', $invoice->sub_total)}}</td>
        </tr>

        <tr>
            <td colspan="2"></td>
            <td align="left">{{__('message.tax')}}:</td>
            <td align="left" class="gray">{{str_replace('.',',', $invoice->tax)}} %  -  {{__('message.tax')}}: € {{str_replace('.',',', $invoice->tax_price)}} +</td>
        </tr>

        <tr>
            <td colspan="2"></td>
            <td align="left">{{__('message.total')}}:</td>
            <td align="left" class="gray">€ {{str_replace('.',',', $invoice->total)}}</td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="information2" style="position: absolute; bottom: 0;">
    <table style="width: 100%;">
        <tr>
            <td style="width: 70%; text-align: center;">
{{--                &copy; {{ date('Y') }} Invoicing System - All rights reserved.--}}
                We verzoeken u vriendelijk het bovenstaande bedrag van <div style="font-weight: bold;">€{{str_replace('.',',', $invoice->total)}}</div> uiterlijk {{$invoice->expiry_date}} te voldoen op IBAN-nummer NL19KNAB0602386829 onder vermelding van
                 <div style="font-weight: bold;">factuurnummer {{$invoice->invoice_number}}.</div> Voor vragen kunt u telefonisch of per email contact opnemen.
            </td>

        </tr>

    </table>
</div>
</body>
</html>
