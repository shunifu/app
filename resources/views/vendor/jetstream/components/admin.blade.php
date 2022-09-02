<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>
  
                  <p>Teachers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
  
                  <p>Students</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>
  
                  <p>Parents</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>
  
                  <p>Classes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
<div class="mt-10 mb-25">
<hr>

</div>
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable ui-sortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                    <i class="fas fa-envelope-open-text mr-1"></i>
                    Notice Board
                  </h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">New</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab">History</a>
                      </li>
                    </ul>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand">
                        </div><div class="chartjs-size-monitor-shrink"></div></div>
                        <canvas id="revenue-chart-canvas" height="900" style="height: 300px; display: block; width: 343px;" width="1029" class="chartjs-render-monitor"></canvas>                         
                     </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                      <canvas id="sales-chart-canvas" height="0" style="height: 0px; display: block; width: 0px;" width="0" class="chartjs-render-monitor"></canvas>                         
                    </div>  
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              
  
             
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable ui-sortable">
  
            
              <!-- Calendar -->
              <div class="card bg-gradient-white">
                <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
  
                  <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                  </h3>
                  <!-- tools card -->
                  <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-bars"></i></button>
                      <div class="dropdown-menu float-right" role="menu">
                        <a href="#" class="dropdown-item">Add new event</a>
                        <a href="#" class="dropdown-item">Clear events</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">View calendar</a>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">January 2021</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="12/27/2020" class="day old weekend">27</td><td data-action="selectDay" data-day="12/28/2020" class="day old">28</td><td data-action="selectDay" data-day="12/29/2020" class="day old">29</td><td data-action="selectDay" data-day="12/30/2020" class="day old">30</td><td data-action="selectDay" data-day="12/31/2020" class="day old">31</td><td data-action="selectDay" data-day="01/01/2021" class="day">1</td><td data-action="selectDay" data-day="01/02/2021" class="day active today weekend">2</td></tr><tr><td data-action="selectDay" data-day="01/03/2021" class="day weekend">3</td><td data-action="selectDay" data-day="01/04/2021" class="day">4</td><td data-action="selectDay" data-day="01/05/2021" class="day">5</td><td data-action="selectDay" data-day="01/06/2021" class="day">6</td><td data-action="selectDay" data-day="01/07/2021" class="day">7</td><td data-action="selectDay" data-day="01/08/2021" class="day">8</td><td data-action="selectDay" data-day="01/09/2021" class="day weekend">9</td></tr><tr><td data-action="selectDay" data-day="01/10/2021" class="day weekend">10</td><td data-action="selectDay" data-day="01/11/2021" class="day">11</td><td data-action="selectDay" data-day="01/12/2021" class="day">12</td><td data-action="selectDay" data-day="01/13/2021" class="day">13</td><td data-action="selectDay" data-day="01/14/2021" class="day">14</td><td data-action="selectDay" data-day="01/15/2021" class="day">15</td><td data-action="selectDay" data-day="01/16/2021" class="day weekend">16</td></tr><tr><td data-action="selectDay" data-day="01/17/2021" class="day weekend">17</td><td data-action="selectDay" data-day="01/18/2021" class="day">18</td><td data-action="selectDay" data-day="01/19/2021" class="day">19</td><td data-action="selectDay" data-day="01/20/2021" class="day">20</td><td data-action="selectDay" data-day="01/21/2021" class="day">21</td><td data-action="selectDay" data-day="01/22/2021" class="day">22</td><td data-action="selectDay" data-day="01/23/2021" class="day weekend">23</td></tr><tr><td data-action="selectDay" data-day="01/24/2021" class="day weekend">24</td><td data-action="selectDay" data-day="01/25/2021" class="day">25</td><td data-action="selectDay" data-day="01/26/2021" class="day">26</td><td data-action="selectDay" data-day="01/27/2021" class="day">27</td><td data-action="selectDay" data-day="01/28/2021" class="day">28</td><td data-action="selectDay" data-day="01/29/2021" class="day">29</td><td data-action="selectDay" data-day="01/30/2021" class="day weekend">30</td></tr><tr><td data-action="selectDay" data-day="01/31/2021" class="day weekend">31</td><td data-action="selectDay" data-day="02/01/2021" class="day new">1</td><td data-action="selectDay" data-day="02/02/2021" class="day new">2</td><td data-action="selectDay" data-day="02/03/2021" class="day new">3</td><td data-action="selectDay" data-day="02/04/2021" class="day new">4</td><td data-action="selectDay" data-day="02/05/2021" class="day new">5</td><td data-action="selectDay" data-day="02/06/2021" class="day new weekend">6</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2021</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month active">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year active">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade active" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
         
    </div>
</div>
