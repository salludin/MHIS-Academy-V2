<div class="mt-15">
    <div class="row">
        <div class="col-7 col-md-5 font-12 text-gray"><span class="pl-10">{{ trans('public.title') }}</span></div>
        <div class="col-2 font-12 text-gray text-center">{{ trans('public.study_time') }}</div>
        <div class="col-2 font-12 text-gray text-center d-none d-md-block">{{ trans('public.attachments') }}</div>
        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="accordion-content-wrapper mt-15" id="textLessonsAccordion" role="tablist" aria-multiselectable="true">
                @foreach($textLessons as $textLesson)
                    <div class="accordion-row rounded-sm shadow-lg border mt-20 p-15">
                        <div class="row align-items-center" role="tab" id="textLessons_{{ $textLesson->id }}">
                            <div class="col-7 col-md-5 d-flex align-items-center" href="#collapseTextLessons{{ $textLesson->id }}" aria-controls="collapseTextLessons{{ $textLesson->id }}" data-parent="#textLessonsAccordion" role="button" data-toggle="collapse" aria-expanded="true">

                                @if($textLesson->accessibility == 'paid')
                                    @if(!empty($user) and $hasBought)
                                        <a href="{{ $course->getUrl() }}/lessons/{{ $textLesson->id }}/read" target="_blank" class="mr-15" data-toggle="tooltip" data-placement="top" title="{{ trans('public.read') }}">
                                            <i data-feather="file-text" width="20" height="20" class="text-gray"></i>
                                        </a>
                                    @else
                                        <button class="mr-15 btn-transparent">
                                            <i data-feather="lock" width="20" height="20" class="text-gray"></i>
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ $course->getUrl() }}/lessons/{{ $textLesson->id }}/read" target="_blank" class="mr-15" data-toggle="tooltip" data-placement="top" title="{{ trans('public.read') }}">
                                        <i data-feather="file-text" width="20" height="20" class="text-gray"></i>
                                    </a>
                                @endif

                                <span class="font-weight-bold text-secondary font-14 file-title">{{ $textLesson->title }}</span>
                            </div>

                            <div class="col-2 text-gray text-center font-14">{{ $textLesson->study_time }} {{ trans('public.min') }}</div>

                            <div class="col-2 text-gray text-center font-14 d-none d-md-block">{{ $textLesson->attachments_count }}</div>

                            <div class="col-3 d-flex justify-content-end">
                                @if($textLesson->accessibility == 'paid')
                                    @if(!empty($user) and $hasBought)
                                        <a href="{{ $course->getUrl() }}/lessons/{{ $textLesson->id }}/read" target="_blank" class="course-content-btns btn btn-sm btn-primary flex-grow-1">
                                            {{ trans('public.read') }}
                                        </a>
                                    @else
                                        <button type="button" class="course-content-btns btn btn-sm btn-gray flex-grow-1 disabled {{ ((empty($user)) ? 'not-login-toast' : (!$hasBought ? 'not-access-toast' : '')) }}">
                                            {{ trans('public.read') }}
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ $course->getUrl() }}/lessons/{{ $textLesson->id }}/read" target="_blank" class="course-content-btns btn btn-sm btn-primary flex-grow-1">
                                        {{ trans('public.read') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div id="collapseTextLessons{{ $textLesson->id }}" aria-labelledby="textLessons_{{ $textLesson->id }}" class=" collapse" role="tabpanel">
                            <div class="panel-collapse">
                                <div class="text-gray">
                                    {!! nl2br(clean($textLesson->summary)) !!}
                                </div>

                                @if(!empty($user) and $hasBought)
                                    <div class="d-flex align-items-center mt-20">
                                        <label class="mb-0 mr-10 cursor-pointer font-weight-500" for="textLessonReadToggle{{ $textLesson->id }}">{{ trans('public.i_passed_this_lesson') }}</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" id="textLessonReadToggle{{ $textLesson->id }}" data-lesson-id="{{ $textLesson->id }}" value="{{ $course->id }}" class="js-text-lesson-learning-toggle custom-control-input" @if(!empty($textLesson->learningStatus)) checked @endif>
                                            <label class="custom-control-label" for="textLessonReadToggle{{ $textLesson->id }}"></label>
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
