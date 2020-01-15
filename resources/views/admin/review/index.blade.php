@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="REVIEW">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">Reviews</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">Dashboard </a>
											</li>
											<li>
												<a href="javascript:;">Home Page Settings </a>
											</li>
											<li>
												<a href="{{ route('admin-review-index') }}">Reviews</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">

              <div class="row">
                <div class="col-lg-12 px-5 pt-5">
                  <div class="card mb-5">
                    <div class="card-header infos">
                      <h4 class="text-white text-uppercase mb-0">Informations</h4>
                    </div>
                    <div class="card-body">
                      <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->admin_loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      @include('includes.admin.form-both')
                      <form id="geniusform" action="{{ route('admin-ps-update') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">

                          <div class="col-lg-6">
                            <div class="form-group">
                              <label for="" class="text-uppercase"><strong>Subtitle</strong></label>
                              <input class="form-control" type="text" name="review_subtitle" value="{{ App\Models\Pagesetting::findOrFail(1)->review_subtitle }}" placeholder="Enter Subtitle" required>
                            </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                              <label for="" class="text-uppercase"><strong>Title</strong></label>
                              <input class="form-control" type="text" name="review_title" value="{{ App\Models\Pagesetting::findOrFail(1)->review_title }}" placeholder="Enter Title" required>
                            </div>
                          </div>
                    </div>

                        <div class="row">

                          <div class="col-lg-12">
                            <div class="form-group">
                              <label for="" class="text-uppercase"><strong>Text</strong></label>
                              <textarea class="form-control" name="review_text" value="" placeholder="Enter Text" required>{{ App\Models\Pagesetting::findOrFail(1)->review_text }}</textarea>
                            </div>
                          </div>


                    </div>

                        <div class="row">

                          <div class="col-lg-2 offset-lg-5 mt-2">
                            <div class="form-group">
                              <button type="submit" class="btn btn-block text-white text-uppercase infos">Submit</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>


							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>Featured Image</th>
									                        <th width="150px">Title</th>
									                        <th width="150px">Sub Title</th>
									                        <th width="500px">Details</th>
									                        <th>Actions</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



{{-- ADD / EDIT MODAL --}}

										<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
										
										
										<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
										</div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">Confirm Delete</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">You are about to delete this Review.</p>
            <p class="text-center">Do you want to proceed?</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger btn-ok">Delete</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection    


@section('scripts')


{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-review-datatables') }}',
               columns: [
                        { data: 'photo', name: 'photo' , searchable: false, orderable: false},
                        { data: 'title', name: 'title' },
                        { data: 'subtitle', name: 'subtitle' },
                        { data: 'details', name: 'details' },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" data-href="{{route('admin-review-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">'+
          '<i class="fas fa-plus"></i> Add New Review'+
          '</a>'+
          '</div>');
      });											
									


{{-- DATA TABLE ENDS--}}


</script>

@endsection   