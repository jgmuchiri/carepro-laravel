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
                    <h4 class="media-box-heading">{{ formatDate(createMomentDate(photo_group.key)) }}</h4>
                    <div class="grid">
                        <div class="grid-sizer"></div>
                        <div class="grid-item" v-for="current_photo in photo_group.values">
                            <lightbox
                                    :thumbnail="current_photo.full_photo_uri"
                                    :images="movePhotoToFront(photosUriArray, current_photo.full_photo_uri_original)"
                            ></lightbox>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <DropzoneModal :url="'/api/children/' + this.child.id + '/photos'"
            @upload="imageUploaded"></DropzoneModal>
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
            }
        },
        methods: {
            movePhotoToFront: function (array, element) {
                return [].concat([element], array.filter(e => e !== element));
            },
            imageUploaded: function(response, file) {
                var todayKey = window.moment().format('YYYY-MM-DD');
                var todayArrayIndex = this.photos.findIndex(e => e.key == todayKey);
                if (todayArrayIndex >= 0) {
                    this.photos[todayArrayIndex].values = this.movePhotoToFront(
                        this.photos[todayArrayIndex].values,
                        response.data.photo
                    );
                    return;
                }

                this.photos = [].concat([{ key: todayKey, values: [response.data.photo]}], this.photos);
            }
        },
        props: ['child']
    }
</script>
