<template>
  <main class="main">
    <router-view></router-view>
  </main>
</template>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');
</style>

<style lang="scss">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Lato', sans-serif;
}
.body {
  background-color: var(--white);
}

.body.active {
  overflow: hidden;
}

.main {
  max-width: 1920px;
  width: 100%;
  height: 100%;
  margin-inline: auto;
  background-color: var(--white);
}

:root {
  --white: #ffffff;
  --black: #2b2a29;
  --light-beige: #d0c5bb;
  --dark-beige: #b6a092;
}

@media screen and (max-width: 1024px) {
  .main {
    height: 100%;
  }
}
</style>
