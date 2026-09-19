@extends('layouts.front')

@section('content')
<style>
    .visitor-poster-page {
        position: relative;
        overflow: hidden;
        padding: 70px 0 85px;
        background:
            radial-gradient(circle at 8% 20%, rgba(243, 120, 32, .11), transparent 27%),
            radial-gradient(circle at 92% 80%, rgba(31, 92, 169, .11), transparent 30%),
            linear-gradient(145deg, #fff 0%, #f6f9fd 55%, #fff9f5 100%);
    }

    .visitor-poster-page::before {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(31, 92, 169, .035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(31, 92, 169, .035) 1px, transparent 1px);
        background-size: 34px 34px;
        content: '';
        pointer-events: none;
    }

    .visitor-poster-page .container {
        position: relative;
        z-index: 1;
    }

    .visitor-poster-heading {
        max-width: 760px;
        margin: 0 auto 42px;
        text-align: center;
    }

    .visitor-poster-kicker {
        margin-bottom: 10px;
        color: #f37820;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .visitor-poster-heading h1 {
        margin-bottom: 15px;
        color: #173f70;
        font-size: clamp(30px, 4vw, 46px);
        font-weight: 800;
    }

    .visitor-poster-heading p {
        margin: 0;
        color: #65758b;
        font-size: 17px;
        line-height: 1.7;
    }

    .visitor-poster-card {
        position: relative;
        overflow: hidden;
        max-width: 1040px;
        margin: 0 auto;
        border: 1px solid rgba(23, 63, 112, .12);
        border-radius: 26px;
        background: #fff;
        box-shadow: 0 30px 70px rgba(12, 45, 89, .14), 0 8px 24px rgba(12, 45, 89, .07);
    }

    .visitor-poster-card::before {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #082f63 0%, #1b4e9b 52%, #f57c20 52%, #ff9a50 100%);
        content: '';
    }

    .visitor-poster-info {
        height: 100%;
        padding: 54px 45px;
        background: linear-gradient(145deg, #082f63, #1f5ca9);
        color: #fff;
    }

    .visitor-poster-info .icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 62px;
        height: 62px;
        margin-bottom: 26px;
        border-radius: 16px;
        background: linear-gradient(145deg, #f37820, #ff9b52);
        font-size: 25px;
        box-shadow: 0 12px 25px rgba(0, 0, 0, .16);
    }

    .visitor-poster-info h2 {
        margin-bottom: 15px;
        color: #fff;
        font-size: 29px;
        font-weight: 700;
        line-height: 1.3;
    }

    .visitor-poster-info>p {
        margin-bottom: 30px;
        color: #dce9fa;
        font-size: 15px;
        line-height: 1.7;
    }

    .visitor-poster-steps {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .visitor-poster-steps li {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 17px;
        color: #eef5ff;
        font-size: 14px;
    }

    .visitor-poster-steps span {
        display: inline-flex;
        flex: 0 0 30px;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border: 1px solid rgba(255, 255, 255, .28);
        border-radius: 50%;
        color: #ffac6f;
        font-weight: 700;
    }

    .visitor-poster-form {
        padding: 54px 48px;
    }

    .visitor-poster-form h3 {
        margin-bottom: 8px;
        color: #173f70;
        font-size: 25px;
        font-weight: 700;
    }

    .visitor-poster-form .form-intro {
        margin-bottom: 30px;
        color: #78889a;
        font-size: 14px;
    }

    .visitor-poster-form .form-label {
        margin-bottom: 9px;
        color: #263b55;
        font-size: 14px;
        font-weight: 600;
    }

    .visitor-poster-form .form-control {
        min-height: 52px;
        border: 1px solid #d7e0ea;
        border-radius: 10px;
        color: #173f70;
        font-size: 15px;
    }

    .visitor-poster-form .form-control:focus {
        border-color: #1f5ca9;
        box-shadow: 0 0 0 4px rgba(31, 92, 169, .1);
    }

    .visitor-poster-form input[type='file'] {
        padding: 12px;
    }

    .visitor-poster-form .form-text {
        color: #7b8a9b;
        font-size: 12px;
    }

    .visitor-poster-form .invalid-feedback {
        display: block;
    }

    .visitor-poster-form .alert-danger {
        border: 0;
        border-left: 4px solid #dc3545;
        border-radius: 8px;
        font-size: 14px;
    }

    .visitor-poster-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        min-height: 53px;
        border: 0;
        border-radius: 9px;
        background: linear-gradient(145deg, #f37820, #ff9141);
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        box-shadow: 0 10px 22px rgba(243, 120, 32, .25);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .visitor-poster-submit:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 27px rgba(243, 120, 32, .32);
    }

    @media (max-width: 991px) {
        .visitor-poster-page {
            padding: 55px 0 65px;
        }

        .visitor-poster-info,
        .visitor-poster-form {
            padding: 40px 34px;
        }
    }

    @media (max-width: 575px) {
        .visitor-poster-page {
            padding: 42px 0 50px;
        }

        .visitor-poster-heading {
            margin-bottom: 30px;
        }

        .visitor-poster-heading p {
            font-size: 15px;
        }

        .visitor-poster-card {
            border-radius: 18px;
        }

        .visitor-poster-info,
        .visitor-poster-form {
            padding: 34px 24px;
        }
    }
</style>

<section class="visitor-poster-page">
    <div class="container">
        <div class="visitor-poster-heading">
            <p class="visitor-poster-kicker">Optic Expo Ahmedabad</p>
            <h1>Create Your Visitor Poster</h1>
            <p>Turn your registered visitor details and favourite photo into a personalised Optic Expo poster, ready to download and share.</p>
        </div>

        <div class="visitor-poster-card">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="visitor-poster-info">
                        <div class="icon-box"><i class="fas fa-image"></i></div>
                        <h2>Your personalised expo creative in seconds</h2>
                        <p>We will safely match your mobile number with your existing visitor registration and place those details on your image.</p>
                        <ol class="visitor-poster-steps">
                            <li><span>1</span> Enter your registered mobile number</li>
                            <li><span>2</span> Choose a clear JPG or PNG photo</li>
                            <li><span>3</span> Download your personalised poster</li>
                        </ol>
                    </div>
                </div>

                <div class="col-lg-7">
                    <form class="visitor-poster-form" method="POST" action="{{ route('visitor-poster.generate') }}" enctype="multipart/form-data">
                        @csrf
                        <h3>Enter your details</h3>
                        <p class="form-intro">Both fields are required to create your poster.</p>

                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                        @endif

                        <div class="mb-4">
                            <label class="form-label" for="mobile">Registered mobile number</label>
                            <input class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" type="tel" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" value="{{ old('mobile') }}" placeholder="Enter 10 digit mobile number" required>
                            @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="photo">Upload your photo</label>
                            <input class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" type="file" accept="image/jpeg,image/png" required>
                            <div class="form-text">JPG or PNG, maximum 5 MB. A square or portrait photo works best.</div>
                            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button class="visitor-poster-submit" type="submit">
                            <i class="fas fa-download"></i> Create &amp; Download Image
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection