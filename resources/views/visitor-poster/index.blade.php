<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create your visitor poster</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 28px 16px;
            background: linear-gradient(135deg, #eef5ff, #fff8e8);
            color: #14213d;
            font-family: Arial, sans-serif;
        }

        .card {
            width: min(100%, 540px);
            overflow: hidden;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 24px 65px rgba(18, 59, 104, .16);
        }

        .hero {
            padding: 34px 38px 30px;
            color: #fff;
            background: #123b68;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: #fbbf24;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(28px, 7vw, 38px);
            line-height: 1.12;
        }

        .hero p {
            margin: 12px 0 0;
            color: #dbeafe;
            line-height: 1.55;
        }

        form {
            padding: 34px 38px 38px;
        }

        label {
            display: block;
            margin: 0 0 9px;
            font-size: 14px;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #cad5e2;
            border-radius: 10px;
            font: inherit;
            color: #14213d;
        }

        input:focus {
            border-color: #31669b;
            outline: 3px solid rgba(49, 102, 155, .13);
        }

        .field {
            margin-bottom: 22px;
        }

        .hint {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.45;
        }

        .alert {
            margin: 0 0 22px;
            padding: 13px 15px;
            border-radius: 9px;
            background: #fff0f0;
            color: #a52020;
            font-size: 14px;
        }

        .error {
            margin: 7px 0 0;
            color: #b42318;
            font-size: 12px;
        }

        button {
            width: 100%;
            padding: 15px 18px;
            border: 0;
            border-radius: 10px;
            background: #f59e0b;
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(245, 158, 11, .25);
        }

        button:hover {
            background: #dd8a05;
        }

        @media (max-width: 520px) {

            .hero,
            form {
                padding-left: 24px;
                padding-right: 24px;
            }
        }
    </style>
</head>

<body>
    <main class="card">
        <section class="hero">
            <p class="eyebrow">Optic Exhibition Ahmedabad</p>
            <h1>Create your visitor poster</h1>
            <p>Enter your registered mobile number and upload a photo. Your personalised image will download automatically.</p>
        </section>

        <form method="POST" action="{{ route('visitor-poster.generate') }}" enctype="multipart/form-data">
            @csrf

            @if (session('error'))
            <div class="alert" role="alert">{{ session('error') }}</div>
            @endif

            <div class="field">
                <label for="mobile">Registered mobile number</label>
                <input id="mobile" name="mobile" type="tel" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" value="{{ old('mobile') }}" placeholder="Enter 10 digit number" required>
                @error('mobile') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="photo">Your photo</label>
                <input id="photo" name="photo" type="file" accept="image/jpeg,image/png" required>
                <p class="hint">JPG or PNG, maximum 5 MB. A square or portrait photo works best.</p>
                @error('photo') <p class="error">{{ $message }}</p> @enderror
            </div>

            <button type="submit">Create &amp; download image</button>
        </form>
    </main>
</body>

</html>