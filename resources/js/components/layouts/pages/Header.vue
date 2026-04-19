<script setup>
import { ref } from 'vue'

const isDark = ref(false)
const showMenu = ref(false)

const toggleTheme = () => {
  isDark.value = !isDark.value
  document.documentElement.classList.toggle('dark')
}

const toggleMenu = () => {
  showMenu.value = !showMenu.value
}
</script>

<template>
  <header class="header" id="header">
    <nav class="nav container">

      <!-- Logo -->
      <a href="#home" class="nav_logo">
        Salem Alburaikie
      </a>

      <!-- Desktop Menu -->
      <div class="nav_menu">
        <ul class="nav_list">
          <li><a href="#home" class="nav_link active_link">Home</a></li>
          <li><a href="#about" class="nav_link">About</a></li>
          <li><a href="#skills" class="nav_link">Skills</a></li>
          <li><a href="#services" class="nav_link">Services</a></li>
          <li><a href="#portfolio" class="nav_link">Portfolio</a></li>
          <li><a href="#contact" class="nav_link">Contact</a></li>
        </ul>
      </div>

      <!-- Right Buttons -->
      <div class="nav_btns">

        <!-- Theme -->
        <button class="theme-toggle" @click="toggleTheme">
          <i :class="isDark ? 'uil-sun' : 'uil-moon'" class="uil theme-icon"></i>
        </button>

        <!-- Mobile Menu -->
        <button class="nav_toggle" @click="toggleMenu">
          <i class="uil uil-bars"></i>
        </button>

      </div>

    </nav>

    <!-- Mobile Menu -->
    <div v-if="showMenu" class="mobile-overlay" @click="toggleMenu">

      <div class="mobile-menu" @click.stop>

        <div class="mobile-header">
          <a href="#home" class="nav_logo">Salem Alburaikie</a>
          <i class="uil uil-times" @click="toggleMenu"></i>
        </div>

        <ul class="mobile-nav-list">
          <li><a href="#home" @click="toggleMenu">Home</a></li>
          <li><a href="#about" @click="toggleMenu">About</a></li>
          <li><a href="#skills" @click="toggleMenu">Skills</a></li>
          <li><a href="#services" @click="toggleMenu">Services</a></li>
          <li><a href="#portfolio" @click="toggleMenu">Portfolio</a></li>
          <li><a href="#contact" @click="toggleMenu">Contact</a></li>
        </ul>

      </div>

    </div>
  </header>
</template>

<style scoped>

/* ================= HEADER ================= */
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  background: rgba(255, 255, 255, 0.92);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--border-color);
}

.dark .header {
  background: rgba(15, 15, 30, 0.92);
}

/* ================= NAV ================= */
.nav {
  height: var(--header-height);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* ================= LOGO ================= */
.nav_logo {
  font-size: 1.85rem;
  font-weight: 700;
  color: var(--title-color);
}

/* ================= NAV MENU ================= */
.nav_list {
  display: flex;
  gap: 2.5rem;
  list-style: none;
}

.nav_link {
  font-weight: 500;
  color: var(--text-color);
  position: relative;
  transition: 0.3s;
}

.nav_link:hover,
.nav_link.active_link {
  color: var(--first-color);
}

.nav_link.active_link::after {
  content: '';
  position: absolute;
  bottom: -6px;
  left: 0;
  width: 100%;
  height: 3px;
  background: var(--first-color);
  border-radius: 3px;
}

/* ================= RIGHT BUTTONS ================= */
.nav_btns {
  display: flex;
  align-items: center;
  gap: 1rem;
}

/* Theme */
.theme-toggle {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  border: 1px solid var(--border-color);
  background: var(--container-color);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 1.3rem;
  transition: 0.3s;
  color: var(--text-color);
}

.theme-toggle:hover {
  background: var(--first-color);
  color: #fff;
  transform: scale(1.05);
}

/* ================= MOBILE BUTTON ================= */
.nav_toggle {
  display: none;
  font-size: 1.8rem;
  cursor: pointer;
  background: none;
  border: none;
  color: var(--text-color);
}

/* ================= MOBILE OVERLAY ================= */
.mobile-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.65);
  backdrop-filter: blur(6px);

  z-index: 9999; /* 🔥 أهم نقطة */

  display: flex;
  justify-content: flex-end;
  align-items: stretch;
}

/* ================= MOBILE MENU ================= */
.mobile-menu {
  width: 85%;
  max-width: 340px;
  height: 100vh; /* 🔥 مهم */

  background: var(--container-color);

  padding: 2rem;

  display: flex;
  flex-direction: column;

  box-shadow: -15px 0 40px rgba(0,0,0,0.25);
  border-left: 1px solid var(--border-color);

  position: relative;

  margin-left: auto;
  transform: translateX(100%);
  animation: slideIn 0.3s ease forwards;
}

@keyframes slideIn {
  to {
    transform: translateX(0);
  }
}

/* Header inside mobile */
.mobile-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 3rem;
}

/* List */
.mobile-nav-list {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;

  margin-top: 2rem;
}

.mobile-nav-list a {
  font-size: 1.25rem;
  font-weight: 500;

  color: var(--title-color);
  display: block;

  padding: 0.6rem 0;
  border-bottom: 1px solid rgba(0,0,0,0.05);

  transition: 0.3s;
}

.mobile-nav-list a:hover {
  color: var(--first-color);
  padding-left: 6px;
}

.dark .mobile-menu {
  background: rgba(20, 20, 35, 0.95);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {

  .nav_list {
    display: none;
  }

  .nav_toggle {
    display: block;
  }
}

</style>