@push('scripts')
<script type="text/x-template" id="content-header-template">
    <div class="content-list right">
        <ul type="none" class="no-margin">
            <li v-for="(content, index) in headerContent" :key="index">
                <a
                    v-text="content.title"
                    :href="url+`/${content['page_link']}`"
                    v-if="(content['content_type'] == 'link' || content['content_type'] == 'category')"
                    :target="content['link_target'] ? '_blank' : '_self'">
                </a>
            </li>
        </ul>
    </div>
</script>


<script type="text/javascript">
    Vue.component('content-header', {

        template: '#content-header-template',
        props: {
            headerContent: {
                type: [Array, String, Object],
                required: false,
                default: (function () {
                    return [];
                })
            },

            url: String
        },
    });

</script>

@endpush