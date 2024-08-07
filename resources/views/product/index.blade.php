@extends('layout')

@section('title', '商品列表')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h2 class="">商品列表</h2>
                <a href="{{ route('product.create') }}" class="btn btn-primary ml-auto">添加商品</a>
            </div>
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
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        {{-- 在显示过长的信息时让超出的部分不显示 class="text-truncate" style="max-width: 150px;" data-toggle="tooltip" --}}
                        <td class="text-truncate" style="max-width: 150px;"
                            data-toggle="tooltip">{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm">详情</a>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm">编辑</a>
                            <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger btn-sm">删除</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
