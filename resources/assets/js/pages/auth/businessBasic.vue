<template>
    <div class="basic-page">
        <list-container title="代金券券号">
            <iqxInput
                :form="form"
                label="输入学生代金券券号"
                :v-errors="errors"
                :value.sync="form.payNum"
                name="name"
                v-validate="'required|max:30'"
        ></iqxInput>
            <!--<iqxInput placeholder="输入学生代金券券号" :inputVal.sync="name"></iqxInput>-->
            <!--<router-link to="success">-->
                <div class="btn-container" @click="useCoupon">
                    <iqxButtn text="确定"></iqxButtn>
                </div>
            <!--</router-link>-->
            <router-link to="payCode">
                <div class="myPayCode"><span>我的收款码</span></div>
            </router-link>
        </list-container>
        <div class="mid"></div>
        <list-container>
            <div class="payment-title">
                <div class="list-title">可结算收入</div>
                <span class="instruction">结算说明</span>
            </div>
            <div class="money">{{money}}元</div>
            <div class="total">总收入：{{total}}元</div>
        </list-container>
    </div>
</template>

<script>
    import Form from 'vform'
    import axios from 'axios'

    export default {
        name: "business-basic",
        metaInfo() {
            return {title: '书院文具店'}
        },
        data() {
            return {
                form     : new Form({
                    payNum:''
                }),
                name : '',
                money: '0',
                total: '0'
            }
        },
        computed:{

        },
        methods:{
            //收入
            async income() {
                const {data} = await axios.get('/api/merchant/income')
                this.money = data.amount
                this.total = data.total_amount
            },
            //使用优惠券
            async useCoupon() {
                axios.post('/api/promotion/school-merchant/use-award',{
                    type:'merchant',
                    serial:this.form.payNum,
                    promotion_code:'school_merchant',
                    merchant_id:this.$store.state.auth.user.id,
                }).then((res)=>{
                    if (res.data.code == 0){
                        this.$router.push('/success')
                    }else{
                        alert(res.data.error)
                        return;
                    }
                })
            }
        },

        mounted() {
            //页面加载完成之后更新收入
            this.income()
        },

    }
</script>

<style lang="stylus" scoped>
    .basic-page {
        height: 100%;
        background url("/img/bg2.png");
        padding 50px 30px 30px;
        background-size 100%;
        background-repeat no-repeat;
    }

    button {
        margin-top 20px!important;
    }

    .mid {
        height 15px;
    }

    .payment-title {
        position relative;
        padding-bottom 15px;
    }

    .myPayCode {
        margin-top 30px;
        padding 0;
        color #666666;
        text-align center;
        font-size 16px;
        vertical-align middle;
    }

    .myPayCode:before {
        content '';
        height 36px;
        width 36px;
        background url("/img/QRcode.png");
        transform scale(0.5);
        display inline-block;
        margin-bottom 3px;
    }

    .myPayCode:after {
        content '';
        height 24px;
        width 14px;
        background url("/img/arrow.png");
        transform scale(0.5);
        display inline-block;
        margin-bottom 3px;
        margin-left 5px;
    }

    .instruction {
        position absolute;
        right 0;
        top 0;
        line-height 24px;
        color #666666;
        font-size 10px;
    }

    .money {
        text-align center;
        font-size 36px;
        color #ff9823;
    }

    .total {
        text-align center;
        line-height 30px;
        color #666666;
        font-size 14px;
    }
</style>