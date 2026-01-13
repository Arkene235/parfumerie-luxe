<template>
    <PublicLayout title="Parfumerie de Luxe">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-cyan-50">
            <!-- Hero Section -->
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-blue-800 to-cyan-800 text-white">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-cyan-500/20"></div>
                </div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                    <div class="text-center">
                        <div class="mb-8">
                            <span class="inline-block px-4 py-2 bg-white bg-opacity-10 backdrop-blur-sm rounded-full text-sm font-medium mb-4">
                                ✨ Collection Exclusive 2026
                            </span>
                        </div>
                        <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white to-cyan-200 bg-clip-text text-transparent">
                            Parfumerie
                            <span class="block text-4xl md:text-5xl font-light">de Luxe</span>
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto leading-relaxed">
                            Découvrez notre collection exclusive de parfums haut de gamme, élaborés avec les ingrédients les plus précieux du monde.
                        </p>
                        <div class="flex flex-wrap justify-center gap-4 mb-12">
                            <span class="bg-white bg-opacity-20 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-medium border border-white border-opacity-20 hover:bg-opacity-30 transition-all duration-300">
                                ✨ Luxe & Élégance
                            </span>
                            <span class="bg-white bg-opacity-20 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-medium border border-white border-opacity-20 hover:bg-opacity-30 transition-all duration-300">
                                🌸 Notes Exquises
                            </span>
                            <span class="bg-white bg-opacity-20 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-medium border border-white border-opacity-20 hover:bg-opacity-30 transition-all duration-300">
                                💎 Qualité Premium
                            </span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <button @click="scrollToProducts" class="bg-white text-blue-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-blue-50 transform hover:scale-105 transition-all duration-300 shadow-xl">
                                Explorer la Collection
                            </button>
                            <Link :href="route('about.index')" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-900 transform hover:scale-105 transition-all duration-300 inline-block text-center">
                                Notre Histoire
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0">
                    <svg viewBox="0 0 1440 120" class="w-full h-12 md:h-20">
                        <path fill="#ffffff" d="M0,32L48,37.3C96,43,192,53,288,58.7C384,64,480,64,576,58.7C672,53,768,43,864,48C960,53,1056,75,1152,80C1248,85,1344,75,1392,69.3L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
                    </svg>
                </div>
            </div>

            <!-- Products Section -->
            <div id="products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <!-- Search and Filters -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 mb-12 border border-blue-100">
                    <div class="flex flex-col lg:flex-row gap-6 items-center">
                        <div class="flex-1 w-full">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input
                                    v-model="search"
                                    type="text"
                                    placeholder="Rechercher des parfums exquis..."
                                    class="w-full pl-12 pr-4 py-4 border-2 border-blue-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-500 text-lg transition-all duration-300"
                                    @input="debouncedSearch"
                                >
                            </div>
                        </div>
                        <div class="w-full lg:w-80">
                            <div class="relative">
                                <select
                                    v-model="selectedCategory"
                                    class="w-full px-6 py-4 border-2 border-blue-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-500 text-lg bg-white appearance-none cursor-pointer transition-all duration-300"
                                    @change="filterByCategory"
                                >
                                    <option value="">Toutes les catégories</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                        <div v-if="products.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            <div v-for="product in products.data" :key="product.id" class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-blue-100 overflow-hidden">
                                <div class="relative overflow-hidden">
                                    <div class="aspect-square bg-gradient-to-br from-blue-50 to-cyan-50 flex items-center justify-center p-8">
                                        <img v-if="product.image" :src="product.image" :alt="product.name" class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                                        <div v-else class="text-8xl opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                                            💐
                                        </div>
                                    </div>
                                    <div class="absolute top-4 right-4">
                                        <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded-full p-2 shadow-lg">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-4 py-2 rounded-full text-sm font-semibold text-center shadow-lg">
                                            Nouveau
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-6">
                                    <div class="text-center mb-4">
                                        <Link :href="route('products.show', product.id)" class="text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors duration-300 block mb-2">
                                            {{ product.name }}
                                        </Link>
                                        <p class="text-blue-600 font-medium text-sm uppercase tracking-wide">{{ product.category.name }}</p>
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm mb-4 text-center line-clamp-2">{{ product.description }}</p>
                                    
                                    <!-- Rating -->
                                    <div class="flex items-center justify-center mb-4">
                                        <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full">
                                            <div class="flex items-center">
                                                <div v-for="star in 5" :key="star" class="text-yellow-400">
                                                    <svg v-if="star <= Math.round(product.rating)" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                    <svg v-else class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                </div>
                                                <span class="ml-2 text-sm text-gray-600 font-medium">
                                                    {{ product.review_count }} avis
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center mb-6">
                                        <div class="text-3xl font-bold text-blue-600 mb-1">{{ product.price }} DH</div>
                                        <div class="text-sm text-gray-500">Stock: {{ product.stock }}</div>
                                    </div>
                                    
                                    <div class="flex gap-3">
                                        <Link
                                            :href="route('cart.add', product.id)"
                                            method="post"
                                            as="button"
                                            class="flex-1 bg-gradient-to-r from-blue-600 to-cyan-600 text-white py-3 px-6 rounded-2xl font-semibold hover:from-blue-700 hover:to-cyan-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
                                            :disabled="product.stock === 0"
                                        >
                                            <span v-if="product.stock > 0">Ajouter au Panier</span>
                                            <span v-else>Épuisé</span>
                                        </Link>
                                        <Link
                                            v-if="$page.props.auth.user"
                                            :href="route('wishlist.toggle', product.id)"
                                            method="post"
                                            as="button"
                                            class="bg-gray-100 text-gray-600 p-3 rounded-2xl hover:bg-blue-100 hover:text-blue-600 transform hover:scale-105 transition-all duration-300"
                                            title="Ajouter à la liste de souhaits"
                                        >
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else class="text-center py-16">
                            <div class="text-gray-400 mb-4">
                                <svg class="mx-auto h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-600 mb-2">Aucun parfum trouvé</h3>
                            <p class="text-gray-500 mb-6">Essayez de modifier vos critères de recherche.</p>
                            <button @click="clearFilters" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition-colors duration-300">
                                Effacer les filtres
                            </button>
                        </div>

                        <!-- Pagination -->
                        <div v-if="products.last_page > 1" class="mt-6 flex justify-center">
                            <div class="flex space-x-2">
                                <Link
                                    v-if="products.prev_page_url"
                                    :href="products.prev_page_url"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                >
                                    Previous
                                </Link>
                                <span v-for="page in pageNumbers" :key="page" class="px-4 py-2">
                                    <Link
                                        v-if="page !== products.current_page"
                                        :href="getPageUrl(page)"
                                        class="text-blue-500 hover:underline"
                                    >
                                        {{ page }}
                                    </Link>
                                    <span v-else class="bg-blue-500 text-white px-2 py-1 rounded">
                                        {{ page }}
                                    </span>
                                </span>
                                <Link
                                    v-if="products.next_page_url"
                                    :href="products.next_page_url"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                >
                                    Next
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </PublicLayout>
</template>

