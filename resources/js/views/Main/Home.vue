
<template>
    <body>
        <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
            <Navbar />
        </aside>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <router-view> </router-view>
        </main>
    </body>
</template>

<script>
    import Navbar from './Navbar.vue';

    export default { 
        components: {
            Navbar
        },
        data(){
            return {
            }
        },
        mounted(){
        },
        methods:{
        }
    }
</script>