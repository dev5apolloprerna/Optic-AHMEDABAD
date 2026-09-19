@extends('layouts.front')

@section('content')

<style>
    /* ==================================================
       OPTIC EXPO PRIVACY POLICY
    ================================================== */

    .optic-privacy-page {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(
                circle at 0% 15%,
                rgba(243, 120, 32, 0.07),
                transparent 24%
            ),
            radial-gradient(
                circle at 100% 70%,
                rgba(31, 92, 169, 0.08),
                transparent 25%
            ),
            #f7f9fc;
    }

    /* ==================================================
       HERO
    ================================================== */

    .privacy-hero {
        position: relative;
        overflow: hidden;
        padding: 70px 20px;
        background:
            radial-gradient(
                circle at 85% 20%,
                rgba(243, 120, 32, 0.28),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #082f63 0%,
                #174e92 58%,
                #1f5ca9 100%
            );
    }

    .privacy-hero::before {
        content: "";
        position: absolute;
        top: -110px;
        right: -80px;
        width: 280px;
        height: 280px;
        border: 55px solid rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .privacy-hero::after {
        content: "";
        position: absolute;
        bottom: -120px;
        left: -70px;
        width: 270px;
        height: 270px;
        border: 45px solid rgba(243, 120, 32, 0.12);
        border-radius: 50%;
    }

    .privacy-hero-content {
        position: relative;
        z-index: 2;
        width: min(1050px, 100%);
        margin: 0 auto;
        text-align: center;
    }

    .privacy-hero h1 {
        position: relative;
        margin: 0 0 22px;
        padding-bottom: 19px;
        color: #ffffff;
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -1px;
        text-transform: uppercase;
    }

    .privacy-hero h1::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 65px;
        height: 4px;
        border-radius: 20px;
        background: #f37820;
        transform: translateX(-50%);
    }

    .privacy-hero p {
        max-width: 950px;
        margin: 0 auto;
        color: rgba(255, 255, 255, 0.92);
        font-size: 16px;
        font-weight: 400;
        line-height: 1.8;
    }

    /* ==================================================
       CONTENT AREA
    ================================================== */

    .privacy-content {
        position: relative;
        z-index: 3;
        padding: 65px 0 80px;
    }

    .privacy-content .container {
        max-width: 1140px;
    }

    /* ==================================================
       POLICY CARD
    ================================================== */

    .privacy-card {
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
        padding: 27px 30px;
        border: 1px solid rgba(15, 54, 105, 0.08);
        border-left: 5px solid #f37820;
        border-radius: 0 16px 16px 0;
        background:
            radial-gradient(
                circle at 100% 0%,
                rgba(243, 120, 32, 0.035),
                transparent 28%
            ),
            #ffffff;
        box-shadow:
            0 14px 38px rgba(9, 45, 89, 0.07);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            border-color 0.25s ease;
    }

    .privacy-card:hover {
        border-left-color: #1f5ca9;
        transform: translateY(-3px);
        box-shadow:
            0 20px 45px rgba(9, 45, 89, 0.11);
    }

    .privacy-card::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 80px;
        border-radius: 0 0 0 100%;
        background: rgba(243, 120, 32, 0.035);
        pointer-events: none;
    }

    /* ==================================================
       HEADINGS
    ================================================== */

    .privacy-card h2 {
        position: relative;
        z-index: 1;
        margin: 0 0 13px;
        color: #f37820;
        font-size: 20px;
        font-weight: 800;
        line-height: 1.4;
    }

    .privacy-card h3 {
        margin: 13px 0 8px;
        color: #082f63;
        font-size: 16px;
        font-weight: 800;
        line-height: 1.5;
    }

    /* ==================================================
       TEXT
    ================================================== */

    .privacy-card p {
        margin: 0 0 8px;
        color: #5e6876;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.75;
    }

    .privacy-card p:last-child {
        margin-bottom: 0;
    }

    /* ==================================================
       LIST
    ================================================== */

    .privacy-card ul {
        margin: 8px 0 13px;
        padding: 0;
        list-style: none;
    }

    .privacy-card ul:last-child {
        margin-bottom: 0;
    }

    .privacy-card ul li {
        position: relative;
        margin-bottom: 8px;
        padding-left: 20px;
        color: #5e6876;
        font-size: 15px;
        line-height: 1.6;
    }

    .privacy-card ul li:last-child {
        margin-bottom: 0;
    }

    .privacy-card ul li::before {
        content: "";
        position: absolute;
        top: 10px;
        left: 2px;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f37820;
        box-shadow: 0 0 0 3px rgba(243, 120, 32, 0.10);
    }

    /* ==================================================
       FIRST CARD
    ================================================== */

    .privacy-card:first-child {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    /* ==================================================
       NUMBER BADGE
    ================================================== */

    .privacy-title-row {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 13px;
    }

    .privacy-number {
        display: inline-flex;
        flex: 0 0 32px;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 9px;
        background: rgba(243, 120, 32, 0.10);
        color: #f37820;
        font-size: 13px;
        font-weight: 800;
    }

    .privacy-title-row h2 {
        margin: 0;
    }

    /* ==================================================
       RESPONSIVE
    ================================================== */

    @media (max-width: 991px) {
        .privacy-hero {
            padding: 60px 20px;
        }

        .privacy-content {
            padding: 50px 0 65px;
        }
    }

    @media (max-width: 767px) {
        .privacy-hero {
            padding: 48px 18px;
        }

        .privacy-hero h1 {
            margin-bottom: 17px;
            padding-bottom: 16px;
            font-size: 31px;
        }

        .privacy-hero p {
            font-size: 14px;
            line-height: 1.7;
        }

        .privacy-content {
            padding: 38px 0 50px;
        }

        .privacy-content .container {
            padding-right: 16px;
            padding-left: 16px;
        }

        .privacy-card {
            margin-bottom: 15px;
            padding: 22px 18px;
            border-left-width: 4px;
            border-radius: 0 13px 13px 0;
        }

        .privacy-card h2 {
            font-size: 17px;
        }

        .privacy-card h3 {
            font-size: 15px;
        }

        .privacy-card p,
        .privacy-card ul li {
            font-size: 14px;
        }

        .privacy-number {
            flex-basis: 29px;
            width: 29px;
            height: 29px;
        }
    }

    @media (max-width: 420px) {
        .privacy-hero {
            padding: 40px 15px;
        }

        .privacy-hero h1 {
            font-size: 27px;
        }

        .privacy-card {
            padding: 20px 15px;
        }
    }
</style>


<div class="optic-privacy-page">

    <!-- ==================================================
         PRIVACY POLICY HERO
    ================================================== -->

    <section class="privacy-hero">
        <div class="privacy-hero-content">

            <h1>Privacy Policy</h1>

            <p>
                Aries Events Pvt. Ltd. respects the privacy of all visitors to the
                Optic Expo website. This Privacy Policy explains how we collect,
                use, and protect your personal information.
            </p>

        </div>
    </section>


    <!-- ==================================================
         PRIVACY POLICY CONTENT
    ================================================== -->

    <section class="privacy-content">
        <div class="container">


            <!-- 1. INFORMATION WE COLLECT -->

            <div class="privacy-card">

                <div class="privacy-title-row">
                    <span class="privacy-number">01</span>
                    <h2>Information We Collect</h2>
                </div>

                <p>
                    When you interact with our website, we may collect the
                    following information:
                </p>

                <h3>Personal Information</h3>

                <ul>
                    <li>Name</li>
                    <li>Email address</li>
                    <li>Phone number</li>
                    <li>Company name</li>
                    <li>City / Location</li>
                </ul>

                <p>
                    This information may be collected when you:
                </p>

                <ul>
                    <li>Register for the exhibition</li>
                    <li>Submit enquiry forms</li>
                    <li>Subscribe to updates</li>
                    <li>Contact us through the website</li>
                </ul>

                <h3>Automatically Collected Information</h3>

                <p>
                    We may automatically collect technical data such as:
                </p>

                <ul>
                    <li>IP address</li>
                    <li>Browser type</li>
                    <li>Device information</li>
                    <li>Pages visited</li>
                    <li>Website usage patterns</li>
                </ul>

            </div>


            <!-- 2. HOW WE USE INFORMATION -->

            <div class="privacy-card">

                <div class="privacy-title-row">
                    <span class="privacy-number">02</span>
                    <h2>How We Use Your Information</h2>
                </div>

                <p>
                    We use the collected information to:
                </p>

                <ul>
                    <li>Respond to your enquiries</li>
                    <li>Provide event updates and information</li>
                    <li>Improve website functionality</li>
                    <li>Communicate regarding the exhibition</li>
                    <li>Manage registrations and enquiries</li>
                </ul>

            </div>


            <!-- 3. DATA PROTECTION -->

            <div class="privacy-card">

                <div class="privacy-title-row">
                    <span class="privacy-number">03</span>
                    <h2>Data Protection</h2>
                </div>

                <p>
                    We implement appropriate technical and administrative
                    measures to protect your personal information against
                    unauthorized access, misuse, or disclosure.
                </p>

                <p>
                    However, no online platform can guarantee complete security.
                </p>

            </div>


            <!-- 4. COOKIES POLICY -->

            <div class="privacy-card">

                <div class="privacy-title-row">
                    <span class="privacy-number">04</span>
                    <h2>Cookies Policy</h2>
                </div>

                <p>
                    Our website may use cookies to improve user experience
                    and analyze website traffic.
                </p>

                <p>
                    Cookies help us understand how visitors interact with our
                    website and allow us to improve performance.
                </p>

                <p>
                    Users can disable cookies through their browser settings.
                </p>

            </div>


            <!-- 5. THIRD-PARTY SERVICES -->

            <div class="privacy-card">

                <div class="privacy-title-row">
                    <span class="privacy-number">05</span>
                    <h2>Third-Party Services</h2>
                </div>

                <p>
                    We may use third-party services such as:
                </p>

                <ul>
                    <li>Analytics tools</li>
                    <li>Email communication platforms</li>
                    <li>Website hosting providers</li>
                </ul>

                <p>
                    These services may process limited data to help operate
                    the website effectively.
                </p>

            </div>


            <!-- 6. EXTERNAL LINKS -->

            <div class="privacy-card">

                <div class="privacy-title-row">
                    <span class="privacy-number">06</span>
                    <h2>External Links</h2>
                </div>

                <p>
                    Our website may contain links to third-party websites.
                    Once you leave our website, we are not responsible for
                    the privacy practices of those websites.
                </p>

            </div>


            <!-- 7. CHILDREN PRIVACY -->

            <div class="privacy-card">

                <div class="privacy-title-row">
                    <span class="privacy-number">07</span>
                    <h2>Children’s Privacy</h2>
                </div>

                <p>
                    Our website and services are intended for business
                    professionals. We do not knowingly collect personal
                    information from individuals under the age of 18.
                </p>

            </div>


            <!-- 8. POLICY UPDATES -->

            <div class="privacy-card">

                <div class="privacy-title-row">
                    <span class="privacy-number">08</span>
                    <h2>Policy Updates</h2>
                </div>

                <p>
                    We may update this Privacy Policy periodically.
                    Updates will be posted on this page with the revised date.
                </p>

            </div>


        </div>
    </section>

</div>

@endsection