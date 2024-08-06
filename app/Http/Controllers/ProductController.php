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
     * @var Product|null 产品模型
     */
    public ?Product $model = null;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function showCreateForm(Request $request): Factory|View|Application
    {
        return view('product.create');
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


}
