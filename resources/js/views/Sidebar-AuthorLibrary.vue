<template>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <router-link to="/author/library/dashboard" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="" exact>
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        Dashboard
                    </router-link>

                    <router-link to="/author/lib/library/" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_library" aria-expanded="false" aria-controls="collapse_accountmanagement" exact>
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        Library
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </router-link>
                    <div class="collapse" id="collapse_library" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/author/library/materialrequest" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Material Request
                            </router-link>
                            <router-link to="/author/library/ollp" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                OLLP
                            </router-link>
                            <router-link to="/author/library/webinar" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Webinars
                            </router-link>
                            <!--
                            <router-link to="/author/library/client" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Client
                            </router-link>
                            <router-link to="/author/library/request" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Request
                            </router-link>
                            <router-link to="/author/library/evaluation" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Evaluation
                            </router-link>
                            <router-link to="/author/library/researchlog" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Research Log
                            </router-link>
                            -->
                        </nav>
                    </div>
                    
                    <router-link to="/login" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="" exact>
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        Logout
                    </router-link>

                    
                </div>
            </div>
            <!--
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
            -->
        </nav>
    </div>
</template>