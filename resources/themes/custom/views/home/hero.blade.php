@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')
<?php
$category = app('Webkul\Category\Repositories\CategoryRepository')->findOrFail(1);
?>


{!! DbView::make($templateRepository
        ->getTemplate('home-hero'))
        ->field('html_content')
        ->with( ['category_image_url' => (!is_null($category->image)) ? $category->image_url : null, 'category_description' => $category->description])
        ->render() !!}

