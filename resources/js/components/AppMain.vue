<template>
    <main>
        <!-- <h1>sono il main</h1>
        <ul>
            <li v-for="(post, index) in posts" :key="index">
                <span>{{post.title}}</span>
                <a href="#" @click="getDetail(post.slug, index)">vedi dettaglio</a>
                <span v-if="post[index].detail">{{post[index].detail.slug}}</span>
            </li
        ></ul> -->
        <router-view> </router-view>
    </main>
</template>

<script>
export default {
    name: 'AppMain',
    data(){
        return{
            posts: [],
        }
    },
    methods:{
        getDetail(slug, index){
            axios.get('/api/posts/'+ slug)
        .then(res => {
            this.posts[index].detail = res.data;
            console.log(this.posts[index].detail)
        })
        .catch(err => {
            console.error(err); 
        })
        }
    },
    created(){
        axios.get('/api/posts')
        .then(res => {
            console.log(res)
            this.posts = res.data;
        })
        .catch(err => {
            console.error(err); 
        })
    }
}
</script>

<style scoped lang='scss'>

</style>