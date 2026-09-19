@extends('layouts.front')

@section('content')

<style>
    /* =========================================================
       OPTIC EXPO - TERMS & CONDITIONS PAGE
    ========================================================= */

    .optic-terms-page {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(
                circle at 0% 20%,
                rgba(243, 120, 32, 0.07),
                transparent 25%
            ),
            radial-gradient(
                circle at 100% 70%,
                rgba(16, 73, 137, 0.08),
                transparent 28%
            ),
            #f6f9fd;
    }


    /* =========================================================
       HERO SECTION
    ========================================================= */

    .terms-hero {
        position: relative;
        overflow: hidden;
        padding: 75px 20px;
        background:
            radial-gradient(
                circle at 88% 20%,
                rgba(243, 120, 32, 0.25),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #082f63 0%,
                #15589f 55%,
                #1f66b5 100%
            );
    }

    .terms-hero::before {
        content: "";
        position: absolute;
        top: -120px;
        right: -70px;
        width: 310px;
        height: 310px;
        border: 55px solid rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .terms-hero::after {
        content: "";
        position: absolute;
        bottom: -135px;
        left: -80px;
        width: 300px;
        height: 300px;
        border: 45px solid rgba(243, 120, 32, 0.12);
        border-radius: 50%;
    }

    .terms-hero-inner {
        position: relative;
        z-index: 2;
        width: min(1050px, 100%);
        margin: 0 auto;
        text-align: center;
    }

    .terms-hero h1 {
        position: relative;
        margin: 0 0 24px;
        padding-bottom: 20px;
        color: #ffffff;
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.7px;
    }

    .terms-hero h1::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 70px;
        height: 4px;
        border-radius: 20px;
        background: #f37820;
        transform: translateX(-50%);
    }

    .terms-hero p {
        max-width: 1050px;
        margin: 0 auto;
        color: rgba(255, 255, 255, 0.93);
        font-size: 15px;
        font-weight: 400;
        line-height: 1.85;
    }

    .terms-hero p strong {
        color: #ffffff;
        font-weight: 700;
    }


    /* =========================================================
       CONTENT AREA
    ========================================================= */

    .terms-content {
        position: relative;
        z-index: 2;
        padding: 65px 0 80px;
    }

    .terms-content .container {
        max-width: 1140px;
    }


    /* =========================================================
       TERMS CARD
    ========================================================= */

    .terms-card {
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
        padding: 28px 30px;
        border: 1px solid rgba(12, 49, 95, 0.08);
        border-left: 5px solid #f37820;
        border-radius: 0 17px 17px 0;
        background:
            radial-gradient(
                circle at 100% 0%,
                rgba(243, 120, 32, 0.04),
                transparent 30%
            ),
            #ffffff;
        box-shadow:
            0 14px 38px rgba(8, 42, 84, 0.07);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            border-color 0.25s ease;
    }

    .terms-card:hover {
        border-left-color: #15589f;
        transform: translateY(-3px);
        box-shadow:
            0 20px 48px rgba(8, 42, 84, 0.11);
    }

    .terms-card::before {
        content: "";
        position: absolute;
        top: -35px;
        right: -35px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(243, 120, 32, 0.035);
        pointer-events: none;
    }


    /* =========================================================
       CARD TITLE
    ========================================================= */

    .terms-title-row {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 13px;
    }

    .terms-number {
        display: inline-flex;
        flex: 0 0 34px;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: rgba(243, 120, 32, 0.11);
        color: #f37820;
        font-size: 13px;
        font-weight: 800;
        line-height: 1;
    }

    .terms-card h2 {
        margin: 0;
        color: #0b3c75;
        font-size: 19px;
        font-weight: 800;
        line-height: 1.4;
    }


    /* =========================================================
       CONTENT TEXT
    ========================================================= */

    .terms-card p {
        margin: 0 0 8px;
        color: #5d6876;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.75;
    }

    .terms-card p:last-child {
        margin-bottom: 0;
    }

    .terms-card strong {
        color: #183f6c;
        font-weight: 700;
    }


    /* =========================================================
       LISTS
    ========================================================= */

    .terms-card ul {
        margin: 8px 0 10px;
        padding: 0;
        list-style: none;
    }

    .terms-card ul li {
        position: relative;
        margin-bottom: 8px;
        padding-left: 21px;
        color: #5d6876;
        font-size: 15px;
        line-height: 1.6;
    }

    .terms-card ul li:last-child {
        margin-bottom: 0;
    }

    .terms-card ul li::before {
        content: "";
        position: absolute;
        top: 9px;
        left: 2px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f37820;
        box-shadow: 0 0 0 3px rgba(243, 120, 32, 0.11);
    }


    /* =========================================================
       SPECIAL FINAL CARD
    ========================================================= */

    .terms-card:last-child {
        margin-bottom: 0;
    }

    .terms-card:last-child {
        background:
            radial-gradient(
                circle at 100% 0%,
                rgba(21, 88, 159, 0.06),
                transparent 32%
            ),
            #ffffff;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .terms-hero {
            padding: 60px 20px;
        }

        .terms-content {
            padding: 50px 0 65px;
        }
    }


    @media (max-width: 767px) {

        .terms-hero {
            padding: 48px 18px;
        }

        .terms-hero h1 {
            margin-bottom: 18px;
            padding-bottom: 17px;
            font-size: 31px;
        }

        .terms-hero p {
            font-size: 14px;
            line-height: 1.7;
        }

        .terms-content {
            padding: 38px 0 50px;
        }

        .terms-content .container {
            padding-right: 16px;
            padding-left: 16px;
        }

        .terms-card {
            margin-bottom: 15px;
            padding: 22px 18px;
            border-left-width: 4px;
            border-radius: 0 13px 13px 0;
        }

        .terms-title-row {
            gap: 9px;
            margin-bottom: 11px;
        }

        .terms-number {
            flex-basis: 30px;
            width: 30px;
            height: 30px;
            font-size: 11px;
        }

        .terms-card h2 {
            font-size: 17px;
        }

        .terms-card p,
        .terms-card ul li {
            font-size: 14px;
            line-height: 1.65;
        }
    }


    @media (max-width: 420px) {

        .terms-hero {
            padding: 40px 15px;
        }

        .terms-hero h1 {
            font-size: 27px;
        }

        .terms-card {
            padding: 20px 15px;
        }

        .terms-title-row {
            align-items: flex-start;
        }
    }
