<!-- <!DOCTYPE html> -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>RANS Office</title>
    <!-- Favicons -->
    <link href="assets_HTML/img/favicon.png" rel="icon">
    <link href="assets_HTML/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets_HTML/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets_HTML/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_HTML/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_HTML/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_HTML/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets_HTML/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets_HTML/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets_HTML/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha - v4.3.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.html"><img src="assets_HTML/img/logo.png"> </a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets_HTML/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#product">Products</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <!-- <li><a class="nav-link   scrollto" href="#portfolio">Portfolio</a></li> -->
                    <!-- <li><a class="nav-link scrollto" href="#team">Team</a></li> -->
                    <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    @if (Route :: has('login'))
                    @auth
                    <li><a class="nav-link scrollto" href="{{ url('/home')}}">Dashboard</a></li>
                    @else
                    <li><a class="nav-link scrollto" href="{{ route('login')}}">Sign in</a></li>
                    @endauth
                    @endif
                    <!-- <li><a class="getstarted scrollto" href="#about">Get Started</a></li> -->
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <h1>Best Products with Great Services for Your Business</h1>
                    <h2>We are a team of talented managers and engineers</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="assets_HTML/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Cliens Section ======= -->
        <section id="cliens" class="cliens section-bg">
            <div class="container">

                <div class="row" data-aos="zoom-in">

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="assets_HTML/img/clients/client-1.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="assets_HTML/img/clients/client-2.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="assets_HTML/img/clients/client-3.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="assets_HTML/img/clients/client-4.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="assets_HTML/img/clients/client-5.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="assets_HTML/img/clients/client-6.png" class="img-fluid" alt="">
                    </div>

                </div>

            </div>
        </section><!-- End Cliens Section -->

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About Us</h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6">
                        <p>
                            Welcome to RANS Office Automation – Your Premier Partner for Office Solutions!
                        </p>
                        <p>
                            Established in 1998, RANS Office Automation has been a trusted name in the realm of office solutions, proudly serving Uttarakhand and adjoining areas. As an authorized distributor and service partner of Xerox photocopiers, we bring decades of expertise and commitment to excellence to every client we serve.
                        </p>
                        <ul>
                            <li><i class="ri-check-double-line"></i> <b>Our Commitment:</b>
                                At RANS Office Automation, we are dedicated to providing unparalleled office solutions that empower businesses to thrive. From cutting-edge Xerox photocopiers to a comprehensive range of office supplies, including laptops, consumables, toner cartridges, and more, we ensure that our clients have access to the tools and resources they need to succeed.</li>
                            <!-- <li><i class="ri-check-double-line"></i> <b>What Sets Us Apart:</b>

                <b>Authorized Xerox Partner:</b> As an authorized distributor and service partner of Xerox photocopiers, we offer genuine products and expert service, guaranteeing optimal performance and reliability.
                <b>Nationwide Presence: </b> While our roots are in Uttarakhand, our services extend across the length and breadth of India, catering to businesses of all sizes and industries.
                <b>Comprehensive Product Range:</b> In addition to Xerox photocopiers, we specialize in providing a diverse array of office solutions, including laptops, consumables, toner cartridges, and other general order supplies, ensuring that we are your one-stop destination for all your office needs.</li> -->
                            <!-- <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li> -->
                        </ul>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">

                        <ul>
                            <li><i class="ri-check-double-line"></i> <b>Our Mission::</b>
                                At RANS Office Automation, our mission is to empower businesses with innovative solutions that streamline operations, enhance productivity, and drive growth. With a customer-centric approach and a passion for excellence, we are committed to delivering unparalleled value to every client we serve.
                            </li>
                            <li><i class="ri-check-double-line"></i> <b>Our Team:</b>
                                Behind RANS Office Automation's success is a dedicated team of professionals who are passionate about delivering exceptional service and solutions. With years of experience and expertise in the industry, our team members are always ready to go above and beyond to meet our clients' needs and exceed their expectations.
                            </li>
                        </ul>


                        <a href="#" class="btn-learn-more">Learn More</a>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us section-bg">
            <div class="container-fluid" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                        <div class="content">
                            <h3><strong>What Sets Us Apart:</strong></h3>
                            <p>
                                Join hands with RANS Office Automation and embark on a journey of success and growth. Whether you're a burgeoning startup or a well-established enterprise, we possess the resources, expertise, and dedication to become your trusted partner for all your office solutions needs.
                            </p>
                        </div>

                        <div class="accordion-list">
                            <ul>
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Authorized Xerox Partner:<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                        <p>
                                            As an authorized distributor and service partner of Xerox photocopiers, we offer genuine products and expert service, guaranteeing optimal performance and reliability.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Nationwide Presence: <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            While our roots are in Uttarakhand, our services extend across the length and breadth of India, catering to businesses of all sizes and industries.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Comprehensive Product Range with Prompt Services: <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            In addition to Xerox photocopiers, we specialize in providing a diverse array of office solutions, including laptops, consumables, toner cartridges, and other general order supplies, ensuring that we are your one-stop destination for all your office needs.
                                        </p>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets_HTML/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Skills Section ======= -->
        <section id="skills" class="skills">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="assets_HTML/img/skills.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                        <h3>Continuos Award Winning Services and Product Sales</h3>
                        <p class="fst-italic">
                            At RANS Office Automation, we take pride in being recognized as an authorized distributor and service partner of Xerox photocopiers, serving clients nationwide. Our commitment to excellence has been consistently acknowledged through awards bestowed upon us by Xerox and other esteemed clients. These accolades serve as a testament to our unwavering dedication to providing top-notch products and exceptional service. We are honored to be trusted partners in the industry, and we remain steadfast in our pursuit of exceeding expectations and delivering value to our customers.
                        </p>

                        <div class="skills-content">

                            <div class="progress">
                                <span class="skill">Products Range <i class="val">98%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">Services <i class="val">100%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">Consumables <i class="val">95%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">PR Management <i class="val">99%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End Skills Section -->

        <section id="product" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Products</h2>
                    <p>Discover a wide range of IT products with RANS Office Automation, your authorized distributor and service partner for Xerox photocopiers. Operating in Uttarakhand and adjoining area basis, we offer a comprehensive range of Xerox products alongside a curated selection of other essential office supplies. Our commitment to excellence ensures seamless operations and unparalleled service delivery, making us the preferred choice for businesses nationwide. Experience the difference with RANS Office Automation – where quality, reliability, and customer satisfaction converge for unmatched office solutions.</p>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4><a href="">Printer and Photocopier</a></h4>
                            <p>Experience unparalleled service and support nationwide with RANS Office Automation, your trusted partner for all Xerox photocopier needs and beyond.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="">Toner Cartridge</a></h4>
                            <p>Elevate your office efficiency with our comprehensive range of high-quality consumables, meticulously curated to complement your Xerox photocopiers and other office equipment, available for nationwide delivery.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4><a href="">PC, Laptops & Tabs</a></h4>
                            <p>As an authorized Xerox service center, we provide unparalleled expertise and support, ensuring swift resolution of any technical issues with your Xerox photocopiers, backed by our nationwide service network.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4><a href="">General Supply</a></h4>
                            <p>Explore our diverse range of office essentials beyond Xerox photocopiers, including top-quality laptops and other general order supplies, all available nationwide to meet your business needs seamlessly.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>









        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Services</h2>
                    <p>Discover unparalleled office solutions with RANS Office Automation, your authorized distributor and service partner for Xerox photocopiers. Operating in Uttarakhand and adjoining area basis, we offer a comprehensive range of Xerox products alongside a curated selection of other essential office supplies. Our commitment to excellence ensures seamless operations and unparalleled service delivery, making us the preferred choice for businesses nationwide. Experience the difference with RANS Office Automation – where quality, reliability, and customer satisfaction converge for unmatched office solutions.</p>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4><a href="">Product Sales</a></h4>
                            <p>Experience unparalleled service and support nationwide with RANS Office Automation, your trusted partner for all Xerox photocopier needs and beyond.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="">Consumables</a></h4>
                            <p>Elevate your office efficiency with our comprehensive range of high-quality consumables, meticulously curated to complement your Xerox photocopiers and other office equipment, available for nationwide delivery.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4><a href="">Authorised Service</a></h4>
                            <p>As an authorized Xerox service center, we provide unparalleled expertise and support, ensuring swift resolution of any technical issues with your Xerox photocopiers, backed by our nationwide service network.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4><a href="">General Orders</a></h4>
                            <p>Explore our diverse range of office essentials beyond Xerox photocopiers, including top-quality laptops and other general order supplies, all available nationwide to meet your business needs seamlessly.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">

                <div class="row">
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3>Call To Action</h3>
                        <p> Ready to streamline your office solutions with top-quality products and nationwide service? Contact us today to discuss your requirements and elevate your business operations with our trusted Xerox photocopiers and other essential office equipment. Experience the convenience and efficiency of RANS Office Automation's services – reach out now!
                        </p>
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle" href="#">Call To Action</a>
                    </div>
                </div>

            </div>
        </section><!-- End Cta Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Portfolio</h2>
                    <p>Discover our extensive portfolio of office solutions, featuring Xerox photocopiers renowned for reliability alongside a curated selection of top-quality laptops and other essential products from leading brands. With nationwide availability and unparalleled service, RANS Office Automation is your one-stop destination for all your office equipment needs.</p>
                </div>

                <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-app">App</li>
                    <li data-filter=".filter-card">Card</li>
                    <li data-filter=".filter-web">Web</li>
                </ul>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-1.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <a href="assets_HTML/img/portfolio/portfolio-1.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-2.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                            <a href="assets_HTML/img/portfolio/portfolio-2.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-3.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>App 2</h4>
                            <p>App</p>
                            <a href="assets_HTML/img/portfolio/portfolio-3.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-4.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Card 2</h4>
                            <p>Card</p>
                            <a href="assets_HTML/img/portfolio/portfolio-4.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-5.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Web 2</h4>
                            <p>Web</p>
                            <a href="assets_HTML/img/portfolio/portfolio-5.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-6.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>App 3</h4>
                            <p>App</p>
                            <a href="assets_HTML/img/portfolio/portfolio-6.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-7.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Card 1</h4>
                            <p>Card</p>
                            <a href="assets_HTML/img/portfolio/portfolio-7.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-8.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Card 3</h4>
                            <p>Card</p>
                            <a href="assets_HTML/img/portfolio/portfolio-8.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-img"><img src="assets_HTML/img/portfolio/portfolio-9.png" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                            <a href="assets_HTML/img/portfolio/portfolio-9.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                            <!-- <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a> -->
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Team</h2>
                    <p>Meet our dedicated team at RANS Office Automation, where expertise meets excellence. With a passion for providing top-notch service and support, our team is committed to delivering unparalleled solutions and customer satisfaction on a nationwide scale.
                    </p>
                </div>

                <div class="row">

                    <div class="col-lg-6">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                            <div class="pic"><img src="assets_HTML/img/team/team-1.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>RN Joshi</h4>
                                <span>Chief Executive Officer</span>
                                <p>Meet our visionary CEO at RANS Office Automation Systems</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
                            <div class="pic"><img src="assets_HTML/img/team/team-2.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Amit Joshi</h4>
                                <span>Sales Head, India</span>
                                <p>Meet our dynamic Sales Head orchestrating nationwide sales</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
                            <div class="pic"><img src="assets_HTML/img/team/team-3.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Anirudh Joshi</h4>
                                <span>CTO</span>
                                <p>Chief Technology Officer innovative and technological advancements</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
                            <div class="pic"><img src="assets_HTML/img/team/team-4.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Bharat Choudhary</h4>
                                <span>Admin Officer</span>
                                <p>Diligent Accountant meticulously managing financial operations</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
                            <div class="pic"><img src="assets_HTML/img/team/team-5.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Deepak Badola</h4>
                                <span>Technical Manager</span>
                                <p>Overseeing the installation, maintenance and optimization of XEROX printing solutions</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
                            <div class="pic"><img src="assets_HTML/img/team/team-6.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Deepender Manwal</h4>
                                <span>Service Head</span>
                                <p>Ensuring unparalleled customer satisfaction through effective service</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </section>
        <!-- End Team Section -->

        <!-- ======= Pricing Section ======= -->
        <!-- <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pricing</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <h3>Free Plan</h3>
              <h4><sup>$</sup>0<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li class="na"><i class="bx bx-x"></i> <span>Pharetra massa massa ultricies</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <a href="#" class="buy-btn">Get Started</a>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box featured">
              <h3>Business Plan</h3>
              <h4><sup>$</sup>29<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul>
              <a href="#" class="buy-btn">Get Started</a>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <h3>Developer Plan</h3>
              <h4><sup>$</sup>49<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul>
              <a href="#" class="buy-btn">Get Started</a>
            </div>
          </div>

        </div>

      </div>
    </section> -->
        <!-- End Pricing Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <!-- <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section> -->
        <!-- End Frequently Asked Questions Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Get in touch with RANS Office Automation today to explore our comprehensive range of office solutions and experience unmatched service in Uttarakhand and adjoining areas. Whether you have inquiries about our products or require support, our dedicated team is here to assist you – reach out to us via phone, email, or visit our office for personalized assistance</p>
                </div>

                <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>1st Floor, Shiva Palace, 57/19, Dehradun, Uttarakhand 248001</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>contact@ransoffice.com</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>0135-2710060</p>
                            </div>

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d215.22821470879802!2d78.04941675441708!3d30.332430987137318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390929c490bd0789%3A0xfcc135943041d37d!2sRans%20Office%20Automation%20Systems!5e0!3m2!1sen!2sin!4v1712482199810!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <form id="emailForm" method="POST" class="email-form" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="star">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name" class="star">Your Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="star">Mobile No.</label>
                                <input type="text" class="form-control" name="mobileno" id="mobileno" maxlength="10" required>
                            </div>
                            <div class="form-group">
                                <label for="name" class="star">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="form-group" class="star">
                                <label for="name">Message</label>
                                <textarea class="form-control" name="message" rows="10"></textarea>
                            </div>
                            <!-- <div class="my-3">
                <div class="loading">Loading...</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div> -->
                            <div class="text-center"><button type="submit" name="submit" value="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <!-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div> -->

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>RANS Office</h3>
                        <p>
                            1st Floor, Shiva Palace <br>
                            57/19, Dehradun <br>
                            Uttarakhand-248001<br>

                            <strong>Phone:</strong> 9690981114<br>
                            <strong>Email:</strong> rans_office4@rediffmail.com<br>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Print Solutions</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Consumables</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Prompt Service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">General Order Supply</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Computer Equipments</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>Stay connected with us across our social networks to stay updated on the latest news, product launches, and special offers.</p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span>RANS Office Automation</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                Designed by <a href="https://itmedium.in/">ITMedium</a>
            </div>



        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets_HTML/vendor/aos/aos.js"></script>
    <script src="assets_HTML/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_HTML/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets_HTML/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets_HTML/vendor/php-email-form/validate.js"></script>
    <script src="assets_HTML/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets_HTML/vendor/waypoints/noframework.waypoints.js"></script>

    <!-- Template Main JS File -->
    <script src="assets_HTML/js/main.js"></script>
    <script>
        function myFunction() {
            document.getElementById("demo").style.display = "none";

        }
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('input').val('');
        });
    </script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#emailForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("send.email") }}',
                    data: $(this).serialize(),
                    success: function(response) {

                        alert(response.message);
                        $('#emailForm')[0].reset();
                    },
                    error: function(response) {
                        alert('Failed to send EMAIL');
                    }
                });
            });
        });
    </script>
</body>

</html>
<?
