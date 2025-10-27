# Pyramedia Website - TODO

## Phase 1: Setup ✅
- [x] Create PHP project
- [x] Copy portfolio data
- [x] Initialize Git

## Phase 2: Core Files
- [x] Create index.php (Home page)
- [x] Create config.php (Configuration)
- [x] Create header.php (Navigation)
- [x] Create footer.php (Footer)
- [ ] Push to GitHub

## Phase 3: Home Page Sections
- [x] Hero section
- [x] Stats section
- [x] Services section
- [x] Portfolio preview
- [x] CTA section
- [ ] Push to GitHub

## Phase 4: Portfolio Page
- [x] Create portfolio.php
- [x] Grid layout with filters
- [x] Load data from JSON
- [ ] Push to GitHub

## Phase 5: Other Pages
- [x] Create about.php
- [x] Create services.php
- [x] Create contact.php
- [ ] Push to GitHub

## Phase 6: Styling
- [x] Setup Tailwind CSS (CDN)
- [x] Dark - [ ] Dark & Bold theme Bold theme
- [x] Responsive design
- [x] Animations
- [ ] Push to GitHub

## Phase 7: Deploy
- [x] Test locally
- [x] Push final version to GitHub
- [x] Deploy to Coolify
- [x] Test on production


---

## Phase 8: Front-End Upgrade (Based on Brief)

