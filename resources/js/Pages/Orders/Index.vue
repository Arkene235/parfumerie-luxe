<template>
    <AuthenticatedLayout title="Orders">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-2xl font-bold mb-4">Historique des Commandes</h1>
                        <div v-if="orders.length === 0" class="text-center">
                            <p>Vous n'avez pas encore de commandes.</p>
                        </div>
                        <div v-else>
                            <div v-for="order in orders" :key="order.id" class="border rounded-lg p-4 mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <h2 class="text-lg font-semibold">Commande #{{ order.id }}</h2>
                                    <span class="px-2 py-1 rounded text-sm" :class="order.status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'">
                                        {{ order.status }}
                                    </span>
                                </div>
                                <p class="text-gray-600">Total: ${{ order.total }}</p>
                                <p class="text-gray-600">Date: {{ new Date(order.created_at).toLocaleDateString('fr-FR') }}</p>
                                <div class="mt-4">
                                    <h3 class="font-semibold">Articles:</h3>
                                    <ul class="list-disc list-inside">
                                        <li v-for="item in order.order_items" :key="item.id">
                                            {{ item.product.name }} - Quantité: {{ item.quantity }} - {{ item.price }} DH
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    orders: Array,
});
</script>