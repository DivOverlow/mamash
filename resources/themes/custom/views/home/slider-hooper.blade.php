<section class="slider-hooper">
    <hooper :itemsToShow="3.25" pagination="no" slides='@json($sliderData)' public_path="{{ url()->to('/') }}">
{{--        <slide v-for="(slide, indx) in slides" :key="indx" :index="indx">--}}
{{--            {{ slide }}--}}
{{--        </slide>--}}

        <slide>
            slide 1
        </slide>
        <slide>
            slide 2
        </slide>
        <slide>
            slide 3
        </slide>
        <slide>
            slide 4
        </slide>
        <slide>
            slide 5
        </slide>

        <hooper-navigation slot="hooper-addons"></hooper-navigation>
        <hooper-pagination slot="hooper-addons"></hooper-pagination>
    </hooper>
</section>
