<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>RANS-Invoice</title>


</head>

<style>
    #table-data {
        border-collapse: collapse;
        padding: 3px;
    }

    #table-data td, #table-data th {
        border: 1px solid black;
    }
    
</style>

<body>
<div class="invoice-box">
    <!-- <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> -->


    <table border="0" id="table-data" width="100%">
        <tr>
            <th colspan="4">INVOICE</th>
        </tr>
        <tr>
            <td width="70px"><b>Invoice No</b></td>
            <td width="">: {{ $product_masuk->id }}</td>
            <td width="30px"><b>Date</b></td>
            <td>: {{ $product_masuk->tanggal }}</td>
        </tr>

        <tr>
            <td><b>Phone No</b></td>
            <td>: {{ $product_masuk->supplier->telepon }}</td>
            <td><b>Address</b></td>
            <td>: {{ $product_masuk->supplier->alamat }}</td>
        </tr>

        <tr>
            <td><b>Supplier</b></td>
            <td>: {{ $product_masuk->supplier->nama }}</td>
            <td><b>Email</b></td>
            <td>: {{ $product_masuk->supplier->email }}</td>
        </tr>

        <tr>
            <td><b>Product</b></td>
            <td >: {{ $product_masuk->product->nama }}</td>
            <td><b>Quantity</b></td>
            <td >: {{ $product_masuk->qty }}</td>
        </tr>
        <tr>
            <td><b>Rate</b></td>
            <td >: {{ $product_masuk->rate }}</td>
            <td><b>Amount</b></td>
            <td >: {{ $product_masuk->amt }}</td>
        </tr>

    </table>

    {{--<hr  size="2px" color="black" align="left" width="45%">--}}

    <br />
    <br />
    <table border="0" width="80%">
        <tr align="center">
            <td>Best Regard</td>
        </tr>
    </table>

    <!-- <table border="0" width="80%">
        <tr align="right">
            <td><img src="https://upload.wikimedia.org/wikipedia/en/f/f4/Timothy_Spall_Signature.png" width="100px" height="100px"></td>
        </tr>

    </table> -->
    <table border="0" width="80%">
        <tr align="center">
            <td><b>R.A.N.S.</b></td>
        </tr>
    </table>
</div>
