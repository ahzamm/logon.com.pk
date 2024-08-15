@extends('site.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
    <!-- page-title -->
<section class="page-title style-two" style="background-image: url({{ URL::asset('site/images/background/job_detail.png') }}) ">
   <div class="container">
       <div class="content-box clearfix">
           <div class="title-box pull-left">
               <h1>{{$job->post_title}}</h1>
                <p style="font-size:20px">{{$job->city}} | {{$job->job_type}}</p>
           </div>
           {{-- <ul class="bread-crumb pull-right">
               <li>FAQs</li>
               <li><a href="/">Home</a></li>
           </ul> --}}
       </div>
   </div>
</section>
<!-- page-title end -->

<section class="service-style-two">
    <div class="container">
        {{-- <div class="sec-title center"><h2>Job Details</h2></div> --}}
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <h3 class="job-info-head">Job Description</h3>
                    <div class="mt-4">
                        {!! $job->description !!}
                    </div>
                    <h3 class="mt-5 job-info-head">Job Application</h3>
                <form class="mt-5" action="" method="POST" id="jobApplicationForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Enter Full Name" aria-describedby="emailHelp">
                          </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="email" placeholder="Enter Email"  aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" aria-describedby="emailHelp">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Resume</label>
                          <input type="file" class="form-control-file" name="resume" placeholder="Choose Resume" accept=".pdf,.doc,.docx" >
                          <small id="fileHelp" class="form-text text-muted">Only .doc, .docx, .pdf</small>
                        </div>
                        <button type="submit" class="theme-btn-two" id="careerBtn">Send Request</button>
                    </form>
                    
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h3 class="job-info-head">Job Information</h3>
                    <div class="mt-4">
                        <p class="job-info-title">Work Experience</p>
                        <p>{{$job->work_experience}}</p>
                        <p class="job-info-title">City</p>
                        <p>{{$job->city}}</p>
                        <p class="job-info-title">Job Type</p>
                        <p>{{$job->job_type}}</p>
                        <p class="job-info-title">Shift</p>
                        <p>{{$job->shift}}</p>
                    </div>
                </div>
            </div>
    </div>
</section>

<!-- clients-style-four -->
@livewire('front.corporate-logo')
<!-- clients-style-four end -->
@endsection
@push('scripts')
    <script src="{{asset('sweet-alert/sweetalert2.min.js')}}"></script>
    <script>
        $(document).on('submit','#jobApplicationForm',function(e){
            e.preventDefault();
            $.ajax({
                url: "/career/application/{{$id}}",
                type: "POST",
                data:  new FormData(document.forms.namedItem("jobApplicationForm")),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend:function(){
                    $('#careerBtn').prop('disabled',true).html('<img src="{{asset('site/images/loader-darker.gif')}}" width="30" alt="contact-preloader">');
                },
                success:function(res){
                   if($.isEmptyObject(res.error)){
                      if(res.status)
                      {
                        document.getElementById("jobApplicationForm").reset();
                        swal('Message','Job Application Sent Successfully','success' );
                      }
                      else
                      {
                        swal('Message','Invalid Job Please try again','error' );
                      }
                   }
                   else
                   {
                       console.log(res.error)
                       errMessage = "";
                       for (let item of res.error) {
                           errMessage += "<li class='my-2 text-danger'>"+item+"</li>";
                       }
                       swal('Validation Failed', errMessage);
                      //printErrorMsg(res.error,'#reassignError');
                   }
                },
                error:function(jhxr,status,err)
                {
                   console.log(jhxr);
                },
                complete:function()
                {
                    $('#careerBtn').prop('disabled',false).text('Submit Form');
                }
             });
        });
    </script>
@endpush
