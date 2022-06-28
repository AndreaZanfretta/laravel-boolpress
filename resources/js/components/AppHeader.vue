<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <router-link :to="{ name: menuItem[0].routeName }" class="navbar-brand"> Boolpress</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <div v-for="(item, index) in menuItem" :key="index">
                            <router-link :to="{ name: item.routeName }" class="nav-link">{{item.label}} </router-link>
                        </div>
                    </ul>
                </div>
                <span class="navbar-text">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-link">
                            <a href="/login">Login</a>
                        </li>
                        <li class="nav-link">
                            <a href="/register">Register</a>
                        </li>
                    </ul>
                </span>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'AppHeader',
    data(){
        return{
            menuItem: [
                {
                    label: 'Home',
                    routeName: 'home',
                },
                {
                    label: 'Chi Siamo',
                    routeName: 'about',
                },
                {
                    label: 'Contatti',
                    routeName: 'contact',
                },
                {
                    label: 'posts',
                    routeName: 'posts',
                },
            ]
        }
    }
}
</script>

<style scoped lang='scss'>
.router-link-active{
    color:red;
 }
</style>