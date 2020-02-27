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

        if (request()->ajax()) {

            $html = '<div class="sticker sale">' . 100 . '</div>'
                . '<span class="special-price mr-4">' . 'UAH' . '</span>'
                . '<span class="regular-price text-base text-gray-cloud line-through">' . 1000 . '</span>';

            return response()->json(['data' => $html]);
        }

        return view($this->_config['view'], compact('category'));
    }
}
