<script setup>
import { ref, computed } from 'vue';
import { useForm, router, usePage } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';

defineOptions({ layout: PublicLayout });

const props = defineProps({
    product: Object,
    reviews: Array,
});

const page = usePage();
const showReviewForm = ref(false);
const editingReview = ref(null);

// Vérifier si l'utilisateur a déjà un avis
const userReview = computed(() => {
    if (!page.props.auth?.user) return null;
    return props.reviews.find(r => r.user_id === page.props.auth.user.id);
});

const form = useForm({
    rating: 5,
    comment: '',
});

const startEdit = (review) => {
    editingReview.value = review.id;
    form.rating = review.rating;
    form.comment = review.comment || '';
    showReviewForm.value = true;
};

const cancelEdit = () => {
    editingReview.value = null;
    form.reset();
    form.rating = 5;
    showReviewForm.value = false;
};

const submitReview = () => {
    if (editingReview.value) {
        // Mettre à jour l'avis existant
        form.patch(route('reviews.update', editingReview.value), {
            onSuccess: () => {
                form.reset();
                form.rating = 5;
                showReviewForm.value = false;
                editingReview.value = null;
            },
        });
    } else {
        // Créer un nouvel avis
        form.post(route('reviews.store', props.product.id), {
            onSuccess: () => {
                form.reset();
                form.rating = 5;
                showReviewForm.value = false;
            },
        });
    }
};

const deleteReview = (reviewId) => {
    if (confirm('Êtes-vous sûr de vouloir supprimer votre avis ?')) {
        router.delete(route('reviews.destroy', reviewId));
    }
};
</script>

