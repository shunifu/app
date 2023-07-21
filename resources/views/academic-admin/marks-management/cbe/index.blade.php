<x-app-layout>
    <x-slot name="header">
      <style>
        .profile-head {
        transform: translateY(5rem)
    }
    
    .cover {
        background-image: url(https://images.pexels.com/photos/5965705/pexels-photo-5965705.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
      background-size: cover;
        background-repeat: no-repeat
    }
    
    </style>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js" integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.min.css" integrity="sha512-jpey1PaBfFBeEAsKxmkM1Yh7fkH09t/XDVjAgYGrq1s2L9qPD/kKdXC/2I6t2Va8xdd9SanwPYHIAnyBRdPmig==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
 
@include('partials.marks-header')

   
    <div class="mb-4">
  
     
    </div>
    <div class="col-md-12 ">
        <div class="card card-light   elevation-3">
           
            <div class="card-body">
                <form action="{{ route('marks.show_cbe') }}" method="post" id="fr">

                            @csrf
                            <div class="form-row">
    
                                <div class="col-md-4 form-group">
                                    <x-jet-label>Select Class</x-jet-label><br>
                                    <select class="form-control" name="teaching_load" id="teaching_load" >
                                        <option value="">Select Teaching Load</option>
                                        @foreach($teaching_loads as $teaching_load_item)
                                            <option value="{{ $teaching_load_item->teaching_load_id }}">
                                                {{ $teaching_load_item->grade_name }} -
                                                {{ $teaching_load_item->subject_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teaching_load')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="col-md-4 form-group">
                                    <x-jet-label>Select Term</x-jet-label>
                                    <select class="form-control" name="term_id" id="term_id">
                                        <option value="">Select Term</option>
                                        @foreach($terms as $term)
                                            <option value="{{ $term->term_id }}">
                                                {{ $term->term_name }}
                                             
                                        @endforeach
                                    </select>
                                    @error('term_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <x-jet-label>Select Strand</x-jet-label>
                                    <select class="form-control" name="strand_id" id="strand_id">
                                        <option value="">Select Strand</option>
                                        
                                    </select>
                                    @error('strand_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                            </div>

                        <div class="card-footer col-auto">
                            <x-jet-button id="btnSelector">Show Students</x-jet-button>
                        </div>
                </form>
       

            </div>

        </div>
    </div>

    <div class="mb-4">

    </div>

    


<script>
    $(document).ready(function () {

    
  
    $("#teaching_load, #term_id").change(function (e) { 
        e.preventDefault();

 
        var data={
                     'term_id':$('select[name="term_id"] :selected').val(),
                    'teaching_load':$('select[name="teaching_load"] :selected').val(),
                   
                }

                $('#strand_id .strand_data').remove();


                console.log(data);

             $.ajax({
                type: "GET",
                url: "{{route('strands.fetch')}}",
                data: data,
                dataType: "json",
                success: function (data) {
                   
                    $.each(data.result, function (key, value) { 
                    $("#strand_id").append('<option class="strand_data" value='+value.id+'>'+value.strand+'</option>');
                
                  
});


                }
             });
        
    });

   


});




 
</script>

  
    

 


    
</x-app-layout>