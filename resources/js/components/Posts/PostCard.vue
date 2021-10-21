<template>
  <div class="card my-3">
  <div class="card-header">
    {{post.title}}
  </div>
  <div class="card-body">
      <p>{{post.content}}</p>
      <footer class="blockquote-footer">
          <time>{{post.created_at}}</time>
        </footer>
  </div>
</div>
</template>

<script>
export default {
    name: "PostCard",
    props: ["post"],

}
</script>

<style>

</style>