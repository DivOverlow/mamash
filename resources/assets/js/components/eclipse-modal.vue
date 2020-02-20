<template>
    <transition name="modal-eclipse">
        <div class="modal" v-if="show">
            <div class="modal-background"></div>
                <div class="modal-content">

                    <div class="modal-header relative">
                        <slot name="header">
                            <i class="icon remove-icon absolute m-2 p-4 cursor-pointer top-0 right-0" @click="emitClose"></i>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            default body
                        </slot>
                    </div>
                </div>
        </div>
    </transition>
</template>
<script>

    export default {
        props: ['message'],

        data() {
           return {
               show: false
           }
        },

        created() {
            eventBus.$on('close-eclipse-modal-event', () => {
                this.eclipseClose()
            })

            if(this.message) {

                this.eclipse();

                // this.hide()
            }
        },

        methods: {
            emitClose() {
              this.$emit('close')
            },

            eclipse() {
                setTimeout(()=> {
                    this.show = true;
                    // return document.querySelector('body').classList.add('modal-open');
                }, 1000);

            },

            eclipseClose() {
                this.show = false;
                // document.querySelector('body').classList.remove('modal-open');
            },

            hide() {
                setTimeout(()=> {
                    this.eclipseClose()
                }, 5000);
            }
        }

    };

</script>

<style scoped>

    .modal {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 1s ease, transform 1s ease;
    }
    .modal, .modal-background {
        position: fixed;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        z-index: 1000;
    }
    .modal-background {
        background-color: rgba(0, 0, 0, 0.75);
        z-index: 40;
    }
    .modal-content {
        background-color: #f5f5f5;
        z-index: 50;
    }
    .modal-eclipse-enter-active {
        opacity: 1;
    }
    .modal-eclipse-enter {
        opacity: 0;
        transform: scale(1.5, 1.5);
    }
    .modal-eclipse-leave-active {
        opacity: 0;
        transform: scale(1.5, 1.5);
    }
    .modal-eclipse-leave {
        opacity: 1;
    }
</style>