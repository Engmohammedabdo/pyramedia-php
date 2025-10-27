<?php
require_once 'config.php';
$page_title = 'سابقة أعمالنا';
include 'header.php';
$portfolio = get_portfolio_data();

// Get unique categories
$categories = array_unique(array_column($portfolio, 'category'));
sort($categories);
?>

<!-- Page Header -->
<section class="relative py-32 overflow-hidden">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark-lighter to-dark">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-accent-gold rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 1s;"></div>
        </div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-12">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
            سابقة <span class="gradient-text">أعمالنا</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto">
            نفخر بتقديم حلول تسويقية مبتكرة لأكثر من 200 عميل من القطاعين الحكومي والخاص
        </p>
    </div>
</section>

<!-- Portfolio Section -->
<section class="py-16 md:py-24 bg-dark-lighter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button onclick="filterProjects('all')" class="filter-btn active px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                الكل (<?php echo count($portfolio); ?>)
            </button>
            <?php foreach ($categories as $category): ?>
                <?php $count = count(array_filter($portfolio, function($p) use ($category) { return $p['category'] === $category; })); ?>
                <button onclick="filterProjects('<?php echo strtolower(str_replace(' ', '-', $category)); ?>')" class="filter-btn px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                    <?php echo $category; ?> (<?php echo $count; ?>)
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Portfolio Grid -->
        <div id="portfolio-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($portfolio as $index => $project): ?>
                <div class="portfolio-item animate-fade-in-up" 
                     data-category="<?php echo strtolower(str_replace(' ', '-', $project['category'])); ?>"
                     style="animation-delay: <?php echo ($index % 6) * 0.1; ?>s;">
                    <div class="bg-dark rounded-xl p-6 border border-dark-light transition-all duration-300 hover:border-primary hover:shadow-lg hover:shadow-primary/20 hover:-translate-y-1 group overflow-hidden h-full flex flex-col">
                        <!-- Project Image Placeholder -->
                        <div class="relative h-48 bg-gradient-to-br from-primary/20 to-accent-gold/20 rounded-lg mb-6 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-6xl font-bold text-white/10">
                                    <?php echo mb_substr($project['client_name'], 0, 1); ?>
                                </div>
                            </div>
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <div class="text-sm text-white">
                                    <p class="font-semibold mb-1">العميل: <?php echo $project['client_name']; ?></p>
                                    <p class="text-gray-300"><?php echo $project['project_title']; ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Project Info -->
                        <div class="flex-1 flex flex-col">
                            <!-- Category Badge -->
                            <span class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-medium mb-3 w-fit">
                                <?php echo $project['category']; ?>
                            </span>

                            <!-- Client Name -->
                            <h3 class="text-xl font-bold mb-2"><?php echo $project['client_name']; ?></h3>

                            <!-- Project Title -->
                            <p class="text-gray-400 mb-4 flex-1"><?php echo $project['project_title']; ?></p>

                            <!-- Services -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php foreach (array_slice($project['services'], 0, 3) as $service): ?>
                                    <span class="px-2 py-1 rounded text-xs bg-dark-lighter text-gray-300 border border-dark-light">
                                        <?php echo $service; ?>
                                    </span>
                                <?php endforeach; ?>
                                <?php if (count($project['services']) > 3): ?>
                                    <span class="px-2 py-1 rounded text-xs bg-dark-lighter text-primary border border-primary/30">
                                        +<?php echo count($project['services']) - 3; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- View Details Button -->
                            <button onclick="showProjectDetails(<?php echo $index; ?>)" class="inline-flex items-center gap-2 text-primary hover:gap-3 transition-all duration-300 mt-auto">
                                <span>عرض التفاصيل</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary/10 text-primary mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-2">لا توجد مشاريع في هذه الفئة</h3>
            <p class="text-gray-400">جرب فئة أخرى أو اعرض جميع المشاريع</p>
        </div>
    </div>
</section>

<!-- Project Details Modal -->
<div id="project-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-dark-lighter rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-dark-light">
        <div class="p-6">
            <!-- Close Button -->
            <button onclick="closeProjectModal()" class="float-left p-2 rounded-lg hover:bg-white/5 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Modal Content -->
            <div id="modal-content"></div>
        </div>
    </div>
</div>

<script>
// Portfolio data
const portfolioData = <?php echo json_encode($portfolio); ?>;

// Filter projects
function filterProjects(category) {
    const items = document.querySelectorAll('.portfolio-item');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const emptyState = document.getElementById('empty-state');
    let visibleCount = 0;

    // Update active button
    filterBtns.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    // Filter items
    items.forEach((item, index) => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            item.style.animationDelay = `${(visibleCount % 6) * 0.1}s`;
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    // Show/hide empty state
    if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
    } else {
        emptyState.classList.add('hidden');
    }
}

// Show project details
function showProjectDetails(index) {
    const project = portfolioData[index];
    const modal = document.getElementById('project-modal');
    const content = document.getElementById('modal-content');

    content.innerHTML = `
        <div class="pt-12">
            <!-- Project Image Placeholder -->
            <div class="relative h-64 bg-gradient-to-br from-primary/20 to-accent-gold/20 rounded-lg mb-6 overflow-hidden">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-8xl font-bold text-white/10">
                        ${project.client_name.charAt(0)}
                    </div>
                </div>
            </div>

            <!-- Category Badge -->
            <span class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-medium mb-4">
                ${project.category}
            </span>

            <!-- Client Name -->
            <h2 class="text-3xl font-bold mb-2">${project.client_name}</h2>

            <!-- Project Title -->
            <p class="text-xl text-gray-300 mb-6">${project.project_title}</p>

            <!-- Services -->
            <div class="mb-6">
                <h3 class="text-lg font-bold mb-3">الخدمات المقدمة:</h3>
                <div class="flex flex-wrap gap-2">
                    ${project.services.map(service => `
                        <span class="px-3 py-1 rounded-lg text-sm bg-dark text-gray-300 border border-dark-light">
                            ${service}
                        </span>
                    `).join('')}
                </div>
            </div>

            <!-- CTA -->
            <div class="flex gap-4 pt-6 border-t border-dark-light">
                <a href="<?php echo url('contact.php'); ?>" class="flex-1 px-6 py-3 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 text-center">
                    ابدأ مشروعك الآن
                </a>
                <button onclick="closeProjectModal()" class="px-6 py-3 bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-lg font-semibold transition-all duration-300">
                    إغلاق
                </button>
            </div>
        </div>
    `;

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Close modal
function closeProjectModal() {
    const modal = document.getElementById('project-modal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on outside click
document.getElementById('project-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProjectModal();
    }
});

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProjectModal();
    }
});

// Add active state to filter buttons
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('active', 'bg-primary', 'text-white');
            b.classList.add('bg-dark', 'text-gray-300', 'hover:bg-dark-light');
        });
        this.classList.add('active', 'bg-primary', 'text-white');
        this.classList.remove('bg-dark', 'text-gray-300', 'hover:bg-dark-light');
    });
});

// Set initial active state
document.querySelector('.filter-btn.active').classList.add('bg-primary', 'text-white');
document.querySelectorAll('.filter-btn:not(.active)').forEach(btn => {
    btn.classList.add('bg-dark', 'text-gray-300', 'hover:bg-dark-light');
});
</script>

<style>
.filter-btn.active {
    @apply bg-primary text-white;
}

.filter-btn:not(.active) {
    @apply bg-dark text-gray-300 hover:bg-dark-light;
}
</style>

<?php include 'footer.php'; ?>
