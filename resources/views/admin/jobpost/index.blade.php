@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
@endpush
@section('content')
  <style>
    .move {
      cursor: move;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 55px;
      height: 27px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: green;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card mt-3 card-outline card-info">
              <div class="card-header">
                <h3 class="card-title"><span><i class="fa fa-bell"></i></span> Contacts</h3>
                <div class="float-right">
                  <a class="btn btn-success btn-sm float-right" href="{{ route('jobpost.create') }}"><i class="fa fa-plus"></i></a>
                  <a href="#" class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#emailModal">Add Email</a>
                </div>
              </div>
              <div class="card-body">
                <div class="">
                  <table class="table table-bordered table-striped w-100" id="example1">
                    <thead>
                      <tr>
                        <th>Sr.No</th>
                        <th>Post Title</th>
                        <th>Job Type</th>
                        <th>Post Date</th>
                        <th>City</th>
                        <th>Work Experience</th>
                        <th>Total Positions</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="sortJobPost" class="move">
                      @foreach ($jobs as $key => $item)
                        <tr>
                          <td>{{ ++$key }}<input type="hidden" class="order-id" value="{{ $item->id }}"></td>
                          <td>{{ $item->post_title }}</td>
                          <td>{{ $item->job_type }}</td>
                          <td>{{ $item->created_at }}</td>
                          <td>{{ $item->city }}</td>
                          <td>{{ $item->work_experience }}</td>
                          <td>{{ $item->total_positions }}</td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_check" @if ($item->active == 1) checked @endif
                                     data-user-id="{{ $item->id }}">
                              <span class="slider round"></span>
                            </label>
                          </td>
                          <td>
                            <button class="btn btn-success btn-sm viewFrontPages" data-value="{{ $item->id }}"><i class="fa fa-eye"></i></button>
                            <a class="btn btn-primary btn-sm" href="{{ route('jobpost.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-info btn-sm" href="{{ route('jobpost.detail', $item->id) }}" title="job applications"><i
                                 class="fa fa-calendar-week"></i></a>
                            <button class="btn btn-danger btn-sm btnDeleteJobPost" data-value="{{ $item->id }}"><i
                                 class="fa fa-trash"></i></button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- Add Email Modal -->
  <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="_exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Email</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="career-emails/edit" method="POST" id="emailForm">
          @csrf
          <div class="modal-body" id="emailContainer">
            @foreach ($data['email_contacts'] as $key => $contact)
              <div class="d-flex gap-5 mb-2 email-row" id="row_{{ $key }}">
                <input type="text" class="form-control" name="adminemail[]" value="{{ $contact->emails }}" placeholder="Enter Email">
                <button class="btn btn-danger btn-sm deleteRow" type="button" onclick="removeRow(this)"><i class="fa fa-minus"></i></button>
              </div>
            @endforeach
            <div class="d-flex gap-5 mb-2" id="addEmailButton">
              <button type="button" class="btn btn-success" onclick="addRow()"><i class="fa fa-plus"></i></button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Job Post Modal -->
<div class="modal fade" id="jobPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>




@endsection
@push('scripts')
  <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
  <script>
    let packageDeleteUrl = "{{ route('front-contact.destroy') }}";

    // Function to update serial numbers
    function updateSerialNumbers() {
      $('#example1 tbody tr').each(function(index) {
        $(this).find('td').first().text(index + 1); // Assuming the serial number is in the first column
      });
    }

    $(document).on('click', '.btnDeleteMenu', function() {
      id = $(this).attr('data-value');
      var row = $(this).closest('tr');
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this record",
        animation: false,
        customClass: 'animated pulse',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true,
        reverseButtons: true
      }).then(function(result) {
        if (result.value) {
          $.ajax({
            url: packageDeleteUrl + '/' + id,
            method: 'get',
            dataType: 'json',
            success: function(res) {
              if (res.unauthorized) {
                Swal.fire('Error!', 'No Rights To delete Contact', "error");
              }
              if (res.status) {
                row.remove();
                updateSerialNumbers();
                Swal.fire('Updated!', 'Contact deleted', 'success');
              }
            },
            error: function(jhxr, status, err) {
              console.log(jhxr);
            }
          })
        }
      })
    })

    function addRow() {
      let htmlRow =
        '<div class="d-flex gap-5 mb-2 email-row"><input type="text" class="form-control" name="adminemail[]" placeholder="Enter Email"><button class="btn btn-danger btn-sm deleteRow" type="button" onclick="removeRow(this)"><i class="fa fa-minus"></i></button></div>';
      $('#addEmailButton').before(htmlRow);
    }

    function removeRow(button) {
      $(button).closest('div.email-row').remove();
    }

    function validateEmail(email) {
      const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }

    function checkDuplicates(emails) {
      let emailSet = new Set();
      for (let email of emails) {
        if (emailSet.has(email)) {
          return true; // Duplicate found
        }
        emailSet.add(email);
      }
      return false; // No duplicates
    }

    $('#emailForm').on('submit', function(e) {
      let isValid = true;
      let invalidEmails = false;
      let emails = [];
      let hasEmptyField = false;

      $('input[name="adminemail[]"]').each(function() {
        let email = $(this).val().trim();
        if (email === '') {
          isValid = false;
          hasEmptyField = true;
          $(this).addClass('is-invalid');
        } else if (!validateEmail(email)) {
          isValid = false;
          invalidEmails = true;
          $(this).addClass('is-invalid');
        } else {
          $(this).removeClass('is-invalid');
          emails.push(email);
        }
      });

      if (isValid && checkDuplicates(emails)) {
        isValid = false;
        toastr.error('Duplicate email addresses found.');
      }

      if (!isValid) {
        e.preventDefault();
        if (hasEmptyField) {
          toastr.error('Please fill out all email fields.');
        } else if (invalidEmails) {
          toastr.error('Please enter valid email addresses.');
        }
      }
    });

    $(document).ready(function() {
      $('#example1').DataTable({
        "responsive": true,
      });
    });


    // Changing Status with event delegation
    let changeStatusUrl = "{{ route('jobpost.status') }}";
    $(document).on('change', '.status_check', function(e) {
      let currentStatus = "";
      if ($(this).prop('checked') == true) {
        currentStatus = 1;
        $(this).closest('tr').find('.status').text('active');
      } else {
        currentStatus = 0;
        $(this).closest('tr').find('.status').text('deactive');
      }
      var status = $(this);
      e.preventDefault();
      $.ajax({
        url: changeStatusUrl,
        type: "Post",
        data: {
          id: $(this).attr("data-user-id"),
          status: currentStatus
        },
        success: function(response) {
          if (response == "success") {
            Swal.fire({
              title: 'Status Changed!',
              text: "Job Post Status Has been Changed!",
              animation: false,
              customClass: 'animated pulse',
              type: 'success',
            });
          }
        }
      })
    });


    
    $(document).on('click', '.viewFrontPages', function() {
      $('#jobPostModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
      id = $(this).attr('data-value');
      $.ajax({
        method: 'get',
        url: '/admin/jobpost/' + id,
        dataType: 'html',
        success: function(res) {
            console.log(res);
          $('#jobPostModal').find('.modal-content').html(res);
        },
        error: function(jhxr, status, err) {
          console.log(jhxr);
        }
      })
    })


    $(document).on('click', '.btnDeleteJobPost', function() {
      if (!confirm("Are you sure you want to delete this record")) {
        return;
      }
      id = $(this).attr('data-value');
      $.ajax({
        method: 'delete',
        url: '/admin/jobpost/' + id,
        dataType: 'json',
        success: function(res) {
          if (res.status) {
            window.location.reload();
          }
        }
      })
    })




  </script>
@endpush
