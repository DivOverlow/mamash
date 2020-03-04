<?php

namespace Webkul\Shop\Http\Controllers;

use Webkul\Category\Repositories\CategoryRepository;

/**
 * Category controller
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class CategoryController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CategoryRepository object
     *
     * @var array
     */
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Category\Repositories\CategoryRepository $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string $slug
     * @return \Illuminate\View\View
     */
    public function index($slug)
    {

        $category = $this->categoryRepository->findBySlugOrFail($slug);

        if (request()->wantsJson()) {

        if (!$category)
            return response([], 204);
//            $params = request()->input();
//            $html = $params['page'];
            $html = '';
            $html = $this->load_data($category->id);

            return response($html, 201);
//            return response()->json(['data' => $html]);
        }

        return view($this->_config['view'], compact('category'));
    }

    private function load_data($id)
    {
        $products =  app('Webkul\Product\Repositories\ProductRepository')->getAll($id);
        $html = '';
        foreach ($products as $productFlat) {
            $html .= '<div class="max-w-sm lg:max-w-md w-full lg:w-1/3 pl-0 sm:pl-6 pb-0 sm:pb-6">';
            $html .= view('shop::products.list.card', ['product' => $productFlat]);
            $html .= '</div>';
        }
        return $html;
    }
}
