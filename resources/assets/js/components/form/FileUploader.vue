<template>
    <div>
        <v-text-field prepend-icon="attach_file" single-line
                      v-model="filename" :label="label" :required="required"
                      @click.native="onFocus"
                      :disabled="disabled" ref="fileTextField"></v-text-field>
        <v-btn raised class="primary">点击上传</v-btn>
        <input type="file" :accept="accept" :multiple="false" :disabled="disabled"
               ref="fileInput" @change="onFileChange" style="display: none">
    </div>
</template>
<script>

    export default {
        name      : 'file-uploader',
        props     : {
            value   : {
                type: [Array, String]
            },
            accept  : {
                type   : String,
                default: "*"
            },
            label   : {
                type   : String,
                default: "Please choose..."
            },
            required: {
                type   : Boolean,
                default: false
            },
            disabled: {
                type   : Boolean,
                default: false
            },
            multiple: {
                type   : Boolean, // not yet possible because of data
                default: false
            }
        },
        data() {
            return {
                filename: ""
            };
        },
        watch: {
            value(v) {
                this.filename = v;
            }
        },
        mounted() {
            this.filename = this.value;
        },

        methods: {
            getFormData(files) {
                const data = new FormData();
                [...files].forEach(file => {
                    data.append('data', file, file.name); // currently only one file at a time
                });
                return data;
            },
            onFocus() {
                if (!this.disabled) {
                    debugger;
                    this.$refs.fileInput.click();
                }
            },
            onFileChange($event) {
                const files = $event.target.files || $event.dataTransfer.files;
                const form  = this.getFormData(files);
                if (files) {
                    if (files.length > 0) {
                        this.filename = [...files].map(file => file.name).join(', ');
                    } else {
                        this.filename = null;
                    }
                } else {
                    this.filename = $event.target.value.split('\\').pop();
                }
                this.$emit('input', this.filename);
                this.$emit('formData', form);
            }
        }
    };
</script>