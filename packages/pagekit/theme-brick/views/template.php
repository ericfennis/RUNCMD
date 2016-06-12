<!DOCTYPE html>
<html class="<?= $params['html_class'] ?>" lang="<?= $intl->getLocaleTag() ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $view->render('head') ?>
        <?php $view->style('custom', 'theme:css/custom.css') ?>
        <?php $view->style('theme', 'theme:css/theme.css') ?>
        <?php $view->script('theme', 'theme:js/theme.js', ['uikit-sticky',  'uikit-lightbox',  'uikit-parallax']) ?>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600italic,700,700italic' rel='stylesheet' type='text/css'>
    </head>
    <body>


                <?php if ($params['logo'] || $view->menu()->exists('main') || $view->position()->exists('navbar')) : ?>
                <header class="<?= $params['classes.navbar'] ?>" <?= $params['classes.sticky'] ?>>

                    <nav class="uk-navbar">

                        <a class="uk-navbar-brand" href="<?= $view->url()->get() ?>">
                            <?php if ($params['logo']) : ?>
                                <img class="tm-logo uk-responsive-height" src="<?= $this->escape($params['logo']) ?>" alt="">
                                <img class="tm-logo-contrast uk-responsive-height" src="<?= ($params['logo_contrast']) ? $this->escape($params['logo_contrast']) : $this->escape($params['logo']) ?>" alt="">
                            <?php else : ?>
                                <?= $params['title'] ?>
                            <?php endif ?>
                        </a>

                        <?php if ($view->menu()->exists('main') || $view->position()->exists('navbar')) : ?>
                        <div class="uk-navbar-flip uk-visible-large">
                            <?= $view->menu('main', 'menu-navbar.php') ?>
                            <?= $view->position('navbar', 'position-blank.php') ?>
                        </div>
                        <?php endif ?>

                        <?php if ($view->position()->exists('offcanvas') || $view->menu()->exists('offcanvas')) : ?>
                        <div class="uk-navbar-flip uk-hidden-large">
                            <a href="#offcanvas" class="uk-navbar-toggle" data-uk-offcanvas></a>
                        </div>
                        <?php endif ?>
                    </nav>
                    <nav id="social-media">
                        <ul class="sm-content">
                            <li>
                                <a href="https://www.facebook.com/svruncmd/">
                                    <img src="packages/pagekit/theme-brick/img/facebook.png">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/svruncmd/">
                                    <img src="packages/pagekit/theme-brick/img/instalogo.png">
                                </a>
                            </li>
                            <li>
                                <a id="linked-in" href="https://www.linkedin.com/company/sv-run-cmd">
                                    <img src="packages/pagekit/theme-brick/img/linkedin.png">
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div id="lid-worden">  
                        <a href="/lidworden" class="button box-shadow" id="lid-font">Lid worden!</a>
                    </div>
                </header>

                <?php endif ?>

                <?php if ($view->position()->exists('hero')) : ?>
                <div id="tm-hero" class="tm-hero uk-block uk-block-large uk-cover-background <?= $params['classes.hero'] ?>" <?= $params['hero_image'] ? "style=\"background-image: url('{$view->url($params['hero_image'])}');\"" : '' ?> <?= $params['classes.parallax'] ?>>

                    <section class="uk-grid uk-grid-match" data-uk-grid-margin>
                        <?= $view->position('hero', 'position-grid.php') ?>
                    </section>

                </div>
                <?php endif; ?>

                <?php if ($view->position()->exists('top')) : ?>
                <div id="tm-top" class="tm-top uk-block <?= $params['top_style'] ?>">

                    <section class="uk-grid uk-grid-match" data-uk-grid-margin>
                        <?= $view->position('top', 'position-grid.php') ?>
                    </section>

                </div>
                <?php endif; ?>

                <div id="tm-main" class="tm-main uk-block <?= $params['main_style'] ?>">

                    <div class="uk-grid" data-uk-grid-match data-uk-grid-margin>

                        <main class="<?= $view->position()->exists('sidebar') ? 'uk-width-medium-3-4' : 'uk-width-1-1'; ?>">
                            <?= $view->render('messages') ?>
                            <?= $view->render('content') ?>
                        </main>

    
                    

                    </div>

                </div>

                <?php if ($view->position()->exists('bottom')) : ?>
                <div id="tm-bottom" class="tm-bottom uk-block <?= $params['bottom_style'] ?>">

                    <section class="uk-grid uk-grid-match" data-uk-grid-margin>
                        <?= $view->position('bottom', 'position-grid.php') ?>
                    </section>

                </div>
                <?php endif; ?>
<!--Footer!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
                <?php if ($view->position()->exists('footer')) : ?>
                <div id="tm-footer" class="tm-footer uk-block-secondary uk-contrast">

                    <nav id="footer-menu">
                        <div class="onderwerp-style" id="footer-menu">Menu</div>
                        <ul>
                            <a href=""><li>Wie zijn wij?</li></a>
                            <a href=""><li>Evenementen</li></a>
                            <a href=""><li>Nieuws</li></a>
                            <a href=""><li>Vacaturebank</li></a>
                            <a href=""><li>Contact</li></a>
                        </ul>
                    </nav>
                    <section>
                        <div class="onderwerp-style">Nieuwsbrief ontvangen?</div>
                        <div class="sub-content-footer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue pellentesque dapibus. Morbi maximus scelerisque erat, id vehicula dui mattis.</div>
                        <a href="\abonneren" class="button box-shadow">Abonneren!</a>
                    </section>
                    <section>
                        <div class="onderwerp-style">Lid worden?</div>
                        <div class="sub-content-footer"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue pellentesque dapibus. Morbi maximus scelerisque erat, id vehicula dui mattis.</div>
                        <a href="/lid-worden" class="button box-shadow">Lid worden!</a>
                    </section>
                    <section>
                        <div class="onderwerp-style" id="sponsoren">Sponsoren</div>
                        <a href="/sterc"><img src="packages/pagekit/theme-brick/img/sterc.svg"></a>
                        <a href="/nhl"><img src="packages/pagekit/theme-brick/img/nhl.svg"></a>
                    </section>

                </div>
                <?php endif; ?>

        

        <?php if ($view->position()->exists('offcanvas') || $view->menu()->exists('offcanvas')) : ?>
        <div id="offcanvas" class="uk-offcanvas">
            <div class="uk-offcanvas-bar uk-offcanvas-bar-flip uk-text-center">

                <?php if ($params['logo_offcanvas']) : ?>
                <div class="uk-panel uk-text-center">
                    <a href="<?= $view->url()->get() ?>">
                        <img src="<?= $this->escape($params['logo_offcanvas']) ?>" alt="">
                    </a>
                </div>
                <?php endif ?>

                <?php if ($view->menu()->exists('offcanvas')) : ?>
                    <?= $view->menu('offcanvas', ['class' => 'uk-nav-offcanvas']) ?>
                <?php endif ?>

                <?php if ($view->position()->exists('offcanvas')) : ?>
                    <?= $view->position('offcanvas', 'position-panel.php') ?>
                <?php endif ?>

            </div>
        </div>
        <?php endif ?>

        <?= $view->render('footer') ?>

    </body>
</html>
