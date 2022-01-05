<li data-id="{{ !empty($file) ? $file->id :'' }}" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
    <div class="d-flex align-items-center justify-content-between " role="tab" id="file_{{ !empty($file) ? $file->id :'record' }}">
        <div class="d-flex align-items-center" href="#collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-controls="collapseFile{{ !empty($file) ? $file->id :'record' }}" data-parent="#chapterContentAccordion{{ !empty($chapter) ? $chapter->id :'' }}" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="file-text" class=""></i>
            </span>

            <div class="font-weight-bold text-dark-blue d-block">{{ !empty($file) ? $file->title . ($file->accessibility == 'free' ? " (". trans('public.free') .")" : '') : trans('public.add_new_files') }}</div>
        </div>

        <div class="d-flex align-items-center">
            @if(!empty($file) and $file->status != \App\Models\WebinarChapter::$chapterActive)
                <span class="disabled-content-badge mr-10">{{ trans('public.disabled') }}</span>
            @endif


            <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

            @if(!empty($file))
                <a href="/panel/files/{{ $file->id }}/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                    <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                </a>
            @endif

            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-controls="collapseFile{{ !empty($file) ? $file->id :'record' }}" data-parent="#chapterContentAccordion{{ !empty($chapter) ? $chapter->id :'' }}" role="button" data-toggle="collapse" aria-expanded="true"></i>
        </div>
    </div>

    <div id="collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-labelledby="file_{{ !empty($file) ? $file->id :'record' }}" class=" collapse @if(empty($file)) show @endif" role="tabpanel">
        <div class="panel-collapse text-gray">
            <div class="js-content-form file-form" data-action="/panel/files/{{ !empty($file) ? $file->id . '/update' : 'store' }}">
                <input type="hidden" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][webinar_id]" value="{{ !empty($webinar) ? $webinar->id :'' }}">
                <input type="hidden" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][chapter_id]" value="{{ !empty($chapter) ? $chapter->id :'' }}" class="chapter-input">

                <div class="row">
                    <div class="col-12 col-lg-6">

                        @if(!empty(getGeneralSettings('content_translate')))
                            <div class="form-group">
                                <label class="input-label">{{ trans('auth.language') }}</label>
                                <select name="ajax[{{ !empty($file) ? $file->id : 'new' }}][locale]"
                                        class="form-control {{ !empty($file) ? 'js-webinar-content-locale' : '' }}"
                                        data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}"
                                        data-id="{{ !empty($file) ? $file->id : '' }}"
                                        data-relation="files"
                                        data-fields="title,description"
                                >
                                    @foreach($userLanguages as $lang => $language)
                                        <option value="{{ $lang }}" {{ (!empty($file) and !empty($file->locale)) ? (mb_strtolower($file->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '') }}>{{ $language }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][locale]" value="{{ $defaultLocale }}">
                        @endif


                        <div class="form-group">
                            <label class="input-label">{{ trans('public.title') }}</label>
                            <input type="text" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][title]" class="js-ajax-title form-control" value="{{ !empty($file) ? $file->title : '' }}" placeholder="{{ trans('forms.maximum_50_characters') }}"/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">{{ trans('public.accessibility') }}</label>

                            <div class="d-flex align-items-center js-ajax-accessibility">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][accessibility]" value="free" @if(empty($file) or (!empty($file) and $file->accessibility == 'free')) checked="checked" @endif id="accessibilityRadio1_{{ !empty($file) ? $file->id : 'record' }}" class="custom-control-input">
                                    <label class="custom-control-label font-14 cursor-pointer" for="accessibilityRadio1_{{ !empty($file) ? $file->id : 'record' }}">{{ trans('public.free') }}</label>
                                </div>

                                <div class="custom-control custom-radio ml-15">
                                    <input type="radio" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][accessibility]" value="paid" @if(!empty($file) and $file->accessibility == 'paid') checked="checked" @endif id="accessibilityRadio2_{{ !empty($file) ? $file->id : 'record' }}" class="custom-control-input">
                                    <label class="custom-control-label font-14 cursor-pointer" for="accessibilityRadio2_{{ !empty($file) ? $file->id : 'record' }}">{{ trans('public.paid') }}</label>
                                </div>
                            </div>

                            <div class="invalid-feedback"></div>
                        </div>


                        <div class="form-group pt-15">
                            <label class="input-label">{{ trans('public.source') }}</label>

                            <div class="d-flex align-items-center">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][storage]" value="local" @if(empty($file) or $file->storage != 'online') checked="checked" @endif id="customRadio1_{{ !empty($file) ? $file->id : 'record' }}" class="js-file-storage custom-control-input">
                                    <label class="custom-control-label font-14 cursor-pointer" for="customRadio1_{{ !empty($file) ? $file->id : 'record' }}">{{ trans('webinars.upload') }}</label>
                                </div>

                                <div class="custom-control custom-radio ml-15">
                                    <input type="radio" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][storage]" value="online" @if(!empty($file) and $file->storage == 'online') checked="checked" @endif id="customRadio2_{{ !empty($file) ? $file->id : 'record' }}" class="js-file-storage custom-control-input">
                                    <label class="custom-control-label font-14 cursor-pointer" for="customRadio2_{{ !empty($file) ? $file->id : 'record' }}">{{ trans('webinars.youtube_vimeo') }}</label>
                                </div>
                            </div>

                            <div class="local-input input-group mt-20 @if(!empty($file) and $file->storage == 'online') d-none @endif">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text panel-file-manager" data-input="file_path{{ !empty($file) ? $file->id : 'record' }}" data-preview="holder">
                                        <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                                    </button>
                                </div>
                                <input type="text" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][file_path]" id="file_path{{ !empty($file) ? $file->id : 'record' }}" value="{{ (!empty($file) and $file->storage != 'online') ? $file->file : '' }}" class="js-ajax-file_path form-control" placeholder="{{ trans('webinars.file_upload_placeholder') }}"/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="online-inputs @if(empty($file) or $file->storage != 'online') d-none @endif">
                                <div class="input-group mt-20">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="link" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][file_path]" value="{{ (!empty($file) and $file->storage == 'online') ? $file->file : '' }}" class="js-ajax-file_path form-control" placeholder="{{ trans('webinars.file_online_placeholder') }}"/>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="row mt-15">
                                    <div class="col-6">
                                        <label class="input-label">{{ trans('webinars.file_type') }}</label>

                                        <select name="ajax[{{ !empty($file) ? $file->id : 'new' }}][file_type]" class="js-ajax-file_type form-control">
                                            <option value="">{{ trans('webinars.select_file_type') }}</option>

                                            @foreach(\App\Models\File::$fileTypes as $fileType)
                                                <option value="{{ $fileType }}" @if(!empty($file) and $file->storage == 'online' and $file->file_type == $fileType) selected @endif>{{ $fileType }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-6">
                                        <label class="input-label">{{ trans('webinars.file_volume') }}</label>
                                        <input type="text" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][volume]" value="{{ (!empty($file) and $file->storage == 'online') ? $file->volume : '' }}" class="js-ajax-volume form-control" placeholder="{{ trans('webinars.online_file_volume') }}"/>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">{{ trans('public.description') }}</label>
                            <textarea name="ajax[{{ !empty($file) ? $file->id : 'new' }}][description]" class="js-ajax-description form-control" rows="6">{{ !empty($file) ? $file->description : '' }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="js-downloadable-file form-group mt-20 @if(!empty($file) and $file->storage == 'online') d-none @endif">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="cursor-pointer input-label" for="downloadableSwitch{{ !empty($file) ? $file->id : '_record' }}">{{ trans('home.downloadable') }}</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][downloadable]" class="custom-control-input" id="downloadableSwitch{{ !empty($file) ? $file->id : '_record' }}" {{ (empty($file) or $file->downloadable) ? 'checked' : ''  }}>
                                    <label class="custom-control-label" for="downloadableSwitch{{ !empty($file) ? $file->id : '_record' }}"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-20">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="cursor-pointer input-label" for="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}">{{ trans('public.active') }}</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][status]" class="custom-control-input" id="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}" {{ (empty($file) or $file->status == \App\Models\File::$Active) ? 'checked' : ''  }}>
                                    <label class="custom-control-label" for="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-30 d-flex align-items-center">
                    <button type="button" class="js-save-file btn btn-sm btn-primary">{{ trans('public.save') }}</button>

                    @if(empty($file))
                        <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">{{ trans('public.close') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</li>
