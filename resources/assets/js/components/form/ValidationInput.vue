<template>
    <div>
        <v-layout row>
            <v-flex xs4>
                <v-subheader>{{leftText}}</v-subheader>
            </v-flex>
            <v-flex xs8
                    class="validation-input">
                <v-text-field
                        :class="errorClass"
                        :hint="hint"
                        :label="label"
                        :name="name"
                        v-model="_value"
                ></v-text-field>
                <div class="get-validation" @click="getCode" v-show="showVal">获取验证码</div>
            </v-flex>
        </v-layout>
        <!--<has-error :form="form" :field="name"></has-error>-->
    </div>
</template>

<script>
    import TextInput from './TextInput'

    export default {
        extends: TextInput,
        name   : 'validation-input',
        props: {
            getValidation: Function,
            showVal: Boolean,
        },
        methods: {
            getCode() {
                this.$emit('getCode')
            },
        }
    }
</script>
<style lang="stylus" scoped>
    .validation-input{
        position relative;
    }
    .subheader {
        color: #000;
        font-size: 16px;
        text-align:bottom ;
        margin-top 10px;
    }
    .get-validation{
        display inline-block;
        height 20px;
        padding 5px 10px;
        line-height 10px;
        background pink;
        border-radius 15px;
        position absolute;
        top 20px;
        right 0;
        font-size 12px;
    }
</style>
