import Vue from 'vue'
import VeeValidate, {Validator} from 'vee-validate';
// import zh from 'vee-validate/dist/locale/zh_CN';


const config = {
    locale:'zh_CN',
    dealy:250,

};

Vue.use(VeeValidate, config);

Validator.extend('mobile', {
    getMessage: field => field + '必须是11位手机号码',
    validate: value => {
        return value.length == 11 && /^((13|14|15|17|18)[0-9]{1}\d{8})$/.test(value)
    }
});

Vue.mixin({
  $_veeValidate: {
    validator: 'new'
  },
  methods: {
    async formHasErrors () {
      const valid = await this.$validator.validateAll()
      if (valid) {
        this.$validator.pause()
      }
      return !valid
    }
  }
})
