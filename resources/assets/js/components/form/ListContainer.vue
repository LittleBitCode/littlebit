<template>
    <div class="list-container">
        <h2 class="list-title" v-if="title">{{title}}</h2>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "list-container",
        props: {
            title: {
                type: String,
                default: ''
            },
        }
    }
</script>

<style scoped>
.list-container{
    background: #fff;
    border-radius: 10px;
    padding: 30px 20px;
    text-align: center;
}
.list-title{
    text-align: center;
    font-size: 16px;
    color: #333333;
    font-family: "PingFang SC-Medium";
    padding-bottom: 20px;
}
</style>