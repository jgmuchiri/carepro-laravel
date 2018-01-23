<template>
    <div>
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-success waves-effect m-b-5"
                            data-toggle="modal"
                            data-target=""
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
                <div class="media-box-body">
                    <h4 class="media-box-heading">10 October 2017</h4>
                    <div class="grid">
                        <div class="grid-sizer"></div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/submerged.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/look-out.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/cat-nose.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/contrail.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/golden-hour.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" />
                        </div>
                    </div>
                </div>
                <div class="media-box-body">
                    <h4 class="media-box-heading">9 October 2017 | Incedent</h4>
                    <div class="grid">
                        <div class="grid-sizer"></div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/submerged.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/look-out.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/cat-nose.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/contrail.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/golden-hour.jpg" />
                        </div>
                        <div class="grid-item">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted()
        {
            var $container = $('.grid');
            $container.imagesLoaded( function () {
                $container.masonry();
            });

            $('#photo-a').click(function (e) {
                $container.imagesLoaded( function () {
                    $container.masonry();
                });
            });
        }
    }
</script>
