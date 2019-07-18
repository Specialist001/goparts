<?php

$this->registerCss('
//    header {
////        font-family: "serif";
//    }
//    h2 {
//        margin-bottom: 20px;
//    }
//    
//    .header table tr td {
//        font-size: 14px;
//        padding-right: 10px;
//        padding-bottom: 5px;
//    }
//    .header table tr td:first-child {
//        font-weight: bold;
//    }
//    .invoice_body {
//        padding-top: 20px;
//    }
//    .invoice_body h1 {
//        margin-bottom: 20px;
//    }
//    .invoice_body table {
//        font-size: 14pt!important;
//        margin: 0 auto;
//        width: 100%;
//    }
//    .invoice_body table td,
//    .invoice_body table th {
//        margin: 0 20px;
//        text-align: center;
//    }
//    .invoice_body table td:first-child,
//    .invoice_body table th:first-child {
//        margin-left: 0;
//        width: 20%;
//    }
//    .invoice_body table td:last-child,
//    .invoice_body table th:last-child {
//        margin-right: 0;
//    }
//    
//    .invoice_body table th:first-child,
//    .invoice_body table td:first-child {
//       width: 50%;
//    }
//    .invoice_body table td {
//        padding-top: 10px;
//    }
//    .invoice_warranty {
//        margin-top: 100px;
//        font-size: 14px;
//    }
//    ul {
//        padding-left: 40px;
//    }
//    li {
//        list-style: disc;
//    }

');
//echo '<pre>';
//print_r($order_product);exit;
//echo '</pre>';
$this->title = 'Invoice #'.$order_product->id;

?>
<div class="invoice">
    <div class="header">
        <h2>INVOICE #<?=$order_product->id?></h2>
        <br>
        <table>
            <tbody>
            <tr>
                <td><strong>Order ID:</strong></td>
                <td><?= $order_product->order_id?></td>
            </tr>
            <tr>
                <td><strong>Date of purchase:</strong></td>
                <td><?= date('Y-m-d H:m:t',$order_product->order->created_at) ?></td>
            </tr>
            <tr>
                <td><strong>Seller:</strong></td>
                <td><?= $order_product->product->user->legal_info ?></td>
            </tr>
            <tr>
                <td><strong>Buyer:</strong></td>
                <td>Goparts.ae (Al Mukhtar)</td>
            </tr>
            <tr>
                <td><strong>Pick up Location:</strong></td>
                <td><?= $order_product->order->city ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="invoice_body">
        <h1 class="">Order details</h1>
        <table>
            <thead>
            <tr>
                <th>Description</th>
                <th>Price</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $order_product->product->translate->description.' for '.$order_product->product->car->vendor.' '.$order_product->product->car->car.' '.$order_product->product->car->modification.' '.$order_product->product->car->year ?></td>
                <td><?= $order_product->product->price ?> AED</td>
                <td><?= $order_product->product->price ?> AED</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="invoice_warranty">
        <h2>WARRANTY AND RETURN POLICY</h2>
        <p>GOPARTS.AE (Al Mukhtar used auto sprae parts tr.) provides warranty for used spare parts and units, which ensure moving and functioning of vehicle, like engine, transmission, pump, motor , computer control units etc.</p>
        <p>The spare parts and units, which are static  (passive, motionless) and do not affect a  moving and functioning of the vehicle, like body parts (spoiler, glass, door, handle, bamper, fender, non- electric mirror  etc) , interior parts ( plastic covers, arm rest, lining, door handle etc.) will not be covered by warranty.</p>
        <p>GOPARTS.AE (Al Mukhtar used auto sprae parts tr.) provides warranty  6 days for the following parts and units, which ensure moving and functioning of the car:</p>
        <ul>
            <li>ENGINE</li>
            <li>TRANSMISSION</li>
            <li>STEERING RACK</li>
            <li>TRANSFER CASE</li>
            <li>DIFFERENTIAL</li>
        </ul>
        <p>GOPARTS.AE (Al Mukhtar used auto sprae parts tr.) provides 2 days warranty for the following parts and units:</p>
        <ul>
            <li>GENERATOR</li>
            <li>STARTER</li>
            <li>CONTROL UNIT (for engine, transmission, starter, ABS, etc.)</li>
            <li>PUMP</li>
            <li>MOTOR (for windshield wiper, door window regulator etc)</li>
            <li>AIRBAG</li>
            <li>SUSPENSION PARTS (shockabsorber, air suspension parts)</li>
            <li>A/C COMPRESOR</li>
        </ul>
        <p>In case the part or unit under warranty is found to be out of order it may be returned by customer to GOPARTS.AE (Al Mukhtar used auto sprae parts tr.)</p>
    </div>
</div>
