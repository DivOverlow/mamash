<template>
    <transition name="modal-transition">
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
            }
        },
        methods: {
            close() {
                this.$emit('close');
            }
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
        z-index: 40;
    }
    .modal-mask .modal-content {
        background-color: #f5f5f5;
        z-index: 50;
        padding: 2em;
        height: 100%;
    }
    .modal-transition-enter-active {
        opacity: 1;
    }
    .modal-transition-enter {
        opacity: 0;
        transform: scale(1.5, 1.5);
    }
    .modal-transition-leave-active {
        opacity: 0;
        transform: scale(1.5, 1.5);
    }
    .modal-transition-leave {
        opacity: 1;
    }
</style>