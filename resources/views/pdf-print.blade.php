<!DOCTYPE html>
<html>

<head>
    <title>Pharmacy Pdf</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

    </style>
</head>

<body>
    <h1 style="text-align: center">ABC Pharmacy</h1>
    <p style="text-align: center">679 Meadowview Drive Stewartsville VA 24179</p>
    <div style="display: flex; text-align:center">
        <div><b>Phone No.</b> : 8523697410</div>
        <div><b>Email </b>: abcpharmacy@gmail.com</div>
    </div>
<hr>
<h3>
<b>Customer name:</b>{{ $order[0]->patientname }}

</h3>

    <div class="container">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Medicine name</th>
                    <th>Expiry Dt.</th>
                    <th>MRP</th>
                    <th>Qty.</th>
                    <th>Total price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order[0]->orderdetail as $key => $value)
                    <tr>
                        <td> {{ $key += 1 }} </td>
                        <td> {{ $value->name }} </td>
                        <td> {{ $value->expiry }} </td>
                        <td> {{ $value->unitprice }} </td>
                        <td> {{ $value->quantity }} </td>
                        <td> {{ $value->qusumunit }} </td>

                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right;color:green"><b>Total</b></td>

                    <td colspan="1" id="order_total_amount" style="color: green"> <b>{{ $order[0]->amount }}</b> </td>
                </tr>
            </tfoot>
        </table>
        <br>
        @if ($order[0]->bike == 0)

        @else
        <p>Baki aca {{$order[0]->bike}} Taka</p>
        @endif
    </div>

</body>

</html>
