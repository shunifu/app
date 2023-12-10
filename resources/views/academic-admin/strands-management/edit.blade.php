<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                  
                </div>

                <img class="card-img-top"
                src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1689527001/ircmjalujakjo1i1bjy4.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Sivusele, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <a href="/academic-admin/strands-bank" >Go back</a>
                        <p class="card-text"> Use this section to view the edit the following strand

                        </p>

                    </div>

                </div>


                <div class="card-body">
                    <form action="{{ route('strands.update') }}" method="post">

                    @csrf
                   <div class="form-group">
                     <label for="">Strand</label>
                     <textarea class="form-control" name="strand" id="strand" rows="3">{{$strand->strand}}</textarea>
                   </div>
                   @error('strand')
                   <span class="text-danger">{{ $message }}</span>
               @enderror


               <input type="hidden" name="strand_id" value="{{$strand->id}}">
                <x-jet-button>Update Strands</x-jet-button>
        
                   
                </form>               
                        </div>

           
              
            </div>


        </div>


    </div>

 

</x-app-layout>
