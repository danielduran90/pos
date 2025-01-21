<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "//www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title> Sale report</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="10" style="margin-top: 40px;">
    <thead>
    <tr style="background-color: dodgerblue;">
        <th style="width: 200%">{{ __('messages.pdf.reference') }}</th>
        <th style="width: 200%">{{ __('messages.pdf.date') }}</th>
        <th style="width: 300%">{{ __('messages.pdf.customer') }}</th>
        <th style="width: 200%">{{ __('messages.pdf.user') }}</th>
        <th style="width: 200%">{{ __('messages.pdf.warehouse') }}</th>
        <th style="width: 200%">{{ __('messages.pdf.status') }}</th>
        <th style="width: 200%">{{ __('messages.pdf.total') }}</th>
        <th style="width: 300%">{{ __('messages.pdf.received_amount') }}</th>
        <th style="width: 300%">{{ __('messages.pdf.payment_status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sales  as $sale)
        <tr align="center">
            <td>{{$sale->reference_code}}</td>
            <td>{{$sale->date->format('d-m-Y')}}</td>
            <td>{{$sale->customer->name}}</td>
            <td>{{$sale->user->first_name}}</td>
            <td>{{$sale->warehouse->name}}</td>
            @if($sale->status == \App\Models\Sale::COMPLETED)
                <td>{{ __('messages.pdf.completed') }}</td>
            @elseif($sale->status == \App\Models\Sale::PENDING)
                <td>{{ __('messages.pdf.pending') }}</td>
            @elseif($sale->status == \App\Models\Sale::ORDERED)
                <td>{{ __('messages.pdf.ordered') }}</td>
            @endif
            <td style="float: left">{{number_format($sale->grand_total,2)}}</td>
            <td>{{number_format((float)$sale->payments->sum('amount'), 2)}}</td>
            @if($sale->payment_status == \App\Models\Sale::PAID)
                <td>{{ __('messages.pdf.paid') }}</td>
            @elseif($sale->payment_status == \App\Models\Sale::UNPAID)
                <td>{{ __('messages.pdf.unpaid') }}</td>
            @elseif($sale->payment_status == \App\Models\Sale::PARTIAL_PAID)
                <td>{{ __('messages.pdf.partial_paid') }}</td>
            @endif
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
