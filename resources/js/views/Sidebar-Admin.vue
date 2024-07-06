<template>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sdd-header-title">DOST-STII SDD</div>
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
                    
                    <router-link to="/admin/dashboard" class="nav-link collapsed" exact href="#" data-toggle="collapse" data-target="#collapse_reports" aria-expanded="false" aria-controls="collapse_accountmanagement">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-h-square"></i>
                        </div>
                        Reports
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </router-link>
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
                            <!--
                            <router-link to="/admin/dashboard/pjs" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                PJS
                            </router-link>
                            -->
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
                            <!--
                            <router-link to="/admin/pjs" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                PJS
                            </router-link>
                            -->
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