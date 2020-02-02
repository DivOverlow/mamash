<?php

namespace Webkul\Core\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Webkul\Core\Repositories\ChannelRepository;
use Storage;
use Webkul\Core\Repositories\LocaleRepository as Locale;

/**
 * Banner Repository
 *
 * @author  Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BannerRepository extends Repository
{
    /**
     * ChannelRepository object
     *
     * @var Object
     */
    protected $channelRepository;

    /**
     * To hold the locale reposotry instance
     */
    protected $locale;


    /**
     * Create a new repository instance.
     *
     * @param  \Webkul\Core\Repositories\ChannelRepository $channelRepository
     * @return void
     */
    public function __construct(
        ChannelRepository $channelRepository,
        Locale $locale,
        App $app
    )
    {
        $this->channelRepository = $channelRepository;

        $this->locale = $locale;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Core\Contracts\Banner';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        $channelName = $this->channelRepository->find($data['channel_id'])->name;

        $dir = 'banner_images/' . $channelName;

        $uploaded = false;
        $image = false;

        if (isset($data['image'])) {
            $image = $first = array_first($data['image'], function ($value, $key) {
                if ($value)
                    return $value;
                else
                    return false;
            });
        }

        if ($image != false) {
            $uploaded = $image->store($dir);

            unset($data['image'], $data['_token']);
        }

        if ($uploaded) {
            $data['path'] = $uploaded;
        } else {
            unset($data['image']);
        }

        $data['content'] = json_encode($data['html_content']);

        return $this->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updateItem(array $data, $id)
    {
        $channelName = $this->channelRepository->find($data['channel_id'])->name;

        $dir = 'banner_images/' . $channelName;

        $uploaded = $image = false;

        if (isset($data['image'])) {
            $image = $first = array_first($data['image'], function ($value, $key) {
                return $value ? $value : false;
            });
        }

        if ($image != false) {
            $uploaded = $image->store($dir);

            unset($data['image'], $data['_token']);
        }

        if ($uploaded) {
            $bannerItem = $this->find($id);

            Storage::delete($bannerItem->path);

            $data['path'] = $uploaded;
        } else {
            unset($data['image']);
        }

        $locale = request()->get('locale') ?: app()->getLocale();
        $data[$locale]['content'] = json_encode($data[$locale]['html_content']);

        $this->update($data, $id);

        return true;
    }

    /**
     * Delete a banner item and delete the image from the disk or where ever it is
     *
     * @return Boolean
     */
    public function destroy($id)
    {
        $bannerItem = $this->find($id);

        $bannerItemImage = $bannerItem->path;

        Storage::delete($bannerItemImage);

        return $this->model->destroy($id);
    }

    /**
     * To extract the page content and load it in the respective view file\
     *
     * @return view
     */
    public function getBanner($key)
    {
        $currentChannel = core()->getCurrentChannel();
        $currentLocale = app()->getLocale();

        $currentLocale = $this->locale->findOneWhere([
            'code' => $currentLocale
        ]);

        $banner = $this->model->where([
            'banner_key' => $key,
            'channel_id' => $currentChannel->id,
        ])->first();

        return $banner->translations->where('locale', $currentLocale->code)->first();
    }

}