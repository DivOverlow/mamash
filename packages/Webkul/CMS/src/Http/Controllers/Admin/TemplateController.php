<?php

namespace Webkul\CMS\Http\Controllers\Admin;

use Webkul\CMS\Http\Controllers\Controller;
use Webkul\CMS\Repositories\TemplateRepository as Template;
use Webkul\Core\Repositories\ChannelRepository as Channel;
use Webkul\Core\Repositories\LocaleRepository as Locale;

/**
 * CMS controller
 *
 * @author  Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
 class TemplateController extends Controller
{
    /**
     * To hold the request variables from route file
     */
    protected $_config;

    /**
     * To hold the channel reposotry instance
     */
    protected $channel;

    /**
     * To hold the locale reposotry instance
     */
    protected $locale;

    /**
     * To hold the TemplateRepository instance
     */
    protected $template;

    public function __construct(Channel $channel, Locale $locale, Template $template)
    {
        /**
         * Pass the class instance through admin middleware
         */
        $this->middleware('auth:admin');

        /**
         * Channel repository instance
         */
        $this->channel = $channel;

        /**
         * Locale repository instance
         */
        $this->locale = $locale;

        /**
         * Template repository instance
         */
        $this->template = $template;

        $this->_config = request('_config');
    }

    /**
     * Loads the index page showing the static pages resources
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * To create a new Template page
     *
     * @return view
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * To store a new CMS page in storage
     *
     * @return view
     */
    public function store()
    {
        $data = request()->all();
        // part one of the validation in case partials templates were generated or generating partial templates
        $this->validate(request(), [
            'channels' => 'required',
            'locales' => 'required',
            'template_key' => 'required'
        ]);

        $channels = $data['channels'];
        $locales = $data['locales'];

        $this->validate(request(), [
            'html_content' => 'required|string',
            'template_title' => 'required|string'
        ]);

        $data['content']['html'] = $data['html_content'];
        $data['content'] = json_encode($data['content']);

        $totalCount = 0;
        $actualCount = 0;

        foreach ($channels as $channel) {
            foreach ($locales as $locale) {
                $templateFound = $this->template->findOneWhere([
                    'channel_id' => $channel,
                    'locale_id' => $locale,
                    'template_key' => $data['template_key']
                ]);

                $totalCount++;

                $data['channel_id'] = $channel;

                $data['locale_id'] = $locale;

                if (! $templateFound) {
                    $result = $this->template->create($data);

                    if ($result) {
                        $actualCount++;
                    }
                }

                unset($templateFound);
            }
        }

        if (($actualCount != 0 && $totalCount != 0) && ($actualCount == $totalCount)) {
            session()->flash('success', trans('admin::app.cms.templates.create-success'));
        } else if (($actualCount != 0 && $totalCount != 0) && ($actualCount != $totalCount)) {
            session()->flash('warning', trans('admin::app.cms.templates.create-partial'));
        } else {
            session()->flash('error', trans('admin::app.cms.templates.create-failure'));
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * To edit a previously created CMS page
     *
     * @return view
     */
    public function edit($id)
    {
        $template = $this->template->findOrFail($id);

        if (request()->has('channel') && request()->has('locale')) {
            $channel = $this->channel->findOneWhere([
                'code' => request()->input('channel')
            ]);

            $locale = $this->locale->findOneWhere([
                'code' => request()->input('locale')
            ]);

            $template = $this->template->findOneWhere([
                'channel_id' => $channel->id,
                'locale_id' => $locale->id,
                'url_key' => $template->url_key
            ]);

            if (! $template) {
                $template  = $this->template->create([
                    'url_key' => str_random(8),
                    'channel' => $channel->code,
                    'locale' => $locale->code
                ]);

                return redirect()->route('admin.template.edit', $template->id);
            }
        } else {
            $template = $this->template->findOrFail($id);
        }

        return view($this->_config['view'])->with('template', $template);
    }

    /**
     * To update the previously created CMS page in storage
     *
     * @param Integer $id
     *
     * @return View
     */
    public function update($id)
    {
        $template = $this->template->findOrFail($id);

        $data = request()->all();

        $this->validate(request(), [
            'template_title' => 'required|string',
            'html_content' => 'required|string',
        ]);

        $data['content']['html'] = $data['html_content'];
        $data['content'] = json_encode($data['content']);

        $result = $this->template->update($data, $id);

        if ($result) {
            session()->flash('success', trans('admin::app.cms.templates.update-success'));
        } else {
            session()->flash('success', trans('admin::app.cms.templates.update-failure'));
        }
        return redirect()->route($this->_config['redirect']);
    }

//    /**
//     * To preview the content of the currently creating page or previously creating page
//     *
//     * @param Integer $id
//     *
//     * @return mixed
//     */
//    public function preview($id)
//    {
//        $page = $this->template->findOrFail($id);
//
//        return view('shop::cms.page')->with('page', $page);
//    }

    /**
     * To delete the previously create CMS page
     *
     * @param Integer $id
     *
     * @return Response JSON
     */
    public function delete($id)
    {
        $template = $this->template->findOrFail($id);

        if ($template->delete()) {
            session()->flash('success', trans('admin::app.cms.templates.delete-success'));

            return response()->json(['message' => true], 200);
        } else {
            session()->flash('success', trans('admin::app.cms.templates.delete-failure'));

            return response()->json(['message' => false], 200);
        }
    }

    /**
     * To mass delete the CMS resource from storage
     *
     * @return Response redirect
     */
    public function massDelete()
    {
        $data = request()->all();

        if ($data['indexes']) {
            $templateIDs = explode(',', $data['indexes']);

            $actualCount = count($templateIDs);

            $count = 0;

            foreach ($templateIDs as $templateId) {

                $template = $this->template->find($templateId);

                if ($template) {
                    $template->delete();

                    $count++;
                }
            }

            if ($actualCount == $count) {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.delete-success', [
                    'resource' => 'CMS Pages'
                ]));
            } else {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.partial-action', [
                    'resource' => 'CMS Pages'
                ]));
            }
        } else {
            session()->flash('warning', trans('admin::app.datagrid.mass-ops.no-resource'));
        }

        return redirect()->route('admin.template.index');
    }
}