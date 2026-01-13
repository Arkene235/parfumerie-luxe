<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <div class="border-b border-gray-100 bg-white">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('products.index')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <NavLink
                                    :href="route('products.index')"
                                    :active="route().current('products.*')"
                                >
                                    Parfums
                                </NavLink>
                                <NavLink
                                    :href="route('about.index')"
                                    :active="route().current('about.*')"
                                >
                                    Notre Histoire
                                </NavLink>
                                <NavLink
                                    :href="route('contact.index')"
                                    :active="route().current('contact.*')"
                                >
                                    Contact
                                </NavLink>
                                <NavLink
                                    :href="route('cart.index')"
                                    :active="route().current('cart.*')"
                                >
                                    Panier
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center" v-if="!$page.props.auth.user">
                            <NavLink
                                :href="route('login')"
                                :active="route().current('login')"
                            >
                                Login
                            </NavLink>
                            <NavLink
                                :href="route('register')"
                                :active="route().current('register')"
                                class="ml-4"
                            >
                                Register
                            </NavLink>
                        </div>

                        <!-- Authenticated User Menu -->
                        <div class="hidden sm:ms-6 sm:flex sm:items-center" v-if="$page.props.auth.user">
                            <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Dashboard
                            </NavLink>
                            <NavLink
                                :href="route('wishlist.index')"
                                :active="route().current('wishlist.*')"
                                class="ml-4"
                            >
                                Liste de souhaits
                            </NavLink>
                            <NavLink
                                :href="route('orders.index')"
                                :active="route().current('orders.*')"
                                class="ml-4"
                            >
                                Commandes
                            </NavLink>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div
                        :class="{
                            block: showingNavigationDropdown,
                            hidden: !showingNavigationDropdown,
                        }"
                        class="sm:hidden"
                    >
                        <div class="space-y-1 pb-3 pt-2">
                            <ResponsiveNavLink
                                :href="route('products.index')"
                                :active="route().current('products.*')"
                            >
                                Parfums
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('about.index')"
                                :active="route().current('about.*')"
                            >
                                Notre Histoire
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('contact.index')"
                                :active="route().current('contact.*')"
                            >
                                Contact
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('cart.index')"
                                :active="route().current('cart.*')"
                            >
                                Panier
                            </ResponsiveNavLink>
                        </div>

                        <div class="border-t border-gray-200 pb-1 pt-4" v-if="!$page.props.auth.user">
                            <div class="space-y-1">
                                <ResponsiveNavLink
                                    :href="route('login')"
                                >
                                    Login
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    :href="route('register')"
                                >
                                    Register
                                </ResponsiveNavLink>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pb-1 pt-4" v-if="$page.props.auth.user">
                            <div class="space-y-1">
                                <ResponsiveNavLink
                                    :href="route('dashboard')"
                                >
                                    Dashboard
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    :href="route('wishlist.index')"
                                >
                                    Liste de souhaits
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    :href="route('orders.index')"
                                >
                                    Commandes
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Heading -->
                <header
                    v-if="$slots.header"
                    class="bg-white shadow"
                >
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>

            <!-- Footer -->
            <footer class="bg-blue-900 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center">
                                <ApplicationLogo class="h-8 w-auto mr-3 fill-current text-white" />
                                <span class="text-xl font-bold">Parfumerie de Luxe</span>
                            </div>
                        </div>
                        <div class="text-center md:text-right">
                            <p class="text-blue-200 text-sm">
                                © {{ new Date().getFullYear() }} Parfumerie de Luxe. Tous droits réservés.
                            </p>
                            <p class="text-blue-300 text-xs mt-1">
                                Développé par <span class="font-semibold">Ali Mouannis</span>
                            </p>
                        </div>
                    </div>
                    <div class="border-t border-blue-800 mt-6 pt-6">
                        <div class="flex flex-col md:flex-row justify-center items-center space-y-2 md:space-y-0 md:space-x-6">
                            <Link :href="route('products.index')" class="text-blue-200 hover:text-white transition-colors duration-200 text-sm">
                                Parfums
                            </Link>
                            <Link :href="route('about.index')" class="text-blue-200 hover:text-white transition-colors duration-200 text-sm">
                                Notre Histoire
                            </Link>
                            <Link :href="route('contact.index')" class="text-blue-200 hover:text-white transition-colors duration-200 text-sm">
                                Contact
                            </Link>
                            <Link :href="route('cart.index')" class="text-blue-200 hover:text-white transition-colors duration-200 text-sm">
                                Panier
                            </Link>
                            <span class="text-blue-400 text-xs">•</span>
                            <span class="text-blue-300 text-xs">Site e-commerce de parfums haut de gamme</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>