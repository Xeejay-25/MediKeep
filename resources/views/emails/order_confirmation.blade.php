<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #007BFF;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
            height: auto;
            float: right;
        }
        .content {
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 20px;
            margin-top: 20px;
        }
        p {
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://i.ibb.co/zSNR7Bf/Picsart-24-10-25-20-14-54-279.png" alt="Logo" 
                    style="position: absolute; top: 10px; right: 10px; height: 130px; opacity: 1; transform: rotate(-15deg); z-index: 1;">
            <h1>Order Request</h1>
        </div>
        <div class="content">
            <p>Dear <strong>{{ $supplier->name }}</strong>,</p>
            <p>A new order has been placed by <strong>{{ Auth::user()->name }}</strong> for <strong>{{ $order->order_date }}.</strong></p>

            <h2>Order Details:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($validatedData['product_id'] as $index => $productId)
                        @php
                            $product = $products->where('id', $productId)->first();
                        @endphp
                        <tr>
                            <td>{{ $product ? $product->name : 'Unknown Product' }}</td>
                            <td>{{ $validatedData['quantity'][$index] }}</td>
                            <td>₱ {{ number_format($validatedData['unit_price'][$index], 2) }}</td>
                            <td>₱ {{ number_format($validatedData['total_price'][$index], 2) }}</td>
                        </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>{{ array_sum($validatedData['quantity']) }}</strong></td>
                            <td></td>
                            <td><strong>₱ {{ number_format(array_sum($validatedData['total_price']), 2) }}</strong></td>
                        </tr>
                    </tfoot>                    
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>
</html>
