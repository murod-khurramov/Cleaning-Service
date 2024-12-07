<x-layouts.main xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot:title>
        Notifications
    </x-slot:title>

{{--    <x-page-header>--}}
{{--        Notifications--}}
{{--    </x-page-header>--}}

    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-lg-6">
                    <h1 class="section-title mb-3">Latest notifications</h1>
                </div>
            </div>
                @foreach($notifications as $notification)

                    <div class="border mb-3 p-4 rounded">
                        <div class="position-relative mb-4">
                            <div class="blog-date">
                                <h4 class="font-weight-bold mb-n1">New</h4>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <a class="text-danger text-uppercase font-weight-medium">{{ 'category' }}</a>
                        </div>
                        <h5 class="font-weight-medium mb-2"> {{ 'title' }} </h5>
                        <p class="mb-4"> {{ 'id' }} </p>
                        <a class="btn btn-sm btn-primary py-2"
                           href=" {{ 'a' }} ">Reading</a>
                    </div>
                @endforeach

                {{ $notifications->links() }}
        </div>
    </div>
    <!-- Blog End -->

</x-layouts.main>
