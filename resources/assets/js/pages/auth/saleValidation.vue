<template>
    <div class="sale-validation">
        <list-container>
            <h2 class="list-title">输入业务员编号</h2>
            <iqxInput
                    :form="form"
                    label="请输入业务员编号"
                    :v-errors="errors"
                    :value.sync="form.code"
                    name="name"
                    v-validate="'required|max:30'"
            ></iqxInput>
            <!--<iqxInput placeholder="请输入业务员编号" :inputVal.sync="code"></iqxInput>-->
        </list-container>
            <div class="btn-container" @click="salesubmit">
                <iqxButtn text="下一步"
                          :disabled=!form.code></iqxButtn>
        </div>
    </div>
</template>

<script>
    import Form from 'vform'

    export default {
        name: "sale-validation",
        metaInfo() {
            return {title: '业务员身份验证'}
        },
        data() {
            return {
                form     : new Form({
                    code: ''
                }),
            }
        },
        methods: {
            async salesubmit() {
                const {data} = await this.form.post('api/salesman/check')
                if(data.data.is_valid){
                    debugger
                    this.$router.push({name: 'bind'})
                }
            }
        }
    }
</script>

<style lang="stylus" scoped>

    .sale-validation {
        height 100%;
        background #f4f3f1;
        padding-top 15px;
    }

    .list-container {
        border-radius 0!important;
        padding-bottom 20px!important;
    }

    h2 {
        text-align left !important;
        padding-bottom 5px !important;
        color #333333 !important;
    }

    .btn-container{
        padding: 0 15px;
    }
</style>