let $;
window.jQuery = window.$ = $ = require("jquery")
window.Vue = require("vue");
window.VeeValidate = require("vee-validate");
window.axios = require("axios");
require("./bootstrap");
require("ez-plus/src/jquery.ez-plus.js");
var accounting = require('accounting');
let locales;
locales = require("./lang/locales.js");

Vue.use(VeeValidate, {
    dictionary: {
        ar: { messages: locales.messages.ar }
    }
});

Vue.prototype.$http = axios

window.eventBus = new Vue();

Vue.component("image-slider", require("./components/image-slider.vue"));
Vue.component("card-modal", require("./components/CardModal"));
Vue.component("vue-slider", require("vue-slider-component"));
Vue.filter('currency', function (value, argument) {
    return accounting.formatMoney(value, argument);
})

import {
    Hooper,
    Slide,
    Navigation as HooperNavigation,
    Pagination as HooperPagination
} from 'hooper';
import 'hooper/dist/hooper.css';

$(document).ready(function () {
    const app = new Vue({
        el: "#app",
        components: {
            Hooper,
            Slide,
            HooperNavigation,
            HooperPagination
        },
        data() {
            return {
                showCardModal: false,
                hooperSettings: {
                    infiniteScroll: true,
                    centerMode: true,
                    autoPlay: true,
                    wheelControl: false,
                    playSpeed: 7000,
                    breakpoints: {
                        2400: { // 2400px ~
                            itemsToShow: 5.5
                        },
                        1800: { // 1800px ~ 2400px
                            itemsToShow: 4.5
                        },
                        1500: { // 1500px ~ 1800px
                            itemsToShow: 3.5
                        },
                        1100: { // 1100px ~ 1500px
                            itemsToShow: 2.5
                        },
                        600: { // 600px ~ 1100px
                            itemsToShow: 1.5
                        },
                        0: { // 0px ~ 600px
                            itemsToShow: 1
                        }
                    }
                },
                modalIds: {}
            }
        },

        mounted: function () {
            this.addServerErrors();
            this.addFlashMessages();

            this.$validator.localize(document.documentElement.lang);
        },

        methods: {
            onSubmit: function (e) {
                this.toggleButtonDisable(true);

                if(typeof tinyMCE !== 'undefined')
                    tinyMCE.triggerSave();

                this.$validator.validateAll().then(result => {
                    if (result) {
                        e.target.submit();
                    } else {
                        this.toggleButtonDisable(false);

                        eventBus.$emit('onFormError')
                    }
                });
            },

            toggleButtonDisable (value) {
                var buttons = document.getElementsByTagName("button");

                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].disabled = value;
                }
            },

            addServerErrors: function (scope = null) {
                for (var key in serverErrors) {
                    var inputNames = [];
                    key.split('.').forEach(function(chunk, index) {
                        if(index) {
                            inputNames.push('[' + chunk + ']')
                        } else {
                            inputNames.push(chunk)
                        }
                    })

                    var inputName = inputNames.join('');

                    const field = this.$validator.fields.find({
                        name: inputName,
                        scope: scope
                    });
                    if (field) {
                        this.$validator.errors.add({
                            id: field.id,
                            field: inputName,
                            msg: serverErrors[key][0],
                            scope: scope
                        });
                    }
                }
            },

            addFlashMessages: function () {
                const flashes = this.$refs.flashes;

                flashMessages.forEach(function (flash) {
                    flashes.addFlash(flash);
                }, this);
            },

            responsiveHeader: function () { },

            showModal(id) {
                this.$set(this.modalIds, id, true);
            }
        }
    });
});