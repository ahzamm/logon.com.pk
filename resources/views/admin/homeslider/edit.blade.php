@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Edit Home Slide
              </h3>
              <div class="ml-auto">
                <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('homeslider.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('homeslider.update', $homeslider->id) }}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                @method('PUT')
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Slide Title</label>
                      <input type="text" class="form-control" name="title" value="{{ $homeslider->title }}">
                      @error('title')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Slide Slogan</label>
                      <input type="text" class="form-control" name="slogan" value="{{ $homeslider->slogan }}">
                      @error('slogan')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image Alt</label>
                      <input type="text" class="form-control" name="image_alt" value="{{ $homeslider->image_alt }}">
                      @error('image_alt')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  @php
                    $fileExtension = pathinfo($homeslider->image, PATHINFO_EXTENSION);
                  @endphp
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Banner Image (size w/h: 1903x720)</label><br>
                      @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('homeslider/' . $homeslider->image) }}" height="60" width="120" alt="{{ $homeslider->image_alt }}" />
                      @elseif ($fileExtension == 'mp4')
                        <video controls width="200" height="120" controls>
                          <source src="{{ asset('homeslider/videos/' . $homeslider->image) }}" type="video/mp4">
                          Your browser does not support the video tag.
                        </video>
                      @else
                        <p>Unsupported media type</p>
                      @endif <br><br>
                      <input type="file" class="form-control-file" name="banner_image">
                      @error('banner_image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  {{-- <div class="col-md-6">
                            <div class="form-group clearfix">
                              <label for="" style="visibility: hidden">A</label>
                                <div class="icheck-success d-block">
                                  <input type="checkbox"  {{$homeslider->active == 1? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
                                  <label for="checkboxSuccess1">
                                      Status
                                  </label>
                                </div>
                              </div>
                        </div> --}}
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>

  </div>
@endsection
@push('scripts')
@endpush