### Brand Identity Update
- [x] Update color scheme (--color-bg: #0b0b0c, --color-accent: #d4af37)
- [ ] Add CSS Variables system
- [ ] Update typography (Tajawal/Cairo for AR, Inter for EN)
- [ ] Add Lucide/Tabler icons (local sprite)

### New Pages
- [x] Create pricing.php (3 packages + CTA)
- [x] Create case-studies.php (detailed case studies)
- [x] Create privacy.php (privacy policy)
- [x] Create 404.php (error page)

### New Components
- [ ] Testimonials slider (auto-slide)
- [x] FAQ accordion with Schema FAQPage
- [x] Pricing toggle (monthly/yearly)
- [ ] Breadcrumbs component
- [ ] Toast/Alert component
- [ ] Badges (New/Offer)

### Multi-language Support (AR/EN)
- [ ] Add language switcher in header
- [ ] Create ar.json and en.json for content
- [ ] Implement RTL/LTR auto-switch
- [ ] Add hreflang tags
- [ ] Update all components for RTL support

### Performance Optimization
- [ ] Convert images to WebP/AVIF
- [ ] Add loading="lazy" to images
- [ ] Implement Critical CSS (inline ≤8KB)
- [ ] Minify CSS and JS
- [ ] Add preload for fonts
- [ ] Add Cache-Control headers

### SEO Enhancement
- [ ] Add meta tags to all pages
- [x] Add OG/Twitter Cards to all pages
- [ ] Implement JSON-LD Schema
- [x] Create robots.txt
- [x] Create sitemap.xml
- [ ] Add breadcrumbs with Schema

### Accessibility (A11y)
- [ ] Ensure color contrast AA
- [ ] Add keyboard navigation
- [ ] Add ARIA labels
- [ ] Add alt text to all images
- [ ] Test with axe-core

### Landing Pages
- [ ] Create landing: Web Design 999 AED
- [ ] Create landing: Real-Estate Automation

### Testing & Deployment
- [ ] Run Lighthouse (target ≥90)
- [ ] Test A11y with axe-core
- [ ] Test AR/EN switching
- [ ] Create STYLEGUIDE.md
- [ ] Push to GitHub
- [ ] Deploy to Coolify
- [ ] Generate Lighthouse report

---

## Phase 9: Advanced SEO

- [x] Add Schema markup (Organization, LocalBusiness, WebSite)
- [x] Add BreadcrumbList Schema
- [ ] Add FAQPage Schema to pricing page
- [x] Create sitemap.xml
- [x] Create robots.txt
- [x] Add OG/Twitter Cards to all pages
- [x] Optimize meta tags
- [ ] Push to GitHub

---

## Phase 10: Admin Dashboard

### Authentication
- [x] Create admin login system
- [x] Secure password hashing
- [x] Session management
- [x] Remember me functionality

### Dashboard
- [ ] Create admin dashboard layout
- [ ] Statistics overview
- [ ] Quick actions

### Portfolio Management
- [ ] List all portfolio items
- [ ] Add new portfolio item
- [ ] Edit portfolio item
- [ ] Delete portfolio item
- [ ] Upload images

### Services Management
- [ ] List all services
- [ ] Edit service content
- [ ] Toggle service visibility

### Messages Management
- [ ] View contact form messages
- [ ] Mark as read/unread
- [ ] Delete messages
- [ ] Reply to messages

### Settings
- [ ] Site information
- [ ] Contact details
- [ ] Social media links
- [ ] SEO settings

### Security
- [x] CSRF protection
- [x] SQL injection prevention
- [x] XSS protection
- [ ] File upload validation

### Final
- [ ] Test all admin features
- [ ] Push to GitHub
- [ ] Deploy to Coolify
- [x] Fix: Headers already sent error in admin/login.php
- [x] Fix: Undefined constant SITE_TITLE in index.php

## Phase 11: Portfolio Images & Content Enhancement
- [x] Extract images from PDF
- [x] Generate professional content with hooks
- [x] Update portfolio.json with enhanced content
- [ ] Upload images to public/images/portfolio/
- [ ] Test portfolio page



---

## Phase 12: Critical Bug Fixes & Portfolio Integration (URGENT)

### 12.1 PHP Errors
- [x] Fix PHP deprecation error in portfolio.php line 60
- [ ] Add null checks before using mb_substr
- [ ] Test portfolio.php to ensure no errors appear

### 12.2 Admin Dashboard - Portfolio Integration
- [x] Create function to read pyramedia-portfolio.json
- [ ] Import JSON data into portfolio_items table
- [ ] Verify Admin Dashboard shows 21 projects (not 0)
- [ ] Test CRUD operations in Admin Panel

### 12.3 Data Accuracy Issues
- [ ] Fix incorrect client names (6 projects showing "Dubai Municipality" incorrectly)
- [ ] Correct "Calendar Design" project (missing client name)
- [ ] Verify all 21 projects have correct client names
- [ ] Match data with pyramedia-portfolio.json

### 12.4 Database Population
- [x] Generate SQL INSERT statements from pyramedia-portfolio.json
- [ ] Execute SQL to populate portfolio_items table
- [ ] Verify data integrity in database
- [ ] Test portfolio display after database update

### 12.5 Portfolio Page Redesign
- [ ] Replace basic grid with modern masonry/card layout
- [ ] Add smooth hover effects with scale/shadow animations
- [ ] Implement glassmorphism cards matching Dark & Bold theme
- [ ] Add gradient overlays on hover
- [ ] Replace letter placeholders with professional images

### 12.6 Testing & Deployment
- [ ] Test all pages for PHP errors
- [ ] Commit all changes to GitHub
- [ ] Deploy via Coolify
- [ ] Test live website

---

**Priority Tasks (Do First):**
1. Fix PHP deprecation error
2. Import JSON to database
3. Fix client names
4. Test and deploy




---

## Phase 13: Critical Fixes & Comprehensive Audit (URGENT)

### 13.1 Critical Errors
- [x] Fix Fatal Error in portfolio.php: array_slice() error fixed
- [x] Fix Admin Portfolio: Add "Edit" button with full functionality
- [ ] Test all CRUD operations in Admin Panel

### 13.2 Comprehensive Website Audit
- [ ] Check all PHP files for errors and warnings
- [ ] Verify database connections and queries
- [ ] Test all pages for functionality
- [ ] Check file relationships and dependencies
- [ ] Validate HTML/CSS/JavaScript

### 13.3 Admin Dashboard Improvements
- [ ] Add Edit functionality to Portfolio management
- [ ] Create edit_portfolio.php page
- [ ] Add Edit button to each portfolio item
- [ ] Test Edit workflow (load data, update, save)

### 13.4 Portfolio Page Improvements
- [ ] Simplify filter buttons (too many categories)
- [ ] Group similar categories
- [ ] Improve filter UX
- [ ] Fix array_slice error

### 13.5 Design Enhancements
- [ ] Review and improve overall design consistency
- [ ] Add modern UI elements (glassmorphism, gradients)
- [ ] Improve hover effects and animations
- [ ] Enhance mobile responsiveness

### 13.6 New Features & Ideas
- [ ] Add search functionality to portfolio
- [ ] Add pagination or infinite scroll
- [ ] Add project detail modal/page
- [ ] Add testimonials section
- [ ] Add contact form validation
- [ ] Add loading states and transitions

### 13.7 Documentation
- [ ] Create comprehensive RECAP document
- [ ] Document all features and functionality
- [ ] Create troubleshooting guide
- [ ] Update README.md

---

**Current Priority:** Fix Fatal Error + Add Edit Button

