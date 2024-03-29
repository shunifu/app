<x-app-layout>
    <x-slot name="header">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Migration Management</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1709014711/zomds79zgkqxuefjdlvv.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">






        <span class=" text-muted text-bold lead" > Migration Guidelines</span><br>
        This section is where you will migrate students from one class to another.
        There are two methods to migrate students from the previous academic year to the next academic year.
        <ul>
            <li>Automatic Migration</li>
            <li>Custom Migration</li>
        </ul>
        The system offers two options for migrating students. The first one is automatic migration where the system migrates students based on their performance in the previous academic year and sequence maps. The second option is custom migration, where you have the freedom to choose the class to which the student(s) will be migrated irrespective of the sequence (stream or class) maps.
        <hr>

     <div class="card-group">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Automatic Migration</h4>
                <p class="card-text">Migrate students based on performance & sequence mapping</p>
                Click <a href="/migration/automatic">here</a> for automatic migration
            </div>
        </div>
        <div class="p-2"></div>
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Custom Migration</h4>
                <p class="card-text">Migrate students without sequence mapping</p>
                Click <a href="/migration/custom">here</a> for custom migration
            </div>
        </div>
     </div>


        </div>

                </div>


                <!-- /.card-header -->
                <!-- form start -->

            </div>


        </div>


    </div>



</x-app-layout>
