<template>
    <div class="container">
        <Header :title="title"></Header>
        <main><PostList/></main>
    </div>
</template>

<script>
import Header from "./Header.vue";
import PostList from "./Posts/PostList.vue"
    export default {
        name: "App",
        data (){
            return {
                title: "Il mio Blog"
            }
        },
        components: {
            Header,
            PostList,
        }
    };
</script>
