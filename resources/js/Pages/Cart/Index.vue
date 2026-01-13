<template>
    <PublicLayout title="Cart">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-2xl font-bold mb-4">Votre Panier</h1>
                        <div v-if="cartItems.length === 0" class="text-center">
                            <p>Votre panier est vide.</p>
                            <Link :href="route('products.index')" class="text-blue-500">Continuer vos achats</Link>
                        </div>
                        <div v-else>
                            <div v-for="item in cartItems" :key="item.product.id" class="flex justify-between items-center border-b py-4">
                                <div class="flex items-center">
                                    <img v-if="item.product.image" :src="item.product.image" :alt="item.product.name" class="w-16 h-16 object-cover mr-4">
                                    <div>
                                        <h2 class="text-lg font-semibold">{{ item.product.name }}</h2>
                                        <p>{{ item.product.price }} DH</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <form v-if="$page.props.auth.user" @submit.prevent="updateQuantity(item.product, $event.target.quantity.value)" class="flex items-center">
                                        <input type="number" :value="item.quantity" name="quantity" min="1" class="w-16 text-center border rounded mr-2">
                                        <button type="submit" class="bg-gray-500 text-white px-2 py-1 rounded mr-2">Update</button>
                                    </form>
                                    <Link v-if="$page.props.auth.user" :href="route('cart.remove', item.product.id)" method="delete" as="button" class="bg-red-500 text-white px-2 py-1 rounded">Remove</Link>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">{{ item.total }}</p>
                                </div>
                            </div>
                            <div class="mt-6 text-right">
                                <p class="text-xl font-bold">Total: {{ total }}</p>
                                <Link v-if="$page.props.auth.user" :href="route('checkout.index')" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block hover:bg-blue-600 transition-colors">Procéder au Paiement</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    cartItems: Array,
});

const total = computed(() => {
    if (!props.cartItems || !Array.isArray(props.cartItems)) return 0;
    return props.cartItems.reduce((sum, item) => {
        const itemTotal = parseFloat(item.total) || 0;
        return sum + itemTotal;
    }, 0);
});

const updateQuantity = (product, quantity) => {
    router.patch(route('cart.update', product.id), { quantity });
};
</script>