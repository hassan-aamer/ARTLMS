@extends('website.layout.master')

@section('page_title')  {{$page_title}} @endsection
@section('content')

    @include('website.layout.inner-header')

    <section class="my-5 edit_profile">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('errors.validation_error_front')
                </div>
                <div class="col-12 mb-3">
                    <h4 class="fw-bold mb-3"> تعديل البيانات الشخصية :
                    </h4>
                    <div class="head-decorator"></div>
                </div>
                <div class="col-12">
                    <form class="row" method="post" action="{{route('website.student.update')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 form-group">
                            <label> المجموعة </label>
                            <input type="text" disabled readonly class="form-control"
                                   @if(auth()->user()->userInfo?->group_type == 't') value=" مجموعة تجريبية "  @else
                                value="مجموعة ضابطة" @endif/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label> الأسم </label>
                            <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}" required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label> البريد الإلكتروني </label>
                            <input type="text" disabled class="form-control"  value="{{auth()->user()->email}}" required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label> الهاتف  </label>
                            <input type="number" min="0" class="form-control" name="phone" value="{{auth()->user()->userInfo?->phone}}" required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="form-label">  اختر الصف الدراسي </label>
                            <select class="form-control" name="level_id" >
                                @foreach($levels as $key=>$val)
                                    @if($val == auth()->user()->userInfo?->level_id)
                                    <option value="{{$val}}" @if($val == auth()->user()->userInfo?->level_id) selected @endif>{{$key}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label> الشعبة  </label>
                            <select class="form-control" name="section_id" >
                                <option value="{{auth()->user()->userInfo?->section?->id}}" selected>{{auth()->user()->userInfo?->section?->name}}</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>  المسمى الوظيفي </label>
                            <input type="text" class="form-control" name="job_title"
                                   value="{{auth()->user()->userInfo?->job_title}}"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>  الرقم القومي </label>
                            <input type="text" class="form-control" name="national_id"
                                   value="{{auth()->user()->userInfo?->national_id}}"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>  المدينة</label>
                            <input type="text" class="form-control" name="city"
                                   value="{{auth()->user()->userInfo?->city}}"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>  المؤهل</label>
                            <input type="text" class="form-control" name="qualification"
                                   value="{{auth()->user()->userInfo?->qualification}}"  />
                        </div>
                        <input type="hidden" name="status" value="yes">
                        <div class="col-md-4 form-group">
                            <label> المدرسة / المعهد / الكلية </label>

                            <input type="text" class="form-control" name="school_or_college"
                                   value="{{auth()->user()->userInfo?->school_or_college}}"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>  القسم</label>
                            <input type="text" class="form-control" name="department"
                                   value="{{auth()->user()->userInfo?->department}}"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>  التخصص</label>
                            <input type="text" class="form-control" name="specialist"
                                   value="{{auth()->user()->userInfo?->specialist}}"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label> فيسبوك </label>
                            <input type="text" class="form-control" name="facebook"
                                   value="{{auth()->user()->userInfo?->facebook}}"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label> تويتر </label>
                            <input type="text" class="form-control" name="twitter"
                                   value="{{auth()->user()->userInfo?->twitter}}"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label> لينكدان </label>
                            <input type="text" class="form-control" name="linkedin"
                                   value="{{auth()->user()->userInfo?->linkedin}}"  />
                        </div>
                        <div class="col-md-12 form-group">
                            <label>  الصورة الشخصية </label>
                            <input type="file" class="form-control" name="image"   />
                            <img src="{{assetURLFile(auth()->user()->userInfo?->image)}}" height="200" />
                        </div>

                        <div class="col-md-12 form-group text-center">
                            <button
                                type="submit"
                                class="woocommerce-button button woocommerce-form-login__submit bg-success"
                                name="login">
                                <i class="far fa-lock-alt me-1"></i>
                                حفظ البيانات
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-12 mb-3">
                    <h4 class="fw-bold mb-3"> تغيير كلمة المرور : </h4>
                    <div class="head-decorator"></div>
                </div>
                <div class="col-12">
                    <form class="woocommerce-form change-pass-form" method="post" action="{{route('website.change_reset_password', Illuminate\Support\Facades\Crypt::encryptString(auth()->user()->id))}}">
                        @csrf
                        <input type="hidden" name="page" value="edit_profile">
                        <input type="hidden" name="token" value="{{Illuminate\Support\Facades\Crypt::encryptString(auth()->user()->id)}}">
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                            <label for="username">كلمة المرور الجديدة
                                <span class="required text-danger">*</span>
                            </label>
                            <input
                                type="password"
                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                name="password"
                                id="password"
                                autocomplete="password"
                                value=""
                                placeholder="ادخل كلمة المرور الجديدة"
                            />
                        </p>
                        <p
                            class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                        >
                            <label for="username"
                            >تأكيد كلمة المرور<span class="required text-danger"
                                >*</span
                                ></label
                            >
                            <input
                                type="password"
                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                name="confirmPassword"
                                id="confirmPassword"
                                autocomplete="confirmPassword"
                                value=""
                                placeholder="ادخل كلمة السر الجديدة مرة أخرى"
                            />
                        </p>
                        <p class="form-row mt-4">
                            <button
                                type="submit"
                                class="woocommerce-button button woocommerce-form-login__submit bg-danger"
                                name="login"
                                value="Log in"
                            >
                                <i class="far fa-lock-alt me-1"></i>
                                تغيير كلمة المرور
                            </button>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
