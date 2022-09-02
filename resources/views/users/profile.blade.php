<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
           
        </h2>
    </x-slot>
    <div class="col-md-4">
        <div class="card card-default card-outline">
        <div class="card-body box-profile">
        <div class="text-center">
        <?php
        echo '<img src="/storage/app/public/profile-photos/BrVZOYQqPpIN8HNDj1t9D01D5eZluYkiDb4dA8Bf.jpg" class="profile-user-img img-fluid img-circle" alt="Student Picture"  />'?>
        </div>
        <h3 class="profile-username text-center">jdf</h3>
        <p class="text-muted text-center">kjds</p>
        <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
        
        <b>School Fees</b> <a class="float-right">sdjd</a>
        </li>
        
        <li class="list-group-item">
        <b>Paid</b> <a class="float-right">df</a>
        </li>
        <li class="list-group-item">
        <b>Outstanding Balance</b> <a class="float-right">df</a>
        </li>
        </ul>
        <div class="row">
        <div class="col">
        <a href="#"><button class="btn form-control btn-default "><i class="fa fa-file-text"></i> View Statement</button></a>
        </div>
        <div class="col">
        <form id="sendSMS">
           
        <button  class="btn form-control btn-default " onclick="sendSMS();"><i class="fa fa-file-text"></i> Send SMS</button>
        </form>
        </div>
        <div class="col">
        <a href="#"><button class="btn form-control btn-default "><i class="fa fa-file-text"></i> Send Push</button></a>
        </div>
        
        </div>
        </div>
        <!-- /.card-body -->
        </div>
        </div>
   
</x-app-layout>