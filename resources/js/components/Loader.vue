<template>
  <div class="loader">
      <div class="spinner-border text-success" role="status">
          <span class="sr-only">Loading...</span>
      </div>
  </div>
</template>

<script>
export default {
name: "Loader",
}
</script>

<style lang="scss" scoped>
.loader{
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    position: fixed;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9;
    .spinner-border{
        width: 100px;
        height: 100px;
    }
}
</style>