<template>
    <div class="modal fade" id="dropzone-modal" tabindex="-1" role="dialog" aria-labelledby="dropzone-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="dropzone-modal">{{ $t('Upload Photos') }}</h4>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <dropzone @state-change="onStateChanged" @upload="onUpload" @error="onError" :url="url" ref="dropzone">
                            <div class="text-center" style="border: 1px solid #e2e2e2;">
                                <div class="child-btn-fa">
                                    <a href="" id="upload_link" title=""><i class="fa fa-upload"></i></a>
                                </div>
                                <p><span>{{ $t('Upload Profile Photo') }}</span></p>
                                <div class="col-md-3 text-center" v-for="file in files">
                                    <img :src="file.data.photo.full_photo_uri" />
                                </div>
                            </div>
                        </dropzone>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Dropzone} from '@lassehaslev/vue-dropzone';
    export default {
        data() {
            return {
                color: '#FF0000',
                files: [],
            }
        },

        methods: {
            onStateChanged(enter) {
                this.color = enter ? '#0000FF' : '#FF0000';
            },
            onUpload(response, file) {
                this.files.push(response);
                this.$emit('upload', response, file)
            },
            onError(response) {
                console.log('Error');
                console.log(response);
            },
        },
        components: {
            Dropzone,
        },

        props: ['url']
    }
</script>
