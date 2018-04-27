<template>
    <button class="iqx-btn"
            :disabled="disabled">{{text}}</button>
</template>

<script>
    export default {
        name: "iqxButtn",
        props: {
            disabled: Boolean,
            text: String,
        },
    }
</script>

<style scoped>

    button{
        background: #ff9823;
        color: #fefefe;
        border: 0;
        width: 100%;
        height: 45px;
        border-radius: 10px;
        margin-top: 30px;
    }
    button[disabled]{
        color: #ffd19d;
    }
</style>
