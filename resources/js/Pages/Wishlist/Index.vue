<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

defineOptions({ layout: AuthenticatedLayout });

defineProps({
    wishlists: Array,
});
</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div v-if="wishlists.length === 0" class="text-center">
                        <div class="text-gray-500 mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            Votre liste de souhaits est vide
                        </h3>
                        <p class="text-gray-500 mb-6">
                            Découvrez nos parfums et ajoutez vos favoris à votre liste de souhaits.
                        </p>
                        <Link
                            :href="route('products.index')"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            Découvrir les parfums
                        </Link>
                    </div>

                        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div
                                v-for="wishlist in wishlists"
                                :key="wishlist.id"
                                class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200"
                            >
                                <div class="aspect-w-1 aspect-h-1">
                                    <img
                                        :src="wishlist.product.image"
                                        :alt="wishlist.product.name"
                                        class="w-full h-48 object-cover"
                                    />
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        {{ wishlist.product.name }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-2">
                                        {{ wishlist.product.description.substring(0, 100) }}...
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-bold text-purple-600">
                                            {{ wishlist.product.price }} DH
                                        </span>
                                        <div class="flex space-x-2">
                                            <Link
                                                :href="route('cart.add', wishlist.product.id)"
                                                method="POST"
                                                class="inline-flex items-center px-3 py-1 bg-purple-600 border border-transparent rounded-md text-xs font-semibold text-white uppercase tracking-widest hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                            >
                                                Ajouter au panier
                                            </Link>
                                            <Link
                                                :href="route('wishlist.destroy', wishlist.id)"
                                                method="DELETE"
                                                class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md text-xs font-semibold text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                            >
                                                Retirer
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>