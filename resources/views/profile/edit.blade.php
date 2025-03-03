@extends('layouts.main')
@section('content')
    <div>
        <div>
            <div>
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div>
            <div>
                <div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div>
            <div>
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection('content')