<?php

namespace Webkul\Core\Http\Controllers;

use Webkul\Core\Repositories\BannerRepository;

/**
 * Banner controller for managing the slider controls.
 *
 * @author  Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright  2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BannerController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * BannerRepository
     *
     * @var Object
     */
    protected $bannerRepository;

    /**
     * @var array
     */
    protected $channels;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\BannerRepository $bannerRepository
     * @return void
     */
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;

        $this->_config = request('_config');
    }

    /**
     * Loads the index for the banners settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Loads the form for creating banner.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $channels = core()->getAllChannels();

        return view($this->_config['view']);
    }

    /**
     * Creates the new sider item.
     *
     * @return response
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'string|required',
            'banner_key' => 'string|required',
            'html_content' => 'required|string',
            'channel_id' => 'required',
            'image.*'  => 'required|mimes:jpeg,bmp,png,jpg'
        ]);

        $result = $this->bannerRepository->save(request()->all());

        if ($result)
            session()->flash('success', trans('admin::app.settings.banners.created-success'));
        else
            session()->flash('success', trans('admin::app.settings.banners.created-fail'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Edit the previously created banner item.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->findOrFail($id);

        return view($this->_config['view'])->with('banner', $banner);
    }

    /**
     * Edit the previously created banner item.
     *
     * @return response
     */
    public function update($id)
    {
        $locale = request()->get('locale') ?: app()->getLocale();

        $this->validate(request(), [
            $locale . '.title' => 'string|required',
            $locale . '.html_content' => 'required|string',
            'channel_id' => 'required',
            'image.*'  => 'sometimes|mimes:jpeg,bmp,png,jpg'
        ]);

        $result = $this->bannerRepository->updateItem(request()->all(), $id);

        if ($result) {
            session()->flash('success', trans('admin::app.settings.banners.update-success'));
        } else {
            session()->flash('error', trans('admin::app.settings.banners.update-fail'));
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Delete a banner item and preserve the last one from deleting
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $banner = $this->bannerRepository->findOrFail($id);

        try {
            $this->bannerRepository->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Banner']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Banner']));
        }

        return response()->json(['message' => false], 400);
    }
}