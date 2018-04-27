<template>
    <v-card flat>
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
            <v-card-title primary-title>
                <h5 class="subheading mb-0">{{ $t('your_info') }}</h5>
            </v-card-title>
            <v-card-text>
                <!-- Name -->
                <text-input
                        :form="form"
                        :label="$t('name')"
                        :v-errors="errors"
                        :value.sync="form.name"
                        counter="30"
                        name="name"
                        v-validate="'required|max:30'"
                ></text-input>

                <!-- Biz Type -->
                <v-select :items="bizTypes" name="biz_type" label="业务类型"></v-select>

                <b-map-search>
                </b-map-search>

                <text-input
                        :form="form"
                        :label="$t('补充地址，楼层/门牌号')"
                        :v-errors="errors"
                        :value.sync="form.address_detail"
                        counter="128"
                        name="address_detail"
                        v-validate="'required|max:128'">
                </text-input>
                <!--<file-uploader></file-uploader>-->
                <span>营业执照/身份证正反面（选填）</span>

                <upload-button title="点击上传" :selectedCallback="fileSelectedFunc"></upload-button>

            </v-card-text>

            <v-card-media id="uploadedFile" src="https://vuetifyjs.com/static/doc-images/cards/plane.jpg" height="200px">
            </v-card-media>
            <v-card-actions>
                <submit-button :flat="true" :form="form" :label="$t('update')"></submit-button>
            </v-card-actions>
        </form>
    </v-card>
</template>

<script>
    import Form from 'vform'
    import {mapGetters} from 'vuex'
    import FileUploader from '../../components/form/FileUploader'
    //    import VSelect from "vuetify/src/components/VSelect/VSelect";

    export default {
//        components: {VSelect},
        name: 'merchant-view',
        data: () => ({
            form    : new Form({
                name    : '',
                biz_type: ''
            }),
            bt      : null,
            bizTypes: [
                {text: "文具店"},
                {text: "奶茶店"},
                {text: "书店"},
                {text: "餐饮店"}
            ]
        }),

        computed: mapGetters({
            user: 'authUser'
        }),

        created() {
            // Fill the form with user data.
            this.form.keys().forEach(key => {
                this.form[key] = this.user[key]
            })
        },

        methods: {
            async fileSelectedFunc(file){
                console.log('ready to upload');
                console.log('file:'+file.name);
//                const { data } = await this.form.post('/api/images');
//                var params = new URLSearchParams();
                let params = new FormData();
                params.append('image', file);
                params.append('item_type', 'certification');
                this.$ajax({
                    method: 'post',
                    url: '/api/images',
                    data:params,
                    headers:{'Content-Type':'multipart/form-data'}
                }).then(function (response) {
                    console.log(response);

                }).catch(function (error) {
                    console.log(error);
                })
            },

            async update() {
                if (await this.formHasErrors()) return

                this.$emit('busy', true)

                const {data} = await this.form.patch('/api/settings/profile')

                await this.$store.dispatch('updateUser', {user: data})
                this.$emit('busy', false)

                this.$store.dispatch('responseMessage', {
                    type: 'success',
                    text: this.$t('info_updated')
                })
            }
        }
    }
</script>

