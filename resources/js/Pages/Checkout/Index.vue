<template>
    <AuthenticatedLayout title="Checkout">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-2xl font-bold mb-4">Paiement</h1>
                        <p class="text-xl mb-4">Total: ${{ total }}</p>
                        <form @submit.prevent="submitPayment" class="space-y-4">
                            <div>
                                <label for="card-element" class="block text-sm font-medium text-gray-700">Carte de Crédit ou Débit</label>
                                <div id="card-element" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></div>
                                <div id="card-errors" class="text-red-500 text-sm mt-1" role="alert"></div>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors" :disabled="processing">
                                {{ processing ? 'Traitement...' : 'Payer Maintenant' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import { loadStripe } from '@stripe/stripe-js';

const props = defineProps({
    total: Number,
});

let stripe = null;
let cardElement = null;
let processing = false;

onMounted(async () => {
    stripe = await loadStripe(import.meta.env.VITE_STRIPE_KEY);
    const elements = stripe.elements();
    cardElement = elements.create('card');
    cardElement.mount('#card-element');
    cardElement.on('change', (event) => {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
});

const submitPayment = async () => {
    processing = true;
    const { token, error } = await stripe.createToken(cardElement);
    if (error) {
        document.getElementById('card-errors').textContent = error.message;
        processing = false;
    } else {
        router.post('/checkout', { stripeToken: token.id });
    }
};
</script>