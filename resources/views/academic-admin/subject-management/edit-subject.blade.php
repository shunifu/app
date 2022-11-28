<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
     
        <div class="card-header">

          {{-- <a href="/academic-admin/subject"> <i class="fas fa-backward fa-2x  "></i> back</a> --}}
        
          <h3 class="card-title">Edit Subject</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

      
            
        
        <form action="{{route('subject.update')}}" method="post">
          <div class="card-body">
            
                @csrf
                <input type="hidden" value="{{$subject->id}}" name="subject_id"/>
                <div class="form-group">
                <x-jet-label>Subject Name</x-jet-label>
                <x-jet-input name="subject_name" value="{{$subject->subject_name}}" ></x-jet-input>
                @error('subject_name')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                <x-jet-label>Subject Type</x-jet-label>
               <select class="form-control" name="subject_type">
                <option value="{{$subject->subject_type}}">{{$subject->subject_type}}</option>
                <option value="4">Passing Subject</option>
                <option value="1">Core Subject</option>
                <option value="2">Elective Subject</option>
                <option value="3">Non Contributing Subject</option>
               </select>
                @error('subject_type')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                  <x-jet-label>Select Section</x-jet-label>
                 <select class="form-control" name="subject_level">
                  <option value="{{$subject->section_level}}">{{$subject->section_level}}</option>
                  <option value="0">All Levels</option>
                  @foreach ($sections as $section)
                  <option value="{{$section->id}}">{{$section->section_name}}</option>
                  @endforeach
                 
                 </select>
                  @error('subject_level')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                  </div>

                  <div class="form-group">
                    <x-jet-label>ECESWA Code</x-jet-label>
                  <input type="text" class="form-control" value="{{$subject->subject_code}}" name="subject_code">
                    @error('subject_code')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>

         

               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Update Subject</x-jet-button>
          </div>
       
      </div>
    </form>
    
  </div>

 
      
    </div>   
            
     
    
</x-app-layout>