@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/my-style.css')}}">
@endpush

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-archive"></i>
                    </span> 
                    Profile
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb bg-transparent">
                        <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card profile">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <div class="text-center pb-4 border profile__header shadow">
                                        <div class="backdrop"></div>
                                        <div class="position-relative d-inline-block mb-3">
                                            <div class="profile d-inline-block">
                                                <div class="d-inline-block rounded-circle avatar--no-overlay">
                                                    <div class="d-inline-block">
                                                        <div class="avatar avatar-circle avatar--no-overlay">
                                                            <img id="filepreview" class="rounded-circle mb-3 d-none" src="" width="120px" height="120px" alt="image">
                                                            @if (!$user->profile_photo_path)
                                                                <div class="avatar-initial">
                                                                    @php
                                                                        $concat = explode(" ", $user->fullname);
                                                                        if (sizeof($concat) > 1) {
                                                                            [$first_name, $second_name] = $concat;
                                                                            echo Str::upper(substr($first_name, 0, 1)).Str::upper(substr($second_name, 0, 1));
                                                                        } else {
                                                                            echo Str::upper(substr($concat[0], 0, 1));
                                                                        }
                                                                    @endphp 
                                                                </div>
                                                            @else
                                                                <img id="profileUser" src="{{ $user->profile_photo_path }}" alt="profile" class="d-inline-block rounded-circle avatar--no-overlay" width="100%" height="100%">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="profile-img" type="file" accept="image/*" hidden accept="image/*">
                                            <div id="btn_brows_file" class="btn btn-dark btn-photo"
                                                style="right: 8px; bottom: -10px; visibility: visible">
                                                <i class='mdi mdi-camera icon' ></i>
                                            </div>
                                            <div id="btn_delete_file" class="btn btn-danger btn-photo"
                                                style="right: 8px; bottom: -10px; visibility: hidden;">
                                                <i class='mdi mdi-delete icon' ></i>
                                            </div>
                                        </div>
                                        <button id="btn_upload_profile" class="btn btn-sm mx-auto btn-gradient-success d-none">
                                            <i class="mdi mdi-upload"></i>
                                            Upload
                                        </button>
                                        <div class="px-2 mt-4">
                                            <p class="font-12">Bureau Oberhaeuser is a design bureau focused on Information- and Interface Design. </p>
                                        </div>
                                    </div>
                                    <div class="border-bottom py-4">
                                        <p><b class="">Skills</b></p>
                                        <div>
                                            @foreach ($skills as $item)
                                                <label class="badge badge-outline-dark">{{$item->name}}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="float-left"> Mail </span>
                                            <span class="float-right text-muted"> {{$user->email}} </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left"> Phone </span>
                                            <span class="float-right text-muted"> {{$user->phone}} </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left"> Birthday </span>
                                            <span class="float-right text-muted"> {{ date('d M Y', strtotime($user->bod))}} </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left"> Religion </span>
                                            <span class="float-right text-muted"> {{$user->religion}} </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left"> Marital Status </span>
                                            <span class="float-right text-muted"> {{$user->marital}} </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left"> Opportunity </span>
                                            <span class="float-right @if($user->status) text-danger @else text-success @endif"> {{$user->status ? 'Close' : 'Open'}} </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-9">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3>{{$user->fullname}}</h3>
                                            <div class="d-flex align-items-center">
                                                @if (isset(auth()->user()->corporate))
                                                    <h5 class="mb-0 mr-2 text-muted">{{$user->corporate->position}}</h5>
                                                @else
                                                    <h5 class="mb-0 mr-2 text-muted">Non set</h5>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-outline-secondary btn-icon">
                                                <i class="mdi mdi-comment-processing"></i>
                                            </button>
                                            <button class="btn btn-gradient-primary">
                                                Request
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-4 py-2 border-top border-bottom">
                                        <ul class="nav nav-tabs profile__navbar">
                                            <li class="nav-item">
                                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                                    <i class="mdi mdi-account-outline"></i> 
                                                    Personal Info 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    <i class="mdi mdi-calendar"></i> 
                                                    My Agenda 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#resume" role="tab" aria-controls="resume" aria-selected="true">
                                                    <i class="mdi mdi-attachment"></i>
                                                    My Resume 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="true">
                                                    <i class="mdi mdi-lock"></i> 
                                                    Security 
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="profile__feed tab-content py-4 px-3">
                                        <!-- Personal Info -->
                                        @include('partials.personalinfo')
                                        <!-- My Resume -->
                                        @include('partials.cv')
                                        <!-- Security -->
                                        @include('partials.security')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="modal" tabindex="-1" data-backdrop="static" aria-labelledby="modal-showLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="forms-modal" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-showLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button id="crop" type="button" class="btn btn-gradient-primary btn-submit">Crop</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            var user = @json($user),
                $inputfile = $('#profile-img'),
                $reviewFile = $('#filepreview'),
                $avatarInit = $('.avatar-initial'),
                $delPhoto = $('#btn_delete_file'),
                $profileU = $('#profileUser'),
                $btnUpload = $('#btn_upload_profile'),
                input = ['fullname', 'email', 'phone', 'pod', 'bod', 'religion', 'marital'];
            // config datetimepicker
            for (const [key, value] of Object.entries(user)) {
                if (jQuery.inArray(key, input) !== -1) {
                    var $inp = $(`input#${key}`)
                    if (key === 'bod') {
                        $('.birthday').datetimepicker({
                            format: "YYYY-MM-DD",
                            date: new Date(value)
                        });
                    } else {
                        $(`input#${key}`).val(value) 
                    }
                }
            }

            $('#printPDF').on('click', function(e) {
                event.preventDefault(); 
                $('#formGeneratePDF').submit();
            })

            $("#btn_brows_file").click(function() {
                var file,
                    fd = new FormData();

                $inputfile.trigger('click');
                $inputfile.on('change', function(e) {
                    var 
                        files = e.target.files,
                        reader = new FileReader(),
                        done = function (url) {
                            // Hidden avatar
                            if (!user.profile_photo_path) {
                                $avatarInit.addClass('d-none')
                            } else {
                                $profileU.addClass('d-none')
                                $profileU.removeClass('d-inline-block')
                            }
                            // Preview Image Upload
                            $reviewFile.removeClass('d-none')
                            $btnUpload.removeClass('d-none')
                            $reviewFile.attr('src', url);
                            // Show up delete button image
                            $("#btn_brows_file").css("visibility", "hidden")
                            $delPhoto.css('visibility', 'visible')
                        };

                    if (files && files.length > 0) {
                        file = files[0];
                        reader.onload = function (e) {
                            done(e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                })

                $btnUpload.click(function () {
                    console.log(file);
                    if (file) {
                        // Append data 
                        fd.append('file', file);
                        fd.append('userID', user.id);
                        // AJAX request 
                        $.ajax({
                            url: "/profile/upload",
                            type: "POST",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response){
                                var {success, message} = response
                                if (success) {
                                    Swal.fire('Success!', message, 'success')
                                    window.location.reload()
                                } else {
                                    Swal.fire({icon: 'error', title: 'Oops...', text: message})
                                }
                            },
                            error: async function(err){
                                const {message} = err.responseJSON;
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: message
                                })
                            }
                        });
                    } else {
                        Swal.fire({icon: 'error', title: 'Oops...', text: "Please select a file."})
                    }
                })

                /*
                 * Button delete photo brows
                */
                $delPhoto.click(function() {
                    if (!user.profile_photo_path) {
                        $avatarInit.removeClass('d-none')
                    } else {
                        $profileU.addClass('d-inline-block')
                        $profileU.removeClass('d-none')
                    }
                    $btnUpload.addClass('d-none')
                    $reviewFile.addClass('d-none')
                    $("#btn_brows_file").css("visibility", "visible")
                    $delPhoto.css('visibility', 'hidden')
                    $reviewFile.removeAttr('src')
                })
            })

            // var $inputfile = $('#profile-img'),
            //     $modal = $('#modal')

            // $("#btn_upload").click(function() {
            //     $inputfile.trigger('click');
            //     $inputfile.on('change', function(e) {
            //         var 
            //             url,
            //             cropper,
            //             file,
            //             reader,
            //             files = e.target.files,
            //             done = function (url) {
            //                 image.src = url;
            //                 $modal.modal('show');
            //             };
                    
            //         if (files && files.length > 0) {
            //             file = files[0];
            //             if (URL) {
            //                 done(URL.createObjectURL(file));
            //             } else if (FileReader) {
            //                 reader = new FileReader();
            //                 reader.onload = function (e) {
            //                     done(reader.result);
            //                 };
            //                 reader.readAsDataURL(file);
            //             }
            //         }
                    
            //         $modal.on('shown.bs.modal', function () {
            //             cropper = new Cropper(image, {
            //                 aspectRatio: 1,
            //                 viewMode: 4,
            //                 preview: '.preview'
            //             });
            //         }).on('hidden.bs.modal', function () {
            //             cropper.destroy();
            //             cropper = null;
            //         });
                    
            //         $("#crop").click(function(){
            //             const canvas = cropper.getCroppedCanvas({
            //                 width: 200,
            //                 height: 200,
            //             });
                    
            //             canvas.toBlob(function(blob) {
            //                 url = URL.createObjectURL(blob);
            //                 var reader = new FileReader();
            //                 reader.readAsDataURL(blob); 
            //                 reader.onloadend = function() {
            //                     var base64data = reader.result;	
            //                     sessionStorage.setItem('image', base64data);
            //                     // let img = `
            //                     //     <span id="del-img">X</span>
            //                     //     <img id="original" src="${$session.getItem('image')}" class="z-depth-1-half avatar-pic" alt="" width="500">
            //                     // `
            //                     $('#prof').attr('src', base64data)
            //                     $modal.modal('hide');
            //                 }
            //             });
            //         })
            //     })
            // });
        })
    </script>
@endpush