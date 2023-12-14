<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                  
                </div>

               
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> Use this select the class of the students whose parents you want to restrict due to non-payment  
                            

                        </p>

                    </div>

                </div>



                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('restriction.loadstudents') }}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <x-jet-label> Class Name</x-jet-label>
                                <select class="form-control" name="grade_id">
                                    <option value="">Select Class</option>
                                    @foreach($grades as $class)
                                        <option value="{{ $class->id }}">{{ $class->grade_name }}</option>

                                    @endforeach
                                </select>
                                @error('class')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

        
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button>Load Students</x-jet-button>
                    </div>
                </form>
            </div>


        </div>


    </div>

</x-app-layout>
