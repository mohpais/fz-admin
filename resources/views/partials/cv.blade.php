<div class="tab-pane fade p-4 active show" id="resume" role="tabpanel" aria-labelledby="resume-tab" style="background-color: #f4f4f4">
    <div class="w-100 mb-2">
        {{-- <a class="btn btn-sm btn-primary" href="{{ route('users.downloadpdf') }}">
            <i class="mdi mdi-printer"></i>
            Export to PDF
        </a> --}}
        <button id="printPDF" class="btn btn-sm btn-primary">
            <i class="mdi mdi-printer"></i>
            Export to PDF
        </button>
        {{-- <a class="btn btn-sm btn-primary" onclick="event.preventDefault(); document.getElementById('formGeneratePDF').submit();">
            <i class="mdi mdi-printer"></i>
            Export to PDF
        </a> --}}
        <form id="formGeneratePDF" action="{{ route('users.downloadpdf') }}" method="POST" class="d-none">
            @csrf
            <input type="hidden" class="form-control" name="userId" id="userId" value="{{$user->id}}" readonly>
        </form>
        
    </div>
    <div class="page border">
        <div class="page__header">
            <div class="backdrop"></div>
            <div class="col-4 photo">
                @if ($user->profile_photo_path)
                    <img class="rounded-circle mx-auto" src="{{ $user->profile_photo_path }}" alt="" style="width: 150px; height: 150px">
                @else
                    <img class="rounded-circle mx-auto" src="{{ asset('panel/images/faces/default.png')}}" alt="" style="width: 150px; height: 150px">
                @endif
            </div>
            <div class="col-8 desc">
                <div class="h2">{{ Str::upper(auth()->user()->fullname) }}</div>
                <div class="h6">{{ Str::upper('Information System') }}</div>
            </div>
        </div>
        <div class="page__body">
            <div class="col-4 side__info">
                <div class="info__items">
                    <div class="h4 title">biodata</div>
                    <div class="divider"></div>
                    <div class="w-100">
                        <table>
                            <tr>
                                <td class="text-bold" style="width: 15px">BOD</td>
                                <td class="text-center" style="width: .85742rem">:</td>
                                <td>09 Oktober 1996</td>
                            </tr>
                            <tr>
                                <td class="text-bold" style="width: 15px">Age</td>
                                <td class="text-center" style="width: .85742rem">:</td>
                                <td>24 Tahun</td>
                            </tr>
                            <tr>
                                <td class="text-bold" style="width: 15px">Religion</td>
                                <td class="text-center" style="width: .85742rem">:</td>
                                <td>Islam</td>
                            </tr>
                            <tr>
                                <td class="text-bold" style="width: 15px">Domisili</td>
                                <td class="text-center" style="width: .85742rem">:</td>
                                <td>DKI Jakarta</td>
                            </tr>
                            <tr>
                                <td class="text-bold" style="width: 15px">Marital</td>
                                <td class="text-center" style="width: .85742rem">:</td>
                                <td>Married</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="info__items">
                    <div class="h4 title">Personal Profile</div>
                    <div class="divider"></div>
                    <div class="w-100 profile">
                        <p>
                            Experienced for more than 1 year as a {{$user->corporate != null ? $user->corporate->position : 'Non set'}} in a company engaged in IT Consulting and has completed several projects.
                        </p>
                        <p>
                            Skilled in PHP, Phyton, Javascript, Laravel, SQL and RethinkDB.
                        </p>
                    </div>
                </div>
                <div class="info__items">
                    <div class="h4 title">Contact</div>
                    <div class="divider"></div>
                    <div class="contact" style="">
                        <a class="link">
                            <i class="mdi mdi-linkedin-box icon"></i>
                            <span>linkedin.com/in/mohamad-pais-746b8a18a</span>
                        </a>
                    </div>
                    <div class="contact" style="">
                        <a class="link">
                            <i class="mdi mdi-email icon"></i>
                            <span>{{$user->email}}</span>
                        </a>
                    </div>
                    <div class="contact" style="">
                        <a class="link">
                            <i class="mdi mdi-phone icon"></i>
                            <span>{{$user->phone}}</span>
                        </a>
                    </div>
                    <div class="contact" style="">
                        <a class="link">
                            <i class="mdi mdi-web icon"></i>
                            <span>https://fz-dev.netlify.app</span>
                        </a>
                    </div>
                </div>
                <div class="info__items">
                    <div class="h4 title">Education</div>
                    <div class="divider"></div>
                    <div class="w-100 font-11">
                        Gunadarma University
                        Bachelor degree of <b>Information System</b>, (2015-2019)
                    </div>
                </div>
            </div>
            <div class="col-8 side__content">
                <div class="info__items">
                    <div class="h4 title">skills</div>
                    <div class="divider"></div>
                    <ul class="skills">
                        @foreach ($skills as $item)
                            <li>{{$item->name}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="info__items">
                    <div class="h4 title">projects</div>
                    <div class="divider"></div>
                    <div class="project">
                        <h5 class="project-title">MARKETPLACE</h5>
                        <span>https://mp.ipm.id</span>
                        <ul style="margin: 7px 0 0">
                            <li>Manage product data to be bought or sold</li>
                            <li>Manage buyer and seller data</li>
                        </ul>
                    </div>
                    <div class="project">
                        <h5 class="project-title">kadin</h5>
                        <span>https://mms.kadin.id</span>
                        <ul style="margin: 7px 0 0">
                            <li>Manage KADIN membership data</li>
                            <li>Print certificates for membership</li>
                            <li>Manage KADIN membership payment data every year</li>
                        </ul>
                    </div>
                    <div class="project">
                        <h5 class="project-title">admin hipminet</h5>
                        <span>https://hipmi.ipm.id</span>
                        <ul style="margin: 7px 0 0">
                            <li>Manage HIPMI membership data</li>
                            <li>Manage news data for membership</li>
                            <li>Organize events for HIPMI membership</li>
                        </ul>
                    </div>
                </div>
                <div class="info__items">
                    <div class="h4 title">experience</div>
                    <div class="divider"></div>
                    <div class="experience">
                        <h5 class="corporate_name">PT. Kairos Utama Indonesia</h5>
                        <p style="margin: 4px 0 0">Technical Consultant</p>
                        <p style="margin: 0">OCT 2021 - NOW</p>
                    </div>
                    <div class="experience">
                        <h5 class="corporate_name">PT. Integra Putra Mandiri</h5>
                        <p style="margin: 4px 0 0">Web Developer</p>
                        <p style="margin: 0">DEC 2019 - SEP 2021</p>
                    </div>
                    <div class="experience">
                        <h5 class="corporate_name">PT. Trengginas</h5>
                        <p style="margin: 4px 0 0">Java Developer</p>
                        <p style="margin: 0">Java Boot Camp Junior Programmer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>