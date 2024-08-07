<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    /**
     * 拿到一个需求的时候我应该怎么做？
     * 1. 创建对应的数据表
     * 2. 定义路由 /product/index /product/create /product/show /product/edit /product/delete
     * 4. 创建对应的数据模型 / 定义验证规则
     * 5. 创建控制器 / 在控制器中定义方法 index show create edit update delete / 下单、加入购物车、收藏、点赞
     * 6. 创建视图 / 展示列表、详情、创建表单、编辑表单
     */

    /**
     * @var Product|null 产品模型
     */
    public ?Product $model = null;

    public function __construct()
    {
        $this->model = new Product();
    }

    /**
     * 创建新产品
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function create(Request $request): RedirectResponse
    {
        // 获取请求数据
        $data = $request->all();
        try {
            // 验证数据
            $validateData = $this->model->validate($data);
            // 保存到数据库
            Product::create($validateData);
            // 重定向到产品列表
            // 如果成功创建产品，则重定向到产品列表
            return redirect()->route('product.index');
        } catch (ValidationException $e) {
            // 验证失败，返回错误信息
            return redirect()->back()->withErrors($e->errors());
        }
    }

    /**
     * 显示所有产品
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $products = Product::all();
        return view('product.index', ['products' => $products]);
    }

    /**
     * 显示产品详情
     *
     * @param $id
     * @return Factory|View|Application
     */
    public function show($id): View|Factory|Application
    {
        $product = Product::find($id);
        return view('product.show', ['product' => $product]);
    }

    /**
     * 删除产品
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        Product::destroy($id);
        return redirect()->route('product.index');
    }

    /**
     * 编辑产品
     *
     * @param $id
     * @return Factory|View|Application
     */
    public function edit($id): Factory|View|Application
    {
        $product = Product::find($id);
        return view('product.edit', ['product' => $product]);
    }


    /**
     * 更新产品
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // 验证请求数据
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // 绑定数据到 Product 模型
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        // 保存更新后的数据到数据库
        $product->save();

        return redirect()->route('product.index');
    }
}
