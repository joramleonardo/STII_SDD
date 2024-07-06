<template>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <router-link to="/author/hr/dashboard" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="" exact>
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        Dashboard
                    </router-link>
                    <router-link to="/author/hr/healthandtraining" class="nav-link collapsed" exact href="#" data-toggle="collapse" data-target="#collapse_healthandtraining" aria-expanded="false" aria-controls="collapse_accountmanagement">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-h-square"></i>
                        </div>
                        Health and Training
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </router-link>
                    <div class="collapse" id="collapse_healthandtraining" aria-labelledby="headingOne" data-parent="#sidenavAccordion" >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link to="/author/hr/healthandtraining/employee" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Employee
                            </router-link>
                            <router-link to="/author/hr/healthandtraining/training" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Training
                            </router-link>
                            <router-link to="/author/hr/healthandtraining/healthcondition" class="nav-link" exact>
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                Health Condition
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