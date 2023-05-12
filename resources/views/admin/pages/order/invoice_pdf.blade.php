<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Invoice</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <style>
            

 td 
            {
             width: 20%;
            }
            .t-aligh
            {
            text-align: right;
            }
            #customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}





#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #007583;
  color: white;
}
.t-padding
{
padding-top: 10px;
    padding-bottom: 30px;
     padding-right: 10px;
}

        </style>
    </head>
    <body>
      
     <table style="max-width:900px;margin:0 auto" width="100%"> 
       <tbody>
        <tr style=""> 
        
			<td style="text-align:right;"> 
              
                
               <img src="https://harris.brandsncodes.site/front-end/images/logo.jpg" style="height:30%
    line-height: 70px;
    width: 30%;" alt="logo images">
              </td>
        </tr>     
        <tr> 

          <td style="text-align:center;">
            
            <h4><b>  Invoice</b></h4>
          
          </td> 
        </tr> 
       </tbody>
      </table>
          <div class="row">
       <div class="col-md-3">
                            <h3 class="card-title">Sold By</h3>  
                             <p class="text-muted">
                    
                       Harris Nadar Jewellery
                   
                    </p>
                            </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Billing Details</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                    
                        First Name: <b>{{ $orderDetails['billing_first_name']}}</b>
                   
                    </p>
                   
                   <p class="text-muted">
                        Email: <b>{{ $orderDetails['billing_email'] }}</b>
                    </p>
                    <p class="text-muted">
                        Country: <b>{{ $orderDetails['billing_country'] }}</b>
                    </p>
                    <p class="text-muted">
                        Address 1: <b>{{ $orderDetails['billing_address_1'] }}</b>
                    </p>
                    <p class="text-muted">
                        Address 2: <b>{{ $orderDetails['billing_address_2'] }}</b>
                    </p>
                    <p class="text-muted">
                        City: <b>{{ $orderDetails['billing_city'] }}</b>
                    </p>
                    <p class="text-muted">
                        State: <b>{{ $orderDetails['billing_state'] }}</b>
                    </p>
                    <p class="text-muted">
                        Zip Code: <b>{{ $orderDetails['billing_zip_code'] }}</b>
                    </p>
                    <p class="text-muted">
                        Phone: <b>{{ $orderDetails['billing_phone'] }}</b>
                    </p>
                </div>
            </div>

        </div>@if($orderDetails['shipping_first_name'])
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Shipping Details</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        First Name: <b>{{ $orderDetails['shipping_first_name'] }} {{ $orderDetails['shipping_last_name'] }}</b>
                    </p>
                    
                    <p class="text-muted">
                        Email: <b>{{ $orderDetails['shipping_email'] }}</b>
                    </p>
                    <p class="text-muted">
                        Country: <b>{{ $orderDetails['shipping_country'] }}</b>
                    </p>
                    <p class="text-muted">
                        Address 1: <b>{{ $orderDetails['shipping_address_1'] }}</b>
                    </p>
                    <p class="text-muted">
                        Address 2: <b>{{ $orderDetails['shipping_address_2'] }}</b>
                    </p>
                    <p class="text-muted">
                        City: <b>{{ $orderDetails['shipping_city'] }}</b>
                    </p>
                    <p class="text-muted">
                        State: <b>{{ $orderDetails['shipping_state'] }}</b>
                    </p>
                    <p class="text-muted">
                        Zip Code: <b>{{ $orderDetails['shipping_zip_code'] }}</b>
                    </p>
                    <p class="text-muted">
                        Phone: <b>{{ $orderDetails['shipping_phone'] }}</b>
                    </p>
                </div>
            </div>
@endif
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Items</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                             
                                <th>Price</th>@if($orderDetails['shipping_first_name'])
                               
                               <th>Total</th>
                              @else
                              
                                <th>Total Price to Pay</th>
                              <th> Payed</th>
                               @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($orderDetails['items'] as $orderItem)
                                <tr> @if($orderItem['product'] ==null)
                                   <td>Gold Advance Booking</td>
                                  <td>{{ $orderItem['qty'] }}g</td>
                                  <td>{{ $orderItem['product_amount'] }}</td>
                                    <td>{{$orderItem['gold_advance_total_amount']}}</td>
                                   <td>{{ ($orderItem['product_amount'] + $orderItem['cer_amount'] + $orderItem['et_amount']) * $orderItem['qty'] }}({{$orderItem['advance_percent'] }}%)</td>
                                  @else
                                  <td>{{ $orderItem['product'] }}  @if( $orderItem['color']) (Color: {{ $orderItem['color'] }})@endif
                                    @if( $orderItem['sizes'])(Size: {{ $orderItem['sizes'] }})@endif</td>
                                    <td>{{ $orderItem['qty'] }}</td>
                                  <td>{{ $orderItem['product_amount'] }}</td>
                                   
                                   <td>Rs.{{number_format(($orderItem['product_amount'] + $orderItem['cer_amount'] + $orderItem['et_amount']) * $orderItem['qty']) }}</td>
                                  @endif
                                    
                                   
                                   
                                   
                                   
                                </tr>
                                @php
                                    $total += ($orderItem['product_amount'] + $orderItem['cer_amount'] + $orderItem['et_amount']) * $orderItem['qty'];
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-center">Total</td>
                              
                                <td>Rs.{{number_format($total)}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

       

       
              
                    <!-- <div class="form-group row"> -->
                   
                    
                    <!-- <div class="form-group row"> -->
                   
 
  


               
           
      

    </body>
</html>
