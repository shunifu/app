<div class="card  ">
    <img class="card-img-top"
        src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,q_auto,w_970/b_rgb:000000,e_gradient_fade,y_-0.5/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_40_style_light_align_center:Report Management,w_0.3,y_0.18/v1612793225/shunifu/pexels-photo-4143800_vqecd5.jpg"
        alt="">
    <div class="card-body">
       
      
        Hi,  {{ Auth::user()->salutation }}  {{ Auth::user()->lastname }} this is the section where you will generate report cards for students. <hr>


       <span class=" text-muted lead" > Report Checklist</span><br>
       Before you print out reports, please ensure the following.
       <hr>
       <p>

        <div class="form-check ">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="ratio_check" id="ratio_check" value="ratio_checker"> Ratio's for each assessement are equal. If you are not sure, view ratio's <a href="/ratios/check">here</a>
            </label>
           </div>

           
       
       <div class="form-check ">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="teacher_check" id="teacher_check" value="teacher_checker"> All Teachers have entered marks for students. If you are not sure, check  <a href="/marks/check">here</a>
        </label>
       </div>


       <div class="form-check ">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="promotions" id="promotions" value="promotions_checker"> If this is the final term, you have done all neccessary promotions and repetions and processions for students.
            <a href="/analytics/term-based">For more click here</a>
        </label>
       </div>


       <div class="form-check ">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="attendance_checker" id="attendance_checker" value="attendance_checker"> Class Teachers have added term attendance data for students. 
        </label>
       </div>

       <div class="form-check ">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="template_checker" id="template_checker" value="template_checker"> Report Card Template has been created . To check templates click <a href="/report/templates">here</a>
        </label>
       </div>
    
       <div class="form-check ">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="variables_checker" id="variables_checker" value="variables_checker"> Report Card Variables have been properly configured. To verify variables click <a href="/report/variables">here</a>
        </label>
       </div>
      


    </div>

</div>
<div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
    <span class="sr-only">Loading...</span>
</div>