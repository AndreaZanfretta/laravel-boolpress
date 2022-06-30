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
                    <p class="card-text"><small class="text-muted">post creato il: {{formatDate}}</small></p>
                </div>
            </div>
            <div>
                <form @submit.prevent="addComment()">
                    <label for="username">Inserisci il nome</label>
                    <input v-model="formData.username" type="text" />
                    <label for="content">Inserisci il contenuto</label>
                    <input v-model="formData.content" type="text" />
                    <button type="submit">Invia</button>
                </form>
            </div>
            <div v-if="post && post.comments.length > 0">
                <h4>Commenti:</h4>
                <div v-for="comment in post.comments" :key="comment.id">
                    {{comment.username}}:  {{ comment.content }}
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
            formData: {
                username: '',
                content: '',
                post_id: '',
            }

        }
    },
    methods: {
        addComment(){
            console.log(this.post.id);
            this.formData.post_id = this.post.id;
            axios.post('/api/comments', this.formData)
            .then(res => {
                console.log(res);
                this.post.comments.push(res.data);
                this.formData.username = '';
                this.formData.content = '';
            })
            .catch(err => {
                console.error(err); 
            })
        }
    },
    computed: {
        formatDate() {
        return this.post.created_at.substr(0, 19).replace("T", ", ");
        },
    },
    mounted(){
        const slug = this.$route.params.slug;
        axios.get(`/api/posts/${slug}`)
        .then(res => {
            console.log(res)
            this.post = res.data;
            console.log(this.post)
        })
        .catch(err => {
            console.error(err); 
            this.$router.push({ name: 'not-found'})
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