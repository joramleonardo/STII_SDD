<!--
<template>
    <div>
        <h1> This is Dashboard </h1>
    </div>

</template>
-->
<template>
    <!-- v-if="isLoggedIn" -->
    <main>
        <Header />
        <div style="padding:5px; font-style: italic; font-color: black; font-size: 12px; background-color: #ABB2B9"> 
            <b>ACCESS:</b> SJA Level
        </div>
        <div id="layoutSidenav">
            <Sidebar />
                        
            <div id="layoutSidenav_content">
                <main>
                    <router-view> </router-view>
                </main>
                <Footer />
            </div>
        </div>

        <FlashMessage position="right bottom"> </FlashMessage>
    </main>
</template>

<script>
    import Header from './Header.vue';
    import Sidebar from './Sidebar-AuthorSJA.vue';
    import Footer from './Footer.vue';
    // import * as authService from './services/auth_service';

    export default { 
        components: {
            Header,
            Sidebar,
            Footer
        },
        data(){
            return {
                isLoggedIn: false
            }
        }
        // data () {
        //     return {
                
        //     }
        // },

        // beforeCreate: async function () {
        //     try {
        //         if(authService.isLoggedIn()) {
        //             const response = await authService.getUserProfile();
        
        //             this.$store.dispatch('authenticate', response.data);
        //         }
        //     } catch (error) {

        //     }
        // },
    }
</script>