<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';

defineOptions({ layout: PublicLayout });
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-cyan-50">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-blue-800 to-cyan-800 text-white">
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white to-cyan-200 bg-clip-text text-transparent">
                        Notre Histoire
                    </h1>
                    <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                        Découvrez l'aventure passionnante de notre parfumerie de luxe
                    </p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 120" class="w-full h-12 md:h-20">
                    <path fill="#ffffff" d="M0,32L48,37.3C96,43,192,53,288,58.7C384,64,480,64,576,58.7C672,53,768,43,864,48C960,53,1056,75,1152,80C1248,85,1344,75,1392,69.3L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
                </svg>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-blue-100">
                <!-- Story Timeline -->
                <div class="p-8 md:p-12 space-y-12">
                    <!-- Introduction -->
                    <div class="text-center mb-12">
                        <div class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-full text-sm font-semibold mb-6">
                            ✨ Depuis 2020
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                            Une Passion pour l'Excellence
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            Notre parfumerie de luxe est née d'une passion profonde pour les fragrances rares et précieuses. 
                            Nous croyons que chaque parfum raconte une histoire unique et mérite d'être découvert.
                        </p>
                    </div>

                    <!-- Timeline Items -->
                    <div class="space-y-16">
                        <!-- 2020 -->
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="flex-shrink-0">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                    2020
                                </div>
                            </div>
                            <div class="flex-1 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-8 border border-blue-100">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Les Débuts</h3>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    Tout a commencé avec un rêve : créer une parfumerie qui célèbre l'art de la fragrance. 
                                    Nous avons commencé avec une sélection soignée de parfums haut de gamme, chacun choisi 
                                    pour sa qualité exceptionnelle et son caractère unique.
                                </p>
                                <div class="flex flex-wrap gap-2 mt-4">
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-blue-600">Passion</span>
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-blue-600">Qualité</span>
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-blue-600">Excellence</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2022 -->
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="flex-shrink-0">
                                <div class="w-24 h-24 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                    2022
                                </div>
                            </div>
                            <div class="flex-1 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 border border-purple-100">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">L'Expansion</h3>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    Grâce à la confiance de nos clients, nous avons élargi notre collection avec des fragrances 
                                    exclusives du monde entier. Chaque nouveau parfum est soigneusement sélectionné pour offrir 
                                    une expérience olfactive inoubliable.
                                </p>
                                <div class="flex flex-wrap gap-2 mt-4">
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-purple-600">Croissance</span>
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-purple-600">Innovation</span>
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-purple-600">Exclusivité</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2024 -->
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="flex-shrink-0">
                                <div class="w-24 h-24 bg-gradient-to-br from-cyan-600 to-teal-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                    2024
                                </div>
                            </div>
                            <div class="flex-1 bg-gradient-to-br from-cyan-50 to-teal-50 rounded-2xl p-8 border border-cyan-100">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">L'Excellence Digitale</h3>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    Nous avons lancé notre plateforme en ligne pour rendre nos parfums accessibles à tous, 
                                    tout en maintenant notre engagement envers la qualité et le service client exceptionnel. 
                                    Chaque commande est préparée avec soin et attention.
                                </p>
                                <div class="flex flex-wrap gap-2 mt-4">
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-cyan-600">Digital</span>
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-cyan-600">Accessibilité</span>
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-cyan-600">Service</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2026 -->
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="flex-shrink-0">
                                <div class="w-24 h-24 bg-gradient-to-br from-amber-600 to-orange-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                    2026
                                </div>
                            </div>
                            <div class="flex-1 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-8 border border-amber-100">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aujourd'hui et Demain</h3>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    Aujourd'hui, nous sommes fiers d'offrir une collection exclusive de parfums qui allie 
                                    tradition et modernité. Notre mission reste la même : vous offrir des fragrances d'exception 
                                    qui reflètent votre personnalité unique.
                                </p>
                                <div class="flex flex-wrap gap-2 mt-4">
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-amber-600">Tradition</span>
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-amber-600">Modernité</span>
                                    <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-amber-600">Avenir</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Values Section -->
                    <div class="mt-16 pt-12 border-t border-gray-200">
                        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Nos Valeurs</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl border border-blue-100">
                                <div class="text-5xl mb-4">💎</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Qualité Premium</h3>
                                <p class="text-gray-600">
                                    Nous sélectionnons uniquement les meilleurs parfums, élaborés avec des ingrédients rares et précieux.
                                </p>
                            </div>
                            <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-100">
                                <div class="text-5xl mb-4">✨</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Excellence</h3>
                                <p class="text-gray-600">
                                    Chaque détail compte. Nous nous engageons à offrir une expérience d'achat exceptionnelle.
                                </p>
                            </div>
                            <div class="text-center p-6 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-100">
                                <div class="text-5xl mb-4">❤️</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Passion</h3>
                                <p class="text-gray-600">
                                    Notre amour pour les parfums se reflète dans chaque interaction et chaque produit que nous proposons.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="mt-16 text-center bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl p-12 text-white">
                        <h2 class="text-3xl font-bold mb-4">Rejoignez Notre Aventure</h2>
                        <p class="text-xl mb-8 text-blue-100">
                            Découvrez notre collection exclusive et trouvez le parfum qui vous correspond
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link
                                :href="route('products.index')"
                                class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-blue-50 transform hover:scale-105 transition-all duration-300 shadow-xl"
                            >
                                Explorer la Collection
                            </Link>
                            <Link
                                :href="route('contact.index')"
                                class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transform hover:scale-105 transition-all duration-300"
                            >
                                Nous Contacter
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

