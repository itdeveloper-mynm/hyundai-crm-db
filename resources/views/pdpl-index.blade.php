<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Define the Fonts */
        @font-face {
            font-family: 'NotoSansArabic-Regular';
            src: url({{asset('pdpl_assets/arabic-fonts/HyundaiSansHead-Medium.871df8d7.woff2')}}) format('woff2');
        }

        @font-face {
            font-family: 'NotoSansArabic-Medium';
            src: url({{asset('pdpl_assets/arabic-fonts/HyundaiSansHead-Regular.403cd6bb.woff2')}}) format('woff2');
        }

        @font-face {
            font-family: 'HyundaiSansHead-Medium';
            src: url({{asset('pdpl_assets/arabic-fonts/NotoSansArabic-Medium.aa13d1f9.woff2')}}) format('woff2');
        }

        @font-face {
            font-family: 'HyundaiSansHead-Regular';
            src: url({{asset('pdpl_assets/arabic-fonts/NotoSansArabic-Regular.cfc2a710.woff')}}) format('woff2');
        }

        @font-face {
            font-family: 'HyundaiSansHead-Medium-English';
            src: url({{asset('pdpl_assets/english-fonts/HyundaiSansHead-Medium.871df8d7.woff2')}}) format('woff2');
        }

        @font-face {
            font-family: 'HyundaiSansHead-Regular-English';
            src: url({{asset('pdpl_assets/english-fonts/HyundaiSansHead-Regular.403cd6bb.woff2')}}) format('woff2');
        }

        .rtl body {
            font-family: 'NotoSansArabic-Regular', 'HyundaiSansHead-Regular', sans-serif;
        }

        /* Arabic Font Family */
        .arabic-font-family {
            font-family: 'NotoSansArabic-Regular', 'HyundaiSansHead-Regular', sans-serif !important;
        }

        /* Specific to Arabic Accordion */
        #accordionExample2 {
            direction: rtl;
            /* Ensures text direction is right-to-left */
        }

        #accordionExample2 .accordion-button,
        #accordionExample2 .accordion-body,
        #accordionExample2 label,
        #accordionExample2 button {
            font-family: 'HyundaiSansHead-Medium', sans-serif !important;
        }

        /* Arabic Accordion Arrow Alignment */
        #accordionExample2 .accordion-button::after {
            position: absolute;
            left: 1rem;
            right: auto;
        }



        .rtl h1,
        .rtl h2,
        .rtl h3,
        .rtl h4,
        .rtl h5,
        .rtl h6,
        .rtl p,
        .rtl input,
        .rtl label,
        .rtl span,
        .rtl a {
            font-family: 'HyundaiSansHead-Medium', 'NotoSansArabic-Medium', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        input,
        label,
        span,
        a {
            font-family: 'HyundaiSansHead-Regular-English', sans-serif;
        }

        body,
        html {
            height: 100%;
            background-color: #F5F3F2;
            font-family: 'HyundaiSansHead-Medium-English', sans-serif;
        }

        .question-bg,
        .button-bg {
            background-color: #002C5F;
            color: #fff;
        }

        .button-bg:hover {
            border: 1px solid #002C5F;
            color: #002C5F;
        }

        .footer-hyundai {
            width: 100%;
            background-color: #1B1B1B;
            color: #fff;
            padding: 20px 0;
        }

        .footer-hyundai .logo {
            max-height: 100px;
        }

        .footer-hyundai .social-icons a {
            color: #fff;
            margin: 0 5px;
            font-size: 14px;
            text-decoration: none;
        }

        .footer-hyundai .privacy-policy {
            margin-top: 20px;
            text-align: center;
        }

        .footer-hyundai .privacy-policy a {
            color: #fff;
            text-decoration: none;
        }

        .footer-hyundai .text {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }

        .font-28 {
            font-size: 28px !important;
            color: #fff;
            text-decoration: none;
        }

        .padding-block {
            padding-block: 96px;
        }

        .font-size-14 {
            font-size: 14px;
        }

        .font-size-12 {
            font-size: 12px;
        }

        @media screen and (max-width: 768px) {
            .padding-block {
                padding-block: 26px;
            }

            .custom-order-0 {
                order: 0;
            }

            .custom-order-1 {
                order: 1;
            }

            .custom-order-2 {
                order: 2;
            }

            .custom-order-3 {
                order: 3;
            }

            .mobile-justify-around {
                justify-content: space-around !important;
            }

        }

        .rtl {
            direction: rtl;
        }

        .rtl .navbar-brand {
            margin-left: auto;
            margin-right: 0;
        }

        .rtl .navbar-text {
            margin-right: auto !important;
            margin-left: 0 !important;
        }

        .form-check-input[type=radio] {
            border: 1px solid #002C5F;
        }

        .form-check-input[type=radio]:checked {
            background-color: #002C5F;
            border-color: #002C5F;
        }

        .top-btn {
            position: fixed;
            right: 10px;
            bottom: 10px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #002C5F;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .top-btn i {
            color: #fff;

        }

        .rtl .top-btn {
            right: auto;
            left: 10px;
        }

        .card {
            word-wrap: break-word;
        }

        .blue-color {
            color: #002C5F;
        }
    </style>
</head>

<body>



    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top px-4">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <svg class="logo" width="165" height="22" viewBox="0 0 165 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M86.819 19.7479V2.58845H90.4292V16.4855H96.7626C97.8846 16.4855 98.0562 16.3073 98.0562 14.8392V2.58845H101.665V15.6102C101.711 19.0561 100.762 19.7479 98.4482 19.7479H86.819ZM161.39 19.7519V2.59241H165V19.7519H161.39ZM105.274 2.58845H116.903C118.561 2.58845 120.166 2.82874 120.119 6.29443V19.7479H116.51V7.52756C116.51 6.05018 116.338 5.7386 115.216 5.7386H108.884V19.7479H105.274V2.58845ZM71.6364 2.58845L76.164 9.60301L80.6322 2.58845H85.0146L77.9658 13.5598V19.7479H74.3556V13.5572L67.2579 2.58845H71.6377H71.6364ZM50.16 2.58845H53.7689V9.35084H61.8433V2.58845H65.4522V19.7479H61.8433V12.7452H53.7689V19.7479H50.16V2.58845ZM138.721 6.29443V15.5825C138.721 18.5386 137.115 19.7479 135.113 19.7479H123.728V2.58845H135.113C138.187 2.58845 138.721 4.60846 138.721 6.29443ZM135.069 7.32688C135.069 6.38817 134.515 5.7386 133.543 5.7386H127.338V16.4605H133.543C134.958 16.3865 135.069 15.5099 135.069 14.8141V7.3282V7.32688ZM157.781 2.59109V19.7519H154.173V14.8194H145.939V19.7519H142.33V6.29839C142.33 3.92192 143.262 2.59109 145.939 2.59109H157.781ZM154.173 5.74256H147.395C146.257 5.81254 145.939 6.10299 145.939 7.53152V11.4659H154.173V5.74388V5.74256ZM36.3699 3.43342C39.2027 5.02302 42.409 7.8167 42.0737 11.5425C41.6869 14.995 38.5466 17.4058 35.7416 18.8567C27.5537 22.8703 16.0512 22.9958 7.59527 19.4878C4.73747 18.2679 1.53118 16.174 0.327345 13.0225C-0.592695 10.4348 0.529305 7.73484 2.41295 5.9406C6.35183 2.26895 11.3744 1.0081 16.5449 0.281951C22.1549 -0.417788 28.0592 0.200095 33.0831 1.96661C34.2052 2.39173 35.3139 2.85779 36.3686 3.4321L36.3699 3.43342ZM31.7486 3.32384C28.3958 2.36533 24.8688 1.78969 21.1279 1.81874C19.3908 1.84514 18.1355 3.50207 17.4279 4.91344C16.8933 6.03566 16.2795 7.37837 16.7323 8.66695C16.9739 9.09075 17.3606 9.37989 17.7883 9.48815C19.6178 9.89875 21.2744 9.15808 22.9178 8.7488C26.1505 7.66619 29.3172 6.43306 32.0813 4.21502C32.2014 4.06451 32.4152 3.914 32.3083 3.68031C32.1895 3.47435 31.9479 3.43342 31.7486 3.32384ZM14.3154 2.66635C14.2217 2.48943 13.9801 2.51584 13.794 2.51584C12.0041 2.80366 10.3065 3.31064 8.67767 3.94172C5.92547 5.1326 2.62546 6.88591 1.81102 10.1734C1.30414 12.6938 3.06634 14.8167 5.01731 16.1317C5.40407 16.3086 5.81855 16.8579 6.24623 16.4473C8.43743 11.7207 10.7474 6.96777 14.2613 2.87231L14.3141 2.66635H14.3154ZM37.6266 6.28387C37.1448 5.9538 36.7171 5.47455 36.1165 5.42042C36.0019 5.46118 35.9003 5.53183 35.8222 5.62506C35.1743 7.10369 34.4792 8.56114 33.7379 9.99513C32.1222 13.1875 30.2795 16.3377 27.8467 19.1446L27.8071 19.3373C27.8335 19.5024 28.0077 19.4746 28.1147 19.4878C29.8241 19.3241 31.4015 18.7749 32.9643 18.2415C35.8354 17.0902 39.4416 15.2828 40.2705 11.8857C40.7787 9.58453 39.2819 7.68071 37.6253 6.28255L37.6266 6.28387ZM25.4562 13.5427C25.2423 12.967 24.6417 12.5432 24.0398 12.4601C22.5839 12.2686 21.2071 12.6792 19.9122 13.0621C16.4406 14.2556 12.9254 15.3911 9.97259 17.8441C9.84059 17.9682 9.74687 18.1438 9.81419 18.3366C9.89923 18.4717 10.0322 18.5698 10.1864 18.6112C13.5216 19.6341 16.9851 20.1782 20.4732 20.2272C22.0638 20.3922 23.3851 19.2964 24.1863 18.0223C24.9084 16.6519 25.7769 15.2419 25.4562 13.5427Z"
                        fill="#002C5E"></path>
                </svg>
            </a>

            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

            <div class="" id="navbarText">

                <a class="navbar-text ms-auto blue-color" href="javascript:void(0)"
                    style="text-decoration: none; display: none;" id="show-arabic">
                    <i class="fa-solid fa-earth-europe"></i> العربية
                </a>

                <a class="navbar-text ms-auto blue-color" href="javascript:void(0)"
                    style="text-decoration: none; display: none;" id="show-english">
                    <i class="fa-solid fa-earth-europe"></i> Eng
                </a>
            </div>
        </div>
    </nav>








        <main id="english-div" style="display: none;">

            <!-- form -->
            <section class="bg-light d-flex align-items-center justify-content-center min-vh-100"
                style="padding-top: 70px;">
                <div class="container">
                    @if ($existchk == true)
                       <div class="row">
                            <div class="alert alert-danger col-md-6 offset-md-3" role="alert">
                               Please do not modify the URL values. Click the link again and proceed.
                            </div>
                       </div>
                    @else
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-10 col-md-8"> <!-- Ensure responsiveness -->
                                <!-- First Accordion -->
                                <div class="accordion" id="accordionExample1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Consent
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                                            <div class="accordion-body">
                                                <form action="{{route('pdplFormSubmit')}}" method="POST" id="eng-Form">
                                                    @csrf
                                                    <!-- Question 1 -->
                                                    <div class="mb-3">
                                                        <label class="form-label fw-500">
                                                            By accepting, I authorize Hyundai - Mohamed Yousuf Naghi Motors and
                                                            its affiliates to contact me by mail or email for marketing
                                                            purposes. In addition, by providing my telephone number and
                                                            submitting, I consent to receive calls and automated telephone
                                                            and/or text messages from Mohamed Yousuf Naghi Motors and its
                                                            affiliates for marketing purposes. I understand that my consent is
                                                            not a condition to purchase any product or service and that I may
                                                            revoke my consent at any time. Please visit Mohamed Yousuf Naghi -
                                                            <a href="https://www.hyundai.com/mynaghi/en/utility/privacy-policy"
                                                                target="_blank">Privacy Policy </a> for information about how we
                                                            collect, use and protect your data.</label>
                                                        <div class="text-center mt-3 mb-3">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="confirmation"
                                                                    id="yes1" value="Yes" checked required>
                                                                <label class="form-check-label fw-bold" for="yes1">Agree</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="confirmation"
                                                                    id="no1" value="No">
                                                                <label class="form-check-label fw-bold"
                                                                    for="no1">Disagree</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <div class="text-center">
                                                        <button type="submit" class="btn button-bg">Send</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>



            <!-- footer -->
            <footer class="footer-hyundai">
                <div class="container padding-block">
                    <div class="row text-center align-items-center">
                        <!-- First Logo -->
                        <div class="col-md-4 mt-4 d-flex justify-content-md-start justify-content-center custom-order-1">
                            <a href="https://www.hyundai.com/mynaghi/en" target="_blank">
                                <img src="{{asset('pdpl_assets/assets/logo/Jeddah.png')}}" alt="Logo 1" class="logo">
                            </a>
                        </div>

                        <!-- Social Media Icons -->
                        <div
                            class="col-md-4 social-icons mt-4 flex-wrap custom-order-2 d-flex align-items-center justify-content-between mobile-justify-around">
                            <a class="mb-0 font-28" href="tel:8001240191">8001240191</a>
                            <div>
                                <a href="https://www.facebook.com/MYNaghiHyundai/" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="https://www.youtube.com/c/hyundaisaudi" target="_blank">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                <a href="https://www.instagram.com/MYNaghiHyundai/" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="https://x.com/MYNaghiHyundai/" target="_blank">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Second Logo -->
                        <div class="col-md-4 mt-4 d-flex justify-content-md-end justify-content-center custom-order-0">
                            <a href="https://www.hyundai.com/mynaghi/en" target="_blank">
                                <img src="{{asset('pdpl_assets/assets/logo/logo-w.svg')}}" alt="Logo 2" class="logo">
                            </a>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5">
                        <!-- Text -->
                        <div class="col-md-8 text-center">
                            <div class="text">
                                <p class="font-size-14">All specifications and descriptions provided herein may be different
                                    from the actual
                                    specifications
                                    and descriptions for the product. Hyundai is a registered trademark of Hyundai Motor
                                    Company.
                                    All
                                    rights reserved, Hyundai Motor Middle East & Africa.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Policy -->
                    <div class="privacy-policy text-center">
                        <a class="font-size-14" href="https://promotionsbyhyundai.com/Jeddah/en/privacy-policy"
                            target="_blank">
                            Privacy Policy
                        </a>
                    </div>
                </div>
            </footer>

        </main>




        <div class="arabic" id="arabic-div">


            <!-- form -->
            <section class="bg-light d-flex align-items-center justify-content-center min-vh-100"
                style="padding-top: 70px;">
                <div class="container">
                    @if ($existchk == true)
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="alert alert-danger col-md-6" role="alert">
                                <b>يرجى عدم تعديل قيم الرابط. انقر على الرابط مرة أخرى وتابع.</b>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    @else
                        <div class="row justify-content-center">
                            <div class="col-md-8">

                                <!-- Second Accordion -->
                                <div class="accordion mt-5 arabic-font-family" id="accordionExample2" dir="rtl">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseThree" aria-expanded="true"
                                                aria-controls="collapseThree">
                                                موافقة
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse show"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample2">
                                            <div class="accordion-body">
                                                <form action="{{route('pdplFormSubmit')}}" method="POST" id="ar-Form">
                                                        @csrf
                                                    <!-- Question 1 -->
                                                    <div class="mb-3">
                                                        <label class="form-label fw-500">بقبولي، فإنني أوافق على أن تقوم هيونداي
                                                            شركة محمد يوسف ناغي للسيارات والشركات التابعة لها بالتواصل معي عبر
                                                            البريد أو البريد الإلكتروني لأغراض تسويقية. بالإضافة إلى ذلك، من
                                                            خلال تقديم رقم هاتفي وتقديم الطلب، فإنني أوافق على تلقي المكالمات
                                                            والرسائل النصية التلقائية من شركة محمد يوسف ناغي للسيارات والشركات
                                                            التابعة لها
                                                            لأغراض تسويقية. أفهم أن موافقتي ليست شرطًا لشراء أي منتج أو خدمة
                                                            وأنه يمكنني إلغاء موافقتي في أي وقت. يرجى زيارة <a
                                                                href="https://www.hyundai.com/mynaghi/ar/utility/privacy-policy"
                                                                target="_blank">
                                                                سياسة الخصوصية </a> لشركة محمد يوسف ناغي لمزيد من المعلومات حول
                                                            كيفية جمع بياناتك واستخدامها وحمايتها.</label>
                                                        <div class="text-center">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="confirmation"
                                                                    id="yes1" value="Yes" checked required>
                                                                <label class="form-check-label fw-bold" for="yes1">موافق</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="confirmation"
                                                                    id="no1" value="No">
                                                                <label class="form-check-label fw-bold" for="no1">غير
                                                                    موافق</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Submit Button -->
                                                    <div class="text-center">
                                                        <button type="submit" class="btn button-bg">إرسال</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            <!-- footer -->
            <footer class="footer-hyundai">
                <div class="container padding-block">
                    <div class="row text-center align-items-center">
                        <!-- First Logo -->
                        <div class="col-md-4 mt-4 d-flex justify-content-md-start justify-content-center custom-order-1">
                            <a href="https://www.hyundai.com/mynaghi/ar" target="_blank">
                                <img src="{{asset('pdpl_assets/assets/logo/Jeddah.png')}}" alt="الشعار 1" class="logo">
                            </a>
                        </div>

                        <!-- Social Media Icons -->
                        <div
                            class="col-md-4 social-icons mt-4 flex-wrap custom-order-2 d-flex align-items-center justify-content-between mobile-justify-around">
                            <a class="mb-0 font-28" href="tel:8001240191">8001240191</a>
                            <div>
                                <a href="https://www.facebook.com/MYNaghiHyundai/" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="https://www.youtube.com/c/hyundaisaudi" target="_blank">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                <a href="https://www.instagram.com/MYNaghiHyundai/" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="https://x.com/MYNaghiHyundai/" target="_blank">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Second Logo -->
                        <div class="col-md-4 mt-4 d-flex justify-content-md-end justify-content-center custom-order-0">
                            <a href="https://www.hyundai.com/mynaghi/ar" target="_blank">
                                <img src="{{asset('pdpl_assets/assets/logo/logo-w.svg')}}" alt="الشعار 2" class="logo">
                            </a>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5">
                        <!-- Text -->
                        <div class="col-md-8 text-center">
                            <div class="text">
                                <p class="font-size-14">
                                    قد تختلف جميع المواصفات والأوصاف الواردة هنا عن المواصفات والأوصاف الفعلية للمنتج.
                                    هيونداي علامة تجارية مسجلة لشركة هيونداي موتور. جميع الحقوق محفوظة لشركة هيونداي
                                    موتور الشرق الأوسط وإفريقيا۔
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Policy -->
                    <div class="privacy-policy text-center">
                        <a class="font-size-14" href="https://promotionsbyhyundai.com/Jeddah/privacy-policy"
                            target="_blank">
                            سياسة الخصوصية
                        </a>
                    </div>
                </div>
            </footer>

        </div>





    <a href="#">
        <div class="top-btn">

            <i class="fa-solid fa-arrow-up"></i>

        </div>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Get elements
        const englishDiv = document.getElementById('english-div');
        const arabicDiv = document.getElementById('arabic-div');
        const showArabic = document.getElementById('show-arabic');
        const showEnglish = document.getElementById('show-english');
        const body = document.body;

        // Show Arabic content and adjust navbar for Arabic
        const toggleToArabic = () => {
            englishDiv.style.display = 'none';
            arabicDiv.style.display = 'block';
            showArabic.style.display = 'none';
            showEnglish.style.display = 'block';
            body.classList.add('rtl');
        };

        // Show English content and adjust navbar for English
        const toggleToEnglish = () => {
            arabicDiv.style.display = 'none';
            englishDiv.style.display = 'block';
            showArabic.style.display = 'block';
            showEnglish.style.display = 'none';
            body.classList.remove('rtl');
        };

        // Event Listeners
        showArabic.addEventListener('click', toggleToArabic);
        showEnglish.addEventListener('click', toggleToEnglish);

        // Initial State: Show Arabic by default
        toggleToArabic(); // Change to Arabic as the default state
    </script>

</body>

</html>


