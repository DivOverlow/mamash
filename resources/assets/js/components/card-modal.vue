<template>
    <Transition name="slide-fade">
        <div v-if="showing" class="fixed inset-y-0 right-0 w-full h-screen flex items-center justify-end z-20 ml-128">
            <div class="card-modal-container relative sm:max-w-md h-full bg-white shadow-lg">
                <div class="modal-header">
                    <i class="icon remove-icon absolute m-2 p-4 cursor-pointer" @click="$emit('close')"></i>
                    <slot name="header">
                        Default header
                    </slot>
                </div>

                <div class="modal-body">
                    <slot name="body">
                        Default body
                    </slot>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                showing: false
            }
        },

        created() {
            eventBus.$on('open-card-modal-event', () => {
                this.showing = true
            })

            eventBus.$on('close-card-modal-event', () => {
                this.showing = false
            })

            if(this.message) {
                setTimeout(()=> {
                    this.showing = true
                }, 500);

            }
        },

        watch: {
            showing(value) {
                if (value) {
                    return document.querySelector('body').classList.add('modal-open');
                }

                document.querySelector('body').classList.remove('modal-open');
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
    .slide-fade-enter-active {
        transition: all .5s ease;
    }
    .slide-fade-leave-active {
        transition: all .5s cubic-bezier(0.3, 0.5, 0.8, 1.0);

    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(28rem);
    }
</style>