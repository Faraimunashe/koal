<x-app-layout>
    <div class="content-wrapper align-items-center">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card" id="pakati">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Updates</h4>
                        @foreach ($notices as $notice)
                            <div class="d-flex mt-5 align-items-top">
                                <div class="mb-0 flex-grow">
                                    <h5 class="me-2 mb-2">{{$notice->title}}</h5>
                                    <p class="mb-0 font-weight-light">{{$notice->content}}</p>
                                    <code>{{$notice->created_at}}</code>
                                </div>
                                <div class="ms-auto">
                                    <i class="mdi mdi-heart-outline text-muted"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

