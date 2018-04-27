<template>
    <div class="info-page">
        <list-container title="基本信息">
            <!--<text-input-->
                    <!--:form="form"-->
                    <!--:label="$t('name')"-->
                    <!--:v-errors="errors"-->
                    <!--:value.sync="form.name"-->
                    <!--counter="30"-->
                    <!--name="name"-->
                    <!--v-validate="'required|max:30'"-->
            <!--&gt;</text-input>-->
            <!--<iqxInput placeholder="输入商家名称" :inputVal.sync="name"></iqxInput>-->
            <!--<iqxInput placeholder="选择商家类型"></iqxInput>-->
            <!--<iqxInput placeholder="输入商家地址" :inputVal.sync="name"></iqxInput>-->
            <!--<iqxInput placeholder="位置补充" :inputVal.sync="name"></iqxInput>-->
            <h2 class="list-title else-title">营业执照/身份证正反面(选填)</h2>
            <div class="unload-img">
                <div class="left">
                    <span v-if="!leftImg">点击上传</span>
                    <img v-else src="leftImg">
                </div>
                <div class="mid"></div>
                <div class="right">
                    <span v-if="!rightImg">点击上传</span>
                    <img v-else src="rightImg">
                </div>
            </div>
        </list-container>
        <router-link to="basic">
            <iqxButtn text="提交"></iqxButtn>
        </router-link>
    </div>
</template>

<script>
    import Form from 'vform'
    export default {
        name: "business-basic",
        metaInfo() {
            return {title: '商家信息'}
        },
        data() {
            return{
                name: '',
                leftImg: '',
                rightImg: '',
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                }),
            }
        }
    }
</script>

<style lang="stylus" scoped>

.info-page {
    height: 100%;
    background url("/img/bg2.png");
    padding 50px 30px 30px;
}
    .else-title{
        margin-top 20px;
    }
    .unload-img{
        display flex;
        font-size 15px;
        .left,.right{
            border-radius 5px;
            height 70px;
            flex 1;
            color #d2d2d2;
            text-align center;
            line-height 70px;
            background: #f2f2f2;
        }
        .mid{
            width 15px;
            background #fff;
        }
    }
</style>