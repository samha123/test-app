@extends('layouts.admin')

@section('content')
    <div class="row">
      
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.order.update-status', $orderDetails['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <select name="status" class="form-control form-control-sm" id="">
                                  <option  > @if( $orderDetails['status'] == 0)
                                         <b style="color:red"> Pending</b>
                                         @elseif( $orderDetails['status']== 1)
                                         <b style="color:green">Approved</b>
                                         @elseif( $orderDetails['status'] == 2)
                                         <b style="color:green">Cancelled</b>
                                          
                                         @else
                                      <b style="color:orange">Delivered</b>
                        
                   
                                   @endif</option>
                                    @foreach (OrderConstants::ORDER_STATUS as $key=>$status)
                                  @if( $orderDetails['status']==$key)@else
                                        <option value="{{ $key }}" >{{ $status }}</option>
                                  @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-success">Save</button>
                            </div>
                            <div class="col-md-5 text-right">
                                <h5># {{ $orderDetails['order_no'] }}</h5>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Billing Details</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        First Name: <b>{{ $orderDetails['billing_first_name'] }} {{ $orderDetails['billing_last_name'] }}</b>
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
                  <p class="text-muted">
                        Mode of Payment: <b>{{ $orderDetails['mode_of_payment'] }}</b>
                    </p>
                </div>
            </div>

        </div>
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
                             
                              
                              
                                <th>Total Price to Pay</th>
                              <th> Payed</th>
                            <th>To Pay</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($orderDetails['items'] as $orderItem)
                                <tr>
                                   <td>Gold Advance Booking</td>
                                  <td>{{ $orderItem['qty'] }}g</td>
                                 
                                    <td>₹{{$orderItem['gold_advance_total_amount']}}</td>
                                   <td>₹{{ ($orderItem['product_amount'] )  }}({{$orderItem['advance_percent'] }}%)</td>
                                   <td>₹{{ ($orderItem['gold_advance_total_amount']-($orderItem['product_amount'] )) }}</td>
                                    
                                   
                                   
                                   
                                   
                                </tr>
                               
                            @endforeach
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                  
                </div>
            </div>
        </div>


@endsection
