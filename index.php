<?php
include_once 'config.php';
include_once 'functions.php';

if (!isset($sections)) {
    $sections = getSections($project, $defaultProject);
}

?><!DOCTYPE html>
<head>
    <title><?php echo $projectTitle; ?></title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <link rel="icon" href="<?php echo $projectFaviconPath; ?>" type="image/x-icon">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_path( '/css/grid.css' ); ?>">

    <link rel="stylesheet" href="<?php echo get_path( '/css/style.css' ); ?>">
    <link rel="stylesheet" href="<?php echo get_path( "/projects/{$project}/project_styles.css" ); ?>">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Montserrat+Alternates:400,700' rel='stylesheet' type='text/css'>
    <!--<link href='//fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>-->
    <link rel="stylesheet" href="<?php echo get_path( '/css/prettify.css' ); ?>">
    <link rel="stylesheet" href="<?php echo get_path( '/css/jquery.fancybox.css' ); ?>">

    <script src="<?php echo get_path( '/js/jquery.js' ); ?>"></script>
    <script src="<?php echo get_path( '/js/jquery-migrate-1.2.1.js' ); ?>"></script>

    <!--[if lt IE 9]>
    <html class="lt-ie9">
    <div style='clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/">
            <img src="<?php echo get_path( '/img/ie8-panel/warning_bar_0000_us.jpg' ); ?>" border="0" height="42" width="820"
                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <script src="/js/html5shiv.js"></script>
    <![endif]-->

    <script src='<?php echo get_path( '/js/device.min.js' ); ?>'></script>
</head>
<body data-section="<?php echo $section_param; ?>" onload="prettyPrint()" data-project="<?php echo $project; ?>">

<!-- Google Tag Manager -->
 <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5WB7JQ"
 height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
 <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
 new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
 j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
 '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
 })(window,document,'script','dataLayer','GTM-5WB7JQ');</script>
 <!-- End Google Tag Manager -->

<div class="page-wrap">
    <div class="rd-mobilemenu active">
        <div class="logo logo__<?php echo $project; ?>">
            <a href="<?php echo get_path( "/index.php?project={$project}" ); ?>">
                <img src="<?php echo $projectImgLogoPath ?>" alt="<?php echo $projectTextLogo; ?>">
                <?php echo $projectTextLogo; ?>
            </a>
        </div>
        <div class="panel">
            <!-- <div class="select select-version">
                <select>
                    <option data-href="#">Version v3-0</option>
                    <option data-href="#" selected>Version v3-1</option>
                    <option data-href="#">Version v2-4</option>
                    <option data-href="#">Version v2-3</option>
                </select>
            </div>
            <div class="select select-lang">
                <select>
                    <option data-href="#">EN</option>
                    <option data-href="#">RU</option>
                </select>
            </div> -->

        </div>
        <p class="copyright">Zemez ©
            <a href="https://zemez.io/privacy-policy/" target= "blank">Privacy Policy</a>
        </p>
    </div>
    <div class="page-content active">
        <button class="rd-mobilepanel_toggle active"><span></span></button>
        <div class="rd-mobilepanel<?php if ('introduction' !== $section_param or 'introduction2' !== $section_param) : ?> fixed<?php endif; ?>">
            <h1 class="rd-mobilepanel_title">
                <?php echo $projectTitle; ?>
            </h1>
            <div class="tm-title-caption"><?php echo $projectTitleCaption; ?></div>
        </div>
        <div class="page">
            <!--========================================================
                HEADER
            =========================================================-->
            <header>
                <nav class="nav">
                    <ul class="menu" data-type="navbar">
                        <?php echo generateNavigation($sections, $lang, $section_param, $project, $defaultProject); ?>
                    </ul>
                </nav>
            </header>
            <!--========================================================
                CONTENT
            =========================================================-->
            <main id="main">
                <div class="container">
                    <?php include_once get_path( '/section.php', true ); ?>
                </div>
            </main>

            <!--========================================================
                FOOTER
            =========================================================-->
            <footer>
                <!-- <div class="navigate">
                    <div class="next_wrapper navigated-section-2">
                        <div class="container">
                            <a href="/section/template-installatiamework-installation.html" class="next">
                                <span>Next</span>
                                <em>Template installation</em>
                            </a>
                        </div>
                    </div>
                </div> -->

            </footer>
        </div>
    </div>
</div>


<script src="<?php echo get_path( '/js/jquery.easing.1.3.js' ); ?>"></script>
<script src="<?php echo get_path( '/js/jquery.rd-navbar.js' ); ?>"></script>
<script src="<?php echo get_path( '/js/prettify.js' ); ?>"></script>
<script src="<?php echo get_path( '/js/jquery.fancybox.js' ); ?>"></script>
<script src="<?php echo get_path( '/js/jquery.ui.totop.js' ); ?>"></script>

<script>
    /* Section Class
     ========================================================*/
    function sectionClass(item_key) {
        $.getJSON('<?php echo get_path( '/sections.json' ); ?>', function (json) {
            var body = $('body');
            var section_class = 'scheme-' + item_key % 9;
            body.attr('class', '');
            body.addClass(section_class);
        });
    }
</script>


<script src="<?php echo get_path( '/js/script.js' ); ?>"></script>

</body>
</html>
