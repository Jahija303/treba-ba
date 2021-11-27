<template>
    <label :for="id + '_button'" :class="{'active': isActive}" class="toggle__button">
        <input type="checkbox" :id="id + '_button'" v-model="checkedValue">
        <span class="toggle__switch"></span>
    </label>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    props: {
        id: {
            type: Number,
            default: 'primary'
        },

        defaultState: {
            type: Number,
            default: false
        }
    },

    data() {
        return {
            currentState: Boolean(this.defaultState === 1)
        }
    },

    watch: {
        defaultState: function defaultState() {
            this.currentState = Boolean(this.defaultState)
        }
    },

    computed: {
        isActive() {
            return this.currentState;
        },

        checkedValue: {
            get() {
                return this.currentState;
            },

            set(newValue) {
                this.currentState = newValue;
                this.$emit('switched', newValue, this.id)
            }
        }
    }
})
</script>

<style scoped>
.toggle__button {
    vertical-align: middle;
    user-select: none;
    cursor: pointer;
    padding-top: 3px;
}
.toggle__button input[type="checkbox"] {
    opacity: 0;
    position: absolute;
    width: 1px;
    height: 1px;
}
.toggle__button .toggle__switch {
    display:inline-block;
    height:15px;
    border-radius:6px;
    width:40px;
    background: #BFCBD9;
    position:relative;
    transition: all .25s;
}

.toggle__button .toggle__switch::after,
.toggle__button .toggle__switch::before {
    content: "";
    position: absolute;
    display: block;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    left: 0;
    top: -2.6px;
    transform: translateX(0);
    transition: all .25s cubic-bezier(.5, -.6, .5, 1.6);
}

.toggle__button .toggle__switch::after {
    background: #6c757d;
}
.toggle__button .toggle__switch::before {
    background: #4D4D4D;
    opacity:0;
}

.active .toggle__switch {
    background: #adedcb;
}

.active .toggle__switch::after,
.active .toggle__switch::before{
    transform:translateX(40px - 18px);
}

.active .toggle__switch::after {
    left: 23px;
    background: #28a745;
}
</style>
