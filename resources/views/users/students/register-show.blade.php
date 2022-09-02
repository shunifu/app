<x-guest-layout class=" col-md-6 mx-auto elevation-2 rounded-2 mt-4 ">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        @if (session('status'))
            <div class="alert alert-success mt-4 rounded-0" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mb-3 rounded-0" role="alert">
                {{ session('error') }}
            </div>
        @endif
  
  
      
     

            <div class="card-body login-card-body">
                <div class="login-logo mt-4">
                    @foreach (\App\Models\School::all('school_logo') as $item)
                    <img src={{asset('storage/'.$item->school_logo) }} width="50" class=" brand-image  img-square"  />
                    @endforeach
              
                </div>
                <p class="login-box-msg small">Student Digital Registration</p> 

                   <div class="mb-3" id="data_students">

                    <table class="table table-small table-hover mx-auto">
                        <thead class="thead-light ">
                    <tr>
                    <th>Name</th>
                    <th>Email Address</th> 
                    <th>Manage</th> 
                    </tr>
                    </thead>
                    <tbody>

            
                      
                @foreach ($get_students as $student)
                <tr>
                @if(empty($get_students))
                @php
                    echo "No Data";
                @endphp
               @else
                <form action="{{ route('student_registration.store') }}" method="POST">
                    @csrf
                <td class="vertical-middle">{{$student->lastname}} {{$student->name}} {{$student->middlename}} </td>  
                <td class="align-middle">
                <input type="email"  id="email" class="form-control" placeholder="Enter your email"  name="email">
                <input type="hidden" name="student_id" value="{{$student->student_id}}">
                </td>
                <td class="align-middle">
                    <x-jet-button>Add Email</x-jet-button>
                    </td>
                </form>
                @endif
                </tr>
                @endforeach
                
                     
                </tbody>
            </table>
            <a href="/student/register">Back to Form</a>
                 

                   </div>

            </div>
    

</x-guest-layout>