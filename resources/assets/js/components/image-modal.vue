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
    function prepareModalOpened(e) {
        // console.log('event='+ e.currentTarget.getBoundingClientRect())
        const targetRect = e.currentTarget.getBoundingClientRect()
        // console.log(targetRect)
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
            openModal(e) {
                this.showImageModal2 = true
                this.modalTransform12 = prepareModalOpened(e)
            } ,
            closeModal() {
                this.$emit('close');
            },
            beforeEnter(el) {
                el.style.transform = this.modalTransform
                el.style.opacity = '0.5'
                // console.log(this.modalTransform)
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
        z-index: 40;
    }
    .modal-mask .modal-content {
        background-image: url('/themes/custom/assets/images/banner/bg_card.jpg');
        /*background-color: #f5f5f5;*/
        z-index: 50;
        padding: 2em;
        height: 100%;
    }
    /*.modal-transition-enter-active {*/
    /*    opacity: 1;*/
    /*}*/
    /*.modal-transition-enter {*/
    /*    opacity: 0;*/
    /*    transform: scale(1.5, 1.5);*/
    /*}*/
    /*.modal-transition-leave-active {*/
    /*    opacity: 0;*/
    /*    transform: scale(1.5, 1.5);*/
    /*}*/
    /*.modal-transition-leave {*/
    /*    opacity: 1;*/
    /*}*/
</style>