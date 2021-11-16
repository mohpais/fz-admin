@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mail.css')}}">
@endpush

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="email-wrapper wrapper">
                <div class="row">
                    <div class="mail-list-container col-sm-12 col-md-4 pt-4 pb-4 border-right bg-white">
                        <div class="border-bottom pb-4 mb-3 px-3">
                            <form class="d-flex align-items-center h-100" action="{{ route('messages.index') }}" method="GET" role="search">
                                <div class="input-group">
                                    <input id="q" name="q" type="text" class="form-control " placeholder="Search mail ...">
                                    <button type="submit" class="input-group-prepend btn-inverse-success btn-icon">
                                        <i class="input-group-text border-0 mdi mdi-magnify bg-transparent"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        @forelse ($messages as $item)
                            <div class="mail-list {{$item->isRead == 0 ? 'new_mail' : ''}}">
                                <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                                <div class="content">
                                    <h6 class="sender-name">{{$item->name}}</h6>
                                    <div class="message_text">
                                        {!! substr($item->body, 0, 10).' ...' !!}
                                    </div>
                                </div>
                                <div class="details">
                                    <i class="mdi mdi-star-outline"></i>
                                </div>
                            </div>
                        @empty
                            <div class="mail-list">
                                <div class="w-100 text-center">
                                    <h6>Tidak ada data!</h6>
                                </div>
                            </div>
                        @endforelse
                        {{-- <div class="mail-list new_mail">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" checked=""> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Microsoft Account Password Change</p>
                                <p class="message_text">Change the password for your Microsoft Account using the security code 35525</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star favorite"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Sophia Lara</p>
                                <p class="message_text">Hello, last date for registering for the annual music event is closing in</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Stella Davidson</p>
                                <p class="message_text">Hey there, can you send me this year’s holiday calendar?</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star favorite"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">David Moore</p>
                                <p class="message_text">FYI</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star favorite"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Daniel Russel</p>
                                <p class="message_text">Hi, Please find this week’s update..</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"><label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Sarah Graves</p>
                                <p class="message_text">Hey, can you send me this year’s holiday calendar ?</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Bruno King</p>
                                <p class="message_text">Hi, Please find this week’s monitoring report in the attachment.</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Me, Mark</p>
                                <p class="message_text">Hi, Testing is complete. The system is ready to go live.</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Catherine Myers</p>
                                <p class="message_text">Template Market: Limited Period Offer!!! 50% Discount on all Templates.</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star favorite"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Daniel Russell</p>
                                <p class="message_text">Hi Emily, Please approve my leaves for 10 days from 10th May to 20th May.</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Sarah Graves</p>
                                <p class="message_text">Hello there, Make the most of the limited period offer. Grab your favorites</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">John Doe</p>
                                <p class="message_text">This is the first reminder to complete the online cybersecurity course</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div>
                        <div class="mail-list">
                            <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                            <div class="content">
                                <p class="sender-name">Bruno</p>
                                <p class="message_text">Dear Employee, As per the regulations all employees are required to complete</p>
                            </div>
                            <div class="details">
                                <i class="mdi mdi-star-outline"></i>
                            </div>
                        </div> --}}
                    </div>
                    <div class="mail-view d-none d-md-block col-md-8 col-lg-8 bg-white">
                        <div class="row">
                            <div class="col-md-12 mb-4 mt-4">
                                <div class="btn-toolbar">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-reply text-primary"></i> Reply</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-reply-all text-primary"></i>Reply All</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-share text-primary"></i>Forward</button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-attachment text-primary"></i>Attach</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-delete text-primary"></i>Delete</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="message-body">
                            <div class="sender-details">
                                <div class="details">
                                    <h4 class="msg-subject ellipsis mb-1"> Weekly Update - Week 19 (May 8, 2017 - May 14, 2017) </h4>
                                    <p class="sender-email"> Sarah Graves <a href="#">itsmesarah268@gmail.com</a> &nbsp;<i class="mdi mdi-account-multiple-plus"></i>
                                    </p>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <div class="message-content">
                                <p>Hi Emily,</p>
                                <p>This week has been a great week and the team is right on schedule with the set deadline. The team has made great progress and achievements this week. At the current rate we will be able to deliver the product right on time and meet the quality that is expected of us. Attached are the seminar report held this week by our team and the final product design that needs your approval at the earliest.</p>
                                <p>For the coming week the highest priority is given to the development for <a href="http://www.bootstrapdash.com/" target="_blank">http://www.bootstrapdash.com/</a> once the design is approved and necessary improvements are made.</p>
                                <p><br><br>Regards,<br>Sarah Graves</p>
                            </div>
                            <div class="attachments-sections">
                                <ul>
                                    <li>
                                        <div class="thumb"><i class="mdi mdi-file-pdf"></i></div>
                                        <div class="details">
                                        <p class="file-name">Seminar Reports.pdf</p>
                                        <div class="buttons">
                                            <p class="file-size">678Kb</p>
                                            <a href="#" class="view">View</a>
                                            <a href="#" class="download">Download</a>
                                        </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="thumb"><i class="mdi mdi-file-image"></i></div>
                                        <div class="details">
                                        <p class="file-name">Product Design.jpg</p>
                                        <div class="buttons">
                                            <p class="file-size">1.96Mb</p>
                                            <a href="#" class="view">View</a>
                                            <a href="#" class="download">Download</a>
                                        </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('includes.footer')
        <!-- partial -->
    </div>
@endsection