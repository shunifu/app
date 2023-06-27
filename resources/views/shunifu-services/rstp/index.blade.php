<x-app-layout>
    <x-slot name="header">
<style>
.video-background {
  position: relative;
  overflow: hidden;
  width: 100vw;
  height: 100vh;
}

.video-background iframe {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 100vw;
  height: 100vh;
  transform: translate(-50%, -50%);
}

@media (min-aspect-ratio: 16/9) {
  .video-background iframe {
    /* height = 100 * (9 / 16) = 56.25 */
    height: 56.25vw;
  }
}
@media (max-aspect-ratio: 16/9) {
  .video-background iframe {
    /* width = 100 / (9 / 16) = 177.777777 */
    width: 177.78vh;
  }
}
</style>
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1687883772/shunifu_header_8_drlx6r.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <span class="text-muted"> Use this section learn more about the Royal Science & Technology Park </span>

                <hr>
                <!-- form start -->
              
               

            </div>


        </div>

    

                <div class="embed-responsive embed-responsive-4by3">
                    <iframe  src="https://www.youtube.com/embed/AxDPhg3arqE?start=9" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                  </div>


    </div>
    </div>

</x-app-layout>
