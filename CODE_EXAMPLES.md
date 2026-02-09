# Code Examples - Responsive UI & Animations

## 📋 Table of Contents
1. [CSS Animation Examples](#css-animation-examples)
2. [Responsive Design Examples](#responsive-design-examples)
3. [JavaScript Examples](#javascript-examples)
4. [HTML Structure Examples](#html-structure-examples)

---

## CSS Animation Examples

### 1. Fade In Animation
```css
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.element {
    animation: fadeIn 0.6s ease;
}
```

### 2. Slide In From Left
```css
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.element {
    animation: slideInLeft 0.8s ease;
}
```

### 3. Scale In From Center
```css
@keyframes scaleInCenter {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.element {
    animation: scaleInCenter 0.6s ease-out;
}
```

### 4. Float/Bounce Animation
```css
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

.element {
    animation: float 3s ease-in-out infinite;
}
```

### 5. Staggered Animation
```css
/* Apply to multiple elements */
.product-card {
    animation: slideInUp 0.6s ease-out backwards;
}

/* Add delay to each */
.product-card:nth-child(1) { animation-delay: 0.1s; }
.product-card:nth-child(2) { animation-delay: 0.2s; }
.product-card:nth-child(3) { animation-delay: 0.3s; }
.product-card:nth-child(4) { animation-delay: 0.4s; }
```

### 6. Hover Lift Effect
```css
.card {
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}
```

### 7. Glow Effect
```css
@keyframes glow {
    0%, 100% {
        box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
    }
    50% {
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.6);
    }
}

.element {
    animation: glow 2s infinite;
}
```

### 8. Pulse/Breathing Effect
```css
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

.badge {
    animation: pulse 2s infinite;
}
```

### 9. Shimmer Effect
```css
@keyframes shimmer {
    0% {
        background-position: -1000px 0;
    }
    100% {
        background-position: 1000px 0;
    }
}

.loading {
    background-image: linear-gradient(
        90deg,
        transparent 0%,
        rgba(255, 255, 255, 0.2) 50%,
        transparent 100%
    );
    background-size: 1000px 100%;
    animation: shimmer 2s infinite;
}
```

### 10. Bounce Animation
```css
@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

.button:hover {
    animation: bounce 0.5s ease;
}
```

---

## Responsive Design Examples

### 1. Mobile-First Grid Layout
```css
/* Mobile - 1 column (default) */
.grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}

/* Tablet - 2 columns */
@media (min-width: 768px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

/* Desktop - 3 columns */
@media (min-width: 1024px) {
    .grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }
}

/* Large Desktop - 4 columns */
@media (min-width: 1200px) {
    .grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }
}
```

### 2. Responsive Typography
```css
/* Mobile sizes (default) */
h1 {
    font-size: 24px;
    line-height: 1.2;
}

h2 {
    font-size: 20px;
}

body {
    font-size: 14px;
}

/* Tablet sizes */
@media (min-width: 768px) {
    h1 {
        font-size: 32px;
    }
    
    h2 {
        font-size: 24px;
    }
    
    body {
        font-size: 16px;
    }
}

/* Desktop sizes */
@media (min-width: 1024px) {
    h1 {
        font-size: 48px;
    }
    
    h2 {
        font-size: 32px;
    }
    
    body {
        font-size: 16px;
    }
}
```

### 3. Responsive Padding/Margin
```css
/* Mobile */
.container {
    padding: 15px;
    margin: 10px 0;
}

/* Tablet */
@media (min-width: 768px) {
    .container {
        padding: 20px;
        margin: 20px 0;
    }
}

/* Desktop */
@media (min-width: 1024px) {
    .container {
        padding: 30px;
        margin: 30px 0;
    }
}
```

### 4. Responsive Flexbox
```css
/* Mobile - Stack vertically */
.flex-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Tablet - Wrap if needed */
@media (min-width: 768px) {
    .flex-container {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 20px;
    }
}

/* Desktop - No wrap */
@media (min-width: 1024px) {
    .flex-container {
        flex-wrap: nowrap;
        gap: 30px;
    }
}
```

### 5. Hide/Show Elements Responsively
```css
/* Hide on mobile */
.desktop-only {
    display: none;
}

/* Show on tablet and up */
@media (min-width: 768px) {
    .desktop-only {
        display: block;
    }
}

/* Hide navigation on mobile, show menu button */
nav {
    display: none;
}

.mobile-menu-toggle {
    display: block;
}

@media (min-width: 769px) {
    nav {
        display: flex;
    }
    
    .mobile-menu-toggle {
        display: none;
    }
}
```

### 6. Responsive Image
```css
/* Responsive image */
img {
    max-width: 100%;
    height: auto;
    display: block;
}

/* Different image widths */
.product-image {
    width: 100%;
    max-width: 300px;
}

@media (min-width: 768px) {
    .product-image {
        max-width: 400px;
    }
}

@media (min-width: 1024px) {
    .product-image {
        max-width: 500px;
    }
}
```

### 7. Responsive Button
```css
.btn {
    padding: 12px 24px;
    font-size: 14px;
    min-height: 44px; /* Touch target */
}

@media (min-width: 768px) {
    .btn {
        padding: 14px 28px;
        font-size: 16px;
    }
}

@media (min-width: 1024px) {
    .btn {
        padding: 16px 32px;
        font-size: 18px;
    }
}
```

---

## JavaScript Examples

### 1. Mobile Menu Toggle
```javascript
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const mobileNav = document.getElementById('mobileNav');

mobileMenuToggle.addEventListener('click', function() {
    mobileNav.classList.toggle('active');
    mobileMenuToggle.classList.toggle('active');
});

// Close menu when link clicked
const navLinks = mobileNav.querySelectorAll('a');
navLinks.forEach(link => {
    link.addEventListener('click', function() {
        mobileNav.classList.remove('active');
        mobileMenuToggle.classList.remove('active');
    });
});
```

### 2. Intersection Observer for Animations
```javascript
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'fadeIn 0.8s ease forwards';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all product cards
document.querySelectorAll('.product-card').forEach(el => {
    el.style.opacity = '0';
    observer.observe(el);
});
```

### 3. Smooth Scroll to Element
```javascript
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
```

### 4. Detect Mobile Device
```javascript
function isMobileDevice() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

// Usage
if (isMobileDevice()) {
    console.log('Mobile device detected');
} else {
    console.log('Desktop device detected');
}
```

### 5. Detect Touch Support
```javascript
function isTouchDevice() {
    return (('ontouchstart' in window) ||
            (navigator.maxTouchPoints > 0) ||
            (navigator.msMaxTouchPoints > 0));
}

// Usage
if (isTouchDevice()) {
    // Remove hover effects, use active states instead
    document.body.classList.add('touch-device');
}
```

### 6. Media Query Listener
```javascript
const mobileQuery = window.matchMedia('(max-width: 768px)');

function handleMobileChange(e) {
    if (e.matches) {
        console.log('Mobile view');
        // Do something on mobile
    } else {
        console.log('Desktop view');
        // Do something on desktop
    }
}

mobileQuery.addEventListener('change', handleMobileChange);

// Initial check
handleMobileChange(mobileQuery);
```

### 7. Close Menu When Clicking Outside
```javascript
document.addEventListener('click', function(event) {
    const isClickInsideNav = mobileNav.contains(event.target);
    const isClickOnToggle = mobileMenuToggle.contains(event.target);
    
    if (!isClickInsideNav && !isClickOnToggle) {
        mobileNav.classList.remove('active');
        mobileMenuToggle.classList.remove('active');
    }
});
```

### 8. Prevent Body Scroll When Menu Open
```javascript
const mobileNav = document.getElementById('mobileNav');

const observer = new MutationObserver(() => {
    if (mobileNav.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = 'auto';
    }
});

observer.observe(mobileNav, { attributes: true, attributeFilter: ['class'] });
```

---

## HTML Structure Examples

### 1. Responsive Navigation
```html
<!-- Desktop Navigation -->
<nav class="nav">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">About</a></li>
    </ul>
</nav>

<!-- Mobile Navigation -->
<button class="mobile-menu-toggle" id="mobileMenuToggle">☰</button>
<nav class="mobile-nav" id="mobileNav">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">About</a></li>
    </ul>
</nav>
```

### 2. Responsive Grid
```html
<div class="grid">
    <div class="grid-item">Item 1</div>
    <div class="grid-item">Item 2</div>
    <div class="grid-item">Item 3</div>
    <div class="grid-item">Item 4</div>
</div>

<style>
.grid {
    display: grid;
    grid-template-columns: 1fr; /* Mobile */
}

@media (min-width: 768px) {
    .grid {
        grid-template-columns: repeat(2, 1fr); /* Tablet */
    }
}

@media (min-width: 1024px) {
    .grid {
        grid-template-columns: repeat(4, 1fr); /* Desktop */
    }
}
</style>
```

### 3. Responsive Hero Section
```html
<section class="hero">
    <div class="hero-content">
        <h1>Welcome</h1>
        <p>Your subtitle here</p>
        <a href="#" class="btn">Shop Now</a>
    </div>
</section>

<style>
.hero {
    height: 300px; /* Mobile */
    padding: 20px;
    text-align: center;
}

@media (min-width: 768px) {
    .hero {
        height: 400px;
        padding: 30px;
    }
}

@media (min-width: 1024px) {
    .hero {
        height: 600px;
        padding: 40px;
    }
}

.hero h1 {
    font-size: 24px; /* Mobile */
}

@media (min-width: 768px) {
    .hero h1 {
        font-size: 36px;
    }
}

@media (min-width: 1024px) {
    .hero h1 {
        font-size: 48px;
    }
}
</style>
```

### 4. Touch-Friendly Button
```html
<button class="btn btn-large">
    Click Me
</button>

<style>
.btn {
    padding: 12px 24px;
    min-height: 44px; /* iOS touch target */
    min-width: 44px;
    cursor: pointer;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn:active {
    transform: scale(0.95);
}

.btn:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}
</style>
```

---

## 🎯 Best Practices

### Do ✅
- Use `transform` for animations (GPU accelerated)
- Test on real devices
- Use mobile-first approach
- Provide touch-friendly sizes (44px minimum)
- Optimize images for different sizes
- Test animations on low-end devices

### Don't ❌
- Animate `width`, `height`, `top`, `left` properties
- Use complex animations on mobile
- Ignore accessibility
- Animate too many elements simultaneously
- Skip testing on different devices
- Use JavaScript for animations that CSS can handle

---

**Last Updated**: January 31, 2026
**Version**: 1.0
