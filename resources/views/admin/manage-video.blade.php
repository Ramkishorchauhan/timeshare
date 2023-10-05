@extends('admin/layout')
@section('container')
    <div class="body-main-content">
        <div class="timeshare-section">
            <div class="timeshare-header">
                <div class="mr-auto">
                    <h4 class="heading-title">Manage Videos</h4>
                </div>
                <div class="ts-filter wd30">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="Create-btn" data-bs-toggle="modal" data-bs-target="#PostVideos">Post Video</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong>{{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong></strong>{{session('status')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif
            <div class="row">

                @foreach ($allvideos as $video)
                <div class="col-md-4">
                    <div class="manage-Video-item">
                        <div class="manage-Video-iframe">
                            <iframe width="100%" height="200" src="{{$video->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                        <div class="manage-Video-content">
                            <h2 class="manage-Video-content-title">{{$video->title}}</h2>
                            <p>{{$video->description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

     <!-- Create Coupon -->
 <div class="modal lm-modal fade" id="PostVideos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Create Video</h2>
            <form action="{{route('admin.add-video')}}" method="post" >
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input name="video_title" type="text" class="form-control" placeholder="Video Title Name" required>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="url" name="video_url"  class="form-control" placeholder="Enter Video Url" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="video_description" class="form-control" placeholder="Video Description" required></textarea>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                        <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="save-btn">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection