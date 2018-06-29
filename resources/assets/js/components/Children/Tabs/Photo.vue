<template>
    <div>
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-success waves-effect m-b-5"
                            data-toggle="modal"
                            data-target="#dropzone-modal"
                            data-backdrop="false">
                        <i class="fa fa-camera m-r-5 btn-fa"></i>
                        <span> {{ $t('Upload') }}</span>
                    </button>
                </div>
            </div>
            <h3 style="margin-top: 0px;">{{ $t('Photos') }}</h3>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <div v-for="(photo_group, index) in photos">
                    <h4 class="media-box-heading">{{ formatDate(createMomentDate(photo_group.key)) }}</h4>
                    <div id="app">
                      <img class="image" v-for="(image, i) in photo_group.values" :src="image.full_photo_uri" @click="photo_group.index = i">
                      <vue-gallery-slideshow :images="photoUrlArray(photo_group.values, photo_group.values.length)" :index="photo_group.index" @close="index = null"></vue-gallery-slideshow>
                    </div>
                </div>
                <div v-if="!photos.length" class="text-center">
                    <p>We couldn't find any Photos</p>
                    <div class="btn-group">
                        <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#dropzone-modal" data-backdrop="false">
                            <i class="fa fa-camera m-r-5 btn-fa"></i>
                            <span> {{ $t('Upload') }}</span>
                        </button>
                    </div>
                 </div>
            </div>
        </div>
        <!-- <DropzoneModal :url="'/api/children/' + this.child.id + '/photos'"
            @upload="imageUploaded"></DropzoneModal> -->
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
                            <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="vsuccess"></vue-dropzone>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import VueGallerySlideshow from 'vue-gallery-slideshow'
    export default {
        created() {
            this.getPhotos()
            this.createIndex()
        },

        computed: {
            photosUriArray: function () {
                return [].concat.apply([], this.photos.map(x => x.values.map(y => y.full_photo_uri_original)));
            }
        },
        data() {
            return {
                photos: [],
                dropzoneOptions: {
                  url: this.url,
                  thumbnailWidth: 150,
                  maxFilesize: 0.5,
                  headers: { "X-CSRF-TOKEN": window.Laravel.csrfToken }
              }
            }
        },
        methods: {
            getPhotos: function() {
                this.$http.get('/api/children/' + this.child.id + '/photos')
                .then(response => {
                    this.photos = response.data.photos;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
            },

            photoUrlArray: function(photos, length) {
                var images = []
                for (var i = 0; i < length; i++) {
                    images.push(photos[i].full_photo_uri_original);
                }
                return images
            },

            vsuccess(file, response) {
                this.getPhotos()
            },

            url: function() {
                return '/api/children/' + this.child.id + '/photos'
            }
        },
        components: {
            vueDropzone: vue2Dropzone,
            VueGallerySlideshow
        },
        props: ['child']
    }
</script>
