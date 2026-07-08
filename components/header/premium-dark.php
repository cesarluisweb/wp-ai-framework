<?php
/**
 * Header Component - Premium Dark (Floating Pill)
 * 
 * Expected $data variables:
 * - $site_name (string)
 * - $nav_links (array of arrays: label, url)
 * - $cta_button (array: label, url)
 */

$site_name = $data['site_name'] ?? 'César Luis Amundaray';
$nav_links = $data['nav_links'] ?? [];
$cta_button = $data['cta_button'] ?? null;
?>

<header class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-gray-950/80 backdrop-blur-xl border-b border-gray-800/50" id="main-header">
    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 py-5 flex items-center justify-between">
        
        <!-- Logo / Name -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 text-xl font-black text-white tracking-tight hover:text-brand-300 transition-colors duration-300">
            <!-- Monograma C -->
            <div class="relative w-8 h-8 flex items-center justify-center rounded-lg bg-gradient-to-br from-brand-400/20 to-brand-600/10 border border-brand-500/30">
                <span class="text-brand-300 font-black text-lg leading-none mt-0.5">C</span>
            </div>
            <span>César Luis</span>
        </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-8">
                <ul class="flex items-center gap-8">
                    <?php foreach ($nav_links as $link): ?>
                    <li>
                        <a href="<?php echo esc_url($link['url']); ?>" class="text-sm font-medium text-gray-300 hover:text-brand-300 transition-colors duration-300">
                            <?php echo esc_html($link['label']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                
                <?php if ($cta_button): ?>
                <div class="pl-8 border-l border-gray-700/50">
                    <a href="<?php echo esc_url($cta_button['url']); ?>" class="btn-primary-sm">
                        <?php echo esc_html($cta_button['label']); ?>
                    </a>
                </div>
                <?php endif; ?>
            </nav>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-300 hover:text-white focus:outline-none" id="mobile-menu-btn" aria-label="Toggle menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
    </div>

    <!-- Mobile Menu Overlay (Hidden by default) -->
    <div class="fixed inset-0 bg-gray-950/95 backdrop-blur-3xl z-40 hidden flex-col items-center justify-center opacity-0 transition-opacity duration-300" id="mobile-menu">
        <button class="absolute top-8 right-8 text-gray-400 hover:text-white" id="mobile-menu-close">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <ul class="flex flex-col items-center gap-8 text-2xl font-bold">
            <?php foreach ($nav_links as $link): ?>
            <li>
                <a href="<?php echo esc_url($link['url']); ?>" class="text-gray-300 hover:text-brand-300 transition-colors duration-300 mobile-link">
                    <?php echo esc_html($link['label']); ?>
                </a>
            </li>
            <?php endforeach; ?>
            
            <?php if ($cta_button): ?>
            <li class="mt-4">
                <a href="<?php echo esc_url($cta_button['url']); ?>" class="inline-flex items-center justify-center px-8 py-4 text-xl font-bold text-gray-950 bg-brand-400 rounded-xl mobile-link">
                    <?php echo esc_html($cta_button['label']); ?>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnOpen = document.getElementById('mobile-menu-btn');
    const btnClose = document.getElementById('mobile-menu-close');
    const menu = document.getElementById('mobile-menu');
    const links = document.querySelectorAll('.mobile-link');
    
    function toggleMenu() {
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            setTimeout(() => { menu.classList.remove('opacity-0'); }, 10);
            document.body.style.overflow = 'hidden';
        } else {
            menu.classList.add('opacity-0');
            setTimeout(() => { menu.classList.add('hidden'); }, 300);
            document.body.style.overflow = '';
        }
    }
    
    if (btnOpen && btnClose && menu) {
        btnOpen.addEventListener('click', toggleMenu);
        btnClose.addEventListener('click', toggleMenu);
        links.forEach(link => link.addEventListener('click', toggleMenu));
    }
});
</script>
