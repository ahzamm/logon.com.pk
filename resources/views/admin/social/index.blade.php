@extends('admin.layouts.app')
@push('style')
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

    .ui-sortable-helper {
      display: table;
      width: 100%;
      background: #fff;
      border: 1px solid #ddd;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .ui-sortable-placeholder {
      display: table;
      width: 100%;
      visibility: visible !important;
      background: #f0f0f0;
      border: 1px dashed #ddd;
      height: 40px;
    }
  </style>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0"><span><i class="fa-brands fa-twitter"></i></span> Social Links</h3>
                <div class="ml-auto">
                  <a href="{{ route('social.create') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> Add Social Media
                  </a>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-responsive ">
                  <table class="table table-bordered table-striped" id="example">
                    <thead>
                      <tr>
                        <th>Serial#</th>
                        <th>Social Media Icons</th>
                        <th>Social Media Names</th>
                        <th>Social Media Links</th>
                        <th>Icon Colors</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="sortfrontMenu" class="move">
                      @foreach ($socials as $key => $item)
                        <tr>
                            <td class="serial-number">{{ $key + 1 }}<input type="hidden" class="order-id" value="{{ $item->id }}"></td>
                          <input type="hidden" class="order-id" value="{{ $item->id }}">
                          </td>
                          <td><i class="{{ $item->icon }}"></i></td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->url }}</td>
                          <td>
                            <center><button class="rounded" disabled style="width: 50px; height:20px; background-color:{{ $item->color }};box-shadow:0 0 10px grey ; border:none"></button></center>
                          </td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_check" @if ($item->status == 1) checked @endif data-user-id="{{ $item->id }}">
                              <span class="slider round"></span>
                            </label>
                          </td>
                          <td class="d-flex justify-content-center" style="gap: 5px;">
                            <a class="btn btn-primary btn-sm" href="{{ route('social.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btnDeleteSocial text-white" data-value="{{ $item->id }}"><i class="fa fa-trash"></i></a>
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
@endsection
@push('scripts')
  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();

      // Changing Status with event delegation
      let changeStatusUrl = "{{ route('social.status') }}";
      $(document).on('change', '.status_check', function(e) {
        let currentStatus = $(this).prop('checked') ? 1 : 0;
        var status = $(this);
        e.preventDefault();
        $.ajax({
          url: changeStatusUrl,
          type: "POST",
          data: {
            id: $(this).attr("data-user-id"),
            status: currentStatus
          },
          success: function(response) {
            if (response == "unauthorized") {
              Swal.fire("Error!", "Status Not Changed , Because You have No Rights To change status", "error");
              status.prop('checked', false);
            } else if (response == "success") {
              Swal.fire({
                title: 'Status Changed!',
                text: "User Status Has been Changed!",
                animation: false,
                customClass: 'animated pulse',
                type: 'success',
              });
            }
          }
        });
      });

      // Delete Social Link with event delegation
      let deleteUrl = "{{ route('social.destroy', ':id') }}";

      // Function to update serial numbers
   function updateSerialNumbers() {
      $('#example tbody tr').each(function(index) {
        $(this).find('td').first().text(index + 1); // Assuming the serial number is in the first column
      });
    }

      $(document).on('click', '.btnDeleteMenu', function() {
        let menuId = $(this).attr('data-value');
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
              url: deleteUrl.replace(':id', menuId),
              method: 'get',
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(res) {
                if (res.status == true) {
                row.remove();
                updateSerialNumbers();
                  Swal.fire('Updated!', 'Social Link Has been deleted', 'success');
                } else if (res.status == "no Access") {
                  Swal.fire('Error!', 'You have no access to delete social links', 'error');
                }
              },
              error: function(jhxr, status, err) {
                console.log(jhxr);
              }
            })
          }
        });
      });

      $(document).on('click','.btnDeleteSocial',function(){
        if(!confirm("Are you sure you want to delete this record"))
        {
            return;
        }
        id = $(this).attr('data-value');
        $.ajax({
            method:'delete',
            url:'/admin/social/'+id,
            dataType: 'json',
            success:function(res){
                if(res.status)
                {
                    window.location.reload();
                }
            }
        })
  })

      // Sorting Data
      let sortTable = $("#sortfrontMenu");
      let sortingFrontUrl = "{{ route('social.sort') }}";
      let csrfToken = $(".csrf_token");
      var editUrlFront = "{{ route('social.edit', ':id') }}";

      $(sortTable).sortable({
        update: function(event, ui) {
          var SortIds = $(this).find('.order-id').map(function() {
            return $(this).val().trim();
          }).get();

          $.ajax({
            url: sortingFrontUrl,
            type: "POST",
            data: {
              sort_Ids: SortIds
            },
            headers: {
              "X-CSRF-TOKEN": csrfToken.val()
            },
            success: function(response) {
              let table = "";
              $(response).each(function(index, value) {
                table += `<tr>
                  <td>${index + 1}<input type="hidden" class="order-id" value="${value.id}"></td>
                  <td><i class="${value.icon}"></i></td>
                  <td>${value.name}</td>
                  <td>${value.url}</td>
                  <td><center><button class="rounded" disabled style="width: 50px; height:20px; background-color:${value.color};box-shadow:0 0 10px grey ; border:none"></button></center></td>
                  <td>
                    <label class="switch">
                      <input type="checkbox" class="status_check" ${value.status == 1 ? 'checked' : ''} data-user-id="${value.id}">
                      <span class="slider round"></span>
                    </label>
                  </td>
                  <td class="d-flex justify-content-center" style="gap: 5px;">
                                <a class="btn btn-primary btn-sm"  href="${editUrlFront.replace(':id', value.id)}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm deleteRecord" data-value="${value.id}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>`;
              });
              $(sortTable).html(table);

              // Re-initialize status check event delegation after sorting
              $(document).on('change', '.status_check', function(e) {
                let currentStatus = $(this).prop('checked') ? 1 : 0;
                var status = $(this);
                e.preventDefault();
                $.ajax({
                  url: changeStatusUrl,
                  type: "POST",
                  data: {
                    id: $(this).attr("data-user-id"),
                    status: currentStatus
                  },
                  success: function(response) {
                    if (response == "unauthorized") {
                      Swal.fire("Error!", "Status Not Changed , Because You have No Rights To change status", "error");
                      status.prop('checked', false);
                    } else if (response == "success") {
                      Swal.fire({
                        title: 'Status Changed!',
                        text: "User Status Has been Changed!",
                        animation: false,
                        customClass: 'animated pulse',
                        type: 'success',
                      });
                    }
                  }
                });
              });
            }
          });
        },
        helper: function(e, ui) {
          ui.children().each(function() {
            $(this).width($(this).width());
          });
          return ui;
        },
        placeholder: "ui-sortable-placeholder"
      });
    });
  </script>
@endpush
