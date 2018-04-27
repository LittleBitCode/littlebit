<template>
    <div class="mobile-page">
        <list-container title="手机号">
            <iqxInput
                    :form="form"
                    label="输入手机号"
                    :v-errors="errors"
                    :value.sync="form.mobile"
                    name="mobile"
                    v-validate="'required|email'"
            ></iqxInput>
            <iqxInput
                    :form="form"
                    label="输入验证码"
                    :v-errors="errors"
                    :value.sync="form.codeVal"
                    name="vercode"
                    v-validate="'required|email'"
                    :rightText="rightText"
                    :disabled="vertifyVal"
                    @getVerCode="getVerCode"
                    @focused="verfocused"
            ></iqxInput>
            <iqxInput
                    :form="form"
                    label="请输入6-8位密码"
                    :v-errors="errors"
                    :value.sync="form.password"
                    name="password"
                    v-validate="'required|email'"
            ></iqxInput>
        </list-container>
        <div class="btn-container" @click="login">
            <iqxButtn text="下一步" :disabled="!submitDis"></iqxButtn>
        </div>
    </div>
</template>

<script>
    import Form from 'vform'

    export default {
        name: 'login-view',
        metaInfo() {
            return {title: '商家信息'}
        },
        data() {
            return {
                form     : new Form({
                    password: '',
                    codeVal: '',
                    mobile: ''
                }),
                mobileNum: '',
                codeVal  : '',
                rightText: '获取验证码',
            }
        },
        computed: {
            submitDis() {
                return this.form.mobile&&this.form.codeVal&&this.form.password
            },
            vertifyVal() {
                return this.$store.state.auth.vertify
            }
        },

        methods: {
            countDown() {
                if(this.rightText==='获取验证码'||this.rightText==='')return
                this.rightText -= 1
                if (this.rightText === 0) {
                    clearInterval(this.countDown)
                    this.rightText = '获取验证码'
                }
            },
            getVerCode() {
                if(!this.form.mobile)return
                if(this.rightText!=='获取验证码')return
                this.rightText = '60'
                setInterval(this.countDown, 1000)
                this.getCode()
            },
            verfocused() {
                this.rightText = ''
            },
            async getCode() {
                const {data} = await new Form({mobile:this.form.mobile, action:'common'}).post('/quxue-sms/verify-code')
                this.$store.dispatch('saveVertify', {
                    vertify   : data.success,
                })
            },
            async login() {
                const {data} = await this.form.post('api/register ')
                this.$store.dispatch('saveToken', {
                    token: data.access_token,
                })
                if(data.status_code===200){
                    this.$router.push({name: 'sale'})
                }
            }
        },
        mounted() {
        }
    }
</script>
<style lang="stylus" scoped>
    .bind-btn {
        margin-top 50px;
    }

    .mobile-page {
        height: 100%;
        background url("/img/bg2.png");
        padding 50px 30px 30px;
        background-size 100%;
        background-repeat no-repeat;
    }
</style>
