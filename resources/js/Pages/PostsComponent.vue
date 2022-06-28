<template>
    <div>
        <h1>PostsComponent</h1>
        <ul v-if="posts.length > 0">
            <li v-for="(post, index) in posts" :key="post.id">
                {{index}} - {{post.title}}
                <router-link :to="{name: 'single-post', params: {slug: post.slug} }">Visualizza Post </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'PostsComponent',
    data(){
        return{
            posts: [],
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

<style scoped lang="scss">

</style>