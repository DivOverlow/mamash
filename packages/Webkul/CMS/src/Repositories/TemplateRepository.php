<?php

namespace Webkul\CMS\Repositories;

use Webkul\Core\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Webkul\Core\Repositories\ChannelRepository as Channel;
use Webkul\Core\Repositories\LocaleRepository as Locale;

/**
 * CMS Reposotory
 *
 * @author  Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */

class TemplateRepository extends Repository
{
    /**
     * To hold the channel reposotry instance
     */
    protected $channel;

    /**
     * To hold the locale reposotry instance
     */
    protected $locale;

    public function __construct(Channel $channel, Locale $locale, App $app)
    {
        $this->channel = $channel;

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
        return 'Webkul\CMS\Contracts\Template';
    }

    public function create(array $data)
    {
        $result = $this->model->create($data);

        if ($result) {
            return $result;
        } else {
            return $result;
        }
    }

//    /**
//     * Retrive category from slug
//     *
//     * @param string $key
//     * @return mixed
//     */
//    public function getTemplate($key)
//    {
//        $currentChannel = core()->getCurrentChannel();
//        $currentLocale = app()->getLocale();
//
//        $currentLocale = $this->locale->findOneWhere([
//            'code' => $currentLocale
//        ]);
//
//        $template = $this->model->where([
//            'template_key' => $key,
//            'locale_id' => $currentLocale->id,
//            'channel_id' => $currentChannel->id
//        ])->first();
//
//        if ($template) {
//            return $template->page_title;
//        }
//        return $key;
//    }

    /**
     * To extract the page content and load it in the respective view file\
     *
     * @return view
     */
    public function getTemplate($key)
    {
        $currentChannel = core()->getCurrentChannel();
        $currentLocale = app()->getLocale();

        $currentLocale = $this->locale->findOneWhere([
            'code' => $currentLocale
        ]);

        $template = $this->model->where([
            'template_key' => $key,
            'locale_id' => $currentLocale->id,
            'channel_id' => $currentChannel->id
        ])->first();

        return $template;
//        if ($page) {
//            return view('shop::cms.page')->with('page', $page);
//        } else {
//            abort(404);
//        }
    }


}