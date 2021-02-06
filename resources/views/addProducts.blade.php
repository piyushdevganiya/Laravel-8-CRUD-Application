@extends('layout')
@section('section')
    <div class="container mt-3">
        <form method="post" enctype="multipart/form-data" action="{{url($url)}}">
            @csrf
            @isset($edit)
                @method('PUT')    
            @endisset
            <div class="card">
                <div class="card-header bg-dark text-white">{{$title}}</div>
                <div class="card-body">
                    @if(Session::has('successMsg'))
                    <div class="alert alert-success">
                        <strong>{{session("successMsg")}}</strong>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="product_name">Product name</label>
                        <input type="text" class="form-control" name="product_name" id="product_name" value="@if($errors->any()){{old('product_name')}}@elseif(isset($edit)){{$edit[0]->product_name}}@endif">
                        @error('product_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description">@if($errors->any()){{old('description')}}@elseif(isset($edit)){{$edit[0]->description}}@endif</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" id="price" value="@if($errors->any()){{old('price')}}@elseif(isset($edit)){{$edit[0]->price}}@endif">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form- col-md-6">
                            <label for="discount">Discount</label>
                            <input type="text" class="form-control" name="discount" id="discount" value="@if($errors->any()){{old('discount')}}@elseif(isset($edit)){{$edit[0]->discount}}@endif">
                            @error('discount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" name="stock" id="stock" value="@if($errors->any()){{old('stock')}}@elseif(isset($edit)){{$edit[0]->stock}}@endif">
                            @error('stock')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image" >
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            @if(isset($edit))
                            <img src="{{url("image/".$edit[0]->image)}}" style="width:100px;height:100px;">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-dark text-white">
                    <input type="submit" class="btn btn-light">
                </div>
            </div>
        </form>
    </div>
@endsection