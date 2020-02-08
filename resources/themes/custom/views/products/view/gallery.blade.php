@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

<?php $images = $productImageHelper->getGalleryImages($product);?>

{!! view_render_event('bagisto.shop.products.view.gallery.before', ['product' => $product]) !!}

<div class="product-image-group {{ (count($images) == 1) ? 'sm:z-20 sm:h-264' :'' }}">

    <div class="cp-spinner cp-round" id="loader">
    </div>

    <product-gallery></product-gallery>

</div>

{!! view_render_event('bagisto.shop.products.view.gallery.after', ['product' => $product]) !!}

@push('scripts')



    <script type="text/x-template" id="product-gallery-template">
        <div class="flex flex-row z-10 {{ (count($images) == 1) ? 'sm:sticky sm:top-0' :'' }}">

            <ul class="thumb-list" v-if="(thumbs.length > 2)">
                <li class="gallery-control top" @click="moveThumbs('top')" v-if="(thumbs.length > 4) && this.is_move.up">
                    <span class="overlay"></span>
                    <i class="icon arrow-up-white-icon"></i>
                </li>

                <li class="thumb-frame" v-for='(thumb, index) in thumbs' @mouseover="changeImage(thumb)" :class="[thumb.large_image_url == currentLargeImageUrl ? 'active' : '']" id="thumb-frame">
                    <img :src="thumb.small_image_url"/>
                </li>

                <li class="gallery-control bottom" @click="moveThumbs('bottom')" v-if="(thumbs.length > 4) && this.is_move.down">
                    <span class="overlay"></span>
                    <i class="icon arrow-down-white-icon"></i>
                </li>
            </ul>

           <image-modal :showing="showImageModal1" :modalTransform="modalTransform11"  @close="showImageModal1 = false">
                <div slot="body">
                    <div class="w-full h-screen flex items-center justify-center py-10">
                        <img :src="currentOriginalImageUrl" :data-image="currentOriginalImageUrl" class="object-contain w-auto h-screen"/>
                    </div>
                </div>
            </image-modal>

            <div class="product-hero-image w-full max-w-xl sm:ml-auto h-96 sm:h-112 flex items-center justify-center" id="product-hero-image">
                <img :src="currentLargeImageUrl" id="pro-img" :data-image="currentLargeImageUrl" class="w-auto h-88 sm:h-96 object-scale-down cursor-pointer z-10" @click="openModal1($event)"/>

                @auth('customer')
                    <a @if ($wishListHelper->getWishlistProduct($product)) class="add-to-wishlist already" @else class="add-to-wishlist" @endif href="{{ route('customer.wishlist.add', $product->product_id) }}">
                    </a>
                @endauth
            </div>

        </div>
    </script>

    <script>
        function prepareModalOpened(e) {
            const targetRect = e.currentTarget.getBoundingClientRect()
            const targetCenterTop = targetRect.top + targetRect.height/2
            const targetCenterLeft = targetRect.left + targetRect.width/2
            const screenCenterTop = window.innerHeight/2
            const screenCenterLeft = window.innerWidth/2

            // css translate scale
            const translateX = targetCenterLeft - screenCenterLeft
            const translateY = targetCenterTop - screenCenterTop
            const scaleX = targetRect.width / window.innerWidth
            const scaleY = targetRect.height / window.innerHeight

            return `translate(${translateX}px, ${translateY}px) scale(${scaleX}, ${scaleY})`
        }

        var galleryImages = @json($images);

        Vue.component('product-gallery', {

            template: '#product-gallery-template',

            data: function() {
                return {
                    showImageModal1: false,
                    modalTransform11: '',
                    images: galleryImages,

                    thumbs: [],

                    currentLargeImageUrl: '',

                    currentOriginalImageUrl: '',

                    counter: {
                        up: 0,
                        down: 0,
                    },

                    is_move: {
                        up: true,
                        down: true,
                    }
                }
            },

            watch: {
                'images': function(newVal, oldVal) {
                    this.changeImage(this.images[0])

                    this.prepareThumbs()
                }
            },

            created: function() {
                this.changeImage(this.images[0])

                this.prepareThumbs()
            },

            methods: {
                openModal1(e) {
                    // console.log(e)
                    this.modalTransform11 = prepareModalOpened(e)
                    return this.showImageModal1 = true;
                } ,

                prepareThumbs: function() {
                    var this_this = this;

                    this_this.thumbs = [];

                    this.images.forEach(function(image) {
                        this_this.thumbs.push(image);
                    });
                },

                changeImage: function(image) {
                    this.currentLargeImageUrl = image.large_image_url;

                    this.currentOriginalImageUrl = image.original_image_url;

                    // if ($(window).width() > 580) {
                    //     $('img#pro-img').data('zoom-image', image.original_image_url).ezPlus();
                    // }
                },

                moveThumbs: function(direction) {
                    let len = this.thumbs.length;

                    if (direction === "top") {
                        const moveThumb = this.thumbs.splice(len - 1, 1);

                        this.thumbs = [moveThumb[0]].concat((this.thumbs));

                        this.counter.up = this.counter.up+1;

                        this.counter.down = this.counter.down-1;

                    } else {
                        const moveThumb = this.thumbs.splice(0, 1);

                        this.thumbs = [].concat((this.thumbs), [moveThumb[0]]);

                        this.counter.down = this.counter.down+1;

                        this.counter.up = this.counter.up-1;
                    }

                    if ((len-4) == this.counter.down) {
                        this.is_move.down = false;
                    } else {
                        this.is_move.down = true;
                    }

                    if ((len-4) == this.counter.up) {
                        this.is_move.up = false;
                    } else {
                        this.is_move.up = true;
                    }
                },
            }
        });

    </script>

    <script>
        $(document).ready(function() {
            // if ($(window).width() > 580) {
            //     $('img#pro-img').data('zoom-image', $('img#pro-img').data('image')).ezPlus();
            // }

            var wishlist = " <?php echo $wishListHelper->getWishlistProduct($product);  ?> ";

            $(document).mousemove(function(event) {
                if ($('.add-to-wishlist').length && wishlist != 1) {
                    if (event.pageX > $('.add-to-wishlist').offset().left && event.pageX < $('.add-to-wishlist').offset().left+32 && event.pageY > $('.add-to-wishlist').offset().top && event.pageY < $('.add-to-wishlist').offset().top+32) {

                        $(".zoomContainer").addClass("show-wishlist");

                    } else {
                        $(".zoomContainer").removeClass("show-wishlist");
                    }
                };

                // if ($("body").hasClass("rtl")) {
                //     $(".zoomWindow").addClass("zoom-image-direction");
                // } else {
                //     $(".zoomWindow").removeClass("zoom-image-direction");
                // }
            });
        })
    </script>

@endpush