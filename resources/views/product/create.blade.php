@extends('layout')

@section('title', '创建商品')

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <h2>创建商品</h2>
            <hr>
            <form action="{{ route('product.create') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">名称</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="请输入商品名称">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">描述</label>
                    <textarea class="form-control" id="description" name="description" rows="10"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">价钱</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="请输入商品单价">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">库存</label>
                    <input type="number" class="form-control" name="stock" id="stock" placeholder="请输入商品库存">
                </div>
                <button type="submit" class="btn btn-primary">添加商品</button>
            </form>
        </div>
    </div>
@endsection
