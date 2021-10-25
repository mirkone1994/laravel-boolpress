<template>
  <div class="card my-3">
  <div class="card-header">
    {{post.title}}
  </div>
  <div class="card-body">
      <address>Scritto da: {{post.user ? post.user.name : ' - '}}</address>
      <p>{{post.content}}</p>
      <footer>
          <time>Pubbliato il: {{getFormattedDate(post.created_at)}}</time>
        </footer>
  </div>
</div>
</template>

<script>
export default {
    name: "PostCard",
    props: ["post"],
    methods: {
        getFormattedDate(date){
            const postDate = new Date(date);
            const day = postDate.getDate();
            const month = postDate.getMonth() + 1;
            const year = postDate.getFullYear();
            return `${day}/${month}/${year}`;
        }
    }

}
</script>

<style>

</style>