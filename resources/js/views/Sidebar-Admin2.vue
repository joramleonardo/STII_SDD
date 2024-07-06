<template>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sdd-header-title-stii">DOST-STII</div>
            <div class="sdd-header-title">GAD Database</div>
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!--
                    <router-link to="/admin/dashboard" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="" exact>
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        Dashboard
                    </router-link>
                    -->

                    <!-- HR CORNER -->
                    <router-link to="/admin/dashboard/hr" class="nav-link collapsed" exact href="#" data-toggle="collapse" data-target="#collapse_hr" aria-expanded="false" aria-controls="collapse_accountmanagement">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        Human Resources
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </router-link>
                    <div class="collapse" id="collapse_hr" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/admin/dashboard/hr" class="nav-link cta" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                L&D
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                OSH
                            </router-link>
                        </nav>
                    </div>
                    <!-- DOSTv CORNER -->
                    <router-link to="/admin/dashboard/dostv" class="nav-link collapsed" exact href="#" data-toggle="collapse" data-target="#collapse_dostv" aria-expanded="false" aria-controls="collapse_accountmanagement">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        DOSTv
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </router-link>
                    <div class="collapse" id="collapse_dostv" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/admin/dashboard/dostv" class="nav-link cta" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                ExperTalk
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                Balitang RapiDOST
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                SiyenSikat
                            </router-link>
                        </nav>
                    </div>
                    <!-- LIBRARY CORNER -->
                    <router-link to="/admin/dashboard/library" class="nav-link collapsed" exact href="#" data-toggle="collapse" data-target="#collapse_library" aria-expanded="false" aria-controls="collapse_accountmanagement">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        Library
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </router-link>
                    <div class="collapse" id="collapse_library" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/admin/dashboard/library" class="nav-link cta" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                OLLP
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                Webinars
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                Library Tour
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                Reference Service
                            </router-link>
                        </nav>
                    </div>
                    <!-- STARBOOKS CORNER -->
                    <router-link to="/admin/dashboard/starbooks" class="nav-link collapsed" exact href="#" data-toggle="collapse" data-target="#collapse_starbooks" aria-expanded="false" aria-controls="collapse_accountmanagement">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        STARBOOKS
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </router-link>
                    <div class="collapse" id="collapse_starbooks" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/admin/dashboard/starbooks" class="nav-link cta" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                Deployment Officers Assembly
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                Regional Conventions
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                Logs
                            </router-link>
                        </nav>
                    </div>
                    <!-- SJA CORNER -->
                    <router-link to="/admin/dashboard/sja" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="" exact>
                        <div class="sb-nav-link-icon">
                        <i class="fas fa-flask"></i>
                        </div>
                        Science Journo Ako
                    </router-link>
                    <!-- LOGOUT CORNER -->
                    <router-link to="/login" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="" exact>
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-window-close"></i>
                        </div>
                        Logout
                    </router-link>


                    <!--
                    <div class="collapse" id="collapse_reports" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/admin/dashboard/hr" class="nav-link cta" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                HR Training
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-flask"></i>
                                </div>
                                Science Journo Ako
                            </router-link>
                            <router-link to="/admin/dashboard/library" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Library
                            </router-link>
                            <router-link to="/admin/dashboard/starbooks" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                STARBOOKS Logs
                            </router-link>
                            <router-link to="/admin/dashboard/dostv" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                DOSTv
                            </router-link>
                        </nav>
                    </div>

                    <router-link to="/admin/library" class="nav-link collapsed" exact href="#" data-toggle="collapse" data-target="#collapse_records" aria-expanded="false" aria-controls="collapse_accountmanagement">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-h-square"></i>
                        </div>
                        Records
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </router-link>
                    <div class="collapse" id="collapse_records" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/admin/library" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Library
                            </router-link>
                            <router-link to="/admin/healthandtraining" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                HR Training
                            </router-link>
                            <router-link to="/admin/starbooks" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                STARBOOKS
                            </router-link>
                            <router-link to="/admin/sciencejourno" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-flask"></i>
                                </div>
                                Science Journo Ako
                            </router-link>
                            <router-link to="/admin/dostv" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                DOSTv
                            </router-link>
                            
                            <router-link to="/admin/pjs" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                PJS
                            </router-link>
                            
                            <router-link to="/admin/dostv" class="nav-link collapsed" exact href="#" data-toggle="collapse" data-target="#collapse_dostv" aria-expanded="false" aria-controls="collapse_accountmanagement">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-h-square"></i>
                                </div>
                                DOSTv
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </router-link>
                        </nav>
                    </div>

                    <div class="collapse" id="collapse_dostv" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/admin/dashboard/starbooks" class="nav-link cta" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                ExperTalk
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-flask"></i>
                                </div>
                                SiyenSikat
                            </router-link>
                            <router-link to="/admin/dashboard/sja" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-flask"></i>
                                </div>
                                Balitang RapiDOST
                            </router-link>
                        </nav>
                    </div>

                    -->

                    
                    


                    
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