</style>


<div class="optic-terms-page">


    {{-- =========================================================
         HERO
    ========================================================= --}}

    <section class="terms-hero">

        <div class="terms-hero-inner">

            <h1>Terms & Conditions</h1>

            <p>
                Welcome to the official website of
                <strong>Optic Expo</strong>, operated by
                <strong>Aries Events Pvt. Ltd.</strong>
                By accessing or using this website, you agree to comply with
                the following Terms and Conditions. If you do not agree with
                these terms, please do not use this website.
            </p>

        </div>

    </section>


    {{-- =========================================================
         TERMS CONTENT
    ========================================================= --}}

    <section class="terms-content">

        <div class="container">


            {{-- 1 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">01</span>
                    <h2>About the Website</h2>
                </div>

                <p>
                    This website provides information related to
                    <strong>Optic Expo</strong>, including event details,
                    exhibitor information, visitor registration, industry
                    updates, and related services.
                    The website is owned and managed by
                    <strong>Aries Events Pvt. Ltd.</strong>,
                    Ahmedabad, India.
                </p>

            </div>


            {{-- 2 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">02</span>
                    <h2>Acceptance of Terms</h2>
                </div>

                <p>
                    By accessing this website, you confirm that you have read,
                    understood, and agreed to these Terms & Conditions along
                    with our Privacy Policy. These terms apply to all visitors,
                    exhibitors, partners, and users who access the website.
                </p>

            </div>


            {{-- 3 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">03</span>
                    <h2>Use of Website</h2>
                </div>

                <p>
                    Users agree to use this website only for lawful purposes.
                    You must not:
                </p>

                <ul>
                    <li>
                        Use the website in any way that may damage the website
                        or services.
                    </li>

                    <li>
                        Attempt unauthorized access to any part of the website.
                    </li>

                    <li>
                        Upload harmful software, malware, or malicious content.
                    </li>

                    <li>
                        Copy or misuse any information without permission.
                    </li>
                </ul>

            </div>


            {{-- 4 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">04</span>
                    <h2>Intellectual Property</h2>
                </div>

                <p>
                    All content available on this website including:
                </p>

                <ul>
                    <li>Text</li>
                    <li>Images</li>
                    <li>Graphics</li>
                    <li>Logos</li>
                    <li>Designs</li>
                    <li>Event information</li>
                </ul>

                <p>
                    is the intellectual property of
                    <strong>Aries Events Pvt. Ltd.</strong>
                    and is protected by applicable copyright and trademark laws.
                </p>

                <p>
                    Users may not reproduce, distribute, or modify any content
                    without prior written permission.
                </p>

            </div>


            {{-- 5 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">05</span>
                    <h2>Event Information Disclaimer</h2>
                </div>

                <p>
                    While we strive to ensure that all event information is
                    accurate, <strong>Aries Events Pvt. Ltd.</strong>
                    reserves the right to:
                </p>

                <ul>
                    <li>Modify event schedules</li>
                    <li>Change venue or dates</li>
                    <li>Update exhibitor information</li>
                    <li>Make corrections to the website</li>
                </ul>

                <p>
                    without prior notice.
                </p>

                <p>
                    Participation in the event does not guarantee specific
                    business results, sales, or leads.
                </p>

            </div>


            {{-- 6 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">06</span>
                    <h2>Registration and Participation</h2>
                </div>

                <p>
                    When users register through this website, they agree to
                    provide accurate and complete information.
                </p>

                <p>
                    Events Pvt. Ltd. reserves the right to reject or cancel
                    registrations if incorrect or misleading information is
                    provided.
                </p>

            </div>


            {{-- 7 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">07</span>
                    <h2>Third-Party Links</h2>
                </div>

                <p>
                    This website may contain links to third-party websites for
                    additional information or services.
                </p>

                <p>
                    Events Pvt. Ltd. is not responsible for the content,
                    policies, or practices of these external websites.
                </p>

            </div>


            {{-- 8 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">08</span>
                    <h2>Limitation of Liability</h2>
                </div>

                <p>
                    Events Pvt. Ltd. shall not be liable for:
                </p>

                <ul>
                    <li>
                        Any direct or indirect damages arising from website use
                    </li>

                    <li>
                        Loss of data or information
                    </li>

                    <li>
                        Technical interruptions or errors
                    </li>

                    <li>
                        External website links
                    </li>
                </ul>

                <p>
                    Users access this website at their own risk.
                </p>

            </div>


            {{-- 9 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">09</span>
                    <h2>Changes to Terms</h2>
                </div>

                <p>
                    We may update these Terms & Conditions from time to time.
                    Updated versions will be published on this page.
                </p>

                <p>
                    Continued use of the website indicates acceptance of the
                    revised terms.
                </p>

            </div>


            {{-- 10 --}}

            <div class="terms-card">

                <div class="terms-title-row">
                    <span class="terms-number">10</span>
                    <h2>Governing Law</h2>
                </div>

                <p>
                    These Terms & Conditions are governed by the laws of
                    <strong>India</strong>. All disputes fall under the
                    jurisdiction of the courts of
                    <strong>Ahmedabad, Gujarat.</strong>
                </p>

            </div>


        </div>

    </section>

</div>

@endsection