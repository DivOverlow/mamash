{!! view_render_event('bagisto.shop.layout.header.category.before') !!}

<?php

$categories = [];

foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category) {
    if ($category->slug)
        array_push($categories, $category);
}

$headerContent = app('Webkul\Core\Repositories\ContentRepository')->getAllContents();

?>

<category-nav  :header-content="{{ json_encode($headerContent) }}" categories='@json($categories)' url="{{url()->to('/')}}"></category-nav>

{!! view_render_event('bagisto.shop.layout.header.category.after') !!}


@push('scripts')


    <script type="text/x-template" id="category-nav-template">

        <ul class="nav">
            <category-item
                v-for="(item, index) in items"
                :class="`first-menu-item`"
                :key="index"
                :url="url"
                :item="item"
                :parent="index">
            </category-item>

            <li v-for="(content, index) in headerContent" :key="index" class="first-menu-item">
                <a
                    v-text="content.title"
                    :href="url+`/${content['page_link']}`"
                    v-if="(content['content_type'] == 'link' || content['content_type'] == 'category')"
                    :target="content['link_target'] ? '_blank' : '_self'">
                </a>
            </li>

        </ul>

    </script>

    <script>
        Vue.component('category-nav', {

            template: '#category-nav-template',

            props: {
                categories: {
                    type: [Array, String, Object],
                    required: false,
                    default: (function () {
                        return [];
                    })
                },
                headerContent: {
                    type: [Array, String, Object],
                    required: false,
                    default: (function () {
                        return [];
                    })
                },

                url: String
            },

            data: function () {
                return {
                    items_count: 0
                };
            },

            computed: {
                items: function () {
                    return JSON.parse(this.categories)
                }
            },
        });
    </script>

    <script type="text/x-template" id="category-item-template">
        <li>
            <a :href="url+'/categories/'+this.item['translations'][0].slug" class="nav-item">
                @{{ name }}

                 </a>
                <div class="nav-menu-info">
                    <div class="img-nav-block">
                        <img class="object-cover h-56 w-full" :src="url+'/storage/'+this.item.image" :alt="name" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
                    </div>
                    <div class="desc-nav-block" v-html="description">
                    </div>
                </div>

            <div v-if="haveChildren" class="nav-level">
                    <ul v-if="haveChildren && show">
                        <category-item
                            v-for="(child, index) in item.children"
                            :key="index"
                            :url="url"
                            :item="child">
                        </category-item>
                    </ul>
            </div>
        </li>
    </script>

    <script>
        Vue.component('category-item', {

            template: '#category-item-template',

            props: {
                item: Object,
                url: String,
            },

            data: function () {
                return {
                    items_count: 0,
                    show: false,
                };
            },

            mounted: function () {
                if (window.innerWidth > 100) {
                    this.show = true;
                }
            },

            computed: {
                haveChildren: function () {
                    return this.item.children.length ? true : false;
                },

                description: function () {
                    if (this.item.translations && this.item.translations.length) {
                        this.item.translations.forEach(function (translation) {
                            if (translation.locale == document.documentElement.lang)
                                return translation.description;
                        });
                    }

                    return this.item.description;
                },

                name: function () {
                    if (this.item.translations && this.item.translations.length) {
                        this.item.translations.forEach(function (translation) {
                            if (translation.locale == document.documentElement.lang)
                                return translation.name;
                        });
                    }

                    return this.item.name;
                }

            },

            methods: {
                showOrHide: function () {
                    this.show = !this.show;
                }
            }
        });
    </script>


@endpush