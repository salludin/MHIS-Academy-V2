<div class="mt-15">
    <div class="row">
        <div class="col-9 col-md-6 font-12 text-gray"><span class="pl-10"><?php echo e(trans('public.title')); ?></span></div>
        <div class="col-md-3 font-12 text-gray text-center d-none d-md-block"><?php echo e(trans('public.volume')); ?></div>
        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="accordion-content-wrapper mt-15" id="filesAccordion" role="tablist" aria-multiselectable="true">
                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion-row rounded-sm shadow-lg border mt-20 p-15">
                        <div class="row align-items-center" role="tab" id="files_<?php echo e($file->id); ?>">
                            <div class="col-9 col-md-6 d-flex align-items-center" href="#collapseFiles<?php echo e($file->id); ?>" aria-controls="collapseFiles<?php echo e($file->id); ?>" data-parent="#filesAccordion" role="button" data-toggle="collapse" aria-expanded="true">

                                <?php if($file->accessibility == 'paid'): ?>
                                    <?php if(!empty($user) and $hasBought): ?>
                                        <?php if($file->isVideo()): ?>
                                            <button type="button" data-id="<?php echo e($file->id); ?>" data-title="<?php echo e($file->title); ?>" class="js-play-video btn-transparent mr-15" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('public.play_online')); ?>">
                                                <i data-feather="play-circle" width="20" height="20" class="text-gray"></i>
                                            </button>
                                        <?php else: ?>
                                            <a href="<?php echo e($course->getUrl()); ?>/file/<?php echo e($file->id); ?>/download" class="mr-15">
                                                <i data-feather="download-cloud" width="20" height="20" class="text-gray"></i>
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button class="mr-15 btn-transparent">
                                            <i data-feather="lock" width="20" height="20" class="text-gray"></i>
                                        </button>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <?php if($file->isVideo()): ?>
                                        <button type="button" data-id="<?php echo e($file->id); ?>" data-title="<?php echo e($file->title); ?>" class="js-play-video btn-transparent mr-15" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('public.play_online')); ?>">
                                            <i data-feather="play-circle" width="20" height="20" class="text-gray"></i>
                                        </button>
                                    <?php else: ?>
                                        <a href="<?php echo e($course->getUrl()); ?>/file/<?php echo e($file->id); ?>/download" class="mr-15" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('home.download')); ?>">
                                            <i data-feather="download-cloud" width="20" height="20" class="text-gray"></i>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <span class="font-weight-bold text-secondary font-14 file-title"><?php echo e($file->title); ?></span>
                            </div>

                            <div class="col-md-3 text-gray font-14 text-center d-none d-md-block"><?php echo e($file->volume); ?></div>

                            <div class="col-3 d-flex justify-content-end">
                                <?php if($file->accessibility == 'paid'): ?>
                                    <?php if(!empty($user) and $hasBought): ?>
                                        <?php if($file->downloadable): ?>
                                            <a href="<?php echo e($course->getUrl()); ?>/file/<?php echo e($file->id); ?>/download" class="course-content-btns btn btn-sm btn-primary flex-grow-1">
                                                <?php echo e(trans('home.download')); ?>

                                            </a>
                                        <?php else: ?>
                                            <button type="button" data-id="<?php echo e($file->id); ?>" data-title="<?php echo e($file->title); ?>" class="js-play-video course-content-btns btn btn-sm btn-primary flex-grow-1">
                                                <?php echo e(trans('public.play')); ?>

                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button type="button" class="course-content-btns btn btn-sm btn-gray flex-grow-1 disabled <?php echo e(((empty($user)) ? 'not-login-toast' : (!$hasBought ? 'not-access-toast' : ''))); ?>">
                                            <?php if($file->downloadable): ?>
                                                <?php echo e(trans('home.download')); ?>

                                            <?php else: ?>
                                                <?php echo e(trans('public.play')); ?>

                                            <?php endif; ?>
                                        </button>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <?php if($file->downloadable): ?>
                                        <a href="<?php echo e($course->getUrl()); ?>/file/<?php echo e($file->id); ?>/download" class="course-content-btns btn btn-sm btn-primary flex-grow-1">
                                            <?php echo e(trans('home.download')); ?>

                                        </a>
                                    <?php else: ?>
                                        <button type="button" data-id="<?php echo e($file->id); ?>" data-title="<?php echo e($file->title); ?>" class="js-play-video course-content-btns btn btn-sm btn-primary flex-grow-1">
                                            <?php echo e(trans('public.play')); ?>

                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div id="collapseFiles<?php echo e($file->id); ?>" aria-labelledby="files_<?php echo e($file->id); ?>" class=" collapse" role="tabpanel">
                            <div class="panel-collapse">
                                <div class="text-gray text-14">
                                    <?php echo nl2br(clean($file->description)); ?>

                                </div>

                                <?php if(!empty($user) and $hasBought): ?>
                                    <div class="d-flex align-items-center mt-20">
                                        <label class="mb-0 mr-10 cursor-pointer font-weight-500" for="fileReadToggle<?php echo e($file->id); ?>"><?php echo e(trans('public.i_passed_this_lesson')); ?></label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" id="fileReadToggle<?php echo e($file->id); ?>" data-file-id="<?php echo e($file->id); ?>" value="<?php echo e($course->id); ?>" class="js-file-learning-toggle custom-control-input" <?php if(!empty($file->learningStatus)): ?> checked <?php endif; ?>>
                                            <label class="custom-control-label" for="fileReadToggle<?php echo e($file->id); ?>"></label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lms\resources\views/web/default/course/tabs/contents/files.blade.php ENDPATH**/ ?>