<div class="mt-15">
    <div class="row">
        <div class="col-9 col-md-6 font-12 text-gray"><span class="pl-10">{{ trans('public.title') }}</span></div>
        <div class="col-md-3 font-12 text-gray text-center d-none d-md-block">{{ trans('public.volume') }}</div>
        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="accordion-content-wrapper mt-15" id="filesAccordion" role="tablist" aria-multiselectable="true">
                @foreach($files as $file)
                    <div class="accordion-row rounded-sm shadow-lg border mt-20 p-15">
                        <div class="row align-items-center" role="tab" id="files_{{ $file->id }}">
                            <div class="col-9 col-md-6 d-flex align-items-center" href="#collapseFiles{{ $file->id }}" aria-controls="collapseFiles{{ $file->id }}" data-parent="#filesAccordion" role="button" data-toggle="collapse" aria-expanded="true">

                                @if($file->accessibility == 'paid')
                                    @if(!empty($user) and $hasBought)
                                        @if($file->isVideo())
                                            <button type="button" data-id="{{ $file->id }}" data-title="{{ $file->title }}" class="js-play-video btn-transparent mr-15" data-toggle="tooltip" data-placement="top" title="{{ trans('public.play_online') }}">
                                                <i data-feather="play-circle" width="20" height="20" class="text-gray"></i>
                                            </button>
                                        @else
                                            <a href="{{ $course->getUrl() }}/file/{{ $file->id }}/download" class="mr-15">
                                                <i data-feather="download-cloud" width="20" height="20" class="text-gray"></i>
                                            </a>
                                        @endif
                                    @else
                                        <button class="mr-15 btn-transparent">
                                            <i data-feather="lock" width="20" height="20" class="text-gray"></i>
                                        </button>
                                    @endif

                                @else
                                    @if($file->isVideo())
                                        <button type="button" data-id="{{ $file->id }}" data-title="{{ $file->title }}" class="js-play-video btn-transparent mr-15" data-toggle="tooltip" data-placement="top" title="{{ trans('public.play_online') }}">
                                            <i data-feather="play-circle" width="20" height="20" class="text-gray"></i>
                                        </button>
                                    @else
                                        <a href="{{ $course->getUrl() }}/file/{{ $file->id }}/download" class="mr-15" data-toggle="tooltip" data-placement="top" title="{{ trans('home.download') }}">
                                            <i data-feather="download-cloud" width="20" height="20" class="text-gray"></i>
                                        </a>
                                    @endif
                                @endif

                                <span class="font-weight-bold text-secondary font-14 file-title">{{ $file->title }}</span>
                            </div>

                            <div class="col-md-3 text-gray font-14 text-center d-none d-md-block">{{ $file->volume }}</div>

                            <div class="col-3 d-flex justify-content-end">
                                @if($file->accessibility == 'paid')
                                    @if(!empty($user) and $hasBought)
                                        @if($file->downloadable)
                                            <a href="{{ $course->getUrl() }}/file/{{ $file->id }}/download" class="course-content-btns btn btn-sm btn-primary flex-grow-1">
                                                {{ trans('home.download') }}
                                            </a>
                                        @else
                                            <button type="button" data-id="{{ $file->id }}" data-title="{{ $file->title }}" class="js-play-video course-content-btns btn btn-sm btn-primary flex-grow-1">
                                                {{ trans('public.play') }}
                                            </button>
                                        @endif
                                    @else
                                        <button type="button" class="course-content-btns btn btn-sm btn-gray flex-grow-1 disabled {{ ((empty($user)) ? 'not-login-toast' : (!$hasBought ? 'not-access-toast' : '')) }}">
                                            @if($file->downloadable)
                                                {{ trans('home.download') }}
                                            @else
                                                {{ trans('public.play') }}
                                            @endif
                                        </button>
                                    @endif

                                @else
                                    @if($file->downloadable)
                                        <a href="{{ $course->getUrl() }}/file/{{ $file->id }}/download" class="course-content-btns btn btn-sm btn-primary flex-grow-1">
                                            {{ trans('home.download') }}
                                        </a>
                                    @else
                                        <button type="button" data-id="{{ $file->id }}" data-title="{{ $file->title }}" class="js-play-video course-content-btns btn btn-sm btn-primary flex-grow-1">
                                            {{ trans('public.play') }}
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div id="collapseFiles{{ $file->id }}" aria-labelledby="files_{{ $file->id }}" class=" collapse" role="tabpanel">
                            <div class="panel-collapse">
                                <div class="text-gray text-14">
                                    {!! nl2br(clean($file->description)) !!}
                                </div>

                                @if(!empty($user) and $hasBought)
                                    <div class="d-flex align-items-center mt-20">
                                        <label class="mb-0 mr-10 cursor-pointer font-weight-500" for="fileReadToggle{{ $file->id }}">{{ trans('public.i_passed_this_lesson') }}</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" id="fileReadToggle{{ $file->id }}" data-file-id="{{ $file->id }}" value="{{ $course->id }}" class="js-file-learning-toggle custom-control-input" @if(!empty($file->learningStatus)) checked @endif>
                                            <label class="custom-control-label" for="fileReadToggle{{ $file->id }}"></label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
