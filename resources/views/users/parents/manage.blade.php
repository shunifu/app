<x-app-layout>
    <x-slot name="header">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
        </script>
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Manage Parents</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1673575215/Manage_Parents_ydbwmk.png"
                    alt="">

                <div class="card-body">
                    <h3 class="lead"> Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text">
                            <span class="text-bold">Use this section to manage parents</span><br>
                        </p>

                    </div>

                </div>
                <!-- /.card-header -->
            </div>
        </div>
        <div class="col-md-12">


            <div class="card text-left">

              <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Select Class</label>
                            <select class="form-control" name="" id="">
                              <option value="">Select Class</option>
                              <option value="">Form 1A</option>
                              <option></option>
                            </select>
                          </div>
                    </div>


                </div>

              </div>
            </div>


        </div>
    </div>

</x-app-layout>
