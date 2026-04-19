<template>
  <footer class="footer">
    <div class="footer_container container">
      <div class="footer_main grid">
        <!-- Left Column -->
        <div class="footer_col">
          <h2 class="footer_logo">Salem Alburaikie</h2>
          <p class="footer_tagline">Full-Stack & Mobile Developer</p>
          <p class="footer_description">
            Crafting exceptional digital experiences with modern technologies.
          </p>
        </div>

        <!-- Quick Links -->
        <div class="footer_col">
          <h4 class="footer_heading">Quick Links</h4>
          <ul class="footer_links">
            <li><a href="#about">About Me</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#portfolio">Portfolio</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>

        <!-- Connect -->
        <div class="footer_col">
          <h4 class="footer_heading">Connect With Me</h4>
          <div class="footer_socials">
            <a href="https://www.instagram.com/sa_alburaikie10" target="_blank" class="footer_social">
              <i class="uil uil-instagram"></i>
            </a>
            <a href="#" target="_blank" class="footer_social">
              <i class="uil uil-linkedin-alt"></i>
            </a>
            <a href="https://github.com/sa-alburaikie" target="_blank" class="footer_social">
              <i class="uil uil-github-alt"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Copyright -->
      <div class="footer_bottom">
        <p>© {{ new Date().getFullYear() }} Salem Alburaikie. All Rights Reserved.</p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background: linear-gradient(135deg, 
    hsl(var(--hue-color), 65%, 92%), 
    hsl(var(--hue-color), 55%, 88%));
  color: hsl(var(--hue-color), 30%, 25%);
  padding: 6rem 0 3rem;
  transition: background 0.6s ease, color 0.6s ease;
}

/* Dark Mode */
.dark .footer {
  background: linear-gradient(135deg, 
    hsl(var(--hue-color), 28%, 14%), 
    hsl(var(--hue-color), 32%, 10%));
  color: hsl(var(--hue-color), 20%, 85%);
}

.footer_container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 2rem;
}

.footer_main {
  grid-template-columns: 2fr 1fr 1fr;
  gap: 4rem;
  margin-bottom: 5rem;
}

.footer_logo {
  font-size: 2.45rem;
  font-weight: 700;
  letter-spacing: -0.04em;
  color: hsl(var(--hue-color), 70%, 22%);
  margin-bottom: 0.6rem;
}

.dark .footer_logo {
  color: white;
}

.footer_tagline {
  color: var(--first-color);
  font-weight: 600;
  margin-bottom: 1.3rem;
}

.footer_description {
  color: hsl(var(--hue-color), 30%, 38%);
  max-width: 340px;
  line-height: 1.75;
}

.dark .footer_description {
  color: hsl(var(--hue-color), 20%, 75%);
}

.footer_heading {
  color: hsl(var(--hue-color), 70%, 22%);
  font-size: 1.18rem;
  margin-bottom: 1.5rem;
  font-weight: 600;
}

.dark .footer_heading {
  color: white;
}

.footer_links {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.footer_links a {
  color: hsl(var(--hue-color), 30%, 35%);
  transition: color 0.3s ease;
}

.dark .footer_links a {
  color: hsl(var(--hue-color), 20%, 78%);
}

.footer_links a:hover {
  color: var(--first-color);
}

.footer_socials {
  display: flex;
  gap: 1.3rem;
}

.footer_social {
  width: 54px;
  height: 54px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.55rem;
  color: hsl(var(--hue-color), 40%, 40%);
  background: rgba(255,255,255,0.75);
  border: 1px solid rgba(124, 58, 237, 0.2);
  border-radius: 50%;
  transition: all 0.4s ease;
}

.dark .footer_social {
  background: rgba(255,255,255,0.08);
  border-color: rgba(255,255,255,0.15);
  color: hsl(var(--hue-color), 20%, 80%);
}

.footer_social:hover {
  background: var(--first-color);
  color: white;
  transform: translateY(-6px);
  box-shadow: 0 12px 25px rgba(124, 58, 237, 0.3);
}

.footer_bottom {
  text-align: center;
  padding-top: 2.8rem;
  border-top: 1px solid rgba(124, 58, 237, 0.15);
  color: hsl(var(--hue-color), 30%, 45%);
  font-size: 0.97rem;
}

.dark .footer_bottom {
  border-color: rgba(255,255,255,0.1);
  color: hsl(var(--hue-color), 20%, 65%);
}

/* Responsive */
@media (max-width: 992px) {
  .footer_main {
    grid-template-columns: 1fr 1fr;
  }
}

@media (max-width: 640px) {
  .footer_main {
    grid-template-columns: 1fr;
    gap: 3rem;
  }
}
</style>