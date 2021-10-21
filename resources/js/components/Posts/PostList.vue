<template>
<section id="post-list">
    <h2>I miei Post</h2>
    <Loader v-if="isLoading"/>
    <div v-else>
    <PostCard v-for="post in posts" :key="post.id" :post="post"/>
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item" v-if="pagination.currentPage > 1" @click="getPosts(pagination.currentPage-1)"><a class="page-link" >Prevoius</a></li>
    <li class="page-item" v-if="pagination.lastPage > pagination.currentPage"  @click="getPosts(pagination.currentPage+1)"><a class="page-link" >Next</a></li>
  </ul>
</nav>

    </div>
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
            pagination: {},
        };
    },
    methods: {
        getPosts(page){
            this.isLoading = true;
            axios.get(`${this.baseUri}/api/posts?page=${page}`).then((res) => {
                const {data, current_page, last_page} = res.data;
                this.posts = data;
                this.pagination = {currentPage: current_page, lastPage: last_page}
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

<style scoped>
.page-item{
    cursor: pointer;
}

</style>