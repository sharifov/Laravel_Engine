@extends('layouts.admin')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">Edit Language <a class="add-btn" href="{{route('admin-lang-index')}}"><i class="fas fa-arrow-left"></i> Back</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">Dashboard </a>
                        </li>
                        <li>
                          <a href="{{ route('admin-lang-index') }}">Language Settings</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-lang-edit',$data->id) }}">Edit</a>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form id="geniusform" action="{{route('admin-lang-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('includes.admin.form-both')  

                         <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">Language *</h4>
                                <p class="sub-heading">(In Any Language)</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="language" placeholder="Language" required="" value="{{$data->language}}">
                          </div>
                        </div>


                        @foreach($lang as $k=>$l)
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="left-area">
                                  <h4 class="heading">{{$default_lang[$k]}} *</h4>
                                  <p class="sub-heading">(In Any Language)</p>
                              </div>
                            </div>
                            <div class="col-lg-7">
                              <input type="text" class="input-field" name="{{$k}}" placeholder="{{$default_lang[$k]}}" required="" value="{{$l}}">
                            </div>
                          </div>
                        @endforeach


                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">Save</button>
                          </div>
                        </div>
                      </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection