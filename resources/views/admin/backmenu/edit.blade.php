@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
@section('title','Edit Menu')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                  <h5 class="card-title">Menus...</h5>
                  <div class="ml-auto">
                    <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('menus.index') }}">
                      <i class="fa fa-arrow-left"></i> Back
                    </a>
                  </div>
              <div class="row mt-5 justify-content-center">
                <div class="col-md-8 col-sm-12 col-xs-12">
                  <div class="card" style="border-color: rgb(126, 120, 120);">
                    <div class="card-header">
                      <h5 class="card-title">Modify Menu and SubMenu.</h5>
                    </div>
                    <div class="card-body">              
                    <form action="{{route('menus.update',$menus->id)}}" method="POST" id="AddMenusForm">
                        @csrf
                        <div class="row">
                          <div class="col-lg-12 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label>Parent Menu Name</label>
                              <input name="parentMenu" type="text" class="form-control" value="{{$menus->menu}}" required>
                              </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Select Icon </label>
                              <select name="menuicon" class="form-control" id="selectIcon">
                                <option value></option>
                                @foreach ($icons as $item)
                                      <option value="{{$item}}" {{$item == $menus->icon? 'selected' : ''}}>{{$item}}</option>
                                  @endforeach
                                </select>
                              @error('icon')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                          <div class="col-md-12">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Sub Menu Name</th>
                                          <th>Sub Menu Route</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody id="submenu-list">
                                      @foreach ($menus->submenus as $key => $item)
                                      <tr>
                                        <td class="d-none">
                                        <input type="hidden" name="submenuId[]" value="{{$item->id}}"/>
                                        </td>
                                          <td class="td-first">
                                          <input type="" name="submenu[]" value="{{$item->submenu}}" placeholder="Sub Menu Name" class="form-control" required/>
                                          </td>
                                          <td class="td-second">
                                              <input type="" name="submenuroute[]" value="{{$item->route_name}}" placeholder="Sub Menu Route" class="form-control" required/>
                                              <span class="text-danger text-sm d-none">Route name not exist in database</span>
                                          </td>
                                          <td>
                                              @if(($key+1) == $menus->submenus->count())
                                              <button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button>
                                              @else
                                              <button class="btn btn-danger btn-sm my-1" type="button" id="btnDeleteSubMenu"><i class="fa fa-trash"></i></button>
                                              @endif
                                              
                                          </td>
                                      </tr>   
                                      @endforeach
                                  </tbody>
                                 
                                  
                              </table>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <a class="btn btn-outline-secondary btn-sm float-right ml-2" href="{{route('menus.index')}}">Cancel</a>
                                  <button class="btn btn-outline-primary btn-sm float-right" type="submit" id="menuBtn">Update Menu</button>
                              </div>
                          </div>    
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
    </section>
</div>
    
<script type="text/html" id="data-row">
<tr>
    <td class="d-none">
        <input type="hidden" name="submenuId[]" value="0"/>
    </td>
    <td class="td-first">
        <input type="" name="submenu[]" placeholder="Sub Menu Name" class="form-control" required/>
    </td>
    <td class="td-second">
        <input type="" name="submenuroute[]" placeholder="Sub Menu Route" class="form-control" required/>
        <span class="text-danger text-sm d-none">Route name not exist in database</span>
    </td>
    <td><button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button></td>
</tr>

</script>
@endsection
@push('scripts')
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('sweet-alert/sweetalert2.min.js')}}"></script>
<script>
function formatState(state) {
          if (!state.id) {
            return state.text;
          }
        var $state = $(
          "<i class='"+state.element.value+"''></i> <span style='color:black;margin-left:10px'>"+state.element.value+"</span>"
            );
            return $state;
        }
    $(function(){
        $('.selectList').select2({
            theme: 'bootstrap4'
        })
        $('#selectIcon').select2({
          theme: 'bootstrap4',
          templateResult: formatState,
          templateSelection: formatState
        });
        $('.select2.select2-container').css('width','auto');
    })
function checkinput(input)
{
    if(input.val() == "")
    {
        $(input).css('border','1px solid red');
        return false;
    }
    else
    {
        $(input).css('border','1px solid #444951');
        return true;
    }
}

$(document).on('click','#btnAddSubMenu',function(){
    fristInput = $(this).parents('tr').find('td.td-first > input');
    secondInput = $(this).parents('tr').find('td.td-second > input');
    button = $(this);
    if(checkinput(fristInput) && checkinput(secondInput))
    {
        
            $.ajax({
                url:'{{route("menus.checkroute")}}',
                method:'post',
                data:{
                    routename: secondInput.val()
                },
                dataType:'json',
                success:function(res){
                    if(res.status)
                    {
                        $(secondInput).siblings('span').addClass('d-none');
                        fristInput.prop('readonly',true);
                        secondInput.prop('readonly',true);
                        let dataRow = $('#data-row').html();
                        $('#submenu-list').append(dataRow);
                        $(button).removeClass("btn-success").addClass("btn-danger").html("<i class='fa fa-trash'></i>").attr('id','btnDeleteSubMenu');
                    }
                    else
                    {
                        $(secondInput).siblings('span').removeClass('d-none');
                    }
                    
                },
                error:function(jhxr,status,err){
                    //console.log(jhxr);
                }
            }) 
    }
    
})
$(document).on('click','#btnDeleteSubMenu',function(){
  subMenuId = $(this).parents('tr').find('td.d-none input').val();
  row = $(this);
  swal({
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
        }).then( function(result) {
            if (result.value) {
              if(subMenuId ==0)
              {
                $(row).parents('tr').remove();
              }else{
                $.ajax({
                url:'{{ route("submenus.delete") }}',
                method:'post',
                data:{
                  subMenuId: subMenuId
                },
                dataType:'json',
                success:function(res){
                    if(res.status)
                    {
                        $(row).parents('tr').remove();
                        // console.log("delete record");
                    }
                    else
                    {
                        //$(secondInput).siblings('span').removeClass('d-none');
                    }
                    
                },
                error:function(jhxr,status,err){
                    console.log(jhxr);
                }
              })
              }
              
            } else if (result.dismiss === 'cancel') {
               //  swal(
               //      'Cancelled',
               //      'Your imaginary data is safe :)',
               //      'error'
               //  )
            }
        })
    
    // $(this).parents('tr').remove();
})
// $(document).on('submit','#AddMenusForm',function(e){
//     // e.preventDefault();
//     // $('#AddMenusForm input').each(function(index,val){
//     //     //alert($(val).val());
//     // })
//     // $(this).submit;
// })
</script>
@endpush