@extends('layout')
@section('section')
    <div class="container mt-3">
        @if(Session::has('successMsg'))
        <div class="alert alert-success">
            <strong>{{session("successMsg")}}</strong>
        </div>
        @endif
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Image</th>
                <th>Description</th>
                <th>Stock</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php $i=1; @endphp
              @foreach($products as $product)
              <tr>
                  <td>{{$i++}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>&#8377;{{$product->price}}</td>
                  <td>@if(empty($product->discount)) - @else &#8377;{{$product->discount}} @endif</td>
                  <td><img src="{{url("image/$product->image")}}" style="width:100px;height:100px;"></td>
                  <td>{{$product->description}}</td>
                  <td>{{$product->stock}}</td>
                  <td>
                      <a href="{{url("products/$product->id/edit")}}" class="btn btn-success">Edit</a>
                      <form method="post" action="{{url("products/$product->id")}}" onsubmit="return confirm('Are you sure remove this product?')">
                        @csrf
                        {{method_field("DELETE")}}
                        <input type="submit" value="Delete" class="btn btn-danger" >
                    </form>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection