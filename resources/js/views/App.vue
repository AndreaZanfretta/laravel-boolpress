<template>
    <div>
        <app-header />
        <app-main />
        <app-footer />
    </div>
</template>

<script>
import AppMain from '../components/AppMain.vue';
import AppHeader from '../components/AppHeader.vue';
import AppFooter from '../components/AppFooter.vue';


export default {
    name: 'app',
    components: {
        AppMain,
        AppHeader,
        AppFooter,
    }
}
</script>