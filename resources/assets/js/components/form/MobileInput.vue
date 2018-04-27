<template>
  <div>
    <v-text-field
      :class="errorClass"
      :counter="counter"
      :error-messages="errorMessages"
      :hint="hint"
      :label="label"
      :name="name"
      :prepend-icon="prepend"
      type="mobile"
      v-model="_value"
    ></v-text-field>
    <has-error :form="form" :field="name"></has-error> 
  </div>
</template>

<script>
    import TextInput from './TextInput'

export default {
  extends: TextInput,
  name: 'mobile-input'
}

</script>
<style lang="stylus" scoped>
    .subheader {
        color: #000;
        font-size: 16px;
        text-align:bottom;
        margin-top 10px;
    }
</style>
