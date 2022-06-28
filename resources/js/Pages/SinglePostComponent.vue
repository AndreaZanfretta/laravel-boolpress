<template>
    <div class="post-container">
            <div class="card mb-3 text-white bg-dark" v-if="post">
                <div class="img-container" v-if="post.image">
                    <img class="card-img-top" :src="`/storage/${post.image}`" :alt="post.title">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text" v-html="post.content"></p>
                    <ul v-if="post.tags">
                        <p>Tags:</p>
                        <li v-for="tag in post.tags" :key="tag.id">{{tag.name}}</li>
                    </ul>
                    <p class="card-text"><small class="text-muted">post creato il: {{post.created_at}}</small></p>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: 'SinglePostComponent',
    data(){
        return{
            post: null,

        }
    },
    mounted(){
        const slug = this.$route.params.slug;
        axios.get(`/api/posts/${slug}`)
        .then(res => {
            console.log(res)
            this.post = res.data;
        })
        .catch(err => {
            console.error(err); 
        })
    }
}
</script>

<style scoped lang="scss">
    .post-container{
        width: 50%;
        margin: 80px auto;
    }
    .img-container{
        
        img{
            width: 100%;
            height: 480px;
            object-fit: cover;
            object-position: center;
        }
    }
    
</style>