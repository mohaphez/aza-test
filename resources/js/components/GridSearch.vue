<template>
    <div class="bg-white">
        <div
            class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8"
        >
            <div class="text-center w-full">
                <h1 class="block mb-2 text-gray-900 dark:text-white">
                    Search Movie
                </h1>
                <input
                    type="text"
                    @input="search"
                    v-model="jsonData.q"
                    id="first_name"
                    class="bg-gray-50 m-auto mb-10 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-4/12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="John Wick"
                    required
                />
            </div>
            <div class="text-center" v-if="loading">
                <div role="status">
                    <svg
                        class="inline mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor"
                        />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill"
                        />
                    </svg>
                </div>
            </div>
            <div
                v-else
                class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
            >
                <a v-for="movie in movies" href="#" class="group">
                    <div
                        class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8"
                    >
                        <img
                            :src="movie.poster"
                            :alt="movie.title"
                            class="h-full w-full object-cover object-center group-hover:opacity-75"
                        />
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">
                        <span
                            class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"
                            >{{ movie.country }}</span
                        >
                        <span
                            class="bg-yellow-100 text-yellow-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-800"
                        >
                            <svg
                                class="mr-2 mb-1 w-3 h-3"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                ></path>
                            </svg>
                            {{ movie.imdb_rating }}</span
                        >
                    </h3>
                    <p class="mt-1 text-lg font-medium text-gray-900">
                        {{ movie.title }}
                    </p>
                    <h5 class="mt-1">
                        <span
                            v-for="genre in movie.genres"
                            class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300"
                            >{{ genre }}</span
                        >
                    </h5>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            jsonData: {
                q: "",
            },
            movies: [],
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        async search() {
            try {
                if (this.jsonData.q.length <= 1) return;
                this.loading = true;
                this.movies = [];
                const res = await fetch(
                    `/api/movie/search?q=${this.jsonData.q}&page=1`
                );
                this.loading = false;
                if (!res.ok) {
                    const message = `An error has occured: ${res.status}`;
                    throw new Error(message);
                }
                const data = await res.json();
                this.movies = data.data;
            } catch (err) {
                //
            }
        },
    },
};
</script>
