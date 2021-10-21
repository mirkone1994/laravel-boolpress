<template>
<section id="post-list">
    <h2>I miei Post</h2>
    <Loader v-if="isLoading"/>
    <PostCard v-else v-for="post in posts" :key="post.id" :post="post"/>
</section>
  
</template>

<script>
import Loader from "../Loader.vue"
import PostCard from './PostCard.vue'
export default {
    name: "PostList",
    components:{
        PostCard,
        Loader,
    },
    data (){
        return {
            baseUri: "http://localhost:8000",
            posts: [],
            isLoading: false,
        };
    },
    methods: {
        getPosts(){
            this.isLoading = true;
            axios.get(`${this.baseUri}/api/posts`).then((res) => {
                this.posts = res.data;
            }).catch((err) => {
                console.error(err);
            }).then(()=>{
                 this.isLoading = false;
            });
        },
    },
    created(){
        this.getPosts();
    },
};
</script>

<style>

</style>