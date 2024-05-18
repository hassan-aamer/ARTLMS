<div class="col-xl-3 col-lg-4 col-sm-6 search_results">
    <div class="team-item team-item-4 bg-white mb-70 mb-xl-0">
        <div class="team-img">
            <a href="{{route('website.teachers.show', $con->id)}}">
                <img
                    src="{{assetURLFile($con->userInfo?->image)}}"
                    alt="{{$con->name}}"
                    class="img-fluid"
                    onerror="this.src='{{asset('frontend/assets/images/clients/testimonial-avata-01.jpg')}}'"
                />
            </a>
            <ul class="team-socials list-inline">
                <li class="list-inline-item">
                    <a href="{{$con->userInfo?->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li class="list-inline-item">
                    <a href="{{$con->userInfo?->twitter}}"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                    <a href="{{$con->userInfo?->linkedin}}"><i class="fab fa-linkedin-in"></i></a>
                </li>
            </ul>
        </div>
        <div class="team-content">
            <div class="team-info">
                <h4><a href="{{route('website.teachers.show', $con->id)}}">{{$con->name}}</a></h4>
                <p>{{$con->userInfo?->job_title}}</p>
            </div>

            <div class="course-meta">
                  <span class="duration"
                  ><i class="far fa-book-reader"></i>{{$con->courses->count()}} نشاط</span
                  >
                <span class="lessons">
                    <i class="fa fa-star text-star fs-12"></i>
                    <i class="fa fa-star text-star fs-12"></i>
                    <i class="fa fa-star text-star fs-12"></i>
                    <i class="fa fa-star text-star fs-12"></i>
                    <i class="fa fa-star text-star fs-12"></i>
                  </span>
            </div>
        </div>
    </div>
</div>
