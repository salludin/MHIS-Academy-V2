<div class="rounded-sm shadow-lg border mt-20 p-15">
    <div class="row align-items-center">
        <div class="col-7 col-md-3 d-flex align-items-center">
            <?php if(!empty($isChapterQuiz)): ?>
                <span class="mr-15 d-flex"><i data-feather="award" width="20" height="20" class="text-gray"></i></span>
            <?php endif; ?>

            <div class="">
                <span class="font-weight-bold font-14 text-secondary d-block"><?php echo e($quiz->title); ?></span>
                <span class="font-12 text-gray d-block"><?php echo e($quiz->quizQuestions->count()); ?> <?php echo e(trans('public.questions')); ?>, <?php echo e($quiz->time); ?> <?php echo e(trans('public.min')); ?></span>
            </div>
        </div>

        <div class="col-2 text-gray font-14 text-center"><?php echo e($quiz->pass_mark); ?>/<?php echo e($quiz->quizQuestions->sum('grade')); ?></div>

        <div class="col-2 text-gray font-14 text-center d-none d-md-block"><?php echo e((!empty($user) and !empty($quiz->result_count)) ? $quiz->result_count : '0'); ?>/<?php echo e($quiz->attempt); ?></div>

        <?php if(empty($user) or empty($quiz->result_status)): ?>
            <div class="col-2 text-gray font-14 text-center d-none d-md-block">-</div>
        <?php else: ?>
            <div class="col-2 text-gray text-center d-none d-md-block">
                <div class="d-flex flex-column <?php if($quiz->result_status == 'passed'): ?> text-primary <?php elseif($quiz->result_status == 'failed'): ?> text-danger <?php else: ?> text-warning <?php endif; ?>">
                    <?php if($quiz->result_status == 'passed'): ?>
                        <span class="font-14"><?php echo e(trans('quiz.passed')); ?></span>
                    <?php elseif($quiz->result_status == 'failed'): ?>
                        <span class="font-14"><?php echo e(trans('quiz.failed')); ?></span>
                    <?php elseif($quiz->result_status == 'waiting'): ?>
                        <span class="font-14"><?php echo e(trans('quiz.waiting')); ?></span>
                    <?php endif; ?>

                    <span class="font-14">(<?php echo e($quiz->user_grade); ?>/<?php echo e($quiz->quizQuestions->sum('grade')); ?>)</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-3 d-flex justify-content-end">
            <?php if(!empty($user) and $quiz->can_try and $hasBought): ?>
                <a href="/panel/quizzes/<?php echo e($quiz->id); ?>/start" class="course-content-btns btn btn-sm btn-primary flex-grow-1"><?php echo e(trans('quiz.quiz_start')); ?></a>
            <?php else: ?>
                <button type="button" class="course-content-btns btn btn-sm btn-gray flex-grow-1 disabled <?php echo e(((empty($user)) ? 'not-login-toast' : (!$hasBought ? 'not-access-toast' : (!$quiz->can_try ? 'can-not-try-again-quiz-toast' : '')))); ?>">
                    <?php echo e(trans('quiz.quiz_start')); ?>

                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lms\resources\views/web/default/course/tabs/contents/quiz.blade.php ENDPATH**/ ?>