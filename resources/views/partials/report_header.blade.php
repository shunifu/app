<div class="card  ">
    <img class="card-img-top"
        src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,q_auto,w_970/b_rgb:000000,e_gradient_fade,y_-0.5/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_40_style_light_align_center:Report Management,w_0.3,y_0.18/v1612793225/shunifu/pexels-photo-4143800_vqecd5.jpg"
        alt="">
    <div class="card-body">
       
      
        Hi,  {{ Auth::user()->salutation }}  {{ Auth::user()->lastname }} this is the section where you will generate report cards for students in a stream. <hr>


       <span class=" text-muted lead" > Please ensure that you have followed the 3 step verification process.</span>
       <p>

        <div class="form-check ">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="ratio_check" id="ratio_check" value="checkedValue"> Ratio's for each assessement are equal. If you are not sure, view ratio's <a href="/ratios/check">here</a>
            </label>
           </div>
           
       
       <div class="form-check ">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="teacher_check" id="teacher_check" value="checkedValue"> All Teachers have entered marks for students. If you are not sure, check  <a href="/marks/check">here</a>
        </label>
       </div>

    
       <div class="form-check ">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="report_variables" id="report_variables" value="checkedValue"> Report Card Variables have been properly configured. To verify variables click <a href="/report/variables">here</a>
        </label>
       </div>
      


    </div>

</div>
<div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
    <span class="sr-only">Loading...</span>
</div>