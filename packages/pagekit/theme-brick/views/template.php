<!DOCTYPE html>
<html class="<?= $params['html_class'] ?>" lang="<?= $intl->getLocaleTag() ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $view->render('head') ?>
        <?php $view->style('theme', 'theme:css/theme.css') ?>
        <?php $view->style('custom', 'theme:css/custom.css') ?>
        <?php $view->script('theme', 'theme:js/theme.js', ['uikit-sticky',  'uikit-lightbox',  'uikit-parallax']) ?>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600italic,700,700italic' rel='stylesheet' type='text/css'>
    </head>
    <body>


                <?php if ($params['logo'] || $view->menu()->exists('main') || $view->position()->exists('navbar')) : ?>
                <header class="box-shadow <?= $params['classes.navbar'] ?>" <?= $params['classes.sticky'] ?>>
                    <div class="uk-container uk-container-center">
                    <nav class="uk-navbar">

                        <a id="logo" class="uk-display-inline-block uk-float-left" href="<?= $view->url()->get() ?>">
                            <img src="packages/pagekit/theme-brick/img/logo.png" alt="Home">
                        </a>
                       
                        <?php if ($view->menu()->exists('main') || $view->position()->exists('navbar')) : ?>
                        <div class="uk-display-inline-block uk-float-left uk-visible-large">
                            <?= $view->menu('main', 'menu-navbar.php') ?>
                            <?= $view->position('navbar', 'position-blank.php') ?>

                        </div>
                        <?php endif ?>

                        <?php if ($view->position()->exists('offcanvas') || $view->menu()->exists('offcanvas')) : ?>
                        <div class="uk-display-inline-block uk-hidden-large">
                            <a href="#offcanvas" class="uk-navbar-toggle" data-uk-offcanvas></a>
                        </div>
                        <div class="uk-display-inline-block uk-float-right" id="lid-worden">  
                            <a href="/lidworden" class="button box-shadow" id="lid-font">Lid worden!</a>
                        </div>
                        <ul class="uk-display-inline-block uk-float-right sm-content">
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
                        <?php endif ?>

                        

                        
                    </nav>
                    
                    </div>
                </header>

                <?php endif ?>

                <?php if ($view->position()->exists('hero')) : ?>
                <div id="tm-hero" class="tm-hero uk-block uk-block-large uk-cover-background <?= $params['classes.hero'] ?>" <?= $params['hero_image'] ? "style=\"background-image: url('{$view->url($params['hero_image'])}');\"" : '' ?> <?= $params['classes.parallax'] ?>>

                    <section class="uk-grid uk-grid-match uk-container uk-container-center" data-uk-grid-margin>

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

                <main id="tm-main" class="tm-main">
                    
                        <div class="uk-container uk-container-center" data-uk-grid-match data-uk-grid-margin>
                                
                              
                                <?= $view->render('content') ?>
                             
                                <?php if ($view->position()->exists('hero') && $view->position()->exists('homepage')) : ?>
                                        <?= $view->position('homepage', 'position-grid-homepage.php') ?>
                                <?php endif; ?>
                        </div>
                    
                        <?php if ($view->position()->exists('hero') && $view->position()->exists('homepage_bottom')) : ?>
                            <?= $view->position('homepage_bottom', 'position-grid-homepage-bottom.php') ?>
                        <?php endif; ?>
                </main>

                <?php if ($view->position()->exists('bottom')) : ?>
                <div id="tm-bottom" class="tm-bottom uk-block <?= $params['bottom_style'] ?>">

                    <section class="uk-grid uk-grid-match" data-uk-grid-margin>
                        <?= $view->position('bottom', 'position-grid.php') ?>
                    </section>

                </div>
                <?php endif; ?>

                


<!--Footer!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
                <?php if ($view->position()->exists('footer')) : ?>
                <footer class="uk-contrast">

                  
                    <div class="uk-container uk-container-center uk-grid">
                    <?= $view->position('footer', 'position-grid-footer.php') ?>
                    <!-- <nav class="uk-width-large-1-4" id="footer-menu">
                        <h3>Menu</h3>
                        <ul>
                            <a href=""><li>Wie zijn wij?</li></a>
                            <a href=""><li>Evenementen</li></a>
                            <a href=""><li>Nieuws</li></a>
                            <a href=""><li>Vacaturebank</li></a>
                            <a href=""><li>Contact</li></a>
                        </ul>
                    </nav>
                    <section class="uk-width-large-1-4">
                        <h3>Nieuwsbrief ontvangen?</h3>
                        <div class="sub-content-footer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue pellentesque dapibus. Morbi maximus scelerisque erat, id vehicula dui mattis.</div>
                        <a href="\abonneren" class="button box-shadow">Abonneren!</a>
                    </section>
                    <section class="uk-width-large-1-4">
                        <h3>Lid worden?</h3>
                        <div class="sub-content-footer"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue pellentesque dapibus. Morbi maximus scelerisque erat, id vehicula dui mattis.</div>
                        <a href="/lid-worden" class="button box-shadow">Lid worden!</a>
                    </section>
                    <section class="uk-width-large-1-4">
                        <h3>Sponsoren</h3>
                        <a class="sponsors" href="https://www.sterc.nl/"><img width="190" height="120" src="packages/pagekit/theme-brick/img/sterc.svg"></a>
                        <a class="sponsors" href="https://www.nhl.nl/"><img width="190" height="120" src="packages/pagekit/theme-brick/img/nhl.svg"></a>
                    </section> -->
                    </div>
                </footer>
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

        

    </body>
</html>
