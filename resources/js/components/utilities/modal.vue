<template>
    <div class="modal-container">
        <div class="modal">
            <div class="modal-header">
                <button class="btn btn-close-modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-content">
                <slot name="modal-content"></slot>
            </div>
            <div class="modal-footer">
                <button class="btn btn-green" @click="$emit('event')">
                    <slot name="button-primary">
                        save
                    </slot>
                </button>
                <button class="btn btn-red btn-close-modal">
                    <slot name="button-secondary">
                        cancel
                    </slot>
                </button>
            </div>
        </div>
    </div>
</template>

