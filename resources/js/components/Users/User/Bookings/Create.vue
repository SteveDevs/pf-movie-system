<template>
    <form @submit.prevent="submitForm">

        <!-- Movies -->
        <div class="mt-4">
            <label for="post-category" class="block font-medium text-sm text-gray-700">
                Category
            </label>
            <select-2 v-model="plays.id" :options="plays.start_end_time" :settings="{ width: '100%' }"></select-2>
            <div class="text-red-600 mt-1">
                {{ errors.movie_id }}
            </div>
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.movie_id">
                    {{ message }}
                </div>
            </div>
        </div>

        <!-- Movie plays times-->
        <div class="mt-4">
            <label for="post-category" class="block font-medium text-sm text-gray-700">
                Category
            </label>
            <select-2 v-model="movies.id" :options="movies" :settings="{ width: '100%' }"></select-2>
            <div class="text-red-600 mt-1">
                {{ errors.movie_id }}
            </div>
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.movie_id">
                    {{ message }}
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <button :disabled="isLoading" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded disabled:opacity-75 disabled:cursor-not-allowed">
                <div v-show="isLoading" class="inline-block animate-spin w-4 h-4 mr-2 border-t-2 border-t-white border-r-2 border-r-white border-b-2 border-b-white border-l-2 border-l-blue-600 rounded-full"></div>
                <span v-if="isLoading">Processing...</span>
                <span v-else>Save Booking</span>
            </button>
        </div>
    </form>
</template>

<script>
import { onMounted, reactive } from "vue";
import usePlays from "../../composables/plays";
import { useForm, useField, defineRule } from "vee-validate";
import { required, min } from "../../validation/rules"

defineRule('required', required)
defineRule('min', min);

export default {
    setup() {
        // Define a validation schema
        const schema = {
            title: 'required|min:5',
            content: 'required|min:50',
            category_id: 'required'
        }

        // Create a form context with the validation schema
        const { validate, errors } = useForm({ validationSchema: schema })

        // Define actual fields for validation
        const { value: title } = useField('title', null, { initialValue: '' });
        const { value: content } = useField('content', null, { initialValue: '' });
        const { value: category_id } = useField('category_id', null, { initialValue: '', label: 'category' });

        const { categories, getCategories } = useCategories()
        const { storePost, validationErrors, isLoading } = usePosts()

        const post = reactive({
            title,
            content,
            category_id,
            thumbnail: ''
        })

        function submitForm() {
            validate().then(form => { if (form.valid) storePost(post) })
        }

        onMounted(() => {
            getCategories()
        })

        return {
            categories,
            post,
            validationErrors,
            isLoading,
            errors,
            submitForm
        }
    }
}
</script>
