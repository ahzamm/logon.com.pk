<div class="modal-header">
  <h5 class="modal-title" id="jobPostModal">Job Details</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <dl class="mt-2 row">
    <div class="col-md-6">
      <dt>Post Title</dt>
      <dd>{{ $job->post_title }}</dd>
    </div>
    <div class="col-md-6">
      <dt>Job Type</dt>
      <dd>{{ $job->job_type }}</dd>
    </div>

    <div class="col-md-6">
      <dt>Post Date</dt>
      <dd>{{ $job->created_at }}</dd>
    </div>
    <div class="col-md-6">
      <dt>City</dt>
      <dd>{{ $job->city }}</dd>
    </div>
    <div class="col-md-6">
      <dt>Work Experience</dt>
      <dd>{{ $job->work_experience }}</dd>
    </div>
    <div class="col-md-6">
      <dt>Total Positions</dt>
      <dd>{{ $job->total_positions }}</dd>
    </div>
    <div class="col-md-6">
      <dt>Status</dt>
      <dd>{{ $job->active }}</dd>
    </div>

  </dl>
  <h3 class="text-center ">Job Description</h3>
  <div>
    {!! $job->description !!}
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
