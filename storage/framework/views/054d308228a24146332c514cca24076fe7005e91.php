

<?php if(!empty($course->sessions) and count($course->sessions)): ?>
    <section class="mt-20">
        <h2 class="section-title"><?php echo e(trans('public.sessions')); ?></h2>

        <?php if(!empty($sessionsWithoutChapter) and count($sessionsWithoutChapter)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.sessions' , ['sessions' => $sessionsWithoutChapter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(!empty($sessionChapters) and count($sessionChapters)): ?>
            <?php $__currentLoopData = $sessionChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sessionChapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between align-items-center mt-20">
                    <h3 class="section-title after-line"><?php echo e($sessionChapter->title); ?></h3>
                    <span class="ml-5 font-14 text-gray"><?php echo e(count($sessionChapter->sessions)); ?> <?php echo e(trans('public.parts')); ?> - <?php echo e(convertMinutesToHourAndMinute($sessionChapter->getDuration())); ?> <?php echo e(trans('public.hr')); ?></span>
                </div>

                <?php echo $__env->make('web.default.course.tabs.contents.sessions' , ['sessions' => $sessionChapter->sessions], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(!empty($sessionChapter->quizzes) and count($sessionChapter->quizzes)): ?>
                    <?php $__currentLoopData = $sessionChapter->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.default.course.tabs.contents.quiz' , ['quiz' => $quiz, 'isChapterQuiz' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>
<?php endif; ?>


<?php if(!empty($course->files) and count($course->files)): ?>
    <section class="mt-40">
        <h2 class="section-title"><?php echo e(trans('public.files')); ?></h2>

        <?php if(!empty($filesWithoutChapter) and count($filesWithoutChapter)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.files' , ['files' => $filesWithoutChapter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(!empty($fileChapters) and count($fileChapters)): ?>
            <?php $__currentLoopData = $fileChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileChapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between align-items-center mt-20">
                    <h3 class="section-title after-line"><?php echo e($fileChapter->title); ?></h3>
                    <span class="ml-5 font-14 text-gray"><?php echo e(count($fileChapter->files)); ?> <?php echo e(trans('public.parts')); ?></span>
                </div>

                <?php echo $__env->make('web.default.course.tabs.contents.files' , ['files' => $fileChapter->files], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(!empty($fileChapter->quizzes) and count($fileChapter->quizzes)): ?>
                    <?php $__currentLoopData = $fileChapter->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.default.course.tabs.contents.quiz' , ['quiz' => $quiz, 'isChapterQuiz' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>

    <?php echo $__env->make('web.default.course.tabs.play_modal.play_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?>


<?php if(!empty($course->textLessons) and count($course->textLessons)): ?>
    <section class="mt-40">
        <h2 class="section-title after-line"><?php echo e(trans('webinars.text_lessons')); ?></h2>

        <?php if(!empty($textLessonsWithoutChapter) and count($textLessonsWithoutChapter)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.text_lessons' , ['textLessons' => $textLessonsWithoutChapter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(!empty($textLessonChapters) and count($textLessonChapters)): ?>
            <?php $__currentLoopData = $textLessonChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $textLessonChapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between align-items-center mt-20">
                    <h3 class="section-title after-line"><?php echo e($textLessonChapter->title); ?></h3>
                    <span class="ml-5 font-14 text-gray"><?php echo e(count($textLessonChapter->textLessons)); ?> <?php echo e(trans('public.parts')); ?> - <?php echo e(convertMinutesToHourAndMinute($textLessonChapter->getDuration())); ?> <?php echo e(trans('public.hr')); ?></span>
                </div>

                <?php echo $__env->make('web.default.course.tabs.contents.text_lessons' , ['textLessons' => $textLessonChapter->textLessons], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(!empty($textLessonChapter->quizzes) and count($textLessonChapter->quizzes)): ?>
                    <?php $__currentLoopData = $textLessonChapter->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.default.course.tabs.contents.quiz' , ['quiz' => $quiz, 'isChapterQuiz' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>
<?php endif; ?>


<?php if(!empty($quizzes) and $quizzes->count() > 0): ?>
    <section class="mt-40">
        <h2 class="section-title after-line"><?php echo e(trans('quiz.quizzes')); ?></h2>

        <div class="mt-15">
            <div class="row">
                <div class="col-7 col-md-3 font-12 text-gray"><span class="pl-10"><?php echo e(trans('public.title')); ?></span></div>
                <div class="col-2 font-12 text-gray text-center"><?php echo e(trans('public.min')); ?> <?php echo e(trans('quiz.grade')); ?></div>
                <div class="col-2 font-12 text-gray text-center d-none d-md-block"><?php echo e(trans('quiz.attempts')); ?></div>
                <div class="col-2 font-12 text-gray text-center d-none d-md-block"><?php echo e(trans('public.status')); ?></div>
                <div class="col-3"></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.default.course.tabs.contents.quiz' , ['quiz' => $quiz], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if(!empty($course->quizzes) and $course->quizzes->count() > 0 and ($quiz->certificate) ): ?>
    <section class="mt-40">
        <h2 class="section-title after-line"><?php echo e(trans('panel.certificates')); ?></h2>

        <div class="mt-15">
            <div class="row">
                <div class="col-6 font-12 text-gray"><span class="pl-10"><?php echo e(trans('public.title')); ?></span></div>
                <div class="col-3 text-center font-12 text-gray"><?php echo e(trans('public.min')); ?> <?php echo e(trans('quiz.grade')); ?></div>
                <div class="col-3"></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php $__currentLoopData = $course->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($quiz->certificate): ?>
                            <div class="rounded-sm shadow-lg border mt-20 p-15">
                                <div class="row align-items-center">
                                    <div class="col-6 d-flex flex-column">
                                        <span class="font-weight-bold font-14 text-secondary"><?php echo e($quiz->title); ?></span>
                                    </div>

                                    <div class="col-3 text-gray font-14 text-center"><?php echo e($quiz->pass_mark); ?>/<?php echo e($quiz->quizQuestions->sum('grade')); ?></div>

                                    <div class="col-3 d-flex justify-content-end">
                                        <?php if(!empty($user) and $quiz->can_download_certificate and $hasBought): ?>
                                            <a href="/panel/quizzes/results/<?php echo e($quiz->result->id); ?>/downloadCertificate" class="course-content-btns btn btn-sm btn-primary flex-grow-1"><?php echo e(trans('home.download')); ?></a>
                                        <?php else: ?>
                                            <button type="button" class="course-content-btns btn btn-sm btn-gray flex-grow-1 disabled <?php echo e(((empty($user)) ? 'not-login-toast' : (!$hasBought ? 'not-access-toast' : (!$quiz->can_download_certificate ? 'can-not-download-certificate-toast' : '')))); ?>">
                                                <?php echo e(trans('home.download')); ?>

                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lms\resources\views/web/default/course/tabs/content.blade.php ENDPATH**/ ?>