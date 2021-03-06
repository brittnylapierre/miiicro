<?php

/*

  type: layout
  content_type: static
  name: Menu - skin-5
  position: 5
  description: Menu - skin-5
  categories: Menu


*/

?>


<section class="header-background">

    <nav class="p-3 mb-3">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                
                <a href="/">
                  <module type="logo" id="header-logo-<?php print $params['id']; ?>" class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"/>
                </a>

                <div class="language-switcher-language-url"
                 id="block-languageswitcher" 
                 role="navigation">
                  <ul class="links">
                    <li hreflang="en_US" 
                        class="en is-active">
                      <a href="/en_US/home" 
                        class="language-link is-active" 
                        hreflang="en">
                          EN
                      </a>
                    </li>
                    <li hreflang="fr_FR"
                        class="fr_FR">
                          <a href="/fr_FR/home" 
                          class="language-link" 
                          hreflang="fr">
                            FR
                          </a>
                        </li>
                      </ul>
                    </div>


                <module type="menu" name="header_menu" id="header_menu" template="navbar" class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"/>


                <!--todo-->
                <!--form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form-->

            </div>
        </div>
    </nav>
</section>
