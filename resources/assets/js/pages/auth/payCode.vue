<template>
    <div class="pay-code">
        <list-container>
            <div class="img-container">
                <img src="/img/savePayCode.png">
                <div id="imgview" :style="{background: `url(${payCode})`}"></div>
                <div></div>
            </div>
            <p>长按保存二维码</p>
        </list-container>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name    : "pay-code",
        metaInfo() {
            return {title: '我的收款码'}
        },
        data() {
            return{
                payCode: '',
                // oo:'https://t12.baidu.com/it/u=1265934677,3204789509&fm=173&app=25&f=JPG?w=549&h=391&s=DA175D84466204B2840CA9100300C0E2'
            }
        },
        methods: {
            async getQrCode() {
                const {data} = await axios.get('/api/merchant/qrcode')
                this.payCode = data.data
                this.$store.dispatch('getQrCode', {
                    qrcode   : data.data,
                })
            },
        },
        mounted() {
            this.getQrCode()
            if(this.payCode!==this.$store.state.auth.qrcode) {
                this.payCode = this.$store.state.auth.qrcode
            }
            // this.payCode = this.$store.state.auth.qrcode
            // document.getElementById('#imgview').style.background(url(this.payCode))
        }
    }
</script>

<style lang="stylus" scoped>
    .list-container{
        padding 50px;
    }
    .pay-code {
        height: 100%;
        background url("/img/bg2.png");
        padding 50px 30px 30px;
        background-size auto 100%;
        background-repeat no-repeat;
    }
        .img-container{
            height: 180px;
            width: 180px;
            margin: 20px auto;
            position: relative;
        }
    .img-container>div{
        height:140px;
        width:140px;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        margin: 20px;
        /*background url("/img/savePayCode.png")*/
        background-size: 140px!important;
        background-repeat: no-repeat!important;
    }
    img{
        height 180px;
        width 180px;
        padding 20px;
        opacity 0;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
    }
    p{
        line-height:80px;
    }
</style>