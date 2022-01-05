<div class="rounded-sm shadow-lg border mt-20 p-15">
    <div class="row align-items-center">
        <div class="col-7 col-md-3 d-flex align-items-center">
            @if(!empty($isChapterQuiz))
                <span class="mr-15 d-flex"><i data-feather="award" width="20" height="20" class="text-gray"></i></span>
            @endif

            <div class="">
                <span class="font-weight-bold font-14 text-secondary d-block">{{ $quiz->title }}</span>
                <span class="font-12 text-gray d-block">{{ $quiz->quizQuestions->count() }} {{ trans('public.questions') }}, {{ $quiz->time }} {{ trans('public.min') }}</span>
            </div>
        </div>

        <div class="col-2 text-gray font-14 text-center">{{ $quiz->pass_mark }}/{{ $quiz->quizQuestions->sum('grade') }}</div>

        <div class="col-2 text-gray font-14 text-center d-none d-md-block">{{ (!empty($user) and !empty($quiz->result_count)) ? $quiz->result_count : '0' }}/{{ $quiz->attempt }}</div>

        @if(empty($user) or empty($quiz->result_status))
            <div class="col-2 text-gray font-14 text-center d-none d-md-block">-</div>
        @else
            <div class="col-2 text-gray text-center d-none d-md-block">
                <div class="d-flex flex-column @if($quiz->result_status == 'passed') text-primary @elseif($quiz->result_status == 'failed') text-danger @else text-warning @endif">
                    @if($quiz->result_status == 'passed')
                        <span class="font-14">{{ trans('quiz.passed') }}</span>
                    @elseif($quiz->result_status == 'failed')
                        <span class="font-14">{{ trans('quiz.failed') }}</span>
                    @elseif($quiz->result_status == 'waiting')
                        <span class="font-14">{{ trans('quiz.waiting') }}</span>
                    @endif

                    <span class="font-14">({{ $quiz->user_grade }}/{{ $quiz->quizQuestions->sum('grade') }})</span>
                </div>
            </div>
        @endif

        <div class="col-3 d-flex justify-content-end">
            @if(!empty($user) and $quiz->can_try and $hasBought)
                <a href="/panel/quizzes/{{ $quiz->id }}/start" class="course-content-btns btn btn-sm btn-primary flex-grow-1">{{ trans('quiz.quiz_start') }}</a>
            @else
                <button type="button" class="course-content-btns btn btn-sm btn-gray flex-grow-1 disabled {{ ((empty($user)) ? 'not-login-toast' : (!$hasBought ? 'not-access-toast' : (!$quiz->can_try ? 'can-not-try-again-quiz-toast' : ''))) }}">
                    {{ trans('quiz.quiz_start') }}
                </button>
            @endif
        </div>
    </div>
</div>
