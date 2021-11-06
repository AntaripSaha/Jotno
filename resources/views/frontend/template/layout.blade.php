<!DOCTYPE html>
<html lang="en">

<head>
    
    @include("frontend.includes.meta")

    @include("frontend.includes.css")

    <!--[if lt IE 9]>
    <script src="{{ asset('frontend/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('frontend/js/respond.min.js') }}"></script>
    <![endif]-->

</head>

    @include("frontend.includes.header")

<body>

    <div class="main-wrapper">
        @yield("body-content")
        @include("frontend.includes.footer")
    </div>

    <div class="loading">Loading&#8230;</div>
    
    <!-- MY MODAL -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <!-- MY MODAL END -->

    <!-- MY MODAL large -->
    <div class="modal fade bd-example-modal-lg" id="largeModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <!-- MY MODAL large END -->

    @include("frontend.includes.script")

</body>

</html>