<template>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <!-- Breadcrumb -->
                        <nav class="flex mb-6" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <li class="inline-flex items-center">
                                    <Link :href="route('products.index')" class="text-gray-700 hover:text-purple-600">Accueil</Link>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                        </svg>
                                        <Link :href="route('products.index')" class="text-gray-700 hover:text-purple-600">Parfums</Link>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                        </svg>
                                        <span class="text-gray-500">{{ product.name }}</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Product Image -->
                            <div class="text-center">
                                <img
                                    v-if="product.image"
                                    :src="product.image"
                                    :alt="product.name"
                                    class="w-full max-w-md mx-auto rounded-lg shadow-lg"
                                />
                                <div v-else class="w-full max-w-md mx-auto h-96 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center shadow-lg">
                                    <span class="text-8xl">💐</span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ product.name }}</h1>
                                <p v-if="product.category" class="text-purple-600 font-medium mb-4">{{ product.category.name }}</p>
                                <p v-else class="text-purple-600 font-medium mb-4">Non catégorisé</p>

                                <!-- Rating -->
                                <div class="flex items-center mb-4">
                                    <div class="flex items-center mr-4">
                                        <div v-for="star in 5" :key="star" class="text-yellow-400">
                                            <svg v-if="star <= Math.round(Number(product.rating || 0))" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <svg v-else class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </div>
                                        <span class="ml-2 text-gray-600">
                                            {{ Number(product.rating || 0).toFixed(1) }} ({{ product.review_count || 0 }} avis)
                                        </span>
                                    </div>
                                </div>

                                <p class="text-gray-700 mb-6">{{ product.description }}</p>

                                <div class="mb-6">
                                    <p class="text-3xl font-bold text-purple-800 mb-2">{{ product.price }} DH</p>
                                    <p class="text-sm text-gray-600">
                                        Stock disponible: <span :class="product.stock > 0 ? 'text-green-600' : 'text-red-600'">
                                            {{ product.stock > 0 ? product.stock + ' unités' : 'Épuisé' }}
                                        </span>
                                    </p>
                                </div>

                                <div class="flex space-x-4">
                                    <Link
                                        :href="route('cart.add', product.id)"
                                        method="post"
                                        as="button"
                                        class="flex-1 bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors duration-200 font-medium shadow-md text-center"
                                        :disabled="product.stock === 0"
                                    >
                                        {{ product.stock > 0 ? 'Ajouter au Panier' : 'Épuisé' }}
                                    </Link>
                                    <Link
                                        v-if="$page.props.auth.user"
                                        :href="route('wishlist.toggle', product.id)"
                                        method="post"
                                        as="button"
                                        class="bg-gray-100 text-gray-600 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                                        title="Ajouter à la liste de souhaits"
                                    >
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Section -->
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    Avis clients ({{ reviews?.length || 0 }})
                                </h2>
                                <button
                                    v-if="page.props.auth?.user && !userReview && !showReviewForm"
                                    @click="showReviewForm = true"
                                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200 font-medium"
                                >
                                    Écrire un avis
                                </button>
                            </div>

                            <!-- Review Form -->
                            <div v-if="showReviewForm" class="bg-gray-50 p-6 rounded-lg mb-6 border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    {{ editingReview ? 'Modifier votre avis' : 'Votre avis' }}
                                </h3>
                                <form @submit.prevent="submitReview" class="space-y-4">
                                    <div>
                                        <InputLabel for="rating" value="Note" />
                                        <div class="flex space-x-2 mt-2">
                                            <button
                                                v-for="star in 5"
                                                :key="star"
                                                type="button"
                                                @click="form.rating = star"
                                                class="text-3xl transition-transform duration-200 hover:scale-110"
                                                :class="star <= form.rating ? 'text-yellow-400' : 'text-gray-300'"
                                            >
                                                ★
                                            </button>
                                        </div>
                                        <InputError :message="form.errors.rating" class="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel for="comment" value="Commentaire (optionnel)" />
                                        <textarea
                                            id="comment"
                                            v-model="form.comment"
                                            rows="4"
                                            class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                            placeholder="Partagez votre expérience avec ce parfum..."
                                        ></textarea>
                                        <InputError :message="form.errors.comment" class="mt-2" />
                                    </div>

                                    <div class="flex space-x-3">
                                        <PrimaryButton
                                            :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing"
                                        >
                                            {{ editingReview ? 'Mettre à jour' : 'Publier l\'avis' }}
                                        </PrimaryButton>
                                        <button
                                            type="button"
                                            @click="cancelEdit"
                                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200"
                                        >
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Reviews List -->
                            <div v-if="reviews && reviews.length > 0" class="space-y-4">
                                <div
                                    v-for="review in reviews"
                                    :key="review.id"
                                    class="bg-white border border-gray-200 rounded-lg p-6"
                                >
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3 mb-2">
                                                <span class="font-semibold text-gray-900">{{ review.user?.name || 'Anonyme' }}</span>
                                                <div class="flex items-center">
                                                    <span v-for="star in 5" :key="star" class="text-yellow-400">
                                                        <svg v-if="star <= review.rating" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                        <svg v-else class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <span class="text-sm text-gray-500">
                                                    {{ new Date(review.created_at).toLocaleDateString('fr-FR') }}
                                                </span>
                                            </div>
                                            <p v-if="review.comment" class="text-gray-700 mt-2">{{ review.comment }}</p>
                                        </div>
                                        <div v-if="page.props.auth?.user && review.user_id === page.props.auth.user.id" class="flex space-x-2 ml-4">
                                            <button
                                                @click="startEdit(review)"
                                                class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                                            >
                                                Modifier
                                            </button>
                                            <button
                                                @click="deleteReview(review.id)"
                                                class="text-red-600 hover:text-red-800 text-sm font-medium"
                                            >
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-else class="text-center py-8 text-gray-500">
                                <p>Aucun avis pour le moment.</p>
                                <p v-if="!page.props.auth?.user" class="mt-2 text-sm">
                                    <Link :href="route('login')" class="text-purple-600 hover:underline">Connectez-vous</Link> pour être le premier à donner votre avis !
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>