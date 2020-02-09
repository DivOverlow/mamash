<template>
    <transition name="modal-transition"
                @before-enter="beforeEnter"
                @enter="enter"
                @before-leave="beforeLeave"
                @leave="leave"
                v-bind:css="false"
    >
        <div class="modal-mask" v-if="showing">
            <div class="modal-wrapper">
                <div class="modal-content">

                    <div class="modal-header">
                        <slot name="header">
                            <i class="icon remove-icon absolute mr-6 p-4 cursor-pointer top-0 right-0" @click="$emit('close')"></i>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            default body
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        props: {
            showing: {
                required: true,
                type: Boolean
            },
            modalTransform: {
                type: String,
            }
        },
        methods: {
            closeModal() {
                this.$emit('close');
            },
            beforeEnter(el) {
                el.style.transform = this.modalTransform
                el.style.opacity = '0.5'
            },
            enter(el, done) {
                setTimeout(() => {
                    el.style.transform ='translate(0px, 0px) scale(1, 1)'
                    el.style.opacity = '1'
                }, 100)
                setTimeout(() => {
                    done()
                }, 700)
            },
            beforeLeave(el) {
                el.style.transform = this.modalTransform
                el.style.opacity = '0'
            },
            leave(el, done) {
                setTimeout(() => {
                    el.style.transform ='translate(0px, 0px) scale(1, 1)'
                    done()
                }, 700)
            },
        }
    };

</script>

<style scoped>

    .modal-mask {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 1s ease, transform 1s ease;
    }
    .modal-mask, .modal-wrapper {
        position: fixed;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        z-index: 1000;
    }
    .modal-wrapper {
        background-color: rgba(0, 0, 0, 0.75);
        z-index: 50;
    }
    .modal-mask .modal-content {
        background-image: url('/themes/custom/assets/images/banner/bg_card.jpg');
        z-index: 10;
        padding: 2em;
        height: 100%;
    }
</style>