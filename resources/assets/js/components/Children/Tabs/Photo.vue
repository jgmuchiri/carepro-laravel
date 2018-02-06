<template>
    <div>
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-success waves-effect m-b-5"
                            data-toggle="modal"
                            data-target="#dropzone-modal"
                            data-backdrop="false"
                    >
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
                <div class="media-box-body" v-for="photo_group in photos">
                    <h4 class="media-box-heading">{{ photo_group.key }}</h4>
                    <div class="grid">
                        <div class="grid-sizer"></div>
                        <div class="grid-item" v-for="current_photo in photo_group.values">
                            <lightbox
                                    :thumbnail="current_photo.full_photo_uri"
                                    :images="movePhotoToFront(photosUriArray, current_photo.full_photo_uri_original)"
                                    @load="imageLoaded"
                            ></lightbox>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <DropzoneModal :url="'/api/children/' + this.child.id + '/photos'"></DropzoneModal>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/children/' + this.child.id + '/photos')
                .then(response => {
                    this.photos = response.data.photos;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        computed: {
            photosUriArray: function () {
                return [].concat.apply([], this.photos.map(x => x.values.map(y => y.full_photo_uri_original)));
            }
        },
        data()
        {
            return {
                photos: [],
                imagesLoadedCount: 0
            }
        },
        methods: {
            imageLoaded: function() {
                this.imagesLoadedCount++;
                if (this.imagesLoadedCount == this.photos.length) {

                }
            },
            movePhotoToFront: function (array, element) {
                return [].concat([element], array.filter(e => e !== element));
            }
        },
        props: ['child']
    }
</script>
