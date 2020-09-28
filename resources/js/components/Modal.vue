<template>
    <transition name="slide-fade" appear>
        <div class="modal-wrapper" @click="$emit('close-modal')" >
            <div class="modal-body" @click.stop>
                    <button type="button" class="close" aria-label="Close" @click="$emit('close-modal')">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="modal-content">
                        <slot></slot>
                    </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
     
        mounted() {
            //$("body").addClass("no-overflow");

        },
        destroyed() {
            //$("body").removeClass("no-overflow");

        }
    }
</script>

<style lang="scss">

    .modal-wrapper 
    {
        position: fixed;
        z-index: 100;
        width: 100%;
        height: 100vh;
        top: 0;
        left: 0;
        background-color: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;

        .modal-body {
            position: fixed;
            z-index: 101;
            background-color: #FFF;
            width: 600px;
            max-width: 100%;
            height: 80vh;
            cursor: initial;

            button.close {
                outline: none;
            }

            .modal-content {
                border: none;
            }
        }
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-to  {
        opacity: 0;
    }

</style>
