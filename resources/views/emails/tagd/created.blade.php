@extends('emails.layout')

@section('title', 'Claim your Tagd')

@section('preview')
You've got an Tagd waiting for you.
@endsection

@section('content')
<!-- START CENTERED WHITE CONTAINER -->
<table role="presentation" class="main">

    <!-- START MAIN CONTENT AREA -->
    <tr>
    <td class="wrapper">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h2>
                    You've just purchased an item through {{ $retailer['name'] }}:
                </h2>

                <h2>
                    <small>
                        {{ $item['name']}}
                    </small>
                </h2>

                <p>
                    <a href="{{ $signUpUrl }}">
                        Sign up in our App to accept your Tagd.
                    </a>
                </p>
            </td>
        </tr>
        </table>
    </td>
    </tr>

<!-- END MAIN CONTENT AREA -->
</table>
<!-- END CENTERED WHITE CONTAINER -->
@endsection

@section('footer')
<!-- START FOOTER -->
<div class="footer">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td class="content-block powered-by">
        <img style="width:5rem" src="{{$message->embed(resource_path('images/logo-black.png'))}}" alt="Tagd logo">
        <br>
        Powered by <a href="{{ $signUpUrl }}">Tagd</a>.
        </td>
    </tr>
    </table>
</div>
<!-- END FOOTER -->
@endsection
