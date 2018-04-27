<template>
    <div class="success-page">
        <div class="success-img"></div>
        <div>消费成功!</div>
        <div class="btn-container" @click="backBasic">
            <iqxButtn text="确定"></iqxButtn>
        </div>
    </div>
</template>

<script>
    export default {
        name: "success",
        metaInfo() {
            return {title: '书院文具店'}
        },
        methods: {
            backBasic() {
                this.$router.push({
                    name: 'basic'
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    .success-page{
        text-align center;
        padding-top 50px;
    }
    .success-img{
        height 150px;
        width 150px;
        background: url("/img/succeed.png");
        background-size contain;
        transform scale(0.5);
        display inline-block;
    }
    span{
        font-size 18px;
    }
    button{
        width 215px!important;
        height 50px!important;
        border-radius 25px!important;
        margin-top 50px!important;
    }
</style>