<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    products: Object,
    categories: Array,
    filters: Object,
});

const search = ref(props.filters.search || '');
const selectedCategory = ref(props.filters.category || '');

const debouncedSearch = (() => {
    let timeout;
    return () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            updateFilters();
        }, 300);
    };
})();

const filterByCategory = () => {
    updateFilters();
};

const updateFilters = () => {
    const params = {};

    if (search.value) {
        params.search = search.value;
    }

    if (selectedCategory.value) {
        params.category = selectedCategory.value;
    }

    router.get('/products', params, {
        preserveState: true,
        replace: true,
    });
};

const pageNumbers = computed(() => {
    const current = props.products.current_page;
    const last = props.products.last_page;
    const delta = 2;
    const range = [];
    const rangeWithDots = [];

    for (let i = Math.max(2, current - delta); i <= Math.min(last - 1, current + delta); i++) {
        range.push(i);
    }

    if (current - delta > 2) {
        rangeWithDots.push(1, '...');
    } else {
        rangeWithDots.push(1);
    }

    rangeWithDots.push(...range);

    if (current + delta < last - 1) {
        rangeWithDots.push('...', last);
    } else if (last > 1) {
        rangeWithDots.push(last);
    }

    return rangeWithDots;
});

const clearFilters = () => {
    search.value = '';
    selectedCategory.value = '';
    updateFilters();
};

const scrollToProducts = () => {
    const element = document.getElementById('products');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
};
</script>