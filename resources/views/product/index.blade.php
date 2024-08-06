@extends('layout')

@section('title', '商品列表')

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <h2>商品列表</h2>
            <hr>
            <table class="table table-success table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">商品名称</th>
                    <th scope="col">商品描述</th>
                    <th scope="col">单价</th>
                    <th scope="col">库存</th>
                    <th scope="col">创建时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
