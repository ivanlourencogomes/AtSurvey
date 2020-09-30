<template>
    <transition name="slide-fade" appear>
        <div class="modal-wrapper" @click="$emit('close-modal')" >
            
            <div class="modal-body" @click.stop>
                    <button type="button" class="close" aria-label="Close" @click="$emit('close-modal')">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="modal-header p-0">
                        <slot name="header"></slot>
                    </div>

                    <div class="modal-content">
                        <slot name="content"></slot>
                    </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
     
        mounted() {
            $("body").addClass("no-overflow");

        },
        destroyed() {
            $("body").removeClass("no-overflow");

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
            width: 1440px;
            max-width: 95%;
            height: 80vh;
            cursor: initial;
            padding: 50px 25px;
            overflow: auto;

            button.close {
                outline: none;
                position: absolute;
                right: 12px;
                top: 6px;
                z-index: 102;
            }

            .modal-content {
                border: none;
                padding: 24px 0;
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
