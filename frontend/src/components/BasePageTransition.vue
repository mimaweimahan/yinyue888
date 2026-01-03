<template>
  <Transition name="page-slide" appear mode="out-in">
    <slot />
  </Transition>
</template>

<style scoped lang="scss">
.page-slide-enter-active {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  z-index: 1;
}
.page-slide-leave-active {
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  width: 100%;
  z-index: 0;
}
.page-slide-enter-from {
  opacity: 0;
  transform: translateX(20px) scale(0.98);
  filter: blur(4px);
}
.page-slide-leave-to {
  opacity: 0;
  transform: translateX(-20px) scale(0.98);
  filter: blur(4px);
}
</style>

