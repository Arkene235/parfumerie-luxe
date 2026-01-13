<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    product: Object,
    reviews: Array,
});

const showReviewForm = ref(false);

const form = useForm({
    rating: 5,
    comment: '',
});

const submitReview = () => {
    form.post(route('reviews.store', props.product.id), {
        onSuccess: () => {
            form.reset();
            showReviewForm.value = false;
        },
    });
};

const renderStars = (rating) => {
    const stars = [];
    for (let i = 1; i <= 5; i++) {
        stars.push({
            filled: i <= rating,
            value: i,
        });
    }
    return stars;
};
</script>

<template>
    <div class="mt-8 border-t pt-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">
                Avis clients ({{ reviews.length }})
            </h3>
            <button
                v-if="$page.props.auth.user && !reviews.find(r => r.user_id === $page.props.auth.user.id)"
                @click="showReviewForm = !showReviewForm"
                class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200"
            >
                Écrire un avis
            </button>
        </div>

        <!-- Review Form -->
        <div v-if="showReviewForm" class="bg-gray-50 p-6 rounded-lg mb-6">
            <h4 class="text-lg font-medium mb-4">Votre avis</h4>
            <form @submit.prevent="submitReview">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Note</label>
                    <div class="flex space-x-1">
                        <button
                            v-for="star in 5"
                            :key="star"
                            type="button"
                            @click="form.rating = star"
                            class="text-2xl"
                            :class="star <= form.rating ? 'text-yellow-400' : 'text-gray-300'"
                        >
                            ★
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Commentaire</label>
                    <textarea
                        id="comment"
                        v-model="form.comment"
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                        placeholder="Partagez votre expérience avec ce parfum..."
                    ></textarea>
                    <InputError :message="form.errors.comment" class="mt-2" />
                </div>
                <div class="flex space-x-2">
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Publier l'avis
                    </PrimaryButton>
                    <button
                        type="button"
                        @click="showReviewForm = false"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200"
                    >
                        Annuler
                    </button>
                </div>
            </form>
        </div>

        <!-- Reviews List -->
        <div v-if="reviews.length > 0" class="space-y-6">
            <div
                v-for="review in reviews"
                :key="review.id"
                class="bg-white border border-gray-200 rounded-lg p-6"
            >
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <span v-for="star in renderStars(review.rating)" :key="star.value" class="text-yellow-400">
                                ★
                            </span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ review.user.name }}</p>
                            <p class="text-sm text-gray-500">{{ new Date(review.created_at).toLocaleDateString('fr-FR') }}</p>
                        </div>
                    </div>
                </div>
                <p v-if="review.comment" class="mt-4 text-gray-700">{{ review.comment }}</p>
            </div>
        </div>

        <div v-else class="text-center py-8 text-gray-500">
            Aucun avis pour le moment. Soyez le premier à donner votre avis !
        </div>
    </div>
</template>