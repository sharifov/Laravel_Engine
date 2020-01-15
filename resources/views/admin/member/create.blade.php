@extends('layouts.load')

@section('content')

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-error')  
                      <form id="geniusformdata" action="{{route('admin-member-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">Title *</h4>
                                <p class="sub-heading">(In Any Language)</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="title" placeholder="Title" required="" value="">
                          </div>
                        </div>
<div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">Sub Title *</h4>
                                <p class="sub-heading">(In Any Language)</p>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <input type="text" class="input-field" name="subtitle" placeholder="Sub Title" required="" value="{{$data->subtitle}}">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">Company Name *</h4>
                                <p class="sub-heading">(In Any Language)</p>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <input type="text" class="input-field" name="company_name" placeholder="Company Name" required="" value="{{$data->company_name}}">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">Company Image *</h4>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <div class="img-upload">
                                <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/member/'.$data->photo):asset('assets/images/noimage.png') }});">
                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>Upload Image</label>
                                    <input type="file" name="photo" class="img-upload" id="image-upload">
                                  </div>
                                  <p class="text">Prefered Size: (600x600) or Square Sized Image</p>
                            </div>

                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">CEO Image *</h4>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <div class="img-upload">
                                <div id="image-preview" class="img-preview" style="background: url({{ $data->ceo ? asset('assets/images/member/'.$data->ceo):asset('assets/images/noimage.png') }});">
                                    <label for="image-upload" class="img-label" id="image-label-1"><i class="icofont-upload-alt"></i>Upload Image</label>
                                    <input type="file" name="ceo" class="img-upload" id="image-label-1">
                                  </div>
                                  <p class="text">Prefered Size: (600x600) or Square Sized Image</p>
                            </div>

                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">Facebook URL *</h4>
                                <p class="sub-heading">(In Any Language)</p>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <input type="text" class="input-field" name="facebook" placeholder="Facebook URL" value="{{$data->facebook}}">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">Twitter URL *</h4>
                                <p class="sub-heading">(In Any Language)</p>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <input type="text" class="input-field" name="twitter" placeholder="Twitter URL" value="{{$data->twitter}}">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">Linkdedin URL *</h4>
                                <p class="sub-heading">(In Any Language)</p>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <input type="text" class="input-field" name="linkedin" placeholder="Linkdedin URL" value="{{$data->linkedin}}">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                              <h4 class="heading">
                                   Details *
                              </h4>
                            </div>
                          </div>
                          <div class="col-lg-10">
                              <textarea class="nic-edit" name="details" placeholder="Details">{{ $data->details }}</textarea> 
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">Create Member</button>
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
