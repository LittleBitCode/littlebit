<template>
    <div class="iqu-input">
        <v-text-field
                :class="errorClass"
                :counter="counter"
                :error-messages="errorMessages"
                :hint="hint"
                :label="label"
                :name="name"
                :prepend-icon="prepend"
                :solo="true"
                v-model="_value"
                @focus="focus"
                :disabled="!disabled"
        ></v-text-field>
        <has-error :form="form" :field="name"></has-error>
        <!--<input type="type" :placeholder="placeholder" v-model="inputVal">-->
        <span v-if="rightText" @click="clickright">{{rightText}}</span>
    </div>
</template>

<script>
    import TextInput from './TextInput'

    export default {
        extends: TextInput,
        name   : "iqxInput",
        props  : {
            inputVal   : String,
            type       : {
                default: 'text',
                type   : String
            },
            placeholder: String,
            rightText  : {
                default: '',
                type   : [String, Number]
            },
            disabled: {
                type: Boolean,
                default: true
            }
        },
        methods: {
            clickright() {
                this.$emit('getVerCode')
            },
            focus() {
                this.$emit('focused')
            }
        }
    }
</script>

<style scoped>
    .iqu-input {
        position: relative;
        background: #f2f2f2;
        margin: 10px 0;
        border-radius: 5px;
        height: 50px;
    }

    span {
        line-height: 45px;
        font-size: 14px;
        display: block;
        color: #333;
    }

    .iqu-input {
        /*box-sizing: border-box;*/
        /*width: 100%;*/
        /*border: 0;*/
        /*border-radius: 5px;*/
        /*height: 50px;*/
        /*padding: 0 15px;*/
        /*font-size: 15px;*/

    }

    .iqu-input > div {
        background: transparent!important;
        box-shadow: none;
        border-radius: 5px;
    }
    .iqu-input > div>div{
        background: red;
    }
    span {
        position: absolute;
        right: 5px;
        top: 10px;
        padding: 0 10px;
        color: #5252ad;
        font-size: 13px;
        line-height: 30px;
    }
</style>
